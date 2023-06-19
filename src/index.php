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
</head>

<body>
    <?php include './components/navbar.php' ?>

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
                echo '<h2>Data table user detail: </h2>';
                echo "<pre>";
                print_r($user_data);
                echo "</pre>";
            } else {
                echo 'user belum ada data detail';
            }
            ?>
        <?php else : ?>
            <h3>Belum ada user login</h3>
        <?php endif; ?>
    </main>
</body>

</html>