<?php 	
require_once 'core.php';

$sql = "SELECT 
			sku.id_sku,
			sku.barcode, 
			sku.sku_code, 
			CONCAT(p.product_name, ' ', sku.variation) sku_name,
			sku.cost,
			sku.price,
			sku.sku_status
		FROM product_sku sku
		JOIN product p ON p.id_product = sku.fk_product
		WHERE sku_status != 3";

$result = $connect->query($sql);
$output = array('data' => array());

if($result->num_rows > 0) { 
	 // $row = $result->fetch_array();
	 $active = ""; 
	 while($row = $result->fetch_array()) {
		$skuId = $row['id_sku'];
		// active 
		if($row['sku_status'] == 1) {
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
			<li><a type="button" data-toggle="modal" id="editSKUModalBtn" data-target="#editSKUModal" onclick="editSKU('.$skuId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
			<li><a type="button" data-toggle="modal" id="removeSKUtModalBtn" data-target="#removeSKUModal"  onclick="removeSKU('.$skuId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
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
			$row['barcode'],
			$row['sku_code'],
			$row['sku_name'],
			$row['cost'],		
			$row['price'],
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