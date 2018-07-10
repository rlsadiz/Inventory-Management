<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$product_id		= $_POST['productId'];
	$user_id		= $_SESSION['userId'];
	
	$sql = "SELECT product_status FROM product WHERE id_product = $product_id";
	$result = $connect->query($sql);
	if($result->num_rows > 0) {
		$row = $result->fetch_array();
		$status = $row['product_status'];
		
		if($status == 1) {
			$sql = "UPDATE product SET product_status = 2 WHERE id_product = $product_id";
		} else {
			$sql = "UPDATE product SET product_status = 1 WHERE id_product = $product_id";
		}
				
		if($connect->query($sql) === TRUE) {
			$valid['success'] = true;
			$valid['messages'] = "Successfully Added";	
		} else {
			$valid['success'] = false;
			$valid['messages'] = $connect -> error;
		}

	}	else {
		$valid['success'] = false;
		$valid['messages'] = $connect -> error;
	}	// /else			
	$connect->close();
	echo json_encode($valid);
 
} // /if $_POST