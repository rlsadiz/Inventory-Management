var manageSKUTable;

$(document).ready(function() {
	// top nav bar 
	$('#navSupplier').addClass('active');
	
	// manage product data table
	manageSupplierTable = $('#manageSupplierTable').DataTable({
		'ajax': 'php_action/fetchSupplier.php',
		'order': []
	});
	
	// add product modal btn clicked
	$("#addSupplierBtn").unbind('click').bind('click', function() {
		
		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		// submit product form
		$("#submitSupplierForm").unbind('submit').bind('submit', function() {
			// form validation
			var supplierName = $("#supplierName").val();
			var street_address = $("#street_address").val();
			var region_address = $("#region_address").val();
			var phone = $("#phone").val();
			var email = $("#email").val();
			var contact_person = $("#contact_person").val();
			var supplier_status = $("#status").val();
	
			if(supplierName == "") {
				$("#supplierName").closest('.center-block').after('<p class="text-danger">Supplier Name field is required</p>');
				$('#supplierName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#supplierName").find('.text-danger').remove();
				// success out for form 
				$("#supplierName").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(street_address == "") {
				$("#street_address").after('<p class="text-danger">Street Address field is required</p>');
				$('#street_address').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#street_address").find('.text-danger').remove();
				// success out for form 
				$("#street_address").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(region_address == "") {
				$("#region_address").after('<p class="text-danger">Region Address field is required</p>');
				$('#region_address').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#region_address").find('.text-danger').remove();
				// success out for form 
				$("#region_address").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(phone == "") {
				$("#phone").after('<p class="text-danger">Phone field is required</p>');
				$('#phone').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#phone").find('.text-danger').remove();
				// success out for form 
				$("#phone").closest('.form-group').addClass('has-success');	  	
			}	// /else
		
			if(supplier_status == "") {
				$("#status").after('<p class="text-danger">Status field is required</p>');
				$('#status').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#status").find('.text-danger').remove();
				// success out for form 
				$("#status").closest('.form-group').addClass('has-success');	  	
			}

			if(supplierName && street_address && region_address && phone && supplier_status) {
				// submit loading button
				$("#createSupplierbtn").button('loading');
				console.log("lol");
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
						$("#createSupplierbtn").button('reset');
						if(response.success == true) {
							// reload the manage product table
							manageSupplierTable.ajax.reload(null, false);
							
							// reset the form text
							$("#submitSupplierForm")[0].reset();
							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');
							
							//$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-supplier-messages').html('<div class="alert alert-success">'+
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

			} // /success function
		}); // /ajax to fetch product image

				
	} else {
		alert('error please refresh the page');
	}
} // /edit sku function

// remove sku 
function removeSKU(skuId = null) {
	if(skuId) {
		// remove sku button clicked
		$("#removeSKUtModalBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeSKUtModalBtn").button('loading');
			$.ajax({
				url: 'php_action/removeSKU.php',
				type: 'post',
				data: {skuId: skuId},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeSKUtModalBtn").button('reset');
					if(response.success == true) {
						// remove product modal
						$("#removeSKUModal").modal('hide');

						// update the product table
						manageProductTable.ajax.reload(null, true);

						// remove success messages
						$(".remove-messages").html('<div class="alert alert-success">'+
						'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
						'</div>');

						// remove the mesages
						$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					} else {

						// remove success messages
						$(".removeProductMessages").html('<div class="alert alert-success">'+
						'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
						'</div>');

						// remove the mesages
						$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					} // /error
				} // /success function
			}); // /ajax fucntion to remove the product
			return false;
		}); // /remove product btn clicked
	} // /if productid
} // /remove product function