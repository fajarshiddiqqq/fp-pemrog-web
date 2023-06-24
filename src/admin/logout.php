<?php
include '../connection.php';
unset($_SESSION['admin']);
echo "<script>location='./login.php'</script>";
