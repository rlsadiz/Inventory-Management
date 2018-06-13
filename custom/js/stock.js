var manageStocksTable;

$(document).ready(function() {
	// top nav bar 
	$('#navStocks').addClass('active');
	
	// manage product data table
	manageStocksTable = $('#manageStocksTable').DataTable({
		'ajax': 'php_action/fetchStocks.php',
		'order': []
	});
}); // document.ready fucntion