<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Customer</h1>
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
	<form action="<?php echo site_url("user/create"); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id">
		
		<div class="form-block">
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Customer Name</label>
					<input type="text" class="form-input" name="full_name" placeholder="" value="<?php echo set_value('full_name'); ?>" minlength='5' maxlength='100' autocomplete="off" required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Email</label>
					<input type="email" class="form-input" name="email" placeholder="" value="<?php echo set_value('email'); ?>" minlength='5' maxlength='100' autocomplete="off" required/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Address</label>
					<input class="form-input" name="current" placeholder="" value="<?php echo set_value('current'); ?>" required>
				</div>
				<div class="form-column">
					<label class="radio-label">City</label>
					<input type="text" class="form-input" name="city" placeholder="" value="<?php echo set_value('city'); ?>" autocomplete="off"  minlength='4' maxlength='50'/>
				</div>
				
				<div class="clear"></div>
			</div>
			

			<div class="form-row">
				
				
				<div class="form-column">
					<label class="radio-label">Pincode</label>
					<input type="number" class="form-input" name="pincode" placeholder="" value="<?php echo set_value('pincode'); ?>" autocomplete="off" minlength='6' maxlength='6' required/>
				</div>
				<div class="form-column">
					<label class="radio-label">Contact Number</label>
					<input type="number" class="form-input" name="phone1" placeholder="" value="<?php echo set_value('phone1'); ?>" autocomplete="off" minlength='10' maxlength='13' required/>
                </div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">PAN Number</label>
					<input type="text" class="form-input" name="pan" placeholder="" value="<?php echo set_value('pan'); ?>" minlength='10' autocomplete="off" maxlength='10' required/>
                </div>
                <div class="form-column">
					<label class="radio-label">Opening Gold Balance (Grams)</label>
					<input type="number" class="form-input" name="opening_balance" placeholder="" autocomplete="off" value="<?php echo set_value('opening_balance'); ?>" minlength='1' maxlength='1000' required/>
                </div>
				<div class="clear"></div>
			</div>
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Making Charge</label>
					<input type="text" class="form-input" name="making_charge" placeholder="" value="<?php echo set_value('making'); ?>" minlength='1' autocomplete="off" maxlength='100000' />
                </div>
                <div class="form-column">
					<label class="radio-label">Opening Silver Balance (Grams)</label>
					<input type="number" class="form-input" name="opening_silver_balance" placeholder="" autocomplete="off" value="<?php echo set_value('opening_silver_balance'); ?>" minlength='1' maxlength='10000' />
                </div>
				<div class="clear"></div>
			</div>
			
			<div class="form-row">
				
				<!--<div class="form-column">
					<label class="radio-label">Record Status</label>
					<label class="form-radio">
					<input type="radio" name="status" value="1" <?php echo set_radio('status',1); ?> required/> Active
					</label>
					<label class="form-radio">
					<input type="radio" name="status" value="0" <?php echo set_radio('status',0); ?> required/> InActive
					</label>
				</div>-->
				<div class="clear"></div>
			</div>
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Submit" />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("user/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
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
jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
}, "Letters only please"); 
$("form").validate({
  rules: {
    full_name: { lettersonly: true },
	locality: { lettersonly: true },
	landmark: { lettersonly: true },
	city: { lettersonly: true },
	state: { lettersonly: true }
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
