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
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	
	<!--Create category-->
	<?php if($this->input->get("create_form")=="yes"): 
	
		$this->load->view("modules/stones/create");
	
	 endif; ?>	
	<!--Create category ends here-->
	
	<!--Editor Category start-->
	<?php if($this->input->get("edit_form")=="yes"): 
	
		$this->load->view("modules/stones/edit");
	
	 endif; ?>
	<!---Editor category ends -->
	
	
	<!--Create category-->
	<?php if($this->input->get("subcat_create_form")=="yes"): 
	
		$this->load->view("modules/stones/create_subcat");
	
	 endif; ?>	
	<!--Create category ends here-->
	
	<!--Editor Category start-->
	<?php if($this->input->get("subcat_edit_form")=="yes"): 
	
		$this->load->view("modules/stones/edit_subcat");
	
	 endif; ?>
	<!---Editor category ends -->
	
	<!--Create Item-->
	<?php if($this->input->get("item_create_form")=="yes"): 
	
		$this->load->view("modules/stones/create_items");

	endif; ?>	
	<!--Create Item ends here-->

	<!--Editor Item start-->
	<?php if($this->input->get("item_edit_form")=="yes"): 

		$this->load->view("modules/stones/edit_item");

	endif; ?>
	<!---Editor Item ends -->
	
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Stones</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url("stones/browse?create_form=yes"); ?>"><button class="btn btn-primary">Add Stone Type</button></a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url("stones/browse?subcat_create_form=yes"); ?>"><button class="btn btn-primary">Add Sub Stone Type </button></a></li>
              <li class="breadcrumb-item"><a href="<?php echo site_url("stones/browse?item_create_form=yes"); ?>"><button class="btn btn-primary">Add Stone Item </button></a></li>
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
                <!-- <h3 class="card-title">
				  <div class="left">Showing <?php echo $page_size>sizeof($users)?sizeof($users):$page_size; ?> of <?php echo $total; ?> | Page <?php echo $current_page; ?> of <?php echo $total_pages; ?></div>
	              <div class="right">
					&nbsp;Records Per Page:  &nbsp; <select name="page_size" class="filter-form-select" style="width:60px;" onchange="window.location.href='<?php echo site_url("stones/browse?".$query_string_page_size); ?>&page_size='+$(this).val()">
						<option <?php if($this->input->get("page_size")==25): ?>selected="selected"<?php endif; ?> value="25">25</option>
						<option <?php if($this->input->get("page_size")==50): ?>selected="selected"<?php endif; ?> value="50">50</option>
						<option <?php if($this->input->get("page_size")==100): ?>selected="selected"<?php endif; ?> value="100">100</option>
						<option <?php if($this->input->get("page_size")==250): ?>selected="selected"<?php endif; ?> value="250">250</option>
					</select>
	               </div>
				</h3> -->
				<div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
				        <?php if($prev_page): ?>
							<li class="page-item"><a href="<?php echo site_url("stones/browse?page=".$prev_page_num); ?>" class="page-link">&laquo;</a></li>
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
										<li class="page-item"><a href="<?php echo site_url("stones/browse?page=".($i-1)."&".$query_string_pagination); ?>" class="page-link"><?php echo $i; ?></a></li>
									<?php
								 } else {
									 echo '<li class="page-item"><a class="page-link">&nbsp;'.$i.'&nbsp;</a></li>';
									 }
									
									}
									
						
							
							?>


						<?php if($next_page): ?>
							<li class="page-item"><a href="<?php echo site_url("stones/browse?page=".$next_page_num); ?>" class="page-link">&raquo;</a></li>
						<?php endif; ?>
                    
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" id="">
                  <thead>
                    <tr>
								<th>Stone Name</th>
								<!-- <th>Grams</th>
								<th>Carat</th>
								<th>Numbers</th>
								 -->
								<th>Rate per unit(Rs)</th>
								<th>Unit</th>
								<th>Available Quantity</th>
								<th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php foreach($users as $user): ?>
						  <tr>
						       
								<td colspan="4"><strong><?php echo $user['name']; ?></strong></td>
								
								<td>
									<a href="<?php echo site_url("stones/browse?edit_form=yes&stone_type_id=".$user['id']); ?>" class="" title="Edit"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i></a>
									<a onclick="save(<?php echo $user['id'];?>)" style="color:red;cursor:pointer;margin-left:10px;"><i class="fas fa-trash " style=" font-size:1.3em; position:relative; top:2px; "></i></a> 
								</td>
								
						  </tr>
						  <?php foreach($user['stone_sub_types'] as $subcat): ?>
							<tr>
						       
								<td colspan="4"><?php echo $subcat['name']; ?></td>
								<!--<td><?php echo addPrecision($subcat['grams'], 3) ; ?></td>
								 <td><?php echo $subcat['carat']; ?></td>
								<td><?php echo $subcat['numbers']; ?></td>
								
								<td>Rs.<?php echo addPrecision($subcat['rate'],2); ?></td>
								<td><?php echo $subcat['unit']; ?></td>--> 
								
								<td>
									<a href="<?php echo site_url("stones/browse?subcat_edit_form=yes&stone_subtype_id=".$subcat['id']); ?>" class="" title="Edit"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i></a>
									<a onclick="myDelete(<?php echo $subcat['id'];?>)" style="color:red;cursor:pointer;margin-left:10px;" class=""><i class="fas fa-trash " style=" font-size:1.3em; position:relative; top:2px; "></i></a>
									
								</td>
								
						  </tr>
						  <?php  foreach($subcat['stone_items'] as $stone_item): ?>
							<tr>
						       
								<td>&nbsp;&nbsp;&nbsp;<?php echo $stone_item['name']; ?></td>
								
								<td><?php echo addPrecision($stone_item['rate'],2); ?></td>
								<td><?php echo $stone_item['unit']; ?></td> 
								<td>
									<div class="d-flex flex-row justify-content-between align-items-center">
										<p><?php echo $stone_item['available_quantity']; ?></p>
										<ul class="list-inline">
											<li class="list-inline-item"><a data-toggle="modal" data-target="#addModal" data-backdrop="false" onclick="addMember(<?php echo $stone_item['id']; ?>)" class="btn btn-outline-primary btn-xs"><i class="fa fa-plus"></i></a></li>
											<li class="list-inline-item"><a data-toggle="modal" data-target="#deductModal" data-backdrop="false" onclick="dedMember(<?php echo $stone_item['id']; ?>)" class="btn btn-outline-info btn-xs"><i class="fa fa-minus"></i></a></li>
											<li class="list-inline-item"><a data-toggle="modal" data-target="#transModal" data-backdrop="false" onclick="tranMember(<?php echo $stone_item['id']; ?>)" class="btn btn-outline-info btn-xs">txns</a></li>
										</ul>
									</div>
								</td>
								<td>
									<a href="<?php echo site_url("stones/browse?item_edit_form=yes&stone_item_id=".$stone_item['id']); ?>" class="" title="Edit"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i></a>
									<a onclick="itemDelete(<?php echo $stone_item['id'];?>)" style="color:red;cursor:pointer;margin-left:10px;" class=""><i class="fas fa-trash " style=" font-size:1.3em; position:relative; top:2px; "></i></a>									
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

	<!-- Add Member Model -->
	<div class="modal fade" id="addModal" data-backdrop="static" role="dialog">
      <div class="modal-dialog modal-md modal-dialog-centered" role="document"><!-- Model Dialog -->
        <div class="modal-content sl-modal-content"><!-- Model Content -->                
          <div class="modal-header sl-modal-header"><!-- Model Header -->
            <h5><i class="fa fa-arrows-v" aria-hidden="true"></i> Add Inventory </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div><!-- \Model Header -->
          <div class="modal-body sl-modal-body"> <!-- Model Body -->
            <div class="row tranModal"> <!-- Row -->                    
              <div class="col-md-12"><!-- col-6 -->
			  <form class="form-horizontal" id="addStone" method="post" action="addStones">
                  <div class="col-md-12">
                      <div class="row p-3 addModal">
                          <div class="col-sm-12 mt-3">
                              <div class="form-group">
                                  <label for="sqty" class="control-label">Quantity</label>
                                  <input type="number" step="0.01" class="form-control" id="sqty" name="sqty" placeholder="0">
								  <input type="hidden" step="0.01" class="form-control" id="osqty" name="osqty">
                              </div>
                          </div>
                          <div class="col-sm-12 mt-3">
                              <div class="form-group">
                                  <label for="sremarks" class="control-label">Remarks/Source</label>
                                  <input type="text" class="form-control" id="sremarks" name="sremarks" placeholder="Remarks">
                              </div>
                          </div>                          
                      </div>
                      <div class="row p-4 text-right">
                          <div class="col-md-12">                                            
                            <button type="button" class="mybtn-cancel btn-outline-danger text-danger btn-sm" data-dismiss="modal">Close</button>
                            <input type="submit" name="submit" id="submit" value="Save" class="btn btn-outline-success text-success btn-sm" />
                          </div>
                      </div>
                  </div>
              </form>                                                             
              </div><!-- \col-6 -->                   
            </div><!-- \Row -->
          </div><!-- \Model Body -->  
        </div><!-- \Model Content -->
      </div><!-- \Model Dialog -->
    </div>
    <!-- \Add Member Model -->

	<!-- deduct Member Model -->
	<div class="modal fade" id="deductModal" data-backdrop="static" role="dialog">
      <div class="modal-dialog modal-md modal-dialog-centered" role="document"><!-- Model Dialog -->
        <div class="modal-content sl-modal-content"><!-- Model Content -->                
          <div class="modal-header sl-modal-header"><!-- Model Header -->
            <h5><i class="fa fa-arrows-v" aria-hidden="true"></i> Deduct From Inventory </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div><!-- \Model Header -->
          <div class="modal-body sl-modal-body"> <!-- Model Body -->
            <div class="row tranModal"> <!-- Row -->                    
              <div class="col-md-12"><!-- col-6 -->
			  	<form class="form-horizontal" id="dedStone" method="post" action="deductStones">
                  <div class="col-md-12">
                      <div class="row p-3 addModal">
                          <div class="col-sm-12 mt-3">
                              <div class="form-group">
                                  <label for="dqty" class="control-label">Quantity</label>
                                  <input type="number" step="0.01" class="form-control" id="dqty" name="dqty" placeholder="0">
								  <input type="hidden" step="0.01" class="form-control" id="dsqty" name="dsqty">
                              </div>
                          </div>
                          <div class="col-sm-12 mt-3">
                              <div class="form-group">
                                  <label for="dremarks" class="control-label">Remarks</label>
                                  <input type="text" class="form-control" id="dremarks" name="dremarks" placeholder="Remarks">
                              </div>
                          </div>                          
                      </div>
                      <div class="row p-4 text-right">
                          <div class="col-md-12">                                            
                            <button type="button" class="mybtn-cancel btn-outline-danger text-danger btn-sm" data-dismiss="modal">Close</button>
                            <input type="submit" name="submit" id="submit" value="Save" class="btn btn-outline-success text-success btn-sm" />
                          </div>
                      </div>
                  </div>
              </form>                                                             
              </div><!-- \col-6 -->                   
            </div><!-- \Row -->
          </div><!-- \Model Body -->  
        </div><!-- \Model Content -->
      </div><!-- \Model Dialog -->
    </div>
    <!-- \Add Member Model -->

	<!-- deduct Member Model -->
	<div class="modal fade" id="transModal" data-backdrop="static" role="dialog">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document"><!-- Model Dialog -->
        <div class="modal-content sl-modal-content"><!-- Model Content -->                
          <div class="modal-header sl-modal-header"><!-- Model Header -->
            <h5><i class="fa fa-arrows-v" aria-hidden="true"></i> Inventory Log For - Stone item name</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div><!-- \Model Header -->
          <div class="modal-body sl-modal-body"> <!-- Model Body -->
            <div class="row tranModal"> <!-- Row -->                    
              <div class="col-md-12"><!-- col-6 -->
			          <form class="form-horizontal" id="addInv" method="post" action="deductInventory">
                  <div class="col-md-12" id="trantable">
                    <table id="dtStonetran" class="table table-striped table-bordered nowrap" style="width:100%;">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Quantity</th>
                          <th>Txn Type</th>
                          <th>Remarks</th>
                          <th>Timestamp</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
              </form>                                                             
              </div><!-- \col-6 -->                   
            </div><!-- \Row -->
          </div><!-- \Model Body -->  
        </div><!-- \Model Content -->
      </div><!-- \Model Dialog -->
    </div>
    <!-- \Add Member Model -->

<!-- unknown rows 

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
-->
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
		$.post("<?php echo site_url("stones/mydelete");?>",
		{partner_id:partner_id}, function(data){
			window.location.href="<?php echo site_url("stones/browse"); ?>";
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
		$.post("<?php echo site_url("stones/stoneSubTypeDelete");?>",
		{partner_id:partner_id}, function(data){
			window.location.href="<?php echo site_url("stones/browse"); ?>";
		});
		}
	}
	function itemDelete(partner_id)
	{
		var delete_record = confirm("Are you sure you want to Delete this record?");
		if(delete_record===true){
		$.post("<?php echo site_url("stones/itemDelete");?>",
		{partner_id:partner_id}, function(data){
			window.location.href="<?php echo site_url("stones/browse"); ?>";
		});
		}
	}
	$('#stone_type_id').on('change', function() {
		var carot_type_id = this.value ;
		if(carot_type_id==1){
			$("#carot_div").addClass("d-lg-none");
			$("#cents_div").removeClass("d-lg-none");
		}
		else{
			$("#cents_div").addClass("d-lg-none");
			$("#carot_div").removeClass("d-lg-none");
		}
	});
</script>

<script>
	 //add data
	 function addMember(id = null) {
      if(id) {
        // remove the error 
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-red").remove();
        // remove the id
        $("#member_id").remove();
        // fetch the member data
        $.ajax({
          	url: 'getStones',
            type: 'post',
            data: {member_id : id},
            dataType: 'json',
            success:function(response) {
              $('#osqty').val(response.available_quantity);
              $(".addModal").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');
              $("#addStone").unbind('submit').bind('submit', function() {
              $(".text-red").remove();
              var form = $(this);
              // validation
              var sqty = $("#sqty").val();              

            if(sqty == "0") {
				$("#sqty").closest('.form-group').addClass('has-error');
				$("#sqty").after('<p class="text-red error-text">Please enter quantity!</p>');
            } else {
				$("#sqty").closest('.form-group').removeClass('has-error');
				$("#sqty").closest('.form-group').addClass('has-success');                   
            }               

            if(sqty) {
            $.ajax({
              url: form.attr('action'),
              type: form.attr('method'),
              data: form.serialize(),
              dataType: 'json',
              success:function(response) {
                if(response.success == true) {
                  $(function() {
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top',
                      target:"#addStone",
                      showConfirmButton: false,
                      timer: 3000
                    });
                    Toast.fire({
                      icon: 'success',
                      title: 'Stone Inventory info updated successfully'
                    });
                  });
                //   $('#dtInventory').DataTable().ajax.reload();
                } else {
                  $(function() {
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top',
                      target:"#addStone",
                      showConfirmButton: false,
                      timer: 3000
                    });
                    Toast.fire({
                      icon: 'error',
                      title: 'Ooops! Something went wrong.'
                    });
                  });
                }
              } // /success
            }); // /ajax
          }
          return false;
        });
      }
    });
      } else{
          alert("Error : Refresh the page again");
        }
    }

	//deduct data
	function dedMember(id = null) {
      if(id) {
        // remove the error 
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-red").remove();
        // remove the id
        $("#member_id").remove();
        // fetch the member data
        $.ajax({
          	url: 'getStones',
            type: 'post',
            data: {member_id : id},
            dataType: 'json',
            success:function(response) {
              $('#dsqty').val(response.available_quantity);
              $(".addModal").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');
              $("#dedStone").unbind('submit').bind('submit', function() {
              $(".text-red").remove();
              var form = $(this);
              // validation
              var dqty = $("#dqty").val();              

            if(dqty == "0") {
				$("#dqty").closest('.form-group').addClass('has-error');
				$("#dqty").after('<p class="text-red error-text">Please enter quantity!</p>');
            } else {
				$("#dqty").closest('.form-group').removeClass('has-error');
				$("#dqty").closest('.form-group').addClass('has-success');                   
            }               

            if(dqty) {
            $.ajax({
              url: form.attr('action'),
              type: form.attr('method'),
              data: form.serialize(),
              dataType: 'json',
              success:function(response) {
                if(response.success == true) {
                  $(function() {
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top',
                      target:"#dedStone",
                      showConfirmButton: false,
                      timer: 3000
                    });
                    Toast.fire({
                      icon: 'success',
                      title: 'Stone Inventory info updated successfully'
                    });
                  });
                //   $('#dtInventory').DataTable().ajax.reload();
                } else {
                  $(function() {
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top',
                      target:"#dedStone",
                      showConfirmButton: false,
                      timer: 3000
                    });
                    Toast.fire({
                      icon: 'error',
                      title: 'Ooops! Something went wrong.'
                    });
                  });
                }
              } // /success
            }); // /ajax
          }
          return false;
        });
      }
    });
      } else{
          alert("Error : Refresh the page again");
        }
    }

	//deduct data
	// $(document).ready(function() { 
  function tranMember(id = null) {
    if(id) {
      $("#member_id").remove();      
		var dtStonetran = $('#dtStonetran').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
      "destroy": true,
			"ordering": true,
			"info": true,
			"autoWidth": true,
			"responsive": true,
			"columnDefs": [{ targets: [0], className: 'dt-center valign dt-w3' },
							{ targets: [1,2,3], className: 'dt-left valign dt-w38' },
							{targets: [4], className: 'dt-center dt-w21 valign'}],
			dom: 'Bfrtip',					
				ajax: {
					type: 'POST',
					url: 'dtStonetran',
					data: function(data) {
						data.bid = id
					},
				},
			"order": [] 
		});//Datatable View
    $('#dtStonetran').DataTable().ajax.reload();
      } else{
          alert("Error : Refresh the page again");
        }
    }
  // });
</script>
