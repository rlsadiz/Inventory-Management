<?php 	

require_once 'core.php';

$productId = $_POST['productId'];

$sql = "SELECT 
			p.id_product, 
			p.fk_category, 
			b.brand_name,
			p.product_code, 
			p.product_name, 
			p.product_image, 
			p.product_status,
			p.is_vatable
		FROM product p
		JOIN brand b ON b.id_brand = p.fk_brand
		WHERE id_product = $productId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);