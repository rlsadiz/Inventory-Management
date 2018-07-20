<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$skuId = $_POST['skuId'];

if($skuId) { 

 $sql = "UPDATE product_sku SET sku_status = 3 WHERE id_sku = $skuId";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = $connect -> error;
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST