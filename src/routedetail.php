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
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="max-w-screen-xl p-5 mx-auto min-h-screen flex flex-col justify-between">
        <div class="rounded-lg border relative shadow-lg p-4">
            <form method="POST">
                <h1 class="text-3xl font-bold text-center mb-5">HALAMAN RUTE DETAIL</h1>

                <h3>Nama Rute: <span class="font-bold"><?php echo $dataRute['route_name'] ?></span></h3>
                <h3>Kuota rute: <span class="font-bold"><?php echo $dataRute['route_recent'] ?> / <?php echo $dataRute['route_quota'] ?></span></h3>
                <h3>Alamat: <span class="font-bold"><?php echo $dataRute['route_address'] ?></span></h3>
                <h3>Status: <span class="font-bold"><?php echo $dataRute['route_status'] ?></span></h3>
                <h3 class="mb-3">Harga tiket: <span class="font-bold"><?php echo $dataRute['route_price'] ?></span></h3>

                <button class="border-black rounded-sm border px-3 py-2 hover:bg-black hover:text-white" name="submit">Booking</button>
            </form>
        </div>
    </div>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    if (!isset($_SESSION['user'])) {
        echo "<script>alert('user belum login')</script>";
    } else {
        $user_data = $_SESSION['user'];
        $user_id = $user_data['user_id'];
        $queryUserDetail = $conn->query("SELECT user_detail_id ,user_identity_status FROM user_detail WHERE user_id = '$user_id'");
        $dataUserDetail = $queryUserDetail->fetch_assoc();
        if ($dataUserDetail['user_identity_status'] == 'verified') {
            // TO DO:
            // 1. Generate token -> masukin ke variable booking_token (panjang 6, terdiri dari lowercase, uppercase, dan angka)
            // 2. Get current date -> masukin ke variable booking_date (tanggal hari user pencet booking)
            // 3. Generate expired_date -> masuking ke variable booking_expired (current_date + 5 hari)
            // 4. INSERT route_id, user_detail_id, booking_date, booking_expired, booking_status, booking_token ke TABLE booking_log
            // 5. Redirect ke ongoing page

            if ($queryInsert) {
                echo "<script>alert('Data booking sudah tersimpan')</script>";
            } else {
                echo "<script>alert('Server error')</script>";
            }
        } else {
            echo "<script>alert('KTP BELUM TERVERIFIKASI')</script>";
        }
    }
}
?>