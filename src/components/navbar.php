<nav class="flex justify-between items-center px-4 py-5 max-w-screen-xl h-[125px] mx-auto border-b mb-12 relative">
    <div>
        <h3 class="text-3xl font-black">Booking Pendakian</h3>
    </div>
    <div>
        <a href="./listgunung.php" class="underline">List gunung</a>
        <a href="./history.php" class="underline">History</a>
    </div>
    <div class="flex items-center">
        <?php if (!isset($_SESSION['user'])) : ?>
            <a href="../src/login" class="bg-blue-500 text-white font-semibold w-[90px] py-2 rounded-sm hover:bg-blue-400 text-center block">Sign In</a>
        <?php else : ?>
            <div class="flex items-center gap-4">
                <div id='UserProfile' class="w-20 h-20 flex items-center overflow-hidden rounded-full object-cover cursor-pointer" onclick="handleProfileComponents()">
                    <?php
                    $userId = $_SESSION['user']['user_id'];
                    $result = $conn->query("SELECT user_photo FROM user_detail WHERE user_id = $userId");
                    if ($result && $result->num_rows > 0) {
                        $user_data = $result->fetch_assoc();
                        $userPhoto = $user_data['user_photo'];
                    ?>
                        <img src="../assets/img/userdata/<?php echo $userPhoto; ?>?timestamp=<?php echo time(); ?>" alt="user_profile">
                    <?php
                    } else {
                    ?>
                        <img src="../assets/default-profile.png" alt="user_profile">
                    <?php
                    }
                    ?>
                </div>

            </div>
            <ul id="UserProfileComponent" class="hidden absolute top-[120px] bg-white flex-col items-center border rounded-sm shadow-sm right-0">
                <a href="userprofile" class="border-b px-4 py-3 w-full text-center hover:bg-slate-50">
                    <li>Manage Account</li>
                </a>
                <a href="#" class="border-b px-4 py-3 w-full text-center hover:bg-slate-50">
                    <li>History</li>
                </a>
                <a href="login/logout.php?return_url=<?php echo urlencode($_SERVER['PHP_SELF']); ?>" class="font-bold text-red-500 px-4 py-3 w-full text-center hover:text-white hover:bg-red-500">
                    <li>Logout</li>
                </a>
            </ul>
        <?php endif; ?>

    </div>
</nav>
<script>
    function handleProfileComponents() {
        var userProfile = document.getElementById('UserProfileComponent');
        userProfile.classList.toggle('hidden');
        userProfile.classList.toggle('flex');
    }
</script>