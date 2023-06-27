<?php
include '../connection.php';
// echo "<pre>";
// print_r($_SESSION['user']);
// echo "</pre>";
if (isset($_SESSION['user']['user_status']) != 'incomplete') {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Input</title>
    <link rel="stylesheet" href="../../dist/output.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#province').change(function() {
                let prov_id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'city.php',
                    data: 'prov_id=' + prov_id,
                    success: function(res) {
                        $('#city').html(res);
                    }
                })
            })
            $('#city').change(function() {
                let city_id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'district.php',
                    data: 'city_id=' + city_id,
                    success: function(res) {
                        $('#district').html(res);
                    }
                })
            })
        })
    </script>
</head>

<body>
    <div class="w-full flex justify-center items-center px-4">
        <div class="border flex flex-col justify-center items-center mt-[2rem] max-w-[50rem] py-12 px-16 rounded-lg shadow-lg relative mb-12 bg-white">
            <h3 class="text-4xl font-semibold my-2">Data Input</h3>
            <p class="mb-12">Fill the forms below.</p>
            <h6 class="text-red-500 text-sm absolute top-36 hidden" id='errormsg'>Error message!</h6>
            <form method='POST' enctype="multipart/form-data" class="w-full">
                <div class="mb-5 flex flex-col">
                    <label for="fullname" class="mb-3 uppercase text-xs font-bold">Full Name</label>
                    <input type="text" name="fullname" id="fullname" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                </div>
                <div class="flex md:flex-row flex-col gap-4">
                    <div class="mb-5 flex flex-col md:w-1/2 w-full">
                        <label for="phone" class="mb-3 uppercase text-xs font-bold">Phone Number</label>
                        <div class="border border-slate-500 rounded-sm flex">
                            <select name="phoneprefix" id="phoneprefix" class="border-r px-2" required>
                                <option value="+62">+62</option>
                                <option value="+61">+61</option>
                                <option value="+60">+60</option>
                            </select>
                            <input type="tel" name="phone" id="phone" autocomplete="off" class="w-full px-3 py-2 h-full" required>
                        </div>
                    </div>
                    <div class="mb-5 flex flex-col md:w-1/2 w-full">
                        <label for="birthdate" class="mb-3 uppercase text-xs font-bold">Birth Date</label>
                        <input type="date" name="birthdate" id="birthdate" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                    </div>
                </div>

                <div class="flex gap-4 md:flex-row flex-col">
                    <div class="mb-5 flex flex-col md:w-1/3 w-full">
                        <label for="province" class="mb-3 uppercase text-xs font-bold">Province</label>
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
                    <div class="mb-5 flex flex-col md:w-1/3 w-full">
                        <label for="city" class="mb-3 uppercase text-xs font-bold">City</label>
                        <select name="city" id="city" class="border border-slate-500 rounded-sm px-3 py-2" required>
                            <option value="">List of city</option>`
                        </select>
                    </div>
                    <div class="mb-5 flex flex-col md:w-1/3 w-full">
                        <label for="district" class="mb-3 uppercase text-xs font-bold">District</label>
                        <select name="district" id="district" class="border border-slate-500 rounded-sm px-3 py-2" required>
                            <option value="">List of district</option>
                        </select>
                    </div>

                </div>

                <div class="grid grid-cols-none md:grid-cols-4 gap-4">
                    <div class="mb-5 flex flex-col col-span-4 md:col-span-3">
                        <label for="address" class="mb-3 uppercase text-xs font-bold">Address</label>
                        <textarea name="address" id="address" class="border border-slate-500 rounded-sm px-3 py-2" required></textarea>
                    </div>
                    <div class="mb-5 flex flex-col col-span-4 md:col-span-1 w-auto">
                        <label for="postalcode" class="mb-3 uppercase text-xs font-bold">Postal Code</label>
                        <input type="number" name="postalcode" id="postalcode" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                    </div>
                </div>

                <div class="flex gap-4 md:flex-row flex-col">
                    <div class="mb-5 flex flex-col md:w-1/2 w-full">
                        <label for="weight" class="mb-3 uppercase text-xs font-bold">Weight (kg)</label>
                        <input type="number" name="weight" id="weight" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                    </div>
                    <div class="mb-5 flex flex-col md:w-1/2 w-full">
                        <label for="height" class="mb-3 uppercase text-xs font-bold">Height (cm)</label>
                        <input type="number" name="height" id="height" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required>
                    </div>

                </div>

                <div class="flex gap-4 mb-12 md:flex-row flex-col">
                    <div class="mb-5 flex flex-col md:w-1/2 w-full">
                        <label for="photo" class="mb-3 uppercase text-xs font-bold">User Photo</label>
                        <input type="file" name="photo" id="photo" required>
                    </div>
                    <div class="mb-5 flex flex-col md:w-1/2 w-full">
                        <label for="identitycard" class="mb-3 uppercase text-xs font-bold">Identity Card Photo</label>
                        <input type="file" name="identitycard" id="identitycard" required />
                    </div>
                </div>

                <div class=" flex justify-between items-center">
                    <a href='../' class="text-blue-500 font-semibold cursor-pointer hover:text-blue-400">
                        Fill form later
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
    $user_id = $_SESSION['user']['user_id'];
    $fullname = $_POST['fullname'];
    $phoneprefix = $_POST['phoneprefix'];
    $phone = $_POST['phone'];
    if (substr($phone, 0, 1) === '0') {
        $phone = substr($phone, 1);
    }
    $fullPhoneNumber = $phoneprefix . $phone;
    $birthdate = $_POST['birthdate'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $address = $_POST['address'];
    $postalcode = $_POST['postalcode'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $photo_name = "user_" . $_SESSION['user']['user_id'] . "_photo" . '.' . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    $photo_loc = $_FILES['photo']['tmp_name'];
    $identitycard_name = "user_" . $_SESSION['user']['user_id'] . "_identity" . '.' . pathinfo($_FILES['identitycard']['name'], PATHINFO_EXTENSION);
    $identitycard_loc = $_FILES['identitycard']['tmp_name'];
    $identity_status = 'unverified';

    move_uploaded_file($photo_loc, "../../assets/img/userdata/" . $photo_name);
    move_uploaded_file($identitycard_loc, "../../assets/img/userdata/" . $identitycard_name);

    $sqlInsert = "INSERT INTO user_detail (user_id, user_full_name, user_phone_number, user_birth_date, user_province, user_city, user_district, user_postal_code, user_address, user_weight, user_height, user_photo, user_identity_card, user_identity_status) VALUES ('$user_id', '$fullname', '$fullPhoneNumber', '$birthdate', '$province', '$city', '$district', '$postalcode', '$address', '$weight', '$height', '$photo_name', '$identitycard_name', '$identity_status')";

    $sqlUpdate = "UPDATE users SET user_status = 'complete' WHERE user_id = '$user_id'";
    $_SESSION['user']['user_status'] = 'complete';

    $resultInsert = $conn->query($sqlInsert);
    $resultUpdate = $conn->query($sqlUpdate);

    if ($resultInsert && $resultUpdate) {
        echo "<script>alert('Data successfully stored!');</script>";
        echo "<script>window.location.href = '../index.php';</script>";
        exit();
    } else {
        echo "<script>document.getElementById('errormsg').classList.remove('hidden');</script>";
        echo "<script>document.getElementById('errormsg').textContent = 'Something error...';</script>";
    }
}
?>