<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage SKU</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>
				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default" style="width:140px" data-toggle="modal" id="addSKUModalBtn" data-target="#addSKUModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add SKU </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageSKUTable">
					<thead>
						<tr>
							<th style="width:10%">Barcode</th>
							<th style="width:15%">SKU Code</th>
							<th style="width:35%">SKU Name</th>
							<th style="width:10%">Cost</th>
							<th style="width:10%">Price</th>
							<th style="width:10%">Status</th>
							<th style="width:10%">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add sku -->
<div class="modal fade" id="addSKUModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitSKUForm" action="php_action/createSKU.php" method="POST" enctype="multipart/form-data">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-plus"></i> Add SKU</h4>
			</div>
		  
			<div class="modal-body" style="max-height:450px; overflow:auto;">

				<div id="add-sku-messages"></div>     	           	       

				<div class="form-group">
					<label for="productName" class="col-sm-3 control-label">Product Code: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="productCode" placeholder="Product Code" name="productCode" autocomplete="off">
				    </div>
				</div> <!-- /form-group-->	       	        
			
				<div class="form-group">
					<label for="productName" class="col-sm-3 control-label">Variation: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="variation" placeholder="Variation" name="variation" autocomplete="off">
				    </div>
				</div> <!-- /form-group-->	
				
				<div class="form-group">
					<label for="barcode" class="col-sm-3 control-label">Barcode: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="number" class="form-control" id="barcode" placeholder="Barcode" name="barcode" autocomplete="off">
						</div>
				</div> <!-- /form-group-->	
				
				<div class="form-group">
					<label for="cost" class="col-sm-3 control-label">Cost: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="number" step="0.01" class="form-control" id="cost" placeholder="Cost" name="cost" autocomplete="off">
						</div>
				</div> <!-- /form-group-->		
				
				<div class="form-group">
					<label for="price" class="col-sm-3 control-label">Price: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="number" step="0.01" class="form-control" id="price" placeholder="Price" name="price" autocomplete="off">
						</div>
				</div> <!-- /form-group-->

				<div class="form-group">
					<label for="stock" class="col-sm-3 control-label">Initial Stock: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="number" class="form-control" id="stock" placeholder="Stock" name="stock" autocomplete="off">
						</div>
				</div> <!-- /form-group-->	
				
				<div class="form-group">
					<label for="critical_stock" class="col-sm-3 control-label">Critical Stock: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="number" class="form-control" id="criticalStock" placeholder="Critical Stock" name="criticalStock" autocomplete="off">
						</div>
				</div> <!-- /form-group-->				

				<div class="form-group">
					<label for="productStatus" class="col-sm-3 control-label">Status: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <select class="form-control" id="status" name="status">
							<option value="">~~SELECT~~</option>
							<option value="1">Active</option>
							<option value="2">Inactive</option>
						  </select>
						</div>
				</div> <!-- /form-group-->	         	        
			  </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createSKUbtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add product -->

<!-- edit sku -->
<div class="modal fade" id="editSKUModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
	<div class="modal-content">
		<form class="form-horizontal" id="editSKUForm" action="php_action/editSKU.php" method="POST" enctype="multipart/form-data"> 	
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-edit"></i> Edit SKU</h4>
			</div>
			
			<div class="modal-body" style="max-height:450px; overflow:auto;">		
				<div id="edit-product-messages"></div>	
				
				<div class="form-group">
					<label for="editProductName" class="col-sm-3 control-label">Product Name: </label>
					<label class="col-sm-1 control-label">: </label>
					<div class="col-sm-7">
						<input type="text" class="form-control" id="editProductName" placeholder="Product Name" name="editProductName" autocomplete="off" disabled="true">
					</div>
				</div> <!-- /form-group-->	
				
				<div class="form-group">
					<label for="editVariationName" class="col-sm-3 control-label">Variation Name: </label>
					<label class="col-sm-1 control-label">: </label>
					<div class="col-sm-7">
						<input type="text" class="form-control" id="editVariationName" placeholder="Variation Name" name="editVariationName" autocomplete="off">
					</div>
				</div> <!-- /form-group-->					        	         	       

				<div class="form-group">
					<label for="editSkuCode" class="col-sm-3 control-label">SKU Code: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="text" class="form-control" id="editSkuCode" placeholder="SKU Code" name="editSkuCode" autocomplete="off" disabled="true">
						</div>
				</div> <!-- /form-group-->	
				
				<div class="form-group">
					<label for="editCost" class="col-sm-3 control-label">Cost: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="number" step="0.01" class="form-control" id="editCost" placeholder="Cost" name="editCost" autocomplete="off">
						</div>
				</div> <!-- /form-group-->		
				
				<div class="form-group">
					<label for="editPrice" class="col-sm-3 control-label">Price: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="number" step="0.01" class="form-control" id="editPrice" placeholder="Price" name="editPrice" autocomplete="off">
						</div>
				</div> <!-- /form-group-->
				
				<div class="form-group">
					<label for="editCriticalStock" class="col-sm-3 control-label">Critical Stock: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="number" class="form-control" id="editCriticalStock" placeholder="Critical Stock" name="editCriticalStock" autocomplete="off">
						</div>
				</div> <!-- /form-group-->				

				<div class="form-group">
					<label for="editStatus" class="col-sm-3 control-label">Status: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <select class="form-control" id="editStatus" name="editStatus">
							<option value="">~~SELECT~~</option>
							<option value="1">Active</option>
							<option value="2">Inactive</option>
						  </select>
						</div>
				</div> <!-- /form-group-->	         	            	
			</div> <!-- /modal-body -->
		
			<div class="modal-footer editProductFooter">
				<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
				<button type="submit" class="btn btn-success" id="editSKUbtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
			</div> <!-- /modal-footer -->
		</form> <!-- /.form -->		
    </div> <!-- /modal-content -->
	</div> <!-- /modal-dailog -->	
</div> <!-- /edit product -->


<!-- remove product -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeProductModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Product</h4>
      </div>
      <div class="modal-body">

      	<div class="removeProductMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove product -->


<script src="custom/js/sku.js"></script>

<?php require_once 'includes/footer.php'; ?>