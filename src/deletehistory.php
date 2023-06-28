<?php
include "connection.php";
$booking_log_id = $_GET['delete'];
$deleteQuery = $conn->query("DELETE FROM `booking_log` WHERE booking_log_id = $booking_log_id");
if ($deleteQuery) {
    echo "<script>alert('Berhasil dihapus')</script>";
    echo "<script>location='./history.php'</script>";
} else {
    echo "<script>alert('Belum berhasil dihapus')</script>";
}
