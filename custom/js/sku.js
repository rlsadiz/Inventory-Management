var manageSKUTable;

$(document).ready(function() {
	// top nav bar 
	$('#navsku').addClass('active');
	
	// manage product data table
	manageSKUTable = $('#manageSKUTable').DataTable({
		'columnDefs': [{className: "text-right", targets: [3, 4]}],
		'ajax': 'php_action/fetchSKU.php',
		'order': []
	});
	
	// add product modal btn clicked
	$("#addSKUModalBtn").unbind('click').bind('click', function() {
		// // product form reset
		$("#submitSKUForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		// submit product form
		$("#submitSKUForm").unbind('submit').bind('submit', function() {
			// form validation
			var productCode = $("#productCode").val();
			var variation = $("#variation").val();
			var barcode = $("#barcode").val();
			var cost = $("#cost").val();
			var price = $("#price").val();
			var stock = $("#stock").val();
			var criticalStock = $("#criticalStock").val();
			var skuStatus = $("#status").val();
	
			if(productCode == "") {
				$("#productImage").closest('.center-block').after('<p class="text-danger">Product Code field is required</p>');
				$('#productImage').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#productImage").find('.text-danger').remove();
				// success out for form 
				$("#productImage").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(variation == "") {
				$("#variation").after('<p class="text-danger">Variation field is required</p>');
				$('#variation').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#variation").find('.text-danger').remove();
				// success out for form 
				$("#variation").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(barcode == "") {
				$("#barcode").after('<p class="text-danger">Barcode field is required</p>');
				$('#barcode').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#barcode").find('.text-danger').remove();
				// success out for form 
				$("#barcode").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(cost == "") {
				$("#cost").after('<p class="text-danger">Cost field is required</p>');
				$('#cost').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#cost").find('.text-danger').remove();
				// success out for form 
				$("#cost").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(price == "") {
				$("#price").after('<p class="text-danger">Price field is required</p>');
				$('#price').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#price").find('.text-danger').remove();
				// success out for form 
				$("#price").closest('.form-group').addClass('has-success');	  	
			}	// /else
			
			if(stock == "") {
				$("#stock").after('<p class="text-danger">Stock field is required</p>');
				$('#stock').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#stock").find('.text-danger').remove();
				// success out for form 
				$("#stock").closest('.form-group').addClass('has-success');	  	
			}	// /else
		
			if(criticalStock == "") {
				$("#criticalStock").after('<p class="text-danger">Critical Stock field is required</p>');
				$('#criticalStock').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#criticalStock").find('.text-danger').remove();
				// success out for form 
				$("#criticalStock").closest('.form-group').addClass('has-success');	  	
			}	// /else
		
			if(skuStatus == "") {
				$("#status").after('<p class="text-danger">Status field is required</p>');
				$('#status').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#status").find('.text-danger').remove();
				// success out for form 
				$("#status").closest('.form-group').addClass('has-success');	  	
			}

			if(productCode && variation && barcode && cost && price && stock && criticalStock && skuStatus) {
				// submit loading button
				$("#createSKUbtn").button('loading');
				
				var form = $(this);
				var formData = new FormData(this);
				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success:function(response) {
						// submit loading button
						$("#createSKUbtn").button('reset');
						if(response.success == true) {
							// reload the manage product table
							manageSKUTable.ajax.reload(null, false);
							
							// reset the form text
							$("#submitSKUForm")[0].reset();
							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');
							
							//$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-sku-messages').html('<div class="alert alert-success">'+
							'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
							'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
							'</div>');

							// remove the mesages
							$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert						

						}// /if response.success
							
					} // /success function
				}); // /ajax function
			}	 // /if validation is ok 					

			return false;
		}); // /submit product form
	}); //
}); // document.ready fucntion

function editSKU(skuId = null) {
	if(skuId) {
		$("#skuId").remove();		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');
		// modal spinner
		$('.div-loading').removeClass('div-hide');
		// modal div
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedSku.php',
			type: 'post',
			data: {skuId: skuId},
			dataType: 'json',
			success:function(response) {		
			// alert(response.product_image);
				// modal spinner
				$('.div-loading').addClass('div-hide');
				// modal div
				$('.div-result').removeClass('div-hide');				 			
				
				// product name
				$("#editProductName").val(response.product_name);
				// variation name
				$("#editVariationName").val(response.variation);
				// sku code
				$("#editSkuCode").val(response.sku_code);
				// cost
				$("#editCost").val(response.cost);
				// price	
				$("#editPrice").val(response.price);
				// critical stock
				$("#editCriticalStock").val(response.critical_quantity);
				// status
				$("#editStatus").val(response.sku_status);

				// update the product data function
				$("#editSKUForm").unbind('submit').bind('submit', function() {

					// form validation
					var variationName = $("#editVariationName").val();
					var cost = $("#editCost").val();
					var price = $("#editPrice").val();
					var critical_stock = $("#editCriticalStock").val();
					var sku_status = $("#editStatus").val();
								
					if(variationName == "") {
						$("#editVariationName").after('<p class="text-danger">Variation Name field is required</p>');
						$('#editVariationName').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editVariationName").find('.text-danger').remove();
						// success out for form 
						$("#editVariationName").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(cost == "") {
						$("#editCost").after('<p class="text-danger">Cost field is required</p>');
						$('#editCost').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editCost").find('.text-danger').remove();
						// success out for form 
						$("#editCost").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(price == "") {
						$("#editPrice").after('<p class="text-danger">Price field is required</p>');
						$('#editPrice').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editPrice").find('.text-danger').remove();
						// success out for form 
						$("#editPrice").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(critical_stock == "") {
						$("#editCriticalStock").after('<p class="text-danger">Critical Stock field is required</p>');
						$('#editCriticalStock').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editCriticalStock").find('.text-danger').remove();
						// success out for form 
						$("#editCriticalStock").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(sku_status == "") {
						$("#editStatus").after('<p class="text-danger">SKU Status field is required</p>');
						$('#editStatus').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editStatus").find('.text-danger').remove();
						// success out for form 
						$("#editStatus").closest('.form-group').addClass('has-success');	  	
					}	// /else					
					
					if(variationName && cost && price && critical_stock && sku_status) {
						// submit loading button
						$("#editSKUbtn").button('loading');

						var form = $(this);
						var formData = new FormData(this);
						formData.append('sku_id', skuId);
						
						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								console.log(response);
								if(response.success == true) {
									// submit loading button
									$("#editSKUbtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-product-messages').html('<div class="alert alert-success">'+
									'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
									'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
									'</div>');

									// remove the mesages
									$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

									// reload the manage student table
									manageProductTable.ajax.reload(null, true);

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');
								} // /if response.success	
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // update the product data function

				// update the product image				
				$("#updateProductImageForm").unbind('submit').bind('submit', function() {					
					// form validation
					var productImage = $("#editProductImage").val();					
					
					if(productImage == "") {
						$("#editProductImage").closest('.center-block').after('<p class="text-danger">Product Image field is required</p>');
						$('#editProductImage').closest('.form-group').addClass('has-error');
					}	else {
						// remov error text field
						$("#editProductImage").find('.text-danger').remove();
						// success out for form 
						$("#editProductImage").closest('.form-group').addClass('has-success');	  	
					}	// /else

					if(productImage) {
						// submit loading button
						$("#editProductImageBtn").button('loading');

						var form = $(this);
						var formData = new FormData(this);

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								
								if(response.success == true) {
									// submit loading button
									$("#editProductImageBtn").button('reset');																		

									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																			
									// shows a successful message after operation
									$('#edit-productPhoto-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

									// remove the mesages
				          $(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert

				          // reload the manage student table
									manageProductTable.ajax.reload(null, true);

									$(".fileinput-remove-button").click();

									$.ajax({
										url: 'php_action/fetchProductImageUrl.php?i='+productId,
										type: 'post',
										success:function(response) {
										$("#getProductImage").attr('src', response);		
										}
									});																		

									// remove text-error 
									$(".text-danger").remove();
									// remove from-group error
									$(".form-group").removeClass('has-error').removeClass('has-success');

								} // /if response.success
								
							} // /success function
						}); // /ajax function
					}	 // /if validation is ok 					

					return false;
				}); // /update the product image

			} // /success function
		}); // /ajax to fetch product image

				
	} else {
		alert('error please refresh the page');
	}
} // /edit product function