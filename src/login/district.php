<?php
include '../connection.php';

$city_id = $_POST['city_id'];

$sql_district = $conn->query("SELECT * FROM districts WHERE city_id = $city_id");

echo '<option>Select District</option>';
while ($row_district = $sql_district->fetch_assoc()) {
    echo '<option value="' . $row_district['dis_id'] . '">' . $row_district['dis_name'] . '</option>';
}
