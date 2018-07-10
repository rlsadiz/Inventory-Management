var productTable;
var rowCount;
$(document).ready(function() {
	var divRequest = $(".div-request").text();
	// top nav bar 
	$('#navOrder').addClass('active');
	
	if(divRequest == 'add')  {
		initialize();
	}
});

function initialize() {
	rowCount = 0;
}

function addOrderItem() {
	var barcode = $("#barcode").val();
	var offset = '0';
	if(barcode.length == 12)
		barcode = offset.concat(barcode);
	
	productTable = $('#productTable').dataTable();
	var index = productTable.fnFindCellRowIndexes(barcode, 0);
	
	console.log(index);
	productTable = $('#productTable').DataTable();
	if(index.length == 0) {
		$.ajax({
			url: 'php_action/fetchOrderStocks.php',
			type: 'post',
			data: {barcode: barcode},
			dataType: 'json',
			success:function(response) {
				if(response.quantity > 0) {
					$.ajax({
					url: 'php_action/fetchOrderItem.php',
					type: 'post',
					data: {barcode: barcode},
					dataType: 'json',
						success:function(response) {
							if ($.trim(response)) {
								var vatable = "";			
								if(response.vatable == 1)
										vatable = "Yes";
								else
										vatable = "No";
								productTable.row.add([
									response.barcode,
									1,
									response.product_name,
									response.price,
									0.00,
									response.price,
									vatable
								]).draw();
							}
						}
					});
				}
			}
		});
		rowCount++;
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
	
	computeTotal();
	
	document.getElementById("barcode").value = "";

}

function computeTotal() {
	productTable = $('#productTable').DataTable();
	var tableProductLength = rowCount;
	var totalSubAmount = 0;

	for(x = 0; x < tableProductLength; x++) {
		var amount = productTable.cell(x, 5).data();
		var vatable = productTable.cell(x, 6).data();
		
		if(vatable == "Yes") {
			totalSubAmount = Number(totalSubAmount) + Number(amount);
		}
		
		console.log(totalSubAmount);
	} // /for

	totalSubAmount = totalSubAmount / 1.12;
	totalSubAmount = totalSubAmount.toFixed(2);

	// sub total
	$("#subTotal").val(totalSubAmount);
	$("#subTotalValue").val(totalSubAmount);

	// vat
	var vat = Number($("#subTotal").val()) * 0.12;
	vat = vat.toFixed(2);
	$("#vat").val(vat);
	$("#vatValue").val(vat);

	// total amount
	var totalAmount = (Number($("#subTotal").val()) + Number($("#vat").val()));
	totalAmount = totalAmount.toFixed(2);
	$("#totalAmount").val(totalAmount);
	$("#totalAmountValue").val(totalAmount);

	var discount = $("#discount").val();
	if(discount) {
		var grandTotal = Number($("#totalAmount").val()) - Number(discount);
		grandTotal = grandTotal.toFixed(2);
		$("#grandTotal").val(grandTotal);
		$("#grandTotalValue").val(grandTotal);
	} else {
		$("#grandTotal").val(totalAmount);
		$("#grandTotalValue").val(totalAmount);
	} // /else discount	

	var paidAmount = $("#paid").val();
	if(paidAmount) {
		change =  Number(paidAmount) - Number($("#grandTotal").val());
		change = paidAmount.toFixed(2);
		if(change > 0) {
			$("#due").val(change);
			$("#dueValue").val(change);
		}
		else {
			$("#due").val(0);
			$("#dueValue").val(0);
		}
	} 

} // /sub total amount

function paidAmount() {
	var grandTotal = $("#grandTotal").val();

	if(grandTotal) {
		var change = Number($("#paid").val()) - Number($("#grandTotal").val());
		change = change.toFixed(2);
		if(change > 0) {
			$("#due").val(change);
			$("#dueValue").val(change);
		}
		else {
			$("#due").val(0);
			$("#dueValue").val(0);
		}
	} // /if
} // /paid amoutn function