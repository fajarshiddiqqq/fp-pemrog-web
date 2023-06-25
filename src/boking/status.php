<?php
    include "../connection.php";
    enum status {
        case pending ;
        case complete ;
        case cancelled;
    }
    $status1 = status::pending;
    $status2 = status::complete;
    $status3 = status::cancelled;
?>