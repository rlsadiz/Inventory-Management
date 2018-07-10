<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Stocks</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>			
				
				<table class="table" id="manageStocksTable">
					<thead>
						<tr>
							<th style="width:12%">Barcode</th>
							<th style="width:12%">SKU Code</th>
							<th style="width:28%">Product Name</th>
							<th style="width:10%">Quantity</th>
							<th style="width:14%">Last Purchase</th>
							<th style="width:14%">Last Order</th>
							<th style="width:10%">Status</th>
						</tr>	
					</thead>
				</table>
				<!-- /table -->
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<script src="custom/js/stock.js"></script>

<?php require_once 'includes/footer.php'; ?>