<?php


parse_str($_SERVER['QUERY_STRING'],$query_array);

$query_array_pagination=$query_array;
$query_array_page_size=$query_array;

$sort_key=$this->input->get("sort_key");
$sort_type=$this->input->get("sort_type");


unset($query_array['sort_key']);
unset($query_array['sort_type']);

$query_string_sort=http_build_query($query_array);

unset($query_array_pagination['page']);

$query_string_pagination=http_build_query($query_array_pagination);

unset($query_array_page_size['page_size']);

$query_string_page_size=http_build_query($query_array_page_size);


if($sort_type=="asc"){

	$sort_type="desc";
	
} else {
	
	$sort_type="asc";
	
	}

?>

<style>
.filter-label{
	font-size:14px;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url("user/create"); ?>"><button class="btn btn-primary">ADD</button></a></li>
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


	<!-- search content 
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
				<div class="card-body">
			    <form class="browse-filter-form" action="<?php echo site_url("user/browse"); ?>">
			        <div class="filter-form-row">
				        
				        <div class="form-column">
					        <span class="filter-label">Name</span> <input type="text" name="firstname" class="form-control" placeholder="Customer Name" value="<?php echo $this->input->get("firstname"); ?>" />
				        </div>
				
				        <div class="form-column">
					        <span class="filter-label">Mobile</span> <input type="text" name="customer_mobile" class="form-control" placeholder="Customer Mobile" value="<?php echo $this->input->get("customer_mobile"); ?>" />
				        </div>
				        <div class="form-column">
							<span class="filter-label">&nbsp;</span>
							<div>
							<input type="submit" class="btn btn-primary" value="Apply" /> <a href="<?php echo site_url("user/browse"); ?>" class="btn btn-primary bg-grey">&nbsp;<i class="fas fa-redo"></i> &nbsp; Reset</a>
							</div>
				        </div>

				        <div class="clear"></div>
			        </div>
			
		        </form>
                </div>
            </div>
          </div>
		</div>
	  </div>
    </section>
	 end search -->


	<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">
				  <div class="left">Showing <?php echo $page_size>sizeof($users)?sizeof($users):$page_size; ?> of <?php echo $total; ?> | Page <?php echo $current_page; ?> of <?php echo $total_pages; ?> </div>
	              <div class="right">
					 &nbsp;Records Per Page:  &nbsp; <select name="page_size" class="filter-form-select" style="width:60px;" onchange="window.location.href='<?php echo site_url("user/browse?".$query_string_page_size); ?>&page_size='+$(this).val()">
						<option <?php if($this->input->get("page_size")==25): ?>selected="selected"<?php endif; ?> value="25">25</option>
						<option <?php if($this->input->get("page_size")==50): ?>selected="selected"<?php endif; ?> value="50">50</option>
						<option <?php if($this->input->get("page_size")==100): ?>selected="selected"<?php endif; ?> value="100">100</option>
						<option <?php if($this->input->get("page_size")==250): ?>selected="selected"<?php endif; ?> value="250">250</option>
					</select>
	               </div>
				</h3>
				<div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
				        <?php if($prev_page): ?>
							<li class="page-item"><a href="<?php echo site_url("user/browse?page=".$prev_page_num); ?>" class="page-link">&laquo;</a></li>
						<?php endif; ?>


						<?php
								
								$total=10;
								$start=1;
								
								if($total_pages<=10){
									
									$start=1;
									$total=$total_pages;
								}
								
								if($total_pages==11 and $current_page>=2){ $start=2; $total=($total+$start)>$total_pages?$total_pages:($total+$start); }
								if($total_pages==12 and $current_page>=3){ $start=3;  $total=($total+$start)>$total_pages?$total_pages:($total+$start);}
								if($total_pages==13 and $current_page>=4){ $start=4;  $total=($total+$start)>$total_pages?$total_pages:($total+$start);}
								if($total_pages==14 and $current_page>=5){ $start=5;  $total=($total+$start)>$total_pages?$total_pages:($total+$start);}
								if($total_pages>14 and $current_page>5 and $current_page<$total_pages){ $start=$current_page-5;  $total=($total+$start)>$total_pages?$total_pages:($total+$start);}
								
								if($total_pages>14 and $current_page==$total_pages){ $start=$current_page-10;  $total=($total+$start)>$total_pages?$total_pages:($total+$start); }
								
									
									for($i=$start; $i<=$total; $i++){
										
										if(($i)!=$current_page){
									?>
										<li class="page-item"><a href="<?php echo site_url("user/browse?page=".($i-1)."&".$query_string_pagination); ?>" class="page-link"><?php echo $i; ?></a></li>
									<?php
								 } else {
									 echo '<li class="page-item"><a class="page-link">&nbsp;'.$i.'&nbsp;</a></li>';
									 }
									
									}
									
						
							
							?>


						<?php if($next_page): ?>
							<li class="page-item"><a href="<?php echo site_url("user/browse?page=".$next_page_num); ?>" class="page-link">&raquo;</a></li>
						<?php endif; ?>
                    
                  </ul>
                </div>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
			  <div class="table-responsive">
                <table class="table table-bordered" id="example2">
                  <thead>
                    <tr>
					            <th>ID</th>
								<th>Name</th>
								<th><!-- Email &  -->Mobile</th>
								
								<th>Address</th>
								
								<!--
								<th>PAN Number</th>
								<th>Gold Balance</th>
								<th>Status</th>-->
								<th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php foreach($users as $user): ?>
						  <tr>
						  <td><?php echo $user['Customer_Code']; ?></td>
								<td><?php echo $user['Customer_Name']; ?></td>
								 <td><!--Email: <?php echo $user['Customer_Email']; ?><br/>
								<strong>Phone:</strong> --><?php echo $user['Customer_Mobile_Number1']; ?></td> 
								<td><?php echo $user['Customer_Billing_address']; ?>,<br/>
								<?php echo $user['Customer_City']; ?> - 
								<?php echo $user['Customer_Pincode']; ?></td>
							<!--	<td><?php echo $user['pan']; ?></td>
								<td><?php echo $user['opening_balance']; ?> Gms</td>

								<td>
									
									
									
									<?php if($user['Customer_Status']==1): ?>
									<i class="fa fa-play-circle" style=" font-size:1.3em; position:relative; top:2px; color:#9c3;" title='Active'></i> Active
									<?php else: ?>
									<i class="fa fa-times-circle" style=" font-size:1.3em; position:relative; top:2px; color:#ffa5a5;" title='Inactive'></i> InActive
									<?php endif; ?>
									
									
									
								</td>-->
								
								<td>
									<a href="<?php echo site_url("user/edit/".$user['Customer_Code']); ?>" class="" title="Edit Membership"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i></a>
									<a onclick="save(<?php echo $user['Customer_Code'];?>)" style="color:red;cursor:pointer;margin-left:10px;"><i class="fas fa-trash trashclass" ></i></a>
									
									<a href="<?php echo site_url("order/create_new_order?customer_id=".$user['Customer_Code']); ?>" class="badge badge-success" title="Create Order" style="cursor:pointer;margin-left:10px;"><i class="fa fa-plus" aria-hidden="true"></i></a>
									
									<a href="<?php echo site_url("order/browse?phone_number=".$user['Customer_Mobile_Number1']); ?>" class="badge badge-primary" title="View Orders" style="cursor:pointer;margin-left:10px;"><i class="fas fa-eye trashclass" ></i></a>
									
								</td>
								
						  </tr>
				  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
									</div>
            </div>
            <!-- /.card -->
         </div>
      </div>
    </section>
</div>




<!-- unknown rows -->












<!-- <style>
th{
	min-width:150px;
}
.ui-datepicker th {
    padding: .7em .3em;
    text-align: center;
    font-weight: bold;
    border: 0;
    min-width: max-content;
}
</style> -->
<div class="module-block" style="display:none;">
<div class="module-title-section">
	
	<h1 class='module-title'>Customers</h1>
	<div class="module-action-items">
	<a href="<?php echo site_url("user/create"); ?>" class="form-button small-button bg-green">Add </a>
	
	
	</div>
	<div class="clear"></div>
	<div class="mega-filter" data-aos="fade-up">
		<form class="browse-filter-form" action="<?php echo site_url("user/browse"); ?>">
			<div class="filter-form-row">
				<div class="form-column">
					<span class="filter-label">Regd. From</span> <input type="text" name="created_from" class="filter-form-input datepicker" placeholder="Start Date" value="<?php echo $this->input->get("created_from"); ?>" />
				</div>
				<div class="form-column">
					<span class="filter-label">Regd. To</span> <input type="text" name="created_to" class="filter-form-input datepicker" placeholder="To Date" value="<?php echo $this->input->get("created_to"); ?>" />
				</div>
				
				<div class="form-column">
					<span class="filter-label">Name</span> <input type="text" name="firstname" class="filter-form-input" placeholder="Customer Name" value="<?php echo $this->input->get("firstname"); ?>" />
				</div>
				
				<div class="form-column">
					<span class="filter-label">Email</span> <input type="text" name="parent_email" class="filter-form-input" placeholder="Customer Email" value="<?php echo $this->input->get("parent_email"); ?>" />
				</div>

				<div class="form-column">
					<span class="filter-label">Customer ID</span> <input type="text" name="customer_id" class="filter-form-input" placeholder="Customer ID" value="<?php echo $this->input->get("customer_id"); ?>" />
				</div>

				 <div class="clear"></div>
			</div>
			
			<div>
			 <input type="submit" class="form-button small-button bg-green" value="Apply" /> <a href="<?php echo site_url("user/browse"); ?>" class="form-button small-button bg-grey">&nbsp;<i class="fas fa-redo"></i> &nbsp; Reset</a>
			 </div>
		</form>
	</div>
</div>



<div class="module-content-section" style="width:100%;overflow:auto;" data-aos="fade-up" data-aos-delay="200">
	<div class="table-header-data">
		
	<div class="left">Showing <?php echo $page_size>sizeof($users)?sizeof($users):$page_size; ?> of <?php echo $total; ?> | Page <?php echo $current_page; ?> of <?php echo $total_pages; ?></div>
	<div class="right">
					Records Per Page:  &nbsp; <select name="page_size" class="filter-form-select" style="width:60px;" onchange="window.location.href='<?php echo site_url("user/browse?".$query_string_page_size); ?>&page_size='+$(this).val()">
						<option <?php if($this->input->get("page_size")==25): ?>selected="selected"<?php endif; ?> value="25">25</option>
						<option <?php if($this->input->get("page_size")==50): ?>selected="selected"<?php endif; ?> value="50">50</option>
						<option <?php if($this->input->get("page_size")==100): ?>selected="selected"<?php endif; ?> value="100">100</option>
						<option <?php if($this->input->get("page_size")==250): ?>selected="selected"<?php endif; ?> value="250">250</option>
					</select>
	</div>
	<div class="clear"></div>
	
	</div>
	<div class="table-container">
						<table>
						  <tr>
								<th><a href="<?php echo site_url("user/browse?".$query_string_sort."&sort_key=id&sort_type=".$sort_type); ?>">Customer&nbsp;Code <?php if($sort_key=="id" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="id" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								<th><a href="<?php echo site_url("user/browse?".$query_string_sort."&sort_key=firstname&sort_type=".$sort_type); ?>">Customer&nbsp;Name <?php if($sort_key=="firstname" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="firstname" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								<th><a href="<?php echo site_url("user/browse?".$query_string_sort."&sort_key=parent_email&sort_type=".$sort_type); ?>">Email <?php if($sort_key=="parent_email" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="parent_email" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								<th><a href="<?php echo site_url("user/browse?".$query_string_sort."&sort_key=created&sort_type=".$sort_type); ?>">Pincode <?php if($sort_key=="created" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="created" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								<th><a href="<?php echo site_url("user/browse?".$query_string_sort."&sort_key=status&sort_type=".$sort_type); ?>">Current Address <?php if($sort_key=="status" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="status" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								<th><a href="<?php echo site_url("user/browse?".$query_string_sort."&sort_key=status&sort_type=".$sort_type); ?>">Home Address <?php if($sort_key=="status" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="status" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								<th><a href="<?php echo site_url("user/browse?".$query_string_sort."&sort_key=status&sort_type=".$sort_type); ?>">Locality <?php if($sort_key=="status" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="status" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								<th><a href="<?php echo site_url("user/browse?".$query_string_sort."&sort_key=status&sort_type=".$sort_type); ?>">Land Mark <?php if($sort_key=="status" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="status" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								
								<th><a href="<?php echo site_url("user/browse?".$query_string_sort."&sort_key=status&sort_type=".$sort_type); ?>">City <?php if($sort_key=="status" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="status" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								<th><a href="<?php echo site_url("user/browse?".$query_string_sort."&sort_key=status&sort_type=".$sort_type); ?>">State <?php if($sort_key=="status" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="status" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								<th><a href="<?php echo site_url("user/browse?".$query_string_sort."&sort_key=status&sort_type=".$sort_type); ?>">Landline Number <?php if($sort_key=="status" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="status" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								
								<th><a href="<?php echo site_url("user/browse?".$query_string_sort."&sort_key=status&sort_type=".$sort_type); ?>">Phone Number <?php if($sort_key=="status" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="status" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								<th><a href="<?php echo site_url("user/browse?".$query_string_sort."&sort_key=status&sort_type=".$sort_type); ?>">Phone Number2 <?php if($sort_key=="status" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="status" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								
								<th><a href="<?php echo site_url("user/browse?".$query_string_sort."&sort_key=status&sort_type=".$sort_type); ?>">Time<?php if($sort_key=="status" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="status" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								
								<th>Status</th>
								<th>Action</th>
						  </tr>
						  
						  <?php foreach($users as $user): ?>
						  <tr>
								<td><?php echo $user['Customer_Code']; ?></td>
								<td><?php echo $user['Customer_Name']; ?></td>
								<td><?php echo $user['Customer_Email']; ?></td>
								<td><?php echo $user['Customer_Pincode']; ?></td>
								<td><?php echo $user['Customer_Billing_address']; ?></td>
								<td><?php echo $user['Customer_Default_shipping_address']; ?></td>
								<td><?php echo $user['Customer_Locality_Or_Town']; ?></td>
								<td><?php echo $user['Customer_Landmark']; ?></td>
								<td><?php echo $user['Customer_City']; ?></td>
								<td><?php echo $user['Customer_State']; ?></td>
								<td><?php echo $user['Customer_Phone_Number']; ?></td>
								<td><?php echo $user['Customer_Mobile_Number1']; ?></td>
								<td><?php echo $user['Customer_Mobile_Number2']; ?></td>
								<td><?php echo $user['Timestamp']; ?></td>
		

								<td>
									
									
									
									<?php if($user['Customer_Status']==1): ?>
									<i class="fa fa-play-circle" style=" font-size:1.3em; position:relative; top:2px; color:#9c3;" title='Active'></i> Active
									<?php else: ?>
									<i class="fa fa-times-circle" style=" font-size:1.3em; position:relative; top:2px; color:#ffa5a5;" title='Inactive'></i> InActive
									<?php endif; ?>
									
									
									
								</td>
								
								<td>
									<a href="<?php echo site_url("user/edit/".$user['Customer_Code']); ?>" class="" title="Edit Membership"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i>Edit</a>
									<a onclick="save(<?php echo $user['Customer_Code'];?>)" style="color:red;cursor:pointer;margin-left:10px;">Delete</a>
									
									<form action="<?php echo site_url("user/order"); ?>" method="post">
									<input type="hidden" value="<?php echo $user['Customer_Code'];?>" name="typeid">
									<button type="submit" class="form-button small-button bg-green">add new order</button>
									</form>
								</td>
						  </tr>
						  <?php endforeach; ?>
						</table>
						<div class="data-pagination">
							<?php if($prev_page): ?>
							<a href="<?php echo site_url("user/browse?page=".$prev_page_num."&".$query_string_pagination); ?>" class="form-button small-button pagination-buttons">Previous</a>
							<?php endif; ?>
							
							<?php
								
								$total=10;
								$start=1;
								
								if($total_pages<=10){
									
									$start=1;
									$total=$total_pages;
								}
								
								if($total_pages==11 and $current_page>=2){ $start=2; $total=($total+$start)>$total_pages?$total_pages:($total+$start); }
								if($total_pages==12 and $current_page>=3){ $start=3;  $total=($total+$start)>$total_pages?$total_pages:($total+$start);}
								if($total_pages==13 and $current_page>=4){ $start=4;  $total=($total+$start)>$total_pages?$total_pages:($total+$start);}
								if($total_pages==14 and $current_page>=5){ $start=5;  $total=($total+$start)>$total_pages?$total_pages:($total+$start);}
								if($total_pages>14 and $current_page>5 and $current_page<$total_pages){ $start=$current_page-5;  $total=($total+$start)>$total_pages?$total_pages:($total+$start);}
								
								if($total_pages>14 and $current_page==$total_pages){ $start=$current_page-10;  $total=($total+$start)>$total_pages?$total_pages:($total+$start); }
								
									
									for($i=$start; $i<=$total; $i++){
										
										if(($i)!=$current_page){
									?>
										<a href="<?php echo site_url("user/browse?page=".($i-1)."&".$query_string_pagination); ?>" class="form-button small-button pagination-buttons"><?php echo $i; ?></a>
									<?php
								 } else {
									 echo "&nbsp;".$i."&nbsp;";
									 }
									
									}
									
						
							
							?>
							
							<?php if($next_page): ?>
							<a href="<?php echo site_url("user/browse?page=".$next_page_num."&".$query_string_pagination); ?>" class="form-button small-button pagination-buttons">Next</a>
							<?php endif; ?>
						</div>
</div>

</div>


</div>

<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->

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
	$.post("<?php echo site_url("user/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("user/browse"); ?>";
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
       $.post("<?php echo site_url("user/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("user/browse"); ?>";
       });
  }
//   $(document).ready(function() {
//     console.log( "ready!" );

// 	$('#example2').DataTable({
// 		responsive: true,
// 		language: {
// 			searchPlaceholder: 'Search...',
// 			sSearch: '',
// 			lengthMenu: '_MENU_ items/page',
// 		}
// 	});
//   });
</script>
