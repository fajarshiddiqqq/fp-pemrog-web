<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="../dist/output.css">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body style="background-image: url(../assets/img/Background/Gunungmerbabu3.jpg); background-repeat:no-repeat;background-size:100% 100vh;">
    <?php include './components/navbar.php' ?>

<<<<<<< HEAD
    <main class="max-w-screen-xl mx-auto px-4">
        <?php if (isset($_SESSION['user'])) : ?>
            <h2>Data tabel user: </h2>
            <?php
            echo "<pre>";
            print_r($_SESSION['user']);
            echo "</pre><br>";

            $userId = $_SESSION['user']['user_id'];
            $result = $conn->query("SELECT * FROM user_detail WHERE user_id = $userId");
            if ($result && $result->num_rows > 0) {
                $user_data = $result->fetch_assoc();
                $userdetailid = $user_data['user_detail_id'];
                echo '<h2>Data table user detail: </h2>';
                echo "<pre>";
                print_r($user_data);
                echo "</pre><br>";
                $result1 = $conn->query("SELECT * FROM booking_log WHERE user_detail_id = $userdetailid");
                if ($result1 && $result1->num_rows > 0) {
                    $user_booking_data = $result1->fetch_assoc();
                    echo '<h2>Data Booking User: </h2>';
                    echo "<pre>";
                    print_r($user_booking_data);
                    echo "</pre>";
                } else {
                    echo 'Tidak ada proses booking';
                }
            } else {
                echo 'user belum ada data detail <br>';
            }


            ?>
        <?php else : ?>
        <?php endif; ?>
        <h1 style="font-size:60px; text-align:center;">Booking Pendakian</h1>
        <p style="text-align:center">selamat datang di situs booking pendakian gunung</p>
=======
    <main class="">
        <h1 style="font-size:60px; text-align:center; ">Booking Pendakian</h1>
        <p style="text-align:center; margin-bottom: 200px">selamat datang di situs booking pendakian gunung</p>
        <a href="">testing</a>
>>>>>>> 4a46f32bc5fbb15d106e1d1c8c101799f4d983d3
    </main>

</body>

</html>