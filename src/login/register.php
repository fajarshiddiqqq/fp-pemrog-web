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
    <title>Register Page</title>
    <link rel="stylesheet" href="../../dist/output.css">
</head>

<body>
    <div class="w-full h-screen flex justify-center items-center px-4 " style="background: lightblue url('../../assets/wall1.jpg') fixed center;">
        <div class="border flex flex-col justify-center items-center py-12 px-16 rounded-lg shadow-lg w-full max-w-xl relative bg-white">
            <h3 class="text-4xl font-semibold my-2">Sign Up</h3>
            <p class="mb-12">Fill the forms below.</p>
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

        $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password, user_password_count, user_status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $username, $email, $password, $pass_count, $status);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
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

        $stmt->close();
    }
}
?>