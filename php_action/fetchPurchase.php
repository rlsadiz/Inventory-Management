<?php 	
require_once 'core.php';

$sql = "SELECT p.id_purchase, p.purchase_code, s.supplier_name, p.cost_amount, p.paid_amount, p.purchase_status, p.updated_at
		FROM purchase p
		JOIN supplier s ON s.id_supplier = p.fk_supplier
		ORDER BY updated_at";

$result = $connect->query($sql);
$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $status = ""; 

 while($row = $result->fetch_array()) {
 	$purchaseId = $row['id_purchase'];
 	// active 
 	if($row['purchase_status'] == 1) {
 		// activate member
 		$status = "<label class='label label-warning'>Purchased</label>";
 	} else if($row['purchase_status'] == 2) {
 		// deactivate member
 		$status = "<label class='label label-warning'>Delivered</label>";
	} else {
		$status = "<label class='label label-success'>Inbounded</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editPurchaseModalBtn" data-target="#editProductModal" onclick="editPurchase('.$purchaseId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removePurchaseModal" id="removeProductModalBtn" onclick="removePurchcase('.$purchaseId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
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
		$row['purchase_code'],
 		$row['supplier_name'],
 		$row['cost_amount'],		
 		$row['paid_amount'],
		$status,
		$row['updated_at'],
 		$button 		
 		); 	
 } // /while 

}// if num_rows
else {
	echo $connect->error;
}

$connect->close();
echo json_encode($output);