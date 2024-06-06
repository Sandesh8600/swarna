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
            <h1>Edit Stone Sub Type</h1>
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
	<form action="<?php echo site_url("stones/browse?item_edit_form=yes&stone_item_id=".$stone_item['id']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="stone_item_id" value="<?php echo $stone_item['id']; ?>" />
		<div class="form-block">

		<div class="form-row" style="width:100%;display:flex;">
				<div class="form-column">
					<label class="radio-label">Stone Type</label>
			        <select name="stone_type_id" class="form-select valid" required="" aria-invalid="false" id="stone_type_id">
						<?php 
						foreach($query->result() as $row)
                          {
							  if($row->id == $stone_item['stone_type_id'])
							  {
								echo '<option value='.$row->id.'>'.$row->name.'</option>';
							  }
						  }
						  foreach($query->result() as $row)
                          {
							  if($row->id != $stone_item['stone_type_id'])
							  {
								echo '<option value='.$row->id.'>'.$row->name.'</option>';
							  }
						  }
						?>
			        </select>
					
				</div>
				<div class="form-column">
					<label class="radio-label">Stone SubType</label>
			        <select name="stone_type_id" class="form-select valid" required="" aria-invalid="false" id="stone_type_id">
						<?php 
						foreach($stone_subtype as $row)
                          { 
							  if($row["id"] == $stone_item['stone_subtype_id'])
							  {
								echo '<option value='.$row["id"].'>'.$row['name'].'</option>';
							  }
						  }
						  foreach($stone_subtype as $row)
                          {
							  if($row["id"] != $stone_item['stone_subtype_id'])
							  {
								echo '<option value='.$row["id"].'>'.$row['name'].'</option>';
							  }
						  }
						?>
			        </select>
					
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Stone Item Name</label>
					<input type="text" class="form-input" name="name" placeholder="Name" minlength='4' maxlength='50' value="<?php echo set_value('name',$stone_item['name']); ?>" required/>
				</div>
				
				
				<!-- <div class="form-column">
					<label class="radio-label">Grams</label>
					<input type="number" class="form-input" name="grams" id="stone-grams" onkeyup="stones_converter('grams', $(this).val());" placeholder="Grams" value="<?php //echo set_value('grams',number_format((float)$stone_item['grams'], 3, '.', '')); 
					$stone_item['grams']
					?>" required/>
				</div> 
				<div class="form-column <?php echo ($stone_item['stone_type_id']==1) ? "d-lg-none" : ""  ?>" id="carot_div">
					<label class="radio-label">Carat</label>
					<input type="number" class="form-input" name="carat" id="stone-carat" onkeyup="stones_converter('carat', $(this).val());" placeholder="Carat" value="<?php echo set_value('carat',$stone_item['carat']); ?>" required/>
				</div>
				<div class="form-column <?php echo ($stone_item['stone_type_id']==1) ? "" : "d-lg-none"  ?>" id="cents_div">
					<label class="radio-label">Cents</label>
					<input type="number" class="form-input" name="cents" id="stone-cents" onkeyup="stones_converter('cents', $(this).val());" placeholder="Cents" value="<?php echo set_value('cents',$stone_item['cents']); ?>" required/>
				</div>-->
				<div class="form-column">
					<label class="radio-label">Rate (Rs)</label>
					<input type="number" class="form-input" name="rate" placeholder="Rate" value="<?php echo set_value('rate',$stone_item['rate']); ?>" required/>
				</div>
				
				<!-- <div class="form-column">
					<label class="radio-label">Numbers</label>
					<input type="number" class="form-input" name="numbers" placeholder="Numbers" value="<?php echo set_value('numbers',$stone_item['numbers']); ?>" required/>
				</div> -->
				<div class="form-column">
					<label class="radio-label">Select Unit</label>
					<select name="unit" class="form-select valid" required="required" aria-invalid="false" id="unit_type_id">
						<option value="<?php echo $stone_item['unit'] ?>">Select Unit</option>
						<?php
						$units = array("Cent","Number","Carat");
						foreach($units as $row)
                          {
							echo "<option value='$row' "; echo ($row==$stone_item['unit']) ? 'selected' : '';
							echo ">$row</option>";
						  }
						?>
			        </select>
						</div>
				<div class="clear"></div>
			</div>

			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Save.." />
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
   // full_name: { lettersonly: true }
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
	
	</script>
	</div>
</div>


	</div>
</div>
</div></div></div>
</section>
