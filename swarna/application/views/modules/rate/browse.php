<?php

function addPrecision($digit, $precision){
	return  number_format((float)$digit, $precision, '.', '');
}
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
	width:140px;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	
	
	<!--Create category-->
	<?php if($this->input->get("create_form")=="yes"): 
	
		$this->load->view("modules/rate/create");
	
	 endif; ?>	
	<!--Create category ends here-->
	
	<!--Editor Category start-->
	<?php if($this->input->get("edit_form")=="yes"): 
	
		$this->load->view("modules/rate/edit");
	
	 endif; ?>
	<!---Editor category ends -->
	
	
	
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rate Per Gram</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url("rate/browse?create_form=yes"); ?>"><button class="btn btn-primary">Add </button></a></li>
              
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

				<form class="browse-filter-form" action="<?php echo site_url("rate/browse"); ?>">
			<div class="filter-form-row">
				<div class="form-column">
					<span class="filter-label">From</span> <input type="text" name="created_from" class="form-control datepicker" placeholder="Start Date" value="<?php echo $this->input->get("created_from"); ?>" autocomplete="off"/>
				</div>
				<div class="form-column">
					<span class="filter-label">To</span> <input type="text" name="created_to" class="form-control datepicker" placeholder="To Date" value="<?php echo $this->input->get("created_to"); ?>" autocomplete="off"/>
				</div>
				
				<div class="form-column">
					<span class="filter-label">&nbsp;</span>
					<div>
					<input type="submit" class="btn btn-primary" value="Apply Filter" /> <a href="<?php echo site_url("rate/browse"); ?>" class="btn btn-primary bg-grey">&nbsp;<i class="fas fa-redo"></i> &nbsp; Reset</a>
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
				
             
				
              </div>  -->
              <!-- /.card-header -->
              <div class="card-body">
			  <div class="row">
                                <div class="col-sm-4 col-md-4">
			
					<select  class="form-control form-select select_metal" data-bs-placeholder="Select" name="company" onChange="onStatusFilter();">
						<option  value="all">All Metal </option>
						<option value="gold">Gold</option>
						<option value="silver">Silver</option>
					</select>
				</div>
				</div>
                <table class="table table-bordered" id="rate_table">
                  <thead>
                    <tr>		
								
						<th>Date </th>
						<th>Metal Type</th>
						
						<th>Rate Per 22k Gold Gram </th>
						<th>Action</th>
					</tr>
                  </thead>
                  <tbody>
				  <?php foreach($users as $user):   ?>
					<tr>	
						
						<td><?php echo date('d-m-Y', strtotime($user['Timestamp'])); ?></td>
						<td><?php echo $user['metal_type']; ?></td>
						<td>₹<?php echo addPrecision($user['TodaysRatePerGram'],2); ?></td>
						<td>
							<a href="<?php echo site_url("rate/browse?edit_form=yes&rate_id=".$user['TodaysRatePerGram_ID']); ?>" class="" title="Edit Membership"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i></a>
							<a onclick="save(<?php echo $user['TodaysRatePerGram_ID'];?>)" style="color:red;cursor:pointer;margin-left:10px;"><i class="fas fa-trash trashclass" ></i></a>
							
							
						</td>
						
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
<div class="module-block" style="display:none;">
<div class="module-title-section">
	
	<h1 class='module-title'>Todays Rate Per Gram </h1>
	<div class="module-action-items">
	<a href="<?php echo site_url("rate/create"); ?>" class="form-button small-button bg-green">Add Todays Rate Per Gram</a>
	
	
	</div>
	<div class="clear"></div>
	<div class="mega-filter" data-aos="fade-up">
		<form class="browse-filter-form" action="<?php echo site_url("rate/browse"); ?>">
			<div class="filter-form-row">
				<div class="form-column">
					<span class="filter-label">Regd. From</span> <input type="text" name="created_from" class="filter-form-input datepicker" placeholder="Start Date" value="<?php echo $this->input->get("created_from"); ?>" />
				</div>
				<div class="form-column">
					<span class="filter-label">Regd. To</span> <input type="text" name="created_to" class="filter-form-input datepicker" placeholder="To Date" value="<?php echo $this->input->get("created_to"); ?>" />
				</div>
				
				<div class="form-column">
					<span class="filter-label">Todays Rate/g's</span> <input type="text" name="firstname" class="filter-form-input" placeholder="Todays Rate Per Gram" value="<?php echo $this->input->get("firstname"); ?>" />
				</div>
				
				
				<div class="form-column">
					<span class="filter-label">Todays Rate/g's</span> <input type="text" name="customer_id" class="filter-form-input" placeholder="Todays Rate Per Gram ID" value="<?php echo $this->input->get("customer_id"); ?>" />
				</div>

				 <div class="clear"></div>
			</div>
			
			<div>
			 <input type="submit" class="form-button small-button bg-green" value="Apply" /> <a href="<?php echo site_url("rate/browse"); ?>" class="form-button small-button bg-grey">&nbsp;<i class="fas fa-redo"></i> &nbsp; Reset</a>
			 </div>
		</form>
	</div>
</div>

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
		
	<div class="left">Showing <?php echo $page_size>sizeof($users)?sizeof($users):$page_size; ?> of <?php echo $total; ?> | Page <?php echo $current_page; ?> of <?php echo $total_pages; ?></div>
	<div class="right">
					Records Per Page:  &nbsp; <select name="page_size" class="filter-form-select" style="width:60px;" onchange="window.location.href='<?php echo site_url("rate/browse?".$query_string_page_size); ?>&page_size='+$(this).val()">
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
								<th><a href="<?php echo site_url("rate/browse?".$query_string_sort."&sort_key=id&sort_type=".$sort_type); ?>">Todays Rate Per Gram ID <?php if($sort_key=="id" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="id" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								<th><a href="<?php echo site_url("rate/browse?".$query_string_sort."&sort_key=firstname&sort_type=".$sort_type); ?>">14kt/18kt/22kt/24kt <?php if($sort_key=="firstname" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="firstname" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
									<th><a href="<?php echo site_url("rate/browse?".$query_string_sort."&sort_key=firstname&sort_type=".$sort_type); ?>">Todays Rate Per Gram <?php if($sort_key=="firstname" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="firstname" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								
								<th><a href="<?php echo site_url("rate/browse?".$query_string_sort."&sort_key=parent_email&sort_type=".$sort_type); ?>">Time <?php if($sort_key=="parent_email" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="parent_email" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								
								<th>Action</th>
						  </tr>
						  
						  <?php  foreach($users as $user):    ?>
						  <tr>
								<td><?php echo $user['TodaysRatePerGram_ID']; ?></td>
								<td><?php echo $user['karrat']; ?></td>

								<td>₹<?php echo $user['TodaysRatePerGram']; ?></td>
								<td><?php echo $user['Timestamp']; ?></td>
		

							
								
								<td>
									<a href="<?php echo site_url("rate/edit/".$user['TodaysRatePerGram_ID']); ?>" class="" title="Edit Membership"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i></a>
									<a onclick="save(<?php echo $user['TodaysRatePerGram_ID'];?>)" style="color:red;cursor:pointer;margin-left:10px;"><i class="fas fa-trash trashclass" ></i></a>
									
									
								</td>
						  </tr>
						  <?php endforeach; ?>
						</table>
						<div class="data-pagination">
							<?php if($prev_page): ?>
							<a href="<?php echo site_url("rate/browse?page=".$prev_page_num."&".$query_string_pagination); ?>" class="form-button small-button pagination-buttons">Previous</a>
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
										<a href="<?php echo site_url("rate/browse?page=".($i-1)."&".$query_string_pagination); ?>" class="form-button small-button pagination-buttons"><?php echo $i; ?></a>
									<?php
								 } else {
									 echo "&nbsp;".$i."&nbsp;";
									 }
									
									}
									
									
							
							?>
							
							<?php if($next_page): ?>
							<a href="<?php echo site_url("rate/browse?page=".$next_page_num."&".$query_string_pagination); ?>" class="form-button small-button pagination-buttons">Next</a>
							<?php endif; ?>
						</div>
</div>

</div>


</div>

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
	$.post("<?php echo site_url("rate/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("rate/browse"); ?>";
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
       $.post("<?php echo site_url("rate/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("rate/browse"); ?>";
       });
  }

  $(document).ready(function() {  
            $.fn.dataTableExt.sErrMode = 'throw';
            const statuColumnIndex=1;
            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                let statusVal = $(".select_metal").val();
                var status = data[statuColumnIndex] || "";
                 console.log(statusVal);
                 console.log(status);
                if(statusVal==="all") {
                    return true;
                }
                return statusVal.toLowerCase() === status.toLowerCase();
        
        });
        $('#rate_table').DataTable( {
			responsive: true,
        "bPaginate": true,
			"aLengthMenu": [[30, 60 , -1], [30, 60, "All"]],
			"iDisplayLength" : 30,
			"bLengthChange": false,
			language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			}
            } );
        } );
        function onStatusFilter() {
           
           var table = $('#rate_table').DataTable();
           table.draw();

       }
</script>
<style>
	.dataTables_length .form-select{ width: 50px;}
</style>
