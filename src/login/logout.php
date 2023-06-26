<?php
include '../connection.php';
unset($_SESSION['user']);

if (isset($_GET['return_url'])) {
    $return_url = $_GET['return_url'];
    header("Location: " . $return_url);
} else {
    header("Location: ../index.php");
}

exit();
