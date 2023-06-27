<?php
include '../connection.php';
if (!isset($_SESSION['admin'])) {
    echo "<script>location='./login.php'</script>";
}

$getUsersQuery = $conn->query("SELECT * FROM users");
$userData = array();
while ($arrData = $getUsersQuery->fetch_assoc()) {
    $userData[] = $arrData;
}

$getUserDetailQuery = $conn->query("SELECT * FROM user_detail");
$userDetailData = array();
while ($arrData = $getUserDetailQuery->fetch_assoc()) {
    $userDetailData[] = $arrData;
}

for ($i = 0; $i < count($userData); $i++) {
    for ($j = 0; $j < count($userDetailData); $j++) {
        if ($userData[$i]['user_id'] == $userDetailData[$j]['user_id']) {
            $userData[$i] = array_merge($userData[$i], $userDetailData[$j]);
        }
    }
}

// echo '<pre>';
// print_r($userData);
// echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../dist/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        tr,
        th,
        td {
            border: 1px solid lightgray;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="max-w-screen-xl p-5 mx-auto min-h-screen flex flex-col justify-between">
        <div class="rounded-lg border relative shadow-lg p-4">
            <h3 class="text-center text-3xl font-bold uppercase mt-5 mb-12">ADMIN CONTROL PANEL</h3>
            <a href="logout.php" class="font-bold text-white bg-red-500 px-3 py-2 rounded-sm absolute right-10 top-10">Logout</a>
            <a href="inputgunung.php" class="font-bold text-white bg-gray-500 px-3 py-2 rounded-sm absolute left-10 top-10">Mountain</a>
            <table class="mt-8 w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th class="w-1/2">KTP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userData as $key => $user) : ?>
                        <?php if (($user['user_status'] == 'complete') && ($user['user_identity_status'] == 'unverified')) : ?>
                            <tr id="user-row-<?php echo $user['user_id']; ?>">
                                <td rowspan="2"><?php echo $key + 1; ?></td>
                                <td rowspan="2">
                                    <div class="mb-3 font-bold">
                                        <?php echo $user['user_full_name']; ?>
                                    </div>
                                    <a href="#" class="text-gray-500 border rounded-sm px-2 py-1 border-gray-500 font-semibold mt-2">Details</a>
                                </td>
                                <td class="flex justify-center">
                                    <img class="w-full m-2" src="../../assets/img/userdata/<?php echo $user['user_identity_card']; ?>?timestamp=<?php echo time(); ?>">
                                </td>
                            </tr>
                            <tr id="user-row1-<?php echo $user['user_id']; ?>">
                                <td class="flex flex-col">
                                    <button onclick="handleApprove(<?php echo $user['user_id'] ?>)" name="approve" class="border border-green-500 font-semibold text-green-500 px-3 py-2 rounded-sm m-2">Approve</button>
                                    <button onclick="handleReject(<?php echo $user['user_id'] ?>)" name="reject" class="border border-red-500 font-semibold text-red-500 px-3 py-2 rounded-sm m-2">Reject</button>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function handleApprove(id) {
            console.log('user ' + id + ' is approved');
            $.ajax({
                url: 'approve_user.php',
                type: 'POST',
                data: {
                    user_id: id
                },
                success: function(response) {
                    console.log(response);
                    $("#user-row-" + id).remove();
                    $("#user-row1-" + id).remove();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function handleReject(id) {
            console.log('user ' + id + ' is rejected');
            $.ajax({
                url: 'reject_user.php',
                type: 'POST',
                data: {
                    user_id: id
                },
                success: function(response) {
                    console.log(response);
                    $("#user-row-" + id).remove();
                    $("#user-row1-" + id).remove();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
</body>

</html>