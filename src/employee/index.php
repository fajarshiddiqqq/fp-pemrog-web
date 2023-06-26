<?php
include '../connection.php';
if (!isset($_SESSION['employee'])) {
    echo "<script>location='./login.php'</script>";
}

// $getUsersQuery = $conn->query("SELECT * FROM users");
// $userData = array();
// while ($arrData = $getUsersQuery->fetch_assoc()) {
//     $userData[] = $arrData;
// }

// $getUserDetailQuery = $conn->query("SELECT * FROM user_detail");
// $userDetailData = array();
// while ($arrData = $getUserDetailQuery->fetch_assoc()) {
//     $userDetailData[] = $arrData;
// }

// for ($i = 0; $i < count($userData); $i++) {
//     for ($j = 0; $j < count($userDetailData); $j++) {
//         if ($userData[$i]['user_id'] == $userDetailData[$j]['user_id']) {
//             $userData[$i] = array_merge($userData[$i], $userDetailData[$j]);
//         }
//     }
// }

// echo '<pre>';
// print_r($userData);
// echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="../../dist/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="max-w-screen-xl p-5 mx-auto min-h-screen flex flex-col justify-between">
        <div class="rounded-lg border relative shadow-lg p-4">
            <h3 class="text-center text-3xl font-bold uppercase mt-5 mb-12">EMPLOYEE CONTROL PANEL</h3>
            <a href="logout.php" class="font-bold text-white bg-red-500 px-3 py-2 rounded-sm absolute right-10 top-10">Logout</a>
            <h6 class="text-red-500 text-sm absolute right-[50%] translate-x-[50%] top-36 hidden" id='errormsg'>Error message!</h6>
            <form method="post">
                <div class="flex flex-col justify-end max-w-xl mx-auto border shadow-lg border-black p-8 pb-5 mb-5">
                    <div class="flex flex-col mb-5">
                        <label for="token" class="mb-3">Input Token</label>
                        <input class="border border-black px-3 py-2 shadow-sm rounded-md" type="text" name="token">
                    </div>
                    <div class="text-right">
                        <button class="border border-black px-3 py-2 rounded-md shadow-sm bg-black text-white hover:bg-gray-800" name="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $booking_token = $_POST['token'];
    $queryBookingLog = $conn->query("SELECT * FROM booking_log WHERE booking_token='$booking_token'");
    $bookingData = $queryBookingLog->fetch_assoc();

    $route_id = $bookingData['route_id'];

    $queryRoute = $conn->query("SELECT * FROM `route` WHERE route_id = '$route_id'");
    $routeData = $queryRoute->fetch_assoc();

    $route_recent = $routeData['route_recent'] - 1;

    if (empty($bookingData)) {
        echo "<script>document.getElementById('errormsg').classList.remove('hidden');</script>";
        echo "<script>document.getElementById('errormsg').textContent = 'Token salah!';</script>";
    } else {
        $conn->query("UPDATE booking_log SET booking_status='complete' WHERE booking_token='$booking_token'");
        $conn->query("UPDATE `route` SET route_recent='$route_recent' WHERE route_id='$route_id'");
        echo "<script>alert('Pendakian terkonfirmasi')</script>";
    }
}
?>