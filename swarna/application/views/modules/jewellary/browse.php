<?php
$this->db->select("*");
$this->db->from("workshops");
$this->db->where("Workshop_Code",$this->session->userdata('workshop_id'));
$workshop = $this->db->get()->row();
?>
<?php
    $this->db->select('*');
	$this->db->from('goldbalance');
	$balance = $this->db->get()->row();
?>
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
            <h1>Gold Transactions for Jewellery
                <span style="color:red">&nbsp;&nbsp;&nbsp;Total Gold : <?php echo $balance->Masterbalance; ?>g</span></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url("jewellary/create"); ?>"><button class="btn btn-primary">ADD Transaction</button></a></li>
              
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
                <h3 class="card-title">
				  <div class="left">Showing <?php echo $page_size>sizeof($users)?sizeof($users):$page_size; ?> of <?php echo $total; ?> | Page <?php echo $current_page; ?> of <?php echo $total_pages; ?></div>
	              <div class="right">
					Records Per Page:  &nbsp; <select name="page_size" class="filter-form-select" style="width:60px;" onchange="window.location.href='<?php echo site_url("jewellary/browse?".$query_string_page_size); ?>&page_size='+$(this).val()">
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
							<li class="page-item"><a href="<?php echo site_url("jewellary/browse?page=".$prev_page_num); ?>" class="page-link">&laquo;</a></li>
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
										<li class="page-item"><a href="<?php echo site_url("jewellary/browse?page=".($i-1)."&".$query_string_pagination); ?>" class="page-link"><?php echo $i; ?></a></li>
									<?php
								 } else {
									 echo '<li class="page-item"><a class="page-link">&nbsp;'.$i.'&nbsp;</a></li>';
									 }
									
									}
									
						
							
							?>


						<?php if($next_page): ?>
							<li class="page-item"><a href="<?php echo site_url("jewellary/browse?page=".$next_page_num); ?>" class="page-link">&raquo;</a></li>
						<?php endif; ?>
                    
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
					            <th><a>Transaction ID <i class="fas fa-sort-down"></a></th>
								<th><a>Entity Type <i class="fas fa-sort-down"></a></th>
								<th><a>Entity ID <i class="fas fa-sort-down"></a></th>
                                <th><a>Gold Balance <i class="fas fa-sort-down"></a></th>
                                <th><a>Transaction Type <i class="fas fa-sort-down"></a></th>
                
                                <th><a>Comments <i class="fas fa-sort-down"></a></th>
                                <th><a>Date <i class="fas fa-sort-down"></a></th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php foreach($users as $user): ?>
						  <tr>
						  <td><?php echo $user['Transaction_ID'] ?></td>
								<td><?php echo $user['Entity_Type'] ?></td>
								<td><?php echo $user['Entity_Id'] ?></td>
								<td><?php echo $user['Gold_in_Grams'] ?>g</td>
								<td><?php echo $user['Transaction_Type'] ?></td>
								
								<td><?php echo $user['Comments'] ?></td>
								<td><?php echo $user['Timestamp'] ?></td>
								
						  </tr>
				  <?php endforeach; ?>
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
<?php
$this->db->select("*");
$this->db->from("workshops");
$this->db->where("Workshop_Code",$this->session->userdata('workshop_id'));
$workshop = $this->db->get()->row();
?>
<div class="module-block" style="display:none;">
<!-- <div class="module-title-section"> -->
	
	<!-- <h1 class='module-title'>Gold deposit for Order-ID #<?php echo $this->session->userdata('workshop_id');?></h1> -->
	<div class="module-action-items">
	<!-- <a href="<?php echo site_url("jewellary/create"); ?>" class="form-button small-button bg-green">Deposit Gold</a> -->
	<!-- <a class="form-button small-button bg-grey" href="<?php echo site_url("order/vieworder"); ?>"><i class="fas fa-arrow-left"></i> Go View Order</a> -->

	
	
	</div>
	<div class="clear"></div>
	<!-- <div class="mega-filter"> -->

<?php
    $this->db->select('*');
	$this->db->from('goldbalance');
	$balance = $this->db->get()->row();
?>
	

    <!-- Workshop -->


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

<div class="module-content-section" style="width:100%;overflow:auto;" data-aos="fade-up" data-aos-delay="200">
            <div class="table-header-data">
                    <h1 class='module-title' style="color: #666;display:flex;width:80%;">Gold Transactions for Jewellery
                    <span style="color:red">&nbsp;&nbsp;&nbsp;Total Gold : <?php echo $balance->Masterbalance; ?>g</span>
                    </h1>
	                <div class="module-action-items" style="width:20%;">
	                     <a href="<?php echo site_url("jewellary/create"); ?>" class="form-button small-button bg-green">Add Transaction</a>
	                </div>
                 
            </div>
            <div class="clear"></div>
	<div class="table-header-data">
		
	<div class="left">Showing <?php echo $page_size>sizeof($users)?sizeof($users):$page_size; ?> of <?php echo $total; ?> | Page <?php echo $current_page; ?> of <?php echo $total_pages; ?></div>
	<div class="right">
					Records Per Page:  &nbsp; <select name="page_size" class="filter-form-select" style="width:60px;" onchange="window.location.href='<?php echo site_url("order/browse?".$query_string_page_size); ?>&page_size='+$(this).val()">
						<option <?php if($this->input->get("page_size")==25): ?>selected="selected"<?php endif; ?> value="25">25</option>
						<option <?php if($this->input->get("page_size")==50): ?>selected="selected"<?php endif; ?> value="50">50</option>
						<option <?php if($this->input->get("page_size")==100): ?>selected="selected"<?php endif; ?> value="100">100</option>
						<option <?php if($this->input->get("page_size")==250): ?>selected="selected"<?php endif; ?> value="250">250</option>
					</select>
	</div>
	<div class="clear"></div>
	
	</div>
            <div class="table-container" style="width:100%;min-height: 150px;overflow:auto;">
						<table>
						  <tr>
								<th><a>Transaction ID <i class="fas fa-sort-down"></a></th>
								<th><a>Entity Type <i class="fas fa-sort-down"></a></th>
								<th><a>Entity ID <i class="fas fa-sort-down"></a></th>
                              <th><a>Gold Balance <i class="fas fa-sort-down"></a></th>
                <th><a>Transaction Type <i class="fas fa-sort-down"></a></th>
                <!-- <th><a>From Entity ID <i class="fas fa-sort-down"></a></th>
                <th><a>From Entity Type <i class="fas fa-sort-down"></a></th> -->
                <th><a>Comments <i class="fas fa-sort-down"></a></th>
                <th><a>Date <i class="fas fa-sort-down"></a></th>

								<!-- <th>Action</th> -->
						  </tr>
						  
						  <?php foreach($users as $user): ?>
						  <tr>
								<td><?php echo $user['Transaction_ID'] ?></td>
								<td><?php echo $user['Entity_Type'] ?></td>
								<td><?php echo $user['Entity_Id'] ?></td>
								<td><?php echo $user['Gold_in_Grams'] ?>g</td>
								<td><?php echo $user['Transaction_Type'] ?></td>
								<!-- <td><?php echo $user['From_Entity_Id'] ?></td>
								<td><?php echo $user['From_Entity_Type'] ?></td> -->
								<td><?php echo $user['Comments'] ?></td>
								<td><?php echo $user['Timestamp'] ?></td>

								
								
                                <!-- <td>
									<a href="<?php echo site_url("jewellary/edit/".$user['Transaction_ID']); ?>" class="" title="Edit Membership"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i>Edit</a>
									
								</td> -->

								 
                            </tr>
						  <?php endforeach; ?>
                           
                            
                        </table>
                        <div class="data-pagination">
							<?php if($prev_page): ?>
							<a href="<?php echo site_url("order/browse?page=".$prev_page_num."&".$query_string_pagination); ?>" class="form-button small-button pagination-buttons">Previous</a>
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
										<a href="<?php echo site_url("order/browse?page=".($i-1)."&".$query_string_pagination); ?>" class="form-button small-button pagination-buttons"><?php echo $i; ?></a>
									<?php
								 } else {
									 echo "&nbsp;".$i."&nbsp;";
									 }
									
									}
									
									
							
							?>
							
							<?php if($next_page): ?>
							<a href="<?php echo site_url("order/browse?page=".$next_page_num."&".$query_string_pagination); ?>" class="form-button small-button pagination-buttons">Next</a>
							<?php endif; ?>
						</div>
</div>

</div>


</div>


<script>

function confirm_delete(url){
		
		
     var response=confirm("Are you sure you want to delete the user?");
     
     if(response==true){
		 
	   window.location.href=url;
	 
	 }
    
 }

</script>
 

 
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
	$.post("<?php echo site_url("jewellary/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("jewellary/browse"); ?>";
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
       $.post("<?php echo site_url("jewellary/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("jewellary/browse"); ?>";
       });
  }
</script>