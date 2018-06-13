<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$categoriesName = $_POST['categoriesName'];
	$categoriesStatus = $_POST['categoriesStatus']; 
	$categoriesParent = $_POST['categoriesParent'];
	$user_id = $_SESSION['userId'];
	$level = "";
	$tree_id = "";
	
	$level_sql = "SELECT tree_id, level FROM category WHERE id_category = '$categoriesParent'";
	$level_result = $connect->query($level_sql);
	if($level_result->num_rows > 0) {
		$level_row = $level_result->fetch_array();
		$level = $level_row[1] + 1;
	}
	else {
		$level = 1;
	}
	
	$tree_sql = "SELECT MAX(tree_id) FROM category WHERE fk_parent_category = '$categoriesParent'";
	$tree_result = $connect->query($tree_sql);
	$tree_row = $tree_result->fetch_array();
	if($tree_row[0] > 0) {
		$tree_id = (($tree_row[0] / pow(10, 2 * (5 - $level))) + 1) * pow(10, 2 * (5 - $level));
	}
	else {
		if($level_row[0] == 0) {
			$tree_id = 100000000;
		}
		else {
			$tree_id = (($level_row[0] / pow(10, 2 * (5 - $level))) + 1) * pow(10, 2 * (5 - $level));
		}
	}
	
	$categories_code = str_replace(' ', '-', $categoriesName);
	$categories_code = strtoupper(substr($categories_code, 0, 4));
	$categories_code_sql = "SELECT category_code FROM category WHERE category_code = '$categories_code'";
	$categories_result = $connect->query($categories_code_sql);
	if($categories_result->num_rows > 0) {
		$categories_code = strtoupper(substr($categoriesName, 0, 3).substr($categoriesName, 4, 1));
	}

	$sql = "INSERT INTO category (fk_user, 	fk_parent_category, tree_id, category_code, category_name, level, category_status) 
	VALUES ('$user_id', '$categoriesParent', '$tree_id', '$categories_code', '$categoriesName', '$level', '$categoriesStatus')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
		echo $connect->error;
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST