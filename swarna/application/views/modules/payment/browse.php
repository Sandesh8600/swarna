<style>
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
</style>
<div class="module-block">
<div class="module-title-section">
	
	<h1 class='module-title'>Payment for Order-ID #<?php echo $this->session->userdata('viewtask_id');?></h1>
	<div class="module-action-items">
	<a href="<?php echo site_url("payment/create"); ?>" class="form-button small-button bg-green">Add Payment</a>
	<a class="form-button small-button bg-grey" href="<?php echo site_url("order/vieworder"); ?>"><i class="fas fa-arrow-left"></i> Go View Order</a>

	
	
	</div>
	<div class="clear"></div>
	<div class="mega-filter">
		<form class="browse-filter-form" action="<?php echo site_url("payment/browse"); ?>">
			<div class="filter-form-row">
				<div class="form-column">
					<span class="filter-label">Regd. From</span> <input type="text" name="created_from" class="filter-form-input datepicker" placeholder="Start Date" value="<?php echo $this->input->get("created_from"); ?>" />
				</div>
				<div class="form-column">
					<span class="filter-label">Regd. To</span> <input type="text" name="created_to" class="filter-form-input datepicker" placeholder="To Date" value="<?php echo $this->input->get("created_to"); ?>" />
				</div>
				
				
				<div class="form-column">
					<span class="filter-label">Payment ID</span> <input type="text" name="customer_id" class="filter-form-input" placeholder="Payment ID" value="<?php echo $this->input->get("customer_id"); ?>" />
				</div>

				 <div class="clear"></div>
			</div>
			
			<div>
			 <input type="submit" class="form-button small-button bg-green" value="Apply" /> <a href="<?php echo site_url("payment/browse"); ?>" class="form-button small-button bg-grey">&nbsp;<i class="fas fa-redo"></i> &nbsp; Reset</a>
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

<div class="module-content-section" style="width:100%;overflow:auto;">
	<div class="table-header-data">
		
	<div class="left">Showing <?php echo $page_size>sizeof($users)?sizeof($users):$page_size; ?> of <?php echo $total; ?> | Page <?php echo $current_page; ?> of <?php echo $total_pages; ?></div>
	<div class="right">
					Records Per Page:  &nbsp; <select name="page_size" class="filter-form-select" style="width:60px;" onchange="window.location.href='<?php echo site_url("payment/browse?".$query_string_page_size); ?>&page_size='+$(this).val()">
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
								<th><a href="<?php echo site_url("payment/browse?".$query_string_sort."&sort_key=id&sort_type=".$sort_type); ?>">Payment ID <?php if($sort_key=="id" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="id" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								<th><a href="<?php echo site_url("payment/browse?".$query_string_sort."&sort_key=firstname&sort_type=".$sort_type); ?>">Payment Date <?php if($sort_key=="firstname" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="firstname" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								<th><a href="<?php echo site_url("payment/browse?".$query_string_sort."&sort_key=firstname&sort_type=".$sort_type); ?>">Payment Method <?php if($sort_key=="firstname" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="firstname" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								<th><a href="<?php echo site_url("payment/browse?".$query_string_sort."&sort_key=firstname&sort_type=".$sort_type); ?>">Gold in Grams <?php if($sort_key=="firstname" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="firstname" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
									<th><a href="<?php echo site_url("payment/browse?".$query_string_sort."&sort_key=firstname&sort_type=".$sort_type); ?>">Metal/Puriity Percentage <?php if($sort_key=="firstname" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="firstname" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								
								<th><a href="<?php echo site_url("payment/browse?".$query_string_sort."&sort_key=firstname&sort_type=".$sort_type); ?>">Amount <?php if($sort_key=="firstname" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="firstname" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								<th><a href="<?php echo site_url("payment/browse?".$query_string_sort."&sort_key=firstname&sort_type=".$sort_type); ?>">Payment Status <?php if($sort_key=="firstname" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="firstname" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								
								<th><a href="<?php echo site_url("payment/browse?".$query_string_sort."&sort_key=parent_email&sort_type=".$sort_type); ?>">Time <?php if($sort_key=="parent_email" and $sort_type=="asc"): ?><i class="fas fa-sort-up"></i><?php elseif($sort_key=="parent_email" and $sort_type=="desc"): ?><i class="fas fa-sort-down"></i><?php endif; ?></a></th>
								
								<th>Action</th>
						  </tr>
						  
						  <?php foreach($users as $user): ?>
						  <tr>
								<td><?php echo $user['Payment_code']; ?></td>
								
								<td><?php echo $user['Date_Of_Order']; ?></td>
								<td><?php echo $user['Payment_Method']; ?></td>
								
								<td><?php echo $user['Quantity']; ?></td>
								<td><?php echo $user['purity']; ?></td>

								<td><?php echo $user['Amount']; ?></td>
								
								<td>
									<?php if($user['Payment_Status']==1): ?>
									<i class="fa fa-play-circle" style=" font-size:1.3em; position:relative; top:2px; color:#9c3;" title='Remaining Balance'></i> In Complete
									<?php else: ?>
									<i class="fa fa-times-circle" style=" font-size:1.3em; position:relative; top:2px; color:#ffa5a5;" title='Closed'></i> Received
									<?php endif; ?>
									
								</td>
							
								<td><?php echo $user['Timestamp']; ?></td>
		

							
								
								<td>
									<a href="<?php echo site_url("payment/edit/".$user['Payment_code']); ?>" class="" title="Edit Membership"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i>Edit</a>
									<a onclick="save(<?php echo $user['Payment_code'];?>)" style="color:red;cursor:pointer;margin-left:10px;">Delete</a>
									
									
								</td>
						  </tr>
						  <?php endforeach; ?>
						</table>
						<div class="data-pagination">
							<?php if($prev_page): ?>
							<a href="<?php echo site_url("payment/browse?page=".$prev_page_num."&".$query_string_pagination); ?>" class="form-button small-button pagination-buttons">Previous</a>
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
										<a href="<?php echo site_url("payment/browse?page=".($i-1)."&".$query_string_pagination); ?>" class="form-button small-button pagination-buttons"><?php echo $i; ?></a>
									<?php
								 } else {
									 echo "&nbsp;".$i."&nbsp;";
									 }
									
									}
									
									
							
							?>
							
							<?php if($next_page): ?>
							<a href="<?php echo site_url("payment/browse?page=".$next_page_num."&".$query_string_pagination); ?>" class="form-button small-button pagination-buttons">Next</a>
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
	$.post("<?php echo site_url("payment/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("payment/browse"); ?>";
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
       $.post("<?php echo site_url("payment/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("payment/browse"); ?>";
       });
  }
</script>