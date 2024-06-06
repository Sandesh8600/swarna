<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create J TYpe</h1>
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
<h1 class='h1-title'></h1>
<div class="form-div">
	
	<div class="validation-errors"><?php echo validation_errors(); ?></div>
	<form action="<?php echo site_url("category/browse?create_form=yes"); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id">
		
		<div class="form-block">
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">J Type Name</label>
					<input type="text" class="form-input" name="full_name" placeholder="Full Name" value="<?php echo set_value('full_name'); ?>" minlength='3' maxlength='50' required/>
				</div>
				<!-- <div class="form-column">
					<label class="radio-label">Select Metal</label>
					<select name="metal_type" class="form-select valid" required="" aria-invalid="false">
						<option>Select Metal</option>
						<option value='gold'>Gold</option>
						<option value="silver">Silver</option>
			        </select>
				</div> -->
				<?php
					$metal_type = $this->input->get("metal_type");
				?>
				<input type="hidden" name="metal_type" value="<?php echo $metal_type; ?>">
				<div class="clear"></div>
			</div>

			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Submit" />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("category/browse?metal_type=$metal_type"); ?>');"><i class="fas fa-arrow-left"></i> Cancel</button>
					
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
