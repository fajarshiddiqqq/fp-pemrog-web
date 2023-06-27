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
    <title>Ongoing Page</title>
    <link rel="stylesheet" href="../../dist/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        form {
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
<?php include './components/navbar.php' ?>
<body>
<form method="POST">
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
        
        <button class="border-black rounded-sm border px-3 py-2 hover:bg-black hover:text-white" name="submit"><input type="hidden" name="booking_log_id" value="<?php echo $dataBooking['booking_log_id']; ?>">Cancelled Booking</input></button>
        <button class="bg-red-500 text-white px-4 py-2 mt-2"><a href="history.php">Back</a></button>
    </div>
</form>
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
            if ($dataUserDetail['user_identity_status'] == 'verified') {
                $booking_log_id = $dataBooking['booking_log_id'];
                $queryBooking = $conn->query("SELECT * FROM `booking_log` WHERE booking_log_id = $booking_log_id");
                if ($queryBooking) {
                    $dataBooking = $queryBooking->fetch_assoc();
                    $BookingQuery = "UPDATE booking_log SET booking_status = 'canceled' WHERE booking_log_id = $booking_log_id";
                    if ($conn->query($BookingQuery)) {
                        echo "<script>alert('Booking cancel successfully.')</script>";
                    } else {
                        echo "Error: " . $conn->error;
                    }
                } else {
                    echo "<script>alert('Gagal mengambil data booking.')</script>";
                }
            } else {
                echo "<script>alert('KTP BELUM TERVERIFIKASI')</script>";
            }
        }
    }
?>