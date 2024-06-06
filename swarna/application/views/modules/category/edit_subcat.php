<?php
$this->db->select("*");
$this->db->from("category");
$query = $this->db->get();

?>
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Sub J Type</h1>
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
	<form action="<?php echo site_url("category/browse?subcat_edit_form=yes&subcategory_id=".$subcategory['SubCategory_ID']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="subcategory_id" value="<?php echo $subcategory['SubCategory_ID']; ?>" />
		<div class="form-block">

		<div class="form-row" style="width:100%;display:flex;">
				<div class="form-column">
					<label class="radio-label"> J Type</label>
			        <select name="category_id" class="form-select valid" required="" aria-invalid="false">
						<?php
						foreach($query->result() as $row)
                          {
							  if($row->Category_ID == $subcategory['Category_ID'])
							  {
								echo '<option value='.$row->Category_ID.'>'.$row->Category_Name.'</option>';
							  }
						  }
						  foreach($query->result() as $row)
                          {
							  if($row->Category_ID != $subcategory['Category_ID'])
							  {
								echo '<option value='.$row->Category_ID.'>'.$row->Category_Name.'</option>';
							  }
						  }
						?>
			        </select>
					<!-- <div class="clear"></div> -->
				</div>
			<!-- </div>
			
			<div class="form-row"> -->
				<div class="form-column">
					<label class="radio-label">Sub J Name</label>
					<input type="text" class="form-input" name="full_name" placeholder="Full Name" minlength='4' maxlength='50' value="<?php echo set_value('full_name',$subcategory['SubCategory_Name']); ?>" required/>
				</div>
				
				<!-- <div class="form-column">
					<label class="radio-label">Making Charges / gram (Rs)</label>
					<input type="number" class="form-input" name="making_charges_per_gram" placeholder="Making Charges/Gram" value="<?php echo set_value('making_charges_per_gram',addPrecision($subcategory['making_charges_per_gram'],2)); ?>"  required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Wastage Percent (%)</label>
					<input type="number" class="form-input" name="wastage_percent" placeholder="Wastage Percent" value="<?php echo set_value('wastage_percent',$subcategory['wastage_percent']); ?>"  required/>
				</div> -->
				
				<div class="clear"></div>
			</div>

			<?php
					$metal_type = $this->input->get("metal_type");
				?>
				<input type="hidden" name="metal_type" value="<?php echo $metal_type; ?>">
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Save.." />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("category/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
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
</div></div></div>
</section>
