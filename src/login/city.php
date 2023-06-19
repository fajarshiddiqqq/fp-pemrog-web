<?php
include '../connection.php';

$prov_id = $_POST['prov_id'];

$sql_city = $conn->query("SELECT * FROM cities WHERE prov_id = $prov_id");

echo '<option>Select City</option>';
while ($row_city = $sql_city->fetch_assoc()) {
    echo '<option value="' . $row_city['city_id'] . '">' . $row_city['city_name'] . '</option>';
}
