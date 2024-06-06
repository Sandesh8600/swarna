<?php
$this->db->select("*");
$this->db->from("customers");
$query = $this->db->get();

?>

<script>
$(document).ready(function(){
  $('select').change(function(){
	  var val = this.value;
	 
	  if(val == 'cash')
	  {
		  $('#purity').css('display','none');
		  $('.total').css('display','none');
		//   alert(val);
	  }
	  if(val == 'gold')
	  {
		  $('#purity').css('display','block');
		  $('.total').css('display','block');
		//   alert(val);
	  }
  });
});
</script>
<div class="box-width">
	<div  class="form-container" data-aos="fade-up">
		
<div id='edit-form'>
<h1 class='h1-title'>Edit Payment Ticket for Order-ID #<?php echo $this->session->userdata('viewtask_id');?></h1>
<div class="form-div">
	
	<div class="validation-errors"><?php echo validation_errors(); ?></div>
	<form action="<?php echo site_url("payment/edit/".$user['Payment_code']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="User_id" value="<?php echo $user['Payment_code']; ?>" />
		<div class="form-block">

	       <!-- <div class="form-row" style="width:100%;display:flex;">
				<div class="form-column">
					<label class="radio-label">Customers Name</label>
			        <select name="customer" class="form-select valid" required="" aria-invalid="false">
						
						<?php
						foreach($query->result() as $row)
                          {
							  if($row->Customer_Code == $user['Customer_Code'])
							  {
								echo '<option value='.$row->Customer_Code.'>'.$row->Customer_Name.'/'.$row->Customer_Code.'</option>';
							  }
							
						  }
						  foreach($query->result() as $row)
                          {
							  if($row->Customer_Code != $user['Customer_Code'])
							  {
								echo '<option value='.$row->Customer_Code.'>'.$row->Customer_Name.'/'.$row->Customer_Code.'</option>';
							  }
							
						  }
						?>
			        </select>
					
				</div>
			</div> -->

				<div class="form-row">
			    <div class="form-column">
					<label class="radio-label">Payment Date</label>
					<input type="text" class="form-input datepicker" name="order_date" placeholder="Payment Date" minlength='1' maxlength='50' value="<?php echo set_value('order_date',$user['Date_Of_Order']); ?>" required="">
				</div>
				
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Payment Method</label>
					<select name="method" class="form-select" required="">
					    <?php if($user['Payment_Method']=='gold')
						{
							echo '<option>gold</option>';
							echo '<option>cash</option>';
						}
						if($user['Payment_Method']!='gold')
						{
							echo '<option>cash</option>';
							echo '<option>gold</option>';
						}
						?>
					    
					</select>
					<!-- <input type="text" class="form-input" name="method" placeholder="Payment Method" minlength='1' maxlength='50' value="<?php echo set_value('method',$user['Payment_Method']); ?>" required> -->
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Quantity</label>
					<input type="number" class="form-input" name="quantity" placeholder="Quantity" minlength='1' maxlength='50' value="<?php echo set_value('quantity',$user['Quantity']); ?>" required/>
				</div>
				<input type="hidden" name="valnew" value="<?php echo set_value('quantity',$user['Quantity']); ?>">
				<div class="form-column" id="purity">
					<label class="radio-label">Metal/Puriity Percentage</label>
					<input type="number" class="form-input" name="purity" placeholder="Metal/Puriity Percentage" minlength='1' maxlength='50' value="<?php echo set_value('purity',$user['Percentage']); ?>" required/>
				</div>
				<script>
				$('input[name=quantity').keyup(function() {
					   $('input[name=valnew]').val($('input[name=quantity]').val());
					   var todayPrice = parseInt($('input[name=percentage').val());
					   todayPrice = todayPrice*parseInt($('input[name=quantity').val());
					   
					   var total = todayPrice;
                       $('input[name=amount]').val(total);
                });
				</script>
				<script>
				$('input[name=purity').keyup(function() {
					//    var todayPrice = parseInt($('select[name=percentage').find(":selected").val());
					   var todayPrice = parseFloat($('input[name=valnew]').val());
					//    alert(todayPrice);
					   var percent = parseFloat($('input[name=purity]').val());
					//    alert(percent);
					   var total = (percent/100)*todayPrice;
                       $('input[name=estimated]').val(total);
                });
				</script>
				<div class="form-column">
					<label class="radio-label">Metal/Puriity</label>
					<input type="number" class="form-input" name="percentage" placeholder="Purity" minlength='1' maxlength='50' value="<?php echo set_value('percentage',$user['purity']); ?>" required/>
				</div>

				<div class="clear"></div>
				<div class="form-column">
					<label class="radio-label">Amount</label>
					<input type="number" class="form-input" name="amount" placeholder="Amount" minlength='1' maxlength='50' value="<?php echo set_value('amount',$user['Amount']); ?>" required/>
				</div>
				<div class="form-column total">
					<label class="radio-label">Total Gold in Grams</label>
					<input type="number" class="form-input" name="estimated" placeholder="Total Gold in Grams" minlength='1' maxlength='50' value="<?php echo set_value('estimated',$user['Total_gold']); ?>" required/>
				</div>
				<script>
				$('input[name=amount').keyup(function() {
					   var todayPrice = parseFloat($('input[name=percentage').val());
					   todayPrice = parseFloat($('input[name=amount').val())/todayPrice;
					   
					   var total = todayPrice;
                       $('input[name=quantity]').val(total);
                });
			</script>
				<div class="clear"></div>
			</div>


			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Status</label>
					<!-- <input type="text" class="form-input" name="status" placeholder="Task Status" value="<?php echo set_value('status',$user['Ticket_Status']); ?>" required/> -->
					<label class="form-radio">
					<input type="radio" name="status" value="1" <?php echo set_radio('status',1,$user['Payment_Status']==1? true:false); ?> required/> In Complete
					</label>
					<label class="form-radio">
					<input type="radio" name="status" value="0" <?php echo set_radio('status',0,$user['Payment_Status']==0? true:false); ?> required/> Received
					</label>
				</div>
				<div class="clear"></div>
			</div>

			
		
		</div>
			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button bg-green" name="submit" value="Save.." />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("order/vieworder"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
		</div>
	</form>
	<script>
	$("#edit-form-id").validate({
		rules: {
			Repassword: {
				equalTo:'#category-password'
			}
		}
	});
	</script>
	</div>
</div>


	</div>
</div>
