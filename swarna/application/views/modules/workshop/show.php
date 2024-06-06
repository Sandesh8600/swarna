
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .table thead th {
            background-color: #ffffff;
        }
        .table tbody tr:hover {
            background-color: #ffffff;
        }
        .view-icon {
            color: #007bff;
            cursor: pointer;
        }
        .view-icon:hover {
            color: #0056b3;
        }
    </style>
<style>
        .box {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        .box h3 {
            margin-bottom: 10px;
            font-size: 14px;
        }
        .box p {
            margin: 5px 5px 5px 5px;
            font-size: 12px;
        }
    </style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Workshop</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url("workshop/create"); ?>"><button class="btn btn-primary">ADD </button></a></li>
              
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
              <!-- <div class="card-header">
                <h3 class="card-title">
	 
				<div class="left">Showing <?php echo $page_size>sizeof($users)?sizeof($users):$page_size; ?> of <?php echo $total; ?> | Page <?php echo $current_page; ?> of <?php echo $total_pages; ?></div>
	              <div class="right">
					&nbsp;Records Per Page:  &nbsp; <select name="page_size" class="filter-form-select" style="width:60px;" onchange="window.location.href='<?php echo site_url("workshop/browse?".$query_string_page_size); ?>&page_size='+$(this).val()">
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
							<li class="page-item"><a href="<?php echo site_url("workshop/browse?page=".$prev_page_num); ?>" class="page-link">&laquo;</a></li>
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
										<li class="page-item"><a href="<?php echo site_url("workshop/browse?page=".($i-1)."&".$query_string_pagination); ?>" class="page-link"><?php echo $i; ?></a></li>
									<?php
								 } else {
									 echo '<li class="page-item"><a class="page-link">&nbsp;'.$i.'&nbsp;</a></li>';
									 }
									
									}
									
						
							
							?>


						<?php if($next_page): ?>
							<li class="page-item"><a href="<?php echo site_url("workshop/browse?page=".$next_page_num); ?>" class="page-link">&raquo;</a></li>
						<?php endif; ?>
                    
                  </ul>
                </div>
              </div> -->
              <!-- /.card-header -->
              <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="box">
                    <h3>Workshops </h3>
                    <p><?php echo $result['total_workshops'];?></p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="box">
                    <h3>Balance Items</h3>
                    <p><?php echo $result['balance'];?></p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="box">
                    <h3>Total Work Order</h3>
                    <p><?php echo $result['TW_order'];?></p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="box">
                    <h3>No. of J Items</h3>
                    <p><?php echo $result['Total_items'];?></p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-3">
                <div class="box">
                    <h3>Total Work Order Assigned</h3>
                    <p><?php echo $result['work_order_given'];?></p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-3">
                <div class="box">
                    <h3>Total Gold Payable</h3>
                    <p><?php echo $result['voucher_gold'];?></p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-3">
                <div class="box">
                    <h3>Total Gold Payable for Assigned</h3>
                    <p><?php echo $result['tgp_assigned'];?></p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-3">
                <div class="box">
                    <h3>Total Gold avilable as per voucher no</h3>
                    <p><?php echo $result['voucher']['Tgp_voucher'];?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Dynamic content will be injected here -->
  </div>
</div>
              
            </div>
            <!-- /.card -->
            <div class="col-md-12">
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">
	 
				<div class="left">Showing <?php echo $page_size>sizeof($users)?sizeof($users):$page_size; ?> of <?php echo $total; ?> | Page <?php echo $current_page; ?> of <?php echo $total_pages; ?></div>
	              <div class="right">
					&nbsp;Records Per Page:  &nbsp; <select name="page_size" class="filter-form-select" style="width:60px;" onchange="window.location.href='<?php echo site_url("workshop/browse?".$query_string_page_size); ?>&page_size='+$(this).val()">
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
							<li class="page-item"><a href="<?php echo site_url("workshop/browse?page=".$prev_page_num); ?>" class="page-link">&laquo;</a></li>
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
										<li class="page-item"><a href="<?php echo site_url("workshop/browse?page=".($i-1)."&".$query_string_pagination); ?>" class="page-link"><?php echo $i; ?></a></li>
									<?php
								 } else {
									 echo '<li class="page-item"><a class="page-link">&nbsp;'.$i.'&nbsp;</a></li>';
									 }
									
									}
									
						
							
							?>


						<?php if($next_page): ?>
							<li class="page-item"><a href="<?php echo site_url("workshop/browse?page=".$next_page_num); ?>" class="page-link">&raquo;</a></li>
						<?php endif; ?>
                    
                  </ul>
                </div>
              </div> -->
              <!-- /.card-header -->

              <div class="container mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-light">
                
                    <tr>
                        <th scope="col">Workshop ID</th>
                        <th scope="col">Balance Items</th>
                        <th scope="col">Total Work Order</th>
                        <th scope="col">No. of J Items</th>
                        <th scope="col">Total Work Order Assigned</th>
                        <th scope="col">Total Gold Payable</th>
                        <th scope="col">TGP Assigned</th>
                        <th scope="col">Gold avilable(vno)</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($workshop as $item) : ?>
                    <tr>
                        <td><?php echo $item['Workshop_Code']; ?></td>
                        <td>10</td>
                        <td><?php echo $item['TW_order']; ?></td>
                        <td><?php echo $item['T_assigned']; ?></td>
                        <td>3</td>
                        <td>50</td>
                        <td></td>
                        <td>70</td>
                        <td><a href="<?php echo site_url("workshop/show/".$item['Workshop_Code']);?>"><i class="fas fa-eye view-icon"></i></a>
                        <a href="<?php echo site_url("workshop/sjw/".$item['Workshop_Code']);?>">  <i class="bi bi-plus-circle-fill" style="font-size: 1rem;  margin-left:10px"></i> </a>
                      </td>
                    </tr>
                   
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Dynamic content will be injected here -->
  </div>
</div>
              
            </div>
         </div>
      </div>
    </section>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0-beta3/js/bootstrap.min.js"></script>
<!-- 
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Sample data array with detailed information
    const data = [
      { id: 1, balanceItem: 50, totalWorkOrder: 10, totalGoldPayable: 200, totalWorkOrderAssigned: 8 },
      { id: 2, balanceItem: 70, totalWorkOrder: 15, totalGoldPayable: 300, totalWorkOrderAssigned: 12 },
      { id: 3, balanceItem: 60, totalWorkOrder: 12, totalGoldPayable: 250, totalWorkOrderAssigned: 10 },
      { id: 4, balanceItem: 80, totalWorkOrder: 18, totalGoldPayable: 350, totalWorkOrderAssigned: 14 },
      { id: 5, balanceItem: 90, totalWorkOrder: 20, totalGoldPayable: 400, totalWorkOrderAssigned: 16 },
      { id: 6, balanceItem: 100, totalWorkOrder: 22, totalGoldPayable: 450, totalWorkOrderAssigned: 18 }
    ];

    // Get the dashboard row element
    const dashboardRow = document.getElementById('dashboard-row');

    // Generate and append boxes dynamically
    data.forEach(item => {
      const colDiv = document.createElement('div');
      colDiv.className = 'col-2';

      const boxDiv = document.createElement('div');
      boxDiv.className = 'dashboard-box';

      const content = `
        <h5>Workshop ID: ${item.id}</h5>
        <p>Balance Item: ${item.balanceItem}</p>
        <p>Total Work Order: ${item.totalWorkOrder}</p>
        <p>Total Gold Payable: ${item.totalGoldPayable}</p>
        <p>Total Work Order Assigned: ${item.totalWorkOrderAssigned}</p>
      `;
      boxDiv.innerHTML = content;

      colDiv.appendChild(boxDiv);
      dashboardRow.appendChild(colDiv);
    });
  });
</script> -->
  <script>
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
	$.post("<?php echo site_url("workshop/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("workshop/browse"); ?>";
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
       $.post("<?php echo site_url("workshop/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("workshop/browse"); ?>";
       });
  }
</script>
