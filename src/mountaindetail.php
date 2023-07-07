<?php
include 'connection.php';
$mountain_id = $_GET['mountain'];
$queryRoute = $conn->query("SELECT * FROM `route` WHERE mountain_id = $mountain_id");
$dataRoute = array();
$queryMountain = $conn->query("SELECT mountain_name FROM mountain WHERE mountain_id = $mountain_id");
$dataMountain = $queryMountain->fetch_assoc();
while ($row = $queryRoute->fetch_assoc()) {
    $dataRoute[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mountrip Id</title>
    <link rel="stylesheet" href="../dist/output.css">
</head>

<body>
    <img src="../assets/img/Background/background.jpg" class="absolute w-full h-screen -z-20">
    <div class="absolute w-full h-screen -z-10 bg-black/[0.6]"></div>
    <?php include './components/navbar.php' ?>
    <main class="absolute overflow-hidden overflow-y-auto w-full bg-transparent h-[calc(100vh-125px)] mt-[125px]">
        <div class="relative flex items-center justify-center mb-8">
            <a href="./listgunung.php" class="text-white font-semibold absolute left-16 underline">Back</a>
            <h1 class="text-center text-white text-6xl font-semibold"><?php echo $dataMountain['mountain_name'] ?></h1>
        </div>
        <?php foreach ($dataRoute as $key => $route) : ?>
            <div class="max-w-screen-lg mx-auto w-full bg-white rounded-sm grid grid-cols-5 my-4 px-8 py-8 gap-6">
                <div class="col-span-3 flex flex-col justify-between">
                    <div>
                        <div class="font-semibold text-4xl mb-4"> <?php echo $route['route_name']; ?>
                        </div>
                        <div class="grid grid-cols-2 border border-black p-2">
                            <div class="col-span-1">
                                <div class="mb-3">Quota</div>
                                <div class="mb-3">Distance</div>
                                <div class="mb-3">Address</div>
                                <div class="mb-3">Status</div>
                                <div class="mb-3">Price</div>
                            </div>
                            <div class="border-black text-right overflow-hidden">
                                <div class="font-semibold mb-3"><?php echo $route['route_recent'];  ?> / <?php echo $route['route_quota'];  ?></div>
                                <div class="font-semibold first-letter:uppercase lowercase mb-3"> <?php echo $route['route_distance']; ?>
                                </div>
                                <div class="font-semibold mb-3 truncate"><?php echo $route['route_address'];  ?></div>
                                <div class="font-semibold mb-3 capitalize"><?php echo $route['route_status'];  ?></div>
                                <div class="font-semibold mb-3">Rp. <?php echo $route['route_price'];  ?></div>
                            </div>
                        </div>
                    </div>

                    <a href="routedetail.php?route=<?php echo $route['route_id'] ?>" class="rounded-full text-center border border-black hover:bg-gray-100 w-full py-2">Route Detail</a>
                </div>
                <div class="col-span-2">
                    <img src="../assets/img/routedata/<?php echo $route['route_img'] ?>" alt="" class="   object-cover">
                </div>
            </div>
        <?php endforeach; ?>

    </main>
</body>

</html>