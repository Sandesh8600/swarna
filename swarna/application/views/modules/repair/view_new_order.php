<?php
$txn_array = array("Cash","Online","Cheque"); 
 $order_type = $order['order_type']; 
 $repair="repair";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Order #<?php echo $order['Order_Code']; ?></h1>
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
					<?php echo date('d-m-Y',strtotime($order['Order_Date'])); ?>
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
                    <tr style="font-weight:bold">
					           <th>Sl.No</th>
					           <th>J Type</th>
					           <th>J Sub Type</th>
							   <td>J Item</td>
					           <th>Notes</th>
					           <th>NW</th>
							   <td>NW after repair</td>
							   <td>Gold Added</td>
					           
					           <th>Wastage </th>
							   <td>Balance Gold (Grams )</td>
							   <th>MC</th>
					           <th>Workshop</th>
					           <th><img src="<?php echo base_url('images/image_icon.png');?>" width=25></th>
					           <th>Status</th>
					</tr>
				  </thead>
				  <tbody>
					
				  
				
				<?php 
				$i=1;
				$total_req_grams=0; 
				
				$total_making_charges=0;
				$total_approx_grams=0;
				$total_nw_after_repair=0;
				$total_wastage=0;
				$total_gold_balance=0;
				foreach($order['order_items'] as $item): 
					$jwelleryItems=$this->Repair_model->getJwelleryItems($item['SubCategory_ID']);
					
					foreach($jwelleryItems as $scat): 
						 if($item['item_id']==$scat['item_id']):  
							$item_name = $scat["item_name"]; 
						endif; 
					 endforeach; 
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $item['Category_Name']; ?></td>
						<td><?php echo $item['SubCategory_Name']; ?></td>
						<td><?php echo $item_name; ?></td>
						<td><?php echo $item['notes']; ?></td>
						<td><?php echo $item['approx_grams']; ?></td>
						<td><?php echo $item['nw_after_repair']; ?></td>
						<td><?php echo $item['nw_after_repair']-$item['approx_grams']; ?></td>
						<td><?php echo $item['wastage']; ?></td>
						<td><?php echo $item['gold_balance']; ?></td>
						<td>
						<?php echo $item['making_charges']; 
						
						?>
						</td>
						<td><?php echo $item['Workshop_Name']; ?></td>
					
						
						<td>
							<?php  echo ($item['receipt_file']!="") ? "<a target='_blank' href='".site_url("uploads/order_receipts/".$item['receipt_file'])."' data-lightbox='example-1' class='example-image-link'><img src='".site_url("uploads/order_receipts/".$item['receipt_file'])."' height='20px'></a>" : "" ?>
						</td>
						<td><?php echo $item['status']; ?></td>
					</tr>
				
				<?php 
				$total_gold_balance=$total_gold_balance+ $item['gold_balance']; 
				$row_making_charges= $item['making_charges'] ; 
						
				$row_making_charges = round($row_making_charges,2);
				
				$total_making_charges=$total_making_charges+$row_making_charges;
				$i++;
				$total_grams_row= $item['nw_after_repair']-$item['approx_grams'] +$item['wastage']+ $total_grams_row; 
				$total_approx_grams=$total_approx_grams+ $item['approx_grams']; 
				$total_nw_after_repair=$total_nw_after_repair+ $item['nw_after_repair']; 
				$total_gold_added_grams=$total_gold_added_grams+  $item['nw_after_repair']-$item['approx_grams'] ;
				$total_wastage=$total_wastage+ $item['wastage']; 
				
				endforeach; ?>
				
				</tbody>
				<tfoot>
				<tr style="font-weight:bold">
					<td colspan=5></td>
					
					<td><span id="total_approx_grams"><?php echo number_format((float)$total_approx_grams, 3, '.', '') ?></span></td>
					<td><span id="nw_repair_grams"><?php echo number_format((float)$total_nw_after_repair, 3, '.', '') ?></span></td>
					<td><span id="gold_added_grams"><?php echo number_format((float)$total_gold_added_grams, 3, '.', '') ?></span></td>
					<?php 
							if($order_type==$repair){
						?>
						<td class='hide_class'> </td>
						
						<td  class='hide_class'><span id="total-outstanding-grams"><?php echo number_format((float)$total_gold_balance, 3, '.', ''); ?></span> </td>
						<?php } ?> 
						<td><span id="making-charges-total"><?php echo number_format((float)$total_making_charges, 2, '.', ''); ?></span> </td>
					
					<td colspan="3"></td>
				</tr>
				<tr style="font-weight:bold">
					<td colspan=4></td>
					
					<td colspan="3"><span class="metal_name"> <?php echo $metal_type ?></span> Rate (Rs)</td>
					<td colspan="3"><span class='metal_type'><?php echo ($metal_type=="gold") ? $order['rate_per_gram'] : $order['rate_per_gram_silver']; ?></span> </td>
					<td class='hide_class'> </td>
				
					<td> </td>
					
				</tr>
				<tr style="font-weight:bold">
					<td colspan=4></td>
					
					<td colspan="3">Balance</td>
					<td colspan="3"><span id='prev_bal'>
						<?php 
						$balance = ($order['rate_per_gram']*$total_gold_balance)+$total_making_charges;
						echo  number_format((float)$balance, 2, '.', ''); ?></span> 
					</td>
					<td class='hide_class'> </td>
				
					<td> </td>
					
				</tr>
				<tfoot>
				   </table>
			
			</div>
			
			<!-- <div class="card-body text-right">
			
			<strong>Total Required Grams: </strong> <span id="total-outstanding-grams"><?php echo $total_req_grams; ?></span>
			
			</div> -->
		</div>
			
		<?php
				// $metal_type = $order["metal_type"];
				if($metal_type=="gold"){
			?>
			<div class="card">
				<div class="card-header"><strong> Gold Receipts</strong> 
					
					
				</div>
				<div class="card-body" id="gold-receipts">
				<table class="table table-bordered" id="gold-receipts-table">
					<tr>
						
						<td>Date</td>
						
						<td>J Item</td>
						<td>Notes</td>
						<td>Grams</td>
						<td>Melting Loss/Stones</td>
						<td>Net Gold</td>
						<td>Quality %</td>
						<td>Pure Gold</td>
						<td>Copper @7%</td>
						<td>Final Grams (92.50%)</td>
						<td><img src="<?php echo base_url('images/image_icon.png');?>" width=25> </td>
						
					</tr>
					
					<?php 
					
						$count=0;
						$total_gold_gram = 0;
						$total_melting_loss=  0;
						$net_gold=  0;
						$total_gold=  0;
						$jwelleryItemsMetal=$this->Order_model->getAllJwelleryItems($metal_type);
					foreach($order['payments'] as $op): 
						$sub_cats_metal=$this->Order_model->get_subcats_by_cat($op['Category_ID']);
						
					if( $op['Payment_Method']=="gold"):
						
						$count++;
					?>
					<tr id='receipt-row-<?php echo $count; ?>'>
						<td><?php echo $gold_date =  date("d-m-Y",strtotime($op['payment_date'])); ?>
							
						</td>
					
						<td>
							
						<?php foreach($jwelleryItemsMetal as $scat): ?>
								 <?php if($op['item_id']==$scat['item_id']):  echo $scat["item_name"]; endif;?>
							<?php endforeach; ?>
							
						</td>
						<!-- <td><?php echo $op['Payment_Method']; ?></td> -->
						<td>
							<?php echo $op['notes']; ?>
						</td>
						
						<td>
							<?php echo $op['Grams']; ?>
						</td>
						<td>
							<?php echo $op['melting_loss']; ?>
						</td>
						<td id="net-deposit-grams-<?php echo $count; ?>" class='net_gold_column_class'><?php  $net_gold = $op['Grams']-$op['melting_loss'];
						echo convert_to_grams($net_gold);
						?></td>
						<td><?php echo $op['Quality']; ?></td>
						<td id="pure-gold-grams-<?php echo $count; ?>"  class='final_gold_column_class'><?php
						 $pure_gold = ($net_gold*  $op['Quality']/100); 
						 echo convert_to_grams($pure_gold);
						?>
						</td>
						<td id="copper-grams-<?php echo $count; ?>"><?php
						 $copper=$pure_gold*(7/100);
						echo convert_to_grams($copper);
						$final_grams= $pure_gold+$copper;
						$final_grams = convert_to_grams($final_grams);
						 ?></td>
						<td id="final-receipt-grams-<?php echo $count; ?>"><?= ($final_grams) ?></td>
						<td>
							<?php  echo ($op['receipt_file']!="") ? "<a target='_blank' href='".site_url("uploads/order_receipts/".$op['receipt_file'])."' data-lightbox='example-1' class='example-image-link'><img src='".site_url("uploads/order_receipts/".$op['receipt_file'])."' height='20px'></a>" : "" ?>
						</td>
						
					</tr>
					<?php 
				$total_gold_gram=$total_gold_gram+$op['Grams'];
				$total_melting_loss=$total_melting_loss+ ($op['melting_loss']);
				$net_gold=$net_gold+ (($op['Grams']-$op['melting_loss']));
				$total_gold=$total_gold+ (($op['Grams']-$op['melting_loss'])*$op['Quality']/100);
				$total_final_grams = $final_grams+ $total_final_grams;
				endif; endforeach; ?>
				<tfoot>
					<tr>
						<td colspan=3></td>
						
						<td><span id="total_gold_grams"><?php echo convert_to_grams($total_gold_gram); ?></span></td>
						<td><span id="gold_melting_loss"><?php //echo $total_melting_loss; ?></span></td>
						<td><span id="net_gold"><?php echo convert_to_grams($net_gold); ?></span></td>
						<td></td>
						 <td><span id="total-pure-receipts"><?php echo convert_to_grams($total_gold); ?></span> </td>
						 <td></td>
						 <td><span id="total-gold-receipts"><?= convert_to_grams($total_final_grams) ?></span> </td>
						<td colspan=2></td>
					</tr>
			</tfoot>
				</table>
				</div>
				<input type="hidden" name="receipt-count" id="receipt-count" value="<?php echo $count; ?>" />

				
			</div> <!--card ends-->
			<?php } ?>
		</div>
		<!--silver receipt block-->
		<?php if($metal_type=="silver"){ ?>
			<div class="card">
				<div class="card-header"><strong> Silver Receipts</strong> 
				
				</div>
				<div class="card-body" id="silver-receipts" style="overflow-x:auto;">
				<table class="table table-bordered" id="silver-receipts-table">
					<tr>
						<td>Date</td>
						
						<td>J Item</td>
						<td>Notes</td>
						<td>Grams</td>
						<td>Melting Loss</td>
						<td>Net Silver</td>
						<td>Quality %</td>
						<td>Pure Silver</td>
						<td> </td>
						<td>Action</td>
					</tr>
					
					<?php 
					
						$silver_count=0;
						$total_silver=0;
						$total_silver_gram=0;
						$total_melting_loss=0;
						$net_silver=0;
						$jwelleryItemsMetal=$this->Order_model->getAllJwelleryItems($metal_type);
					
						
					foreach($order['payments'] as $op): 
						$sub_cats_metal=$this->Order_model->get_subcats_by_cat($op['Category_ID']);
						
					if($op['Payment_Method']=="silver"):
						
						$silver_count++;
					?>
					
					<tr id='silver-receipt-row-<?php echo $silver_count; ?>'>
						<td>
							<?php echo date("d-m-Y",strtotime($op['payment_date'])); ?><input  type='hidden' class='form-input ' name='silver_receipt[<?php echo $silver_count; ?>][payment_date]' id='date-silver-<?php echo $silver_count; ?>' value='<?php echo $op['payment_date'] ?>' required />
						</td>
						
						<td>
							<select class='form-select input-micro-width' name='silver_receipt[<?php echo $count; ?>][item_id]' id='jitem_id-<?php echo $count; ?>'  >
						<?php foreach($jwelleryItemsMetal as $scat): ?>
								<option value="<?php echo $scat["item_id"]; ?>" <?php if($item['item_id']==$scat['item_id']): ?>selected="selected"<?php endif; ?>><?php echo $scat["item_name"]; ?></option>
							<?php endforeach; ?>
							</select>
							<input type="hidden" name="silver_receipt[<?php echo $silver_count; ?>][Payment_Method]" value="<?php echo $op['Payment_Method']; ?>" >
						</td>
						<!-- <td><?php echo $op['Payment_Method']; ?>
							
						</td> -->
						<td>
							<input placeholder="Notes.." type="text" class="form-input input-micro-width" name="silver_receipt[<?php echo $silver_count; ?>][notes]" id="additional-notes-silver-deposit-<?php echo $silver_count; ?>" value="<?php echo $op['notes']; ?>">
						</td>
						
						<td>
							<input placeholder="Grams" type="number" class="form-input input-micro-width valid gram_input_column_class" style='width:70px !important;' name="silver_receipt[<?php echo $silver_count; ?>][Grams]" id="silver-receipt-grams-<?php echo $silver_count; ?>" value="<?php echo $op['Grams']; ?>" oninput="calculate_silver_receipt_grams(<?php echo $silver_count; ?>);" >
						</td>
						<td>
							<input placeholder="Melting Loss (gms)" type="number" class="form-input input-micro-width valid melting_input_column_class" style='width:50px !important;' name="silver_receipt[<?php echo $silver_count; ?>][melting_loss]" id="silver-melting-loss-<?php echo $silver_count; ?>" value="<?php echo $op['melting_loss']; ?>" oninput="calculate_silver_receipt_grams(<?php echo $silver_count; ?>);"  >
						</td>
						<td ><input id="net-silver-deposit-grams-<?php echo $silver_count; ?>" class="silver_deposit_column_class" value="<?php echo  $op['Grams']-$op['melting_loss']; ?>" disabled style='width: 65px;'></td>
						
						<td><input placeholder="Quality %" type="number" class="form-input input-micro-width valid" style='width:50px !important;' name="silver_receipt[<?php echo $silver_count; ?>][Quality]" id="silver-quality-<?php echo $silver_count; ?>" value="<?php echo $op['Quality']; ?>" oninput="calculate_silver_receipt_grams(<?php echo $silver_count; ?>);" ></td>
						
						<td id="pure-silver-grams-<?php echo $silver_count; ?>"><?php echo  ($op['Grams']-$op['melting_loss'])*$op['Quality']/100; ?></td>
						<td>
							<?php echo ($op['receipt_file']!="") ? "<a  target='_blank' href='".site_url("uploads/order_receipts/".$op['receipt_file'])."' data-lightbox='example-1' class='example-image-link'><img src='".site_url("uploads/order_receipts/".$op['receipt_file'])."' height='20px'></a>" : "" ?> 
							<div class="custom-file" id="silverFile<?php echo $silver_count; ?>"><input type='file'  accept='png,jpe?g,gif,jpg' name='receipt_silver_file[<?php echo $silver_count; ?>]' class="custom-file-input" /><label class="custom-file-label" for="silverFile<?php echo $silver_count; ?>"></label></div>
							<input type="hidden"  name="silver_receipt[<?php echo $silver_count; ?>][receipt_file]" value="<?php echo $op['receipt_file']; ?>">
						</td>
						<td>
							<input type="button" class="form-button small-button bg-red valid" name="remove_silver_receipt_<?php echo $silver_count; ?>" id="remove-silver-receipt-<?php echo $silver_count; ?>" value="x" onclick="remove_silver_receipt('silver-receipt-row-<?php echo $silver_count; ?>')" >
							<input type="hidden" id="total-final-silver-receipt-grams-<?php echo $silver_count; ?>" name="total_final_silver_receipt_grams[]" value="<?php echo  ($op['Grams']-$op['melting_loss'])*$op['Quality']/100; ?>">
						</td>
					</tr>
					
						<?php 
						
						$total_silver_gram=$total_silver_gram+$op['Grams'];
						$total_melting_loss=$total_melting_loss+ ($op['melting_loss']);
						$net_silver=$net_silver+ (($op['Grams']-$op['melting_loss']));
						$total_silver=$total_silver+ (($op['Grams']-$op['melting_loss'])*$op['Quality']/100);
						
						
						endif; endforeach; ?>
						<tfoot>
					<tr>
						<td colspan=3></td>
						
						<td><span id="total_silver_grams"><?php echo $total_silver_gram ?></span></td>
						<td><span id="total_melting_loss"><?php echo $total_melting_loss ?></span></td>
						<td><span id="net_silver"><?php echo $net_silver ?></span></td>
						<td></td>
						
						 <td><span id="total-silver-receipts"><?php echo $total_silver; ?></span> </td>
						
						<td colspan=2></td>
					</tr>
					</tfoot>
				</table>
				
				<input type="hidden" name="silver-receipt-count" id="silver-receipt-count" value="<?php echo $silver_count; ?>" />
			
			</div>
			
			
		</div>
			<?php }?>
			<!--silver receipt block ends-->
		<div class="card">
				<?php $rate_per_gram =0;
					if($metal_type=="gold"){
						$rate_per_gram_silver=0;
						$rate_per_gram= $rate_per_gram_gold;
					}
					else {
						$rate_per_gram_gold=0;
						$rate_per_gram= $rate_per_gram_silver;
					}
				?>
				
				<div class="card-header"><strong> Cash Receipts</strong>  </div>
				<div class="card-body" id="cash-receipts" style="overflow-x:auto;">
				<table class="table table-bordered" id="cash-receipts-table">
					<tr>
					
						<td>date</td>
						<td>Payment Type</td>
						<td>Notes</td>
						<td>Amount</td>
						
					</tr>
					<?php 
					
						$count=0;
						$total_cash_grams = 0;
						$total_cash_amt = 0;
					foreach($order['payments'] as $op): 
					
					if($op['Payment_Method']=="cash" ):
						
						$count++;
					?>
					<tr id='receipt-row-<?php echo $count; ?>'>
						<td><?php echo date("d-m-Y",strtotime($op['payment_date'])); ?></td> 
						
						<td><?php echo $op['Payment_Method']; ?></td>
						<td><?php echo $op['notes']; ?></td>
						
						<td>
							<?php if($op['Payment_Method']=='cash'): ?>
								<?php echo $op['total_amount']; ?>
							<?php endif; 
							$total_cash_amt = $total_cash_amt+$op['total_amount'];
							?>
						</td>
 						
					</tr>
					<?php endif; endforeach; ?>
					
					<tr  style="font-weight:bold">
						<td colspan=3></td>
						
						<td><span id="total_cash_amount"><?php echo  number_format((float)$total_cash_amt, 2, '.', '') ?></span></td>
						
					</tr>
					
				</table>
			
			</div>
			<div class="card">
				
				<div class="card-header"> </div>
				<div class="card-body"  style="overflow-x:auto;">
				<table class="table table-bordered">
					
					<tr  style="font-weight:bold">
						<td colspan=6><strong> Remaining Balance</strong></td>
						
						 <td><span id="total-remaining-balance"><?php 
						$remaining_balance = ($order['rate_per_gram']*$total_gold_balance)+$total_making_charges-$total_cash_amt - ($order['rate_per_gram'] * $total_silver)  - ($order['rate_per_gram'] * $total_final_grams);
						echo  number_format((float)$remaining_balance, 2, '.', ''); ?></span> </td>
						
						<td></td>
					</tr>
				</table>
			
			</div>
		
			
			<div class="card"><div class="card-body">
			
			<div class="form-row blocks-right">
					
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("repair/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
			
			</div></div> <!--card ends-->
			
		</div>
	
	</div>
</div>


	</div>
</div>
</div></div></div>
</section>
</div>


