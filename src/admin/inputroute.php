<?php
include '../connection.php';
if (!isset($_SESSION['admin'])) {
    echo "<script>location='./login.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Gunung</title>
    <link rel="stylesheet" href="../../dist/output.css">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="w-full flex justify-center items-center px-4">
        <div class="border flex flex-col justify-center items-center py-12 px-16 rounded-lg shadow-lg w-full max-w-xl relative bg-white">
            <h3 class="text-4xl font-semibold my-2">INPUT RUTE</h3>
            <a href="./index.php" class="absolute right-10 top-6 cursor-pointer">
                <img src="../../assets/x_symbol.svg" width="20" alt="">
            </a>
            <h6 class="text-red-500 text-sm absolute top-36 hidden" id='errormsg'>Error message!</h6>
            <form method='POST' enctype="multipart/form-data" class="w-full">
                <div class="mb-5 flex flex-col">
                    <label for="mountain" class="mb-3 uppercase text-xs font-bold">gunung</label>
                    <?php
                    $sqlMountain = $conn->query('SELECT * FROM mountain');
                    ?>
                    <select name="mountain" id="mountain" class=" border border-slate-500 rounded-sm px-3 py-2" required>
                        <option value="">Select mountain</option>
                        <?php while ($dataMountain = $sqlMountain->fetch_assoc()) { ?>
                            <option value="<?php echo $dataMountain['mountain_id']; ?>"><?php echo $dataMountain['mountain_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-5 flex flex-col">
                    <label for="name" class="mb-3 uppercase text-xs font-bold">nama rute</label>
                    <input type="text" name="name" id="name" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                </div>
                <div class="mb-5 flex flex-col">
                    <label for="quota" class="mb-3 uppercase text-xs font-bold">kuota rute</label>
                    <input type="number" name="quota" id="quota" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                </div>
                <div class="mb-5 flex flex-col">
                    <label for="distance" class="mb-3 uppercase text-xs font-bold">jarak rute</label>
                    <input type="number" name="distance" id="distance" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                </div>
                <div class="mb-5 flex flex-col">
                    <label for="address" class="mb-3 uppercase text-xs font-bold">alamat rute</label>
                    <textarea name="address" id="address" class="border border-slate-500 rounded-sm px-3 py-2" required></textarea>
                </div>
                <div class="mb-5 flex flex-col">
                    <label for="status" class="mb-3 uppercase text-xs font-bold">status rute</label>
                    <select name="status" id="status" class="border border-slate-500 rounded-sm px-3 py-2" required>
                        <option value="">Status Rute</option>
                        <option value="open">Open</option>
                        <option value="close">Close</option>
                    </select>
                </div>
                <div class="mb-5 flex flex-col">
                    <label for="price" class="mb-3 uppercase text-xs font-bold">harga rute</label>
                    <input type="number" name="price" id="price" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                </div>
                <div class="mb-5 flex flex-col">
                    <label for="image" class="mb-3 uppercase text-xs font-bold">gambar rute</label>
                    <input type="file" name="image" id="image" autocomplete="off" required>
                </div>
                <div class="flex justify-between items-center">
                    <a href="./inputgunung.php" class="bg-gray-500 text-white font-semibold w-[90px] py-2 rounded-sm text-center hover:bg-gray-400">Back</a>
                    <button class="bg-blue-500 text-white font-semibold w-[90px] py-2 rounded-sm hover:bg-blue-400" name="save">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php

if (isset($_POST['save'])) {
    $mountain_id = $_POST['mountain'];
    $route_name = $_POST['name'];
    $route_quota = $_POST['quota'];
    $route_recent = $_POST['quota'];
    $route_distance = $_POST['distance'];
    $route_address = $_POST['address'];
    $route_status = $_POST['status'];
    $route_price = $_POST['price'];
    $image_name = $_FILES['image']['name'];
    $image_loc = $_FILES['image']['tmp_name'];
    move_uploaded_file($image_loc, "../../assets/img/routedata/" . $image_name);
    $sqlInsert = $conn->query("INSERT INTO `route`(mountain_id, route_name, route_quota, route_recent, route_distance, route_address, route_status, route_price, route_img) VALUES ('$mountain_id', '$route_name', '$route_quota', '$route_recent', '$route_distance', '$route_address', '$route_status', '$route_price', '$image_name');");

    if ($sqlInsert) {
        echo "<script>alert('Data successfully stored!');</script>";
        echo "<script>window.location.href = './index.php';</script>";
        exit();
    } else {
        echo "<script>document.getElementById('errormsg').classList.remove('hidden');</script>";
        echo "<script>document.getElementById('errormsg').textContent = 'Something error...';</script>";
    }
}
?>