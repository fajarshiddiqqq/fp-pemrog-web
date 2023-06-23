<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_id'])) {
        $userId = $_POST['user_id'];
        $updateQuery = "UPDATE user_detail SET user_identity_status = 'verified' WHERE user_id = $userId";

        if ($conn->query($updateQuery)) {
            echo "User approved successfully.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Invalid user_id parameter.";
    }
} else {
    echo "Invalid request method.";
}
