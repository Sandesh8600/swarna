<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Admin Info</h1>
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
	<form action="<?php echo site_url("admin/edit/".$admin['admin_id']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="admin_id" value="<?php echo $admin['admin_id']; ?>" />
		<div class="form-block">
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Admin Name</label>
					<input type="text" class="form-input" name="admin_name" placeholder="Admin Name" value="<?php echo set_value('admin_name',$admin['admin_name']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Admin Email</label>
					<input type="email" class="form-input" name="email" placeholder="Email" value="<?php echo set_value('email',$admin['email']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Password</label>
					<input type="password" class="form-input" name="password" placeholder="Password" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Record Status</label>
					<label class="form-radio">
					<input type="radio" name="status" value="1" <?php echo set_radio('status',1,$admin['status']==1? true:false); ?> required/> Active
					</label>
					<label class="form-radio">
					<input type="radio" name="status" value="0" <?php echo set_radio('status',0,$admin['status']==0? true:false); ?> required/> Inactive
					</label>
				</div>
				<div class="clear"></div>
			</div>
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Save.." />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("admin/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
		</div>
	</form>
	<script>
	$("#edit-form-id").validate({
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
</div>