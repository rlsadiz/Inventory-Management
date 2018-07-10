<?php 	

require_once 'core.php';

$skuId = $_POST['skuId'];

$sql = "SELECT sku.id_sku, sku.sku_code, p.product_name, sku.variation, sku.cost, sku.price, sku.critical_quantity, sku.sku_status
		FROM product_sku sku
		JOIN product p ON p.id_product = sku.fk_product
		WHERE id_sku = $skuId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);