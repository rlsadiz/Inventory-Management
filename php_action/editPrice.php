<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
	
$sku_id = $_POST['editSkuId'];
$price = $_POST['editPricePrice'];
$userId = $_SESSION['userId'];

$sql = "UPDATE product_sku 
		SET fk_user = $userId, price = $price
		WHERE id_sku = $sku_id";

if($connect->query($sql) === TRUE) {
	$valid['success'] = true;
	$valid['messages'] = "Successfully Updated";	
} else {
	$valid['success'] = false;
	$valid['messages'] = $connect->error;
}
 
$connect->close();
echo json_encode($valid);