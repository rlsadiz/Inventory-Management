<?php 	

require_once 'core.php';

$sql = "SELECT *
		FROM brand 
		WHERE brand_status != 3";
		
$result = $connect->query($sql);
$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeBrands = ""; 

 while($row = $result->fetch_array()) {
 	$brandId = $row['id_brand'];
	
 	// active 
 	if($row['brand_status'] == 1) {
 		// activate member
 		$activeBrands = "<label class='label label-success'>Active</label>";
 	} else {
 		// deactivate member
 		$activeBrands = "<label class='label label-danger'>Inactive</label>";
 	}
	
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands('.$brandId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 	
		$row['brand_code'],
 		$row['brand_name'], 		
 		$activeBrands,
		$row['updated_at'],
 		$button
 		); 	
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);