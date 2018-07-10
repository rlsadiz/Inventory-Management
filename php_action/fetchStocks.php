<?php 	
require_once 'core.php';

$sql = "SELECT * FROM stock";

$result = $connect->query($sql);
$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
 	//
	$status = "";	
 	if($row[2] > $row[5]) {
 		// activate member
 		$status = "<label class='label label-success'>Healthy</label>";
 	} else if($row[2] > 0) {
 		// deactivate member
 		$status = "<label class='label label-warning'>Critical</label>";
 	} // /else
	else {
		$status = "<label class='label label-danger'>Out of Stock</label>";
	}
	// $brandId = $row[3];
	// $brandSql = "SELECT * FROM brands WHERE brand_id = $brandId";
	// $brandData = $connect->query($sql);
	// $brand = "";
	// while($row = $brandData->fetch_assoc()) {
	// 	$brand = $row['brand_name'];
	// }
	
 	$output['data'][] = array( 		
 		$row[0],
		$row[1],
 		$row[2],
 		$row[3],		
 		$row[4],
		$row[5],
 		$status	
 		); 	
 } // /while 

}// if num_rows
else {
	echo $connect->error;
}

$connect->close();

echo json_encode($output);