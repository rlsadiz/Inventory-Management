<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$brandName = $_POST['editBrandName'];
	$brandStatus = $_POST['editBrandStatus'];	
	$brandId = $_POST['brandId'];
	$userId = $_SESSION['userId'];

	$sql = "UPDATE brand SET fk_user = '$userId', brand_name = '$brandName', brand_status = '$brandStatus' WHERE id_brand = '$brandId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = $connect -> error;
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST