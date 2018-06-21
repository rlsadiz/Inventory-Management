var manageCategoriesTable;

$(document).ready(function() {
	// active top navbar categories
	$('#navCategories').addClass('active');	

	// manage categories Data Table
	manageCategoriesTable = $('#manageCategoriesTable').DataTable({
		'ajax' : 'php_action/fetchCategories.php',
		'order': []
	}); 

	// on click on submit categories form modal
	$('#addCategoriesModalBtn').unbind('click').bind('click', function() {
		// reset the form text
		$("#submitCategoriesForm")[0].reset();
		
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// submit categories form function
		$("#submitCategoriesForm").unbind('submit').bind('submit', function() {

			var categoriesName = $("#categoriesName").val();
			var categoriesParent = $("#categoriesParent").val();
			var categoriesStatus = $("#categoriesStatus").val();

			if(categoriesName == "") {
				$("#categoriesName").after('<p class="text-danger">Category Name field is required</p>');
				$('#categoriesName').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#categoriesName").find('.text-danger').remove();
				// success out for form 
				$("#categoriesName").closest('.form-group').addClass('has-success');	  	
			}

			if(categoriesParent == "") {
				$("#categoriesParent").after('<p class="text-danger">Category Parent field is required</p>');
				$('#categoriesParent').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#categoriesParent").find('.text-danger').remove();
				// success out for form 
				$("#categoriesParent").closest('.form-group').addClass('has-success');	  	
			}
			
			if(categoriesStatus == "") {
				$("#categoriesStatus").after('<p class="text-danger">Category Status field is required</p>');
				$('#categoriesStatus').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#categoriesStatus").find('.text-danger').remove();
				// success out for form 
				$("#categoriesStatus").closest('.form-group').addClass('has-success');	  	
			}

			if(categoriesName && categoriesParent && categoriesStatus) {
				var form = $(this);
				// button loading
				$("#createCategoriesBtn").button('loading');

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),
					dataType: 'json',
					success:function(response) {
						// button loading
						$("#createCategoriesBtn").button('reset');

						if(response.success == true) {
							// reload the manage member table 
							manageCategoriesTable.ajax.reload(null, false);						

							// reset the form text
							$("#submitCategoriesForm")[0].reset();
							// remove the error text
							$(".text-danger").remove();
							// remove the form error
							$('.form-group').removeClass('has-error').removeClass('has-success');
							
							// shows a successful message after operation
							$('#add-categories-messages').html('<div class="alert alert-success">'+
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
		}); // submit categories form function
	}); // /on click on submit categories form modal	

}); // /document

// edit categories function
function editCategories(categoriesId = null) {
	if(categoriesId) {
		// remove the added categories id 
		$('#editCategoriesId').remove();
		// reset the form text
		$("#editCategoriesForm")[0].reset();
		// reset the form text-error
		$(".text-danger").remove();
		// reset the form group errro		
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// edit categories messages
		$("#edit-categories-messages").html("");
		// modal spinner
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-categories-result').addClass('div-hide');
		//modal footer
		$(".editCategoriesFooter").addClass('div-hide');		

		$.ajax({
			url: 'php_action/fetchSelectedCategories.php',
			type: 'post',
			data: {categoriesId: categoriesId},
			dataType: 'json',
			success:function(response) {

				// modal spinner
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-categories-result').removeClass('div-hide');
				//modal footer
				$(".editCategoriesFooter").removeClass('div-hide');	

				// set the categories name
				$("#editCategoriesName").val(response.category_name);
				// set the categories status
				$("#editCategoriesParent").val(response.fk_parent_category);
				// set the categories status
				$("#editCategoriesStatus").val(response.category_status);
				// add the categories id 
				$(".editCategoriesFooter").after('<input type="hidden" name="editCategoriesId" id="editCategoriesId" value="'+response.id_category+'" />');


				// submit of edit categories form
				$("#editCategoriesForm").unbind('submit').bind('submit', function() {
					var categoriesName = $("#editCategoriesName").val();
					var categoriesParent = $("#editCategoriesParent").val();
					var categoriesStatus = $("#editCategoriesStatus").val();
					
					if(categoriesName == "") {
						$("#editCategoriesName").after('<p class="text-danger">Category Name field is required</p>');
						$('#editCategoriesName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editCategoriesName").find('.text-danger').remove();
						// success out for form 
						$("#editCategoriesName").closest('.form-group').addClass('has-success');	  	
					}
					
					var parent_message = ""; 
					if(categoriesParent == categoriesId) {
						categoriesParent = "";
						parent_message = "Category Parent must not equal Category";
					}
					else {
						parent_message = "Category Parent field is required";
					}
					
					if(categoriesParent == "") {
						$("#editCategoriesParent").after('<p class="text-danger">'+ parent_message +'</p>');
						$('#editCategoriesParent').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editCategoriesParent").find('.text-danger').remove();
						// success out for form 
						$("#editCategoriesParent").closest('.form-group').addClass('has-success');	  		
					}
			
					if(categoriesStatus == "") {
						$("#editCategoriesStatus").after('<p class="text-danger">Category Status field is required</p>');
						$('#editCategoriesStatus').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editCategoriesStatus").find('.text-danger').remove();
						// success out for form 
						$("#editCategoriesStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(categoriesName && categoriesParent && categoriesStatus) {
						var form = $(this);
						// button loading
						$("#editCategoriesBtn").button('loading');

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								// button loading
								$("#editCategoriesBtn").button('reset');

								if(response.success == true) {
									// reload the manage member table 
									manageCategoriesTable.ajax.reload(null, false);									  	  			
									
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-categories-messages').html('<div class="alert alert-success">'+
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

			} // /success
		}); // /fetch the selected categories data

	} else {
		alert('Oops!! Refresh the page');
	}
} // /edit categories function

// remove categories function
function removeCategories(categoriesId = null) {	
	if(categoriesId) {
		$('#removeCategoriesId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedCategories.php',
			type: 'post',
			data: {categoriesId: categoriesId},
			dataType: 'json',
			success:function(response) {	
				console.log(categoriesId);
				$('.removeCategoriesFooter').after('<input type="hidden" name="removeCategoriesId" id="removeCategoriesId" value="'+response.id_category+'" /> ');			
				
				// remove categories btn clicked to remove the categories function
				$("#removeCategoriesBtn").unbind('click').bind('click', function() {
					// remove categories btn
					$("#removeCategoriesBtn").button('loading');
				
					$.ajax({
						url: 'php_action/removeCategories.php',
						type: 'post',
						data: {categoriesId: categoriesId},
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {
								// remove categories btn
								$("#removeCategoriesBtn").button('reset');
								// close the modal 
								$("#removeCategoriesModal").modal('hide');
								// update the manage categories table
								manageCategoriesTable.ajax.reload(null, false);
								// udpate the messages
								$('.remove-messages').html('<div class="alert alert-success">'+
								'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
								'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
								'</div>');

								$(".alert-success").delay(500).show(10, function() {
									$(this).delay(3000).hide(10, function() {
										$(this).remove();
									});
								}); // /.alert
							} else {
								// close the modal 
								$("#removeCategoriesModal").modal('hide');

								// udpate the messages
								$('.remove-messages').html('<div class="alert alert-success">'+
								'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
								'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
								'</div>');

								$(".alert-success").delay(500).show(10, function() {
									$(this).delay(3000).hide(10, function() {
										$(this).remove();
									});
								}); // /.alert
							} // /else
						} // /success function
					}); // /ajax function request server to remove the categories data
				});
			} // /response
		}); // /ajax function to fetch the categories data
	}
} // remove categories function