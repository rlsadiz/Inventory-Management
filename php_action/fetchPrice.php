<?php 	
require_once 'core.php';

$sql = "SELECT * FROM price_list";

$result = $connect->query($sql);
$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
	$skuId = $row['id_sku'];
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editPriceModalBtn" data-target="#editProductModal" onclick="editPrice('.$skuId.')"> <i class="glyphicon glyphicon-edit"></i> Edit Price</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removePromotionModal" id="removeProductModalBtn" onclick="removePromotion('.$skuId.')"> <i class="glyphicon glyphicon-trash"></i> Remove Promotion</a></li>       
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
		$row['sku_code'],
 		$row['product_name'],
 		$row['cost'],		
 		$row['price'],
		$row['promotion_price'],
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