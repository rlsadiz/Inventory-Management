<?php 	

require_once 'core.php';

$sql = "SELECT *
		FROM category
		WHERE category_status != 3 AND level > 0
		ORDER BY tree_id ASC";
		
$result = $connect->query($sql);
$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 

 while($row = $result->fetch_array()) {
 	$categoriesId = $row['id_category'];
 	// active 
 	if($row['category_status'] == 1) {
 		// activate member
 		$activeCategories = "<label class='label label-success'>Active</label>";
 	} else {
 		// deactivate member
 		$activeCategories = "<label class='label label-danger'>Inactive</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn" data-target="#editCategoriesModal" onclick="editCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" id="removeCategoriesModalBtn" data-target="#removeCategoriesModal"  onclick="removeCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array(
		$row['tree_id'],
		$row['category_code'],
 		$row['category_name'],
		$row['level'], 		
 		$activeCategories,
		$row['updated_at'],
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);