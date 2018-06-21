<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$productName 	= $_POST['productName'];
	$brandId		= $_POST['brandName'];
	$categoryId 	= $_POST['categoryName'];
	$productStatus 	= $_POST['productStatus'];
	$vatable		= $_POST['vatable'];
	$user_id = $_SESSION['userId'];
	
	$brand_code = $connect->query("SELECT brand_code FROM brand WHERE id_brand = $brandId");
	$brand_code = $brand_code->fetch_array();
	$brand_code = $brand_code[0];
	
	$product_code = $connect->query("SELECT COUNT(id_product) FROM product WHERE fk_brand = $brandId");
	$product_code = $product_code->fetch_array();
	$product_code = sprintf('%03d', $product_code[0] + 1);
	
	$product_code = $brand_code."-".$product_code;
	
	$type = explode('.', $_FILES['productImage']['name']);
	$type = $type[count($type)-1];		
	$url = '../assests/images/products/'.$product_code.'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {
				
				$sql = "INSERT INTO product (fk_user, fk_category, fk_brand, product_code, product_name, product_image, product_status, is_vatable) 
				VALUES ($user_id, $categoryId, $brandId, '$product_code', '$productName', '$url', $productStatus, $vatable)";
				
				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
					echo $connect->error;
				}

			}	else {
				return false;
			}	// /else	
		} // if
	} // if in_array 		

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST