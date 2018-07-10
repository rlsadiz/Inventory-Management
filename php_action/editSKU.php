<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$skuId 			= $_POST['sku_id'];
	$variationName 	= $_POST['editVariationName']; 	
	$cost		 	= $_POST['editCost'];
	$price		 	= $_POST['editPrice'];
	$critical_stock	= $_POST['editCriticalStock'];
	$sku_status		= $_POST['editStatus'];
	
	$sql = "UPDATE product_sku SET variation = '$variationName', cost = $cost, price = $price, critical_quantity = $critical_stock, sku_status = $sku_status WHERE id_sku = $skuId";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating sku info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
