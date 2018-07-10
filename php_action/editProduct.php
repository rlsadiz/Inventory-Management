<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$productId 		= $_POST['product_id'];
	$productName 	= $_POST['editProductName']; 	
	$categoryName 	= $_POST['editCategoryName'];
	$productStatus 	= $_POST['editProductStatus'];
	$is_vatable		= $_POST['editProductVatable'];
	
	$sql = "UPDATE product SET product_name = '$productName', fk_category = '$categoryName', product_status = '$productStatus', is_vatable = $is_vatable WHERE id_product = $productId";

	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
