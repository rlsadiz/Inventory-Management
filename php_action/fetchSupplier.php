<?php 	
require_once 'core.php';

$sql = "SELECT 
			sup.id_supplier,
			sup.supplier_code,
			sup.supplier_name,
			sup.supplier_phone,
			sup.supplier_email,
			sup.contact_person,
			sup.supplier_status
		FROM supplier sup
		WHERE supplier_status != 3";

$result = $connect->query($sql);
$output = array('data' => array());

if($result->num_rows > 0) { 
	 // $row = $result->fetch_array();
	 $active = ""; 
	 while($row = $result->fetch_array()) {
		$supId = $row['id_supplier'];
		// active 
		if($row['supplier_status'] == 1) {
			// activate member
			$active = "<label class='label label-success'>Active</label>";
		} else {
			// deactivate member
			$active = "<label class='label label-danger'>Inactive</label>";
		} // /else

		$button = '<!-- Single button -->
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Action <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu">
			<li><a type="button" data-toggle="modal" id="editSupplierBtn" data-target="#editSupplierModal" onclick="editSupplier('.$supId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
			<li><a type="button" data-toggle="modal" id="removeSupplierBtn" data-target="#removeSupplierModal"  onclick="removeSupplier('.$supId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
		  </ul>
		</div>';

		// $brandId = $row[3];
		// $brandSql = "SELECT * FROM brands WHERE brand_id = $brandId";
		// $brandData = $connect->query($sql);
		// $brand = "";
		// while($row = $brandData->fetch_assoc()) {
		// 	$brand = $row['brand_name'];
		// }

		$output['data'][] = array( 		
			$row['supplier_code'],
			$row['supplier_name'],
			$row['supplier_phone'],
			$row['supplier_email'],		
			$row['contact_person'],
			$active,
			$button
			); 	
	 } // /while 
}// if num_rows
else {
	echo $connect->error;
}

$connect->close();
echo json_encode($output);