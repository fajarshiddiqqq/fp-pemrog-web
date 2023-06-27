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
    <title>List Gunung</title>
    <link rel="stylesheet" href="../dist/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body style="background-image: url(../assets/img/Background/Gunungmerbabu3.jpg); background-repeat:no-repeat;background-size:100% 100vh">
    <?php include './components/navbar.php' ?>
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Ketinggian</th>
            <th>Provinsi</th>
            <th>Gambar</th>
            <th>Detail</th>
        </tr>
        <tr>
            <?php foreach ($dataMountain as $key => $mountain) : ?>
                <td>
                    <?php echo $key + 1; ?>
                </td>
                <td>
                    <?php echo $mountain['mountain_name']; ?>
                </td>
                <td>
                    <?php echo $mountain['mountain_height']; ?>
                </td>
                <td>
                    <?php echo $mountain['mountain_province']; ?>
                </td>
                <td>
                    <?php echo $mountain['mountain_img']; ?>
                </td>
                <td>
                    <a href="mountaindetail.php?mountain=<?php echo $mountain['mountain_id'] ?>">Lihat</a>
                </td>
            <?php endforeach; ?>

        </tr>
    </table>
    
</body>

</html>