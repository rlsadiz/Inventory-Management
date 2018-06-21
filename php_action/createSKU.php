<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$productCode 	= $_POST['productCode'];
	$variation		= $_POST['variation'];
	$barcode 		= $_POST['barcode'];
	$cost		 	= $_POST['cost'];
	$price 			= $_POST['price'];
	$criticalStock	= $_POST['criticalStock'];
	$sku_status		= $_POST['status'];
	$user_id = $_SESSION['userId'];
	
	$product_result = $connect->query("SELECT id_product FROM product WHERE product_code = '$productCode'");
	if($product_result->num_rows > 0) {
		$productId = $product_result->fetch_array();
		$productId = $productId[0];
	
		$variation_code = $connect->query("SELECT COUNT(id_sku) FROM product_sku WHERE fk_product = $productId");
		$variation_code = $variation_code->fetch_array();
		$variation_code = sprintf('%02d', $variation_code[0] + 1);
	
		$sku_code = $productCode."-".$variation_code;
		if(strlen($barcode) == 12) {
			$barcode = "0".$barcode;
		}

		$sql = "INSERT INTO product_sku (fk_user, fk_product, barcode, sku_code, variation, variation_code, cost, price, critical_quantity, sku_status) 
		VALUES ($user_id, $productId, $barcode, '$sku_code', '$variation', '$variation_code', $cost, $price, $criticalStock, $sku_status)";
		
		if($connect->query($sql) === TRUE) {
			$valid['success'] = true;
			$valid['messages'] = "SKU Added Successfully";	
		} else {
			$valid['success'] = false;
			$valid['messages'] = "Error: while adding the SKU";
		}
	}
	else {
		$valid['success'] = false;
		$valid['messages'] = "Error: no product found";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST