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
        global $con;

        $currentDateTime = date('Y-m-d H:i:s');

        // Pernyataan SQL untuk menyimpan token ke tabel
        $sql = "INSERT INTO booking_log (booking_log_id, route_id, user_detail_id, booking_date, booking_status, booking_sum, booking_total_price, booking_token) VALUES ('','','','','$currentDateTime','','','', '$token')";

        // Menjalankan pernyataan SQL untuk menyimpan token
        if ($con->query($sql) === false) {
            die("Error saat menyimpan token ke database: " . $con->error);
        }
    }
    function expireddate ($token)
    {
        
    }
    // Menghasilkan token baru
    $token = generateToken();

    // Menyimpan token ke database
    saveTokenToDatabase($token);

?>