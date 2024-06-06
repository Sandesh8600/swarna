<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Items Info</h1>
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
	<form action="<?php echo site_url("items/edit/".$user['Item_Code']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="User_id" value="<?php echo $user['Item_Code']; ?>" />
		<div class="form-block">
			
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Item Name</label>
					<input type="text" class="form-input" name="full_name" minlength='1' maxlength='50' placeholder="Item Name" value="<?php echo set_value('full_name',$user['Item_Name']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				
				<div class="form-column">
					<label class="radio-label">Status</label>
					<label class="form-radio">
					<input type="radio" name="Status" value="1" <?php echo set_radio('Status',1,$user['Status']==1? true:false); ?> required/> Active
					</label>
					<label class="form-radio">
					<input type="radio" name="Status" value="0" <?php echo set_radio('Status',0,$user['Status']==0? true:false); ?> required/> InActive
					</label>
				</div>
				<div class="clear"></div>
			</div>

			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Save.." />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("items/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
		</div>
	</form>
	<script>
jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
}, "Letters only please"); 
$("form").validate({
  rules: {
    full_name: { lettersonly: true }
  }
});
</script>
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