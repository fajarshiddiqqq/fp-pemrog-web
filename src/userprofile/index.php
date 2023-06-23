<?php
include '../connection.php';



$userId = $_SESSION['user']['user_id'];
$getUserQuery = $conn->query("SELECT * FROM user_detail WHERE user_id = $userId");
$getUser = $getUserQuery->fetch_assoc();

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
        <form class="border shadow-sm rounded-sm px-12 py-3 w-full max-w-xl relative bg-white" method="post">
            <a href="../index.php" class="absolute right-10 top-6 cursor-pointer">
                <img src="../../assets/x_symbol.svg" width="20" alt="">
            </a>
            <h3 class="text-center text-4xl font-semibold my-5">User profile</h3>
            <div class="w-full flex items-center justify-center mb-5 relative">
                <div class="w-28 h-28 flex items-center overflow-hidden rounded-full object-cover group">
                    <?php
                    if ($getUser) {
                    ?>
                        <img src="../../assets/img/userdata/<?php echo $getUser['user_photo']; ?>?timestamp=<?php echo time(); ?>" alt="user_profile">
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
                <input type="text" name="username" id="username" placeholder="" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required value="<?php echo $_SESSION['user']['user_name'] ?>">
            </div>
            <div class="mb-5 flex flex-col">
                <label for="email" class="mb-3 uppercase text-xs font-bold">Email</label>
                <input type="email" name="email" id="email" placeholder="" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required value="<?php echo $_SESSION['user']['user_email'] ?>">
            </div>
            <div class="mb-12 flex flex-col">
                <label for="password" class="mb-3 uppercase text-xs font-bold">Password</label>
                <input onclick="hidePlaceholder()" onblur="showPlaceholder()" type="password" name="password" id="password" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2 placeholder:text-black" placeholder="<?php for ($x = 0; $x < $_SESSION['user']['user_password_count']; $x++) {
                                                                                                                                                                                                                                            echo "•";
                                                                                                                                                                                                                                        } ?>" value="">
            </div>
            <div class="w-full flex justify-between mb-5">
                <a href="editdata.php" class="border rounded-sm text-white hover:text-gray-500 bg-gray-500 hover:bg-white border-gray-500 font-semibold px-4 py-2">More Data</a>
                <button name="submit" class="border rounded-sm px-6 py-2 font-semibold hover:text-blue-500 border-blue-500 bg-blue-500 text-white hover:bg-white  ">Save</button>
            </div>
        </form>
    </div>
    <script>
        function hidePlaceholder() {
            var input = document.getElementById('password');
            input.placeholder = '';
        }

        function showPlaceholder() {
            var input = document.getElementById('password');
            input.placeholder = '<?php for ($x = 0; $x < $_SESSION['user']['user_password_count']; $x++) {
                                        echo "•";
                                    } ?>';
        }
    </script>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user']['user_id'];
    $new_name = $_POST['username'];
    $new_email = $_POST['email'];
    if ($_POST['password'] == '') {
        $new_password = $_SESSION['user']['user_password'];
    } else {
        $new_password = sha1($_POST['password']);
        $pass_count = strlen($_POST['password']);
    }
    if ($_SESSION['user']['user_name'] != $new_name) {
        $conn->query("UPDATE users SET user_name='$new_name' WHERE user_id='$user_id';");
        $_SESSION['user']['user_name'] = $new_name;
    }
    if ($_SESSION['user']['user_email'] != $new_email) {
        $conn->query("UPDATE users SET user_email='$new_email' WHERE user_id='$user_id';");
        $_SESSION['user']['user_email'] = $new_email;
    }
    if ($_SESSION['user']['user_password'] != $new_password) {
        $conn->query("UPDATE users SET user_password='$new_password', user_password_count='$pass_count' WHERE user_id='$user_id';");
        $_SESSION['user']['user_password'] = $new_password;
        $_SESSION['user']['user_password_count'] = $pass_count;
    }

    // echo "<pre>";
    // print_r($_SESSION['user']);
    // echo "</pre>";
    echo "<script>window.location='../index.php'</script>";
}
?>