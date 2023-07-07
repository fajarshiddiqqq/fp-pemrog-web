<?php
include './connection.php';
$route_id = $_GET['route'];
$queryRute = $conn->query("SELECT * FROM `route` WHERE route_id = $route_id");


$dataRute = $queryRute->fetch_assoc();
// echo '<pre>';
// print_r($dataRute);
// echo '</pre>';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mountrip Id</title>
    <link rel="stylesheet" href="../dist/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <img src="../assets/img/Background/background.jpg" class="absolute w-full h-screen -z-20">
    <div class="absolute w-full h-screen -z-10 bg-black/[0.6]"></div>
    <?php include './components/navbar.php'; ?>

    <main class="absolute overflow-hidden overflow-y-auto w-full bg-transparent h-[calc(100vh-125px)] mt-[125px] p-12">
        <a href="mountaindetail.php?mountain=<?php echo $dataRute['mountain_id'] ?>" class="text-white font-semibold absolute top-0 left-16 underline">Back</a>

        <div class="rounded-lg border h-full relative shadow-lg px-12 py-8  text-white bg-black/[.4]">
            <form method="POST" class="flex flex-col justify-between h-full ">
                <div class="mx-auto max-w-screen-md w-full">
                    <h1 class="text-5xl font-bold text-center mb-12">Rute <?php echo $dataRute['route_name'] ?></h1>
                    <div class="grid grid-cols-5">
                        <div class="text-right col-span-2">
                            <h3 class="mb-3">Route Quota</h3>
                            <h3 class="mb-3">Route Status</h3>
                            <h3 class="mb-3">Route Price</h3>
                            <h3 class="mb-3">Route Address</h3>
                        </div>
                        <div class="col-span-1 flex items-center justify-center w-full">
                            <div class="bg-white w-[1px] h-full"> </div>
                        </div>
                        <div class="col-span-2">
                            <h3 class=" mb-3 font-semibold"><?php echo $dataRute['route_recent'] ?> / <?php echo $dataRute['route_quota'] ?></h3>
                            <h3 class="mb-3"><span class="font-semibold capitalize"><?php echo $dataRute['route_status'] ?></h3>
                            <h3 class="mb-3">Rp. <?php echo $dataRute['route_price'] ?></h3>
                            <h3 class="mb-3"><?php echo $dataRute['route_address'] ?></h3>

                        </div>
                    </div>
                </div>
                <button class="rounded-full text-center border border-white text-white bg-white/[.1] hover:bg-white/[.3] font-semibold w-full py-2" name="submit">Booking</button>
            </form>
        </div>
    </main>

</body>

</html>
<?php
if (isset($_POST['submit'])) {
    if (!isset($_SESSION['user'])) {
        echo "<script>alert('user belum login')</script>";
    } else {
        $user_data = $_SESSION['user'];
        $user_id = $user_data['user_id'];
        $queryUserDetail = $conn->query("SELECT user_detail_id,user_identity_status FROM user_detail WHERE user_id = '$user_id'");
        $dataUserDetail = $queryUserDetail->fetch_assoc();
        $userDetailId = $dataUserDetail['user_detail_id'];

        $queryCountBook = $conn->query("SELECT COUNT(booking_log_id) as jumlah FROM booking_log WHERE user_detail_id = $userDetailId");
        $countBook = $queryCountBook->fetch_assoc();

        if ($countBook['jumlah'] > 0) {
            echo "<script>alert('Tidak bisa booking lebih dari 1 kali dalam satu waktu!')</script>";
        } else {
            if ($dataUserDetail['user_identity_status'] == 'verified') {
                $routeRecent = $dataRute['route_recent'] - 1;
                $conn->query("UPDATE `route` SET route_recent = $routeRecent WHERE route_id= $route_id");

                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                $token = '';
                $max = strlen($characters) - 1;
                for ($i = 0; $i < 6; $i++) {
                    $token .= $characters[rand(0, $max)];
                }
                $user_detail_id = $dataUserDetail['user_detail_id'];
                $booking_date = date('Y-m-d H:i:s');
                $booking_expired = date('Y-m-d H:i:s', strtotime($booking_date . '+5 days'));
                $querryInsert = $conn->query("INSERT INTO booking_log(route_id, user_detail_id, booking_date, booking_expired, booking_status, booking_token) VALUES('$route_id','$user_detail_id','$booking_date', '$booking_expired','pending','$token')");
                if ($querryInsert) {
                    echo "<script>alert('Data booking sudah tersimpan')</script>";
                    echo "<script>window.location.href = 'history.php';</script>";
                } else {
                    echo "<script>alert('Internal server error')</script>";
                }
            } else {
                echo "<script>alert('KTP BELUM TERVERIFIKASI')</script>";
            }
        }
    }
}
?>