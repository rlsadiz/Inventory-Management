<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$categoriesName = $_POST['editCategoriesName'];
	$categoriesStatus = $_POST['editCategoriesStatus']; 
	$categoriesParent = $_POST['categoriesParent'];
	$categoriesId = $_POST['editCategoriesId'];
	$userId = $_SESSION['userId'];
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
	
	$sql = "UPDATE category 
			SET fk_user = '$userId', tree_id = '$tree_id', fk_parent_category = '$categoriesParent', 
				category_name = '$categoriesName', level = '$level', category_status = '$categoriesStatus'
			WHERE id_category = '$categoriesId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the categories";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST