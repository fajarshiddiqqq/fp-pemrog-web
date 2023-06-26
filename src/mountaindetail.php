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
    <title>Document</title>
    <link rel="stylesheet" href="../dist/output.css">
</head>

<body>
    <?php include './components/navbar.php'; ?>
    <table>
        <tr>
            <th>No Rute</th>
            <th>No Mountain</th>
            <th>Nama</th>
            <th>Quota</th>
            <th>Recent</th>
            <th>Address</th>
            <th>Status</th>
            <th>Price</th>
            <th>Gambar</th>
            <th>Action</th>

        </tr>
        <tr>
            <?php foreach ($dataRute as $key => $value) : ?>
                <td><?php echo $key + 1 ?><br></td>
                <td><?php echo $value['mountain_id'] ?><br> </td>
                <td><?php echo $value['route_name'] ?><br> </td>
                <td><?php echo $value['route_quota'] ?><br> </td>
                <td><?php echo $value['route_recent'] ?><br></td>
                <td><?php echo $value['route_address'] ?><br></td>
                <td><?php echo $value['route_status'] ?><br></td>
                <td><?php echo $value['route_price'] ?><br></td>
                <td><?php echo $value['route_img'] ?><br></td>
                <td><a href="routedetail.php?route=<?php echo $value['route_id'] ?>">Lihat</a></td>
            <?php endforeach; ?>
</body>

</html>