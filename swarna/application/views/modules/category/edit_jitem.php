<?php
$this->db->select("*");
$this->db->from("category");
$query = $this->db->get();
$metal_type = $this->input->get("metal_type");
$categoryId = "";
?>
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit J Item(<?= ucfirst($metal_type) ?>)</h1>
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
	<form action="<?php echo site_url("category/browse?jitem_edit_form=yes&jitem_id=".$subcategory['SubCategory_ID']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="item_id" value="<?php echo $jwellery_item['item_id']; ?>" />
		<div class="form-block">

		<div class="form-row" style="width:100%;display:flex;">
				<div class="form-column">
					<label class="radio-label">Category Name</label>
			        <select name="category_id" class="form-select valid" required="" aria-invalid="false" onchange='sub_category_options($(this).val());'>
						<?php 
						$subcategory_array = array();
						foreach($users  as $row)
                          {
							  if($row['Category_ID'] == $subcategory['Category_ID'])
							  {
								 $categoryId = $subcategory['Category_ID'];
								echo '<option value='.$row['Category_ID'].'>'.$row['Category_Name'].'</option>';
								$j=1;
								foreach($row['subcategories'] as $subcat){
									$subcategory_array[$j]["SubCategory_Name"]= $subcat['SubCategory_Name'];
									$subcategory_array[$j]["SubCategory_ID"]= $subcat['SubCategory_ID'];
									$j++;
								  }
							  }
							 
						  }
						  foreach($users as $row)
                          {
							  if($row['Category_ID'] != $subcategory['Category_ID'])
							  {
								echo '<option value='.$row['Category_ID'].'>'.$row['Category_Name'].'</option>';
							  }
						  }
						?>
			        </select>
					
				</div>
				<div class="form-column">
					<label class="radio-label">Sub Category Name</label>
			        <select name="subcategory_id" class="form-select valid" required="" aria-invalid="false" id="sub-category" >
						<?php
						
						foreach($subcategory_array as $row)
                          { 
							  if($row['SubCategory_ID'] == $subcategory['SubCategory_ID'])
							  {
								echo '<option value='.$row['SubCategory_ID'].'>'.$row['SubCategory_Name'].'</option>';
							  }
						  }
						  foreach($subcategory_array as $row)
                          {
							  if($row['SubCategory_ID'] != $subcategory['SubCategory_ID'])
							  {
								echo '<option value='.$row['SubCategory_ID'].'>'.$row['SubCategory_Name'].'</option>';
							  }
						  }
						?>
			        </select>
					
				</div>
				<!-- <div class="clear"></div>
			</div> -->
			
			
				<div class="form-column">
					<label class="radio-label">J Item Name</label>
					<input type="text" class="form-input" name="full_name" placeholder="Full Name" minlength='4'  value="<?php echo set_value('full_name',$jwellery_item['item_name']); ?>" required style="width:220%"/>
				</div>
				</div>
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Making Charges / gram (Rs)</label>
					<input type="number" class="form-input" name="making_charges_per_gram" placeholder="Making Charges/Gram" value="<?php echo set_value('making_charges_per_gram',addPrecision($jwellery_item['making_charges_per_gram'],2)); ?>"  required/>
				</div>
			
				<div class="form-column">
					<label class="radio-label">Wastage Type</label>
				
					<select name="wastage_type" class="form-select valid" required=""  aria-invalid="false" onchange="get_wastage_type($(this).val())">
							<option value="percent" <?php echo (set_value('wastage_type',$jwellery_item['wastage_type'])=="percent") ? "selected" : ""; ?>>Percent </option>
							<option value="gram" <?php echo (set_value('wastage_type',$jwellery_item['wastage_type'])=="gram") ? "selected" : ""; ?>>Gram </option>
						</select>
				</div>
				<div class="form-column">
					<label class="radio-label">Wastage </label>
					<input type="number" class="form-input" name="wastage_percent" placeholder="Wastage " value="<?php echo set_value('wastage_percent',$jwellery_item['wastage_percent']); ?>"  required/>
				</div>
				<div class="clear"></div>
			</div>

			<?php
					$metal_type = $this->input->get("metal_type");
				?>
				<input type="hidden" name="metal_type" value="<?php echo $metal_type; ?>">
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Save.." />
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
