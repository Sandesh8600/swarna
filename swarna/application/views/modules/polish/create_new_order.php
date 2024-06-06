<!-- Content Wrapper. Contains page content -->
<?php 
	$txn_array = array("Cash","Online","Cheque");
	$service_type = array('polish'); //,"custom jewellery" , 'repair'
	$metal_type = $this->input->get_post("metal_type");
	$metal_print_name = ucfirst($metal_type);
?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> <?php echo $metal_print_name ?> Polish Order</h1>
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
	<form action="<?php echo site_url("polish/create_new_order"); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id">
		<input type='hidden' id='cust-code-selected' name='Customer_Code_Selected' value='' required />
		<input type='hidden' id='metal_type' name='metal_type' value="<?php echo $metal_type ?>" />
		
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
					
					<input type="text" class="form-input" name="order" value="<?php echo set_value('order', $order_id); ?>"  autocomplete="off" disabled="disabled"/>
					
				</div> -->
				<?php $order_id=date('dmY')."-".rand(100,999); ?>
				<input type="hidden" class="form-input" name="order_id" value="<?php echo set_value('order_id', $order_id); ?>" />
				<div class="form-column">
					<!--<label class="radio-label">Service Type</label>
					<select class='form-select input-micro-width' name='order_type' id="service_type" onchange='hide_columns($(this).val());' required="required">
					 <option value=''>-Select Service Type-</option> 
					<?php foreach($service_type as $cat): echo "<option value='".$cat."'>".$cat."</option>"; endforeach; ?>	
				</select>-->
					<label class="radio-label">Metal Type</label>
					<select class="form-select" name="metal_type_select"  onchange="get_metal_type($(this).val())" required>
						<option value="">Select Metal</option>
						<option value="gold" <?php echo ($metal_type=="gold") ? " selected": "" ?>>Gold</option>
						<option value="silver" <?php echo ($metal_type=="silver") ? " selected": "" ?>>Silver</option>
					</select>
					<input type="hidden" value="polish" name="order_type"  id="service_type" >
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
					
					<input type="hidden" name="Customer_Code" value="<?php echo $this->input->get("customer_id"); ?>" />
					
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
			<?php
			if($rate_per_gram_gold>0 || $rate_per_gram_silver>0):
				//  $dclass = "show";
				 $dclass = "style=display:inline;";
				 $hideclass = "style=display:none;";
			else:
				// $dclass = "hide";
				$dclass = "style=display:none;";
				$hideclass = "style=display:inline;";
			endif;
			?>
			<div class="card">
			<div class="card-header"><strong> Order Items</strong> <a class="form-button small-button add_cash "  onclick='add_item();' <?php echo $dclass;  ?>  > + </a><?php ?>&nbsp;<a href="<?php echo site_url("rate/browse?create_form=yes&metal_type=$metal_type"); ?>" target="_blank" <?php echo $hideclass;  ?> class="add_rate"><span style="color:red;">Add today's <?php echo $metal_type ?> rate </span> </a><?php   ?> </div>
				<div class="card-body" id="order-items" style="overflow-x:auto;">
				<table class="table table-bordered" id="order-items-table">
					<tr>
						<!-- <td>Service Type</td> -->
						<td>J Type</td>
						<td>J Sub Type</td>
						<td>J Items</td>
						<td>Notes</td>
						<td >Workshop</td>
						<td >NW</td>
						<!-- <td class="hide_class">Wastage %</td>
						
						<td class="hide_class">Balance Gold (Grams)</td> -->
						<td class="hide_class">NW after Polish</td>
						<td>MC (Rs)</td>
						<td><img src="<?php echo base_url('images/image_icon.png');?>" width=25></td>
						<td>Action</td>
					</tr>
					<tfoot>
					<tr  style="font-weight:bold">
					<td colspan=5></td>
					
					<td><span id="total_approx_grams"><?php echo $total_approx_grams ?></span></td>
						<!-- <td class='hide_class'><span id=""><?php //echo number_format((float)$total_wastage, 3, '.', ''); ?></span> </td>-->
						<td class='hide_class'><span id="total-outstanding-grams"><?php echo number_format((float)$total_req_grams, 3, '.', ''); ?></span> </td> 
						<!--<td class='hide_class'><span id="total-gold-balance"><?php echo number_format((float)$total_req_grams, 3, '.', ''); ?></span> </td> -->
						<td><span id="making-charges-total"><?php echo number_format((float)$total_making_charges, 2, '.', ''); ?></span> </td>
					
					<td colspan=2></td>
				</tr>
							</tfoot>	
				</table>
			
			</div>
			
			
			</div>
			
			<!--receipts block-->
			<!-- Cash block -->
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
				<input type="hidden" name="cash-count" id="cash-count" value="0" />
				<div class="card-header"><strong> Cash Receipts</strong>  <a class="form-button small-button add_cash"  onclick='add_cash("cash");'  <?php echo $dclass;  ?>> + </a> &nbsp;<a href="<?php echo site_url("rate/browse?create_form=yes&metal_type=$metal_type"); ?>" target="_blank"  class="add_rate" <?php echo $hideclass;  ?>><span style="color:red;">Add today's <?php echo $metal_type ?> rate </span> </a> </div>
				<div class="card-body" id="cash-receipts" style="overflow-x:auto;">
				<table class="table table-bordered" id="cash-receipts-table">
					<tr>
					<!--	<td>JType</td>-->
						<td>Select date</td>
						<td>Payment Type</td>
						<td>Notes</td>
						<td>Amount</td>
						<!-- <td>Payment type</td> -->
						
						<td>Action</td>
					</tr>
					<tfoot>
					<tr  style="font-weight:bold">
						<td colspan=3></td>
						
						<td><span id="total_cash_amount"><?php echo $total_cash_amt ?></span></td>
						 <!-- <td><span id="total-cash-receipts"></span> </td>
						 -->
						<td></td>
					</tr>
				</tfoot>
				</table>
			
			</div>
			</div>
			
			<div class="card">
				
				
				<div class="card-body"  style="overflow-x:auto;">
				<table class="table table-bordered">
					
					<tr  style="font-weight:bold">
						<td colspan=6><strong> Remaining Balance</strong></td>
						
						 <td><span id="total-remaining-balance"><?php $balance = $total_making_charges-$total_cash_amt;
						 echo number_format((float)($balance), 2, '.', ''); ?></span> </td>
						
					</tr>
					<tr  style="font-weight:bold">
						<td colspan=6><strong> Total Dues</strong></td>
						
						 <td><span id="total_dues"><?php
						 echo number_format((float)($total_approx_grams-$total_req_grams), 3, '.', ''); ?></span> </td>
						
					</tr>
				</table>
			
			</div>
			<div class="card"><div class="card-body">
			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Submit" />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("polish/browse?metal_type=$metal_type"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
			
			</div></div> <!--card ends-->
			
		</div>
	</form>
	<script>
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
		ignore: [],
		rules: {
			metal_type_select: { required: true },
			Customer_Code_Selected: { required: true },
			"receipt_order_file[]": {
       
			extension: "png|jpe?g|gif" // Example: allowed file extensions
			}
		},
		messages: {
            "Customer_Code_Selected": {
                required: "Please select the customer"
            },
			"receipt_order_file[]": {
      
			extension: "Only PNG, JPG, and GIF files are allowed"
			}
           
        }
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
	
	//function to get making charges and wastage
	function get_sub_cat_config(sub_cat_id, div_id){
		
		if(sub_cat_id){
			
				$.post("<?php echo site_url("order/get_sub_cat"); ?>", {sub_cat_id:sub_cat_id}, function(data){
			
					var result=JSON.parse(data);
					
					$("#wastage-"+div_id).val(parseInt(result.subcat.wastage_percent));
					
					//making charges set in input
					$("#making-charge-per-gram-"+div_id).val(parseInt(result.subcat.making_charges_per_gram));
					
					
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
		metalType = $("#metal_type").val();
		if(metalType===""){
			alert("Please select metal type first");
			return;
		}
		item_count=parseInt($("#item-count").val())+1;
		service_type =($("#service_type ").val());
		if(service_type == ""){
			service_type = "polish";
		}
		
		$("#item-count").val(item_count);
		category_options=createCategoryOption(metalType);
		//service_options="<option value=''>-Select Service Type-</option><?php //foreach($service_type as $cat): echo "<option value='".$cat."'>".$cat."</option>"; endforeach; ?>";
		//category_options="<option value=''>-Select Category-</option><?php foreach($categories as $cat): echo "<option value='".$cat['Category_ID']."'>".$cat['Category_Name']."</option>"; endforeach; ?>";
		
		workshop_options="<option value=''>-Select Workshop-</option><?php foreach($workshops as $ws): echo "<option value='".$ws['Workshop_Code']."'>".$ws['Workshop_Name']."</option>"; endforeach; ?>";
			 
			 
			 item="<tr id='item-row-"+item_count+"'>"+
			// "<td><select class='form-select input-micro-width' name='item["+item_count+"][order_type]' id='service-"+item_count+"' onchange='hide_columns($(this).val(), "+item_count+");' >"+service_options+"</select></td>"+
			 "<td><select class='form-select input-micro-width' name='item["+item_count+"][Category_ID]' id='category-"+item_count+"' onchange='sub_category_options($(this).val(), "+item_count+");' >"+category_options+"</select></td>"+
			 
			 "<td><select class='form-select input-micro-width' name='item["+item_count+"][SubCategory_ID]' id='sub-category-"+item_count+"' onchange='jitem_options($(this).val(), \""+item_count+"\");' ><option value=''>-Sub Category-</option></select></td>"+	
			 "<td><select class='form-select input-micro-width' name='item["+item_count+"][item_id]' id='jitem_id-"+item_count+"' onchange='get_item_config($(this).val(), \""+item_count+"\");' ><option value=''>- J Items-</option></select></td>"+	

			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='item["+item_count+"][notes]' id='additional-notes-"+item_count+"' /></td>"+	
			 
			 "<td><select class='form-select input-micro-width' name='item["+item_count+"][Workshop_Code]' id='workshop-"+item_count+"' >"+workshop_options+"</select></td>"+
			 
			 "<td><input placeholder='Net Weight' type='number' class='form-input input-micro-width approx_gram_class' style='width:70px !important;' name='item["+item_count+"][approx_grams]' id='approx-grams-"+item_count+"' value='0' oninput='calculate_total_grams("+item_count+")' /></td>";
			 
			 if(service_type=="repair"){
				item+="<td  class='hide_class' ><input placeholder='Wastage %' type='number' class='form-input input-micro-width total_wastage_class' style='width:50px !important;' name='item["+item_count+"][wastage]' id='wastage-"+item_count+"' value='0' oninput='calculate_total_grams("+item_count+")' /></td>"+	
			   
			   
			    "<td id='gold-balance-row-"+item_count+"' class='hide_class'><input placeholder='Balance Gold' type='number' class='form-input input-micro-width balance_gold_class' style='width:50px !important;' name='item["+item_count+"][gold_balance]' id='gold-balance-"+item_count+"' value='0' oninput='update_total_outstanding_grams()' /></td>";
			 }
			 item+="<td class='hide_class'  ><input class='form-input input-micro-width nw_after_repair' type='number' id='total-grams-"+item_count+"'  name='item["+item_count+"][nw_after_repair]' style='width:70px !important;' oninput='calculate_total_grams("+item_count+")' /></td>"+
			 "<td  class=''><input placeholder='making Charges' type='number' class='form-input input-micro-width making-charge-rs' style='width:50px !important;' name='item["+item_count+"][making_charges]' oninput='update_total_outstanding_grams()' id='making-charges-"+item_count+"' value='0'/></td>"+
			 "<td><div class='custom-file' ><input type='file' name='receipt_order_file["+item_count+"]' class='custom-file-input' id='orderFile"+item_count+"'  /><label class='custom-file-label' for='orderFile"+item_count+"'></label></div></td>"+
			   "<td><input type='button' class='form-button small-button bg-red' name='remove"+item_count+"' id='remove-"+item_count+"' value='x'  onclick='remove_item(\"item-row-"+item_count+"\", \"item-count\")'/><input type='hidden' id='grams_total_final-"+item_count+"' name='grams_total_final[]' value='0' /></td>"+	
			 "</tr>";
			 
			 
			//  $("#order-items-table>tbody>tr").eq(item_count-1).after(item);				 
	   $("#order-items-table").append(item);
	change_file_input();
	}
	//function :hide some columns on basis of service type
	function hide_columns(service_type){
		if(service_type=="polish"){
			// $("#wastage-"+row_id).hide();
			// $("#total-grams-"+row_id).hide();
			// $("#gold-balance-"+row_id).hide();
			$(".hide_class").hide();
		}
		else { 
			// $("#wastage-"+row_id).show();
			// $("#total-grams-"+row_id).show();
			// $("#gold-balance-"+row_id).show();
			$(".hide_class").show();
		}
		update_total_outstanding_grams();
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
		
		approx_grams=extractNumericValue($('#approx-grams-'+row_id).val());
		service=parseFloat($('#service-'+row_id).val());
		if(service=="polish"){
			$('#wastage-'+row_id).val() = 0;
		}
		wastage_percent=parseFloat($('#wastage-'+row_id).val());
		
		making_charge_percent=parseFloat($('#making-charges-'+row_id).val());
		
		wastage = approx_grams*wastage_percent/100;
		gross_total=(approx_grams-(approx_grams*wastage_percent/100));
		
		//net_total=gross_total+(gross_total*making_charge_percent/100);
		net_total=gross_total;
		net_total=parseFloat(net_total).toFixed(3);
		
		$('#total-grams-'+row_id).html(net_total);
		$('#wastage-'+row_id).html(wastage);
		//$('#gold-balance-'+row_id).val(net_total);
		//gold-balance
		making_charge_per_gram=$('#making-charge-per-gram-'+row_id).val();
		
		//making_charges=net_total*parseInt(making_charge_per_gram);
		making_charges=approx_grams*parseInt(making_charge_per_gram);
		
		
		$("#making-charges-"+row_id).html(parseFloat(making_charges).toFixed(2));
		
		$('#grams_total_final-'+row_id).val(net_total);
		
		update_total_outstanding_grams();
		
		return net_total;
		
		
		
	}
	
	//update total outstanding
	function update_total_outstanding_grams(){
		
		total_array=document.getElementsByName('grams_total_final[]');
		nw_after_repair_array=document.getElementsByClassName('nw_after_repair');
		total_approx_gram=document.getElementsByClassName('approx_gram_class');
		total_gold_balance=$(".balance_gold_class");
		total_grams=0;
		total_balance=0;
		total_nw=0;
		
		for(i=0; i<total_array.length; i++){
			service=($('#service_type').val());
			//console.log(service);
			if(service=="polish"){
				total_array[i].value = 0;
			}
			
			total_grams=total_grams+parseFloat(total_array[i].value);
			
		}
		for(i=0; i<nw_after_repair_array.length; i++){
			// console.log(extractNumericValue(nw_after_repair_array[i].value));
			total_nw=total_nw+extractNumericValue(nw_after_repair_array[i].value);
			
		}
		
		$('#total-outstanding-grams').html(parseFloat(total_nw).toFixed(3));
		
		
		//update making charges total
		making_charges_array=$(".making-charge-rs");
		
		net_making_charges=0;
		//console.log(making_charges_array);
		making_charges_array.each(function(){
			
			making_charge=extractNumericValue($(this).val()); 
			net_making_charges = net_making_charges + (making_charge);
		
		}); 
		total_wastage_array=$(".total_wastage_class");
		
		net_wastage=0;
		
		total_wastage_array.each(function(){
			
			wastage=$(this).val();
			net_wastage = net_wastage + extractNumericValue(wastage);
		
		});
		total_gold_balance.each(function(){
			
			balance=$(this).val();
			total_balance = total_balance + extractNumericValue(balance);
		
		});
		total_approx_grams=0;
		for(i=0; i<total_approx_gram.length; i++){
			
			total_approx_grams=total_approx_grams+extractNumericValue(total_approx_gram[i].value);
			
		}
		$('#total_approx_grams').html(total_approx_grams);
		$('#total-gold-balance').html(total_balance);
		total_cash_amount = extractNumericValue($('#total_cash_amount').html());
		$('#making-charges-total').html(parseFloat(net_making_charges).toFixed(2));
		total_duesg = extractNumericValue($("#total-outstanding-grams").html())-extractNumericValue($("#total_approx_grams").html());
		
		total_duesg = fixFloat(total_duesg,3);
		$('#total-remaining-balance').html(parseFloat(net_making_charges-total_cash_amount).toFixed(2));
		$('#total_dues').html(total_duesg);
	}
	
	
	//function to populate deposit record
	function add_gold(receipt_type){
		
		receipt_count=parseInt($("#receipt-count").val())+1;
		
		$("#receipt-count").val(receipt_count);
			
		category_options="<option value=''>-Select Category-</option><?php foreach($categories as $cat): echo "<option value='".$cat['Category_ID']."'>".$cat['Category_Name']."</option>"; endforeach; ?>";
		
		amount_input="<input type='hidden' name='receipt["+receipt_count+"][Payment_Method]' id='receipt-type-"+receipt_count+"' value='gold' />";
		
		if(receipt_type=="cash"){
		
		//	amount_input="<td><input placeholder='Amount' type='number' class='form-input input-micro-width' style='width:90px !important;' name='receipt["+receipt_count+"][total_amount]' id='receipt-amount-"+receipt_count+"' value='0' oninput='amount_to_grams("+receipt_count+");' /><input type='hidden' name='receipt["+receipt_count+"][Payment_Method]' id='receipt-type-"+receipt_count+"' value='cash' /><input type='hidden' name='receipt["+receipt_count+"][rate_per_gram]' id='rate-per-gram-"+receipt_count+"' value='<?php echo $rate_per_gram_gold; ?>'></td>";
		
		}
			 
			 
			 item="<tr id='receipt-row-"+receipt_count+"'>"+
			 "<td><input placeholder='Enter Date' max='<?php echo date("Y-m-d"); ?>' type='date' class='form-input input-micro-width' name='receipt["+receipt_count+"][payment_date]' id='date-"+receipt_count+"' value='<?php echo date("d-m-Y")?>' required /></td>"+
			// "<td><select class='form-select input-micro-width' name='receipt["+receipt_count+"][Category_ID]' id='receipt-category-"+receipt_count+"' onchange='sub_category_options_deposit($(this).val(), "+receipt_count+");' >"+category_options+"</select></td>"+
			 
			// "<td><select class='form-select input-micro-width' name='receipt["+receipt_count+"][SubCategory_ID]' id='sub-category-deposit-"+receipt_count+"' ><option value=''>-Sub Category-</option></select></td>"+	
			 "<td>"+receipt_type+amount_input+"</td>"+
			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='receipt["+receipt_count+"][notes]' id='additional-notes-deposit-"+receipt_count+"' /></td>"+
			 
			 
			 "<td><input placeholder='Grams' type='number' class='form-input input-micro-width' style='width:70px !important;' name='receipt["+receipt_count+"][Grams]' id='receipt-grams-"+receipt_count+"' value='0' oninput='calculate_receipt_grams("+receipt_count+");' /></td>"+
			 
			 "<td><input placeholder='Melting Loss (gms)' type='number' class='form-input input-micro-width' style='width:50px !important;' name='receipt["+receipt_count+"][melting_loss]' id='melting-loss-"+receipt_count+"' value='0' oninput='calculate_receipt_grams("+receipt_count+");' /></td>"+
			 
			  "<td id='net-deposit-grams-"+receipt_count+"'>0</td>"+
			 
			 "<td><input placeholder='Quality %' type='number' class='form-input input-micro-width' style='width:50px !important;' name='receipt["+receipt_count+"][Quality]' id='quality-"+receipt_count+"' value='0' oninput='calculate_receipt_grams("+receipt_count+");' /></td>"+
			 
			 "<td id='pure-gold-grams-"+receipt_count+"'>0</td>"+  
			 
			 "<td id='copper-grams-"+receipt_count+"'>0</td>"+
			 
			 "<td id='final-receipt-grams-"+receipt_count+"'>0</td>"+
			 "<td><div class='custom-file' id='goldFile"+receipt_count+"'><input type='file' name='receipt_gold_file["+receipt_count+"]' class='custom-file-input'   /><label class='custom-file-label' for='goldFile"+receipt_count+"'></label></div></td>"+
			 "<td><input type='button' class='form-button small-button bg-red' name='remove_receipt_"+receipt_count+"' id='remove-receipt-"+receipt_count+"' value='x'  onclick='remove_receipt(\"receipt-row-"+receipt_count+"\", \"receipt-count\")'/><input type='hidden' id='total-final-receipt-grams-"+receipt_count+"' name='total_final_receipt_grams[]' value='0' /></td>"+	
			   
			 "</tr>";
			 
			 
			 $("#gold-receipts-table>tbody>tr").eq(receipt_count-1).after(item);		 
	//    $("#gold-receipts-table").append(item);
	
	}
	
	//function to populate cash deposit record
	function add_cash(receipt_type){
		metal_type = $("#metal_type_select").val();
		receipt_count=parseInt($("#cash-count").val())+1;
		
		$("#cash-count").val(receipt_count);
			
		category_options="<option value=''>-Select Transaction Type-</option><?php foreach($txn_array as $cat): echo "<option value='".$cat."'>".$cat."</option>"; endforeach; ?>";
		
		
		if(receipt_type=="cash"){
		
			if(metal_type=="gold"){
				rate_per_gram = $("#rate-per-gram").val();
		
		 	}
			 else rate_per_gram = $("#rate-per-gram-silver").val();
		
			amount_input="<td><input placeholder='Amount' type='number' class='form-input input-micro-width cash_amount_class' style='width:90px !important;' name='cash_receipt["+receipt_count+"][total_amount]' id='receipt-amount-"+receipt_count+"' value='0' oninput='amount_to_grams("+receipt_count+");' /><input type='hidden' name='cash_receipt["+receipt_count+"][Payment_Method]' id='receipt-type-"+receipt_count+"' value='cash' /><input type='hidden' name='cash_receipt["+receipt_count+"][rate_per_gram]' id='rate-per-gram-"+receipt_count+"' value='"+rate_per_gram+"'></td>";
		
		}
			 
			 
			 item="<tr id='receipt-row-"+receipt_count+"'>"+
			 "<td><input placeholder='Enter Date' type='date' class='form-input input-micro-width' name='cash_receipt["+receipt_count+"][payment_date]' id='date-"+receipt_count+"' value='<?php echo date("d-m-Y")?>' required style='width:100px !important' max='<?php echo date("Y-m-d"); ?>' /></td>"+
			"<td><select class='form-select input-micro-width' name='cash_receipt["+receipt_count+"][txn_type]' id='txn_type_-"+receipt_count+"' >"+category_options+"</select></td>"+
			 
			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='cash_receipt["+receipt_count+"][notes]' id='additional-notes-deposit-"+receipt_count+"' /></td>"+amount_input+
			    
			 "<td><input type='button' class='form-button small-button bg-red' name='remove_receipt_"+receipt_count+"' id='remove-receipt-"+receipt_count+"' value='x'  onclick='remove_receipt(\"receipt-row-"+receipt_count+"\", \"cash-count\")'/></td>"+	
			   
			 "</tr>";
			 
		
	   $("#cash-receipts-table").append(item);
	
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
		update_total_receipt_grams();
		update_cash_receipt_grams();
	}
	
	//amount to grams
	function amount_to_grams(row_id){
		
		amount=parseFloat($('#receipt-amount-'+row_id).val());
		metal_type = $('#metal_type').val();
		//if(metal_type=='gold'){
			rate_per_gram=parseFloat($('#rate-per-gram-'+row_id).val());
		//}
		//else{}
		grams=amount/rate_per_gram;
		
		grams=grams.toFixed(2);
		
		$('#cash-grams-'+row_id).val(grams);
		
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
		net_gold_receipt = parseFloat(net_gold_receipt).toFixed(3);
		$('#net-deposit-grams-'+row_id).text(net_gold_receipt);
		pure_gold = parseFloat(pure_gold).toFixed(3);
		$('#pure-gold-grams-'+row_id).text(pure_gold);
		copper = parseFloat(copper).toFixed(3);
		$('#copper-grams-'+row_id).text(copper);
		final_grams = parseFloat(final_grams).toFixed(3);
		
		
		$('#final-receipt-grams-'+row_id).text(final_grams);
		
		$('#total-final-receipt-grams-'+row_id).val(final_grams);
		
		
		update_total_receipt_grams();
		
		return final_grams;
		
	}

//calculate total grams receipts
function calculate_cash_grams(row_id){
		
		//alert("hu");
		receipt_grams=parseFloat($('#cash-grams-'+row_id).val());
		
		console.log(receipt_grams);
		//debugger;
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
		net_gold_receipt = parseFloat(net_gold_receipt).toFixed(3);
		$('#net-deposit-grams-'+row_id).text(net_gold_receipt);
		pure_gold = parseFloat(pure_gold).toFixed(3);
		$('#pure-gold-grams-'+row_id).text(pure_gold);
		copper = parseFloat(copper).toFixed(3);
		$('#copper-grams-'+row_id).text(copper);
		final_grams = parseFloat(final_grams).toFixed(3);
		
		console.log(final_grams);
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
			console.log(total_grams+"hi");
		}
		$('#total-cash-receipts').html(total_grams);
		$('#total_cash_amount').html(total_amt);
		
		total_dues = extractNumericValue($("#total-outstanding-grams").html())-extractNumericValue($("#total_approx_grams").html());
		net_making_charges = parseFloat($('#making-charges-total').html());
		$('#total-remaining-balance').html(fixFloat(net_making_charges-total_amt,2));
		total_dues = fixFloat(total_dues,3);
		
		$('#total_dues').html(total_dues);
	}
	
	//update total outstanding receipts
	function update_total_receipt_grams(){
		
		total_array=document.getElementsByName('total_final_receipt_grams[]');
		
		total_grams=0;
		
		for(i=0; i<total_array.length; i++){
			
			
			total_grams=total_grams+parseFloat(total_array[i].value);
			
		}
		
		$('#total-gold-receipts').html(total_grams);
		$('#total-gold-receipts-value').val(total_grams); 
		total_duess = extractNumericValue($("#total-outstanding-grams").html())-extractNumericValue($("#total_approx_grams").html());
		
		total_duess = fixFloat(total_duess,3);
		net_making_charges = parseFloat($('#total-remaining-balance').html());
		net_making_charges = parseFloat($('#making-charges-total').html());
		$('#total-remaining-balance').html(fixFloat(net_making_charges-total_amt,2));
		$('#total_dues').html(total_duess);
	}

</script>


<script>
	
	
	//function to get stone sub type details
	function get_stone_sub_type_config(stone_sub_type_id, div_id){
		
		if(stone_sub_type_id){
			
				$.post("<?php echo site_url("order/get_stone_sub_type"); ?>", {stone_sub_type_id:stone_sub_type_id}, function(data){
			
					var result=JSON.parse(data);
					var unit = result.stone_sub_type.unit;
					$("#stone-cents-"+div_id).val(parseInt(result.stone_sub_type.cents));
					$("#stone-grams-"+div_id).val(parseInt(result.stone_sub_type.grams));
					$("#stone-carat-"+div_id).val(parseInt(result.stone_sub_type.carat));
					$("#stone-rate-"+div_id).val(parseInt(result.stone_sub_type.rate));
					$("#unit_id_"+div_id).html(unit);
					
					
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
			 
			 "<td><select class='form-select input-micro-width' name='stone["+stones_count+"][stone_sub_type_id]' id='stone-sub-type-"+stones_count+"' onchange='get_stone_sub_type_config($(this).val(), \""+stones_count+"\");' ><option value=''>-Stone Sub Type-</option></select></td>"+	
			 
			 "<td><input type='number' class='form-input input-micro-width quantity_class' style='width:70px !important;' name='stone["+stones_count+"][quantity]' id='unit-quantity-"+stones_count+"' value='1' onchange='calculate_stones_gross_amount("+stones_count+");' oninput='calculate_stones_gross_amount("+stones_count+");' /></td>"+	
			// "<td><input type='number' class='form-input input-micro-width' style='width:70px !important;' name='stone["+stones_count+"][quantity]' id='stone-quantity-"+stones_count+"' value='1' /></td>"+	
			 
		//	"<td><input type='number' class='form-input input-micro-width' style='width:70px !important;' name='stone["+stones_count+"][cents]' id='stone-cents-"+stones_count+"' onkeyup='stones_converter(\"cents\", $(this).val(), "+stones_count+");' onchange='stones_converter(\"cents\", $(this).val(), "+stones_count+");' /></td>"+	
			
			//"<td><input type='number' class='form-input input-micro-width' style='width:70px !important;' name='stone["+stones_count+"][grams]' id='stone-grams-"+stones_count+"' onkeyup='stones_converter(\"grams\", $(this).val(), "+stones_count+");' onchange='stones_converter(\"grams\", $(this).val(), "+stones_count+");' /></td>"+	
			
			"<td><input type='number' class='form-input input-micro-width stone_class' style='width:70px !important;' name='stone["+stones_count+"][carat]' id='stone-carat-"+stones_count+"' oninput='calculate_stones_gross_amount("+stones_count+");' onchange='calculate_stones_gross_amount("+stones_count+");' /> <span id='unit_id_"+stones_count+"'></span><input type='hidden' name='stone["+stones_count+"][unit]' id='unit_value_"+stones_count+"' /></td>"+	
			
			"<td><input type='number' class='form-input input-micro-width' style='width:100px !important;' name='stone["+stones_count+"][rate]' id='stone-rate-"+stones_count+"' oninput='calculate_stones_gross_amount("+stones_count+")' onchange='calculate_stones_gross_amount("+stones_count+")' ></td>"+	
			   
			    "<td id='stone-charges-"+stones_count+"' class='stone-charges-inr'>0</td>"+
			   "<td><input type='button' class='form-button small-button bg-red' name='removestone"+stones_count+"' id='remove-stone-"+stones_count+"' value='x'  onclick='remove_stone(\"stone-row-"+stones_count+"\", \"stones-count\", "+stones_count+")'/></td>"+	
			 "</tr>";
			 
			 
			 $("#order-stones-table>tbody>tr").eq(stones_count-1).after(stone);
	   // $("#order-stones-table").append(stone);
	
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
	//remove stone
	function remove_stone(id, count_id="",row=""){

		$("#"+id).remove();
		if(count_id!=""){
			$("#"+count_id).val(parseInt($("#"+count_id).val())-1);
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
		
		quantity=parseFloat($('#unit-quantity-'+row_id).val());
		//console.log(quantity);
		//cents=parseFloat($('#stone-cents-'+row_id).val());
		
		// grams=parseFloat($('#stone-grams-'+row_id).val());
		
		 carat=parseFloat($('#stone-carat-'+row_id).val());
		
		rate=parseFloat($('#stone-rate-'+row_id).val());
		
		gross_total=quantity * carat * rate;
		gross_total = fixFloat(gross_total);
		$('#stone-charges-'+row_id).html(gross_total);
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
			
			stone=$(this).val(); console.log(stone);
			net_stone = net_stone + parseInt(stone);
		
		});
		
		
		//update final total
		gross_total_array=$(".stone-charges-inr");
		
		net_amount=0;
		
		gross_total_array.each(function(){
			
			stone_charge=$(this).html();
			net_amount = net_amount + parseInt(stone_charge);
		
		});
		
		$('#total-stone-charges').html(net_amount);
		$('#total_stone_size').html(net_stone);
		$('#total_quantity').html(net_quantity);
	}

</script>

<script>

//function to populate deposit record
	function add_silver(){
		
		receipt_count=parseInt($("#silver-receipt-count").val())+1;
		
		$("#silver-receipt-count").val(receipt_count);
			
		
		
		amount_input="<input type='hidden' name='silver_receipt["+receipt_count+"][Payment_Method]' id='silver-receipt-type-"+receipt_count+"' value='silver' />";
			 
			 
			 item="<tr id='silver-receipt-row-"+receipt_count+"'>"+
			 "<td><input placeholder='Enter Date' max='<?php echo date("Y-m-d"); ?>' type='date' class='form-input input-micro-width' name='silver_receipt["+receipt_count+"][payment_date]' id='date-"+receipt_count+"' value='<?php echo date("d-m-Y")?>' required /></td>"+
			
			 "<td>Silver</td>"+
			 "<td><input placeholder='Notes..' type='text' class='form-input input-micro-width' name='silver_receipt["+receipt_count+"][notes]' id='additional-notes-silver-deposit-"+receipt_count+"' /> "+amount_input+" </td>"+
			 
			 
			 "<td><input placeholder='Grams' type='number' class='form-input input-micro-width gram_input_column_class' style='width:70px !important;' name='silver_receipt["+receipt_count+"][Grams]' id='silver-receipt-grams-"+receipt_count+"' value='0' oninput='calculate_silver_receipt_grams("+receipt_count+");' /></td>"+
			 
			 "<td><input placeholder='Melting Loss (gms)' type='number' class='form-input input-micro-width melting_input_column_class' style='width:50px !important;' name='silver_receipt["+receipt_count+"][melting_loss]' id='silver-melting-loss-"+receipt_count+"' value='0' oninput='calculate_silver_receipt_grams("+receipt_count+");' /></td>"+
			 
			  "<td><input disabled id='net-silver-deposit-grams-"+receipt_count+"'  class='silver_deposit_column_class' value='0'></td>"+
			 
			 "<td><input placeholder='Quality %' type='number' class='form-input input-micro-width' style='width:50px !important;' name='silver_receipt["+receipt_count+"][Quality]' id='silver-quality-"+receipt_count+"' value='0' oninput='calculate_silver_receipt_grams("+receipt_count+");' /></td>"+
			 
			 "<td id='pure-silver-grams-"+receipt_count+"'>0</td>"+  
			 
			 
			 
			// "<td id='silver-value-inr-"+receipt_count+"'>0</td>"+
			"<td><div class='custom-file' id='silverFile"+receipt_count+"'><input type='file' name='receipt_silver_file["+receipt_count+"]' class='custom-file-input'   /><label class='custom-file-label' for='silverFile"+receipt_count+"'></label></div></td>"+
			 "<td><input type='button' class='form-button small-button bg-red' name='remove_silver_receipt_"+receipt_count+"' id='remove-silver-receipt-"+receipt_count+"' value='x'  onclick='remove_silver_receipt(\"silver-receipt-row-"+receipt_count+"\")'/><input type='hidden' id='total-final-silver-receipt-grams-"+receipt_count+"' name='total_final_silver_receipt_grams[]' value='0' /></td>"+	
			   
			 "</tr>";
			 
			 
			 $("#silver-receipts-table>tbody>tr").eq(receipt_count-1).after(item);	 
	    //$("#silver-receipts-table").append(item);
	
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
		net_silver_receipt = fixFloat(net_silver_receipt, 3);
		$('#net-silver-deposit-grams-'+row_id).val(net_silver_receipt);
		
		quality_percent=parseFloat($('#silver-quality-'+row_id).val());
		
		pure_silver=net_silver_receipt*(quality_percent/100);
		
		final_grams= pure_silver;
		pure_silver = fixFloat(pure_silver, 3);
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
		total_dues =extractNumericValue($("#total-outstanding-grams").html())-extractNumericValue($("#total_approx_grams").html());
		
		 total_dues = fixFloat(total_dues,3);
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

function get_metal_type(metal){
		
		if(metal=="silver"){
			$("#silver_block").removeClass("d-none");
			$("#gold_block").addClass("d-none");
			$("#metal_type").val("silver");
		}
		else{
			$("#silver_block").addClass("d-none");
			$("#gold_block").removeClass("d-none");
			$("#metal_type").val("gold");
		}
			if(metal){	
				$.post("<?php echo site_url("rate/get_metal_rate"); ?>", {metal_type:metal}, function(data){
			
					var result=JSON.parse(data);
					if(result.status==false){
						// $("#today_rate").show();
						$(".add_cash").hide();
						$(".add_rate").show();
						$("#rate-per-gram").val(0);
						$("#today_rate").html("");
					}
					else{
						// $("#today_rate").hide();
						$(".add_cash").show();
						$(".add_rate").hide();
						
						rate_result = result.result;
						
						today_rate = fixFloat(rate_result[0].TodaysRatePerGram,2);
						$("#rate-per-gram").val(today_rate);
						$("#today_rate").html(today_rate);
						
					}
									
				});	
				
			}	
		
		createCategoryOption(metal);
	}
	function createCategoryOption(metal_type){		
		return "<option value=''>-Select J Type-</option>"
		  +categoryOptions.filter(c=>c.metal_type ===metal_type)
		   .map(c=>"<option value='"+c.Category_ID+"'>"+c.Category_Name+"</option>").join("");
	}
//function to get making charges and wastage
function get_item_config(item_id, div_id){
		
		if(item_id){			
				$.post("<?php echo site_url("order/get_jitem"); ?>", {item_id:item_id}, function(data){
			
					var result=JSON.parse(data);
					
					$("#wastage-"+div_id).val(parseInt(result.subcat.wastage_percent));
					
					//making charges set in input
					$("#making-charge-per-gram-"+div_id).val(parseInt(result.subcat.making_charges_per_gram));
					
					calculate_total_grams(div_id);					
				});			
		}		
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
	$( document ).ready(function() {
		categoryOptions = <?php echo json_encode($categories); ?>;
	});
</script>
<style>
	.input-micro-width{width:90px !important;}
	
	.custom-file-input, .custom-file-label {width:62px !important;}
	.custom-file-label::after {width:10px !important;}
</style>
