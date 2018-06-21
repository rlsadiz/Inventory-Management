<?php 	

require_once 'core.php';

$barcode = $_POST['barcode'];
$sql = "SELECT barcode, product_name, IFNULL(promotion_price, price) price
		FROM price_list
		WHERE barcode = '$barcode'";
$result = $connect->query($sql);


$row = "";

if($result->num_rows > 0) { 
	$row = $result->fetch_array();
 
} // if num_rows

$connect->close();

echo json_encode($row);