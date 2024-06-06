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
<?php
    $this->db->select('*');
	$this->db->from('goldbalance');
	$balance = $this->db->get()->row();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gold Transactions for workshop ID #<?php echo $this->session->userdata('workshop_id');?>  <span style="color:red">&nbsp;&nbsp;&nbsp;Remaining Gold : <?php echo $balance->Masterbalance; ?>g</span></h1>
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
<!-- <h1 class='h1-title'>
</h1> -->
<div class="form-div">
	
	<div class="validation-errors"><?php echo validation_errors(); ?></div>
	<form action="<?php echo site_url("goldtransaction/create"); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id">
		
	  <div class="form-block">
	  <input type="hidden" name="entity_type" value="Workshop">
	    
	        <div class="form-row">
				<div class="form-column">
					<label class="radio-label">Gold(Grams)</label>
					<input type="number" class="form-input" name="gold" placeholder="Gold" value="<?php echo set_value('gold'); ?>" minlength='1' maxlength='50' required/>
					<p style="color:red;"><?php echo $this->session->flashdata('golds');?></p>
				</div>
				<!-- <div class="clear"></div> -->
			
				<div class="form-column">
					<label class="radio-label">Transaction Type</label>
			        <select name="type" class="form-select valid" required="" aria-invalid="false">
						<option>Select Transaction</option>
						<option>Debit</option>
						<option>Credit</option>
						<option>Cash</option>

			        </select>
					
				</div>

				<div class="clear"></div>
			</div>

			<!-- <div class="form-row">
				<div class="form-column">
					<label class="radio-label">From Entity Type</label>
					<input type="text" class="form-input" name="from_entity" placeholder="From Entity Type" value="<?php echo set_value('from_entity'); ?>" minlength='1' maxlength='50' required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">From Entity ID</label>
					<input type="text" class="form-input" name="from_entity_id" placeholder="From Entity ID" minlength='1' maxlength='400' value="<?php echo set_value('from_entity_id'); ?>" required/>
				</div>
				<div class="clear"></div>
			</div> -->

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Comments</label>
					<textarea class="form-input" name="comments" placeholder="Comments" value="<?php echo set_value('comments'); ?>"  rows="4" minlength='1' maxlength='150' required></textarea>
				</div>
				<div class="clear"></div>
			</div>
			
			
		</div>

			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Submit" />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("goldtransaction/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
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
</div>