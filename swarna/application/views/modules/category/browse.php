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
$metal_type = $this->input->get("metal_type");
?>

<style>
.filter-label{
	font-size:14px;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	
	<!--Create category-->
	<?php if($this->input->get("create_form")=="yes"): 
	
		$this->load->view("modules/category/create");
	
	 endif; ?>	
	<!--Create category ends here-->
	
	<!--Editor Category start-->
	<?php if($this->input->get("edit_form")=="yes"): 
	
		$this->load->view("modules/category/edit");
	
	 endif; ?>
	<!---Editor category ends -->
	
	
	<!--Create category-->
	<?php if($this->input->get("subcat_create_form")=="yes"): 
	
		$this->load->view("modules/category/create_subcat");
	
	 endif; ?>	
	<!--Create category ends here-->
	
	<!--Editor Category start-->
	<?php if($this->input->get("subcat_edit_form")=="yes"): 	
		$this->load->view("modules/category/edit_subcat");	
	 endif; ?>
	<!---Editor category ends -->
	
	<!--Editor J Item start-->
	<?php if($this->input->get("jitem_create_form")=="yes"): 	
		$this->load->view("modules/category/create_jitem");	
	 endif; ?>
	<!---Editor J Item ends -->
	<!--Editor J Item edit start-->
	<?php if($this->input->get("jitem_edit_form")=="yes"): 	
		$this->load->view("modules/category/edit_jitem");	
	 endif; ?>
	<!---Editor J Item edit ends -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>J Type (<?php echo ucfirst($metal_type); ?>)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url("category/browse?create_form=yes&metal_type=$metal_type"); ?>"><button class="btn btn-primary">ADD J Type</button></a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url("category/browse?subcat_create_form=yes&metal_type=$metal_type"); ?>"><button class="btn btn-primary">ADD Sub J Type</button></a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url("category/browse?jitem_create_form=yes&metal_type=$metal_type"); ?>"><button class="btn btn-primary">ADD J Items</button></a></li>
              
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
					&nbsp;Records Per Page:  &nbsp; <select name="page_size" class="filter-form-select" style="width:60px;" onchange="window.location.href='<?php echo site_url("category/browse?".$query_string_page_size); ?>&page_size='+$(this).val()">
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
							<li class="page-item"><a href="<?php echo site_url("category/browse?page=".$prev_page_num); ?>" class="page-link">&laquo;</a></li>
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
										<li class="page-item"><a href="<?php echo site_url("category/browse?page=".($i-1)."&".$query_string_pagination); ?>" class="page-link"><?php echo $i; ?></a></li>
									<?php
								 } else {
									 echo '<li class="page-item"><a class="page-link">&nbsp;'.$i.'&nbsp;</a></li>';
									 }
									
									}
								
							?>


						<?php if($next_page): ?>
							<li class="page-item"><a href="<?php echo site_url("category/browse?page=".$next_page_num); ?>" class="page-link">&raquo;</a></li>
						<?php endif; ?>
                    
                  </ul>
                </div>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" id="example2">
                  <thead>
                    <tr>
						<th>J Type Name</th>
						<th>MC/Gram</th>
						<th>Wastage </th>
						<!-- <th>Wastage Gram</th> -->
						<th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php foreach($users as $user): ?>
						  <tr>
						       
								<td colspan="3"><strong><?php echo $user['Category_Name']; ?></strong></td>
							
								<td>
									<a href="<?php echo site_url("category/browse?edit_form=yes&metal_type=".$metal_type."&category_id=".$user['Category_ID']); ?>" class="" title="Edit category"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i></a>
									<a onclick="save(<?php echo $user['Category_ID'];?>)" style="color:red;cursor:pointer;margin-left:10px;"><i class="fas fa-trash trashclass" ></i></a>
									
								</td>
								
						  </tr>
						  <?php  foreach($user['subcategories'] as $subcat):  ?>
							<tr>
						       
								<td colspan=3>&nbsp;&nbsp;<?php echo $subcat['SubCategory_Name']; ?></td>
								<!-- <td>Rs.<?php echo addPrecision($subcat['making_charges_per_gram'],2); ?></td>
								<td><?php echo $subcat['wastage_percent']; ?>%</td> -->
								<td>
									<a href="<?php echo site_url("category/browse?subcat_edit_form=yes&metal_type=".$metal_type."&subcategory_id=".$subcat['SubCategory_ID']); ?>" class="" title="Edit Sub Category"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i></a>
									<a onclick="myDelete(<?php echo $subcat['SubCategory_ID'];?>)" style="color:red;cursor:pointer;margin-left:10px;"><i class="fas fa-trash trashclass" ></i></a>
									
								</td>
								
						  	</tr>
						  <?php 
						  foreach($subcat['jitems'] as $jitem): ?>
							<tr>
						       
								<td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $jitem['item_name']; ?></td>
								<td>Rs.<?php echo addPrecision($jitem['making_charges_per_gram'],2); ?></td>
								<td><?php echo $jitem['wastage_percent']; ?><?= ($jitem['wastage_type']=='percent') ? '%' : '' ?></td>
								<!-- <td><?php echo $jitem['wastage_gram']; ?></td> -->
								<td>
									<a href="<?php echo site_url("category/browse?jitem_edit_form=yes&metal_type=".$metal_type."&jitem_id=".$jitem['item_id']); ?>" class="" title="Edit J Item "><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i></a>
									<a onclick="deleteJItem(<?php echo $jitem['item_id'];?>)" style="color:red;cursor:pointer;margin-left:10px;"><i class="fas fa-trash trashclass" ></i></a>
									
								</td>
								
						  </tr>
						<?php endforeach; ?>
					<?php endforeach; ?>
						  
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
	$.post("<?php echo site_url("category/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("category/browse?metal_type=$metal_type"); ?>";
       });
  } else {
    // alert("no clicked");
  }
};

</script>


<script>
function myDelete(partner_id)
  {
    var delete_record = confirm("Are you sure you want to Delete this record?");
	if(delete_record===true){
       $.post("<?php echo site_url("category/deleteSubcat");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("category/browse?metal_type=$metal_type"); ?>";
       });
	}
  }

  function deleteJItem(partner_id)
  {
    var delete_record = confirm("Are you sure you want to Delete this record?");
	if(delete_record===true){
       $.post("<?php echo site_url("category/deleteJItem");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("category/browse?metal_type=$metal_type"); ?>";
       });
	}
  }

  //function to populate sub category
	function sub_category_options(category_id){
		
		const subcat_options=[];
		<?php
			
			foreach($users as $cat):
			
				$subcats="<option value=''>-select subcat-</option>";
			
				foreach($cat['subcategories'] as $sub_cat):
				
					$subcats=$subcats."<option value='".$sub_cat['SubCategory_ID']."'>".$sub_cat['SubCategory_Name']."</option>";			
				endforeach;
			
				?>
				subcat_options[<?php echo $cat['Category_ID']; ?>]="<?php echo $subcats; ?>";
				<?php
			
			endforeach;
		?>
		
		$("#sub-category").html(subcat_options[category_id]);
		
	}
</script>
 
