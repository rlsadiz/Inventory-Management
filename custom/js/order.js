var productTable;

$(document).ready(function() {
	var divRequest = $(".div-request").text();
	// top nav bar 
	$('#navOrder').addClass('active');
	
	if(divRequest == 'add')  {
	}
});

function addOrderItem() {
	var barcode = $("#barcode").val();
	var offset = '0';
	if(barcode.length == 12)
		barcode = offset.concat(barcode);
	
	productTable = $('#productTable').DataTable();
	
	$.ajax({
		url: 'php_action/fetchOrderItem.php',
		type: 'post',
		data: {barcode: barcode},
		dataType: 'json',
		success:function(response) {
			console.log(response);
			if ($.trim(response)) {
				productTable.row.add([
					response.barcode,
					1,
					response.product_name,
					response.price,
					response.price,
					response.price,
					barcode
				]).draw();
			}
		}
	});

	
	document.getElementById("barcode").value = "";
}