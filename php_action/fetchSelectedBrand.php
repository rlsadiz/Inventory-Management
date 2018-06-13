<?php 	

require_once 'core.php';

$brandId = $_POST['brandId'];

$sql = "SELECT id_brand, brand_name, brand_status FROM brand";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);