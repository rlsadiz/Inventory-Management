var managePriceTable;

$(document).ready(function() {
	// top nav bar 
	$('#navPrice').addClass('active');
	
	// manage product data table
	managePriceTable = $('#managePriceTable').DataTable({
		'ajax': 'php_action/fetchPrice.php',
		'order': []
	});
}); // document.ready fucntion

function editPrice(skuId = null) {
	
}

function removePromotion(skuId = null) {
}