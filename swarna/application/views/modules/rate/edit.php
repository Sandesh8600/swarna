<!-- Content Wrapper. Contains page content -->
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Rate</h1>
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
	<form action="<?php echo site_url("rate/browse?edit_form=yes&rate_id=".$user['TodaysRatePerGram_ID']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="User_id" value="<?php echo $user['TodaysRatePerGram_ID']; ?>" />
		<div class="form-block">
		 
		 
		 
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Date</label>
					<?php echo date('d-m-Y',strtotime($user['Timestamp'])); ?>
				</div>
				<div class="form-column">
					<label class="radio-label">Metal Type</label>
					<select class="form-select" name="metal_type" required>
						<option value="">Not Selected</option>
						<option value="gold" <?php if($user['metal_type']=='gold'): echo "selected='selected'"; endif; ?>>Gold</option>
						<option value="silver" <?php if($user['metal_type']=='silver'): echo "selected='selected'"; endif; ?>>Silver</option>
					</select>
				</div>
				<div class="form-column">
					<label class="radio-label">Rate Per 22k Gold Gram(₹)</label>
					<input type="number" class="form-input" name="full_name" placeholder="Todays Rate Per Gram" minlength='1' maxlength='5' value="<?php echo set_value('full_name',$user['TodaysRatePerGram']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>

			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Save.." />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("rate/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
		</div>
	</form>
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
