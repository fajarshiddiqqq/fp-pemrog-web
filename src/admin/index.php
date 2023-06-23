<?php
include '../connection.php';
if (!isset($_SESSION['admin'])) {
    echo "<script>location='./login.php'</script>";
} else {
    print_r($_SESSION['admin']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- bisa verif ktp -->
    <!-- bisa finish -->
</body>

</html>