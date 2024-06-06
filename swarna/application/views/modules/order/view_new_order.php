<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Order #<?php echo $order['Order_Code'];  ?></h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
<!-- search content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div>
				<div >
	<div  class="" data-aos="fade-up">
		
<div id='create-form'>
<!-- <h1 class='h1-title'></h1> -->
<div class="form-div">
	
	<div class="validation-errors"><?php echo validation_errors(); ?></div>
	
		<input type='hidden' id='cust-code-selected' name='Customer_Code_Selected' value='<?php echo $order['Customer_Code']?>' />
		<div class="form-block">
			
			<div class="card"><div class="card-body">
			
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Order Date</label>
					<?php echo date('d-m-Y',strtotime($order['Order_Date'])); 
					$metal_type = ucfirst($order['metal_type']); 
					?>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Order ID</label>
					<?php echo $order['orderid']; ?>
					
				</div>
				
				<div class="form-column">
					<label class="radio-label">Order Status</label>
					<?php echo $order['Order_Status']; ?>
				</div>
				
				<div class="clear"></div>
			</div>
			
			</div></div> <!--card ends-->
			
			<!--customer selection block-->
			<div class="card">
				<div class="card-header"><strong>Customer Details: #<?php echo $customer['Customer_Code']; ?></strong></div>
				<div class="card-body">
			
			<div class="form-row">
				<div class="form-column">
					 
					<strong><?php echo $customer['Customer_Name']; ?></strong><br/>
					<?php echo $customer['Customer_Mobile_Number1']; ?><br/>
					<?php echo $customer['Customer_Email']; ?><br/>
					<?php echo $customer['Customer_Billing_address']; ?><br/>
					<?php echo $customer['Customer_City']." - ".$customer['Customer_Pincode']; ?><br/>
					
				</div>
				<div class="clear"></div>
				
			</div>


			</div></div> <!--card ends-->
			
			<!--items block-->
			<div class="card">
				<div class="card-header"><strong>Order Items</strong> </div>
				<div class="card-body" id="order-items">
					
					<table class="table table-bordered">
                  <thead>
                    <tr>
					           <th>Sl.No</th>
					           <th>J Type</th>
					           <th>Sub J Type</th>
					           <th>J Item</th>
					           <th>Notes</th>
					           <th>Approx. Grams</th>
					           <th>M C(Rs)</th>
					           <th>Wastage </th>
					           <th>Workshop</th>
					           <th>Total Grams</th>
					           <th>&nbsp;</th>
					           <th>Status</th>
					</tr>
				  </thead>
				  <tbody>
					
				  
				
				<?php 
				$i=1;
				$total_req_grams=0;
				$$total_making_charge=0;
				$total_approx_grams=0;
				$total_wastage=0;
				$total_gold_balance=0;
				foreach($order['order_items'] as $item): 
			
				?>
				
					 <tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $item['Category_Name']; ?></td>
						<td><?php echo $item['SubCategory_Name']; ?></td>
						<td><?php echo $item['item_name']; ?></td>
						<td><?php echo $item['notes']; ?></td>
						<td><?php echo $item['approx_grams']; ?></td>
						<td><?php echo $item['making_charges']  ;  ?></td>
						<td><?php echo $item['wastage']; ?></td>
						<td><?php echo $item['Workshop_Name']; ?></td>
					
						<td>
							<?php 
							// if($item['wastage_type']=="percent"){
							// 	$total_grams_row=$item['approx_grams']+($item['approx_grams']*$item['wastage']/100);
							// }
							// else 
							$total_grams_row=$item['approx_grams']+($item['wastage']);
							 echo decimal_number($total_grams_row,3); 
							$total_making_charge+= $item['making_charges'] ;
							$total_req_grams=$total_req_grams+$total_grams_row;
							
							?>
						</td>
						<td>
						<?php if($item['receipt_file']!=""): ?>	
						<img src="<?php echo base_url('uploads/order_receipts/'.$item['receipt_file']); ?>" width=55>
					<?php endif; ?>
					</td>
						<td><?php echo $item['status']; ?></td>
					</tr>
				
				<?php 
				
				$i++;
				$total_approx_grams=$total_approx_grams+ $item['approx_grams']; 
				$total_wastage=$total_wastage+ $item['wastage']; 
				endforeach; ?>
				</tbody>
				 <tfoot style="font-weight:bold">
				<tr>
					<td colspan=5></td>
					
					<td><span id="total_approx_grams"><?php echo number_format((float)$total_approx_grams, 3, '.', ''); ?></span></td>
					<td><span id="making-charges-total"><?php echo number_format((float)$total_making_charge, 2, '.', ''); ?></span> </td>
					<td><span id="total-wastage"><?php //echo number_format((float)$total_wastage, 2, '.', ''); ?></span> </td>
					<td></td>
					<td><span id="total-outstanding-grams"><?php echo number_format((float)$total_req_grams, 3, '.', ''); ?></span> </td>
						
					
					<td></td>
				</tr>
			</tfoot>
			</table>
			
		</div>
		
		
		</div>
			<!-- stones section -->
			<div class="card">
				<div class="card-header"><strong> Stones</strong> </div>
				<div class="card-body" id="order-stones" style="overflow-x:auto;">
				<table class="table table-bordered" id="order-stones-table">
					<tr>
						<td>Stone Type</td>
						<td>Stone Sub Type</td>
						<td>Quantity</td>
						
						<td>Ct/Pc</td>
						<td>Rate per Unit(Rs)</td>
						<td>Total(Rs)</td>
						
					</tr>
				
				<?php 
				
				$scount=0;
				
				$total_stone_cost=0;
				$total_quantity=0;
				$total_stone_size=0;
				
				foreach($order_stones as $ostone): $scount++; 
				
				?>
				
					
		<tr id='stone-row-<?php echo $scount; ?>'>
			 <td>
				 <?php foreach($stone_types as $stype): ?>
					 <?php if($stype['id']==$ostone['stone_type_id']): echo $stype['name']; ?><?php endif; ?>
					<?php endforeach;  ?>
			 </td>
			 
			 <td>
				 <?php foreach($stone_sub_types as $subtype): ?>
					 <?php if($subtype['stone_type_id']==$ostone['stone_type_id']):  echo $subtype['name']; ?><?php endif; ?>
					<?php endforeach; ?>
			 </td>	
			 
			 <td><?php echo $ostone['quantity']; ?></td>
			 
			<td><?php echo $ostone['carat']; ?><span id='unit_id_<?php echo $scount; ?>'><?php echo $ostone['unit']; ?></span>
			<input type="hidden" name="stone[<?php echo $scount; ?>][unit]" id='unit_value_<?php echo $scount; ?>' value="<?php echo $ostone['unit'];; ?>" />
		</td>
			
			<td><?php echo $ostone['rate']; ?></td>	
			   
			    <td id='stone-charges-<?php echo $scount; ?>' class='stone-charges-inr'><?php echo $ostone['rate']*$ostone['carat']; ?></td>
			  
			 </tr>
					
				<?php
				
					$total_stone_cost=$total_stone_cost+($ostone['rate']*$ostone['carat']);
				$total_quantity=$total_quantity+($ostone['quantity']);
				$total_stone_size=$total_stone_size+($ostone['carat']);
				
					endforeach;
					
				?>	
				 <tfoot style="font-weight:bold">
				<tr>
					<td colspan=2></td>
					<td><span id="total_quantity"><?php echo $total_quantity ?></span></td>
					<td><span id="total_stone_size"><?php echo $total_stone_size ?></span></td>
					<td></td>
						<td><span id="total-stone-charges"><?php echo number_format($total_stone_cost, 2); ?></span></td>
					
				</tr>	
				</tfoot>
			</table>
				
				<!--stones block-->
			<input type="hidden" name="stones-count" id="stones-count" value="<?php echo $scount; ?>" />
			
			 </div>
		
			</div> 
			<div class="card">
				<div class="card-header"><strong><?php echo $metal_type; ?> Receipts</strong> </div>
				<div class="card-body" id="gold-receipts" style="overflow-x:auto;">
				<?php if($metal_type=="Gold"){ ?>
				<table class="table table-bordered" id="gold-receipts-table">
					<tr>
						<td>Date</td>
						
						<td>J Item</td>
						<td>Notes</td>
						<!-- <td>Amount</td> -->
						<td>Grams</td>
						<td>Melting Loss/Stones</td>
						<td>Net Gold</td>
						<td>Quality %</td>
						<td>Pure Gold</td>
						<td>Copper@7%</td>
						<td>Final Grams (92.50%)</td>
						<td></td>
					</tr>
					
					<?php 
					
						$count=0;
						$total_receipts=0;
						$total_gold_gram = 0;
						$total_melting_loss=  0;
						$net_gold=  0;
						$total_gold=  0;
						$jwelleryItemsMetal=$this->Order_model->getAllJwelleryItems($metal_type);
						// echo "<pre>";
						// print_r($order['payments']);
					foreach($order['payments'] as $op): 
						if( $op['Payment_Method']=="gold"):
						$count++;
		
						$net_gold_receipt=$op['Grams']-$op['melting_loss'];
						$pure_gold=$net_gold_receipt*($op['Quality']/100);
						
						$copper=$pure_gold*(7/100);
						
						if($op['Payment_Method']=="cash"){
						
							$copper=0;
							
						}
						
						$final_grams= $pure_gold+$copper;
						$final_grams=number_format((float)$final_grams, 2, '.', '');
						$total_receipts=$total_receipts+$final_grams;
						$total_receipts = number_format((float)$total_receipts, 3, '.', '');
						$pure_gold = number_format((float)$pure_gold, 3, '.', '');
						$net_gold_receipt = convert_to_grams($net_gold_receipt);
					?>
					<tr id='receipt-row-<?php echo $count; ?>'>
					<td><?php echo  date("d-m-Y",strtotime($op['payment_date'])); ?></td>
					<td><?php foreach($jwelleryItemsMetal as $scat): ?>
								<?php if($op['item_id']==$scat['item_id']):  echo $scat["item_name"];  endif; ?>
							<?php endforeach; echo $op['item_id']; ?></td>
					<!-- <td><?php echo $op['Payment_Method']; ?></td>
						 -->
						<td><?php echo $op['notes']; ?></td>
						<!-- <td>
							<?php echo $op['total_amount']; ?>
						</td> -->
						<td>
							<?php echo $op['Grams']; ?>
						</td>
						<td>
							<?php echo $op['melting_loss']; ?>
						</td>
						<td id="net-deposit-grams-<?php echo $count; ?>"><?php echo $net_gold_receipt; ?></td>
						<td><?php echo $op['Quality']; ?></td>
						<td id="pure-gold-grams-<?php echo $count; ?>"><?php echo $pure_gold; ?></td>
						<td id="copper-grams-<?php echo $count; ?>"><?php echo $copper; ?></td>
						<td id="final-receipt-grams-<?php echo $count; ?>"><?php echo number_format((float)$final_grams, 3, '.', ''); ?></td>
						<td>
						<?php if($op['receipt_file']!=""): ?>	
						<img src="<?php echo base_url('uploads/order_receipts/'.$op['receipt_file']); ?>" width=55>
					<?php endif; ?>
					</td>
					</tr>
					<?php 
				$total_gold_gram=$total_gold_gram+$op['Grams'];
				$total_melting_loss=$total_melting_loss+ ($op['melting_loss']);
				$net_gold=$net_gold+ (($op['Grams']-$op['melting_loss']));
				$total_gold=$total_gold+ (($op['Grams']-$op['melting_loss'])*$op['Quality']/100);
				$total_gold = convert_to_grams($total_gold);
				$net_gold = convert_to_grams($net_gold);
				$total_gold_gram = convert_to_grams($total_gold_gram);
				$total_melting_loss = convert_to_grams($total_melting_loss);
					endif;
				endforeach; ?>
				 <tfoot style="font-weight:bold">
					<tr>
						<td colspan=3></td>
						
						<td><span id="total_gold_grams"><?php echo $total_gold_gram; ?></span></td>
						<td><span id="gold_melting_loss"><?php echo $total_melting_loss; ?></span></td>
						<td><span id="net_gold"><?php echo $net_gold; ?></span></td>
						<td></td>
						 <td><span id="total-pure-receipts"><?php echo $total_gold; ?></span> </td>
						 <td></td>
						 <td><span id="total-gold-receipts"><?php echo $total_receipts; ?></span> </td>
						<td colspan=2></td>
					</tr>
			</tfoot>
				</table>
			<?php }
			else{
				?>
				<table class="table table-bordered" >
					<tr>
						<td>Type</td>
						
						<td>Notes</td>
						<td>Amount</td>
						<td>Grams</td>
						<td>Melting Loss/Stones</td>
						<td>Net <?php echo $metal_type; ?></td>
						<td>Quality %</td>
						<td>Pure <?php echo $metal_type; ?></td>
						<td>Final Grams </td>
						
					</tr>
					
					<?php 
					
						$count=0;
						$total_receipts=0;
						
						$total_silver=0;
						$total_silver_gram=0;
						$total_melting_loss=0;
						$net_silver=0;
					foreach($order['payments'] as $op): 
						if( $op['Payment_Method']=="silver"):
						$quality = $op['Quality'];
						$count++;
		
						$net_gold_receipt=$op['Grams']-$op['melting_loss'];
						$pure_gold=$net_gold_receipt*($op['Quality']/100);
						
						$copper=$pure_gold*(7/100);
						
						if($op['Payment_Method']=="cash"){
						
							$copper=0;
							$quality = 100.00;
							$pure_gold = $op['Grams'];
						}
						
						$final_grams= $pure_gold;

						$total_receipts=$total_receipts+$final_grams;
						$total_receipts = number_format((float)$total_receipts, 3, '.', '');
					?>
					<tr id='receipt-row-<?php echo $count; ?>'>
					<td><?php echo $op['Payment_Method']; ?></td>
						
						<td><?php echo $op['notes']; ?></td>
						<td>
							<?php echo $op['total_amount']; ?>
						</td>
						<td>
							<?php echo $op['Grams']; ?>
						</td>
						<td>
							<?php echo $op['melting_loss']; ?>
						</td>
						<td id="net-grams-<?php echo $count; ?>"><?php echo $net_gold_receipt; ?></td>
						<td><?php echo $quality; ?></td>
						<td id="pure-grams-<?php echo $count; ?>"><?php echo $pure_gold; ?></td>
						<td id="final-grams-<?php echo $count; ?>"><?php echo number_format((float)$final_grams, 2, '.', '');; ?></td>
						
					</tr>
					<?php 
				$total_silver_gram=$total_silver_gram+$op['Grams'];
				$total_melting_loss=$total_melting_loss+ ($op['melting_loss']);
				$net_silver=$net_silver+ (($op['Grams']-$op['melting_loss']));
				$total_silver=$total_silver+ (($op['Grams']-$op['melting_loss'])*$op['Quality']/100);
					endif;
				endforeach; ?>
				 <tfoot style="font-weight:bold">
					<tr>
						<td colspan=3></td>
						
						<td><span id="total_silver_grams"><?php echo decimal_number($total_silver_gram,2) ?></span></td>
						<td><span id="total_melting_loss"><?php echo decimal_number($total_melting_loss,2) ?></span></td>
						<td><span id="net_silver"><?php echo decimal_number($net_silver,2) ?></span></td>
						<td></td>
						
						 <td><span id="total-silver-receipts"><?php echo $total_receipts; ?></span> </td>
						
						<td ><?php echo $total_receipts; ?></td>
					</tr>
			</tfoot>
				</table>
				<?php
			} ?>
			</div>
			
			
		</div>
		<!-- Cash block -->
		<div class="card">
			
				<div class="card-header"><strong> Cash Receipts</strong>  </div>
				<div class="card-body" id="cash-receipts">
				<table class="table table-bordered" id="cash-receipts-table">
					<tr>
						<td>Date</td>
						<td>Type</td>
						<td>Notes</td>
						<td>Amount</td>
						 <td>Grams</td>
						
					</tr>
					
					<?php 
					
						$count=0;
						$total_cash_grams = 0;
						$total_cash_amt = 0;
					foreach($order['payments'] as $op): 
						
					if($op['Payment_Method']=="cash" ):
						if($op['payment_for']=="gram_charge" ):
						$count++;
					?>
					<tr id='receipt-cash-<?php echo $count; ?>'>
						<td><?php echo date("d-m-Y",strtotime($op['payment_date'])); ?></td> 
						
						<td><?php echo $op['txn_type']; ?></td>
						<td><?php echo $op['notes']; ?></td>
						
						<td>
							<?php if($op['Payment_Method']=='cash'): ?>
								<?php echo $op['total_amount']; ?>
							
							<?php endif; 
							
							 $total_cash_amt = $total_cash_amt+$op['total_amount'];
							?>
						</td>
 						
						<td>
							<?php echo convert_to_grams($op['Grams']); ?>
							<?php $total_cash_grams = $total_cash_grams+$op['Grams']; ?>
						</td>
	
					</tr>
					<?php 
					endif; 
					endif; 
					
				endforeach; 
				$total_cash_grams = convert_to_grams($total_cash_grams);
					$total_cash_amt = number_format($total_cash_amt, 2);?>
				<tfoot style="font-weight:bold">
					<tr>
						<td colspan=3></td>
						
						<td><span id="total_cash_amount"><?php echo $total_cash_amt ?></span></td>
						 <td><span id="total-cash-receipts"><?php echo $total_cash_grams ?></span></td>
						
					</tr>
			</tfoot>
				</table>
				
			</div> <!--cash card ends-->
			<!--receipts block-->
			<input type="hidden" name="cash-count" id="cash-count" value="<?php echo $count; ?>" />
			
			
		</div>
			<!-- Cash block -->
		<div class="card">
				
				
				<div class="card-header"><strong> Making charge Receipts</strong>  </div>
					
				<div class="card-body" id="making_charge-receipts" style="overflow-x:auto;">
				<table class="table table-bordered" id="making-charge-table">
					<tr>
					
						<td>Date</td>
						<td>Payment Type</td>
						<td>Notes</td>
						<td>Amount</td>
						
					</tr>
					<?php 
					
					$mcount=0;
					
					$total_making_amt = 0;
				foreach($order['payments'] as $op): 
					
				if($op['Payment_Method']=="cash" ):
					if($op['payment_for']=="making_charge" ):
					$mcount++;
				?>
				<tr id='receipt-making-<?php echo $mcount; ?>'>
					<td><?php echo date("d-m-Y",strtotime($op['payment_date'])); ?></td> 
					<input  type='hidden' class='form-input ' name='making_receipt[<?php echo $mcount; ?>][payment_date]' id='date-cash-<?php echo $mcount; ?>]' value='<?php echo date("Y-m-d")?>' required />
					<input  type='hidden' class='form-input ' name='making_receipt[<?php echo $mcount; ?>][Quality]'  value='100' required />
					<input  type='hidden' class='form-input ' name='making_receipt[<?php echo $mcount; ?>][copper]'  value='0' required />
					<td><?php echo $op['txn_type']; ?></td>
					<td><?php echo $op['notes']; ?>
					
					<td>
						<?php if($op['Payment_Method']=='cash'): ?>
							<?php echo $op['total_amount']; ?>
							
						<?php else: ?>
						<input type="hidden" name="making_receipt[<?php echo $count; ?>][Payment_Method]" id="receipt-type-<?php echo $mcount; ?>" value="gold">
						<?php endif; 
						$total_making_amt = $total_making_amt+$op['total_amount'];
						?>
					</td>
					
					
				</tr>
				<?php 
				endif; 
				endif; 
			endforeach; ?>
			<tfoot>
					<tr  style="font-weight:bold">
						<td colspan=3></td>
						
						<td><span id="total_making_amount"><?php echo number_format($total_making_amt, 2); ?></span></td>
						
						 <input type="hidden" name="making-count" id="making-count" value="<?= $mcount ?>" />
						
					</tr>
		</tfoot>
				</table>
			
			</div>
			
			<!-- <div class="card-body text-right">
			
			<strong>Total Cash Receipts: </strong> <span id="total-cash-receipts">0</span> Grams
			
			</div> -->
		</div>
			<!-- Cash block End-->
			<!-- Cash block -->
		<div class="card">
				
				
				<div class="card-header"><strong> Stone charge Receipts</strong> </div>
					
				<div class="card-body" id="stone_charge-receipts" style="overflow-x:auto;">
				<table class="table table-bordered" id="stone-charge-table">
					<tr>
					
						<td>Date</td>
						<td>Payment Type</td>
						<td>Notes</td>
						<td>Amount</td>
						
					</tr>
					<?php 
					
					$mcount=0;
					$total_stone_amount = 0;
				foreach($order['payments'] as $op): 
					
				if($op['Payment_Method']=="cash" ):
					if($op['payment_for']=="stone_charge" ):
					$mcount++;
				?>
				<tr id='receipt-making-<?php echo $mcount; ?>'>
					<td><?php echo date("d-m-Y",strtotime($op['payment_date'])); ?>
					
					</td> 
					<td><?php echo $op['txn_type']; ?></td>
					<td><?php echo $op['notes']; ?></td>
					
					<td>
						<?php if($op['Payment_Method']=='cash'): ?>
							<?php echo $op['total_amount']; ?>
						<?php else: ?>
						
						<?php endif; 
						
						?>
					</td>
					
					
				</tr>
				<?php 
				 $total_stone_amount = $total_stone_amount+$op['total_amount'];
				endif; 
				endif; 
			endforeach; ?>
			<tfoot>
					<tr  style="font-weight:bold">
						<td colspan=3></td>
						
						<td><span id="total_stone_amount"><?php echo number_format($total_stone_amount,2) ?></span></td>
						 <td><span id="total-stone-receipts"></span><input type="hidden" name="stone-count" id="stone-count" value="<?= $mcount ?>" /> </td>
						
					</tr>
		</tfoot>
				</table>
			
			</div>
			
		</div>
			<!-- Cash block End-->
			<div class="form-block">
				<div class="card">
					<div class="card-body text-right">
						<div class="form-row" style="float: right;">
						<div class="form-column">
								<!-- <strong>Oustanding Grams: </strong> --><span style="color:red;" > <?php echo decimal_number($total_req_grams-$total_receipts-$total_cash_grams,3); ?> Grams</span>  
							</div>
							<div class="form-column">
							<!-- <strong>SC: </strong>  -->
							<span style="color:red;" >Rs <?php echo decimal_number($total_stone_cost-$total_stone_amount,2); ?> </span> 
							</div>
						
							<div class="form-column">
								<!-- <strong>MC: </strong> -->
								 <span style="color:red;" >Rs <?php echo decimal_number($total_making_charge-$total_making_amt,2); ?> </span> 
							</div>
						
							
						
							
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			
			<div class="card"><div class="card-body">
			
			<div class="form-row blocks-right">
					
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("order/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
			
			</div></div> <!--card ends-->
			
		</div>
	
	</div>
</div>


	</div>
</div>
</div></div></div></div>
</section>
</div>


