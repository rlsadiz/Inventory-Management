<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$supplierName 		= $_POST['supplierName'];
	$street_address		= $_POST['street_address'];
	$region_address 	= $_POST['region_address'];
	$phone		 		= $_POST['phone'];
	$email 				= $_POST['email'];
	$contact_person		= $_POST['contact_person'];
	$supplier_status	= $_POST['supplier_status'];
	$user_id 			= $_SESSION['userId'];
	
	echo email;
	$sql = "INSERT INTO product_sku (fk_user, fk_product, barcode, sku_code, variation, variation_code, cost, price, critical_quantity, sku_status) 
	VALUES ($user_id, $productId, $barcode, '$sku_code', '$variation', '$variation_code', $cost, $price, $criticalStock, $sku_status)";
	
	if($connect->query($sql) === TRUE) {
		$sku_id = $connect->query("SELECT id_sku FROM product_sku WHERE barcode = $barcode");
		$sku_id = $sku_id->fetch_array();
		$sku_id = $sku_id[0];
		
		$inv_sql = "INSERT INTO inventory (fk_user, fk_sku, type, sku_code, quantity) VALUES($user_id, $sku_id, 'Initial Stock', '$sku_code', $stock)";
		
		if($connect->query($inv_sql) === TRUE) {
			$valid['success'] = true;
			$valid['messages'] = "SKU Added Successfully";	
		}
		else {
			$valid['success'] = false;
			$valid['messages'] = $connect -> error;	
		}
	}
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST