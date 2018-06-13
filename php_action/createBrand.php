<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$brandName = $_POST['brandName'];
	$brandStatus = $_POST['brandStatus']; 
	$user_id = $_SESSION['userId'];
	
	$brand_code = strtoupper(substr($brandName, 0, 4));
	$brand_code_sql = "SELECT brand_code FROM brand WHERE brand_code = '$brand_code'";
	$brand_result = $connect->query($brand_code_sql);
	if($brand_result->num_rows > 0) {
		$brand_code = strtoupper(substr($brandName, 0, 3).substr($brandName, 4, 1));
	}
	
	$sql = "INSERT INTO brand (fk_user, brand_code, brand_name, brand_status) VALUES ($user_id, '$brand_code', '$brandName', '$brandStatus')";
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST