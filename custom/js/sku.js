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

			if(productCode && variation && barcode && cost && price && criticalStock && kuStatus) {
				// submit loading button
				$("#createSKUbtn").button('loading');

				var form = $(this);
				var formData = new FormData(this);
				console.log("lol");
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