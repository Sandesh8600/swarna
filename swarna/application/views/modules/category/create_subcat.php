<?php
$this->db->select("*");
$this->db->from("category");
$query = $this->db->get();
$metal_type = $this->input->get("metal_type");
?>
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Sub J Type(<?php echo ucfirst($metal_type) ?>)</h1>
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
	<form action="<?php echo site_url("category/browse?subcat_create_form=yes"); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id">
		
	  <div class="form-block">
	       <div class="form-row" style="width:100%;display:flex;">
				<div class="form-column">
					<label class="radio-label">J TYpe Name</label>
			        <select name="category_id" class="form-select valid" required="" aria-invalid="false">
						<option>Select Model</option>
						<?php
					//	foreach($query->result() as $row)
						foreach($users as $row)
                          {
							echo '<option value='.$row['Category_ID'].'>'.$row['Category_Name'].'</option>';
						  }
						?>
			        </select>
					<div class="clear"></div>
				</div>
			</div>

		
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Sub J TYpe Name</label>
					<input type="text" class="form-input" name="full_name" placeholder="Full Name" value="<?php echo set_value('full_name'); ?>" minlength='4' maxlength='50' required/>
				</div>
				
				<!-- <div class="form-column">
					<label class="radio-label">Making Charges / gram (Rs)</label>
					<input type="number" class="form-input" name="making_charges_per_gram" placeholder="Making Charges/Gram" value="<?php echo set_value('making_charges_per_gram'); ?>" step='0.001' onkeyup="parseFloat($(this).val()).toFixed(3);"  required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Wastage Percent (%)</label>
					<input type="number" class="form-input" name="wastage_percent" placeholder="Wastage Percent" value="<?php echo set_value('wastage_percent'); ?>"  required/>
				</div> -->
				
				<div class="clear"></div>
			</div>

			
			
		</div>

		<?php
			
		?>
		<input type="hidden" name="metal_type" value="<?php echo $metal_type; ?>">
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Submit" />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("category/browse?metal_type=$metal_type"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
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
    //full_name: { lettersonly: true }
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
</div>
</div>
</div>
</section>
