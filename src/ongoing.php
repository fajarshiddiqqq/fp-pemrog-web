<?php
    include './connection.php';
    $queryBooking = $conn->query("SELECT * FROM `booking_log` WHERE booking_log_id;");

    if ($queryBooking) {
        $dataBooking = $queryBooking->fetch_assoc();

    } else {
        echo "Gagal mengambil data booking.";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="../../dist/output.css">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .ticket-container {
            background-color: #f3f3f3;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
        }

        .ticket-info {
            margin-bottom: 15px;
        }

        .ticket-info h2 {
            margin: 0;
            font-size: 24px;
        }

        .ticket-info p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="ticket-container">
        <div class="ticket-info">
            <h2>Ongoing Tiket Pemesanan</h2>
            <p>No Tiket: <?php echo $dataBooking['booking_log_id']; ?></p>
            <p>Rute Tiket: <?php echo $dataBooking['route_id']; ?></p>
            <p>Nama Pemesan: <?php echo $dataBooking['user_detail_id']; ?></p>
            <p>Tanggal Pemesanan: <?php echo $dataBooking['booking_date']; ?></p>
            <p>Tanggal kadaluwarsa: <?php echo $dataBooking['booking_expired']; ?></p>
            <p>Status: <?php echo $dataBooking['booking_status']; ?></p>
            <p>Token Tiket: <?php echo $dataBooking['booking_token']; ?></p>
        </div>

        <button class="bg-red-500 text-white px-4 py-2 mt-2">Cancel</button>
    </div>
</body>

</html>
<?php
?>