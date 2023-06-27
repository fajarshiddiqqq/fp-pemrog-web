<?php
include 'connection.php';
$mountain_id = $_GET['mountain'];
$queryRute = $conn->query("SELECT * FROM `route`");
$dataRute = array();
while ($row = $queryRute->fetch_assoc()) {
    $dataRute[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Montain Detail</title>
    <link rel="stylesheet" href="../dist/output.css">
</head>

<body>
    <?php include './components/navbar.php'; ?>
    <table>
        <tr>
            <th>No Rute</th>
            <th>Nama</th>
            <th>Quota</th>
            <th>Recent</th>
            <th>Distance</th>
            <th>Address</th>
            <th>Status</th>
            <th>Price</th>
            <th>Gambar</th>
            <th>Action</th>

        </tr>
        <?php foreach ($dataRute as $key => $value) : ?>
            <tr>
                <td><?php echo $key + 1 ?></td>
                <td><?php echo $value['route_name'] ?> </td>
                <td><?php echo $value['route_quota'] ?> </td>
                <td><?php echo $value['route_recent'] ?></td>
                <td><?php echo $value['route_distance'] ?> km</td>
                <td><?php echo $value['route_address'] ?></td>
                <td><?php echo $value['route_status'] ?></td>
                <td><?php echo $value['route_price'] ?></td>
                <td><?php echo $value['route_img'] ?></td>
                <td><a href="routedetail.php?route=<?php echo $value['route_id'] ?>">Lihat</a></td>
            </tr>
        <?php endforeach; ?>
</body>

</html>