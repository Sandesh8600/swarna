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
            <h1>Create J Item(<?php echo ucfirst($metal_type) ?>)</h1>
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
			<form action="<?php echo site_url("category/browse?jitem_create_form=yes"); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id">
				
			<div class="form-block">
			<div class="form-row" style="width:100%;display:flex;">
					<div class="form-column">
						<label class="radio-label">J Type Name</label>
						<select name="category_id" class="form-select valid" required="" onchange='sub_category_options($(this).val());'  aria-invalid="false">
							<option>Select J Type</option>
							<?php
							foreach($users as $row)
							{
								echo '<option value='.$row['Category_ID'].'>'.$row['Category_Name'].'</option>';
							}
							?>
						</select>
						
					</div>
					<div class="form-column">
						<label class="radio-label">Sub J Type Name</label>
						<select name="sub_category_id" id="sub-category" class="form-select valid" required="" aria-invalid="false">
							<option>Select Sub J Type</option>
							<?php
							// foreach($users as $row)
							// {
							// 	echo '<option value='.$row['Category_ID'].'>'.$row['Category_Name'].'</option>';
							// }
							?>
						</select>
						
					</div>
					
					<div class="form-column">
						<label class="radio-label">J Item Name</label>
						<input type="text" class="form-input" name="full_name" placeholder="Full Name" value="<?php echo set_value('full_name'); ?>" minlength='4' style="width:220%" required/>
					</div>
					<div class="clear"></div>
				</div>

			
				<div class="form-row">
					
			<!--	</div>
				
				 <div class="form-row"> -->
					<div class="form-column">
						<label class="radio-label">Wastage Type</label>
						<select name="wastage_type" class="form-select valid" required=""  aria-invalid="false" onchange="get_wastage_type($(this).val())">
							<option value="percent">Percent </option>
							<option value="gram">Gram </option>
						</select>
					</div>
					<div class="form-column " >
						<label class="radio-label"><span  id="wastage_percent">Wastage Percent (%)</span><span  id="wastage_gram"  class=" d-none">Wastage Gram</span></label>
						<input type="number" class="form-input" name="wastage_percent" placeholder="Wastage" value="<?php echo set_value('wastage_percent'); ?>"  required/>
					</div>
					<div class="form-column">
						<label class="radio-label">Making Charges / gram (Rs)</label>
						<input type="number" class="form-input" name="making_charges_per_gram" placeholder="Making Charges/Gram" value="<?php echo set_value('making_charges_per_gram'); ?>" step='0.001' onkeyup="parseFloat($(this).val()).toFixed(3);"  required/>
					</div>
					<!-- <div class="form-column d-none" id="wastage_gram" >
						<label class="radio-label">Wastage Gram</label>
						<input type="number" class="form-input" name="wastage_percent" placeholder="Wastage Gram" value="<?php //echo set_value('wastage_percent'); ?>"  required/>
					</div> -->
					<div class="clear"></div>
				</div>

			</div>

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

	$("#create-form-id").validate({
		rules: {
			/*repassword: {
				equalTo:'#user-password'
			}*/
		}
	});
	function get_wastage_type(type){
		if(type=="percent"){
			$("#wastage_percent").removeClass("d-none");
			$("#wastage_gram").addClass("d-none");
			
		}
		else if(type=="gram"){
			$("#wastage_gram").removeClass("d-none");
			$("#wastage_percent").addClass("d-none");
		}
	}
	</script>
	</div>
</div>


</div>
</div>
</div>
</div>
</div>
</section>
