<?php
    include "connection.php";
    $queryBooking = $conn->query("SELECT * FROM `booking_log` WHERE booking_log_id;");
    $detail = $conn->query("SELECT user_full_name FROM `user_detail`");
    $dataBooking = $queryBooking->fetch_assoc();
    $namalengkap = $detail->fetch_assoc();
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
    width: 100vw; /* Mengambil 100% lebar viewport */
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
        <div class="title-bg ">
            <div class="bg-[url('/img/hero-pattern.svg')]">
                <h2 class="text-center px-4 py-2 text-4xl text-black">History Booking Pendakian</h2>
            </div>
        </div>

    <div class="container mx-auto mt-8">
        <table class="border-collapse w-full">    
            <tr>
                <th class="border border-slate-600 px-4 py-2">No Booking</th>
                <th class="border border-slate-600 px-4 py-2">No Route</th>
                <th class="border border-slate-600 px-4 py-2">Nama User</th>
                <th class="border border-slate-600 px-4 py-2">Booking Date</th>
                <th class="border border-slate-600 px-4 py-2">Booking Expired</th>
                <th class="border border-slate-600 px-4 py-2">Booking_status</th>
                <th class="border border-slate-600 px-4 py-2">booking_token</th>
                <th class="border border-slate-600 px-4 py-2">Detail Tiket</th>
            </tr>
            <tr class="bg-gray-200">
                <td class=" text-center px-4 py-2"><?php echo $dataBooking['booking_log_id'] ?> </td>
                <td class=" text-center px-4 py-2"><?php echo $dataBooking['route_id'] ?> </td>
                <td class=" text-center px-4 py-2"><?php echo $namalengkap['user_full_name'] ?> </td>
                <td class=" text-center px-4 py-2"><?php echo $dataBooking['booking_date'] ?></td>
                <td class=" text-center px-4 py-2"><?php echo $dataBooking['booking_expired'] ?></td>
                <td class=" text-center px-4 py-2"><?php echo $dataBooking['booking_status'] ?></td>
                <td class=" text-center px-4 py-2"><?php echo $dataBooking['booking_token'] ?></td>
                <td class=" text-center px-4 py-2"><button class="bg-blue-500 text-black px-4 py-2 mt-4"><a href="ongoing.php?booking_log=<?php echo $dataBooking['booking_log_id'] ?>">Lihat</a></button></td>
            </tr>
        </table>
    </div>
</body>

</html>