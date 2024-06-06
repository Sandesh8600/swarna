<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Workshop Info</h1>
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
	<form action="<?php echo site_url("workshop/edit/".$user['Workshop_Code']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="User_id" value="<?php echo $user['Workshop_Code']; ?>" />
		<div class="form-block">
			
		<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Workshop Name</label>
					<input type="text" class="form-input" name="full_name" placeholder="Workshop Name" minlength='1' maxlength='50' value="<?php echo set_value('full_name',$user['Workshop_Name']); ?>" required/>
				</div>
				<div class="form-column">
					<label class="radio-label">Email ID</label>
					<input type="text" class="form-input" name="email" placeholder="Email ID" minlength='1' maxlength='50' value="<?php echo set_value('email',$user['Workshop_Email_Id']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Workshop Address</label>
					<textarea class="form-input" name="address" rows="5" minlength='1' maxlength='300' placeholder="Address" required/><?php echo set_value('address',$user['Workshop_Address']); ?></textarea>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Opening Gold Balance in Gms</label>
					<input type="number" class="form-input" name="balance" minlength='1' maxlength='50' placeholder="Opening Gold Balance in Gm's" value="<?php echo set_value('balance',$user['Workshop_GoldBalanceInGram']); ?>" required/>
				</div>
				<div class="form-column">
					<label class="radio-label">Opening Balance(INR)</label>
					<input type="text" class="form-input" name="balance_inr" placeholder="Workshop opening Balance in INR" value="<?php echo set_value('balance_inr', $user['balance_inr']); ?>" minlength='1' maxlength='10' required/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Contact Number</label>
					<input type="number" class="form-input" name="number1" minlength='10' maxlength='12' placeholder="Contact Number" value="<?php echo set_value('number1',$user['Workshop_Contact_Mobile_Number1']); ?>" required/>
				</div>
				
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">ID Proof Type</label>
					<select name="id_proof_type" class="form-select" required>
						<option val="">Select</option>
						<option val="aadhar" <?php echo set_select('id_proof_type',$user['id_proof_type'], $user['id_proof_type']=="aadhar"?true:false); ?>>Aadhar</option>
						<option val="pan" <?php echo set_select('id_proof_type',$user['id_proof_type'], $user['id_proof_type']=="pan"?true:false); ?>>PAN</option>
						<option val="driving_license" <?php echo set_select('id_proof_type',$user['id_proof_type'], $user['id_proof_type']=="driving_license"?true:false); ?>>Driving License</option>
					</select>
					
				</div>
				<div class="form-column">
					<label class="radio-label">ID Proof Number</label>
					
					<input type="text" class="form-input" name="id_proof_number" placeholder="ID proof Number" value="<?php echo set_value('id_proof_number',$user['id_proof_number']); ?>" minlength='3' maxlength='20' required/>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="form-row">
				
				<div class="form-column">
					<label class="radio-label">Change ID Proof File (PDF/image)</label>
					
					<input type="file" class="form-input" name="id_proof_file" placeholder="ID proof File"  />
					
					<?php if($user['id_proof_file']): ?><br/><br/>
					<a target="_blank" href="<?php echo base_url("files/".$user['id_proof_file']); ?>">View ID Proof</a>
						
					
					<?php endif; ?>
				</div>
				<div class="clear"></div>
			</div>

			


			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Save.." />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("workshop/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
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
</div></div></div></div>
</section>
</div>
