var managePurchaseTable;

$(document).ready(function() {
	// top nav bar 
	$('#navPurchase').addClass('active');

	// manage product data table
	managePurchaseTable = $('#managePurchaseTable').DataTable({
		'columnDefs': [{className: "text-right", targets: [2, 3]}],
		'ajax': 'php_action/fetchPurchase.php',
		'order': []
	});
});