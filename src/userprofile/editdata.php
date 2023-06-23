<?php
include '../connection.php';
$user_id = $_SESSION['user']['user_id'];
if ($_SESSION['user']['user_status'] == 'complete') {
    $get_user = $conn->query("SELECT * FROM user_detail WHERE user_id = '$user_id';");
    if ($get_user->num_rows > 0) {
        $row = $get_user->fetch_assoc();

        $old_fullname = $row['user_full_name'];

        $old_fullPhoneNumber = $row['user_phone_number'];
        $old_prefix = substr($old_fullPhoneNumber, 0, 3);
        $old_number = substr($old_fullPhoneNumber, 3);

        $old_birthdate = $row['user_birth_date'];

        $old_province_id = $row['user_province'];
        $old_city_id = $row['user_city'];
        $old_district_id = $row['user_district'];
        $get_province = $conn->query("SELECT prov_id, prov_name FROM provinces WHERE prov_id='$old_province_id'");
        $prov_row = $get_province->fetch_assoc();
        $get_city = $conn->query("SELECT city_id, city_name FROM cities WHERE city_id='$old_city_id'");
        $city_row = $get_city->fetch_assoc();
        $get_district = $conn->query("SELECT dis_id, dis_name FROM districts WHERE dis_id='$old_district_id'");

        $district_row = $get_district->fetch_assoc();

        $old_address = $row['user_address'];
        $old_postalcode = $row['user_postal_code'];
        $old_weight = $row['user_weight'];
        $old_height = $row['user_height'];
        $old_user_photo = $row['user_photo'];
        $old_user_identity = $row['user_identity_card'];
        $old_user_identity_status = $row['user_identity_status'];
    } else {
        echo 'user detail not found!';
    }
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
                    url: '../login/city.php',
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
                    url: '../login/district.php',
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
            <a href="../index.php" class="absolute right-10 top-6 cursor-pointer">
                <img src="../../assets/x_symbol.svg" width="20" alt="">

            </a>
            <h3 class="text-4xl font-semibold my-2">Data Input</h3>
            <p class="mb-12">Fill the forms below.</p>
            <h6 class="text-red-500 text-sm absolute top-36 hidden" id='errormsg'>Error message!</h6>
            <form method='POST' enctype="multipart/form-data" class="w-full">
                <div class="mb-5 flex flex-col">
                    <label for="fullname" class="mb-3 uppercase text-xs font-bold">Full Name</label>
                    <input type="text" name="fullname" id="fullname" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" value="<?php if ($_SESSION['user']['user_status'] == 'complete') {
                                                                                                                                                        echo $row['user_full_name'];
                                                                                                                                                    } ?>" required>
                </div>
                <div class="flex md:flex-row flex-col gap-4">
                    <div class="mb-5 flex flex-col md:w-1/2 w-full">
                        <label for="phone" class="mb-3 uppercase text-xs font-bold">Phone Number</label>
                        <div class="border border-slate-500 rounded-sm flex">
                            <select name="phoneprefix" id="phoneprefix" class="border-r px-2" required>
                                <option value="+62">
                                    <?php if ($_SESSION['user']['user_status'] == 'complete') {
                                        echo $old_prefix;
                                    } else {
                                        echo '+62';
                                    } ?>
                                </option>
                                <option value="+61">+61</option>
                                <option value="+60">+60</option>
                            </select>
                            <input type="tel" name="phone" id="phone" autocomplete="off" class="w-full px-3 py-2 h-full" required value="<?php if ($_SESSION['user']['user_status'] == 'complete') {
                                                                                                                                                echo $old_number;
                                                                                                                                            } ?>">
                        </div>
                    </div>
                    <div class="mb-5 flex flex-col md:w-1/2 w-full">
                        <label for="birthdate" class="mb-3 uppercase text-xs font-bold">Birth Date</label>
                        <input type="date" name="birthdate" id="birthdate" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required value="<?php if ($_SESSION['user']['user_status'] == 'complete') {
                                                                                                                                                                        echo $row['user_birth_date'];
                                                                                                                                                                    } ?>">
                    </div>
                </div>

                <div class="flex gap-4 md:flex-row flex-col">
                    <div class="mb-5 flex flex-col md:w-1/3 w-full">
                        <label for="province" class="mb-3 uppercase text-xs font-bold">Province</label>
                        <?php
                        $sql_provinsi = $conn->query('SELECT * FROM provinces');
                        ?>
                        <select name="province" id="province" class=" border border-slate-500 rounded-sm px-3 py-2">
                            <option value="">
                                <?php if ($_SESSION['user']['user_status'] == 'complete') {
                                    echo $prov_row['prov_name'];
                                } else {
                                    echo 'Select Province';
                                } ?>
                            </option>
                            <?php while ($row_province = $sql_provinsi->fetch_assoc()) { ?>
                                <option value="<?php echo $row_province['prov_id']; ?>"><?php echo $row_province['prov_name']; ?></option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="mb-5 flex flex-col md:w-1/3 w-full">
                        <label for="city" class="mb-3 uppercase text-xs font-bold">City</label>
                        <select name="city" id="city" class="border border-slate-500 rounded-sm px-3 py-2">
                            <option value="">
                                <?php if ($_SESSION['user']['user_status'] == 'complete') {
                                    echo $city_row['city_name'];
                                } else {
                                    echo 'Select City';
                                } ?>
                            </option>
                        </select>
                    </div>
                    <div class="mb-5 flex flex-col md:w-1/3 w-full">
                        <label for="district" class="mb-3 uppercase text-xs font-bold">District</label>
                        <select name="district" id="district" class="border border-slate-500 rounded-sm px-3 py-2">
                            <option value="">
                                <?php if ($_SESSION['user']['user_status'] == 'complete') {
                                    echo $district_row['dis_name'];
                                } else {
                                    echo 'Select District';
                                } ?>
                            </option>
                        </select>
                    </div>

                </div>

                <div class="grid grid-cols-none md:grid-cols-4 gap-4">
                    <div class="mb-5 flex flex-col col-span-4 md:col-span-3">
                        <label for="address" class="mb-3 uppercase text-xs font-bold">Address</label>
                        <textarea name="address" id="address" class="border border-slate-500 rounded-sm px-3 py-2" required><?php if ($_SESSION['user']['user_status'] == 'complete') {
                                                                                                                                echo $row['user_address'];
                                                                                                                            } ?></textarea>
                    </div>
                    <div class="mb-5 flex flex-col col-span-4 md:col-span-1 w-auto">
                        <label for="postalcode" class="mb-3 uppercase text-xs font-bold">Postal Code</label>
                        <input type="number" name="postalcode" id="postalcode" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required value="<?php if ($_SESSION['user']['user_status'] == 'complete') {
                                                                                                                                                                            echo $row['user_postal_code'];
                                                                                                                                                                        } ?>">
                    </div>
                </div>

                <div class="flex gap-4 md:flex-row flex-col">
                    <div class="mb-5 flex flex-col md:w-1/2 w-full">
                        <label for="weight" class="mb-3 uppercase text-xs font-bold">Weight (kg)</label>
                        <input type="number" name="weight" id="weight" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required value="<?php if ($_SESSION['user']['user_status'] == 'complete') {
                                                                                                                                                                    echo $row['user_weight'];
                                                                                                                                                                } ?>">
                    </div>
                    <div class="mb-5 flex flex-col md:w-1/2 w-full">
                        <label for="height" class="mb-3 uppercase text-xs font-bold">Height (cm)</label>
                        <input type="number" name="height" id="height" autocomplete="off" class="border border-slate-500 rounded-sm px-3 py-2" required value="<?php if ($_SESSION['user']['user_status'] == 'complete') {
                                                                                                                                                                    echo $row['user_height'];
                                                                                                                                                                } ?>">
                    </div>

                </div>

                <div class="flex gap-4 mb-12 md:flex-row flex-col">
                    <div class="mb-5 flex flex-col md:w-1/2 w-full">
                        <label for="photo" class="mb-5 uppercase text-xs font-bold">User Photo</label>
                        <div class="flex flex-col items-center">
                            <?php if ($_SESSION['user']['user_status'] == 'complete') : ?>
                                <img src="../../assets/img/userdata/<?php echo $row['user_photo']; ?>?timestamp=<?php echo time(); ?>" class="h-28 mb-5 cursor-pointer scale-125" id='prev' alt="user_profile" onclick="handleClickPhoto()">
                            <?php else : ?>
                                <img src="" class="max-h-28 mb-5 cursor-pointer" id='prev' onclick="handleClickPhoto()">
                            <?php endif; ?>
                            <input type="file" name="photo" id="photo" accept='image/*' style="display:none;" />
                            <label for="photo" class="border border-black px-4 py-2 text-sm hover:bg-slate-200 italic cursor-pointer">
                                Click to select
                            </label>
                        </div>
                    </div>
                    <div class="mb-5 flex flex-col md:w-1/2 w-full relative">
                        <label for="identitycard" class="mb-5 uppercase text-xs font-bold">Identity Card Photo</label>

                        <?php if ($_SESSION['user']['user_status'] == 'complete') : ?>
                            <?php if ($row['user_identity_status'] == 'verified') : ?>
                                <span class="text-green-500 font-bold absolute -top-[2px] text-sm right-[50%] translate-x-[70%] italic">(verified)</span>
                            <?php elseif ($row['user_identity_status'] == 'unverified') : ?>
                                <span class="text-red-500 font-bold absolute -top-[2px] text-sm right-[50%] translate-x-[70%] italic">(unverified)</span>
                            <?php else : ?>
                                <span class="text-red-500 font-bold absolute -top-[2px] text-sm right-[50%] translate-x-[70%] italic">(rejected)</span>
                            <?php endif; ?>
                        <?php endif; ?>

                        <div class="flex flex-col items-center">
                            <?php if ($_SESSION['user']['user_status'] == 'complete') : ?>
                                <img src="../../assets/img/userdata/<?php echo $row['user_identity_card']; ?>?timestamp=<?php echo time(); ?>" class="h-28 mb-5 cursor-pointer" id='prev1' alt="identity_card" onclick="handleClickIdentity()">
                            <?php else : ?>
                                <img src="" class="max-h-28 mb-5 cursor-pointer" id='prev1' onclick="handleClickIdentity()">
                            <?php endif; ?>
                            <input type="file" name="identitycard" id="identitycard" accept='image/*' style="display:none;" />
                            <label for="identitycard" class="border border-black px-4 py-2 text-sm hover:bg-slate-200 italic cursor-pointer">
                                Click to select
                            </label>
                        </div>
                    </div>
                </div>

                <div class=" flex justify-between items-center">
                    <a href='./' class="text-blue-500 font-semibold cursor-pointer hover:text-blue-400">
                        Back
                    </a>
                    <button class="bg-blue-500 text-white font-semibold w-[90px] py-2 rounded-sm hover:bg-blue-400" name="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const photoInput = document.getElementById('photo');
            const identityCardInput = document.getElementById('identitycard');
            const photoPreview = document.getElementById('prev');
            const identityCardPreview = document.getElementById('prev1');



            photoInput.addEventListener('change', (event) => {
                const [file] = event.target.files;
                if (file) {
                    photoPreview.src = URL.createObjectURL(file);
                }
            });

            identityCardInput.addEventListener('change', (event) => {
                const [file] = event.target.files;
                if (file) {
                    identityCardPreview.src = URL.createObjectURL(file);
                }
            });
        });

        const handleClickIdentity = () => {
            console.log('clicked');
            $('#identitycard')[0].click();
        }

        const handleClickPhoto = () => {
            console.log('clicked');
            $('#photo')[0].click();
        }
    </script>
</body>

</html>
<?php
if (isset($_POST['submit'])) {

    if ($_SESSION['user']['user_status'] == 'incomplete') {
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
        if (!empty($_FILES['photo']['name'])) {
            $photo_name = "user_" . $_SESSION['user']['user_id'] . "_photo" . '.' . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $photo_loc = $_FILES['photo']['tmp_name'];
            move_uploaded_file($photo_loc, "../../assets/img/userdata/" . $photo_name);
        } else {
            $photo_name = '';
        }
        if (!empty($_FILES['identitycard']['name'])) {
            $identitycard_name = "user_" . $_SESSION['user']['user_id'] . "_identity" . '.' . pathinfo($_FILES['identitycard']['name'], PATHINFO_EXTENSION);
            $identitycard_loc = $_FILES['identitycard']['tmp_name'];
            move_uploaded_file($identitycard_loc, "../../assets/img/userdata/" . $identitycard_name);
        } else {
            $identitycard_name = '';
        }
        $identity_status = 'unverified';


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
    } else {
        $new_fullname = $_POST['fullname'];
        $new_phoneprefix = $_POST['phoneprefix'];
        $new_phone = $_POST['phone'];
        if (substr($new_phone, 0, 1) === '0') {
            $new_phone = substr($new_phone, 1);
        }
        $new_fullPhoneNumber = $new_phoneprefix . $new_phone;
        $new_birthdate = $_POST['birthdate'];

        if ($_POST['province'] == '') {
            $new_province = $prov_row['prov_id'];
        } else {
            $new_province = $_POST['province'];
        }

        if ($_POST['city'] == '') {
            $new_city = $city_row['city_id'];
        } else {
            $new_city = $_POST['city'];
        }


        if ($_POST['district'] == '') {
            $new_district = $district_row['dis_id'];
        } else {
            $new_district = $_POST['district'];
        }

        $new_address = $_POST['address'];
        $new_postalcode = $_POST['postalcode'];
        $new_weight = $_POST['weight'];
        $new_height = $_POST['height'];

        if (!empty($_FILES['photo']['name'])) {
            $new_photo_name = "user_" . $_SESSION['user']['user_id'] . "_photo" . '.' . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $new_photo_loc = $_FILES['photo']['tmp_name'];
            move_uploaded_file($new_photo_loc, "../../assets/img/userdata/" . $new_photo_name);
        } else {
            $new_photo_name = $row['user_photo'];
        }

        if (!empty($_FILES['identitycard']['name'])) {
            $new_identitycard_name = "user_" . $_SESSION['user']['user_id'] . "_identity" . '.' . pathinfo($_FILES['identitycard']['name'], PATHINFO_EXTENSION);
            $new_identitycard_loc = $_FILES['identitycard']['tmp_name'];
            move_uploaded_file($new_identitycard_loc, "../../assets/img/userdata/" . $new_identitycard_loc);
        } else {
            $new_identitycard_name = $row['user_identity_card'];
        }

        $new_identity_status = 'unverified';

        $conn->query("UPDATE user_detail SET
            user_full_name = '$new_fullname',
            user_phone_number = '$new_fullPhoneNumber',
            user_birth_date = '$new_birthdate',
            user_province = '$new_province',
            user_city = '$new_city',
            user_district = '$new_district',
            user_address = '$new_address',
            user_postal_code = '$new_postalcode',
            user_weight = '$new_weight',
            user_height = '$new_height',
            user_photo = '$new_photo_name',
            user_identity_card = '$new_identitycard_name',
            user_identity_status = '$new_identity_status'
        WHERE user_id = '$user_id';
");

        echo "<script>window.location='../index.php'</script>";
    }
}
?>