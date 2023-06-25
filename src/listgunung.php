<?php
    include 'connection.php';
    $querry_mountain = $conn->query("SELECT * FROM mountain WHERE mountain_id = 1");
    
    $data_mountain = $querry_mountain->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Gunung</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
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
            <td><?php echo $data_mountain['mountain_id'] ?><br></td>
            <td><?php echo $data_mountain['mountain_name']?><br> </td>
            <td><?php echo $data_mountain['mountain_height']?><br> </td>
            <td><?php echo $data_mountain['mountain_province']?><br> </td>
            <td><?php echo $data_mountain['mountain_img']?><br></td>
            <td><a href="mountaindetail.php?=<?php echo $data_mountain['mountain_id']?>">Lihat</a></td>
        </tr>
    </table>
</body>
</html>