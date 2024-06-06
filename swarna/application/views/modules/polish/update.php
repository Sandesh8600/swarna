<?php
$this->db->select("*");
$this->db->from("orderstatustrack");
$orderstatus = $this->db->get();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Status for Order-ID #<?php echo $this->session->userdata('viewtask_id');?></h1>
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
	<form action="<?php echo site_url("order/status_create"); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id">
		
	  <div class="form-block">
	       
		
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Description</label>
					<textarea class="form-input" name="description" minlength='1' maxlength='400' placeholder="description" required><?php echo set_value('description'); ?></textarea>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row" style="width:100%;display:flex;">
				<div class="form-column">
					<label class="radio-label">Order Status</label>
					<!-- <textarea class="form-input" name="status" placeholder="Order Status"  required><?php echo set_value('status'); ?></textarea> -->
					
			        <select name="status" class="form-select valid" required="" aria-invalid="false">
						<option>Select Status</option>
						<?php
						foreach($orderstatus->result() as $rowo)
                          {
							echo '<option>'.$rowo->orderstatustrack_name.'</option>';
						  }
						?>
			        </select>
				<div class="clear"></div>
			</div>
			
		</div>

			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Submit" />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("order/vieworder"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
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
	</div></div></div></div>
</section>
</div>