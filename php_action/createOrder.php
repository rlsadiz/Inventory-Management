<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);

if($_POST) {	
	$orderList = json_decode($_POST['orderList'], true);
	//$vatable = $_POST['vatable'];
	
	
	//order item
	$length = sizeof($orderList);
	for($i = 0; $i < $length; $i++) {
		$barcode = $orderList[$i]['Barcode'];
		$sql = "SELECT id_sku, barcode, product_name from price_list WHERE barcode = '$barcode'";
		$result = $connect->query($sql);
		
		if($result->num_rows > 0) {
			$row = $result->fetch_array();
			print_r($row);
		}
	}		
	//echo sizeof($orderList);
	//$sql = "INSERT INTO orders (order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_status, order_status) 
	//VALUES ('$orderDate', '$clientName', '$clientContact', '$subTotalValue', '$vatValue', '$totalAmountValue', '$discount', '$grandTotalValue', '$paid', '$dueValue', $paymentStatus, 1)";
	
	
	//$order_id;
	//$orderStatus = false;
	if($connect->query($sql) === true) {
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	

	}

		
	// echo $_POST['productName'];
	$orderItemStatus = false;

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);