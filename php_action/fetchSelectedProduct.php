<?php 	

require_once 'core.php';

$productId = $_POST['productId'];

$sql = "SELECT id_product, fk_category, fk_brand, product_code, product_name, product_image, product_status FROM product WHERE id_product = $productId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);