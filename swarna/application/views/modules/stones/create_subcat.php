<?php
$this->db->select("*");
$this->db->from("stone_type");
$query = $this->db->get();

?>
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Stone Sub Type</h1>
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
	<form action="<?php echo site_url("stones/browse?subcat_create_form=yes"); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id">
		
	  <div class="form-block">
	       <div class="form-row" style="width:100%;display:flex;">
				<div class="form-column">
					<label class="radio-label">Select Stone Type</label>
			        <select name="stone_type_id" class="form-select valid" required="" aria-invalid="false" id="stone_type_id">
						<option>Select Stone Type</option>
						<?php
						foreach($query->result() as $row)
                          {
							echo '<option value='.$row->id.'>'.$row->name.'</option>';
						  }
						?>
			        </select>
					
				</div>
				
				<div class="clear"></div>
			</div>

		
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Stone Sub Type Name</label>
					<input type="text" class="form-input" name="name" placeholder="Name" value="<?php echo set_value('name'); ?>" minlength='4' maxlength='50' required/>
				</div>
				<?php 
					//if(stone_type_id)
				?>
				<!-- <div class="form-column">
					<label class="radio-label">Grams</label>
					<input type="number" class="form-input" name="grams" id="stone-grams" onkeyup="stones_converter('grams', $(this).val());" placeholder="Grams" value="<?php //echo set_value('grams'); ?>" required/>
				</div> -->
				<!-- <div class="form-column d-lg-none" id="carot_div">
					<label class="radio-label">Carat</label>
					<input type="number" class="form-input" name="carat" id="stone-carat" onkeyup="stones_converter('carat', $(this).val());" placeholder="Carat" value="<?php echo set_value('carat'); ?>" required/>
				</div>
				<div class="form-column" id="cents_div">
					<label class="radio-label"  >Cents</label>
					<input type="number" class="form-input" name="cents" id="stone-cents" onkeyup="stones_converter('carat', $(this).val());" placeholder="Cents" value="<?php echo set_value('cents'); ?>" required/>
				</div> 
				<div class="form-column">
					<label class="radio-label">Rate per Unit (Rs)</label>
					<input type="number" class="form-input" name="rate" placeholder="Rate" value="<?php echo set_value('rate'); ?>" required/>
				</div>
				<div class="form-column">
					<label class="radio-label">Unit</label>
					<input type="number" class="form-input" name="numbers" placeholder="Numbers" value="<?php echo set_value('numbers'); ?>" required/> 
					<select name="unit" class="form-select valid" required="required" aria-invalid="false" id="unit_type_id">
						<option value="">Select Unit</option>
						<?php
						$units = array("Cent","Number","Carat");
						foreach($units as $row)
                          {
							echo '<option value='.$row.'>'.$row.'</option>';
						  }
						?>
			        </select>
				</div>-->
				<div class="clear"></div>
			</div>

			
			
		</div>

			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Submit" />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("stones/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
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
	
	
	//convert cents to carat to grams
	function stones_converter(convert_from, val){
		
		carat=0;
		cents=0;
		grams=0;
		
		if(convert_from=="carat"){
			
				carat=parseFloat(val);
				
				cents=carat*100;
				
				grams=carat * 0.2;
			
			}
			
		if(convert_from=="grams"){
			
				carat=parseFloat(val)*5;
				
				grams=parseFloat(val);
				
				cents=carat * 100;
			
			}
			
		if(convert_from=="cents"){
			
				carat=parseFloat(val)*0.01;
				
				cents=parseFloat(val);
				
				grams=carat * 0.2;
			}
		
		$('#stone-cents').val(cents);
		
		$('#stone-grams').val(grams);
		
		$('#stone-carat').val(carat);
		
	}
	
	//.toPrecision(2)
	
	</script>
	</div>
</div>


</div>
</div>
</div>
</div>
</div>
</section>
