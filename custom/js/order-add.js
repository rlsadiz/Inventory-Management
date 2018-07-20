var productTable;
var rowCount;
var dataSet;

$(document).ready(function() {
	var divRequest = $(".div-request").text();
	// top nav bar 
	$('#navOrder').addClass('active');
	
	productTable = $('#productTable').DataTable({
		'searching': false, 
		'paging': false,
		'columnDefs': [{className: "text-right", targets: [3, 4]}],
		'order': []
	});
	
	// add product modal btn clicked
	$("#createOrderBtn").unbind('click').bind('click', function() {
		computeTotal();			
		var orderTable = tableToJSON($("#productTable"));
		var vatable = $("#subTotal").val();
		
		$.ajax({
			url : 'php_action/createOrder.php',
			type: 'GET',
			data: {orderList: JSON.stringify(orderTable)},
			//data: {orderList: JSON.stringify($('#productTable'))},
			dataType: 'json',
			contentType: 'json',
			success: function(response) {
				console.log("yehey");
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status + ": " + thrownError);
			}
		});
	});
});	

function initialize() {
	rowCount = 0;
	productTable = $('#productTable').DataTable();
	productTable.clear().draw();
	
	$("#vatable").val(0.00);
	$("#vat").val(0.00);
	$("#nonVatable").val(0.00);
	$("#totalAmount").val(0.00);
	$("#discountTotal").val(0.00);
	$("#grandTotal").val(0.00);
	$("#paid").val(0.00);
	$("#change").val(0.00);
}

function tableToJSON(tblObj){  
	var data = [];
	var $headers = $(tblObj).find("th");
	var $rows = $(tblObj).find("tbody tr").each(function(index) {
		$cells = $(this).find("td");
		data[index] = {};
		$cells.each(function(cellIndex) {
			data[index][$($headers[cellIndex]).html()] = $(this).html();
		});    
	});
	
	return data;
}

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
									response.price,
									vatable
								]).draw();
							}
						}
					});
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status + ": " + thrownError);
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
		total = qty * price;
		total = total.toFixed(2);
		productTable.cell(index, 1).data(qty);
		productTable.cell(index, 4).data(total);
	}
	
	computeTotal();
	
	document.getElementById("barcode").value = "";
}

function computeTotal() {
	productTable = $('#productTable').DataTable();
	var vatableAmount = 0;
	var nonVat = 0;
	productTable.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
        var data = this.data();
		var vat = data[5];
        if(vat == "Yes")
			vatableAmount = vatableAmount + parseInt(data[4]);
		else
			nonVat = nonVat + parseInt(data[4]);
    });

	// vatable
	vatableAmount = vatableAmount / 1.12;
	vatableAmount = vatableAmount.toFixed(2);
	$("#vatable").val(vatableAmount);
	$("#vatableValue").val(vatableAmount);

	// vat
	var vat = Number($("#vatable").val()) * 0.12;
	vat = vat.toFixed(2);
	$("#vat").val(vat);
	$("#vatValue").val(vat);

	// non-vat
	nonVat = nonVat.toFixed(2);
	$("#nonVatable").val(nonVat);
	$("#nonVatableValue").val(nonVat);
	
	// total amount
	var totalAmount = Number($("#vatable").val()) + Number($("#vat").val()) + Number($("#nonVatable").val());
	//console.log(nonVat);
	//totalAmount = totalAmount.toFixed(2);
	$("#totalAmount").val(totalAmount);
	$("#totalAmountValue").val(totalAmount);

	// discount amount
	var discount = $("#discountTotal").val();
	var discount_reason = $("#discount_reason").val();
	if(discount && discount_reason != 0) {
		var grandTotal = Number($("#totalAmount").val()) - Number(discount);
		grandTotal = grandTotal.toFixed(2);
		$("#grandTotal").val(grandTotal);
		$("#grandTotalValue").val(grandTotal);
	} else {
		$("#grandTotal").val(totalAmount);
		$("#grandTotalValue").val(totalAmount);
	} // /else discount	
	
	paidAmount();
} // /sub total amount

function paidAmount() {
	var grandTotal = $("#grandTotal").val();

	if(grandTotal) {
		var change = Number($("#paid").val()) - Number($("#grandTotal").val());
		change = change.toFixed(2);
		if(change > 0) {
			$("#change").val(change);
			$("#changeVal").val(change);
		}
		else {
			$("#change").val(0);
			$("#changeVal").val(0);
		}
	} // /if
} // /paid amount function