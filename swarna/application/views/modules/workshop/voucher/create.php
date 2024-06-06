<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add voucher details</h1>
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
	<form action="<?php echo site_url("voucher/create"); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id">
		
		<div class="form-block">
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">voucher Id</label>
					<input type="number" class="form-input" name="voucher" placeholder="Workshop Name" value="<?php echo set_value('voucher'); ?>" minlength='1' maxlength='5' required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">worksop</label>
					<input type="email" class="form-input" name="email" placeholder="Email ID" value="<?php echo set_value('workshop_id'); ?>" minlength='4' maxlength='100' required/>
				</div>
			
				<div class="clear"></div>
			</div>

			<div class="form-row">
					<div class="form-column">
					<label class="radio-label">Order id</label>
					<input type="number" class="form-input" name="number1" placeholder="Mobile Number1" value="<?php echo set_value('order_id'); ?>" minlength='10' maxlength='13' required/>
				</div>
				<div class="form-column">
					<label class="radio-label">Item_id</label>
					<input type="number" class="form-input" name="number1" placeholder="Mobile Number1" value="<?php echo set_value('item_id'); ?>" minlength='10' maxlength='13' required/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Gold Melting Id</label>
					<input type="text" class="form-input" name="balance" placeholder="Workshop Gold Balance in Gm's" value="<?php echo set_value('gold_melting_id'); ?>" minlength='1' maxlength='10' required/>
				</div>
				<div class="form-column">
					<label class="radio-label">Gold given</label>
					<input type="number" class="form-input" name="balance_inr" placeholder="Workshop opening Balance in INR" value="<?php echo set_value('gold_given'); ?>" minlength='1' maxlength='10' required/>
				</div>
				<div class="clear"></div>
			</div>

            <div class="form-row">
				<div class="form-column">
					<label class="radio-label">Gold Recived</label>
					<input type="text" class="form-input" name="balance" placeholder="Workshop Gold Balance in Gm's" value="<?php echo set_value('gold_recived'); ?>" minlength='1' maxlength='10' required/>
				</div>
				
				<div class="clear"></div>
			</div>


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
</script>
			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Submit" />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("goldtransaction/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
		</div>
	</form>

	<script>
jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z0-9 ]*$/.test(value);
}, "Letters only please"); 
$("form").validate({
  rules: {
    full_name: { lettersonly: true }
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