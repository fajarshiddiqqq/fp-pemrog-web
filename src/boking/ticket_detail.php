
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
        <title>Boking Page</title>
        <link rel="stylesheet" href="../../dist/output.css">
    </head>
    
    <body>
        <div class="w-full h-screen flex justify-center items-center px-4 " style="background: lightblue url('../../assets/wall1.jpg') fixed center;">
            <div class="border flex flex-col justify-center items-center py-12 px-16 rounded-lg shadow-lg w-full max-w-xl relative bg-white">
                <h3 class="text-4xl font-semibold my-2">Sign in</h3>
                <p class="mb-12">Fill the forms below.</p>
                <h6 class="text-red-500 text-sm absolute top-36 hidden" id='errormsg'>Error message!</h6>
                <form method='POST' class="w-full">
                    <div class="mb-5 flex flex-col">
                        <label for="pilih" class="mb-3 uppercase text-xs font-bold">Username / Email</label>
                        <input type="text" name="username" id="username" placeholder="example@gmail.com" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                    </div>
                    <div class="mb-3 flex flex-col">
                        <label for="password" class="mb-3 uppercase text-xs font-bold">Password</label>
                        <input type="password" name="password" id="password" placeholder="• • • • •" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                    </div>
                    <div class="mb-16">
                        <a class="font-semibold text-blue-500 text-sm cursor-pointer hover:text-blue-400">Forgot password?</a>
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="register.php" class="text-blue-500 font-semibold cursor-pointer hover:text-blue-400">
                            Create new account
                        </a>
                        <button class="bg-blue-500 text-white font-semibold w-[90px] py-2 rounded-sm hover:bg-blue-400" name="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    
    </html>
    
    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
    
        $get_user = $conn->query("SELECT * FROM users WHERE (user_name='$username' OR user_email='$username');");
        $user_data = $get_user->fetch_assoc();
    
        // echo "<pre>";
        // print_r($user_data);
        // echo "</pre>";
        // echo $password;
    
        if (empty($user_data)) {
            echo "<script>document.getElementById('errormsg').classList.remove('hidden');</script>";
            echo "<script>document.getElementById('errormsg').textContent = 'User not found';</script>";
        } else if ($user_data['user_password'] !== $password) {
            echo "<script>document.getElementById('errormsg').classList.remove('hidden');</script>";
            echo "<script>document.getElementById('errormsg').textContent = 'Wrong password';</script>";
        } else {
            $_SESSION['user'] = $user_data;
            header("Location: ../index.php");
            exit();
        }
    }
    
    ?>