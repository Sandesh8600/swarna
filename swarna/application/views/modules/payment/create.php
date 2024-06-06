<?php
$this->db->select("*");
$this->db->from("customers");
$query = $this->db->get();

?>
<?php
$this->load->helper('date');
$c_date = date("Y-m-d");
$this->db->select("*");
$this->db->from("todaysratepergram");
$this->db->where("Timestamp", $c_date);
$queryrate = $this->db->get();

?>

<script>
$(document).ready(function(){
	var date = '<?php echo date("d-m-Y");?>'
    $('input[name=order_date]').val(date);

});
</script>

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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> -->

<!-- <script>
$(document).ready(function () {
//change selectboxes to selectize mode to be searchable
   $("select").select2();
});
</script> -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Payment Ticket for Order-ID #<?php echo $this->session->userdata('viewtask_id');?></h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
<!-- search content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
				<div class="card-body">
	<div  class="" data-aos="fade-up">
		
<div id='create-form'>
<!-- <h1 class='h1-title'></h1> -->
<div class="form-div">
	
	<div class="validation-errors"><?php echo validation_errors(); ?></div>
	<form action="<?php echo site_url("payment/create"); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id">
		
	  <div class="form-block">

	       <!-- <div class="form-row" style="width:100%;display:flex;">
				<div class="form-column">
					<label class="radio-label">Customers Name</label>
			        <select name="customer" class="form-select valid" required="" aria-invalid="false">
						<option>Select Customer</option>
						<?php
						foreach($query->result() as $row)
                          {
							echo '<option value='.$row->Customer_Code.'>'.$row->Customer_Name.'/'.$row->Customer_Code.'</option>';
						  }
						?>
			        </select>
					
				</div> -->

			</div>
			<div class="form-row">
			    <div class="form-column">
					<label class="radio-label">Payment Date</label>
					<input type="text" class="form-input datepicker" name="order_date" placeholder="Order Date" value="" required="" minlength='1' maxlength='50'>
				</div>
				<!-- <div class="form-column">
					<label class="radio-label">Claim Date</label>
					<input type="text" class="form-input datepicker" name="claim_date" placeholder="Claim Date" value="" minlength='1' maxlength='50' required="">
				</div> -->
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Payment Method</label>
					<select name="method" class="form-select" required="">
					<option>gold</option>
					<option>cash</option>
					</select>
					<!-- <input type="text" class="form-input" name="method" placeholder="Payment Method" minlength='1' maxlength='50' value="<?php echo set_value('method'); ?>" required> -->
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Gold in Grams</label>
					<input type="number" class="form-input" name="quantity" placeholder="Quantity" minlength='1' maxlength='50' value="<?php echo set_value('quantity'); ?>" required/>
				</div>
                <input type="hidden" name="valnew">
				<div class="form-column" id="purity">
					<label class="radio-label">Metal/Purity Percentage</label>
					<input type="number" class="form-input" name="purity" placeholder="Metal/Purity Percentage" minlength='1' maxlength='50' value="92" required/>
				</div>
			
				<div class="form-column">
					<label class="radio-label">Today's Rate</label>
			        <select name="percentage" class="form-select valid" required="" aria-invalid="false">
						<?php
						foreach($queryrate->result() as $row_rate)
                          {
							echo '<option value='.$row_rate->TodaysRatePerGram.'>'.$row_rate->karrat.' = Rs.'.$row_rate->TodaysRatePerGram.'</option>';
						  }
						?>
			        </select>
					
				</div>
				<script>
				$('select').on('change', function() {
                   var today = parseFloat(this.value);
				   var gold = parseFloat($('input[name=quantity]').val());
				   var total = today*gold;
				   $('input[name=amount]').val(total);
                });
				</script>
				
				
				<script>
				$('input[name=quantity').keyup(function() {
					    $('input[name=valnew]').val($('input[name=quantity]').val());
					   var todayPrice = parseInt($('select[name=percentage]').find(":selected").val());
					   todayPrice = todayPrice*parseInt($('input[name=quantity]').val());
					   var total = todayPrice;
                       $('input[name=amount]').val(total);

					   var percent = parseFloat($('input[name=purity]').val());
					//    alert(percent);
					   var est = (percent/100)*parseInt($('input[name=quantity]').val());
                       $('input[name=estimated]').val(est.toFixed(2));
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
                       $('input[name=estimated]').val(total.toFixed(2));
                });
				</script>
				<div class="clear"></div>
				<div class="form-column">
					<label class="radio-label">Amount</label>
					<input type="number" class="form-input" name="amount" placeholder="Amount" minlength='1' maxlength='50' value="<?php echo set_value('amount'); ?>" required/>
				</div>
				<div class="form-column total">
					<label class="radio-label">Total Gold in Grams</label>
					<input type="number" class="form-input" name="estimated" placeholder="Total Gold in Grams" minlength='1' maxlength='50' value="<?php echo set_value('estimated'); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>
			<script>
				$('input[name=amount').keyup(function() {
					   var todayPrice = parseFloat($('select[name=percentage').find(":selected").val());
					   todayPrice = parseFloat($('input[name=amount').val())/todayPrice;
					   
					   var total = todayPrice;
                       $('input[name=quantity]').val(total);
                });
			</script>
			
			

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Payment Status</label>
					<!-- <input type="text" class="form-input" name="status" placeholder="Task Status" value="<?php echo set_value('status'); ?>" required/> -->
					<label class="form-radio">
					<input type="radio" name="status" value="1" <?php echo set_radio('status',1); ?> required/> Pending
					</label>
					<label class="form-radio">
					<input type="radio" name="status" value="0" <?php echo set_radio('status',0); ?> required/> Received
					</label>
				</div>
				<div class="clear"></div>
			</div>
			
			
		</div>

			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Submit" />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("order/vieworder"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
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
	$("#create-form-id").validate({
		rules: {
			/*repassword: {
				equalTo:'#user-password'
			}*/
		}
	});
	</script>
	</div>
</div>


	</div>
</div>
</div></div></div></div>
</section>
</div>