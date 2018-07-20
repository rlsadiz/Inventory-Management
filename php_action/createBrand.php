<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$brandName = $_POST['brandName'];
	$brandStatus = $_POST['brandStatus']; 
	$user_id = $_SESSION['userId'];
	
	$brand_code = "";
	$brand_code = preg_replace('/[^A-Za-z0-9]/', '', $brandName);
	
	if(strlen($brand_code) < 5) {
		$brand_code = strtoupper(str_pad($brand_code, 5, "0"));
	}
	else {
		$brand_word = preg_replace('/[^A-Za-z0-9\ ]/', '', $brandName);
		$brand_word = explode(" ", $brand_word);
		if(count($brand_word) == 1) {
			$brand_no_vowel = strtoupper(substr($brand_word[0], 1, strlen($brand_word[0])- 2));
			$brand_no_vowel = preg_replace('/[AEIOU]/', '', $brand_no_vowel);
			if(strlen($brand_no_vowel) > 3) {
				$brand_code = strtoupper(substr($brand_word[0], 0, 1)).
					strtoupper(substr($brand_no_vowel, 0, 3)).strtoupper(substr($brand_word[0], strlen($brand_word[0]) - 1, 1));
			}
			else {
				$brand_code = strtoupper(substr($brand_word[0], 0, 4)).strtoupper(substr($brand_word[0], strlen($brand_word[0]) - 1, 1));
			}
		}
	}
	
	$sql = "INSERT INTO brand (fk_user, brand_code, brand_name, brand_status) VALUES ($user_id, '$brand_code', '$brandName', '$brandStatus')";
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = $connect -> error;
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST