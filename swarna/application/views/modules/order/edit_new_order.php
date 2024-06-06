<!-- Content Wrapper. Contains page content -->
<?php $txn_array = array("Cash","Online","Cheque");

?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Order #<?php echo $order['Order_Code']; ?></h1>
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
	<form action="<?php echo site_url("order/edit_new_order/".$order['Order_Code']); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id">
		<input type='hidden' id='cust-code-selected' name='Customer_Code_Selected' value='<?php echo $order['Customer_Code']?>' />
		<input type='hidden' id='metal_type' name='metal_type' value="<?php echo $metal_type ?>" />
		<input type="hidden" id="grams_total_final-100000" name="grams_total_final[]" value="0" />
		
		<input type="hidden" id="total-final-receipt-grams-100000" name="total_final_receipt_grams[]" value="0" />
		
		<input type="hidden" id="rate-per-gram" name="rate_per_gram"  value="<?php echo $rate_per_gram_gold; ?>" />
		<input type="hidden" id="rate-per-gram-silver" name="rate_per_gram_silver"  value="<?php echo $rate_per_gram_silver; ?>" />
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
		<div class="form-block">
			
			<div class="card"><div class="card-body">
			
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label" for="order_date">Order Date</label>
					<input type="text" class="form-input" name="order_date" value="<?php echo set_value('order_date', date('d-m-Y',strtotime($order['Order_Date']))); ?>" autocomplete="off" disabled="disabled" id="order_date"/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Order ID</label>
					<input type="text" class="form-input" name="order" value="<?php echo set_value('order', $order['orderid']); ?>"  autocomplete="off" disabled="disabled"/>
					<input type="hidden" class="form-input" name="Order_Code" value="<?php echo set_value('order_id', $order['Order_Code']); ?>" />
				</div>
				
				<div class="form-column">
					<label class="radio-label">Order Status</label>
					<select class="form-select" name="Order_Status">
						<option value="">-Order Status-</option>
						
						<option value="pending" <?php if($order['Order_Status']=='pending'): ?>selected="selected"<?php endif; ?>>Pending</option>
						<option value="ongoing" <?php if($order['Order_Status']=='ongoing'): ?>selected="selected"<?php endif; ?>>Ongoing</option>
						<option value="cancelled" <?php if($order['Order_Status']=='cancelled'): ?>selected="selected"<?php endif; ?>>Cancelled</option>
						<option value="completed" <?php if($order['Order_Status']=='completed'): ?>selected="selected"<?php endif; ?>>Completed</option>
						<option value="delivered" <?php if($order['Order_Status']=='delivered'): ?>selected="selected"<?php endif; ?>>Delivered</option>
							
					</select>
				</div>
				
				<div class="clear"></div>
			</div>
			
			</div></div> <!--card ends-->
			
			<!--customer selection block-->
			<div class="card">
				<div class="card-header"><strong>Customer Selection</strong></div>
				<div class="card-body">
			
			<div class="form-row">
				<div class="form-column">
					
					<input type="hidden" name="Customer_Code" value="<?php echo $order['Customer_Code']?>" required/>
					
					
					<div id='customer-full-name' style="background:#fcfcfc;">
						<?php echo $order['customer']['Customer_Name']; ?><br/>
						<?php echo $order['customer']['Customer_Mobile_Number1']; ?><br/>
						<?php echo $order['customer']['Customer_Email']; ?><br/>
						<?php echo $order['customer']['Customer_Billing_address']; ?><br/>
						<?php echo $order['customer']['Customer_City']." - ".$order['customer']['Customer_Pincode']; ?>
					</div>
					
				</div>
				
				<div class="form-column">
					<button type="button" class="form-button small-button" name="select_customer" onclick="add_customer_popup();">+ Add/Change Customer</button>
				</div>
				<div class="clear"></div>
				
			</div>


			</div></div> <!--card ends-->
			
			<!--items block-->
			<div class="card">
				<div class="card-header"><strong> Order Items</strong> <a class="form-button small-button" onclick='add_item();'> + </a></div>
				<div class="card-body" id="order-items">
				
				<table class="table table-bordered" id="order-items-table">
					<tr>
						<td>J Type</td>
						<td>J Sub Type</td>
						<td>J Item</td>
						<td>Notes</td>
						<td>Workshop</td>
						<td>Approx Grams</td>
						<td>Wastage </td>
						<td>Total Grams</td>
						<td>MC (Rs)</td>
						<td><img src="<?php echo base_url('images/image_icon.png');?>" width=20></td>
						<td>Status</td>
						<td>Action</td>
					</tr>
					
				
				<?php 
				
				$count=0;
				
				$total_req_grams=0;
				
				$total_making_charges=0;
				$total_approx_grams=0;
				$total_wastage=0;
				$total_gold_balance=0;
				
				foreach($order['order_items'] as $item): $count++; 
				// print_r($item);
				$sub_cats=$this->Order_model->get_subcats_by_cat($item['Category_ID']);
				$jwelleryItems=$this->Order_model->getJwelleryItems($item['SubCategory_ID']);
				
				?>
				<tr id="item-row-<?= $count ?>">
						<td>
							<select class="form-select input-micro-width" name="item[<?php echo $count; ?>][Category_ID]" id="category-<?php echo $count; ?>" onchange="sub_category_options($(this).val(), <?php echo $count; ?>);">
								<option value="">-Select J Type-</option>
								<?php foreach($categories as $cat): ?>
									<option value="<?php echo $cat["Category_ID"]; ?>" <?php if($item['Category_ID']==$cat['Category_ID']): ?>selected="selected"<?php endif; ?>><?php echo $cat["Category_Name"]; ?></option>
								<?php endforeach; ?>
							</select>
						</td>
						<td>
							<select class="form-select input-micro-width" name="item[<?php echo $count; ?>][SubCategory_ID]" id="sub-category-<?php echo $count; ?>" onchange="jitem_options($(this).val(), '<?php echo $count; ?>');">
							<option value="">-Sub J Type-</option>
							<?php foreach($sub_cats as $scat): ?>
								<option value="<?php echo $scat["SubCategory_ID"]; ?>" <?php if($item['SubCategory_ID']==$scat['SubCategory_ID']): ?>selected="selected"<?php endif; ?>><?php echo $scat["SubCategory_Name"]; ?></option>
							<?php endforeach; ?>
							
							</select>
						</td>
						<td>
							<select class='form-select input-micro-width' name='item[<?php echo $count; ?>][item_id]' id='jitem_id-<?php echo $count; ?>' onchange='get_item_config($(this).val(), <?php echo $count; ?>);' >
						<?php 
						// echo "<pre>";
						// print_r($jwelleryItems);
						foreach($jwelleryItems as $scat):
							if($item['item_id']==$scat['item_id']){
								$making_charge = $scat['making_charges_per_gram'];
							}
						
						?>
								<option value="<?php echo $scat["item_id"]; ?>" <?php if($item['item_id']==$scat['item_id']): ?>selected="selected"<?php endif; ?>><?php echo $scat["item_name"]; ?></option>
							<?php endforeach; ?>
							</select>
						</td>
						
						<td><input placeholder="Notes.." type="text" class="form-input input-micro-width" name="item[<?php echo $count; ?>][notes]" id="additional-notes-<?php echo $count; ?>" value="<?php echo $item['notes']; ?>"></td>
						
						<td>
							<select class="form-select input-micro-width" name="item[<?php echo $count; ?>][Workshop_Code]" id="workshop-<?php echo $count; ?>">
							<option value="">-Select Workshop-</option>
							<?php foreach($workshops as $wshop): ?>
									<option value="<?php echo $wshop["Workshop_Code"]; ?>" <?php if($item['Workshop_Code']==$wshop['Workshop_Code']): ?>selected="selected"<?php endif; ?>><?php echo $wshop["Workshop_Name"]; ?></option>
								<?php endforeach; ?>
							</select>
						</td>
						
						<td><input placeholder="Approx Grams" type="number" class="form-input input-micro-width approx_gram_class" style='width:62px !important;' name="item[<?php echo $count; ?>][approx_grams]" id="approx-grams-<?php echo $count; ?>" value="<?php echo $item['approx_grams']; ?>" oninput='calculate_total_grams(<?php echo $count; ?>)'  ></td>
						
						
						
						<td><span id='wastage_value-<?php echo $count; ?>'><?php echo $item['wastage']; ?></span><input placeholder="Wastage " type="hidden" class="form-input input-micro-width total_wastage_class" style='width:50px !important;'  id="wastage-<?php echo $count; ?>" value="<?php echo $item['wastage_percent']; ?>" >
						<input type='hidden' id='wastage_gram-<?php echo $count; ?>' value="<?php echo $item['wastage']; ?>" name="item[<?php echo $count; ?>][wastage]" />
						<input type='hidden' id='wastage_type-<?php echo $count; ?>' value="<?php echo $item['wastage_type']; ?>" />
					</td>
						
						
						
						<td id='total-grams-<?php echo $count; ?>'>
							<?php 
							
							 $total_grams_row=$item['approx_grams']+($item['wastage']);
							// $total_grams_row=($item['approx_grams']+($item['approx_grams']*$item['wastage']/100));
							//+($item['approx_grams']*$item['making_charges']/100)
							 echo number_format($total_grams_row, 3); 
							
							$total_req_grams=$total_req_grams+$total_grams_row;
							
							?>
						</td>
						
						<td id='making-charges-<?php echo $count; ?>' class="making-charge-rs">
							<?php $row_making_charges= $item['making_charges'] ; 
							// $row_making_charges= $item['making_charges'] * $total_grams_row; 
							
							echo number_format($row_making_charges,2);
							
							$total_making_charges=$total_making_charges+$row_making_charges;
							
							?>
							
						</td>
						<td>
							<?php  echo ($item['receipt_file']!="") ? "<a target='_blank' href='".site_url("uploads/order_receipts/".$item['receipt_file'])."' data-lightbox='example-1' class='example-image-link'><img src='".site_url("uploads/order_receipts/".$item['receipt_file'])."' height='20px'></a>" : "" ?><div class="custom-file"><input type='file'  name='receipt_order_file[<?php echo $count; ?>]' class="custom-file-input" id="customFile" /><label class="custom-file-label" for="customFile"></label></div>
							<input type="hidden"  name="item[<?php echo $count; ?>][receipt_file]" value="<?php echo $item['receipt_file']; ?>">
						</td>
						<td>
							<select class="form-select input-micro-width" style="width:60px !important;" name="item[<?php echo $count; ?>][status]" id="item-status-<?php echo $count; ?>">
							<option value="">-Status-</option>
							
							<option value="pending" <?php if($item['status']=='pending'): ?>selected="selected"<?php endif; ?>>Pending</option>
							<option value="assigned" <?php if($item['status']=='assigned'): ?>selected="selected"<?php endif; ?>>Assigned</option>
							<option value="completed" <?php if($item['status']=='completed'): ?>selected="selected"<?php endif; ?>>Completed</option>
							<option value="received" <?php if($item['status']=='received'): ?>selected="selected"<?php endif; ?>>Received</option>
								
							</select>
						</td>
						
						<td><input type="button" class="form-button small-button bg-red" name="remove<?php echo $count; ?>" id="remove-<?php echo $count; ?>" value="x" onclick="remove_item('item-row-<?php echo $count; ?>', 'item-count')">
						<input type='hidden' id='making-charge-per-gram-<?php echo $count; ?>' value='<?php echo $making_charge; ?>' >
						<input type='hidden' name='item[<?php echo $count; ?>][making_charges]' id='making-charge-<?php echo $count; ?>' value='<?= $item['making_charges'] ?>' >
						<input type="hidden" id="grams_total_final-<?php echo $count; ?>" name="grams_total_final[]" value="<?php echo $total_grams_row; ?>" />
						</td>
					</div>
					
					</tr>
				
				<?php 
				
				$total_approx_grams=$total_approx_grams+ $item['approx_grams']; 
				$total_wastage=$total_wastage+ $item['wastage']; 
				
				
				endforeach;
				$total_approx_grams =  number_format((float)$total_approx_grams, 3, '.', '');
				?>
				<tfoot>
				<tr>
					<td colspan=5></td>
					
					<td><span id="total_approx_grams"><?php echo $total_approx_grams ?></span></td>
						<td><span id="total-wastage"><?php //echo number_format((float)$total_wastage, 2, '.', ''); ?></span> </td>
						<td><span id="total-outstanding-grams"><?php echo number_format((float)$total_req_grams, 3, '.', ''); ?></span> </td>
						<td><span id="making-charges-total"><?php echo number_format((float)$total_making_charges, 2, '.', ''); ?></span> </td>
					
					<td></td>
				</tr>
			</tfoot>
				</table>
				
				<input type="hidden" name="item-count" id="item-count" value="<?php echo count($order['order_items']); ?>" />
			
			</div>
			
			<!-- <div class="card-body text-right">
			
			<strong>Total Required Grams: </strong> <span id="total-outstanding-grams"><?php echo number_format((float)$total_req_grams, 2, '.', ''); ?></span> &nbsp;&nbsp;
			<strong>Total Making Charges: </strong> Rs.<span id="making-charges-total"><?php echo number_format((float)$total_making_charges, 2, '.', ''); ?></span>
			
			</div> -->
		</div>
			
			
			<!-- stones section -->
			<div class="card">
				<div class="card-header"><strong>Add Stones</strong> <a class="form-button small-button" onclick='add_stone();'> + </a></div>
				<div class="card-body" id="order-stones" style="overflow-x:auto;">
				<table class="table table-bordered" id="order-stones-table">
					<tr>
						<td>Stone Type</td>
						<td>Stone Sub Type</td>
						<td>Items</td>
						<td>Quantity</td>
						
						<td>Ct/Pc</td>
						<td>Rate per Unit(Rs)</td>
						<td>Total(Rs)</td>
						<td>Action</td>
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
				 <select class='form-select input-micro-width' name='stone[<?php echo $scount; ?>][stone_type_id]' id='stone-type-<?php echo $scount; ?>' onchange='stone_sub_type_options($(this).val(), <?php echo $scount; ?>);' >
					<option value=''>-Stone Type-</option>
					<?php foreach($stone_types as $stype): ?>
					<option value="<?php echo $stype['id']; ?>" <?php if($stype['id']==$ostone['stone_type_id']): ?>selected='selected'<?php endif; ?>><?php echo $stype['name']; ?></option>
					<?php endforeach; 
					?>
				</select>
			 </td>
			 
			 <td>
				 <select class='form-select input-micro-width' name='stone[<?php echo $scount; ?>][stone_sub_type_id]' id='stone-sub-type-<?php echo $scount; ?>' onchange='stone_item_options($(this).val(), "<?php echo $scount; ?>");' >
					 <option value=''>-Stone Sub Type-</option>
					 <?php foreach($stone_sub_types as $subtype): 
						if($subtype['stone_type_id']==$ostone['stone_type_id']):
							print_r($ostone['stone_sub_type_id']); 
					 ?>
					<option value="<?php echo $subtype['id']; ?>" <?php if($subtype['id']==$ostone['stone_sub_type_id']): ?>selected="selected"<?php endif; ?>><?php echo $subtype['name']; ?></option>
					<?php 
					endif;
					endforeach; ?>
			     </select>
			 </td>	
			 <td>
				 <select class='form-select input-micro-width' name='stone[<?php echo $scount; ?>][stone_item_id]' id='stone-item-<?php echo $scount; ?>' onchange='get_stone_sub_type_config($(this).val(), "<?php echo $scount; ?>");' >
					 <option value=''>-Stone Items-</option>
					 <?php foreach($stone_items as $subtype): 
						if($subtype['id']==$ostone['stone_item_id']):
					 ?>
					<option value="<?php echo $subtype['id']; ?>" <?php if($subtype['id']==$ostone['stone_item_id']): ?>selected="selected"<?php endif; ?>><?php echo $subtype['name']; ?></option>
					<?php 
					endif;
					endforeach; ?>
			     </select>
			 </td>	
			 <td><input type='number' class='form-input input-micro-width quantity_class' style='width:70px !important;' name='stone[<?php echo $scount; ?>][quantity]' id='stone-quantity-<?php echo $scount; ?>' value="<?php echo $ostone['quantity']; ?>"  oninput='calculate_stones_gross_amount(<?php echo $scount; ?>);'  /></td>
			 
			<td><input type='number' class='form-input input-micro-width stone_class' style='width:70px !important;' name='stone[<?php echo $scount; ?>][carat]' id='stone-carat-<?php echo $scount; ?>' oninput='calculate_stones_gross_amount(<?php echo $scount; ?>);'  value="<?php echo $ostone['carat']; ?>" /><span id='unit_id_<?php echo $scount; ?>'><?php echo $ostone['unit']; ?></span>
			<input type="hidden" name="stone[<?php echo $scount; ?>][unit]" id='unit_value_<?php echo $scount; ?>' value="<?php echo $ostone['unit'];; ?>" />
		</td>
			
			<td><input type='number' class='form-input input-micro-width' style='width:100px !important;' name='stone[<?php echo $scount; ?>][rate]' id='stone-rate-<?php echo $scount; ?>' value="<?php echo $ostone['rate']; ?>" oninput='calculate_stones_gross_amount(<?php echo $scount; ?>);' /></td>	
			   
			    <td id='stone-charges-<?php echo $scount; ?>' class='stone-charges-inr'><?php echo number_format($ostone['rate']*$ostone['carat'],2); ?></td>
			   <td><input type='hidden'  name='stone[<?php echo $scount; ?>][total_amount]' id='stone-total_amount-<?php echo $scount; ?>' value="<?= $ostone['rate']*$ostone['carat'] ?>" ><input type='button' class='form-button small-button bg-red' name='removestone<?php echo $scount; ?>' id='remove-stone-<?php echo $scount; ?>' value='x'  onclick='remove_stone("stone-row-<?php echo $scount; ?>","stones-count",<?php echo $scount; ?>)'/></td>
			 </tr>
					
				<?php
				
				$total_stone_cost=$total_stone_cost+($ostone['rate']*$ostone['carat']);
				$total_quantity=$total_quantity+($ostone['quantity']);
				$total_stone_size=$total_stone_size+($ostone['carat']);
				
					endforeach;
				
				?>	
				<tfoot>
				<tr>
					<td colspan=3></td>
					<td><span id="total_quantity"><?php echo $total_quantity ?></span></td>
					<td><span id="total_stone_size"><?php echo $total_stone_size ?></span></td>
					<td></td>
						<td><span id="total-stone-charges"><?php echo number_format((float)$total_stone_cost, 2, '.', ''); ?></span></td>
					
					<td></td>
				</tr>
				</tfoot>	
			</table>
				
				<!--stones block-->
			<input type="hidden" name="stones-count" id="stones-count" value="<?php echo $scount; ?>" />
			
			 </div>
			<!--	<div class="card-body text-right">
				<strong>Total Stone Charges: </strong> Rs.<span id="total-stone-charges"><?php echo $total_stone_cost; ?></span>
				</div>-->
			</div> 
			
			<?php
				// $metal_type = $order["metal_type"];
				if($metal_type=="gold"){
			?>
			<div class="card">
				<div class="card-header"><strong> Gold Receipts</strong> 
					<a class="form-button small-button" style="background:#e2ad37;"   onclick='add_gold("gold");'>+ </a>
				</div>
				<div class="card-body" id="gold-receipts">
				<table class="table table-bordered" id="gold-receipts-table">
					<tr>
						
						<td>Date</td>
						<!-- <td>Type</td> 
						<td>J Type</td>
						<td>J Sub Type</td>-->
						<td>J Item</td>
						<td>Notes</td>
						<td>Grams</td>
						<td>Melting Loss/Stones</td>
						<td>Net Gold</td>
						<td>Quality %</td>
						<td>GC<br/>Quality %</td>
						<td>Pure Gold</td>
						<td>Copper @7%</td>
						<td>Final Grams (92.50%)</td>
						<td><img src="<?php echo base_url('images/image_icon.png');?>" width=25> </td>
						<td>Action</td>
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
						
						// $jwelleryItemsMetal=$this->Order_model->getJwelleryItems($op['SubCategory_ID']);
					if( $op['Payment_Method']=="gold"):
						
						$count++;
					?>
					<tr id='receipt-row-<?php echo $count; ?>'>
						<td><?php echo $gold_date =  date("d-m-Y",strtotime($op['payment_date'])); ?>
							<input  type='hidden' class='form-input ' name='receipt[<?php echo $count; ?>][payment_date]' id='date-gold-<?php echo $count; ?>' value='<?php echo$op['payment_date'] ?>' required  />
						</td>
						<!-- <td>
							<select class="form-select input-micro-width" name="receipt[<?php echo $count; ?>][Category_ID]" id="category-<?php echo $count; ?>" onchange="sub_category_options($(this).val(), <?php echo $count; ?>);">
								<option value="">-Select J Type-</option>
								<?php foreach($categories as $cat): ?>
									<option value="<?php echo $cat["Category_ID"]; ?>" <?php if($op['Category_ID']==$cat['Category_ID']): ?>selected="selected"<?php endif; ?>><?php echo $cat["Category_Name"]; ?></option>
								<?php endforeach; ?>
							</select>
						</td>
						<td>
							<select class="form-select input-micro-width" name="receipt[<?php echo $count; ?>][SubCategory_ID]" id="sub-category-metal-<?php echo $count; ?>" onchange="jitem_options($(this).val(), '<?php echo $count; ?>');">
							<option value="">-Sub J Type-</option>
							<?php  foreach($sub_cats_metal as $scat): ?>
								<option value="<?php echo $scat["SubCategory_ID"]; ?>" <?php if($op['SubCategory_ID']==$scat['SubCategory_ID']): ?>selected="selected"<?php endif; ?>><?php echo $scat["SubCategory_Name"]; ?></option>
							<?php endforeach; ?>
							
							</select>
						</td> -->
						<td>
							<select class='form-select input-micro-width' name='receipt[<?php echo $count; ?>][item_id]' id='jitem_id_metal-<?php echo $count; ?>' >
						<?php foreach($jwelleryItemsMetal as $scat): ?>
								<option value="<?php echo $scat["item_id"]; ?>" <?php if($op['item_id']==$scat['item_id']): ?>selected="selected"<?php endif; ?>><?php echo $scat["item_name"]; ?></option>
							<?php endforeach; ?>
							</select>
						</td>
						<!-- <td><?php echo $op['Payment_Method']; ?></td> -->
						<td>
							<input placeholder="Notes.." type="text" class="form-input input-micro-width" name="receipt[<?php echo $count; ?>][notes]"  value="<?php echo $op['notes']; ?>">
						</td>
						
						<td><input type="hidden" name="receipt[<?php echo $count; ?>][Payment_Method]" id="receipt-type-<?php echo $count; ?>" value="gold">
							<input placeholder="Grams" type="number" class="form-input input-micro-width valid floatGramField gold_gram_column_class" style='width:70px !important;' name="receipt[<?php echo $count; ?>][Grams]" id="receipt-grams-<?php echo $count; ?>" value="<?php echo $op['Grams']; ?>" oninput="calculate_receipt_grams(<?php echo $count; ?>);" >
						</td>
						<td>
							<input placeholder="Melting Loss (gms)" type="number" class="form-input input-micro-width valid melting_gold_column_class" style='width:60px !important;' name="receipt[<?php echo $count; ?>][melting_loss]" id="melting-loss-<?php echo $count; ?>" value="<?php echo $op['melting_loss']; ?>" oninput="calculate_receipt_grams(<?php echo $count; ?>);"  >
						</td>
						<td id="net-deposit-grams-<?php echo $count; ?>" class='net_gold_column_class'>0</td>
						<td><input placeholder="Quality %" type="number" class="form-input input-micro-width valid" style='width:50px !important;' name="receipt[<?php echo $count; ?>][Quality]" id="quality-<?php echo $count; ?>" value="<?php echo $op['Quality']; ?>" oninput="calculate_receipt_grams(<?php echo $count; ?>);" ></td>
						<td><input placeholder="GC Quality %" type="number" class="form-input input-micro-width valid" style='width:50px !important;' name="receipt[<?php echo $count; ?>][jeweller_purity]" id="gc-quality-<?php echo $count; ?>" value="<?php echo $op['jeweller_purity']; ?>"  ></td>
						<td id="pure-gold-grams-<?php echo $count; ?>"  class='final_gold_column_class'>0</td>
						<td id="copper-grams-<?php echo $count; ?>">0</td>
						<td id="final-receipt-grams-<?php echo $count; ?>">0</td>
						<td>
							<?php  echo ($op['receipt_file']!="") ? "<a target='_blank' href='".site_url("uploads/order_receipts/".$op['receipt_file'])."' data-lightbox='example-1' class='example-image-link'><img src='".site_url("uploads/order_receipts/".$op['receipt_file'])."' height='20px'></a>" : "" ?><div class="custom-file"><input type='file'  accept='png,jpe?g,gif,jpg' name='receipt_gold_file[<?php echo $count; ?>]' class="custom-file-input" /><label class="custom-file-label" for="customFile"></label></div>
							<input type="hidden"  name="receipt[<?php echo $count; ?>][receipt_file]" value="<?php echo $op['receipt_file']; ?>">
						</td>
						<td><input type="button" class="form-button small-button bg-red valid" name="remove_receipt_<?php echo $count; ?>" id="remove-receipt-<?php echo $count; ?>" value="x" onclick="remove_receipt('receipt-row-<?php echo $count; ?>', 'receipt-count')" ><input type="hidden" id="total-final-receipt-grams-<?php echo $count; ?>" name="total_final_receipt_grams[]" value="0"></td>
					</tr>
					<?php 
				$total_gold_gram=$total_gold_gram+$op['Grams'];
				$total_melting_loss=$total_melting_loss+ ($op['melting_loss']);
				$net_gold=$net_gold+ (($op['Grams']-$op['melting_loss']));
				$total_gold=$total_gold+ (($op['Grams']-$op['melting_loss'])*$op['Quality']/100);
				
				endif; endforeach; ?>
				<tfoot>
					<tr>
						<td colspan=3></td>
						
						<td><span id="total_gold_grams"><?php echo $total_gold_gram; ?></span></td>
						<td><span id="gold_melting_loss"><?php //echo $total_melting_loss; ?></span></td>
						<td><span id="net_gold"><?php echo $net_gold; ?></span></td>
						<td></td>
						<td></td>
						 <td><span id="total-pure-receipts"><?php echo $total_gold; ?></span> </td>
						 <td></td>
						 <td><span id="total-gold-receipts"></span> </td>
						<td colspan=2></td>
					</tr>
			</tfoot>
				</table>
				</div>
				<input type="hidden" name="receipt-count" id="receipt-count" value="<?php echo $count; ?>" />

				
			</div> <!--card ends-->
			<?php } ?>
			<div class="card">
			
				<div class="card-header"><strong> Cash Receipts</strong>  <?php  if($rate_per_gram>0): ?> <a class="form-button small-button" onclick='add_cash("cash");'> + </a> <?php else: ?><span style="color:red;">Today's rate per gram not added </span><a href="<?php echo site_url("rate/browse?create_form=yes"); ?>" target="_blank" >Add Rate</a><?php endif;   ?>  </div>
				<div class="card-body" id="cash-receipts">
				<table class="table table-bordered" id="cash-receipts-table">
					<tr>
						<td>Date</td>
						<td>Type</td>
						<td>Notes</td>
						<td>Amount</td>
						 <td>Grams</td>
						
						<!-- <td>Final Grams </td>  -->
						<td>Action</td>
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
						<input  type='hidden' class='form-input ' name='cash_receipt[<?php echo $count; ?>][payment_date]' id='date-cash-<?php echo $count; ?>]' value='<?php echo $op['payment_date'] ?>' required />
						<input  type='hidden' class='form-input ' name='cash_receipt[<?php echo $count; ?>][Quality]'  value='100' required />
						<input  type='hidden' class='form-input ' name='cash_receipt[<?php echo $count; ?>][copper]'  value='0' required />
						<td><?php echo $op['txn_type']; ?></td>
						<td><input placeholder="Notes.." type="text" class="form-input input-micro-width" name="cash_receipt[<?php echo $count; ?>][notes]" value="<?php echo $op['notes']; ?>"></td>
						
						<td>
							<?php if($op['Payment_Method']=='cash'): ?>
								<input placeholder="Amount" type="number" class="form-input input-micro-width valid floatNumberField cash_amount_class" style='width:90px !important;' name="cash_receipt[<?php echo $count; ?>][total_amount]" id="receipt-amount-<?php echo $count; ?>" value="<?php echo $op['total_amount']; ?>" oninput="cash_to_grams(<?php echo $count; ?>);" ><input type="hidden" name="cash_receipt[<?php echo $count; ?>][Payment_Method]" id="receipt-type-<?php echo $count; ?>" value="cash">
								<input type="hidden" name="cash_receipt[<?php echo $count; ?>][rate_per_gram]" id="rate-per-gram-<?php echo $count; ?>" value="<?php echo $op['rate_per_gram']; ?>">
								<input type="hidden" name="cash_receipt[<?php echo $count; ?>][Payment_Method]" id="receipt-type-<?php echo $count; ?>" value="cash">
							<input type="hidden" name="cash_receipt[<?php echo $count; ?>][payment_for]"  value="gram_charge">
							<?php else: ?>
							
							<?php endif; 
							
							 $total_cash_amt = $total_cash_amt+$op['total_amount'];
							?>
						</td>
 						
						<td>
							<input placeholder="Grams" type="number" class="form-input input-micro-width valid floatGramField" style='width:70px !important;' name="cash_receipt[<?php echo $count; ?>][Grams]" id="cash-grams-<?php echo $count; ?>" value="<?php echo convert_to_grams($op['Grams']); ?>" oninput="calculate_cash_grams(<?php echo $count; ?>);" >
							<?php $total_cash_grams = $total_cash_grams+$op['Grams']; ?>
						</td>
	
						<!-- <td id="final-receipt-grams-<?php echo $count; ?>"><?php echo $op['Grams']; ?></td>  -->
						<td><input type="button" class="form-button small-button bg-red valid" name="remove_receipt_<?php echo $count; ?>" value="x" onclick="remove_receipt('receipt-cash-<?php echo $count; ?>','cash-count')" ><input type="hidden" id="total-cash-receipt-grams-<?php echo $count; ?>" name="total_cash_receipt_grams[]" value="0"><input type="hidden" id="total-cash-receipt-amt-<?php echo $count; ?>" name="total_cash_receipt_amt[]" value="<?php echo $op['total_amount']; ?>">
						<input type="hidden" name="cash_receipt[<?php echo $count; ?>][txn_type]"  value="<?= $op['txn_type'] ?>">
					</td>
					</tr>
					<?php 
					endif; 
					endif; 
				endforeach; ?>
				<tfoot>
					<tr>
						<td colspan=3></td>
						
						<td><span id="total_cash_amount"><?php echo $total_cash_amt ?></span></td>
						 <td><span id="total-cash-receipts">0</span></td>
						
						<td></td>
					</tr>
			</tfoot>
				</table>
				
			</div> <!--cash card ends-->
			<!--receipts block-->
			<input type="hidden" name="cash-count" id="cash-count" value="<?php echo $count; ?>" />
			
		</div>
			<!-- Cash block -->
			<div class="card">
				
				
				<div class="card-header"><strong> Making charge Receipts</strong>  <a class="form-button small-button"  onclick='add_making_charge("cash");' id="add_making_charge" > + </a> </div>
					
				<div class="card-body" id="making_charge-receipts" style="overflow-x:auto;">
				<table class="table table-bordered" id="making-charge-table">
					<tr>
					
						<td>Select date</td>
						<td>Payment Type</td>
						<td>Notes</td>
						<td>Amount</td>
						
						<td>Action</td>
					</tr>
					<?php 
					
					$mcount=0;
					$total_cash_grams = 0;
					$total_making_amt = 0;
				foreach($order['payments'] as $op): 
					
				if($op['Payment_Method']=="cash" ):
					if($op['payment_for']=="making_charge" ):
					$mcount++;
				?>
				<tr id='receipt-making-<?php echo $mcount; ?>'>
					<td><?php echo date("d-m-Y",strtotime($op['payment_date'])); ?></td> 
					<input  type='hidden' class='form-input ' name='making_receipt[<?php echo $mcount; ?>][payment_date]' id='date-cash-<?php echo $mcount; ?>]' value='<?php echo $op['payment_date'] ?>' required />
					<input  type='hidden' class='form-input ' name='making_receipt[<?php echo $mcount; ?>][Quality]'  value='100' required />
					<input  type='hidden' class='form-input ' name='making_receipt[<?php echo $mcount; ?>][copper]'  value='0' required />
					<td><?php echo $op['txn_type']; ?></td>
					<td><input placeholder="Notes.." type="text" class="form-input input-micro-width" name="making_receipt[<?php echo $mcount; ?>][notes]" id="notes-<?php echo $mcount; ?>" value="<?php echo $op['notes']; ?>"></td>
					
					<td>
						<?php if($op['Payment_Method']=='cash'): ?>
							<input placeholder="Amount" type="number" class="form-input input-micro-width valid floatNumberField making_amount_class" style='width:90px !important;' name="making_receipt[<?php echo $mcount; ?>][total_amount]" id="making-amount-<?php echo $mcount; ?>" value="<?php echo $op['total_amount']; ?>" oninput="calculate_making_charge(<?php echo $mcount; ?>);" ><input type="hidden" name="making_receipt[<?php echo $mcount; ?>][Payment_Method]" id="receipt-type-<?php echo $mcount; ?>" value="cash">
							
						<?php else: ?>
						<input type="hidden" name="making_receipt[<?php echo $count; ?>][Payment_Method]" id="receipt-type-<?php echo $mcount; ?>" value="gold">
						<?php endif; 
						$total_making_amt = $total_making_amt+$op['total_amount'];
						?>
					</td>
					
					<td><input type="button" class="form-button small-button bg-red valid" name="remove_receipt_<?php echo $count; ?>"  value="x" onclick="remove_receipt('receipt-making-<?php echo $mcount; ?>', 'making-count')" ><input type="hidden" id="total-cash-receipt-amt-<?php echo $count; ?>" name="total_cash_receipt_amt[]" value="<?php echo $op['total_amount']; ?>"><input type="hidden" name="making_receipt[<?php echo $mcount; ?>][payment_for]"  value="making_charge"><input type="hidden" name="making_receipt[<?php echo $mcount; ?>][txn_type]"  value="<?= $op['txn_type'] ?>"></td>
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
						<td></td>
					</tr>
		</tfoot>
				</table>
			
			</div>
			
		</div>
			<!-- Cash block End-->
			<!--silver receipt block-->
			<?php if($metal_type=="silver"){ ?>
			<div class="card">
				<div class="card-header"><strong> Silver Receipts</strong> <a class="form-button small-button" style="background:#e2ad37;" onclick='add_silver();'> + </a></div>
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
			<!-- Cash block -->
		<div class="card">
				
				
				<div class="card-header"><strong> Stone charge Receipts</strong>  <a class="form-button small-button"  onclick='add_stone_charge("cash");' id="add_stone_charge" > + </a> </div>
					
				<div class="card-body" id="stone_charge-receipts" style="overflow-x:auto;">
				<table class="table table-bordered" id="stone-charge-table">
					<tr>
					
						<td>Select date</td>
						<td>Payment Type</td>
						<td>Notes</td>
						<td>Amount</td>
						
						<td>Action</td>
					</tr>
					<?php 
					
					$mcount=0;
					$total_cash_grams = 0;
					
				foreach($order['payments'] as $op): 
					
				if($op['Payment_Method']=="cash" ):
					if($op['payment_for']=="stone_charge" ):
					$mcount++;
				?>
				<tr id='receipt-making-<?php echo $mcount; ?>'>
					<td><?php echo date("d-m-Y",strtotime($op['payment_date'])); ?>
					<input  type='hidden' class='form-input ' name='stone_receipt[<?php echo $mcount; ?>][payment_date]' id='date-cash-<?php echo $mcount; ?>]' value='<?php echo $op['payment_date'] ?>' required />
					<input  type='hidden' class='form-input ' name='stone_receipt[<?php echo $mcount; ?>][Quality]'  value='100' required />
					<input  type='hidden' class='form-input ' name='stone_receipt[<?php echo $mcount; ?>][copper]'  value='0' required />
					</td> 
					<td><?php echo $op['txn_type']; ?></td>
					<td><input placeholder="Notes.." type="text" class="form-input input-micro-width" name="stone_receipt[<?php echo $mcount; ?>][notes]" id="notes-<?php echo $mcount; ?>" value="<?php echo $op['notes']; ?>"></td>
					
					<td>
						<?php if($op['Payment_Method']=='cash'): ?>
							<input placeholder="Amount" type="number" class="form-input input-micro-width valid floatNumberField stone_amount_class" style='width:90px !important;' name="stone_receipt[<?php echo $mcount; ?>][total_amount]" id="receipt-amount-<?php echo $mcount; ?>" value="<?php echo $op['total_amount']; ?>" oninput="calculate_stone_charge(<?php echo $mcount; ?>);" ><input type="hidden" name="stone_receipt[<?php echo $mcount; ?>][Payment_Method]" id="receipt-type-<?php echo $mcount; ?>" value="cash">
							
						<?php else: ?>
						<input type="hidden" name="stone_receipt[<?php echo $mcount; ?>][ ]" id="receipt-type-<?php echo $mcount; ?>" value="gold">
						<?php endif; 
						$total_stone_amount = $total_stone_amount+$op['total_amount'];
						?>
					</td>
					
					<td><input type="button" class="form-button small-button bg-red valid" name="remove_receipt_<?php echo $mcount; ?>"  value="x" onclick="remove_receipt('receipt-making-<?php echo $mcount; ?>', 'stone-count')" ><input type="hidden" name="stone_receipt[<?php echo $mcount; ?>][payment_for]"  value="stone_charge">
					<input type="hidden" name="stone_receipt[<?php echo $mcount; ?>][txn_type]"  value="<?= $op['txn_type']; ?>">
				</td>
				</tr>
				<?php 
				endif; 
				endif; 
			endforeach; ?>
			<tfoot>
					<tr  style="font-weight:bold">
						<td colspan=3></td>
						
						<td><span id="total_stone_amount"><?php echo number_format($total_stone_amount,2) ?></span></td>
						 <td><span id="total-stone-receipts"></span><input type="hidden" name="stone-count" id="stone-count" value="<?= $mcount ?>" /> </td>
						
						<td></td>
					</tr>
		</tfoot>
				</table>
			
			</div>
			
		</div>
			<!-- Cash block End-->
		
			<!--Total Dues block-->
			<div class="card">
				<div class="card-header  text-right"><strong>Total Dues</strong></div>
				<div class="card-body">
			
			<div class="form-row">
				
				<div class="card-body text-right">
			<strong>
			<!-- Total Dues:  -->
			<span id="total_dues">
			<?php echo number_format((float)$total_req_grams, 3, '.', ''); ?>
			</span> Grams</strong> 
			<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 <!-- Stone Dues:  -->
				Rs <span id="stone_dues">
			<?php echo number_format((float)($total_stone_cost-$total_stone_amount), 2, '.', ''); ?>
			</span></strong> 
			<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				<!-- MC Dues: -->
				 Rs <span id="mc_dues">
			<?php echo number_format((float)($total_making_charges-$total_making_amt), 2, '.', ''); ?>
			</span></strong> 
			</div>
				
			</div>


			</div>
		</div> <!--total dues ends-->
			
			
			<div class="card"><div class="card-body">
			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Submit" />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("order/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
			
			</div></div> <!--card ends-->
			
		</div>
	</form>
	<script>
	$(document).ready(function () {
        $(".floatNumberField").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
		$(".floatGramField").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
		$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		// console.log(fileName);
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
    });
$('input[type=number').keyup(function() {
  var val = $(this).val();
//   alert(val);
if(val == 0)
{
  $(this).val(/^0+/, '');
}
});
</script>

<script>
jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
}, "Letters only please"); 
// $("form").validate({
//   rules: {
//     full_name: { lettersonly: true },
// 	locality: { lettersonly: true },
// 	landmark: { lettersonly: true },
// 	city: { lettersonly: true },
// 	state: { lettersonly: true }
//   }
// });
</script>


	<script>
		$(document).ready(function () {
	$("#create-form-id").validate({
		// ignore: ":file",
		rules: {
    //   "receipt_order_file\\[\\d+\\]": {   
	// 	required: false,    
    //     extension: "png|jpe?g|gif" // Example: allowed file extensions
    //   }
    },
    messages: {
    //   "receipt_order_file\\[\\d+\\]": {
      
    //     extension: "Only PNG, JPG, and GIF files are allowed"
    //   }
    },
	
    // Custom validation for file inputs
    // invalidHandler: function(form, validator) {
    //   var errors = validator.numberOfInvalids();
    //   if (errors) {
    //     var fileErrors = validator.invalid["receipt_order_file[]"];
    //     if (fileErrors) {
    //       $.each(fileErrors, function(index, error) {
    //         if (error) {
    //           // Handle the validation error for individual file inputs
    //           var fieldName = "receipt_order_file[" + index + "]";
    //           var errorMessage = "Please select a valid file for " + fieldName;
    //           validator.showErrors({ [fieldName]: errorMessage });
    //         }
    //       });
    //     }
    //   }
    // }
  });
	
	$("input[type=file]").each(function() {
        $(this).rules("add", {
            accept: "image/*",
            messages: {
                accept: "Only jpeg, jpg or png images"
            }
        });
    });
    });
	</script>
	</div>
</div>


	</div>
</div>
</div></div></div></div>
</section>
</div>

<script>
	function get_item_config(item_id, div_id){
		
		if(item_id){			
				$.post("<?php echo site_url("order/get_jitem"); ?>", {item_id:item_id}, function(data){
			
					var result=JSON.parse(data);
					var wastage_type = result.subcat.wastage_type;
					$("#wastage_type-"+div_id).val(wastage_type);
					$("#wastage-"+div_id).val(parseFloat(result.subcat.wastage_percent));
					
					//making charges set in input
					$("#making-charge-per-gram-"+div_id).val(parseFloat(result.subcat.making_charges_per_gram));
					
					calculate_total_grams(div_id);					
				});			
		}		
	}
	//function to get making charges and wastage
	function get_sub_cat_config(sub_cat_id, div_id){
		
		if(sub_cat_id){
			
				$.post("<?php echo site_url("order/get_sub_cat"); ?>", {sub_cat_id:sub_cat_id}, function(data){
			
					var result=JSON.parse(data);
					
					$("#wastage-"+div_id).val(parseFloat(result.subcat.wastage_percent));
					
					//making charges set in input
					$("#making-charge-per-gram-"+div_id).val(parseFloat(result.subcat.making_charges_per_gram));
					
					
					calculate_total_grams(div_id);
					
				});
			
			}
		
	}
	
	function add_customer_popup(){
		
				  form_data="<form onsubmit='return select_create_customer();'><input type='hidden' id='cust-code' name='Customer_Code' value='' />"+
				  
				  "<div class='form-row'><div class='form-column'><label class='radio-label'>Enter Contact Number</label><input type='number' class='form-input' name='contact_number' id='cust-mobile' placeholder='Phone Number' minlength='10' maxlength='12' onkeyup='search_populate_customer();' autocomplete='nope' required/></div><div class='form-column'><label class='radio-label'>Email</label><input type='email' id='cust-email' class='form-input' name='email' placeholder='Email' autocomplete='nope' required/></div><div class='clear'></div></div>"+
				
				  "<div class='form-row'><div class='form-column'><label class='radio-label'>Customer Name</label><input type='text' class='form-input' name='full_name' placeholder='Customer Name' id='cust-name' minlength='5' maxlength='100' autocomplete='nope' required/></div><div class='form-column'><label class='radio-label'>Address</label><input type='text' id='cust-address' class='form-input' name='address' placeholder='Address' autocomplete='nope' required/></div><div class='clear'></div></div>"+
				 
				  "<div class='form-row'><div class='form-column'><label class='radio-label'>Pincode</label><input type='text' id='cust-pincode' class='form-input' name='pincode' placeholder='Pincode' autocomplete='nope' required/></div><div class='form-column'><label class='radio-label'>City</label><input type='text' class='form-input' name='city' placeholder='City Name' id='cust-city' autocomplete='nope' required/></div><div class='clear'></div></div>"+
				  
				  "<div class='form-row'><div class='form-column'><label class='radio-label'>PAN Number</label><input type='text' id='cust-pan' class='form-input' name='pan' placeholder='PAN Number' autocomplete='nope' required/></div><div class='form-column'><label class='radio-label'>Opening Balance (gms)</label><input type='text' class='form-input' name='opening_balance' id='cust-opening-balance' placeholder='Gold Balance in Grams' autocomplete='nope' required/></div><div class='clear'></div></div>"+
				  "<div class='form-row'><div class='form-column'><input type='submit' class='form-button' name='create_customer_button'  value='Submit & Select'/></div><div class='clear'></div></div>";
		
		show_popup(form_data);
	
	}
	
	function search_populate_customer(){
		
		var mobile=$('#cust-mobile').val();
		
		if(mobile.length>=10){
		
		$.post("<?php echo site_url("user/search_customer"); ?>", {mobile:mobile}, function(data){
			
			var result=JSON.parse(data);
			
			if(result.status==true){
				
				$('#cust-code').val(result.Customer_Code);
				$('#cust-name').val(result.name);
				$('#cust-email').val(result.email);
				$('#cust-address').val(result.address);
				$('#cust-pincode').val(result.pincode);
				$('#cust-city').val(result.city);
				$('#cust-pan').val(result.pan);
				$('#cust-opening-balance').val(result.opening_balance);
				
			}
		
		});
		
		}
	
	}
	
	
	function select_create_customer(){
		
		customer_code=$('#cust-code').val();
		customer_name=$('#cust-name').val();
		
		email=$('#cust-email').val();
		address=$('#cust-address').val();
		pincode=$('#cust-pincode').val();
		city=$('#cust-city').val();
		pan=$('#cust-pan').val();
		opening_balance=$('#cust-opening-balance').val();
		
		phone=$('#cust-mobile').val();
		
		
		if(customer_code.length>0){
			
			$("#cust-code-selected").val(customer_code);
			$("#customer-full-name").html(customer_name+"<br/>"+phone+"<br/>"+email+"<br/>"+address+"<br/>"+city+" - "+pincode);
			
			$.post("<?php echo site_url("order/ajax_update_customer"); ?>", {customer_code:customer_code,customer_name:customer_name,email:email,address:address,pincode:pincode,city:city,pan:pan,opening_balance:opening_balance,phone:phone}, function(data){
			
			});
			
		
		} else {
			
			
			$.post("<?php echo site_url("order/ajax_update_customer"); ?>", {customer_name:customer_name,email:email,address:address,pincode:pincode,city:city,pan:pan,opening_balance:opening_balance,phone:phone}, function(data){
				
				json_obj=JSON.parse(data);
				
				$("#cust-code-selected").val(json_obj.customer_code);
				$("#customer-full-name").html(customer_name+"<br/>"+phone+"<br/>"+email+"<br/>"+address+"<br/>"+city+" - "+pincode);
				
				alert("customer created!");
					
			});
			
		}
		
		hide_popup();
		
		
		return false;
	}
	
	
	//function to populate item
	function add_item(){
		
		item_count=parseInt($("#item-count").val())+1;
		
		$("#item-count").val(item_count);
			
		category_options="<option value=''>-Select J Type-</option><?php foreach($categories as $cat): echo "<option value='".$cat['Category_ID']."'>".$cat['Category_Name']."</option>"; endforeach; ?>";
		
		workshop_options="<option value=''>-Select Workshop-</option><?php foreach($workshops as $ws): echo "<option value='".$ws['Workshop_Code']."'>".$ws['Workshop_Name']."</option>"; endforeach; ?>";
		
		
		 item="<tr id='item-row-"+item_count+"'>"+
			 "<td><select class='form-select input-micro-width' name='item["+item_count+"][Category_ID]' id='category-"+item_count+"' onchange='sub_category_options($(this).val(), "+item_count+");' >"+category_options+"</select></td>"+
			 
			 "<td><select class='form-select input-micro-width' name='item["+item_count+"][SubCategory_ID]' id='sub-category-"+item_count+"' onchange='jitem_options($(this).val(), \""+item_count+"\");'><option value=''>-Sub J Type-</option></select></td>"+	

			 "<td><select class='form-select input-micro-width' name='item["+item_count+"][item_id]' id='jitem_id-"+item_count+"' onchange='get_item_config($(this).val(), \""+item_count+"\");' ><option value=''>- J Items-</option></select></td>"+	

			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='item["+item_count+"][notes]' id='additional-notes-"+item_count+"' /></td>"+	
			 "<td><select class='form-select input-micro-width' name='item["+item_count+"][Workshop_Code]' id='workshop-"+item_count+"' >"+workshop_options+"</select></td>"+
			 "<td><input placeholder='Approx Grams' type='number' class='form-input input-micro-width approx_gram_class' style='width:70px !important;' name='item["+item_count+"][approx_grams]' id='approx-grams-"+item_count+"' value='0' oninput='calculate_total_grams("+item_count+")' /><input type='hidden' id='wastage_type-"+item_count+"' /></td>"+
			 
			  "<td><span id='wastage_value-"+item_count+"'></span><input placeholder='Wastage ' type='hidden' class='form-input input-micro-width total_wastage_class' style='width:50px !important;'  id='wastage-"+item_count+"' value='0' oninput='calculate_total_grams("+item_count+")' readonly /><input type='hidden' id='wastage_gram-"+item_count+"' name='item["+item_count+"][wastage]' ></td>"+
			 
			 
			    "<td id='total-grams-"+item_count+"'>0</td>"+
			     "<td id='making-charges-"+item_count+"' class='making-charge-rs'>0</td>"+
				 "<td><div class='custom-file'><input type='file'  name='receipt_order_file["+item_count+"]' class='custom-file-input '  id='orderFile"+item_count+"' /><label class='custom-file-label' for='orderFile"+item_count+"'></label></div></td>"+
			    "<td><select class='form-select input-micro-width valid' style='width:90px !important;' name='item["+item_count+"][status]' id='item-status-"+item_count+"'> <option value=''>-Status-</option> <option value='pending'>Pending</option> <option value='assigned'>Assigned</option> <option value='completed'>Completed</option> <option value='received'>Received</option> </select> </td>"+
			   "<td><input type='hidden'  id='making-charge-per-gram-"+item_count+"' value='0' ><input type='hidden' name='item["+item_count+"][making_charges]' id='making-charge-"+item_count+"' value='0' ><input type='button' class='form-button small-button bg-red' name='remove"+item_count+"' id='remove-"+item_count+"' value='x'  onclick='remove_item(\"item-row-"+item_count+"\", \"item-count\")'/><input type='hidden' id='grams_total_final-"+item_count+"' name='grams_total_final[]' value='0' /></td>"+	
			 "</tr>"; 
			//  $("#order-items-table>tbody>tr").eq(item_count-1).after(item);	 			 
	  
	   $("#order-items-table").append(item);
	   change_file_input();
	}
	
	//function to populate sub category
	function sub_category_options(category_id, row_id){
		
		const subcat_options=[];
		<?php
			
			foreach($categories as $cat):
			
				$subcats="<option value=''>-select subcat-</option>";
			
				foreach($cat['sub_categories'] as $sub_cat):
				
					$subcats=$subcats."<option value='".$sub_cat['SubCategory_ID']."'>".$sub_cat['SubCategory_Name']."</option>";			
				endforeach;
			
				?>
				subcat_options[<?php echo $cat['Category_ID']; ?>]="<?php echo $subcats; ?>";
				<?php
			
			endforeach;
		?>
		
		$("#sub-category-"+row_id).html(subcat_options[category_id]);
		
	}
	//function to populate J item
	function jitem_options(subcategory_id, row_id){
		
		const jitem_option=[];
		<?php
			 $subcategory_id = $sub_cat['SubCategory_ID'];
			foreach($categories as $cat):
			
				foreach($cat['sub_categories'] as $sub_cat):
					$jitems="<option value=''>-select J Item-</option>";
					
						foreach($sub_cat['jitems'] as $jitem):
					
						$jitems=$jitems."<option value='".$jitem['item_id']."'>".$jitem['item_name']."</option>";			
						endforeach;
					?>
					jitem_option[<?php echo $sub_cat['SubCategory_ID']; ?>]="<?php echo $jitems; ?>";
					<?php
				endforeach;			
			endforeach;
		?>		
		$("#jitem_id-"+row_id).html(jitem_option[subcategory_id]);		
	}
	//function to remove item
	
	function remove_item(id, count_id=""){

		$("#"+id).remove();
		if(count_id!=""){
			// $("#"+count_id).val(parseInt($("#"+count_id).val())-1);
		}

		update_total_outstanding_grams();

	}
	
	//calculate total grams
	function calculate_total_grams(row_id){
		
		
		
		approx_grams=parseFloat($('#approx-grams-'+row_id).val());
		
		wastage_percent=parseFloat($('#wastage-'+row_id).val());
		// console.log(wastage_percent);
		making_charge_percent=parseFloat($('#making-charges-'+row_id).html());
		wastage_type=$('#wastage_type-'+row_id).val();
		making_charge_per_gram=fixFloat($('#making-charge-per-gram-'+row_id).val(),2);
		if(wastage_type=="gram"){
			gross_total=(approx_grams+wastage_percent);
			wastage_value = wastage_percent;
			making_charges=making_charge_per_gram;
			
		}
		else if(wastage_type=="percent"){
			wastage_value = (approx_grams*wastage_percent/100);
			gross_total=(approx_grams+wastage_value);
			making_charges=approx_grams*fixFloat(making_charge_per_gram,2);
			
		}
		
		net_total=convert_to_grams(gross_total);
	
		$('#total-grams-'+row_id).html(net_total);
		
		$('#grams_total_final-'+row_id).val(net_total);
		
		
		
		
	
		//making_charges=net_total*parseInt(making_charge_per_gram);
		making_charges = fixFloat(making_charges, 2);
		
		$("#making-charges-"+row_id).html(making_charges);
		$("#making-charge-"+row_id).val(making_charges);
		// wastage_value = parseFloat(wastage_value).toFixed(3);
		wastage_value=convert_to_grams(wastage_value);
		$("#wastage_gram-"+row_id).val(wastage_value);
		$("#wastage_value-"+row_id).html(wastage_value);
		update_total_outstanding_grams();
		
		return net_total;
		
		
		
	}
	
	//update total outstanding
	function update_total_outstanding_grams(){
		
		total_array=document.getElementsByName('grams_total_final[]');
		total_approx_gram=document.getElementsByClassName('approx_gram_class');
		
		total_grams=0;
		total_approx_grams=0;
		for(i=0; i<total_approx_gram.length; i++){
			
			total_approx_grams=total_approx_grams+parseFloat(total_approx_gram[i].value);
			
		}
		for(i=0; i<total_array.length; i++){
			
			total_grams=total_grams+parseFloat(total_array[i].value);
			
		}
		total_grams = fixFloat(total_grams, 3);
		$('#total-outstanding-grams').html(total_grams);
		total_approx_grams = convert_to_grams(total_approx_grams);
		$('#total_approx_grams').html(total_approx_grams);
		
		
		//update making charges total
		making_charges_array=$(".making-charge-rs");
		
		net_making_charges=0;
		
		making_charges_array.each(function(){
			
			var a=$(this).html();		
			a=a.replace(/\,/g,'');
			making_charge=parseFloat(a);
			
			net_making_charges = net_making_charges + (making_charge);
		
		});
		total_wastage_array=$(".total_wastage_class");
		
		net_wastage=0;
		
		total_wastage_array.each(function(){
			
			wastage=extractNumericValue($(this).val());
			net_wastage = net_wastage + parseFloat(wastage);
		
		});
		total_making_amount = parseFloat($('#total_making_amount').html().replace(/,/g, ''));
		// console.log(total_making_amount);
		if(isNaN(total_making_amount)){
			total_making_amount = 0;
		}
		//Update making charges
		// console.log(total_making_amount);
		$('#mc_dues').html(fixFloat(net_making_charges-total_making_amount,2));
		net_making_charges = fixFloat(net_making_charges, 2);
		$('#making-charges-total').html(net_making_charges);
		
		// $('#total-wastage').html(net_wastage);
		total_duesg = extractNumericValue($("#total-outstanding-grams").html())-extractNumericValue($("#total-gold-receipts").html())-extractNumericValue($("#total-silver-receipts").html())-extractNumericValue($("#total-cash-receipts").html());
		
		total_duesg = fixFloat(total_duesg, 3);
		$('#total_dues').html(total_duesg);
	}
	
	
	
	//function to populate deposit record
	function add_gold(receipt_type){
		
		receipt_count=parseInt($("#receipt-count").val())+1;
		
		$("#receipt-count").val(receipt_count);
		metalType = $("#metal_type").val();
		category_options="<option value=''>-Select J Type-</option><?php foreach($categories as $cat): echo "<option value='".$cat['Category_ID']."'>".$cat['Category_Name']."</option>"; endforeach; ?>";
		item_options=createItems(metalType);
		//amount_input="<td><input type='hidden' name='receipt["+receipt_count+"][Payment_Method]' id='receipt-type-"+receipt_count+"' value='gold' /></td>";
		amount_input="";
		if(receipt_type=="cash"){
		
			amount_input="<td><input placeholder='Amount' type='number' class='form-input input-micro-width floatNumberField' style='width:90px !important;' name='receipt["+receipt_count+"][total_amount]' id='receipt-amount-"+receipt_count+"' value='0' oninput='amount_to_grams("+receipt_count+");' /><input type='hidden' name='receipt["+receipt_count+"][Payment_Method]' id='receipt-type-"+receipt_count+"' value='cash' /><input type='hidden' name='receipt["+receipt_count+"][rate_per_gram]' id='rate-per-gram-"+receipt_count+"' value='<?php echo $rate_per_gram; ?>'></td>";
		
		}
			 
			 
			 item="<tr id='receipt-row-"+receipt_count+"'>"+
			 "<td><input placeholder='Enter Date' type='date' class='form-input input-date-width' name='receipt["+receipt_count+"][payment_date]' id='date-"+receipt_count+"' value='<?php echo date("d-m-Y")?>' required max='<?php echo date("Y-m-d"); ?>' /></td>"+
		

			 "<td><select class='form-select input-micro-width' name='receipt["+receipt_count+"][item_id]' id='jitem_id-"+receipt_count+"'  >"+item_options+"</select><input type='hidden' name='receipt["+receipt_count+"][Payment_Method]' id='receipt-type-"+receipt_count+"' value='gold' /></td>"+	
			// "<td><select class='form-select input-micro-width' name='receipt["+receipt_count+"][Category_ID]' id='receipt-category-"+receipt_count+"' onchange='sub_category_options_deposit($(this).val(), "+receipt_count+");' >"+category_options+"</select></td>"+
			 
			// "<td><select class='form-select input-micro-width' name='receipt["+receipt_count+"][SubCategory_ID]' id='sub-category-deposit-"+receipt_count+"' ><option value=''>-Sub Category-</option></select></td>"+	
			//  "<td>"+receipt_type+"</td>"+
			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='receipt["+receipt_count+"][notes]' id='additional-notes-deposit-"+receipt_count+"' /></td>"+amount_input+
			 
			 
			 "<td><input placeholder='Grams' type='number' class='form-input input-micro-width floatGramField gold_gram_column_class' style='width:70px !important;' name='receipt["+receipt_count+"][Grams]' id='receipt-grams-"+receipt_count+"' value='0' oninput='calculate_receipt_grams("+receipt_count+");' /></td>"+
			 
			 "<td><input placeholder='Melting Loss (gms)' type='number' class='form-input input-micro-width melting_gold_column_class' style='width:50px !important;' name='receipt["+receipt_count+"][melting_loss]' id='melting-loss-"+receipt_count+"' value='0' oninput='calculate_receipt_grams("+receipt_count+");' /></td>"+
			 
			  "<td id='net-deposit-grams-"+receipt_count+"' class='net_gold_column_class'>0</td>"+
			 
			 "<td><input placeholder='Quality %' type='number' class='form-input input-micro-width' style='width:50px !important;' name='receipt["+receipt_count+"][Quality]' id='quality-"+receipt_count+"' value='0' oninput='calculate_receipt_grams("+receipt_count+");' /></td>"+
			 
			  "<td><input placeholder='GC Quality %' type='number' class='form-input input-micro-width' style='width:50px !important;' name='receipt["+receipt_count+"][jeweller_purity]' id='gc-quality-"+receipt_count+"' value='0' /></td>"+
			 
			 "<td id='pure-gold-grams-"+receipt_count+"'  class='final_gold_column_class'>0</td>"+  
			 
			 "<td id='copper-grams-"+receipt_count+"'>0</td>"+
			 
			 "<td id='final-receipt-grams-"+receipt_count+"'>0</td>"+
			 "<td><div class='custom-file' ><input type='file'   name='receipt_gold_file["+receipt_count+"]' class='custom-file-input' id='goldFile"+receipt_count+"' /><label class='custom-file-label' for='goldFile"+receipt_count+"'></label></div></td>"+
			 "<td><input type='button' class='form-button small-button bg-red' name='remove_receipt_"+receipt_count+"' id='remove-receipt-"+receipt_count+"' value='x'  onclick='remove_receipt(\"receipt-row-"+receipt_count+"\", \"receipt-count\")'/><input type='hidden' id='total-final-receipt-grams-"+receipt_count+"' name='total_final_receipt_grams[]' value='0' /></td>"+	
			   
			 "</tr>";
			 
			 
		// $("#gold-receipts-table>tbody>tr").eq(receipt_count-1).after(item);	 
	   $("#gold-receipts-table").append(item);
	  change_file_input();
	}
	
	function add_cash(receipt_type){
		
		receipt_count=parseInt($("#cash-count").val())+1;
		
		$("#cash-count").val(receipt_count);
			
		category_options="<option value=''>-Select Transaction Type-</option><?php foreach($txn_array as $cat): echo "<option value='".$cat."'>".$cat."</option>"; endforeach; ?>";
		
		
		if(receipt_type=="cash"){
		
			amount_input="<td><input placeholder='Amount' type='number' class='form-input input-micro-width cash_amount_class' style='width:90px !important;' name='cash_receipt["+receipt_count+"][total_amount]' id='receipt-amount-"+receipt_count+"' value='0' oninput='cash_to_grams("+receipt_count+");' /><input type='hidden' name='cash_receipt["+receipt_count+"][Payment_Method]' id='receipt-type-"+receipt_count+"' value='cash' /><input type='hidden' name='cash_receipt["+receipt_count+"][rate_per_gram]' id='rate-per-gram-"+receipt_count+"' value='<?php echo $rate_per_gram; ?>'></td>";
		
		}
			 
			 
			 item="<tr id='receipt-cash-"+receipt_count+"'>"+
			 "<td><input placeholder='Enter Date' type='date' class='form-input input-date-width' name='cash_receipt["+receipt_count+"][payment_date]' id='date-"+receipt_count+"' value='<?php echo date("d-m-Y")?>' required style='width:120px !important;' max='<?php echo date("Y-m-d"); ?>'  /></td>"+
			"<td><select class='form-select input-micro-width' name='cash_receipt["+receipt_count+"][txn_type]' id='txn_type_-"+receipt_count+"' >"+category_options+"</select></td>"+
			 
			// "<td><select class='form-select input-micro-width' name='receipt["+receipt_count+"][SubCategory_ID]' id='sub-category-deposit-"+receipt_count+"' ><option value=''>-Sub Category-</option></select></td>"+	
			// "<td>"+receipt_type+"</td>"+
			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='cash_receipt["+receipt_count+"][notes]' id='additional-notes-deposit-"+receipt_count+"' /></td>"+amount_input+
			 
			 
			 "<td><input placeholder='Grams' type='number' class='form-input input-micro-width' style='width:70px !important;' name='cash_receipt["+receipt_count+"][Grams]' id='cash-grams-"+receipt_count+"' value='0' oninput='calculate_cash_grams("+receipt_count+");' /></td>"+
			 
			// "<td><input placeholder='Melting Loss (gms)' type='number' class='form-input input-micro-width' style='width:50px !important;' name='receipt["+receipt_count+"][melting_loss]' id='melting-loss-"+receipt_count+"' value='0' onkeyup='calculate_receipt_grams("+receipt_count+");' /></td>"+
			 
			//  "<td id='net-deposit-grams-"+receipt_count+"'>0</td>"+
			 
		//	 "<td><input placeholder='Quality %' type='number' class='form-input input-micro-width' style='width:50px !important;' name='receipt["+receipt_count+"][Quality]' id='quality-"+receipt_count+"' value='0' onkeyup='calculate_receipt_grams("+receipt_count+");' /></td>"+
			 
		//	 "<td id='pure-gold-grams-"+receipt_count+"'>0</td>"+  
			 
		//	 "<td id='copper-grams-"+receipt_count+"'>0</td>"+
			 
			// "<td id='cash-receipt-grams-"+receipt_count+"'>0</td>"+
			    
			 "<td><input type='button' class='form-button small-button bg-red' name='remove_receipt_"+receipt_count+"' id='remove-receipt-"+receipt_count+"' value='x'  onclick='remove_receipt(\"receipt-cash-"+receipt_count+"\", \"cash-count\")'/><input type='hidden' id='total-cash-receipt-grams-"+receipt_count+"' name='total_cash_receipt_grams[]' value='0' /><input type='hidden' id='total-cash-receipt-amt-"+receipt_count+"' name='total_cash_receipt_amt[]' value='0' /><input  type='hidden' class='form-input ' name='cash_receipt["+receipt_count+"][Quality]'  value='100' required /><input  type='hidden' class='form-input ' name='cash_receipt["+receipt_count+"][copper]'  value='0' required /><input type='hidden' name='cash_receipt["+receipt_count+"][payment_for]'  value='gram_charge'></td>"+	
			   
			 "</tr>";
			 
	  $("#cash-receipts-table").append(item);
	
	 	// $("#cash-receipts-table>tbody>tr").eq(receipt_count-1).after(item);
	}
	//function to populate sub category
	function sub_category_options_deposit(category_id, row_id){
		
		const subcat_options=[];
		<?php
			
			foreach($categories as $cat):
			
				$subcats="<option value=''>-select subcat-</option>";
			
				foreach($cat['sub_categories'] as $sub_cat):
				
					$subcats=$subcats."<option value='".$sub_cat['SubCategory_ID']."'>".$sub_cat['SubCategory_Name']."</option>";			
				endforeach;
			
				?>
				subcat_options[<?php echo $cat['Category_ID']; ?>]="<?php echo $subcats; ?>";
				<?php
			
			endforeach;
		?>
		
		
		
		$("#sub-category-deposit-"+row_id).html(subcat_options[category_id]);
		
	}
	
	
	//function to remove item
	function remove_receipt(id, count_id=""){

		$("#"+id).remove();
		
		if(count_id!=""){
		
			// $("#"+count_id).val(parseInt($("#"+count_id).val())-1);
		
		}
		update_cash_receipt_grams();
		update_total_receipt_grams();
		calculate_stone_charge();
		calculate_making_charge();
		update_total_outstanding_grams();
	}
	
	//amount to grams
	function cash_to_grams(row_id){
		
		amount=parseFloat($('#receipt-amount-'+row_id).val());
		
		rate_per_gram=parseFloat($('#rate-per-gram-'+row_id).val());
		
		grams=amount/rate_per_gram;
		
		grams=convert_to_grams(grams);
		console.log("poonam"+grams+"");
		$('#cash-grams-'+row_id).val(grams);
		
		$('#receipt-amount-'+row_id).val(amount);//added by poonam 15Sep22
		
		calculate_cash_grams(row_id);
	}
	
	function amount_to_grams(row_id){
		
		amount=parseFloat($('#receipt-amount-'+row_id).val());
		
		rate_per_gram=parseFloat($('#rate-per-gram-'+row_id).val());
		
		grams=amount/rate_per_gram;
		
		grams=grams.toFixed(2);
		
		$('#receipt-grams-'+row_id).val(grams);
		$('#receipt-amount-'+row_id).val(amount);//added by poonam 15Sep22
		calculate_receipt_grams(row_id);
		calculate_cash_grams(row_id);
	}
	
	
	//calculate total grams receipts
	function calculate_receipt_grams(row_id){
		
		//debugger;
		receipt_grams=getNumericValue($('#receipt-grams-'+row_id).val());
		
		melting_loss=getNumericValue($('#melting-loss-'+row_id).val());
		
		receipt_type=$('#receipt-type-'+row_id).val();
		quality_percent=parseFloat($('#quality-'+row_id).val());
		if(receipt_type=='cash'){
			melting_loss=0;
			quality_percent =100;
			$('#quality-'+row_id).val(100);
		}
		
		net_gold_receipt=receipt_grams-melting_loss;
		
		pure_gold=net_gold_receipt*(quality_percent/100);
		
		copper=pure_gold*(7/100);
		
		if(receipt_type=='cash'){
			copper=0;
		}
		
		final_grams= pure_gold+copper;
		// console.log("here"+final_grams+'#net-deposit-grams-'+row_id+"here");
		net_gold_receipt = convert_to_grams(net_gold_receipt);
		pure_gold = convert_to_grams(pure_gold);
		copper = convert_to_grams(copper);
		final_grams = convert_to_grams(final_grams);
		$('#net-deposit-grams-'+row_id).text((net_gold_receipt));
		
		$('#pure-gold-grams-'+row_id).text((pure_gold));
		
		$('#copper-grams-'+row_id).text((copper));
		
		$('#final-receipt-grams-'+row_id).text((final_grams));
		
		$('#total-final-receipt-grams-'+row_id).val((final_grams));
		
		
		update_total_receipt_grams();
		
		return final_grams;
		
	}
	
	
	//update total outstanding receipts
	function update_total_receipt_grams(){
		
		total_array=document.getElementsByName('total_final_receipt_grams[]');
		total_cash_gold=document.getElementsByName('total_cash_receipt_grams[]');
		total_grams=0;
		total_cash_grams=0;
		
		for(i=0; i<total_array.length; i++){			
			total_grams=total_grams+parseFloat(total_array[i].value);
			
		}
		for(i=0; i<total_cash_gold.length; i++){			
			total_cash_grams=total_cash_grams+parseFloat(total_cash_gold[i].value);
			
		}
		gross_gram_array=$(".gold_gram_column_class");		
		net_gram_gold=0;		
		gross_gram_array.each(function(){
			
			net_gram_gold = net_gram_gold + parseFloat($(this).val());
		
		});
		gross_melting_array=$(".melting_gold_column_class");		
		net_melting_gold=0;		
		gross_melting_array.each(function(){
			
			melting_gold=$(this).val();
			net_melting_gold = net_melting_gold + parseFloat(melting_gold);
		
		});
		gross_gold_array=$(".net_gold_column_class");		
		net_gold=0;		
		gross_gold_array.each(function(){
			
			net_gold = net_gold + parseFloat($(this).html());
		
		});
		final_gold_array=$(".final_gold_column_class");		
		final_gold=0;		
		final_gold_array.each(function(){
			
			final_gold = final_gold + parseFloat($(this).html());
			
		
		});
		final_gold = convert_to_grams(final_gold);
		net_gram_gold = convert_to_grams(net_gram_gold);
		net_melting_gold = convert_to_grams(net_melting_gold);
		total_grams = convert_to_grams(total_grams);
		
		net_gold = convert_to_grams(net_gold);
		$('#total-gold-receipts').html((total_grams));
		$('#gold_melting_loss').html(net_melting_gold);
		$('#net_gold').html(net_gold);
		$('#total-pure-receipts').html(final_gold);
		$('#total_gold_grams').html(net_gram_gold);
		total_duess = extractNumericValue($("#total-outstanding-grams").html())-extractNumericValue($("#total-silver-receipts").html())-(total_grams)-extractNumericValue($("#total-cash-receipts").html());
		
		total_duess = convert_to_grams(total_duess);
		$('#total_dues').html(total_duess);
	}
	
	$(document).ready(function(){
		
	
	
	<?php if($order['payments']): 
	
		$count=0;
		
		foreach($order['payments'] as $op):
		
			$count++;
			
			?>
				calculate_receipt_grams(<?php echo $count; ?>);
				calculate_cash_grams(<?php echo $count; ?>);
			<?php
		
		endforeach;
	
	 endif; ?>
	 
	});

</script>


<script>
	
	
	//function to get stone sub type details
	function get_stone_sub_type_config(stone_sub_type_id, div_id){
		
		if(stone_sub_type_id){
			
				$.post("<?php echo site_url("order/get_stone_item"); ?>", {stone_sub_type_id:stone_sub_type_id}, function(data){
			
					var result=JSON.parse(data);
					// console.log(result);
					var unit = result.stone_item.unit;
					$("#stone-cents-"+div_id).val(parseInt(result.stone_item.cents));
					$("#stone-grams-"+div_id).val(parseInt(result.stone_item.grams));
					$("#stone-carat-"+div_id).val(parseInt(result.stone_item.carat));
					$("#stone-rate-"+div_id).val(parseInt(result.stone_item.rate));
					$("#unit_id_"+div_id).html(unit);
					$("#unit_value_"+div_id).val(unit);
					
					calculate_stones_gross_amount(div_id);
					
				});
			
			}
		
	}

	//function to populate item
	function add_stone(){
		
		stones_count=parseInt($("#stones-count").val())+1;
		
		$("#stones-count").val(stones_count);
			
		stone_type_options="<option value=''>-Stone Type-</option><?php foreach($stone_types as $stone_type): echo "<option value='".$stone_type['id']."'>".$stone_type['name']."</option>"; endforeach; ?>";
			 
			 
			 stone="<tr id='stone-row-"+stones_count+"'>"+
			 "<td><select class='form-select input-micro-width' name='stone["+stones_count+"][stone_type_id]' id='stone-type-"+stones_count+"' onchange='stone_sub_type_options($(this).val(), "+stones_count+");' >"+stone_type_options+"</select></td>"+
			 
			//  "<td><select class='form-select input-micro-width' name='stone["+stones_count+"][stone_sub_type_id]' id='stone-sub-type-"+stones_count+"' onchange='get_stone_sub_type_config($(this).val(), \""+stones_count+"\");' ><option value=''>-Stone Sub Type-</option></select></td>"+	
			 "<td><select class='form-select input-micro-width' name='stone["+stones_count+"][stone_sub_type_id]' id='stone-sub-type-"+stones_count+"' onchange='stone_item_options($(this).val(), \""+stones_count+"\");' ><option value=''>-Stone Sub Type-</option></select></td>"+	
			 
			 "<td><select class='form-select input-micro-width' name='stone["+stones_count+"][stone_item_id]' id='stone-item-"+stones_count+"' onchange='get_stone_sub_type_config($(this).val(), \""+stones_count+"\");' ><option value=''>-Stone Sub Type-</option></select></td>"+	
			 "<td><input type='number' class='form-input input-micro-width quantity_class' style='width:70px !important;' name='stone["+stones_count+"][quantity]' id='stone-quantity-"+stones_count+"' value='1' oninput='calculate_stones_gross_amount("+stones_count+");'  /></td>"+	
			 
		//	"<td><input type='number' class='form-input input-micro-width' style='width:70px !important;' name='stone["+stones_count+"][cents]' id='stone-cents-"+stones_count+"' onkeyup='stones_converter(\"cents\", $(this).val(), "+stones_count+");' onchange='stones_converter(\"cents\", $(this).val(), "+stones_count+");' /></td>"+	
			
		//	"<td><input type='number' class='form-input input-micro-width' style='width:70px !important;' name='stone["+stones_count+"][grams]' id='stone-grams-"+stones_count+"' onkeyup='stones_converter(\"grams\", $(this).val(), "+stones_count+");' onchange='stones_converter(\"grams\", $(this).val(), "+stones_count+");' /></td>"+	
			
		//	"<td><input type='number' class='form-input input-micro-width' style='width:70px !important;' name='stone["+stones_count+"][carat]' id='stone-carat-"+stones_count+"' onkeyup='stones_converter(\"carat\", $(this).val(), "+stones_count+");' onchange='stones_converter(\"carat\", $(this).val(), "+stones_count+");' /></td>"+	
		"<td><input type='number' class='form-input input-micro-width stone_class' style='width:70px !important;' name='stone["+stones_count+"][carat]' id='stone-carat-"+stones_count+"' oninput='calculate_stones_gross_amount("+stones_count+");'  /> <span id='unit_id_"+stones_count+"'></span><input type='hidden' name='stone["+stones_count+"][unit]' id='unit_value_+stones_count+' value=''></td>"+	
			"<td><input type='number' class='form-input input-micro-width' style='width:100px !important;' name='stone["+stones_count+"][rate]' id='stone-rate-"+stones_count+"' oninput='calculate_stones_gross_amount("+stones_count+");'  /></td>"+	
		//	"<td><input type='number' class='form-input input-micro-width' style='width:100px !important;' name='stone["+stones_count+"][rate]' id='stone-rate-"+stones_count+"' /></td>"+	
			   
			    "<td id='stone-charges-"+stones_count+"' class='stone-charges-inr'>0</td>"+
			   "<td><input type='hidden'  name='stone["+stones_count+"][total_amount]' id='stone-total_amount-"+stones_count+"' ><input type='button' class='form-button small-button bg-red' name='removestone"+stones_count+"' id='remove-stone-"+stones_count+"' value='x'  onclick='remove_stone(\"stone-row-"+stones_count+"\", \"stones-count\", "+stones_count+")'/></td>"+	
			 "</tr>";
			 
			 
		// $("#order-stones-table>tbody>tr").eq(stones_count-1).after(stone);
	   $("#order-stones-table").append(stone);
	
	}
	
	
	//function to stone_sub_type_options
	function stone_sub_type_options(stone_type_id, row_id){
		
		const stone_subtype_options=[];
		
		<?php
				
			foreach($stone_types as $stone_type):
			
				$stone_sub_types_options="<option value=''>-stone sub types-</option>";
			
				foreach($stone_sub_types as $sub_type):
					
					if($sub_type['stone_type_id']==$stone_type['id']){
				
					$stone_sub_types_options=$stone_sub_types_options."<option value='".$sub_type['id']."'>".$sub_type['name']."</option>";	
					
					}	
						
				endforeach;
			
				?>
				stone_subtype_options[<?php echo $stone_type['id']; ?>]="<?php echo $stone_sub_types_options; ?>";
				<?php
			
			endforeach;
		?>
		
		
		
		$("#stone-sub-type-"+row_id).html(stone_subtype_options[stone_type_id]);
		
	}
	
	//remove stone
	function remove_stone(id, count_id="",row=""){

		$("#"+id).remove();
		if(count_id!=""){
			// $("#"+count_id).val(parseInt($("#"+count_id).val())-1);
		}
		if(row!=""){
			calculate_stones_gross_amount(row);
		}
	}
	
	//convert cents to carat to grams
	function stones_converter(convert_from, val, row_id){
		
		carat=0;
		cents=0;
		grams=0;
		
		if(convert_from=="carat"){
			
				carat=parseFloat(val);
				
				cents=carat*100;
				
				grams=carat * 0.2;
			
			}
			
		if(convert_from=="grams"){
			
				carat=parseFloat(val)*5;
				
				grams=parseFloat(val);
				
				cents=carat * 100;
			
			}
			
		if(convert_from=="cents"){
			
				carat=parseFloat(val)*0.01;
				
				cents=parseFloat(val);
				
				grams=carat * 0.2;
			}
		
		$('#stone-cents-'+row_id).val(cents);
		
		$('#stone-grams-'+row_id).val(parseFloat(grams).toFixed(2));
		
		$('#stone-carat-'+row_id).val(carat);
		
		calculate_stones_gross_amount(row_id);
		
	}
	
	//calculate gross amount for stones
	function calculate_stones_gross_amount(row_id){
		total_amt = parseFloat($('#total_stone_amount').html());
		quantity=parseFloat($('#stone-quantity-'+row_id).val());
		
	
		
		carat=extractNumericValue($('#stone-carat-'+row_id).val());
		
		rate=parseFloat($('#stone-rate-'+row_id).val());
		
		gross_total= carat * rate;
		
		gross_total = fixFloat(gross_total,2);
		$('#stone-charges-'+row_id).html(gross_total);
		
		
		
		//update final total
		gross_total_array=$(".stone-charges-inr");
		total_quantity=$(".quantity_class");
		total_stone=$(".stone_class");
		
		net_amount=0;
		net_quantity=0;
		net_stone=0;
		
		total_stone.each(function(){
			stone=$(this).val(); 
			stone = convert_to_number(stone);
			
			net_stone = net_stone + parseInt(stone);
		
		});
		gross_total_array.each(function(){
			var a=$(this).html();		
			// a=a.replace(/\,/g,'');
			stone_charge=convert_to_number(a);
			
			net_amount = net_amount + parseFloat(stone_charge);
		
		});
		total_quantity.each(function(){
			
			quantity=$(this).val();
			net_quantity = net_quantity + parseInt(quantity);
		
		});
		$('#stone-total_amount-'+row_id).val(gross_total);
		$('#total-stone-charges').html(fixFloat(net_amount,2));
		$('#total_stone_size').html(net_stone);
		$('#total_quantity').html(net_quantity);
		$('#stone_dues').html(fixFloat((net_amount-total_amt),2));
		
	}
//calculate total grams receipts
function calculate_cash_grams(row_id){
		
		receipt_grams=parseFloat($('#cash-grams-'+row_id).val());
		
		//debugger;
		//melting_loss=parseFloat($('#melting-loss-'+row_id).val());		
		receipt_type=$('#receipt-type-'+row_id).val();
		
		
		
		net_gold_receipt=receipt_grams;
		
		
		
		pure_gold=net_gold_receipt;
		
		//copper=pure_gold*(7/100);		
		if(receipt_type=='cash'){
			copper=0;
		}
		
		final_grams= pure_gold;
		
		net_gold_receipt = convert_to_grams(net_gold_receipt);
		//$('#net-deposit-grams-'+row_id).text(net_gold_receipt);
		pure_gold = convert_to_grams(pure_gold);
		//$('#pure-gold-grams-'+row_id).text(pure_gold);
		//copper = parseFloat(copper).toFixed(2);
		//$('#copper-grams-'+row_id).text(copper);
		final_grams = convert_to_grams(final_grams);
		
		$('#cash-receipt-grams-'+row_id).text(final_grams);
		
		$('#total-cash-receipt-grams-'+row_id).val(final_grams);
		
		
		update_cash_receipt_grams();
		
		return final_grams;
		
	}
	//update total cash receipts
	function update_cash_receipt_grams(){
		
		total_array=document.getElementsByName('total_cash_receipt_grams[]');
		total_amt_array=document.getElementsByClassName('cash_amount_class');
		
		total_grams=0;
		total_amt=0;
		
		for(i=0; i<total_array.length; i++){
			
			total_grams=total_grams+parseFloat(total_array[i].value);
			
		}
		
		for(i=0; i<total_amt_array.length; i++){
			
			total_amt=total_amt+parseFloat(total_amt_array[i].value);
			
		}
		// console.log(total_grams+"hi");
		if(total_grams>0)
			total_grams = convert_to_grams(total_grams);
			total_amt = fixFloat(total_amt, 2);
		$('#total-cash-receipts').html(total_grams);
		$('#total_cash_amount').html(total_amt);
		total_dues = extractNumericValue($("#total-outstanding-grams").html())-extractNumericValue($("#total-silver-receipts").html())-extractNumericValue($("#total-gold-receipts").html())-parseFloat(total_grams).toFixed(3);
		
		total_dues = convert_to_grams(total_dues);
		$('#total_dues').html(total_dues);
	}
</script>


<script>

//function to populate deposit record
	function add_silver(){
		
		receipt_count=parseInt($("#silver-receipt-count").val())+1;
		
		$("#silver-receipt-count").val(receipt_count);
			
		
		
		amount_input="<input type='hidden' name='silver_receipt["+receipt_count+"][Payment_Method]' id='silver-receipt-type-"+receipt_count+"' value='silver' />";
			 
			 
			 item="<tr id='silver-receipt-row-"+receipt_count+"'>"+
			 
			 "<td><input placeholder='Enter Date' type='date' class='form-input input-date-width' name='silver_receipt["+receipt_count+"][payment_date]' id='date-"+receipt_count+"' value='<?php echo date("d-m-Y")?>' required max='<?php echo date("Y-m-d"); ?>' /></td>"+
			//  "<td><select class='form-select input-micro-width' name='silver_receipt["+receipt_count+"][Category_ID]'  onchange='sub_category_receipt($(this).val(), "+receipt_count+");' >"+category_options+"</select></td>"+
			 
			//  "<td><select class='form-select input-micro-width' name='silver_receipt["+receipt_count+"][SubCategory_ID]' id='sub-category-"+receipt_count+"' onchange='jitem_options_receipt($(this).val(), \""+receipt_count+"\");'><option value=''>-Sub J Type-</option></select></td>"+	

			 "<td><select class='form-select input-micro-width' name='silver_receipt["+receipt_count+"][item_id]' id='jitem_id-"+receipt_count+"' ><option value=''>- J Items-</option></select><input type='hidden' name='receipt["+receipt_count+"][Payment_Method]' id='receipt-type-"+receipt_count+"' value='gold' /></td>"+
			//  "<td>Silver</td>"+
			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='silver_receipt["+receipt_count+"][notes]' id='additional-notes-silver-deposit-"+receipt_count+"' /> "+amount_input+" </td>"+
			 
			 
			 "<td><input placeholder='Grams' type='number' class='form-input input-micro-width gram_input_column_class' style='width:70px !important;' name='silver_receipt["+receipt_count+"][Grams]' id='silver-receipt-grams-"+receipt_count+"' value='0' oninput='calculate_silver_receipt_grams("+receipt_count+");' /></td>"+
			 
			 "<td><input placeholder='Melting Loss (gms)' type='number' class='form-input input-micro-width melting_input_column_class' style='width:50px !important;' name='silver_receipt["+receipt_count+"][melting_loss]' id='silver-melting-loss-"+receipt_count+"' value='0' oninput='calculate_silver_receipt_grams("+receipt_count+");' /></td>"+
			 
			  "<td><input disabled id='net-silver-deposit-grams-"+receipt_count+"' style='width: 65px;' class='silver_deposit_column_class' value='0'> </td>"+
			 
			 "<td><input placeholder='Quality %' type='number' class='form-input input-micro-width' style='width:50px !important;' name='silver_receipt["+receipt_count+"][Quality]' id='silver-quality-"+receipt_count+"' value='0' oninput='calculate_silver_receipt_grams("+receipt_count+");' /></td>"+
			 
			 "<td id='pure-silver-grams-"+receipt_count+"'>0</td>"+  
			 
			 
			 
			// "<td id='silver-value-inr-"+receipt_count+"'>0</td>"+
			"<td><div class='custom-file' id='silverFile"+receipt_count+"'><input type='file'  accept='png,jpe?g,gif,jpg' name='receipt_silver_file["+receipt_count+"]' class='custom-file-input' /><label class='custom-file-label' for='silverFile"+receipt_count+"'></label></div></td>"+
			 "<td><input type='button' class='form-button small-button bg-red' name='remove_silver_receipt_"+receipt_count+"' id='remove-silver-receipt-"+receipt_count+"' value='x'  onclick='remove_silver_receipt(\"silver-receipt-row-"+receipt_count+"\")'/><input type='hidden' id='total-final-silver-receipt-grams-"+receipt_count+"' name='total_final_silver_receipt_grams[]' value='0' /></td>"+	
			   
			 "</tr>";
			 
			 
		// $("#silver-receipts-table>tbody>tr").eq(receipt_count-1).after(item);
	  $("#silver-receipts-table").append(item);
	 change_file_input();
	}
	function jitem_options_receipt(subcategory_id, row_id){
		
		const jitem_option=[];
		<?php
			
			foreach($categories as $cat):
			
				foreach($cat['sub_categories'] as $sub_cat):
					$jitems="<option value=''>-select J Item-</option>";
					
						foreach($sub_cat['jitems'] as $jitem):
					
						$jitems=$jitems."<option value='".$jitem['item_id']."'>".$jitem['item_name']."</option>";			
						endforeach;
					?>
					jitem_option[<?php echo $sub_cat['SubCategory_ID']; ?>]="<?php echo $jitems; ?>";
					<?php
				endforeach;			
			endforeach;
		?>		
		$("#jitem_id_receipt-"+row_id).html(jitem_option[subcategory_id]);		
	}
	function sub_category_receipt(category_id, row_id){
		
		const subcat_options=[];
		<?php
			
			foreach($categories as $cat):
			
				$subcats="<option value=''>-select subcat-</option>";
			
				foreach($cat['sub_categories'] as $sub_cat):
				
					$subcats=$subcats."<option value='".$sub_cat['SubCategory_ID']."'>".$sub_cat['SubCategory_Name']."</option>";			
				endforeach;
			
				?>
				subcat_options[<?php echo $cat['Category_ID']; ?>]="<?php echo $subcats; ?>";
				<?php
			
			endforeach;
		?>
		
		$("#sub-category-receipt-"+row_id).html(subcat_options[category_id]);
		
	}
	//function to remove item
	function remove_silver_receipt(id){
		
		$("#"+id).remove();
		
		update_total_silver_receipt_grams();
	
	}
	
	
	//calculate total grams receipts
	function calculate_silver_receipt_grams(row_id){
		
		
		receipt_grams=parseFloat($('#silver-receipt-grams-'+row_id).val());
		
		melting_loss=parseFloat($('#silver-melting-loss-'+row_id).val());
		
		net_silver_receipt=receipt_grams-melting_loss;
		
		$('#net-silver-deposit-grams-'+row_id).val(convert_to_grams(net_silver_receipt));
		
		quality_percent=parseFloat($('#silver-quality-'+row_id).val());
		
		pure_silver=net_silver_receipt*(quality_percent/100);
		
		final_grams= pure_silver;
		
		$('#pure-silver-grams-'+row_id).html(convert_to_grams(pure_silver));
		
		//rate=$('#rate-per-gram-silver').val();
		
		//inr_value=parseInt(rate)*final_grams;
		
		//$('#silver-value-inr-'+row_id).html(inr_value);
		
		$('#total-final-silver-receipt-grams-'+row_id).val(convert_to_grams(final_grams));
		
		update_total_silver_receipt_grams();
		
		return final_grams;
		
	}
	
	
	//update total outstanding receipts
	function update_total_silver_receipt_grams(){
		
		total_array=document.getElementsByName('total_final_silver_receipt_grams[]');
		total_gram_values=document.getElementsByClassName('gram_input_column_class');
		total_melting_values=document.getElementsByClassName('melting_input_column_class');
		total_silver_deposit_values=document.getElementsByClassName('silver_deposit_column_class');
		
		//console.log(total_silver_deposit_values.length);
		total_grams=0;
		total_gram_value=0;
		total_melting_value=0;
		total_silver_deposit_value=0;
		for(i=0; i<total_silver_deposit_values.length; i++){
			// console.log(total_silver_deposit_values[i].value);
			total_silver_deposit_value=total_silver_deposit_value+parseFloat(total_silver_deposit_values[i].value);
			
		}
		for(i=0; i<total_melting_values.length; i++){
			
			total_melting_value=total_melting_value+parseFloat(total_melting_values[i].value);
			
		}
		for(i=0; i<total_gram_values.length; i++){
			
			total_gram_value=total_gram_value+parseFloat(total_gram_values[i].value);
			// total_melting_value=total_melting_value+parseFloat(total_melting_values[i].value);
			
		}
		//console.log(total_silver_deposit_value);
		for(i=0; i<total_array.length; i++){
			
			//total_gram_val=document.getElementsByName("silver_receipt[2][Grams]");
			//console.log(total_gram_val);
		//	console.log(total_gram_val.length);
		//	console.log(document.getElementsByName("silver_receipt["+i+"][Grams]");
			total_grams=total_grams+parseFloat(total_array[i].value);
			
		}
		total_grams = fixFloat(total_grams, 2);
		$('#total-silver-receipts').html(total_grams);
		$('#total_melting_loss').html(total_melting_value);
		$('#net_silver').html(total_silver_deposit_value);
		$('#total_silver_grams').html(total_gram_value);
		total_dues =extractNumericValue($("#total-outstanding-grams").html())-extractNumericValue($("#total-gold-receipts").html())-total_grams-extractNumericValue($("#total-cash-receipts").html());
		 total_dues = fixFloat(total_dues, 3);
		$('#total_dues').html(total_dues);
	}

	function getNumericValue(value){
		const parsedValue = parseFloat(value);
		if(isNaN(parsedValue)){
			return 0;
	}
	return parsedValue;
}
function extractNumericValue(element){
	return getNumericValue(element);
}
function fixFloat(element, precision){
	return parseFloat(element).toFixed(precision);
}
function add_making_charge(receipt_type){
		
		receipt_count=parseInt($("#making-count").val())+1;
		
		$("#making-count").val(receipt_count);
		
		category_options="<option value=''>-Select Transaction Type-</option><?php foreach($txn_array as $cat): echo "<option value='".$cat."'>".$cat."</option>"; endforeach; ?>";
		
		
		if(receipt_type=="cash"){
		
			if(metal_type=="gold"){
				rate_per_gram = $("#rate-per-gram").val();
		
		 	}
			 else rate_per_gram = $("#rate-per-gram-silver").val();
		// console.log(rate_per_gram);receipt-amount
			amount_input="<td><input placeholder='Amount' type='number' class='form-input input-micro-width making_amount_class' style='width:90px !important;' name='making_receipt["+receipt_count+"][total_amount]' id='making-amount-"+receipt_count+"' value='0' oninput='calculate_making_charge("+receipt_count+");' /><input type='hidden' name='making_receipt["+receipt_count+"][Payment_Method]' id='receipt-type-cash-"+receipt_count+"' value='cash' /></td>";
		
		}
			 
			 
			 item="<tr id='receipt-making-"+receipt_count+"'>"+
			 "<td><input placeholder='Enter Date' type='date' class='form-input input-date-width' name='making_receipt["+receipt_count+"][payment_date]' id='date-"+receipt_count+"' value='<?php echo date("d-m-Y")?>' required max='<?php echo date("Y-m-d"); ?>'  /></td>"+
			"<td><select class='form-select input-micro-width' name='making_receipt["+receipt_count+"][txn_type]' id='txn_type_-"+receipt_count+"' >"+category_options+"</select></td>"+
			 
			
			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='making_receipt["+receipt_count+"][notes]' id='additional-notes-deposit-"+receipt_count+"' /></td>"+amount_input+
			 
			 "<td><input type='button' class='form-button small-button bg-red' name='remove_receipt_"+receipt_count+"' id='remove-receipt-"+receipt_count+"' value='x'  onclick='remove_receipt(\"receipt-making-"+receipt_count+"\", \"making-count\")'/><input  type='hidden' class='form-input ' name='making_receipt["+receipt_count+"][Quality]'  value='100' required /><input type='hidden' name='making_receipt["+receipt_count+"][payment_for]'  value='making_charge'></td>"+	
			   
			 "</tr>";
			 
			 
			//  $("#making-charge-table>tbody>tr").eq(receipt_count-1).after(item);
			 $("#making-charge-table").append(item);
	
	}
//function to populate stone item
function stone_item_options(subcategory_id, row_id){
		
		const jitem_option=[];
		<?php
			 
			foreach($stone_types as $cat):
			
				foreach($cat['sub_stone_type'] as $sub_cat):
					$jitems="<option value=''>-Select Stone Item-</option>";
					
						foreach($sub_cat['stone_items'] as $jitem):
					
						$jitems=$jitems."<option value='".$jitem['id']."'>".$jitem['name']."</option>";			
						endforeach;
					?>
					jitem_option[<?php echo $sub_cat['id']; ?>]="<?php echo $jitems; ?>";
					<?php
				endforeach;			
			endforeach;
		?>		
		$("#stone-item-"+row_id).html(jitem_option[subcategory_id]);		
	}	

	//function to populate cash deposit record
	function add_stone_charge(receipt_type){
		
		receipt_count=parseInt($("#stone-count").val())+1;
		
		$("#stone-count").val(receipt_count);
		
		category_options="<option value=''>-Select Transaction Type-</option><?php foreach($txn_array as $cat): echo "<option value='".$cat."'>".$cat."</option>"; endforeach; ?>";
		
		
		if(receipt_type=="cash"){
		
			
			amount_input="<td><input placeholder='Amount' type='number' class='form-input input-micro-width stone_amount_class' style='width:90px !important;' name='stone_receipt["+receipt_count+"][total_amount]' id='stone-amount-"+receipt_count+"' value='0' oninput='calculate_stone_charge("+receipt_count+");' /><input type='hidden' name='stone_receipt["+receipt_count+"][Payment_Method]' id='receipt-type-cash-"+receipt_count+"' value='cash' /></td>";
		
		}
			 
			 
			 item="<tr id='receipt-stone-"+receipt_count+"'>"+
			 "<td><input placeholder='Enter Date' type='date' class='form-input input-date-width' name='stone_receipt["+receipt_count+"][payment_date]' id='date-"+receipt_count+"' value='<?php echo date("d-m-Y")?>' required  max='<?php echo date("Y-m-d"); ?>' /></td>"+
			"<td><select class='form-select input-micro-width' name='stone_receipt["+receipt_count+"][txn_type]' id='txn_type_-"+receipt_count+"' >"+category_options+"</select></td>"+
			 
			
			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='stone_receipt["+receipt_count+"][notes]' id='additional-notes-deposit-"+receipt_count+"' /></td>"+amount_input+
			 
			 "<td><input type='button' class='form-button small-button bg-red' name='remove_stone_"+receipt_count+"' id='remove-stone-"+receipt_count+"' value='x'  onclick='remove_receipt(\"receipt-stone-"+receipt_count+"\", \"stone-count\")'/><input  type='hidden' class='form-input ' name='stone_receipt["+receipt_count+"][Quality]'  value='100' required /><input type='hidden' name='stone_receipt["+receipt_count+"][payment_for]'  value='stone_charge'></td>"+	
			   
			 "</tr>";
			 
			 
			//  $("#stone-charge-table>tbody>tr").eq(receipt_count-1).after(item);
			 $("#stone-charge-table").append(item);
	
	}
	$( document ).ready(function() {
		categoryOptions = <?php echo json_encode($categories); ?>;
		itemOptions = <?php echo json_encode($j_items); ?>;
		metal_type = $("#metal_type").val();
		
	});
	function createItems(metal_type){		
		return "<option value=''>-Select J Items-</option>"
		  +itemOptions.filter(c=>c.metal_type ===metal_type)
		   .map(c=>"<option value='"+c.item_id+"'>"+c.item_name+"</option>").join("");
	}
	function calculate_making_charge(row_id=""){
		var total_making_amount = 0;
		
		total_making_charges = parseFloat($('#making-charges-total').html());
		total_amt_array=document.getElementsByClassName('making_amount_class');
		
		for(i=0; i<total_amt_array.length; i++){
			
			total_making_amount=total_making_amount+parseFloat(total_amt_array[i].value);
			
		}
		total_making_amount = fixFloat(total_making_amount, 2);
		$('#total_making_amount').html(total_making_amount);
		$('#mc_dues').html(fixFloat(total_making_charges-total_making_amount,2));
		
	}
	function calculate_stone_charge(row_id=""){
		var total_amt = 0;
		
		total_stone_charges = parseFloat($('#total-stone-charges').html());
		total_amt_array=document.getElementsByClassName('stone_amount_class');
		
		for(i=0; i<total_amt_array.length; i++){
			
			total_amt=total_amt+parseFloat(total_amt_array[i].value);
			
		}
		total_amt = fixFloat(total_amt, 2);
		$('#total_stone_amount').html(total_amt);
		console.log(total_stone_charges);
		console.log(total_amt);
		$('#stone_dues').html(fixFloat(total_stone_charges-total_amt,2));
	}
	// $('.custom-file input').change(function (e) {
    //     var files = [];
    //     for (var i = 0; i < $(this)[0].files.length; i++) {
    //         files.push($(this)[0].files[i].name);
    //     }
    //     $(this).next('.custom-file-label').html(files.join(', '));
    // });
	
	
	
</script>
<style>
	.input-micro-width{width:90px !important;}
	
	
	.custom-file-input, .custom-file-label {width:4rem !important;}
	.custom-file-label::after {width:10px !important;}
	.custom-file-control:before{
  content: "Browse";
}
.custom-file-control:after{
  content: "Add files..";
}
</style>
