<?php 	
require_once 'core.php';

$sql = "SELECT p.id_product, p.product_image, p.product_code, p.product_name, b.brand_name, c.category_name, p.product_status, COUNT(ps.id_sku) sku
		FROM product p
		LEFT JOIN brand b ON b.id_brand = p.fk_brand
		LEFT JOIN category c ON c.id_category = p.fk_category
		LEFT JOIN product_sku ps ON p.id_product = ps.fk_product
		WHERE product_status != 3
		GROUP BY 1";

$result = $connect->query($sql);
$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
 	$productId = $row['id_product'];
 	// active 
 	if($row['product_status'] == 1) {
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
	    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$productId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

	// $brandId = $row[3];
	// $brandSql = "SELECT * FROM brands WHERE brand_id = $brandId";
	// $brandData = $connect->query($sql);
	// $brand = "";
	// while($row = $brandData->fetch_assoc()) {
	// 	$brand = $row['brand_name'];
	// }

	$imageUrl = substr($row['product_image'], 3);
	$productImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:30px;'  />";

 	$output['data'][] = array( 		
 		$productImage,
		$row['product_code'],
 		$row['product_name'],
 		$row['brand_name'],		
 		$row['category_name'],
		$row['sku'],
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