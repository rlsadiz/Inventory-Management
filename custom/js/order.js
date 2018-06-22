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
	
	productTable = $('#productTable').dataTable();
	var index = productTable.fnFindCellRowIndexes(barcode, 0);
	
	productTable = $('#productTable').DataTable();
	if(index.length == 0) {
		$.ajax({
			url: 'php_action/fetchOrderItem.php',
			type: 'post',
			data: {barcode: barcode},
			dataType: 'json',
			success:function(response) {
				if ($.trim(response)) {
					productTable.row.add([
						response.barcode,
						1,
						response.product_name,
						response.price,
						0.00,
						response.price,
						barcode
					]).draw();
				}
			}
		});
	}
	else {
		var qty = productTable.cell(index, 1).data();
		var price = productTable.cell(index, 3).data();
		var discount = productTable.cell(index, 4).data();
		var total = productTable.cell(index, 5).data();
		qty = qty + 1;
		total = qty * (price - discount);
		productTable.cell(index, 1).data(qty);
		productTable.cell(index, 5).data(total);
	}
	

	
	document.getElementById("barcode").value = "";
}