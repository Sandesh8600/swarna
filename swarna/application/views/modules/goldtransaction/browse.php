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
            <h1>Workshop Profile Details for ID #<?php echo $this->session->userdata('workshop_id');?>
                    <span style="color:red">&nbsp;&nbsp;&nbsp;Workshop Gold Balance: <?php echo $workshop->Workshop_GoldBalanceInGram; ?>g</span></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url("workshop/create"); ?>"><button class="btn btn-primary">ADD Workshop</button></a></li>
              
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
               
				<div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
				        
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                                <th><a>Workshop ID <i class="fas fa-sort-down"></a></th>
								                <th><a>Workshop Name <i class="fas fa-sort-down"></a></th>
								                <th><a>Email <i class="fas fa-sort-down"></a></th>
                                <th><a>Address <i class="fas fa-sort-down"></a></th>
                                <th><a>Gold Balance <i class="fas fa-sort-down"></a></th>
                                <th><a>Mobile No.1 <i class="fas fa-sort-down"></a></th>
                                <th><a>Mobile No.2 <i class="fas fa-sort-down"></a></th>

					</tr>
                  </thead>
                  <tbody>
                  <tr>
								<td><?php echo $workshop->Workshop_Code ?></td>
								<td><?php echo $workshop->Workshop_Name ?></td>
								<td><?php echo $workshop->Workshop_Email_Id ?></td>
								<td><?php echo $workshop->Workshop_Address ?></td>
								<td><?php echo $workshop->Workshop_GoldBalanceInGram ?>g</td>
								<td><?php echo $workshop->Workshop_Contact_Mobile_Number1 ?></td>
								<td><?php echo $workshop->Workshop_Contact_Mobile_Number2 ?></td>
								
								
                                <td>
									<!-- <a href="<?php echo site_url("user/edit/".$customer->Customer_Code); ?>" class="" title="Edit Membership"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i>Edit</a> -->
									
								</td>

								 
                            </tr>
						  
                  </tbody>
                </table>
              </div>
              
            </div>
            <!-- /.card -->
         </div>
      </div>
    </section>



<!-- end -->

<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
              <div class="row mb-2">
                <div class="col-sm-6">
                 <h3 style="margin-bottom:0px;">Gold Transactions for workshop ID #<?php echo $this->session->userdata('workshop_id');?></h3>
                 </div>
                <div class="col-sm-6">

			        	<div class="card-tools">
                  <ul class="pagination pagination-sm float-right" style="margin-bottom:0px;">
                  <a href="<?php echo site_url("goldtransaction/create"); ?>" class="btn btn-primary">Add Transaction</a>
				        
                  </ul>
                </div>
                </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                                <th><a>Workshop ID <i class="fas fa-sort-down"></a></th>
								                <th><a>Workshop Name <i class="fas fa-sort-down"></a></th>
								                <th><a>Email <i class="fas fa-sort-down"></a></th>
                                <th><a>Address <i class="fas fa-sort-down"></a></th>
                                <th><a>Gold Balance <i class="fas fa-sort-down"></a></th>
                                <th><a>Mobile No.1 <i class="fas fa-sort-down"></a></th>
                                <th><a>Mobile No.2 <i class="fas fa-sort-down"></a></th>

					</tr>
                  </thead>
                  <tbody>
                  <tr>
								<td><?php echo $workshop->Workshop_Code ?></td>
								<td><?php echo $workshop->Workshop_Name ?></td>
								<td><?php echo $workshop->Workshop_Email_Id ?></td>
								<td><?php echo $workshop->Workshop_Address ?></td>
								<td><?php echo $workshop->Workshop_GoldBalanceInGram ?>g</td>
								<td><?php echo $workshop->Workshop_Contact_Mobile_Number1 ?></td>
								<td><?php echo $workshop->Workshop_Contact_Mobile_Number2 ?></td>
								
								
                                <td>
									<!-- <a href="<?php echo site_url("user/edit/".$customer->Customer_Code); ?>" class="" title="Edit Membership"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i>Edit</a> -->
									
								</td>

								 
                            </tr>
						  
                  </tbody>
                </table>
              </div>
              
            </div>
            <!-- /.card -->
         </div>
      </div>
    </section>
<!-- end -->


<!-- voucher content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
              <div class="row mb-2">
                <div class="col-sm-6">
                 <h3 style="margin-bottom:0px;">Gold Given Vorchers to workshop  </h3>
                 </div>
                <div class="col-sm-6">

			        	<div class="card-tools">
                  <ul class="pagination pagination-sm float-right" style="margin-bottom:0px;">
                  <a href="<?php echo site_url("voucher/create"); ?>" class="btn btn-primary">Give Gold</a>
				        
                  </ul>
                </div>
                </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                                <th><a>voucher NO <i class="fas fa-sort-down"></a></th>
								                <th><a>Date <i class="fas fa-sort-down"></a></th>
								                <th><a>Workshop <i class="fas fa-sort-down"></a></th>
                                <th><a>Order Id | item Id <i class="fas fa-sort-down"></a></th>
                                <th><a>Gold melting Id<i class="fas fa-sort-down"></a></th>
                                <th><a>Gold Given <i class="fas fa-sort-down"></a></th>
                                <th><a>Gold Recived<i class="fas fa-sort-down"></a></th>
                                <th><a>Action<i class="fas fa-sort-down"></a></th>

					</tr>
                  </thead>
                  <tbody >
                 <?php foreach($result as $row): ?> 
                  <tr>
								<td><?php echo $row[0]?></td>
						
								
								
                                <td>
									<!-- <a href="<?php echo site_url("user/edit/".$customer->Customer_Code); ?>" class="" title="Edit Membership"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i>Edit</a> -->
									
								</td>

								 
                            </tr>
						 <?php endforeach;?> 
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


<!-- unknown rows -->

















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
	$.post("<?php echo site_url("goldtransaction/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("goldtransaction/browse"); ?>";
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
       $.post("<?php echo site_url("goldtransaction/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("goldtransaction/browse"); ?>";
       });
  }
</script>