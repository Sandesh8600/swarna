<?php
$this->db->select("*");
$this->db->from("workshops");
$query = $this->db->get();

?>

<?php
$this->db->select("*");
$this->db->from("taskstoworkshop");
$queryp = $this->db->get();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Gold Transactions for Jewellery</h1>
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
	<form action="<?php echo site_url("jewellary/edit/".$user['Transaction_ID']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="User_id" value="<?php echo $user['Transaction_ID']; ?>" />
		<div class="form-block">

		
	        
		<input type="hidden" name="entity_type" value="<?php echo $user['Entity_Type'];?>">
	        
	        <div class="form-row">
				<div class="form-column">
					<label class="radio-label">Gold(Grams)</label>
					<input type="number" class="form-input" name="gold" placeholder="Gold" value="<?php echo set_value('gold',$user['Gold_in_Grams']); ?>" minlength='1' maxlength='50' required/>
				</div>
				<!-- <div class="clear"></div> -->
			
				<div class="form-column">
					<label class="radio-label">Transaction Type</label>
			        <select name="type" class="form-select valid" required="" aria-invalid="false">
						<?php if($user['Transaction_Type'] == 'Debit'){?>
						<option>Debit</option>
						<option>Credit</option>
						<option>Cash</option>
						<?php }?>
						<?php if($user['Transaction_Type'] == 'Credit'){?>
						<option>Credit</option>
						<option>Debit</option>
						<option>Cash</option>
						<?php }?>
						<?php if($user['Transaction_Type'] == 'Cash'){?>
						<option>Cash</option>
						<option>Credit</option>
						<option>Debit</option>
						<?php }?>

			        </select>
					
				</div>

				<div class="clear"></div>
			</div>

			<!-- <div class="form-row">
				<div class="form-column">
					<label class="radio-label">From Entity Type</label>
					<input type="text" class="form-input" name="from_entity" placeholder="From Entity Type" value="<?php echo set_value('from_entity',$user['From_Entity_Type']); ?>" minlength='1' maxlength='50' required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">From Entity ID</label>
					<input type="text" class="form-input" name="from_entity_id" placeholder="From Entity ID" minlength='1' maxlength='400' value="<?php echo set_value('from_entity_id',$user['From_Entity_Id']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div> -->

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Comments</label>
					<textarea class="form-input" name="comments" placeholder="Comments"  rows="4" minlength='1' maxlength='150' required><?php echo set_value('comments',$user['Comments']); ?></textarea>
				</div>
				<div class="clear"></div>
			</div>
			
		</div>
			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button bg-green" name="submit" value="Save.." />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("jewellary/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
		</div>
	</form>
	<script>
jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
}, "Letters only please"); 
$("form").validate({
  rules: {
    title: { lettersonly: true }
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
</div></div></div></div>
</section>
</div>