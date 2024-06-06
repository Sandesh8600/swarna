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
            <h1>Edit Deposit Ticket for Order-ID #<?php echo $this->session->userdata('viewtask_id');?></h1>
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
	<form action="<?php echo site_url("golddeposit/edit/".$user['Ticket_Id']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="User_id" value="<?php echo $user['Ticket_Id']; ?>" />
		<div class="form-block">

		
	        
	        <div class="form-row">
				<div class="form-column">
					<label class="radio-label">Ticket Title</label>
					<input type="text" class="form-input" name="title" placeholder="Task Titles" value="<?php echo set_value('title',$user['Ticket_title']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>

	       <div class="form-row" style="width:100%;display:flex;">
				<div class="form-column">
					<label class="radio-label">Workshop Name</label>
			        <select name="workshop" class="form-select valid" required="" aria-invalid="false">
						
						<?php
						foreach($query->result() as $row)
                          {
							  if($row->Workshop_Code == $user['Workshop_Code'])
							  {
								echo '<option value='.$row->Workshop_Code.'>'.$row->Workshop_Name.'</option>';
							  }
							
						  }
						  foreach($query->result() as $row)
                          {
							  if($row->Workshop_Code != $user['Workshop_Code'])
							  {
								echo '<option value='.$row->Workshop_Code.'>'.$row->Workshop_Name.'</option>';
							  }
							
						  }
						?>
			        </select>
					
				</div>

				<div class="form-column">
					<label class="radio-label">Tasktype</label>
			        <select name="task" class="form-select valid" required="" aria-invalid="false">
						
						<?php
						foreach($queryp->result() as $rowp)
                          {
							if($rowp->Task_Id == $user['Task_Id'])
							{
							    echo '<option value='.$rowp->Task_Id.'>'.$rowp->Task_Title.'</option>';
							}
						  }
						  foreach($queryp->result() as $rowp)
                          {
							if($rowp->Task_Id != $user['Task_Id'])
							{
							    echo '<option value='.$rowp->Task_Id.'>'.$rowp->Task_Title.'</option>';
							}
						  }
						?>
			        </select>
					
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Deposite Gold In Grams</label>
					<input type="text" class="form-input" name="deposit" placeholder="Deposite Gold In Grams" minlength='1' maxlength='50' value="<?php echo set_value('deposit',$user['Deposite_GoldInGrams']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Task Description</label>
					<textarea type="text" class="form-input" name="description" placeholder="Task Description" minlength='1' maxlength='400' required><?php echo set_value('description',$user['Ticket_Description']); ?></textarea>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Ticket Priority</label>
					<input type="text" class="form-input" name="priority" placeholder="Ticket Priority" minlength='1' maxlength='50' value="<?php echo set_value('priority',$user['Ticket_Priority']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Status</label>
					<!-- <input type="text" class="form-input" name="status" placeholder="Task Status" value="<?php echo set_value('status',$user['Ticket_Status']); ?>" required/> -->
					<label class="form-radio">
					<input type="radio" name="status" value="1" <?php echo set_radio('status',1,$user['Ticket_Status']==1? true:false); ?> required/> In Progress
					</label>
					<label class="form-radio">
					<input type="radio" name="status" value="0" <?php echo set_radio('status',0,$user['Ticket_Status']==0? true:false); ?> required/> Closed
					</label>
				</div>
				<div class="clear"></div>
			</div>

			
			
		</div>
			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Save.." />
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