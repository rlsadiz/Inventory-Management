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

<!-- edit price -->
<div class="modal fade" id="editPriceModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editPriceForm" action="php_action/editPrice.php" method="POST">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-edit"></i> Edit Price</h4>
			</div>
		<div class="modal-body">
	      	<div id="edit-price-messages"></div>
	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
			</div>

			<div class="edit-price-result">
				<div class="form-group">
					<label for="editPriceName" class="col-sm-4 control-label">Product  Name: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="text" class="form-control" disabled="true" id="editPriceName" placeholder="Product Name" name="editPriceName" autocomplete="off">
						</div>
				</div> <!-- /form-group-->
				<div class="form-group">
					<label for="editPriceVariation" class="col-sm-4 control-label">Variation: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="text" class="form-control" disabled="true" id="editPriceVariation" placeholder="Variation Name" name="editPriceVariation" autocomplete="off">
						</div>
				</div> <!-- /form-group-->
				<div class="form-group">
					<label for="editPriceVariation" class="col-sm-4 control-label">SKU Code: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="text" class="form-control" disabled="true" id="editPriceSKU" placeholder="SKU Code" name="editPriceSKU" autocomplete="off">
						</div>
				</div> <!-- /form-group-->	       	        
				<div class="form-group">
					<label for="editPriceCost" class="col-sm-4 control-label">Cost: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="number" step="0.01" class="form-control" disabled="true" id="editPriceCost" placeholder="Cost" name="editPriceCost" autocomplete="off">
						</div>
				</div> <!-- /form-group-->	 
				<div class="form-group">
					<label for="editPricePrice" class="col-sm-4 control-label">Price: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="number" step="0.01" class="form-control" id="editPricePrice" placeholder="Price" name="editPricePrice" onchange="updateMargin()" onkeyup="updateMargin()" autocomplete="off">
						</div>
				</div> <!-- /form-group-->
				<div class="form-group">
					<label for="editPriceMargin" class="col-sm-4 control-label">Margin: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="number" step="0.01" class="form-control" id="editPriceMargin" placeholder="Cost" name="editPriceMargin" onchange="updatePrice()" onkeyup="updatePrice()" autocomplete="off">
						</div>
				</div> <!-- /form-group-->			
			</div> <!-- /modal-body -->
	      
			<div class="modal-footer editPriceFooter">
			<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

			<button type="submit" class="btn btn-success" id="editPriceBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
			</div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<script src="custom/js/pricing.js"></script>

<?php require_once 'includes/footer.php'; ?>