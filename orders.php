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
				<div class="col-sm-4">
					<img class='img-round' src="\assests\images\photo_default.png" style='height:80%; width:80%;'  />
					<div class="row" style="margin-top:5px">
					<div class="form-group">
						<label for="paid" class="col-xs-4 control-label">Paid Amount</label>
						<div class="col-xs-6">
							<input type="number" step="0.01" min="0" style="text-align: right" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" />
						</div>
					</div> <!--/form-group-->
					</div>
					<div class="row" style="margin-top:5px">
					<div class="form-group">
						<label for="change" class="col-xs-4 control-label">Change</label>
						<div class="col-xs-6">
							<input type="text" style="text-align: right" class="form-control" id="change" name="change" disabled="true" />
							<input type="hidden" class="form-control" id="changeVal" name="changeVal" />
						</div>
					</div> <!--/form-group-->
					</div>
					<div class="row" style="margin-top:5px">
					<div class="form-group">
							<div class="col-xs-4" style="margin-top:5px">
								<button class="btn btn-default" style="width:140px" id="finalize" onclick="computeTotal()"> <i class="glyphicon glyphicon-ok"></i> Finalize </button>
							</div>				
					</div> <!-- /form-group-->	
					</div>					
				</div>
				
				<div class="col-sm-8">
					<input type="text" class="form-control" id="barcode" name="barcode" onchange="addOrderItem()" placeholder="Barcode Number" autocomplete="off" />
					<br>
					<table class="table" id="productTable">
						<thead>
							<tr>
								<th style="width:10%;">Barcode</th>
								<th style="width:10%;">Qty</th>	
								<th style="width:46%;">Product</th>
								<th style="width:12%;">Price</th>	  			
								<th style="width:12%;">Total</th>			  			
								<th style="width:10%;">Vat</th>
							</tr>
						</thead>  	
					</table>
					
					<div class="form-group">	
						<div class="form-group">
							<label for="subTotal" class="col-xs-3 control-label">Vatable</label>
							<div class="col-xs-3" style="margin-top:5px">
								<input type="text" style="text-align: right" class="form-control" id="vatable" name="vatable" disabled="true" />
								<input type="hidden" class="form-control" id="vatableValue" name="vatableValue" />
							</div>
						</div> <!--/form-group-->
						<div class="form-group">
							<label for="discount" class="col-xs-3 control-label">Discount</label>
							<div class="col-xs-3" style="margin-top:5px">
								<input type="number" step="0.01" min="0" style="text-align: right" class="form-control" id="discountTotal" name="discountTotal"  onkeyup="computeTotal()" onchange="computeTotal()" autocomplete="off" />
							</div>
						</div> <!--/form-group-->	
						<div class="form-group">
							<label for="vat" class="col-xs-3 control-label">VAT 12%</label>
							<div class="col-xs-3" style="margin-top:5px">
								<input type="text" style="text-align: right" class="form-control" id="vat" name="vat" disabled="true" />
								<input type="hidden" class="form-control" id="vatValue" name="vatValue" />
							</div>
						</div> <!--/form-group-->
						<div class="form-group">
							<label for="discount_reason" class="col-xs-3 control-label" >Discount Reason </label>
							<div class="col-xs-3" style="margin-top:5px">
								<select class="form-control" id="discount_reason" name="discount_reason" onchange="computeTotal()">
									<option value="">~~SELECT~~</option>
			  						<?php
			  							$sql = "SELECT * FROM discount_reason";
			  							$productData = $connect->query($sql);

			  							while($row = $productData->fetch_array()) {									 		
			  								echo "<option value='".$row['id_discount_reason']."'>".$row['name']."</option>";
										 	} // /while 

			  						?>
								</select>
							</div>
						</div> <!-- /form-group-->
						<div class="form-group">
							<label for="subTotal" class="col-xs-3 control-label">Non-Vatable</label>
							<div class="col-xs-3" style="margin-top:5px">
								<input type="text" style="text-align: right" class="form-control" id="nonVatable" name="nonVatable" disabled="true" />
								<input type="hidden" class="form-control" id="nonVatableValue" name="nonVatableValue" />
							</div>
						</div> <!--/form-group-->
						<div class="form-group">
							<label for="grandTotal" class="col-xs-3 control-label">Grand Total</label>
							<div class="col-xs-3" style="margin-top:5px">
								<input type="text" style="text-align: right" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
								<input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
							</div>
						</div> <!--/form-group-->
						<div class="form-group">
							<label for="totalAmount" class="col-xs-3 control-label">Total</label>
							<div class="col-xs-3" style="margin-top:5px">
								<input type="text" style="text-align: right" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
								<input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
							</div>
						</div> <!--/form-group-->									  				
					</div>
				</div> <!--/col-md-6-->								  						  
			</div>
			
			<div class="form-group submitButtonFooter">
				<div class="col-sm-10" style="margin-top:5px">
				  <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Checkout </button>
				  <button type="reset" class="btn btn-default" onclick="initialize()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<script src="assests/plugins/datatables plugins/api/fnFindCellRowIndexes.js"></script>
<script src="custom/js/order-add.js"></script>

<?php require_once 'includes/footer.php' ?>


	