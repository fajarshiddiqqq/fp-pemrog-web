<?php
include 'connection.php';
$queryMountain = $conn->query("SELECT * FROM mountain");
$dataMountain = array();
while ($arrData = $queryMountain->fetch_assoc()) {
    $dataMountain[] = $arrData;
}
// print_r($dataMountain);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mountrip Id</title>
    <link rel="stylesheet" href="../dist/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <img src="../assets/img/Background/background.jpg" class="absolute w-full h-screen -z-20">
    <div class="absolute w-full h-screen -z-10 bg-black/[0.6]"></div>
    <?php include './components/navbar.php' ?>
    <main class="absolute overflow-hidden overflow-y-auto w-full bg-transparent h-[calc(100vh-125px)] mt-[125px]">
        <div class="font-semibold text-5xl mb-12 text-center text-white"> Daftar Gunung </div>

        <?php foreach ($dataMountain as $key => $mountain) : ?>

            <div class="max-w-screen-lg mx-auto w-full bg-white rounded-sm grid grid-cols-5 mb-6 px-8 py-8 gap-6">

                <div class="col-span-2 flex flex-col justify-between">
                    <div>
                        <div class="font-semibold text-4xl mb-4"> <?php echo $mountain['mountain_name']; ?>
                        </div>
                        <div class="flex items-center mb-4 w-full justify-between border border-black p-2">
                            <div>
                                <div class="mb-3">Height</div>
                                <div class="">Province</div>
                            </div>
                            <div class="ml-6 border-black text-right">
                                <div class="font-semibold text-lg mb-3"><?php echo $mountain['mountain_height']; ?> mdpl</div>
                                <?php $prov_id = $mountain['mountain_province'];
                                $queryProvince = $conn->query("SELECT prov_name FROM provinces WHERE prov_id = $prov_id");
                                $dataProvince = $queryProvince->fetch_assoc(); ?>
                                <div class="font-semibold text-lg first-letter:uppercase lowercase"> <?php echo $dataProvince['prov_name']; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="mountaindetail.php?mountain=<?php echo $mountain['mountain_id'] ?>" class="rounded-full text-center border border-black hover:bg-gray-100 w-full py-2">Route Lists</a>
                </div>
                <div class="col-span-3">
                    <img src="../assets/img/routedata/<?php echo $mountain['mountain_img'] ?>" class="object-cover w-full" alt="">
                </div>
            </div>
        <?php endforeach; ?>

    </main>

</body>

</html>