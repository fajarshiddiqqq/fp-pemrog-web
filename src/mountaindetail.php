
<?php
    include 'connection.php';
    $mountain_id = $_GET['mountain'];
    echo $mountain_id;
    $queryRute = $conn->query("SELECT * FROM `route`");
    $dataRute = $queryRute->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
            <td><?php echo $dataRute['route_id'] ?><br></td>
            <td><?php echo $dataRute['mountain_id']?><br> </td>
            <td><?php echo $dataRute['route_name']?><br> </td>
            <td><?php echo $dataRute['route_quota']?><br> </td>
            <td><?php echo $dataRute['route_recent']?><br></td>
            <td><?php echo $dataRute['route_address']?><br></td>
            <td><?php echo $dataRute['route_status']?><br></td>
            <td><?php echo $dataRute['route_price']?><br></td>
            <td><?php echo $dataRute['route_img']?><br></td>
            <td><a href="routedetail.php?route=<?php echo $dataRute['route_id']?>">Lihat</a></td>
</body>
</html>