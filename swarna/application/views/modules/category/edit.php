<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit J Type Info</h1>
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
	<form action="<?php echo site_url("category/browse?edit_form=yes&category_id=".$cat['Category_ID']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="User_id" value="<?php echo $cat['Category_ID']; ?>" />
		<div class="form-block">
			
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">J type Name</label>
					<input type="text" class="form-input" name="full_name" placeholder="Full Name" minlength='1' maxlength='50' value="<?php echo set_value('full_name',$cat['Category_Name']); ?>" required/>
				</div>
				<div class="form-column">
					<label class="radio-label">Select Metal</label>
					<select name="metal_type" class="form-select valid" required="" aria-invalid="false">
						<option>Select Metal</option>
						<option value='gold' <?php echo ($cat['metal_type']=="gold") ? "selected" : ""; ?>>Gold</option>
						<option value="silver" <?php echo ($cat['metal_type']=="silver") ? "selected" : ""; ?>>Silver</option>
			        </select>
				</div>
				<div class="clear"></div>
			</div>

			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Save.." />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("category/browse"); ?>');"><i class="fas fa-arrow-left"></i> Cancel</button>
					
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
