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
    <table>
        <tr>
            <th>No Booking</th>
            <th>No Route</th>
            <th>User Detail</th>
            <th>Booking Date</th>
            <th>Booking Expired</th>
            <th>Booking_status</th>
            <th>booking_token</th>
            <th>Detail Tiket</th>

        </tr>
        <tr>
                <td><?php echo $dataBooking['booking_log_id'] ?> </td>
                <td><?php echo $dataBooking['route_id'] ?> </td>
                <td><?php echo $dataBooking['user_detail_id'] ?> </td>
                <td><?php echo $dataBooking['booking_date'] ?></td>
                <td><?php echo $dataBooking['booking_expired'] ?></td>
                <td><?php echo $dataBooking['booking_status'] ?></td>
                <td><?php echo $dataBooking['booking_token'] ?></td>
                <td><a href="ongoing.php?booking_log=<?php echo $dataBooking['booking_log_id'] ?>">Lihat</a></td>
        </tr>
</body>

</html>