<?php
include '../connection.php';
unset($_SESSION['user']);


header("Location: ../index.php");


exit();
