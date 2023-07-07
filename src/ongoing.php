<?php
include './connection.php';
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Login Terlebih Dahulu!')</script>";
    echo "<script>location='./login'</script>";
}

$userId = $_SESSION['user']['user_id'];

$queryUserDetail = $conn->query("SELECT * FROM `user_detail` WHERE user_id = '$userId'");
$dataUserDetail = $queryUserDetail->fetch_assoc();

$userDetailId = $dataUserDetail['user_detail_id'];
$queryBooking = $conn->query("SELECT * FROM `booking_log` WHERE user_detail_id = $userDetailId");
$dataBooking = $queryBooking->fetch_assoc();

if ($queryBooking->num_rows > 0) {
    $routeId = $dataBooking['route_id'];
    $queryRute = $conn->query("SELECT mountain_id, route_name, route_price FROM `route` WHERE route_id = '$routeId'");
    $dataRute = $queryRute->fetch_assoc();
    $routeName = $dataRute['route_name'];
    $mountainId = $dataRute['mountain_id'];
    $queryMountain = $conn->query("SELECT mountain_name FROM `mountain` WHERE mountain_id = '$mountainId'");
    $dataMountain = $queryMountain->fetch_assoc();
    $mountainName = $dataMountain['mountain_name'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mountrip Id</title>
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

<body>
    <img src="../assets/img/Background/background.jpg" class="absolute w-full h-screen -z-20">
    <div class="absolute w-full h-screen -z-10 bg-black/[0.6]"></div>
    <?php include './components/navbar.php' ?>
    <form method="POST">
        <div class="ticket-container">
            <?php if ($queryBooking->num_rows > 0) : ?>
                <?php if ($dataBooking['booking_status'] == 'pending') : ?>
                    <div class="ticket-info">
                        <h2 class="Bold">Ongoing Tiket Pemesanan</h2>
                        <p>No Tiket: <?php echo $dataBooking['booking_log_id']; ?></p>
                        <p>Destinasi: <?php echo "$routeName, $mountainName"; ?></p>
                        <p>Nama Pemesan: <?php echo $dataUserDetail['user_full_name']; ?></p>
                        <p>Tanggal Pemesanan: <?php echo $dataBooking['booking_date']; ?></p>
                        <p>Tanggal kadaluwarsa: <?php echo $dataBooking['booking_expired']; ?></p>
                        <p>Harga Tiket: Rp. <?php echo $dataRute['route_price']; ?></p>
                        <p>Status: <?php echo $dataBooking['booking_status']; ?></p>
                        <p>Token Tiket: <?php echo $dataBooking['booking_token']; ?></p>
                    </div>

                    <button class="w-full rounded-sm border px-3 py-2 bg-red-500 text-white font-semibold" name="cancel">
                        Cancel Booking
                    </button>
                <?php endif; ?>
            <?php else : ?>
                <h2 class="text-center">TIdak ada booking yang sedang berlangsung</h2>
            <?php endif; ?>
        </div>
    </form>

</body>

</html>
<?php
if (isset($_POST['cancel'])) {
    $queryUpdate = $conn->query("UPDATE `booking_log` SET booking_status = 'canceled' WHERE user_detail_id = $userDetailId");
    if ($queryUpdate) {
        echo "<script>location='./history.php'</script>";
    } else {
        echo "<script>alert('Gagal mengambil data booking.')</script>";
    }
}
?>