<?php $txn_array = array("Cash","Online","Cheque"); 
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
                    <tr>
					           <th>Sl.No</th>
					           <th>Category</th>
					           <th>Sub Category</th>
					           <th>Notes</th>
					           <th>NW(Gm)</th>
					           <th>NW after Polish(Gm)</th>
					           <th>MC</th>
					           <!-- <th>Wastage %</th> -->
					           <th>Workshop</th>
					           <th><img src="<?php echo base_url('images/image_icon.png');?>" width=20></th>
					           <th>Status</th>
					</tr>
				  </thead>
				  <tbody>
					
				  
				
				<?php 
				$i=1;
				$total_req_grams=0; 
				
				$total_making_charges=0;
				$total_approx_grams=0;
				$total_wastage=0;
				$total_gold_balance=0;
				foreach($order['polish_items'] as $item): 
				
			
				?>
				
					 <tr>
					           <td><?php echo $i; ?></td>
					           <td><?php echo $item['Category_Name']; ?></td>
					           <td><?php echo $item['SubCategory_Name']; ?></td>
					           <td><?php echo $item['notes']; ?></td>
					           <td><?php echo $item['approx_grams']; ?></td>
					           <td><?php echo $item['nw_after_repair']; ?></td>
					         <td><?php echo $item['making_charges']; ?></td>
					         
					           <td><?php echo $item['Workshop_Name']; ?></td>
					      
					           <td>
							   <?php  echo ($item['receipt_file']!="") ? "<a target='_blank' href='".site_url("uploads/order_receipts/".$item['receipt_file'])."' data-lightbox='example-1' class='example-image-link'><img src='".site_url("uploads/order_receipts/".$item['receipt_file'])."' height='20px'></a>" : "" ?>
						</td>
						
					           <td><?php echo $item['status']; ?></td>
					</tr>
				
				<?php 
				
				$i++;
				$total_req_grams=$total_req_grams+$item['nw_after_repair'];
				$row_making_charges= $item['making_charges'] ; 
				$total_approx_grams=$total_approx_grams+ $item['approx_grams']; 
				$total_wastage=$total_wastage+ $item['wastage']; 
				$total_gold_balance=$total_gold_balance+ $item['gold_balance']; 
				$row_making_charges = round($row_making_charges,2);
				$total_making_charges=$total_making_charges+$row_making_charges;
				endforeach; ?>
				
				</tbody>
				<tfoot>
					<tr style="font-weight:bold">
						<td colspan=4></td>
						
						<td><span id="total_approx_grams"><?php echo number_format((float)$total_approx_grams, 3, '.', '') ?></span></td>
						<?php 
								if($order_type==$repair){
							?>
							<td class='hide_class'><span id="total-wastage"><?php //echo number_format((float)$total_wastage, 3, '.', ''); ?></span> </td>
							
							<td class='hide_class'><span id="total-gold-balance"><?php echo number_format((float)$total_gold_balance, 3, '.', ''); ?></span> </td>
							<?php } ?> 
							<td  ><span id="total-outstanding-grams"><?php echo number_format((float)$total_req_grams, 3, '.', ''); ?></span> </td>
							<td><span id="making-charges-total"><?php echo number_format((float)$total_making_charges, 2, '.', ''); ?></span> </td>
						
						<td></td>
					</tr>
				</tfoot>
				   </table>
			
			</div>
			
			
			
			<!-- <div class="card">
				<div class="card-header"><strong>Gold Receipts</strong> </div>
				<div class="card-body" id="gold-receipts" style="overflow-x:auto;">
				<table class="table table-bordered" id="gold-receipts-table">
					<tr>
						<td>Type</td>
						
						<td>Notes</td>
						<td>NW</td>
						<td>Grams</td>
						<td>Melting Loss/Stones</td>
						<td>Net Gold</td>
						<td>Quality %</td>
						<td>Pure Gold</td>
						<td>Copper@7%</td>
						<td>Final Grams (92.50%)</td>
						
					</tr>
					
					<?php 
					
						$count=0;
						$total_receipts=0;
					foreach($order['payments'] as $op): 
						print_r($op);
						$count++;
						
						
						
						
		
		
		
		$net_gold_receipt=$op['Grams']-$op['melting_loss'];
		
		
		
		$pure_gold=$net_gold_receipt*($op['Quality']/100);
		
		$copper=$pure_gold*(7/100);
		
		if($op['Payment_Method']=="cash"){
		
			$copper=0;
			
		}
		
		$final_grams= $pure_gold+$copper;

			$total_receipts=$total_receipts+$final_grams;
						
					?>
					<tr id='receipt-row-<?php echo $count; ?>'>
					<td><?php echo $op['Payment_Method']; ?></td>
						<td><?php echo $op['Category_Name']; ?>
					
						</td>
						<td>
							
						</td>
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
						<td id="net-deposit-grams-<?php echo $count; ?>"><?php echo $net_gold_receipt; ?></td>
						<td><?php echo $op['Quality']; ?></td>
						<td id="pure-gold-grams-<?php echo $count; ?>"><?php echo $pure_gold; ?></td>
						<td id="copper-grams-<?php echo $count; ?>"><?php echo $copper; ?></td>
						<td id="final-receipt-grams-<?php echo $count; ?>"><?php echo $final_grams; ?></td>
						
					</tr>
					<?php endforeach; ?>
					
				</table>
			
			</div>
			
			<div class="card-body text-right">
			
			<strong>Total Gold Receipts: </strong> <span id="total-gold-receipts"><?php echo $total_receipts; ?></span> Grams
			
			</div></div>
			
			<div class="card"><div class="card-body text-right">
			
			<strong>Oustanding Grams: </strong> <span style="color:red;" id="total-gold-receipts"><?php echo $total_req_grams-$total_receipts; ?> Grams</span> 
			
			</div></div>
			
			<div class="card"><div class="card-body">
			
			<div class="form-row blocks-right">
					
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("order/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
			
			</div></div> -->
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
					
						<td>Date</td>
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
						$balance = ($order['rate_per_gram']*$total_gold_balance)+$total_making_charges-$total_cash_amt;
						echo  number_format((float)$balance, 2, '.', ''); ?></span> </td>
						
						<td></td>
					</tr>
					<tr  style="font-weight:bold">
						<td colspan=6><strong> Total Dues</strong></td>
						
						 <td><span ><?php 
						 echo number_format((float)($total_req_grams-$total_approx_grams), 3, '.', ''); ?></span> </td>
						
					</tr>
				</table>
			
			</div>
		</div>
	
	</div> 
</div>


	</div>
</div>
</div></div></div></div>
</section>
</div>


