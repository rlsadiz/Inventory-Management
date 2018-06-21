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
					<label for="editPricePrice" class="col-sm-3 control-label">Barcode: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="number" class="form-control" id="barcode" placeholder="Barcode" name="barcode" autocomplete="off">
						</div>
				</div> <!-- /form-group-->	
				
				<div class="form-group">
					<label for="editPricePrice" class="col-sm-3 control-label">Cost: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="number" step="0.01" class="form-control" id="cost" placeholder="Cost" name="cost" autocomplete="off">
						</div>
				</div> <!-- /form-group-->		
				
				<div class="form-group">
					<label for="editPricePrice" class="col-sm-3 control-label">Price: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-7">
						  <input type="number" step="0.01" class="form-control" id="price" placeholder="Price" name="price" autocomplete="off">
						</div>
				</div> <!-- /form-group-->

				<div class="form-group">
					<label for="editPricePrice" class="col-sm-3 control-label">Critical Stock: </label>
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

<!-- add sku -->
<div class="modal fade" id="addSKUModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitSKUForm" action="php_action/createSKU.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add SKU</h4>
	      </div>
	      <div class="modal-body" style="max-height:450px; overflow:auto;">

	      	<div id="add-sku-messages"></div>     	           	       

	        <div class="form-group">
	        	<label for="productName" class="col-sm-3 control-label">Product Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="productName" placeholder="Product Name" name="productName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	       	        
			
	        <div class="form-group">
	        	<label for="brandName" class="col-sm-3 control-label">Brand Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="brandName" name="brandName">
				      	<option value="">~~SELECT~~</option>
				      	<?php 
							$sql = "SELECT * FROM brand WHERE brand_status = 1";
							$result = $connect->query($sql);

							while($row = $result->fetch_array()) {
								echo "<option value='".$row['id_brand']."'>".$row['brand_name']."</option>";	
							} // while
							
				      	?>
				      </select>
				    </div>
	        </div> <!-- /form-group-->	

	        <div class="form-group">
	        	<label for="categoryName" class="col-sm-3 control-label">Category Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select type="text" class="form-control" id="categoryName" placeholder="Category Name" name="categoryName" >
				      	<option value="">~~SELECT~~</option>
				      	<?php 
							$sql = "SELECT * FROM category WHERE category_status = 1 AND id_category != 1";
							$result = $connect->query($sql);

							while($row = $result->fetch_array()) {
								echo "<option value='".$row['id_category']."'>".$row['category_name']."</option>";
							} // while
								
				      	?>
				      </select>
				    </div>
	        </div> <!-- /form-group-->					        	         	       

	        <div class="form-group">
	        	<label for="productStatus" class="col-sm-3 control-label">Status: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="productStatus" name="productStatus">
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
<!-- /add sku -->

<!-- edit product -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><i class="fa fa-edit"></i> Edit Product</h4>
		</div>
		  
		<div class="modal-body" style="max-height:450px; overflow:auto;">
			<div id="edit-product-messages"></div>
			<br />
			<div class="div-loading">
				<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
				<span class="sr-only">Loading...</span>
			</div>
			
			<div class="div-result">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Photo</a></li>
					<li role="presentation"><a href="#productInfo" aria-controls="profile" role="tab" data-toggle="tab">Product Info</a></li>    
				</ul>

				<!-- Tab panes -->
				<form class="form-horizontal" id="editProductForm" action="php_action/editProduct.php" method="POST"  enctype="multipart/form-data">
				<div class="tab-content">
					<!-- product image -->
					<div role="tabpanel" class="tab-pane active" id="photo">
						<div class="form-group">
							<label for="editProductImage" class="col-sm-3 control-label">Product Image: </label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-8">							    				   
								<img src="" id="getProductImage" class="thumbnail" style="width:250px; height:250px;" />
							</div>
						</div> <!-- /form-group-->	     	           	       

						<div class="form-group">
							<label for="editProductImage" class="col-sm-3 control-label">Select Photo: </label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-8">
								<!-- the avatar markup -->
								<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
								<div class="kv-avatar center-block">					        
									<input type="file" class="form-control" id="editProductImage" placeholder="Product Name" name="editProductImage" class="file-loading" style="width:auto;"/>
								</div>
							</div>
						</div> <!-- /form-group-->	     	           	       
					</div>
					
					<!-- product image -->
					<div role="tabpanel" class="tab-pane" id="productInfo">
						<div class="form-group">
							<label for="editProductName" class="col-sm-3 control-label">Product Name: </label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="editProductName" placeholder="Product Name" name="editProductName" autocomplete="off">
							</div>
						</div> <!-- /form-group-->	         	        

						<div class="form-group">
							<label for="editBrandName" class="col-sm-3 control-label">Brand Name: </label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-8">
								<select class="form-control" id="editBrandName" name="editBrandName">
									<option value="">~~SELECT~~</option>
									<?php 
										$sql = "SELECT * FROM brand WHERE brand_status = 1";
										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row['id_brand']."'>".$row['brand_name']."</option>";
										} // while							
									?>
								</select>
							</div>
						</div> <!-- /form-group-->	

						<div class="form-group">
							<label for="editCategoryName" class="col-sm-3 control-label">Category Name: </label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-8">
								<select type="text" class="form-control" id="editCategoryName" name="editCategoryName" >
									<option value="">~~SELECT~~</option>
									<?php 
										$sql = "SELECT * FROM category WHERE category_status = 1 AND id_category != 1";
										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row['id_category']."'>".$row['category_name']."</option>";
										} // while
									?>
								</select>
							</div>
						</div> <!-- /form-group-->					        	         	       

						<div class="form-group">
							<label for="editProductStatus" class="col-sm-3 control-label">Status: </label>
							<label class="col-sm-1 control-label">: </label>
							<div class="col-sm-8">
								<select class="form-control" id="editProductStatus" name="editProductStatus">
									<option value="">~~SELECT~~</option>
									<option value="1">Available</option>
									<option value="2">Not Available</option>
								</select>
							</div>
						</div> <!-- /form-group-->	 
					</div> <!-- /product info -->		     	
				</div> <!-- /tab-content --> 
				</form> <!-- /.form -->		
			</div> <!-- /div-result -->
		</div> <!-- /modal-body -->
		
		<div class="modal-footer editProductFooter">
			<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
			<button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
		</div> <!-- /modal-footer -->		      
     	
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