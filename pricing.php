<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Price</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>			
				
				<table class="table" id="managePriceTable">
					<thead>
						<tr>
							<th style="width:14%">SKU Code</th>
							<th style="width:32%">Product Name</th>
							<th style="width:10%">Cost</th>
							<th style="width:10%">Price</th>
							<th style="width:10%">Promotion</th>
							<th style="width:14%">Updated At</th>
							<th style="width:10%">Options</th>
						</tr>	
					</thead>
				</table>
				<!-- /table -->
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<script src="custom/js/pricing.js"></script>

<?php require_once 'includes/footer.php'; ?>