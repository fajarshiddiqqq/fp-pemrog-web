<?php
include '../connection.php';
if (isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mountrip Id</title>
    <link rel="stylesheet" href="../../dist/output.css">
</head>

<body>
    <img src="../../assets/img/Background/background.jpg" class="absolute w-full h-screen -z-20">
    <div class="absolute w-full h-screen -z-10 bg-black/[0.6]"></div>
    <main class="absolute overflow-hidden overflow-y-auto w-full bg-transparent h-screen">

        <div class="w-full h-screen flex justify-center items-center px-4 ">
            <div class="border flex flex-col justify-center items-center py-12 px-16 rounded-lg shadow-lg w-full max-w-xl relative bg-white">
                <h3 class="text-4xl font-semibold my-2">Sign Up</h3>
                <p class="mb-12">Fill the forms below.</p>
                <a href="../index.php" class="absolute right-10 top-6 cursor-pointer">
                    <img src="../../assets/x_symbol.svg" width="20" alt="">
                </a>
                <h6 class="text-red-500 text-sm absolute top-36 hidden" id='errormsg'>Error message!</h6>
                <form method='POST' class="w-full">
                    <div class="mb-5 flex flex-col">
                        <label for="username" class="mb-3 uppercase text-xs font-bold">Username</label>
                        <input type="text" name="username" id="username" placeholder="your username" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                    </div>
                    <div class="mb-5 flex flex-col">
                        <label for="email" class="mb-3 uppercase text-xs font-bold">Email</label>
                        <input type="email" name="email" id="email" placeholder="example@gmail.com" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                    </div>
                    <div class="mb-3 flex flex-col">
                        <label for="password" class="mb-3 uppercase text-xs font-bold">Password</label>
                        <input type="password" name="password" id="password" placeholder="• • • • •" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                    </div>
                    <div class="mb-12 flex flex-col">
                        <label for="pass_confirm" class="mb-3 uppercase text-xs font-bold">Password Confirmation</label>
                        <input type="password" name="pass_confirm" id="pass_confirm" placeholder="• • • • •" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                    </div>
                    <div class=" flex justify-between items-center">
                        <a href='../login' class="text-blue-500 font-semibold cursor-pointer hover:text-blue-400">
                            Already have account
                        </a>
                        <button class="bg-blue-500 text-white font-semibold w-[90px] py-2 rounded-sm hover:bg-blue-400" name="signup">
                            Sign Up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>

<?php
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $pass_confirm = sha1($_POST['pass_confirm']);
    $pass_count = strlen($_POST['password']);
    $status = 'incomplete';


    if ($password !== $pass_confirm) {
        echo "<script>document.getElementById('errormsg').classList.remove('hidden');</script>";
        echo "<script>document.getElementById('errormsg').textContent = 'Password did not match!';</script>";
        exit();
    } else {
        $queryInsert = $conn->query("INSERT INTO users (user_name, user_email, user_password, user_password_count, user_status) VALUES ('$username', '$email', '$password', '$pass_count', '$status')");

        if ($queryInsert) {
            $get_user = $conn->query("SELECT * FROM users WHERE user_name='$username';");
            $user_data = $get_user->fetch_assoc();
            $_SESSION['user'] = $user_data;
            echo "<script>alert('Signup successful!');</script>";
            echo "<script>window.location.href = 'userdata.php';</script>";
            exit();
        } else {
            echo "<script>document.getElementById('errormsg').classList.remove('hidden');</script>";
            echo "<script>document.getElementById('errormsg').textContent = 'Something error...';</script>";
        }
    }
}
?>