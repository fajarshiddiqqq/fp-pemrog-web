<?php
include "connection.php";
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Login Terlebih Dahulu!')</script>";
    echo "<script>location='./login'</script>";
}

$userId = $_SESSION['user']['user_id'];

$queryUserDetail = $conn->query("SELECT * FROM `user_detail` WHERE user_id = '$userId'");
$dataUserDetail = $queryUserDetail->fetch_assoc();

$userDetailId = $dataUserDetail['user_detail_id'];
$queryBooking = $conn->query("SELECT * FROM `booking_log` WHERE user_detail_id = $userDetailId");

if ($queryBooking) {
    $dataBooking = array();
    while ($arrData = $queryBooking->fetch_assoc()) {
        $dataBooking[] = $arrData;
    }
} else {
    echo "<script>location='./index.php'</script>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Page</title>
    <link rel="stylesheet" href="../dist/output.css">
    <style>
        .title-bg {
            width: 100vw;
            height: 369px;
            flex-shrink: 0;
            background-image: url('/assets/img/Background/image_3.png');
            background-color: lightgray;
            background-position: 0px -48.289px;
            background-size: 148.752% 157.279%;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
    </style>
</head>

<body>
    <?php include './components/navbar.php'; ?>
    <div class="title-bg" style="background-image: url(../assets/img/Background/image_3.png);">
        <h2 class="text-center px-4 py-2 text-4xl text-black">History Booking Pendakian</h2>
    </div>

    <div class="container mx-auto mt-8">
        <table class="border-collapse w-full">
            <tr>
                <th class="border border-slate-600 px-4 py-2">No</th>
                <th class="border border-slate-600 px-4 py-2">Booking ID</th>
                <th class="border border-slate-600 px-4 py-2">No Route</th>
                <th class="border border-slate-600 px-4 py-2">Booking Date</th>
                <th class="border border-slate-600 px-4 py-2">Booking Expired</th>
                <th class="border border-slate-600 px-4 py-2">Booking_status</th>
                <th class="border border-slate-600 px-4 py-2">booking_token</th>
                <th class="border border-slate-600 px-4 py-2">Hapus</th>
            </tr>
            <?php foreach ($dataBooking as $key => $value) : ?>
                <?php if ($dataBooking['booking_status'] != 'pending') : ?>
                    <tr class="bg-gray-200">
                        <td class=" text-center px-4 py-2"><?php echo $key + 1 ?> </td>
                        <td class=" text-center px-4 py-2"><?php echo $value['booking_log_id'] ?> </td>
                        <td class=" text-center px-4 py-2"><?php echo $value['route_id'] ?> </td>
                        <td class=" text-center px-4 py-2"><?php echo $value['booking_date'] ?></td>
                        <td class=" text-center px-4 py-2"><?php echo $value['booking_expired'] ?></td>
                        <td class=" text-center px-4 py-2"><?php echo $value['booking_status'] ?></td>
                        <td class=" text-center px-4 py-2"><?php echo $value['booking_token'] ?></td>
                        <td class=" text-center px-4 py-2">
                            <a class="bg-red-500 text-white px-4 py-2 mt-4" href="./deletehistory.php?delete=<?php echo $value['booking_log_id'] ?>">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>