<div id='enquiry-form' class="inner-padding">
	<h1 class='h1-title'>Request Call Back</h1>
<div class="form-div">
	
	<?php $cat_slug=isset($category['cat_slug']) ? "/".$category['cat_slug'] : ""; ?>
	
	<form action="<?php echo site_url("home/service".$cat_slug); ?>" method='POST' enctype="multipart/form-data" name="enquiry_form" id="enquiry-form-id">
		
		<div class="form-block">
			<div class="form-row">
				<div class="form-column">
					
					<input type="text" class="form-input" name="name" placeholder="Your Name" minlength="4" maxlength="30" value="<?php echo set_value('name'); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>
				
			<div class="form-row">
				<div class="form-column">
					
					<input type="text" class="form-input" name="mobile" placeholder="Mobile Number" minlength="10" maxlength="10" value="<?php echo set_value('mobile'); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>
			<div class="form-row">
				<div class="form-column">
					
					<input type="email" class="form-input" name="email" placeholder="Email address" value="<?php echo set_value('email'); ?>" />
				</div>
				<div class="clear"></div>
			</div>
			<div class="form-row">
				<div class="form-column">
				
					<select name="cat_id" class="form-select" required>
						<option>Select Service</option>
						<?php foreach($categories as $cat): ?>
						<option value="<?php echo $cat['cat_id']; ?>" <?php if(isset($category['cat_id']) and (@$category['cat_id']==$cat['cat_id'])): ?>selected='selected'<?php endif; ?>><?php echo $cat['cat_name']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="clear"></div>
			</div>
			<div class="form-row">
				<div class="form-column">
				
					<select name="city_id" class="form-select" required>
						<option>Select Your City</option>
						<?php foreach($cities as $city): ?>
						<option value="<?php echo $city['city_id']; ?>"><?php echo $city['city_name']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="clear"></div>
			</div>
			<div class="form-row">
					<input type="submit" class="form-button" name="submit" value="GET CALL BACK" />
					
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

