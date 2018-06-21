var managePriceTable;

$(document).ready(function() {
	// top nav bar 
	$('#navPrice').addClass('active');
	
	// manage product data table
	managePriceTable = $('#managePriceTable').DataTable({
		'columnDefs': [{className: "text-right", targets: [2, 3, 4]}],
		'ajax': 'php_action/fetchPrice.php',
		'order': []
	});
}); // document.ready fucntion

function editPrice(skuId = null) {
	if(skuId) {
		// remove the added sku id 
		$('#editSkuId').remove();
		// reset the form text
		$("#editPriceForm")[0].reset();
		// reset the form text-error
		$(".text-danger").remove();
		// reset the form group error	
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// edit price messages
		$("#edit-price-messages").html("");
		// modal spinner
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-price-result').addClass('div-hide');
		//modal footer
		$(".editPriceFooter").addClass('div-hide');
	
		var margin = 0;
		$.ajax({
			url: 'php_action/fetchSelectedSku.php',
			type: 'get',
			data: {skuId: skuId},
			dataType: 'json',
			success:function(response) {
				// modal spinner
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-price-result').removeClass('div-hide');
				//modal footer
				$(".editPriceFooter").removeClass('div-hide');	

				// set the product name
				$("#editPriceName").val(response.product_name);
				// set the variation name
				$("#editPriceVariation").val(response.variation);
				// set the sku code
				$("#editPriceSKU").val(response.sku_code);
				// set the cost
				$("#editPriceCost").val(response.cost);
				// set the price
				$("#editPricePrice").val(response.price);
				// set the margin
				margin = (response.price - response.cost) / response.cost * 100;
				$("#editPriceMargin").val(parseFloat(margin).toFixed(2));
				// add the categories id 
				$(".editPriceFooter").after('<input type="hidden" name="editSkuId" id="editSkuId" value="'+response.id_sku+'" />');
				
				// submit of edit price form
				$("#editPriceForm").unbind('submit').bind('submit', function() {
					var price = $("#editPricePrice").val();
					var margin = $("#editPriceMargin").val();
					
					if(price == "") {
						$("#editPricePrice").after('<p class="text-danger">Price field is required</p>');
						$('#editPricePrice').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editPricePrice").find('.text-danger').remove();
						// success out for form 
						$("#editPricePrice").closest('.form-group').addClass('has-success');	  	
					}
					
					if(margin == "") {
						$("#editPriceMargin").after('<p class="text-danger">Margin field is required</p>');
						$('#editPriceMargin').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editPriceMargin").find('.text-danger').remove();
						// success out for form 
						$("#editPriceMargin").closest('.form-group').addClass('has-success');	  	
					}

					if(price && margin) {
						var form = $(this);
						// button loading
						$("#editPriceBtn").button('loading');
						
						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								// button loading
								$("#editPriceBtn").button('reset');
								console.log("lol");
								if(response.success == true) {
									// reload the manage member table 
									managePriceTable.ajax.reload(null, false);									  	  			
									
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-price-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								}  // if

							} // /success
						}); // /ajax	
					} // if


					return false;
				}); // /submit of edit categories form
			}		
		});
	}
}

function updateMargin() {
	var price = Number($("#editPricePrice").val());
	var cost = Number($("#editPriceCost").val());
	var margin = (price - cost) / cost * 100;
	
	$("#editPriceMargin").val(parseFloat(margin).toFixed(2));
}

function updatePrice() {
	var margin = Number($("#editPriceMargin").val());
	var cost = Number($("#editPriceCost").val());
	var price = ((margin / 100) + 1) * cost;
	
	$("#editPricePrice").val(parseFloat(price).toFixed(2));
}