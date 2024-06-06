<?php
$metal_type = $this->input->get("metal_type");
$this->db->select("*");
$this->db->from("metalorpurity");
$query=$this->db->get();
?>
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ADD Today's Rate Per Gram (22 karat)</h1>
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
	<form action="<?php echo site_url("rate/browse?create_form=yes"); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id">
		
		<div class="form-block">
		   
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Date</label>
					<?php echo date('d-m-Y'); ?>
				</div>
				<div class="form-column">
					<label class="radio-label">Metal Type</label>
					<select class="form-select" name="metal_type" required>
						<option value="">Not Selected</option>
						<option value="gold" <?php echo ($metal_type=="gold") ? " selected": "" ?>>Gold</option>
						<option value="silver" <?php echo ($metal_type=="silver") ? " selected": "" ?>>Silver</option>
					</select>
				</div>
				<div class="form-column">
					<label class="radio-label">Rate Per Gram(₹)</label>
					<input type="number" class="form-input" name="full_name" placeholder="TodaysRatePerGram" value="<?php echo set_value('full_name'); ?>" minlength='1' maxlength='5' required/>
				</div>
				
				
				
				<div class="clear"></div>
			</div>

			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Submit" />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("rate/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
		</div>
	</form>
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
