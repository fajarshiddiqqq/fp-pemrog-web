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

<body style="background-image: url(../../assets/img/mountaindata/merbabu.jpg); background-repeat: no-repeat;background-size:100% 100vh;">
    <div class="w-full flex justify-center h-screen items-center px-4">
        <div class="border flex flex-col justify-center items-center py-12 px-16 rounded-lg shadow-lg w-full max-w-xl relative bg-white">
            <h3 class="text-4xl font-semibold my-2">INPUT GUNUNG</h3>
            <a href="./index.php" class="absolute right-10 top-6 cursor-pointer">
                <img src="../../assets/x_symbol.svg" width="20" alt="">
            </a>
            <h6 class="text-red-500 text-sm absolute top-36 hidden" id='errormsg'>Error message!</h6>
            <form method='POST' enctype="multipart/form-data" class="w-full">
                <div class="mb-5 flex flex-col">
                    <label for="name" class="mb-3 uppercase text-xs font-bold">nama gunung</label>
                    <input type="text" name="name" id="name" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                </div>
                <div class="mb-5 flex flex-col">
                    <label for="height" class="mb-3 uppercase text-xs font-bold">tinggi gunung</label>
                    <input type="number" name="height" id="height" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                </div>
                <div class="mb-5 flex flex-col">
                    <label for="province" class="mb-3 uppercase text-xs font-bold">provinsi</label>
                    <?php
                    $sql_provinsi = $conn->query('SELECT * FROM provinces');
                    ?>
                    <select name="province" id="province" class=" border border-slate-500 rounded-sm px-3 py-2" required>
                        <option value="">Select province</option>
                        <?php while ($row_province = $sql_provinsi->fetch_assoc()) { ?>
                            <option value="<?php echo $row_province['prov_id']; ?>"><?php echo $row_province['prov_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-5 flex flex-col">
                    <label for="image" class="mb-3 uppercase text-xs font-bold">gambar gunung</label>
                    <input type="file" name="image" id="image" autocomplete="off" required>
                </div>
                <div class="flex justify-between items-center">
                    <a href="./inputroute.php" class="bg-gray-500 text-white font-semibold w-[90px] py-2 rounded-sm text-center hover:bg-gray-400">Route</a>
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
    $mountain_name = $_POST['name'];
    $mountain_height = $_POST['height'];
    $mountain_province = $_POST['province'];
    $image_name = $_FILES['image']['name'];
    $image_loc = $_FILES['image']['tmp_name'];
    // print_r($_POST);
    move_uploaded_file($image_loc, "../../assets/img/mountaindata/" . $image_name);
    $sqlInsert = $conn->query("INSERT INTO mountain(mountain_name, mountain_height, mountain_province, mountain_img) VALUES ('$mountain_name', '$mountain_height', '$mountain_province', '$image_name');");
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