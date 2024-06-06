<!-- Content Wrapper. Contains page content -->
<?php 
	$txn_array = array("Cash","Online","Cheque");
	$metal_type = $this->input->get("metal_type");
	$metal_print_name = ucfirst($metal_type);
?>

<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $metal_print_name ?> Order </h1>
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
				<div>
	<div  class="" data-aos="fade-up">
		
<div id='create-form'>
<!-- <h1 class='h1-title'></h1> -->
<div class="form-div">
	
	<div class="validation-errors"><?php echo validation_errors(); ?></div>
	<form action="<?php echo site_url("order/create_new_order"); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id" autocomplete="off">
		<input type='hidden' id='cust-code-selected' name='Customer_Code_Selected' value='<?php echo $this->input->get("customer_id"); ?>' required />
		<input type='hidden' id='metal_type' name='metal_type' value="<?php echo $metal_type ?>" />
		<input type='hidden' id='order_type' name='order_type' value="custom jewellery" />
		
		<input type="hidden" id="grams_total_final-100000" name="grams_total_final[]" value="0" />
		
		<input type="hidden" id="total-final-receipt-grams-100000" name="total_final_receipt_grams[]" value="0" />
		
		<input type="hidden" id="rate-per-gram" name="rate_per_gram"  value="<?php echo $rate_per_gram_gold; ?>" />
		<input type="hidden" id="rate-per-gram-silver" name="rate_per_gram_silver"  value="<?php echo $rate_per_gram_silver; ?>" />
		<input type="hidden" id="total-gold-receipts-value"   value="0" />
		<input type="hidden" id="total-silver-receipts-value"   value="0" />
		
		<div class="form-block">
			
			<div class="card"><div class="card-body">
			
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Order Date</label>
					<input type="text" class="form-input" name="order_date" value="<?php echo set_value('order_date', date('d-m-Y')); ?>" autocomplete="off" disabled="disabled"/>
				</div>
				
				<!-- <div class="form-column">
					<label class="radio-label">Order ID</label>
					<?php $order_id='SO-'.'1/'.date('Y'); ?>
					<input type="text" class="form-input" name="order" value="<?php echo set_value('order', $order_id); ?>"  autocomplete="off" disabled="disabled"/>
					<input type="hidden" class="form-input" name="order_id" value="<?php echo set_value('order_id', $order_id); ?>" />
				</div> -->
				<?php $order_id=date('dmY')."-".rand(100,999); ?>
				<input type="hidden" class="form-input" name="order_id" value="<?php echo set_value('order_id', $order_id); ?>" />
				<div class="form-column">
					<label class="radio-label">Metal Type</label>
					<select class="form-select" name="metal_type_select"  onchange="get_metal_type($(this).val())" required id="metal_type_select">
						<option value="">Not Selected</option>
						<option value="gold" <?php echo ($metal_type=="gold") ? " selected": "" ?>>Gold</option>
						<option value="silver" <?php echo ($metal_type=="silver") ? " selected": "" ?>>Silver</option>
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
					
					<!-- <input type="hidden" name="Customer_Code" value="<?php echo $this->input->get("customer_id"); ?>" required/> -->
					
					<?php
					
					$customer="";
					
					if($this->input->get("customer_id")){
						$query=$this->db->query("select * from customers where Customer_Code=?", $this->input->get("customer_id"));
						$customer=$query->row_array();
					}
					?>
					
					<div id='customer-full-name' style="background:#fcfcfc;">
						<?php
						
							if($customer){ ?>
								
								<?php echo $customer['Customer_Name']; ?><br/>
								<?php echo $customer['Customer_Mobile_Number1']; ?><br/>
								<?php echo $customer['Customer_Email']; ?><br/>
								<?php echo $customer['Customer_Billing_address']; ?><br/>
								<?php echo $customer['Customer_City']." - ".$customer['Customer_Pincode']; ?>
									
								<?php	
								}
										
						?>
					</div>
				</div>
				
				<div class="form-column">
					<button type="button" class="form-button small-button" name="select_customer" onclick="add_customer_popup();">+ Add/Change Customer</button>
				</div>
				<div class="clear"></div>
				
			</div>


			</div></div> <!--card ends-->
			
			<!--items block-->
			<input type="hidden" name="item-count" id="item-count" value="0" />
			
			<div class="card">
				<div class="card-header"><strong> Order Items</strong> <a class="form-button small-button" onclick='add_item();'> + </a></div>
				<div class="card-body" id="order-items" style="overflow-x:auto;">
				<table class="table table-bordered" id="order-items-table">
					<tr>
						<td>J Type</td>
						<td>J Sub Type</td>
						<td>J Items</td>
						<td>Notes</td>
						<td>Workshop</td>
						<td>Approx Grams</td>
						<td>Wastage </td>
						<td>Total Grams</td>
						<td>MC (Rs)</td>
						<td><img src="<?php echo base_url('images/image_icon.png');?>" width=15></td>
						<td>Action</td>
					</tr>
					<tfoot>
					<tr style="font-weight:bold">
					<td colspan=5></td>
					
					<td><span id="total_approx_grams"><?php echo $total_approx_grams ?></span></td>
						<td><span id="total-wastage"><?php //echo number_format((float)$total_wastage,2, '.', ''); ?></span> </td>
						<td><span id="total-outstanding-grams"><?php echo number_format((float)$total_req_grams,2, '.', ''); ?></span> </td>
						<td><span id="making-charges-total"><?php echo number_format((float)$total_making_charges, 2, '.', ''); ?></span> </td>
					
					<td></td>
				</tr>	
							</tfoot>
				</table>
			
			</div>
			
			<!-- <div class="card-body text-right">
			
			<strong>Total Required Grams: </strong> <span id="total-outstanding-grams">0</span> &nbsp;&nbsp;
			<strong>Total Making Charges: Rs.</strong> <span id="making-charges-total">0</span>
			
			</div> -->
			
			</div>
			
			
			<!--stones block-->
			<input type="hidden" name="stones-count" id="stones-count" value="0" />
			
			<div class="card">
				<div class="card-header"><strong> Stones</strong> <a class="form-button small-button" onclick='add_stone();'> + </a></div>
				<div class="card-body" id="order-stones" style="overflow-x:auto;">
				<table class="table table-bordered" id="order-stones-table">
					<tr>
						<td>Stone Type</td>
						<td>Stone Sub Type</td>
						<td> Items</td>
						<td>Quantity</td>
						<td><div id="">Ct/Pc</div></td>
						<!-- <td>Grams</td> 
						<td>Carat</td>-->
						<td>Rate per Unit(Rs)</td>
						<td>Total(Rs)</td>
						<td>Action</td>
					</tr>
					<tfoot>
					<tr  style="font-weight:bold">
					<td colspan=3></td>
					<td><span id="total_quantity"></span></td>
					<td><span id="total_stone_size"></span></td>
					<td></td>
						<td><span id="total-stone-charges"></span></td>
					
					<td></td>
				</tr>	
							</tfoot>
				</table>
			
			</div>
				<!-- <div class="card-body text-right">
				<strong>Total Stone Charges: </strong> Rs.<span id="total-stone-charges">0</span>
				</div> -->
			</div>
			<!-- Cash block -->
			<div class="card">
				<?php $rate_per_gram =0;
					if($metal_type=="gold"){
						// $rate_per_gram_silver=0;
						$rate_per_gram= $rate_per_gram_gold;
					}
					else {
						// $rate_per_gram_gold=0;
						$rate_per_gram= $rate_per_gram_silver;
					}
				?>
				<input type="hidden" name="cash-count" id="cash-count" value="0" />
				<div class="card-header"><strong> Cash Receipts</strong>  <a class="form-button small-button"  onclick='add_cash("cash");' id="add_cash" style='display:none' > + </a> 
				&nbsp;<span style="color:red;display:none" id="today_rate" ><button type="button" class="form-button small-button" name="select_customer" onclick="add_rate();">Add today's <?php echo $metal_type ?> rate </button></span>  </div>
					<!-- <div class="card-header"><strong> Cash Receipts</strong> <?php if($rate_per_gram>0): ?> <a class="form-button small-button"  onclick='add_cash("cash");'> + </a> <?php else: ?>&nbsp;<a href="<?php echo site_url("rate/browse?create_form=yes&metal_type=$metal_type"); ?>"><span style="color:red;"><button type="button" class="form-button small-button" name="select_customer" onclick="add_rate();">Add today's <?php echo $metal_type ?> rate </button></span> </a><?php endif;  ?>  </div> -->
				<div class="card-body" id="cash-receipts" style="overflow-x:auto;">
				<table class="table table-bordered" id="cash-receipts-table">
					<tr>
					<!--	<td>JType</td>-->
						<td>Select date</td>
						<td>Payment Type</td>
						<td>Notes</td>
						<td>Amount</td>
						<!-- <td>Payment type</td> -->
						<td>Grams</td>
						<!-- <td>Total Grams</td> -->
						<td>Action</td>
					</tr>
					
					
					<tfoot>
					<tr  style="font-weight:bold">
						<td colspan=3></td>
						
						<td><span id="total_cash_amount"><?php echo $total_cash_amt ?></span></td>
						 <td><span id="total-cash-receipts"></span> </td>
						
						<td></td>
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
				
				<input type="hidden" name="making-count" id="making-count" value="0" />
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
					<tfoot>
					<tr  style="font-weight:bold">
						<td colspan=3></td>
						
						<td><span id="total_making_amount"><?php echo $total_cash_amt ?></span></td>
						 <td><span ></span> </td>
						
						<td></td>
					</tr>
					</tfoot>
				</table>
			
			</div>
			
			<!-- <div class="card-body text-right">
			
			<strong>Total Cash Receipts: </strong> <span id="total-cash-receipts">0</span> Grams
			
			</div> -->
		</div>
			<!-- Cash block End-->
			<!--receipts block-->
			
			
			
			<div class="card <?php echo ($metal_type=="gold") ? "" : "d-none" ?>" id="gold_block">
				<input type="hidden" name="receipt-count" id="receipt-count" value="0" />
				<div class="card-header"><strong>Gold Receipts</strong> <a class="form-button small-button" style="background:#e2ad37;" onclick='add_gold("gold");'> + </a> </div>
				<div class="card-body" id="gold-receipts" style="overflow-x:auto;">
				<table class="table table-bordered" id="gold-receipts-table">
					<tr>
					<td>Date</td>
						
						<td>J Items</td>
						
						<td>Notes</td>
						
						<td>Grams</td>
						<td>Melting Loss/<br/>Stones</td>
						<td>Net Gold</td>
						<td>Quality %</td>
						<td>GC<br/>Quality %</td>
						<td>Pure Gold</td>
						<td>Copper@7%</td>
						<td>Final Grams</td>
						<td> </td>
						<td>Action</td>
					</tr>
					<tfoot>
					<tr  style="font-weight:bold">
						<td colspan=3></td>
						
						<td><span id="total_gold_grams"></span></td>
						<td><span id="gold_melting_loss"></span></td>
						<td><span id="net_gold"></span></td>
						<td></td>
						<td></td>
						 <td><span id="total-pure-receipts"></span> </td>
						 <td></td>
						 <td><span id="total-gold-receipts"></span> </td>
						<td colspan=2></td>
					</tr>
				</tfoot>
				</table>
			
			</div>
			
		</div>
			
			<!--silver receipt block-->
			
			<div class="card <?php echo ($metal_type=="silver") ? "" : "d-none" ?>"  id="silver_block" >
			<input type="hidden" name="silver-receipt-count" id="silver-receipt-count" value="0" />
			<div class="card-header"><strong> Silver Receipts</strong> <a class="form-button small-button" style="background:#e2ad37;" onclick='add_silver();'> + </a></div>
				<div class="card-body" id="silver-receipts" style="overflow-x:auto;">
				<table class="table table-bordered" id="silver-receipts-table">
					<tr>
					
						<td>Date</td>
						<!-- <td>J Type</td>
						<td>J Sub Type</td> -->
						<td>J Items</td>
						<td>Notes</td>
						<td>Grams</td>
						<td>Melting Loss</td>
						<td>Net Silver</td>
						<td>Quality %</td>
						<td>Pure Silver</td>
						<td> </td>
						<td>Action</td>
					</tr>
					<tfoot>
					<tr  style="font-weight:bold">
						<td colspan=3></td>
						
						<td><span id="total_silver_grams"></span></td>
						<td><span id="total_melting_loss"></span></td>
						<td><span id="net_silver"></span></td>
						<td></td>
						
						 <td><span id="total-silver-receipts"></span> </td>
						
						<td colspan=2></td>
					</tr>
				</tfoot>
				</table>
			
			</div>
			
			<!-- <div class="card-body text-right">
			
			<strong>Total Silver Receipts: </strong> <span id="total-silver-receipts">0</span> Grams
			
			</div> -->
		</div><!--silver receipt block ends-->
		<!-- Cash block -->
		<div class="card">
				
				<input type="hidden" name="stone-count" id="stone-count" value="0" />
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
					<tfoot>
					<tr  style="font-weight:bold">
						<td colspan=3></td>
						
						<td><span id="total_stone_amount"><?php echo $total_cash_amt ?></span></td>
						 <td><span id="total-stone-receipts"></span> </td>
						
						<td></td>
					</tr>
				</tfoot>
				</table>
			
			</div>
			
		</div>
			<!-- Cash block End-->
		
			<!--Total Dues block-->
			<div class="card">
				<div class="card-header text-right" style="margin-right:22px;"><strong>Total Dues</strong></div>
				<div class="card-body">
			
			<div class="form-row">
				<div class="form-column">
					
					
				</div>
				<div class="card-body text-right">
			
			<strong>
				<!-- Total Dues:  -->
				<span id="total_dues">0 </span> Grams</strong> 
			<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<!-- Stone Dues:  -->
				Rs<span id="stone_dues"> 0</span></strong> 
			<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<!-- MC Dues: -->
				Rs <span id="mc_dues"> 0</span></strong> 
			
			</div>
				
			</div>


			</div>
		</div> <!--total dues ends-->
			
			
			<div class="card"><div class="card-body">
			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Submit" />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("order/browse?metal_type=$metal_type"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
			
			</div></div> <!--card ends-->
			
		</div>
	</form>
	
	</div>
</div>


	</div>
</div>
</div></div></div></div>
</section>
</div>
<script>
		$('input[type=number').keyup(function() {
			var val = $(this).val();
			//   alert(val);
			if(val == 0)
			{
			$(this).val(/^0+/, '');
			}
		});

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
		var item_count = 0;
		var cashcounter = 0;
		var goldcounter = 0;
		var silvercounter = 0;
	$(document).ready(function(){
		
		$("#create-form-id").validate({
			ignore: [],
			rules: {
				metal_type_select: { required: true },
				Customer_Code_Selected: { required: true },
				// "receipt_order_file[]": {       
				// 	extension: "png|jpe?g|gif" // Example: allowed file extensions
				// }
			},
			messages: {
				"Customer_Code_Selected": {
					required: "Please select the customer"
				},
				// "receipt_order_file[]": {
		
				// extension: "Only PNG, JPG, and GIF files are allowed"
				// }
			},
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
	
	
	function get_metal_type(metal){
		
		if(metal=="silver"){
			$("#silver_block").removeClass("d-none");
			$("#gold_block").addClass("d-none");
			$("#metal_type").val("silver");
			
			if(metal){			
				$.post("<?php echo site_url("rate/get_metal_rate"); ?>", {metal_type:metal}, function(data){
			
					var result=JSON.parse(data);
					
					if(result.status==false){
						$("#today_rate").show();
						$("#add_cash").hide();
					}
					else{
						if(result.metal_type=="silver"){
							$("#today_rate").hide();
							$("#add_cash").show();
						}
						$("#today_rate").hide();
					}
									
				});	
				
			}	
		}
		else{
			if(metal){			
				$.post("<?php echo site_url("rate/get_metal_rate"); ?>", {metal_type:metal}, function(data){
			
					var result=JSON.parse(data);
					
					if(result.status==false){
						$("#today_rate").show();
						$("#add_cash").hide();
					}
					else{
						if(result.metal_type=="gold"){
						$("#today_rate").hide();
						$("#add_cash").show();
						}
						$("#today_rate").hide();
					}			
				});			
		}	
			$("#silver_block").addClass("d-none");
			$("#gold_block").removeClass("d-none");
			$("#metal_type").val("gold");
		}
		createCategoryOption(metal);
	}
	//function to get making charges and wastage
	function get_item_config(item_id, div_id){
		
		if(item_id){			
				$.post("<?php echo site_url("order/get_jitem"); ?>", {item_id:item_id}, function(data){
			
					var result=JSON.parse(data);
					// console.log(result);
					var wastage_type = result.subcat.wastage_type;
					if(wastage_type=="percent"){
						$("#wastage-"+div_id).val(parseFloat(result.subcat.wastage_percent));
					}
					else{
						$("#wastage-"+div_id).val(parseFloat(result.subcat.wastage_percent));
					}
					$("#wastage_type-"+div_id).val(wastage_type);
					
					//making charges set in input
					$("#making-charge-per-gram-"+div_id).val(parseFloat(result.subcat.making_charges_per_gram));
					
					calculate_total_grams(div_id);					
				});			
		}		
	}
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
				
				"<div class='form-row'><div class='form-column'><label class='radio-label'>Enter Contact Number</label><input type='number' class='form-input' name='contact_number' id='cust-mobile' placeholder='Phone Number' minlength='10' maxlength='12' oninput='search_populate_customer();' autocomplete='nope' required/></div><div class='form-column'><label class='radio-label'>Email</label><input type='email' id='cust-email' class='form-input' name='email' placeholder='Email' autocomplete='nope' required/></div><div class='clear'></div></div>"+
			
				"<div class='form-row'><div class='form-column'><label class='radio-label'>Customer Name</label><input type='text' class='form-input' name='full_name' placeholder='Customer Name' id='cust-name' minlength='5' maxlength='100' autocomplete='nope' required/></div><div class='form-column'><label class='radio-label'>Address</label><input type='text' id='cust-address' class='form-input' name='address' placeholder='Address' autocomplete='nope' required/></div><div class='clear'></div></div>"+
				
				"<div class='form-row'><div class='form-column'><label class='radio-label'>Pincode</label><input type='text' id='cust-pincode' class='form-input' name='pincode' placeholder='Pincode' autocomplete='nope' required/></div><div class='form-column'><label class='radio-label'>City</label><input type='text' class='form-input' name='city' placeholder='City Name' id='cust-city' autocomplete='nope' required/></div><div class='clear'></div></div>"+
				
				"<div class='form-row'><div class='form-column'><label class='radio-label'>PAN Number</label><input type='text' id='cust-pan' class='form-input' name='pan' placeholder='PAN Number' autocomplete='nope' required/></div><div class='form-column'><label class='radio-label'>Opening Gold Balance (gms)</label><input type='text' class='form-input' name='opening_balance' id='cust-opening-balance' placeholder='Gold Balance in Grams' autocomplete='nope' required/></div><div class='clear'></div></div>"+

				"<div class='form-row'><div class='form-column'><label class='radio-label'>Making Charge</label><input type='text'  class='form-input' name='making_charge' id='cust_making_charge' placeholder='Making Charge' autocomplete='nope' /></div><div class='form-column'><label class='radio-label'>Opening Silver Balance (gms)</label><input type='text' class='form-input' id='silver_opening_balance' name='silver_opening_balance'  placeholder='Silver Balance in Grams' autocomplete='nope' /></div><div class='clear'></div></div>"+

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
					$('#cust_making_charge').val(result.making_charge);
					$('#silver_opening_balance').val(result.silver_opening_balance);
					
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
		silver_opening_balance=$('#silver_opening_balance').val();
		making_charge=$('#cust_making_charge').val();
		
		phone=$('#cust-mobile').val();
		
		
		if(customer_code.length>0){
			
			$("#cust-code-selected").val(customer_code);
			$("#customer-full-name").html(customer_name+"<br/>"+phone+"<br/>"+email+"<br/>"+address+"<br/>"+city+" - "+pincode);
			
			$.post("<?php echo site_url("order/ajax_update_customer"); ?>", {customer_code:customer_code,customer_name:customer_name,email:email,address:address,pincode:pincode,city:city,pan:pan,opening_balance:opening_balance,phone:phone,silver_opening_balance:silver_opening_balance,making_charge:making_charge}, function(data){
			
			});
			
		
		} else {
						
			$.post("<?php echo site_url("order/ajax_update_customer"); ?>", {customer_name:customer_name,email:email,address:address,pincode:pincode,city:city,pan:pan,opening_balance:opening_balance,phone:phone,silver_opening_balance:silver_opening_balance,making_charge:making_charge}, function(data){
				
				json_obj=JSON.parse(data);
				
				$("#cust-code-selected").val(json_obj.Customer_Code);
				$("#customer-full-name").html(customer_name+"<br/>"+phone+"<br/>"+email+"<br/>"+address+"<br/>"+city+" - "+pincode);
				
				alert("customer created!");
					
			});
			
		}
		
		hide_popup();
		
		
		return false;
	}
	
	function submit_rate(){
		
		metal_type=$('#metal_type_rate').val();
		metal_type_select=$('#metal_type_select').val();
		 
		metal_rate=$('#metal_rate').val();
		if(metal_type=="silver"){
			$("#rate-per-gram-silver").val(metal_rate);
		}
		else $("#rate-per-gram").val(metal_rate);
		
		
		if(metal_rate.length>0){
			
			
			$.post("<?php echo site_url("order/ajax_add_rate"); ?>", {metal_type:metal_type,metal_rate:metal_rate}, function(data){
				var result=JSON.parse(data);
					if(result.status==false){
						alert(result.message);
					}
					else{
						const str = metal_type;
						const str2 = str.charAt(0).toUpperCase() + str.slice(1);
						alert(str2 + " rate added successfully!");
					}
			});
			
			
			if(metal_type==metal_type_select){
				$("#add_cash").show();
				$("#today_rate").hide();
			}
			
		
		} 
		else {
			alert("Add "+ metal_type + " rate !");
		// 	$.post("<?php echo site_url("order/ajax_add_rate"); ?>", {metal_type:metal_type,metal_rate:metal_rate}, function(data){
		// 		status = 
		// 		
		// });
		// if(metal_type==metal_type_select)
		// $("#add_cash").show();
		
					
			
			
		}
		
		hide_popup();
		
		
		return false;
	}
	
	function createCategoryOption(metal_type){		
		return "<option value=''>-Select J Type-</option>"
		  +categoryOptions.filter(c=>c.metal_type ===metal_type)
		   .map(c=>"<option value='"+c.Category_ID+"'>"+c.Category_Name+"</option>").join("");
	}
	function createItems(metal_type){		
		return "<option value=''>-Select J Items-</option>"
		  +itemOptions.filter(c=>c.metal_type ===metal_type)
		   .map(c=>"<option value='"+c.item_id+"'>"+c.item_name+"</option>").join("");
	}
	//function to populate item
	function add_item(){
		
		
		item_count++;
		metalType = $("#metal_type").val();
		if(metalType===""){
			alert("Please select metal type first");
			return;
		}
		// item_count=parseInt($("#item-count").val())+1;
		
		$("#item-count").val(item_count);
		
		category_options=createCategoryOption(metalType);
		
		workshop_options="<option value=''>-Select Workshop-</option><?php foreach($workshops as $ws): echo "<option value='".$ws['Workshop_Code']."'>".$ws['Workshop_Name']."</option>"; endforeach; ?>";
			 
			 
			 item="<tr id='item-row-"+item_count+"'>"+
			 "<td><select class='form-select input-micro-width' name='item["+item_count+"][Category_ID]' id='category-"+item_count+"' onchange='sub_category_options($(this).val(), "+item_count+");' >"+category_options+"</select></td>"+
			 
			 "<td><select class='form-select input-micro-width' name='item["+item_count+"][SubCategory_ID]' id='sub-category-"+item_count+"' onchange='jitem_options($(this).val(), \""+item_count+"\");' ><option value=''>-Sub J Type-</option></select></td>"+	
			 
			 "<td><select class='form-select input-micro-width' name='item["+item_count+"][item_id]' id='jitem_id-"+item_count+"' onchange='get_item_config($(this).val(), \""+item_count+"\");' ><option value=''>- J Items-</option></select></td>"+	

			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='item["+item_count+"][notes]' id='additional-notes-"+item_count+"' /></td>"+	
			 
			 "<td><select class='form-select input-micro-width' name='item["+item_count+"][Workshop_Code]' id='workshop-"+item_count+"' >"+workshop_options+"</select></td>"+
			 
			 "<td><input placeholder='Approx Grams' type='number' class='form-input input-micro-width approx_gram_class' style='width:62px !important;' name='item["+item_count+"][approx_grams]' id='approx-grams-"+item_count+"' value='0' oninput='calculate_total_grams("+item_count+")' /></td>"+
			 
			 	
			  "<td><span id='wastage_value-"+item_count+"'></span><input placeholder='Wastage' type='hidden' class='form-input input-micro-width total_wastage_class' style='width:50px !important;'  id='wastage-"+item_count+"' value='0' oninput='calculate_total_grams("+item_count+")' readonly /><input type='hidden' id='wastage_gram-"+item_count+"' name='item["+item_count+"][wastage]' ><input type='hidden' id='wastage_type-"+item_count+"' /></td>"+	
			  
			    "<td id='total-grams-"+item_count+"'>0</td>"+
			    "<td id='making-charges-"+item_count+"' class='making-charge-rs'>0</td>"+
				"<td><div class='custom-file'><input type='file' name='receipt_order_file["+item_count+"]'   class='custom-file-input'  id='orderFile"+item_count+"' /><label class='custom-file-label' for='orderFile"+item_count+"'>Choose file</label></div></td>"+
			   "<td><input type='hidden'    id='making-charge-per-gram-"+item_count+"' value='0' ><input type='hidden' name='item["+item_count+"][making_charges]' id='making-charge-"+item_count+"' value='0' ><input type='button' class='form-button small-button bg-red' name='remove"+item_count+"' id='remove-"+item_count+"' value='x'  onclick='remove_item(\"item-row-"+item_count+"\", \"item-count\")'/><input type='hidden' id='grams_total_final-"+item_count+"' name='grams_total_final[]' value='0' /></td>"+	
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
	//function to populate sub category
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
	//function to populate J item
	function jitem_options(subcategory_id, row_id){
		
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
		$("#jitem_id-"+row_id).html(jitem_option[subcategory_id]);		
	}

	//function to populate receipt J item
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
	//function to remove item
	//function to remove item
	function remove_item(id, count_id=""){

$("#"+id).remove();
// if(count_id!=""){
// 	$("#"+count_id).val(parseInt($("#"+count_id).val())-1);
// }

update_total_outstanding_grams();

}
	
	//calculate total grams
	function calculate_total_grams(row_id){
		
		approx_grams=parseFloat($('#approx-grams-'+row_id).val());
		
		wastage_percent=parseFloat($('#wastage-'+row_id).val());
		// wastage_gram=parseFloat($('#wastage_gram-'+row_id).val());
		wastage_type=$('#wastage_type-'+row_id).val();
		
		making_charge_percent=parseFloat($('#making-charges-'+row_id).val());
		making_charge_per_gram=parseFloat($('#making-charge-per-gram-'+row_id).val());
		
		//making_charges=net_total*parseInt(making_charge_per_gram);
		
	
		if(wastage_type=="gram"){
			gross_total=(approx_grams+wastage_percent);
			wastage_value = wastage_percent;
			making_charges=making_charge_per_gram;
		}
		else if(wastage_type=="percent"){
			wastage_value = (approx_grams*wastage_percent/100);
			gross_total=(approx_grams+wastage_value);
			making_charges=approx_grams*(making_charge_per_gram);
			
		}
		//net_total=gross_total+(gross_total*making_charge_percent/100);
		net_total=gross_total;
		net_total=convert_to_grams(net_total);
		
		$('#total-grams-'+row_id).html(net_total);
		
		wastage_value = convert_to_grams(wastage_value);
		making_charges = parseFloat(making_charges).toFixed(2);
		$("#making-charge-"+row_id).val(making_charges);
		$("#making-charges-"+row_id).html(making_charges);
		$("#wastage_value-"+row_id).html((wastage_value));
		$("#wastage_gram-"+row_id).val((wastage_value));
		
		$('#grams_total_final-'+row_id).val(net_total);
		
		update_total_outstanding_grams();
		
		return net_total;
		
		
		
	}
	
	//update total outstanding
	function update_total_outstanding_grams(){
		
		total_array=document.getElementsByName('grams_total_final[]');
		total_approx_gram=document.getElementsByClassName('approx_gram_class');
		total_grams=0;
		
		for(i=0; i<total_array.length; i++){
			
			
			total_grams=total_grams+parseFloat(total_array[i].value);
			
		}
		
		$('#total-outstanding-grams').html(convert_to_grams(total_grams));
		
		
		//update making charges total
		making_charges_array=$(".making-charge-rs");
		
		net_making_charges=0;
		
		making_charges_array.each(function(){
			
			making_charge=convert_to_number($(this).html());
			net_making_charges = net_making_charges + parseFloat(making_charge);
		
		});
		total_wastage_array=$(".total_wastage_class");
		
		net_wastage=0;
		
		total_wastage_array.each(function(){
			
			wastage=convert_to_number($(this).val());
			net_wastage = net_wastage + parseFloat(wastage);
		
		});
		total_approx_grams=0;
		for(i=0; i<total_approx_gram.length; i++){
			
			total_approx_grams=total_approx_grams+parseFloat(total_approx_gram[i].value);
			
		}
		total_approx_grams = convert_to_grams(total_approx_grams);
		$('#total_approx_grams').html(total_approx_grams);
		//$('#total-wastage').html(net_wastage);
		$('#making-charges-total').html(parseFloat(net_making_charges).toFixed(2));
		total_dues = extractNumericValue($("#total-outstanding-grams").html())-extractNumericValue($("#total-gold-receipts-value").val())-extractNumericValue($("#total-silver-receipts-value").val())-extractNumericValue($("#total-cash-receipts").html());
		// console.log(extractNumericValue($("#total-outstanding-grams").html())+"here"+total_dues);
		total_dues = convert_to_grams(total_dues);
		$('#total_dues').html(total_dues);
		total_making_amount = parseFloat($('#total_making_amount').html().replace(/,/g, ''));
		if(isNaN(total_making_amount)){
			total_making_amount = 0;
		}
		$('#mc_dues').html(fixFloat(net_making_charges-total_making_amount,2));
		
	}
	
	var categoryOptions;
	//function to populate deposit record
	function add_gold(receipt_type){
		
		receipt_count=parseInt($("#receipt-count").val())+1;
		
		$("#receipt-count").val(receipt_count);
			
		category_options="<option value=''>-Select J Type-</option><?php foreach($categories as $cat): echo "<option value='".$cat['Category_ID']."'>".$cat['Category_Name']."</option>"; endforeach; ?>";
		metalType = $("#metal_type").val();
		if(metalType===""){
			alert("Please select metal type first");
			return;
		}
		category_options=createCategoryOption(metalType);
		item_options=createItems(metalType);
		amount_input="<input type='hidden' name='receipt["+receipt_count+"][Payment_Method]' id='receipt-type-"+receipt_count+"' value='gold' />";
		
		if(receipt_type=="cash"){
		
		//	amount_input="<td><input placeholder='Amount' type='number' class='form-input input-micro-width' style='width:90px !important;' name='receipt["+receipt_count+"][total_amount]' id='receipt-amount-"+receipt_count+"' value='0' onkeyup='amount_to_grams("+receipt_count+");' /><input type='hidden' name='receipt["+receipt_count+"][Payment_Method]' id='receipt-type-"+receipt_count+"' value='cash' /><input type='hidden' name='receipt["+receipt_count+"][rate_per_gram]' id='rate-per-gram-"+receipt_count+"' value='<?php echo $rate_per_gram_gold; ?>'></td>";
		
		}
			 
			 
			 item="<tr id='receipt-row-"+receipt_count+"'>"+
			 "<td><input placeholder='Enter Date' type='date' class='form-input input-date-width' name='receipt["+receipt_count+"][payment_date]' id='date-"+receipt_count+"' value='<?php echo date("d-m-Y")?>' required style='width:100px !important' max='<?php echo date("Y-m-d"); ?>' /></td>"+
			//  "<td><select class='form-select input-micro-width' name='receipt["+receipt_count+"][Category_ID]'  onchange='sub_category_receipt($(this).val(), "+receipt_count+");' >"+category_options+"</select></td>"+
			 
			//  "<td><select class='form-select input-micro-width' name='receipt["+receipt_count+"][SubCategory_ID]' id='sub-category-receipt-"+receipt_count+"' onchange='jitem_options_receipt($(this).val(), \""+receipt_count+"\");' ><option value=''>-Sub J Type-</option></select></td>"+	
			 
			 "<td><select class='form-select input-micro-width' name='receipt["+receipt_count+"][item_id]' id='jitem_id_receipt-"+receipt_count+"'  >"+item_options+"</select></td>"+	
			// "<td><select class='form-select input-micro-width' name='receipt["+receipt_count+"][Category_ID]' id='receipt-category-"+receipt_count+"' onchange='sub_category_options_deposit($(this).val(), "+receipt_count+");' >"+category_options+"</select></td>"+
			 
			// "<td><select class='form-select input-micro-width' name='receipt["+receipt_count+"][SubCategory_ID]' id='sub-category-deposit-"+receipt_count+"' ><option value=''>-Sub J Type-</option></select></td>"+	
			//  "<td>"+receipt_type+amount_input+"</td>"+
			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='receipt["+receipt_count+"][notes]' id='additional-notes-deposit-"+receipt_count+"' />"+amount_input+"</td>"+
			 
			 
			 "<td><input placeholder='Grams' type='number' class='form-input input-micro-width gold_gram_column_class' style='width:70px !important;' name='receipt["+receipt_count+"][Grams]' id='receipt-grams-"+receipt_count+"' value='0' oninput='calculate_receipt_grams("+receipt_count+");' /></td>"+
			 
			 "<td><input placeholder='Melting Loss (gms)' type='number' class='form-input input-micro-width melting_gold_column_class' style='width:50px !important;' name='receipt["+receipt_count+"][melting_loss]' id='melting-loss-"+receipt_count+"' value='0' oninput='calculate_receipt_grams("+receipt_count+");' /></td>"+
			 
			  "<td id='net-deposit-grams-"+receipt_count+"' class='net_gold_column_class'>0</td>"+
			 
			 "<td><input placeholder='Quality %' type='number' class='form-input input-micro-width' style='width:50px !important;' name='receipt["+receipt_count+"][Quality]' id='quality-"+receipt_count+"' value='0' oninput='calculate_receipt_grams("+receipt_count+");' /></td>"+
			 
			 "<td><input placeholder='GC Quality %' type='number' class='form-input input-micro-width' style='width:50px !important;' name='receipt["+receipt_count+"][jeweller_purity]' id='gc-quality-"+receipt_count+"' value='0' /></td>"+
			 
			 "<td id='pure-gold-grams-"+receipt_count+"'  class='final_gold_column_class'>0</td>"+  
			 
			 "<td id='copper-grams-"+receipt_count+"'>0</td>"+
			 
			 "<td id='final-receipt-grams-"+receipt_count+"'>0</td>"+
			 "<td><div class='custom-file'><input type='file'   name='receipt_gold_file["+receipt_count+"]' class='custom-file-input'  id='goldFile"+receipt_count+"' /><label class='custom-file-label' for='goldFile"+receipt_count+"'></label></div></td>"+
			 "<td><input type='button' class='form-button small-button bg-red ' name='remove_receipt_"+receipt_count+"' id='remove-receipt-"+receipt_count+"' value='x'  onclick='remove_receipt(\"receipt-row-"+receipt_count+"\", \"receipt-count\")'/><input type='hidden' id='total-final-receipt-grams-"+receipt_count+"' name='total_final_receipt_grams[]' value='0' /></td>"+	
			//  "<td><input type='button' class='form-button small-button bg-red removeRow' name='remove_receipt_"+receipt_count+"' id='remove-receipt-"+receipt_count+"' value='x'  onclick='remove_receipt(\"receipt-row-"+receipt_count+"\", \"receipt-count\")'/><input type='hidden' id='total-final-receipt-grams-"+receipt_count+"' name='total_final_receipt_grams[]' value='0' /></td>"+	
			   
			 "</tr>";
			 
			 
			//  $("#gold-receipts-table>tbody>tr").eq(receipt_count-1).after(item);		 
	   $("#gold-receipts-table").append(item);
	change_file_input();
	}
	
	//function to populate cash deposit record
	function add_cash(receipt_type){
		console.log(cashcounter);
		cashcounter++;
		// cashcounter=parseInt($("#cash-count").val())+1;
		
		$("#cash-count").val(cashcounter);
		metal_type = $("#metal_type").val();
		category_options="<option value=''>-Select Transaction Type-</option><?php foreach($txn_array as $cat): echo "<option value='".$cat."'>".$cat."</option>"; endforeach; ?>";
		
		
		if(receipt_type=="cash"){
		
			if(metal_type=="gold"){
				rate_per_gram = $("#rate-per-gram").val();
		
		 	}
			 else rate_per_gram = $("#rate-per-gram-silver").val();
		
			amount_input="<td><input placeholder='Amount' type='number' class='form-input input-micro-width cash_amount_class' style='width:90px !important;' name='cash_receipt["+cashcounter+"][total_amount]' id='receipt-amount-"+cashcounter+"' value='0' oninput='amount_to_grams("+cashcounter+");' /><input type='hidden' name='cash_receipt["+cashcounter+"][Payment_Method]' id='receipt-type-cash-"+cashcounter+"' value='cash' /><input type='hidden' name='cash_receipt["+cashcounter+"][rate_per_gram]' id='rate-per-gram-"+cashcounter+"' value='"+rate_per_gram+"'></td>";
		
		}
			 
			 
			 item="<tr id='receipt-cash-"+cashcounter+"'>"+
			 "<td><input placeholder='Enter Date' type='date' class='form-input input-date-width' name='cash_receipt["+cashcounter+"][payment_date]' id='date-"+cashcounter+"' value='<?php echo date("d-m-Y")?>' required max='<?php echo date("Y-m-d"); ?>' /></td>"+
			"<td><select class='form-select input-micro-width' name='cash_receipt["+cashcounter+"][txn_type]' id='txn_type_-"+cashcounter+"' >"+category_options+"</select></td>"+
			 
		
			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='cash_receipt["+cashcounter+"][notes]' id='additional-notes-deposit-"+cashcounter+"' /></td>"+amount_input+
			 
			 
			 "<td><input placeholder='Grams' type='number' class='form-input input-micro-width gram_class' style='width:70px !important;' name='cash_receipt["+cashcounter+"][Grams]' id='cash-grams-"+cashcounter+"' value='0' oninput='calculate_cash_grams("+cashcounter+");' /></td>"+
			 
			
			    
			 "<td><input type='button' class='form-button small-button bg-red removeRow' name='remove_receipt_"+cashcounter+"' id='remove-receipt-"+cashcounter+"' value='x'  /><input type='hidden' id='total-cash-receipt-grams-"+cashcounter+"' name='total_cash_receipt_grams[]' value='0' /><input  type='hidden' class='form-input ' name='cash_receipt["+cashcounter+"][Quality]'  value='100' required /><input type='hidden' name='cash_receipt["+cashcounter+"][payment_for]'  value='gram_charge'></td>"+	
			//  "<td><input type='button' class='form-button small-button bg-red' name='remove_receipt_"+receipt_count+"' id='remove-receipt-"+receipt_count+"' value='x'  onclick='remove_receipt(\"receipt-cash-"+receipt_count+"\", \"cash-count\")'/><input type='hidden' id='total-cash-receipt-grams-"+receipt_count+"' name='total_cash_receipt_grams[]' value='0' /><input  type='hidden' class='form-input ' name='cash_receipt["+receipt_count+"][Quality]'  value='100' required /><input type='hidden' name='cash_receipt["+receipt_count+"][payment_for]'  value='gram_charge'></td>"+	
			   
			 "</tr>";
			
			//  $("#cash-receipts-table>tbody>tr").eq(cashcounter-1).after(item);
	   $("#cash-receipts-table").append(item);
	
	}
	
	//function to populate cash deposit record
	function add_making_charge(receipt_type){
		
		receipt_count=parseInt($("#making-count").val())+1;
		
		$("#making-count").val(receipt_count);
		metal_type = $("#metal_type").val();
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
			 "<td><input placeholder='Enter Date' type='date' class='form-input input-date-width' name='making_receipt["+receipt_count+"][payment_date]' id='date-"+receipt_count+"' value='<?php echo date("d-m-Y")?>' required max='<?php echo date("Y-m-d"); ?>' /></td>"+
			"<td><select class='form-select input-micro-width' name='making_receipt["+receipt_count+"][txn_type]' id='txn_type_-"+receipt_count+"' >"+category_options+"</select></td>"+
			 
			
			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='making_receipt["+receipt_count+"][notes]' id='additional-notes-deposit-"+receipt_count+"' /></td>"+amount_input+
			 
			 "<td><input type='button' class='form-button small-button bg-red' name='remove_receipt_"+receipt_count+"' id='remove-receipt-"+receipt_count+"' value='x'  onclick='remove_receipt(\"receipt-making-"+receipt_count+"\", \"making-count\")'/><input  type='hidden' class='form-input ' name='making_receipt["+receipt_count+"][Quality]'  value='100' required /><input type='hidden' name='making_receipt["+receipt_count+"][payment_for]'  value='making_charge'></td>"+	
			   
			 "</tr>";
			 
			 
			//  $("#making-charge-table>tbody>tr").eq(receipt_count-1).after(item);
			 $("#making-charge-table").append(item);
	
	}
	
	//function to populate cash deposit record
	function add_stone_charge(receipt_type){
		
		receipt_count=parseInt($("#stone-count").val())+1;
		
		$("#stone-count").val(receipt_count);
		metal_type = $("#metal_type").val();
		category_options="<option value=''>-Select Transaction Type-</option><?php foreach($txn_array as $cat): echo "<option value='".$cat."'>".$cat."</option>"; endforeach; ?>";
		
		
		if(receipt_type=="cash"){
		
			
			amount_input="<td><input placeholder='Amount' type='number' class='form-input input-micro-width stone_amount_class' style='width:90px !important;' name='stone_receipt["+receipt_count+"][total_amount]' id='stone-amount-"+receipt_count+"' value='0' oninput='calculate_stone_charge("+receipt_count+");' /><input type='hidden' name='stone_receipt["+receipt_count+"][Payment_Method]' id='receipt-type-cash-"+receipt_count+"' value='cash' /></td>";
		
		}
			 
			 
			 item="<tr id='receipt-stone-"+receipt_count+"'>"+
			 "<td><input placeholder='Enter Date' type='date' class='form-input input-date-width' name='stone_receipt["+receipt_count+"][payment_date]' id='date-"+receipt_count+"' value='<?php echo date("d-m-Y")?>' required max='<?php echo date("Y-m-d"); ?>' /></td>"+
			"<td><select class='form-select input-micro-width' name='stone_receipt["+receipt_count+"][txn_type]' id='txn_type_-"+receipt_count+"' >"+category_options+"</select></td>"+
			 
			
			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='stone_receipt["+receipt_count+"][notes]' id='additional-notes-deposit-"+receipt_count+"' /></td>"+amount_input+
			 
			 "<td><input type='button' class='form-button small-button bg-red' name='remove_stone_"+receipt_count+"' id='remove-stone-"+receipt_count+"' value='x'  onclick='remove_receipt(\"receipt-stone-"+receipt_count+"\", \"stone-count\")'/><input  type='hidden' class='form-input ' name='stone_receipt["+receipt_count+"][Quality]'  value='100' required /><input type='hidden' name='stone_receipt["+receipt_count+"][payment_for]'  value='stone_charge'></td>"+	
			   
			 "</tr>";
			 
			 
			//  $("#stone-charge-table>tbody>tr").eq(receipt_count-1).after(item);
			 $("#stone-charge-table").append(item);
	
	}

	//function to populate sub category
	function sub_category_options_deposit(category_id, row_id){
		
		const subcat_options=[];
		<?php
			
			foreach($categories as $cat):
			
				$subcats="<option value=''>-Select Sub J Type-</option>";
			
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
	$("#cash-receipts-table").on("click", ".removeRow", function() {
		$(this).closest("tr").remove();

		// cashcounter--;
		// console.log(cashcounter);
		update_cash_receipt_grams();
		update_total_receipt_grams();
		calculate_stone_charge();
		calculate_making_charge();
		update_total_outstanding_grams();
	});
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
	function calculate_stone_charge(row_id=""){
		var total_amt = 0;
		amount=parseFloat($('#making-amount-'+row_id).val());
		total_stone_charges = parseFloat($('#total-stone-charges').html());
		metal_type = $('#metal_type').val();
		total_amt_array=document.getElementsByClassName('stone_amount_class');
		rate_per_gram=parseFloat($('#rate-per-gram-'+row_id).val());
		for(i=0; i<total_amt_array.length; i++){
			
			total_amt=total_amt+parseFloat(total_amt_array[i].value);
			
		}
		total_amt = fixFloat(total_amt,2);
		$('#total_stone_amount').html(total_amt);
		$('#stone_dues').html(total_stone_charges-total_amt);
	}
	//amount to grams
	function calculate_making_charge(row_id=""){
		var total_amt = 0;
		amount=parseFloat($('#making-amount-'+row_id).val());
		total_making_charges = parseFloat($('#making-charges-total').html());
		
		total_amt_array=document.getElementsByClassName('making_amount_class');
		rate_per_gram=parseFloat($('#rate-per-gram-'+row_id).val());
		for(i=0; i<total_amt_array.length; i++){
			
			total_amt=total_amt+parseFloat(total_amt_array[i].value);
			
		}
		total_amt = fixFloat(total_amt, 2);
		$('#total_making_amount').html(total_amt);
		$('#mc_dues').html(fixFloat(total_making_charges-total_amt, 2));
		
	}
	//amount to grams
	function amount_to_grams(row_id){
		// $("#cash-receipts-table  tbody tr").each(function() {
			// $(document).on('input', '.cash_amount_class', function() {
			// 	var row = $(this).closest('tr');
			// var total_amount = parseFloat(row.find('.cash_amount_class').val());
			
			// var total = parseFloat($(this).find("input[name^='total']").val());
			// quantitySum += isNaN(total_amount) ? 0 : total_amount;
			// totalSum += isNaN(total) ? 0 : total;
			amount=parseFloat($('#receipt-amount-'+row_id).val());
			rate_per_gram=parseFloat($('#rate-per-gram-'+row_id).val());
			grams=amount/rate_per_gram;
			grams=convert_to_grams(grams);
		
		// $(this).find("input[name='cash_receipt[][Grams]']").val(grams);
		// row.find('.gram_class').val(grams);
		
		$('#cash-grams-'+row_id).val(grams);
		// });
		
	//	calculate_receipt_grams(row_id);
		calculate_cash_grams(row_id);
	}
	
	
	//calculate total grams receipts
	function calculate_receipt_grams(row_id){
		
		
		receipt_grams=parseFloat($('#receipt-grams-'+row_id).val());
		
		melting_loss=parseFloat($('#melting-loss-'+row_id).val());
		
		receipt_type=$('#receipt-type-'+row_id).val();
		
		if(receipt_type=='cash'){
			melting_loss=0;
		}
		
		net_gold_receipt=receipt_grams-melting_loss;
		
		quality_percent=parseFloat($('#quality-'+row_id).val());
		
		if(receipt_type=='cash'){
			quality_percent=100;
			$('#quality-'+row_id).val(100)
		}
		
		pure_gold=net_gold_receipt*(quality_percent/100);
		
		copper=pure_gold*(7/100);
		
		if(receipt_type=='cash'){
			copper=0;
		}
		
		final_grams= pure_gold+copper;
		net_gold_receipt = convert_to_grams(net_gold_receipt);
		$('#net-deposit-grams-'+row_id).text(net_gold_receipt);
		pure_gold = convert_to_grams(pure_gold);
		$('#pure-gold-grams-'+row_id).text(pure_gold);
		copper = convert_to_grams(copper);
		$('#copper-grams-'+row_id).text(copper);
		final_grams = convert_to_grams(final_grams);
		
		
		$('#final-receipt-grams-'+row_id).text(final_grams);
		
		$('#total-final-receipt-grams-'+row_id).val(final_grams);
		
		
		update_total_receipt_grams();
		
		return final_grams;
		
	}

//calculate total grams receipts
function calculate_cash_grams(row_id){
		
		//alert("hu");
		receipt_grams=parseFloat($('#cash-grams-'+row_id).val());
		
		//console.log(receipt_grams);
		//debugger;
		melting_loss=parseFloat($('#melting-loss-'+row_id).val());		
		receipt_type=$('#receipt-type-cash-'+row_id).val();
		
		if(receipt_type=='cash'){
			melting_loss=0;
		}
		
		net_gold_receipt=receipt_grams-melting_loss;
		
		quality_percent=parseFloat($('#quality-'+row_id).val());
		
		if(receipt_type=='cash'){
			quality_percent=100;
			$('#quality-'+row_id).val(100)
		}
		
		
		pure_gold=net_gold_receipt*(quality_percent/100);
		
		copper=pure_gold*(7/100);		
		if(receipt_type=='cash'){
			copper=0;
		}
		
		final_grams= pure_gold+copper;
		
		net_gold_receipt = convert_to_grams(net_gold_receipt);
		$('#net-deposit-grams-'+row_id).text(net_gold_receipt);
		pure_gold = convert_to_grams(pure_gold);
		$('#pure-gold-grams-'+row_id).text(pure_gold);
		copper = convert_to_grams(copper);
		$('#copper-grams-'+row_id).text(copper);
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
			
			
			total_grams=total_grams+extractNumericValue(total_array[i].value);
			
		}
		for(i=0; i<total_amt_array.length; i++){
			
			total_amt=total_amt+extractNumericValue(total_amt_array[i].value);
			
		}
		total_grams = convert_to_grams(total_grams);
		total_amt = fixFloat(total_amt,2);
		$('#total-cash-receipts').html(total_grams);
		$('#total_cash_amount').html(total_amt);
		total_dues = extractNumericValue($("#total-outstanding-grams").html())-extractNumericValue($("#total-silver-receipts-value").val())-extractNumericValue($("#total-gold-receipts-value").val())-(total_grams);
		// console.log(total_dues);
		total_dues = convert_to_grams(total_dues);
		$('#total_dues').html(total_dues);
	}
	
	//update total outstanding receipts
	function update_total_receipt_grams(){
		
		total_array=document.getElementsByName('total_final_receipt_grams[]');
		
		total_grams=0;
		
		for(i=0; i<total_array.length; i++){
			
			
			total_grams=total_grams+parseFloat(total_array[i].value);
			
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
		net_gold = convert_to_grams(net_gold);
		final_gold = convert_to_grams(final_gold);
		total_grams = convert_to_grams(total_grams);
		net_gram_gold = convert_to_grams(net_gram_gold);
		net_melting_gold = convert_to_grams(net_melting_gold);
		$('#total-gold-receipts').html(total_grams);
		$('#total-gold-receipts-value').val(total_grams); 
		$('#gold_melting_loss').html(net_melting_gold);
		$('#net_gold').html(net_gold);
		$('#total-pure-receipts').html(final_gold);
		$('#total_gold_grams').html(net_gram_gold);
		total_dues = extractNumericValue($("#total-outstanding-grams").html())-extractNumericValue($("#total-silver-receipts-value").val())-extractNumericValue($("#total-gold-receipts-value").val())-extractNumericValue($("#total-cash-receipts").html());
		// console.log($("#total-outstanding-grams").html()+'total gram '+$("#total-silver-receipts-value").val()+'---'+$("#total-gold-receipts-value").val());
		
		total_dues = convert_to_grams(total_dues);
		$('#total_dues').html(total_dues);
	}


	
	
	//function to get stone items details
	function get_stone_sub_type_config(stone_sub_type_id, div_id){
		
		if(stone_sub_type_id){
			
				$.post("<?php echo site_url("order/get_stone_item"); ?>", {stone_sub_type_id:stone_sub_type_id}, function(data){
			
					var result=JSON.parse(data);
					console.log(result);
					var unit = result.stone_item.unit;
					$("#stone-cents-"+div_id).val(parseFloat(result.stone_item.cents));
					$("#stone-grams-"+div_id).val(parseFloat(result.stone_item.grams));
					$("#stone-carat-"+div_id).val(parseFloat(result.stone_item.carat));
					$("#stone-rate-"+div_id).val(parseFloat(result.stone_item.rate));
					$("#unit_id_"+div_id).html(unit);
					
					
					calculate_stones_gross_amount(div_id);
					
				});
			
			}
		
	}
	// //function to get stone sub type details
	// function get_stone_sub_type_config(stone_sub_type_id, div_id){
		
	// 	if(stone_sub_type_id){
			
	// 			$.post("<?php echo site_url("order/get_stone_sub_type"); ?>", {stone_item_id:stone_sub_type_id}, function(data){
			
	// 				var result=JSON.parse(data);
	// 				console.log(result);
	// 				var unit = result.stone_sub_type.unit;
	// 				$("#stone-cents-"+div_id).val(parseInt(result.stone_sub_type.cents));
	// 				$("#stone-grams-"+div_id).val(parseInt(result.stone_sub_type.grams));
	// 				$("#stone-carat-"+div_id).val(parseInt(result.stone_sub_type.carat));
	// 				$("#stone-rate-"+div_id).val(parseInt(result.stone_sub_type.rate));
	// 				$("#unit_id_"+div_id).html(unit);
					
					
	// 				calculate_stones_gross_amount(div_id);
					
	// 			});
			
	// 		}
		
	// }
	//function to populate stone item
	// function stone_item_options(subcategory_id, row_id){
		
	// 	const stone_item_option=[];
	// 	<?php
	// 		 $subcategory_id = $sub_cat['SubCategory_ID'];
	// 		foreach($stone_types as $cat):
			
	// 			foreach($stone_sub_types as $sub_cat):
	// 				$jitems="<option value=''>-select J Item-</option>";
					
	// 					foreach($sub_cat['jitems'] as $jitem):
					
	// 					$jitems=$jitems."<option value='".$jitem['item_id']."'>".$jitem['item_name']."</option>";			
	// 					endforeach;
	// 				?>
	// 				stone_item_option[<?php echo $sub_cat['SubCategory_ID']; ?>]="<?php echo $jitems; ?>";
	// 				<?php
	// 			endforeach;			
	// 		endforeach;
	// 	?>		
	// 	$("#jitem_id-"+row_id).html(stone_item_option[subcategory_id]);		
	// }
	//function to populate item
	function add_stone(){
		
		stones_count=parseInt($("#stones-count").val())+1;
		
		$("#stones-count").val(stones_count);
			
		stone_type_options="<option value=''>-Stone Type-</option><?php foreach($stone_types as $stone_type): echo "<option value='".$stone_type['id']."'>".$stone_type['name']."</option>"; endforeach; ?>";
			 
			 
			 stone="<tr id='stone-row-"+stones_count+"'>"+
			 "<td><select class='form-select input-micro-width' name='stone["+stones_count+"][stone_type_id]' id='stone-type-"+stones_count+"' onchange='stone_sub_type_options($(this).val(), "+stones_count+");' >"+stone_type_options+"</select></td>"+
			 
			 "<td><select class='form-select input-micro-width' name='stone["+stones_count+"][stone_sub_type_id]' id='stone-sub-type-"+stones_count+"' onchange='stone_item_options($(this).val(), \""+stones_count+"\");' ><option value=''>-Stone Sub Type-</option></select></td>"+	
			 
			 "<td><select class='form-select input-micro-width' name='stone["+stones_count+"][stone_item_id]' id='stone-item-"+stones_count+"' onchange='get_stone_sub_type_config($(this).val(), \""+stones_count+"\");' ><option value=''>-Stone Sub Type-</option></select></td>"+	
			 
			 "<td><input type='number' class='form-input input-micro-width quantity_class' style='width:70px !important;' name='stone["+stones_count+"][quantity]' id='unit-quantity-"+stones_count+"' value='1'  oninput='calculate_stones_gross_amount("+stones_count+");' /></td>"+	
			// "<td><input type='number' class='form-input input-micro-width' style='width:70px !important;' name='stone["+stones_count+"][quantity]' id='stone-quantity-"+stones_count+"' value='1' /></td>"+	
			 
		//	"<td><input type='number' class='form-input input-micro-width' style='width:70px !important;' name='stone["+stones_count+"][cents]' id='stone-cents-"+stones_count+"' oninput='stones_converter(\"cents\", $(this).val(), "+stones_count+");' onchange='stones_converter(\"cents\", $(this).val(), "+stones_count+");' /></td>"+	
			
			//"<td><input type='number' class='form-input input-micro-width' style='width:70px !important;' name='stone["+stones_count+"][grams]' id='stone-grams-"+stones_count+"' oninput='stones_converter(\"grams\", $(this).val(), "+stones_count+");' onchange='stones_converter(\"grams\", $(this).val(), "+stones_count+");' /></td>"+	
			
			"<td><input type='number' class='form-input input-micro-width stone_class' style='width:70px !important;' name='stone["+stones_count+"][carat]' id='stone-carat-"+stones_count+"' oninput='calculate_stones_gross_amount("+stones_count+");'  /> <span id='unit_id_"+stones_count+"'></span><input type='hidden' name='stone["+stones_count+"][unit]' id='unit_value_"+stones_count+"' /></td>"+	
			
			"<td><input type='number' class='form-input input-micro-width' style='width:100px !important;' name='stone["+stones_count+"][rate]' id='stone-rate-"+stones_count+"' oninput='calculate_stones_gross_amount("+stones_count+")'  ></td>"+	
			   
			    "<td id='stone-charges-"+stones_count+"' class='stone-charges-inr'>0</td>"+
			   "<td><input type='hidden'  name='stone["+stones_count+"][total_amount]' id='stone-total_amount-"+stones_count+"' ><input type='button' class='form-button small-button bg-red' name='removestone"+stones_count+"' id='remove-stone-"+stones_count+"' value='x'  onclick='remove_stone(\"stone-row-"+stones_count+"\", \"stones-count\", "+stones_count+")'/></td>"+	
			 "</tr>";
			 
			 
			//  $("#order-stones-table>tbody>tr").eq(stones_count-1).after(stone);
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
		
		$('#stone-grams-'+row_id).val(grams);
		
		$('#stone-carat-'+row_id).val(carat);
		
		calculate_stones_gross_amount(row_id);
		
	}
	
	//calculate gross amount for stones
	function calculate_stones_gross_amount(row_id){
		total_amt = parseFloat($('#total_stone_amount').html());
		if(isNaN(total_amt)){
			total_amt = 0;
		}
		// debugger;
		quantity=parseFloat($('#unit-quantity-'+row_id).val());
		console.log(total_amt);
		//cents=parseFloat($('#stone-cents-'+row_id).val());
		
		// grams=parseFloat($('#stone-grams-'+row_id).val());
		
		 carat=extractNumericValue($('#stone-carat-'+row_id).val());
		
		rate=parseFloat($('#stone-rate-'+row_id).val());
		if(quantity>1){
			quantity = 1;
		}
		gross_total=quantity * carat * rate;
		gross_total = fixFloat(gross_total,2);
		$('#stone-charges-'+row_id).html(gross_total);
		$('#stone-total_amount-'+row_id).val(gross_total);
		total_quantity=$(".quantity_class");
		total_stone=$(".stone_class");
		
		net_amount=0;
		net_quantity=0;
		net_stone=0;
		total_quantity.each(function(){
			
			quantity=$(this).val();
			net_quantity = net_quantity + parseInt(quantity);
		
		});
		total_stone.each(function(){
			
			stone=$(this).val(); 
			net_stone = net_stone + parseInt(stone);
		
		});
		
		
		//update final total
		gross_total_array=$(".stone-charges-inr");
		
		net_amount=0;
		
		gross_total_array.each(function(){
			
			stone_charge=$(this).html();
			net_amount = net_amount + parseFloat(stone_charge);
		
		});
		net_amount = fixFloat(net_amount,2);
		$('#total-stone-charges').html(net_amount);
		$('#total_stone_size').html(net_stone);
		$('#total_quantity').html(net_quantity);
		$('#stone_dues').html(fixFloat( net_amount-total_amt,2));
	}

</script>

<script>

//function to populate deposit record
	function add_silver(){
		
		receipt_count=parseInt($("#silver-receipt-count").val())+1;
		
		$("#silver-receipt-count").val(receipt_count);
			
		metalType = $("#metal_type").val();
		if(metalType===""){
			alert("Please select metal type first");
			return;
		}
		category_options=createCategoryOption(metalType);
		item_options=createItems(metalType);
		amount_input="<input type='hidden' name='silver_receipt["+receipt_count+"][Payment_Method]' id='silver-receipt-type-"+receipt_count+"' value='silver' />";
			 
			 
			 item="<tr id='silver-receipt-row-"+receipt_count+"'>"+
			 "<td><input placeholder='Enter Date' type='date' class='form-input input-date-width' name='silver_receipt["+receipt_count+"][payment_date]' id='date-"+receipt_count+"' value='<?php echo date("d-m-Y")?>' required max='<?php echo date("Y-m-d"); ?>' /></td>"+
			//  "<td><select class='form-select input-micro-width' name='silver_receipt["+receipt_count+"][Category_ID]'  onchange='sub_category_receipt($(this).val(), "+receipt_count+");' >"+category_options+"</select></td>"+
			 
			//  "<td><select class='form-select input-micro-width' name='silver_receipt["+receipt_count+"][SubCategory_ID]' id='sub-category-receipt-"+receipt_count+"' onchange='jitem_options_receipt($(this).val(), \""+receipt_count+"\");' ><option value=''>-Sub J Type-</option></select></td>"+	
			 
			 "<td><select class='form-select input-micro-width' name='silver_receipt["+receipt_count+"][item_id]' id='jitem_id_receipt-"+receipt_count+"' ><option value=''>- J Items-</option>"+item_options+"</select></td>"+	
			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='silver_receipt["+receipt_count+"][notes]' id='additional-notes-silver-deposit-"+receipt_count+"' /> "+amount_input+" </td>"+
			 
			 
			 "<td><input placeholder='Grams' type='number' class='form-input input-micro-width gram_input_column_class' style='width:70px !important;' name='silver_receipt["+receipt_count+"][Grams]' id='silver-receipt-grams-"+receipt_count+"' value='0' oninput='calculate_silver_receipt_grams("+receipt_count+");' /></td>"+
			 
			 "<td><input placeholder='Melting Loss (gms)' type='number' class='form-input input-micro-width melting_input_column_class' style='width:50px !important;' name='silver_receipt["+receipt_count+"][melting_loss]' id='silver-melting-loss-"+receipt_count+"' value='0' oninput='calculate_silver_receipt_grams("+receipt_count+");' /></td>"+
			 
			  "<td><input disabled id='net-silver-deposit-grams-"+receipt_count+"'  class='silver_deposit_column_class' value='0'></td>"+
			 
			 "<td><input placeholder='Quality %' type='number' class='form-input input-micro-width' style='width:50px !important;' name='silver_receipt["+receipt_count+"][Quality]' id='silver-quality-"+receipt_count+"' value='0' oninput='calculate_silver_receipt_grams("+receipt_count+");' /></td>"+
			 
			 "<td id='pure-silver-grams-"+receipt_count+"'>0</td>"+  
			 
			 
			 
			// "<td id='silver-value-inr-"+receipt_count+"'>0</td>"+
			"<td><div class='custom-file' id='silverFile"+receipt_count+"'><input type='file'   name='receipt_silver_file["+receipt_count+"]' class='custom-file-input' /><label class='custom-file-label' for='silverFile"+receipt_count+"'></label></div></td>"+
			 "<td><input type='button' class='form-button small-button bg-red' name='remove_silver_receipt_"+receipt_count+"' id='remove-silver-receipt-"+receipt_count+"' value='x'  onclick='remove_silver_receipt(\"silver-receipt-row-"+receipt_count+"\")'/><input type='hidden' id='total-final-silver-receipt-grams-"+receipt_count+"' name='total_final_silver_receipt_grams[]' value='0' /></td>"+	
			   
			 "</tr>";
			 
			 
			//  $("#silver-receipts-table>tbody>tr").eq(receipt_count-1).after(item);	 
	    $("#silver-receipts-table").append(item);
		change_file_input();
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
		net_silver_receipt = fixFloat(net_silver_receipt,2);
		$('#net-silver-deposit-grams-'+row_id).val(net_silver_receipt);
		
		quality_percent=parseFloat($('#silver-quality-'+row_id).val());
		
		pure_silver=net_silver_receipt*(quality_percent/100);
		
		final_grams= pure_silver;
		pure_silver = fixFloat(pure_silver,2);
		$('#pure-silver-grams-'+row_id).html(pure_silver);
		
		//rate=$('#rate-per-gram-silver').val();
		
		//inr_value=parseInt(rate)*final_grams;
		
		//$('#silver-value-inr-'+row_id).html(inr_value);
		
		$('#total-final-silver-receipt-grams-'+row_id).val(final_grams);
		
		update_total_silver_receipt_grams();
		
		return final_grams;
		
	}
	
	
	//update total outstanding receipts
	function update_total_silver_receipt_grams(){
		
		total_array=document.getElementsByName('total_final_silver_receipt_grams[]');
		total_gram_values=document.getElementsByClassName('gram_input_column_class');
		total_melting_values=document.getElementsByClassName('melting_input_column_class');
		total_silver_deposit_values=document.getElementsByClassName('silver_deposit_column_class');
		total_grams=0;
		total_gram_value=0;
		total_melting_value=0;
		total_silver_deposit_value=0;
		for(i=0; i<total_array.length; i++){
			
			
			total_grams=total_grams+parseFloat(total_array[i].value);
			
		}
		for(i=0; i<total_silver_deposit_values.length; i++){
			console.log(total_silver_deposit_values[i].value);
			total_silver_deposit_value=total_silver_deposit_value+parseFloat(total_silver_deposit_values[i].value);
			
		}
		for(i=0; i<total_melting_values.length; i++){
			
			total_melting_value=total_melting_value+parseFloat(total_melting_values[i].value);
			
		}
		for(i=0; i<total_gram_values.length; i++){
			
			total_gram_value=total_gram_value+parseFloat(total_gram_values[i].value);
			// total_melting_value=total_melting_value+parseFloat(total_melting_values[i].value);
			
		}
		$('#total-silver-receipts').html(total_grams);
		$('#total-silver-receipts-value').val(total_grams);
		$('#total_melting_loss').html(total_melting_value);
		$('#net_silver').html(total_silver_deposit_value);
		$('#total_silver_grams').html(total_gram_value);
		total_dues =extractNumericValue($("#total-outstanding-grams").html())-extractNumericValue($("#total-gold-receipts-value").val())-total_grams-extractNumericValue($("#total-cash-receipts").html());
		 total_dues = convert_to_grams(total_dues);
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

$( document ).ready(function() {
	categoryOptions = <?php echo json_encode($categories); ?>;
	itemOptions = <?php echo json_encode($j_items); ?>;
	
	bsCustomFileInput.init();
});


	function add_rate(){
			
		form_data=" 	<form onsubmit='return submit_rate();' method='POST' name='create_form' id='create-form-id'>	<div class='form-block'> <div class='form-row'> <div class='form-column'> <label class='radio-label'>Date</label> <?php echo date('d-m-Y'); ?> </div> <div class='form-column'>	<label class='radio-label'>Metal Type</label> 					<select class='form-select' name='metal_type_rate' required id='metal_type_rate'> 						<option value=''>Not Selected</option> 					<option value='gold' <?php echo ($metal_type=="gold") ? ' selected': "" ?>>Gold</option> <option value='silver' <?php echo ($metal_type=="silver") ? ' selected': "" ?>>Silver</option> 	</select> 	</div> <div class='form-column'> <label class='radio-label'>Rate Per Gram(₹)</label> <input type='number' class='form-input' name='full_name' placeholder='TodaysRatePerGram' value='<?php echo set_value('full_name'); ?>' minlength='1' maxlength='5' id='metal_rate' required/> </div>  <div class='clear'></div> </div> 			<div class='form-row blocks-right'>		<input type='submit' class='form-button' name='submit' value='Submit' /> <div class='clear'></div> 	</div> 	</div> 	</form>";

		show_popup(form_data);

	}
</script>
<style>
	.input-micro-width{width:100% !important;}
	/* .custom-file{width:70%} */
</style>

 
