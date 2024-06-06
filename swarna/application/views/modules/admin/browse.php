<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	
	<!--create admin form-->

<?php if($this->input->get("create_form")=="yes"): ?>
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Admin</h1>
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
		
<div id='create-form' >
<!-- <h1 class='h1-title'></h1> -->
<div class="form-div">
	
	<div class="validation-errors"><?php echo validation_errors(); ?></div>
	<form action="<?php echo site_url("admin/browse?create_form=yes"); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id">
		
		<div class="form-block">
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Admin Name</label>
					<input type="text" class="form-input" name="admin_name" placeholder="Admin Name" value="<?php echo set_value('admin_name'); ?>" required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Admin Email</label>
					<input type="email" class="form-input" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Password</label>
					<input type="password" class="form-input" name="password" placeholder="Password" required/>
				</div>
			
				<div class="form-column">
					<label class="radio-label">Record Status</label>
					<label class="form-radio">
					<input type="radio" name="status" value="1" <?php echo set_radio('status',1); ?> required/> Active
					</label>
					<label class="form-radio">
					<input type="radio" name="status" value="0" <?php echo set_radio('status',0); ?> required/> Inactive
					</label>
				</div>
				<div class="clear"></div>
			</div>
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Submit" />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("admin/browse"); ?>');"><i class="fas fa-arrow-left"></i> Close</button>
					
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
</div>
</div></div></div></div>
</section>
<?php endif; ?>

	<!--create admin form ends-->
	
	
	
	<?php if($this->input->get("edit_form")=="yes"): ?>
	
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
	<form action="<?php echo site_url("admin/browse?edit_form=yes&admin_id=".$admin['admin_id']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="admin_id" value="<?php echo $admin['admin_id']; ?>" /> 
		<div class="form-block">
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Admin Name</label>
					<input type="text" class="form-input" name="admin_name" placeholder="Admin Name" value="<?php echo set_value('admin_name',$admin['admin_name']); ?>" required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Admin Email</label>
					<input type="email" class="form-input" name="email" placeholder="Email" value="<?php echo set_value('email',$admin['email']); ?>" required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Password</label>
					<input type="password" class="form-input" name="password" placeholder="Password" />
				</div>
				
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
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("admin/browse"); ?>');">Close</button>
					
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
	
	<?php endif; ?>
	
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Access Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url("admin/browse?create_form=yes"); ?>"><button class="btn btn-primary">Create Admin</button></a></li>
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


	<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
				<div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
				        <?php if($prev_page): ?>
							<li class="page-item"><a href="<?php echo site_url("admin/browse?page=".$prev_page_num); ?>" class="page-link">&laquo;</a></li>
						<?php endif; ?>
						<?php if($next_page): ?>
							<li class="page-item"><a href="<?php echo site_url("admin/browse?page=".$next_page_num); ?>" class="page-link">&raquo;</a></li>
						<?php endif; ?>
                    
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th>Admin Name</th>
					  <th>Email</th>
					  <th>Status</th>
                      <th style="width: 130px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php $k=1;
						  foreach($admins as $ad): ?>
						  <tr>
								<td><?php echo $k; ?></td>
								<td><?php echo $ad['admin_name']; ?></td>
								<td><?php echo $ad['email']; ?></td>
								<td>
									<?php if($ad['status']==1): ?>
									<i class="fa fa-play-circle" style=" font-size:1.3em; position:relative; top:2px; color:#9c3;" title='Active'></i> Active
									<?php else: ?>
									<i class="fa fa-times-circle" style=" font-size:1.3em; position:relative; top:2px; color:#ffa5a5;" title='Inactive'></i> In Active
									<?php endif; ?>
									
								</td>
								<td class="blocks">
									<a href="<?php echo site_url("admin/browse?edit_form=yes&admin_id=".$ad['admin_id']); ?>" class=""><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i></a>
									<a onclick="save(<?php echo $ad['admin_id'];?>)" style="color:red;cursor:pointer;margin-left:10px;"><i class="fas fa-trash trashclass" ></i></a>
								
								</td>
						  </tr>
						  <?php $k++;
						endforeach; ?>
                  </tbody>
                </table>
              </div>
              
            </div>
            <!-- /.card -->
         </div>
      </div>
    </section>
</div>




<!-- unknown rows -->

<div class="module-block" style="display:none;">
<div class="module-title-section">
	
	<h1 class='module-title'>Manage Admins</h1>
	<div class="module-action-items">
		<a href="<?php echo site_url("admin/create?create_form=yes"); ?>" class="form-button small-button bg-green">Create Admin</a>
	</div>
	<div class="clear"></div>
</div>

<div class="module-content-section" data-aos="fade-up">
	<div class="table-container">
						<table>
						  <tr>
								<th>Admin ID</th>
								<th>Admin Name</th>
								<th>Email</th>
								<th>Status</th>
								<th class="blocks-right">Action</th>
						  </tr>
						  
						  <?php $k=1;
						  foreach($admins as $ad): ?>
						  <tr>
								<td><?php echo $k; ?></td>
								<td><?php echo $ad['admin_name']; ?></td>
								<td><?php echo $ad['email']; ?></td>
								<td>
									<?php if($ad['status']==1): ?>
									<i class="fa fa-play-circle" style=" font-size:1.3em; position:relative; top:2px; color:#9c3;" title='Active'></i>
									<?php else: ?>
									<i class="fa fa-times-circle" style=" font-size:1.3em; position:relative; top:2px; color:#ffa5a5;" title='Inactive'></i>
									<?php endif; ?>
									
								</td>
								<td class="blocks-right">
									<a href="<?php echo site_url("admin/browse?edit_form=yes&admin_id=".$ad['admin_id']); ?>" class=""><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i></a>
									<a onclick="save(<?php echo $ad['admin_id'];?>)" style="color:red;cursor:pointer;margin-left:10px;"><i class="fas fa-trash trashclass" ></i></a>
								
								</td>
						  </tr>
						  <?php $k++;
						endforeach; ?>
						</table>
						
						<div class="data-pagination">
							<?php if($prev_page): ?>
							<a href="<?php echo site_url("admin/browse?page=".$prev_page_num); ?>" class="form-button small-button pagination-buttons">Previous</a>
							<?php endif; ?>
							<?php if($next_page): ?>
							<a href="<?php echo site_url("admin/browse?page=".$next_page_num); ?>" class="form-button small-button pagination-buttons">Next</a>
							<?php endif; ?>
						</div>
</div>

</div>

</div>



<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>

const ui = {
  confirm: async (message) => createConfirm(message)
};

const createConfirm = (message) => {
  return new Promise((complete, failed) => {
    $("#confirmMessage").text(message);

    $("#confirmYes").off("click");
    $("#confirmNo").off("click");

    $("#confirmYes").on("click", () => {
      $(".confirm").hide();
      complete(true);
    });
    $("#confirmNo").on("click", () => {
      $(".confirm").hide();
      complete(false);
    });

    $(".confirm").show();
  });
};

const save = async (partner_id) => {
	// alert(partner_id);
  const confirm = await ui.confirm("Are you sure you want to Delete this record?");

  if (confirm) {
	$.post("<?php echo site_url("admin/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("admin/browse"); ?>";
       });
  } else {
    // alert("no clicked");
  }
};

</script>

<script>
function myDelete(partner_id)
  {
    //    alert(partner_id);
       $.post("<?php echo site_url("admin/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("admin/browse"); ?>";
       });
  }
</script>
