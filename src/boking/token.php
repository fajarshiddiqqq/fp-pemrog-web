<?php
    include '../connection.php';
    function generateToken($length = 10)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $token = '';
        $max = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[rand(0, $max)];
        }

        return $token;
    }

    function saveTokenToDatabase($token)
    {
        global $conn;

        $currentDateTime = date('Y-m-d H:i:s');

        // Pernyataan SQL untuk menyimpan token ke tabel
        $sql = "INSERT INTO booking_log (booking) VALUES ('$currentDateTime', '$token')";

        // Menjalankan pernyataan SQL untuk menyimpan token
        if ($conn->query($sql) === false) {
            die("Error saat menyimpan token ke database: " . $conn->error);
        }
    }
    function expireddate ($token,$currentDateTime ,$expirationTime)
    {
        global $conn;

        $booking_date = date('Y-m-d H:i:s');
    
        // SQL statement to save token and expiration time to the database
        $sql = "INSERT INTO booking_log (booking_date, booking_expired, booking_token) VALUES ('$currentDateTime', '$expirationTime', '$token')";
    
        // Run the SQL statement to save the token
        if ($conn->query($sql) === false) {
            die("Error while saving token to the database: " . $conn->error);
        }
    }
    // Menghasilkan token baru
    $token = generateToken();

    // Menyimpan token ke database
    saveTokenToDatabase($token);

?>