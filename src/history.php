<?php
    include "connection.php";
    $queryBooking = $conn->query("SELECT * FROM `booking_log` WHERE booking_log_id;");
    $dataBooking = $queryBooking->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Page</title>
    <link rel="stylesheet" href="../dist/output.css">
</head>

<body>
    <?php include './components/navbar.php'; ?>
    <table class="border-collapse w-2/3 mx-auto">
        <tr>
            <th class="border border-slate-600 px-4 py-2">No Booking</th>
            <th class="border border-slate-600 px-4 py-2">No Route</th>
            <th class="border border-slate-600 px-4 py-2">User Detail</th>
            <th class="border border-slate-600 px-4 py-2">Booking Date</th>
            <th class="border border-slate-600 px-4 py-2">Booking Expired</th>
            <th class="border border-slate-600 px-4 py-2">Booking_status</th>
            <th class="border border-slate-600 px-4 py-2">booking_token</th>
            <th class="border border-slate-600 px-4 py-2">Detail Tiket</th>
        </tr>
        <tr class="bg-gray-200">
            <td class=" text-center px-4 py-2"><?php echo $dataBooking['booking_log_id'] ?> </td>
            <td class=" text-center px-4 py-2"><?php echo $dataBooking['route_id'] ?> </td>
            <td class=" text-center px-4 py-2"><?php echo $dataBooking['user_detail_id'] ?> </td>
            <td class=" text-center px-4 py-2"><?php echo $dataBooking['booking_date'] ?></td>
            <td class=" text-center px-4 py-2"><?php echo $dataBooking['booking_expired'] ?></td>
            <td class=" text-center px-4 py-2"><?php echo $dataBooking['booking_status'] ?></td>
            <td class=" text-center px-4 py-2"><?php echo $dataBooking['booking_token'] ?></td>
            <td class=" text-center px-4 py-2"><button class="bg-blue-500 text-black px-4 py-2 mt-4"><a href="ongoing.php?booking_log=<?php echo $dataBooking['booking_log_id'] ?>">Lihat</a></button></td>
        </tr>
    </table>
</body>

</html>