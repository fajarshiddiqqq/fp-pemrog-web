<?php
include '../connection.php';
echo "<pre>";
print_r($_SESSION['user']);
echo "</pre>";
$userId = $_SESSION['user']['user_id'];
$getUserQuery = $conn->query("SELECT * FROM user_detail WHERE user_id = $userId");
$getUser = $getUser->fetch_assoc();
echo "<pre>";
print_r($getUser);
echo "</pre>";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Page</title>
    <link rel="stylesheet" href="../../dist/output.css">
</head>

<body>
    <div class="w-full flex items-center justify-center h-screen">
        <form class="border shadow-sm rounded-sm px-12 py-3 w-full max-w-xl">
            <h3 class="text-center text-4xl font-semibold my-5">User profile</h3>
            <div class="w-full flex items-center justify-center mb-5">
                <div class="w-28 bg-black h-28 flex items-center overflow-hidden rounded-full object-cover cursor-pointer">
                    <?php
                    if ($getUser && $getUser->num_rows > 0) {
                        $userPhoto = $user_data['user_photo'];
                    ?>
                        <img src="../../assets/img/userdata/<?php echo $userPhoto; ?>" alt="user_profile">
                        <!-- IF DATA NOT COMPLETE -->
                    <?php
                    } else {
                    ?>
                        <img src="../../assets/default-profile.png" alt="user_profile">
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="mb-5 flex flex-col">
                <label for="username" class="mb-3 uppercase text-xs font-bold">Username</label>
                <input type="text" name="username" id="username" placeholder="" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
            </div>
            <div class="mb-5 flex flex-col">
                <label for="username" class="mb-3 uppercase text-xs font-bold">Email</label>
                <input type="text" name="username" id="username" placeholder="" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
            </div>
            <div class="mb-12 flex flex-col">
                <label for="password" class="mb-3 uppercase text-xs font-bold">Password</label>
                <input type="password" name="password" id="password" placeholder="" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
            </div>
            <div class="w-full flex justify-between mb-5">
                <button class="border rounded-sm text-white hover:text-gray-500 bg-gray-500 hover:bg-white border-gray-500 font-semibold px-4 py-2">More Data</button>
                <button class="border rounded-sm px-6 py-2 font-semibold hover:text-blue-500 border-blue-500 bg-blue-500 text-white hover:bg-white  ">Save</button>
            </div>
    </div>
    </form>
    </div>
</body>

</html>