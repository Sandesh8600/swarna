<?php
$this->db->select("*");
$this->db->from("workshops");
$query = $this->db->get();

?>

<?php
$this->db->select("*");
$this->db->from("tasktype");
$queryp = $this->db->get();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Task for Order-ID #<?php echo $this->session->userdata('viewtask_id');?></h1>
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
	<form action="<?php echo site_url("viewtask/edit/".$user['Task_Id']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="User_id" value="<?php echo $user['Task_Id']; ?>" />
		<div class="form-block">

		
	        
	        <div class="form-row">
				<div class="form-column">
					<label class="radio-label">Task Title</label>
					<input type="text" class="form-input" name="title" minlength='1' maxlength='50' placeholder="Task Titles" value="<?php echo set_value('title',$user['Task_Title']); ?>" required/>
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
							if($rowp->TaskType_Id == $user['TaskType_Id'])
							{
							    echo '<option value='.$rowp->TaskType_Id.'>'.$rowp->TaskType_Name.'</option>';
							}
						  }
						  foreach($queryp->result() as $rowp)
                          {
							if($rowp->TaskType_Id != $user['TaskType_Id'])
							{
							    echo '<option value='.$rowp->TaskType_Id.'>'.$rowp->TaskType_Name.'</option>';
							}
						  }
						?>
			        </select>
					
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Task Description</label>
					<textarea type="text" class="form-input" name="description" minlength='1' maxlength='300' placeholder="Task Description" required><?php echo set_value('description',$user['Task_Description']); ?></textarea>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Task Priority</label>
					<input type="text" class="form-input" name="priority" minlength='1' maxlength='50' placeholder="Task Priority" value="<?php echo set_value('priority',$user['Task_Priority']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Task Status</label>
					<!-- <input type="text" class="form-input" name="status" placeholder="Task Status" value="<?php echo set_value('status',$user['Task_Status']); ?>" required/> -->
					<label class="form-radio">
					<input type="radio" name="status" value="1" <?php echo set_radio('status',1,$user['Task_Status']==1? true:false); ?> required/> In Progress
					</label>
					<label class="form-radio">
					<input type="radio" name="status" value="0" <?php echo set_radio('status',0,$user['Task_Status']==0? true:false); ?> required/> Closed
					</label>
				</div>
				<div class="clear"></div>
			</div>

		
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Start Date</label>
					<input type="text" class="form-input datepicker" minlength='1' maxlength='50' name="start_date" placeholder="Start Date" value="<?php echo set_value('start_date',$user['Start_Date']); ?>" required/>
				</div>

				<div class="form-column">
					<label class="radio-label">End Date</label>
					<input type="text" class="form-input datepicker" minlength='1' maxlength='50' name="end_date" placeholder="End Date" value="<?php echo set_value('end_date',$user['End_Date']); ?>" required/>
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