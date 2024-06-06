<div class="content-wrapper" style="background:transparent;box-shadow:none;">
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
				<div class="card-body" style="background:transparent;box-shadow:none;padding: 0!important;">
<div id="login-block" data-aos="fade-up">
	<div class="box-width">
		
<div id='login-form'>
<h1 class='h1-title'>Swarna Control</h1>
<div class="form-div">
	<div class="validation-errors">
		<?php echo validation_errors(); ?>
		
		<?php if($this->input->get_post("login_error")=='yes'): ?>
		<p>Username or Password is incorrect. Please try again.</p>
		<?php endif; ?>
		
	</div>
	
	<form action="<?php echo site_url("login/validate"); ?>" method='POST' enctype="multipart/form-data" name="enquiry_form" id="login-form-id">
		
		<div class="form-block">
			<div class="form-row">
				<div class="form-column">
					
					<input type="email" class="form-control" name="email" style="width: 235px;" placeholder="Email address" value="<?php echo set_value('email'); ?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="form-row">
				<div class="form-column">
					
					<input type="password" class="form-control" name="password" style="width: 235px;" placeholder="Password" />
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="form-row">
					<input type="submit" class="form-button" name="submit" style="width: 235px;" value="Login" />
					
				<div class="clear"></div>
			</div>
		</div>
	</form>
	<script>
	$("#enquiry-form-id").validate({
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
</div>
</div>
</section>
</div>
