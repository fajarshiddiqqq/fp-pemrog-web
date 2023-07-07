<?php
include 'connection.php';
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
    <?php include './components/navbar.php' ?>
    <main class="text-white max-w-screen-xl mx-auto px-4 h-screen w-full flex flex-col font-semibold items-center justify-center">
        <h1 style="font-size:60px; text-align:center;">Booking Pendakian</h1>
        <p style="text-align:center" class="font-normal mb-5">Selamat datang di situs booking pendakian gunung</p>
        <a href="./listgunung.php" class="rounded-full font-semibold w-32 py-3 border border-white bg-white/[0.1] hover:bg-white/[0.3] text-center">List Gunung</a>
    </main>

</body>

</html>