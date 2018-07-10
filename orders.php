<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 
?>

<div class="row">
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Add Orders</div>
		</div> <!-- /panel-heading -->
		
		<div class="panel-body">	
			<div class="success-messages"></div> <!--/success-messages-->

			<div class="form-group">
				<label for="clientContact" class="col-sm-2 control-label">Barcode</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="barcode" name="barcode" onchange="addOrderItem()" placeholder="Barcode Number" autocomplete="off" />
				</div>
			</div> <!--/form-group-->			  

			<table class="table" id="productTable">
			<thead>
				<tr>
					<th style="width:10%;">Barcode</th>
					<th style="width:10%;">Quantity</th>	
					<th style="width:46%;">Product</th>
					<th style="width:12%;">Price</th>	  			
					<th style="width:12%;">Total</th>			  			
					<th style="width:10%;">Vatable</th>
				</tr>
			</thead>  	
			</table>
		  
			<div class="col-md-6">
				<div class="form-group">
					<label for="subTotal" class="col-sm-3 control-label">Vatable Sale</label>
					<div class="col-sm-9">
					  <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
					  <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
					</div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
					<label for="vat" class="col-sm-3 control-label">VAT 12%</label>
					<div class="col-sm-9">
					  <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
					  <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
					</div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
					<label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
					<div class="col-sm-9">
					  <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
					  <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
					</div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
					<label for="discount" class="col-sm-3 control-label">Total Discount</label>
					<div class="col-sm-9">
					  <input type="text" class="form-control" id="discountTotal" name="discountTotal" disabled="true" onkeyup="discountFunc()" autocomplete="off" />
					</div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
					<label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
					<div class="col-sm-9">
					  <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
					  <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
					</div>
				  </div> <!--/form-group-->			  		  
			  </div> <!--/col-md-6-->

			<div class="col-md-6">
			<div class="form-group">
				<label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" />
				</div>
			  </div> <!--/form-group-->			  
			  <div class="form-group">
				<label for="due" class="col-sm-3 control-label">Change</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" id="due" name="due" disabled="true" />
				  <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
				</div>
			  </div> <!--/form-group-->									  						  
			</div> <!--/col-md-6-->


			<div class="form-group submitButtonFooter">
				<div class="col-sm-offset-1 col-sm-10">
				  <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>

				  <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<script src="assests/plugins/datatables plugins/api/fnFindCellRowIndexes.js"></script>
<script src="custom/js/order.js"></script>

<?php require_once 'includes/footer.php'; ?>


	