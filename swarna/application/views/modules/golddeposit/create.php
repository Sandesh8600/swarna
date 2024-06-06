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
            <h1>Gold Deposit Ticket for Order-ID #<?php echo $this->session->userdata('viewtask_id');?></h1>
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
	<form action="<?php echo site_url("golddeposit/create"); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id">
		
	  <div class="form-block">
	        
	        <div class="form-row">
				<div class="form-column">
					<label class="radio-label">Ticket Title</label>
					<input type="text" class="form-input" name="title" placeholder="Ticket Title" value="<?php echo set_value('title'); ?>" minlength='4' maxlength='50' required/>
				</div>
				<div class="clear"></div>
			</div>

	       <div class="form-row" style="width:100%;display:flex;">
				<div class="form-column">
					<label class="radio-label">Workshop Name</label>
			        <select name="workshop" class="form-select valid" required="" aria-invalid="false">
						<option>Select workshop</option>
						<?php
						foreach($query->result() as $row)
                          {
							echo '<option value='.$row->Workshop_Code.'>'.$row->Workshop_Name.'</option>';
						  }
						?>
			        </select>
					
				</div>

				<div class="form-column">
					<label class="radio-label">Task To Workshop</label>
			        <select name="task" class="form-select valid" required="" aria-invalid="false">
						<option>Select Tasktype</option>
						<?php
						foreach($queryp->result() as $rowp)
                          {
							echo '<option value='.$rowp->Task_Id.'>'.$rowp->Task_Title.'</option>';
						  }
						?>
			        </select>
					
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Deposite Gold In Grams</label>
					<input type="number" class="form-input" name="deposit" placeholder="0" value="<?php echo set_value('deposit'); ?>" minlength='1' maxlength='50' required/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Ticket Description</label>
					<textarea type="text" class="form-input" name="description" placeholder="Ticket Description" minlength='1' maxlength='400' value="<?php echo set_value('description'); ?>" required></textarea>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Ticket Priority</label>
					<input type="text" class="form-input" name="priority" placeholder="Ticket Priority" value="<?php echo set_value('priority'); ?>"  minlength='1' maxlength='50' required/>
				</div>
				<div class="clear"></div>
			</div>

			
			

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Task Status</label>
					<!-- <input type="text" class="form-input" name="status" placeholder="Task Status" value="<?php echo set_value('status'); ?>" required/> -->
					<label class="form-radio">
					<input type="radio" name="status" value="1" <?php echo set_radio('status',1); ?> required/> In Progress
					</label>
					<label class="form-radio">
					<input type="radio" name="status" value="0" <?php echo set_radio('status',0); ?> required/> Closed
					</label>
				</div>
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