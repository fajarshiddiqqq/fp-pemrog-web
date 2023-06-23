<?php
include '../connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../../dist/output.css">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>

<body>
    <div class="w-full h-screen flex justify-center items-center px-4 ">
        <div class="border flex flex-col justify-center items-center py-12 px-16 rounded-lg shadow-lg w-full max-w-xl relative bg-white">
            <h3 class="text-4xl font-semibold my-2">Admin Login</h3>
            <p class="mb-12">Fill all the credentials.</p>
            <h6 class="text-red-500 text-sm absolute top-36 hidden" id='errormsg'>Error message!</h6>
            <form method='POST' class="w-full">
                <div class="mb-5 flex flex-col">
                    <label for="username" class="mb-3 uppercase text-xs font-bold">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                </div>
                <div class="mb-16 flex flex-col">
                    <label for="password" class="mb-3 uppercase text-xs font-bold">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                </div>
                <div class="text-right">
                    <button class="border-black border bg-black text-white font-semibold py-2 rounded-sm hover:bg-white hover:text-black w-52 transition duration-100" name="login">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['login'])) {
    $admin_name = $_POST['username'];
    $admin_password = sha1($_POST['password']);

    $getAdminQuery = $conn->query("SELECT * FROM admins WHERE admin_name='$admin_name';");
    $adminData = $getAdminQuery->fetch_assoc();


    if (empty($adminData)) {
        echo "<script>document.getElementById('errormsg').classList.remove('hidden');</script>";
        echo "<script>document.getElementById('errormsg').textContent = 'Admin data is not found!';</script>";
    } else if ($adminData['admin_password'] !== $admin_password) {
        echo "<script>document.getElementById('errormsg').classList.remove('hidden');</script>";
        echo "<script>document.getElementById('errormsg').textContent = 'Wrong password!';</script>";
    } else {
        // echo "<script>alert('sampai sini');</script>";
        $_SESSION['admin'] = $adminData;
        // print_r($_SESSION);
        echo "<script>location='./index.php'</script>";
    }
}

?>