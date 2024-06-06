<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Customer Info</h1>
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
		
<div id='edit-form'>
<!-- <h1 class='h1-title'></h1> -->
<div class="form-div">
	
	<div class="validation-errors"><?php echo validation_errors(); ?></div>
	<form action="<?php echo site_url("user/edit/".$user['Customer_Code']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="User_id" value="<?php echo $user['Customer_Code']; ?>" />
		<div class="form-block">
			
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Customer Name</label>
					<input type="text" class="form-input" name="full_name" placeholder="Full Name" minlength='5' maxlength='100' autocomplete="off" value="<?php echo set_value('full_name',$user['Customer_Name']); ?>" required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Email</label>
					<input type="email" class="form-input" name="email" placeholder="Email" minlength='5' maxlength='100' autocomplete="off" value="<?php echo set_value('email',$user['Customer_Email']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>

			

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Address</label>
					<input class="form-input" name="current" placeholder="Address" required value="<?php echo set_value('current',$user['Customer_Billing_address']); ?>" />
				</div>
				<div class="form-column">
					<label class="radio-label">City</label>
					<input type="text" class="form-input" name="city" placeholder="City" minlength='4' maxlength='50' autocomplete="off" value="<?php echo set_value('city',$user['Customer_City']); ?>" />
				</div>
				
				<div class="clear"></div>
			</div>

			<div class="form-row">
				
				
				<div class="form-column">
					<label class="radio-label">Pincode</label>
					<input type="number" class="form-input" name="pincode" placeholder="Pincode" minlength='6' maxlength='6' autocomplete="off" value="<?php echo set_value('pincode',$user['Customer_Pincode']); ?>" required/>
				</div>
				<div class="form-column">
					<label class="radio-label">Contact Number</label>
					<input type="number" class="form-input" name="phone1" minlength='10' maxlength='12' placeholder="Contact Number" autocomplete="off" value="<?php echo set_value('phone1',$user['Customer_Mobile_Number1']); ?>" minlength='10' maxlength='13' required/>
                </div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
			
				
				
				
				<div class="form-column">
					<label class="radio-label">PAN Number</label>
					<input type="text" class="form-input" name="pan" minlength='10' maxlength='12' placeholder="PAN Number" autocomplete="off" value="<?php echo set_value('pan',$user['pan']); ?>" minlength='10' maxlength='13' required/>
                </div>
                <div class="form-column">
					<label class="radio-label">Opening Gold Balance (Grams)</label>
					<input type="number" class="form-input" name="opening_balance" placeholder="Opening Balance" autocomplete="off" value="<?php echo set_value('opening_balance', $user['opening_balance']); ?>" minlength='1' maxlength='1000' required/>
                </div>
				<div class="clear"></div>
			</div>
			
			
			
			
			<div class="form-row">
				
				<!--<div class="form-column">
					<label class="radio-label">Record Status</label>
					<label class="form-radio">
					<input type="radio" name="Status" value="1" <?php echo set_radio('Status',1,$user['Customer_Status']==1? true:false); ?> required/> Active
					</label>
					<label class="form-radio">
					<input type="radio" name="Status" value="0" <?php echo set_radio('Status',0,$user['Customer_Status']==0? true:false); ?> required/> InActive
					</label>
				</div>-->
				<div class="clear"></div>
			</div>
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Save.." />
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
	$("#edit-form-id").validate({
		rules: {
			Repassword: {
				equalTo:'#user-password'
			}
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
