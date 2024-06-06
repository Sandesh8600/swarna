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
	$metal_type = $this->input->get("metal_type");
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
            <h1>Inventory </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!--<li class="breadcrumb-item"><a href="<?php echo site_url("inventory/create"); ?>"><button class="btn btn-primary">Create </button></a></li>-->
              
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
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dtInventory" class="table table-striped table-bordered nowrap" style="width:100%;">			
                    <thead>
                        <tr>
                            <th>Metal ID</th>					          
                            <th>Metal Type </th>
                            <th>Grams</th> 		
                            <th>Updated Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
              </div>              
            </div>
            <!-- /.card -->
         </div>
      </div>
    </section>
    <!-- Add Member Model -->
    <div class="modal fade" id="transModal" data-backdrop="static" role="dialog">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document"><!-- Model Dialog -->
        <div class="modal-content sl-modal-content"><!-- Model Content -->                
          <div class="modal-header sl-modal-header"><!-- Model Header -->
            <h5><i class="fa fa-arrows-v" aria-hidden="true"></i> Transactions </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div><!-- \Model Header -->
          <div class="modal-body sl-modal-body"> <!-- Model Body -->
            <div class="row tranModal"> <!-- Row -->                    
              <div class="col-md-12"><!-- col-6 -->
                <table id="dtMetalInventory" class="table table-striped table-bordered nowrap" style="width:100%; font-size:12px;">			
                  <thead>
                    <tr>
                      <th>ID</th>					          
                      <th>Metal Inventory Id </th>
                      <th>Tran Type</th> 							
                      <th>Grams</th>
                      <th>Rate/Gram (Rs)</th>
                      <th>Remarks</th>
                      <th>Shop/User</th>
                      <th>Timestamp</th>
                    </tr>
                  </thead>
                </table>                                                              
              </div><!-- \col-6 -->                   
            </div><!-- \Row -->
          </div><!-- \Model Body -->  
        </div><!-- \Model Content -->
      </div><!-- \Model Dialog -->
    </div>
    <!-- \Add Member Model -->
    <!-- Edit Member Model -->
    <div class="modal fade" id="editModal" data-backdrop="static" role="dialog">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document"><!-- Model Dialog -->
        <div class="modal-content sl-modal-content"><!-- Model Content -->                
          <div class="modal-header sl-modal-header bg-primary"><!-- Model Header -->
            <h5><i class="fa fa-arrows-v" aria-hidden="true"></i> Edit Inventory Items </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div><!-- \Model Header -->
          <div class="modal-body sl-modal-body"> <!-- Model Body -->
            <div class="row"> <!-- Row -->                    
              <div class="col-md-12"><!-- col-6 -->
                <form class="form-horizontal" id="addInv" method="post" action="editInventory">
                  <div class="col-md-12">
                      <div class="row p-3 editModal">
                          <div class="col-sm-4 mt-3">
                              <div class="form-group">
                                  <label for="edit_metal_type" class="control-label">Metal Type</label>
                                  <select class="form-control" name="edit_metal_type" id="edit_metal_type">
                                      <option value="0">Not Selected</option>
                                      <option value="gold">Gold</option>
                                      <option value="silver">Silver</option>
                                      <option value="platinum">Platinum</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-sm-4 mt-3">
                              <div class="form-group">
                                  <label for="edit_metal_shape" class="control-label">Metal Shape</label>
                                  <select class="form-control" name="edit_metal_shape" id="edit_metal_shape">
                                      <option value="0">Not Selected</option>
                                      <option value="bar">Bar</option>
                                      <option value="biscuit">Biscuit</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-sm-4 mt-3">
                              <div class="form-group">
                                  <label for="edit_metal_purity" class="control-label">Metal Purity %</label>
                                  <input type="number" step="0.01" class="form-control" id="edit_metal_purity" name="edit_metal_purity" placeholder="%">
                              </div>
                          </div>
                      </div>
                      <div class="row pl-3 pr-3">
                          <div class="col-sm-4 mt-3">
                              <div class="form-group">
                                  <label for="edit_gpu" class="control-label">Grams Per Unit</label>
                                  <input type="number" step="0.01" class="form-control" id="edit_gpu" name="edit_gpu" placeholder="0">
                              </div>
                          </div>
                          <div class="col-sm-4 mt-3">
                              <div class="form-group">
                                  <label for="edit_quantity" class="control-label">Quantity</label>
                                  <input type="number" step="0.01" class="form-control" id="edit_quantity" name="edit_quantity" placeholder="0">
                              </div>
                          </div>
                          <div class="col-sm-4 mt-3">
                              <div class="form-group">
                                  <label for="edit_shop_name" class="control-label">Shop Name</label>
                                  <input type="text" class="form-control" id="edit_shop_name" name="edit_shop_name">
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
    <!-- \Edit Member Model -->

    <!-- Deduct Member Model -->
    <div class="modal fade" id="deductModal" data-backdrop="static" role="dialog">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document"><!-- Model Dialog -->
        <div class="modal-content sl-modal-content"><!-- Model Content -->                
          <div class="modal-header sl-modal-header bg-primary"><!-- Model Header -->
            <h5><i class="fa fa-arrows-v" aria-hidden="true"></i> Update Inventory </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div><!-- \Model Header -->
          <div class="modal-body sl-modal-body"> <!-- Model Body -->
            <div class="row"> <!-- Row -->                    
              <div class="col-md-12"><!-- col-6 -->
                <form class="form-horizontal" id="deductInv" method="post" action="updateInventory">
                  <div class="col-md-12">
                      <div class="row p-3 dedModal">                          
                          <div class="col-sm-6 mt-3">
                              <div class="form-group">
                                  <label for="txn_type" class="control-label">Transaction Type</label>
                                   <select class="form-control" id="txn_type" name="txn_type" required>
									   <option value='add'>+ Add</option>
									   <option value='deduct'>- Deduct</option>
                                   </select>                            
                              </div>
                          </div>
                          <div class="col-sm-6 mt-3">
                              <div class="form-group">
                                  <label for="ded_quantity" class="control-label">Grams</label>
                                  <input type="number" step="0.01" class="form-control" id="ded_quantity" name="grams" >
                                  <input type="hidden" step="0.01" class="form-control" id="avb_quantity" >
                              </div>
                          </div>
                          <div class="col-sm-6 mt-3">
                              <div class="form-group">
                                  <label for="ded_quantity" class="control-label">Rate/Gram (Rs)</label>
                                  <input type="number" class="form-control" id="rate_per_gram" name="rate_per_gram" />                                  
                              </div>
                          </div>
                          <div class="col-sm-6 mt-3">
                              <div class="form-group">
                                  <label for="ded_total_gram" class="control-label">Shop/User name</label>
                                  <input type="text" class="form-control" id="shop_user_name" name="shop_user_name" />
                              </div>
                          </div>
                      </div>
                      <div class="row pl-3 pr-3">                          
                          <div class="col-sm-12 mt-3">
                              <div class="form-group">
                                  <label for="ded_Remarks" class="control-label">Remarks</label>
                                  <input type="text" class="form-control" id="ded_Remarks" name="ded_Remarks" placeholder="Remarks">
                              </div>
                          </div>
                      </div>
                      <div class="row p-4 text-right">
                          <div class="col-md-12">                                            
                            <button type="button" id="closeUpdateModal" class="mybtn-cancel btn-outline-danger text-danger btn-sm" data-dismiss="modal">Close</button>
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
    <!-- \Deduct Member Model -->
</div>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<script>
    $(document).ready(function(){
      var dtInventory = $('#dtInventory').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "responsive": true,
        "columnDefs": [],
        dom: 'Bfrtip',
            buttons: [
                {extend:'copy', text:'<i class="fas fa-copy text-info"></i> Copy', titleAttr: 'Copy'}, 
                {extend:'csv', text:'<i class="fas fa-file-excel text-primary"></i> CSV <i class="fas fa-download text-dark"></i>', titleAttr:'csv'}, 
                {extend:'excel', text:'<i class="fas fa-file-excel text-primary"></i> Excel <i class="fas fa-download text-dark"></i>', titleAttr:'excel'}, 
                {extend:'pdf', text:'<i class="fas fa-file-pdf text-danger"></i> PDF <i class="fas fa-download text-dark"></i>', titleAttr:'pdf'}, 
                {extend:'print', text:'<i class="fas fa-print text warning"></i> Print', titleAttr:'print'}
            ], 
        "order": [],
            // Load data from an Ajax source
            "ajax": {
                "url": "dtInventory/",
                "type": "POST"
            },
      });
      //To Select the id of member to delete
      $(document).on('click', '#delete_inventory', function(e){ 
        var memberid = $(this).data('id');
        SwalDelete(memberid);
        e.preventDefault();
      });
    });//end doc ready function
    //Delete Swal popup
    function SwalDelete(memberid){  
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        showLoaderOnConfirm: true,
        preConfirm: function() {
          return new Promise(function(resolve) {                
              $.ajax({
              url: 'delInventory',
              type: 'POST',
                data: {member_id : memberid},
                dataType: 'json'
              })
              .done(function(response){
                  Swal.fire(
                        'Deleted!',
                        response.messages,
                        'success'
                  );
                  $('#dtInventory').DataTable().ajax.reload();
              })
              .fail(function(){
              swal.fire('Oops...', 'Something went wrong !', 'error');
              });
          });
            },
        allowOutsideClick: false
      })  
    }

    //edit data
    function editMember(id = null) {
      if(id) {
        // remove the error 
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-red").remove();
        // remove the id
        $("#member_id").remove();
        // fetch the member data
        $.ajax({
          url: 'getInventory',
            type: 'post',
            data: {member_id : id},
            dataType: 'json',
            success:function(response) {
              $('#edit_metal_type').val(response.metal_type);
              $('#edit_metal_shape').val(response.metal_shape);
              $('#edit_metal_purity').val(response.purity_percent);
              $('#edit_gpu').val(response.grams_per_unit);
              $('#edit_quantity').val(response.quantity);
              $('#edit_shop_name').val(response.purchased_from);
              $(".editModal").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');
              $("#addInv").unbind('submit').bind('submit', function() {
              $(".text-danger").remove();
              var form = $(this);
              // validation
              var edit_metal_type = $("#edit_metal_type").val();
              var edit_metal_shape = $("#edit_metal_shape").val();
              var edit_metal_purity = $("#edit_metal_purity").val();
              var edit_gpu = $("#edit_gpu").val();
              var edit_quantity = $("#edit_quantity").val();
              var edit_shop_name = $("#edit_shop_name").val();

              if(edit_metal_type == "0") {
                    $("#edit_metal_type").closest('.form-group').addClass('has-error');
                    $("#edit_metal_type").after('<p class="text-red error-text">Please select metal type!</p>');
            } else {
                    $("#edit_metal_type").closest('.form-group').removeClass('has-error');
                    $("#edit_metal_type").closest('.form-group').addClass('has-success');                   
            }    
            if(edit_metal_shape == "0") {
                    $("#edit_metal_shape").closest('.form-group').addClass('has-error');
                    $("#edit_metal_shape").after('<p class="text-red error-text">Please select metal shape!</p>');
            } else {
                    $("#edit_metal_shape").closest('.form-group').removeClass('has-error');
                    $("#edit_metal_shape").closest('.form-group').addClass('has-success');                   
            }   
            if(edit_metal_purity == "") {
                    $("#edit_metal_purity").closest('.form-group').addClass('has-error');
                    $("#edit_metal_purity").after('<p class="text-red error-text">Please enter metal purity!</p>');
            } else {
                    $("#edit_metal_purity").closest('.form-group').removeClass('has-error');
                    $("#edit_metal_purity").closest('.form-group').addClass('has-success');                   
            } 
            if(edit_gpu == "") {
                    $("#edit_gpu").closest('.form-group').addClass('has-error');
                    $("#edit_gpu").after('<p class="text-red error-text">Please enter grams per unit!</p>');
            } else {
                    $("#edit_gpu").closest('.form-group').removeClass('has-error');
                    $("#edit_gpu").closest('.form-group').addClass('has-success');                   
            } 
            if(edit_quantity == "") {
                    $("#edit_quantity").closest('.form-group').addClass('has-error');
                    $("#edit_quantity").after('<p class="text-red error-text">Please enter quantity!</p>');
            } else {
                    $("#edit_quantity").closest('.form-group').removeClass('has-error');
                    $("#edit_quantity").closest('.form-group').addClass('has-success');                   
            } 
            if(edit_shop_name == "") {
                    $("#edit_shop_name").closest('.form-group').addClass('has-error');
                    $("#edit_shop_name").after('<p class="text-red error-text">Please enter shop name!</p>');
            } else {
                    $("#edit_shop_name").closest('.form-group').removeClass('has-error');
                    $("#edit_shop_name").closest('.form-group').addClass('has-success');                   
            } 

            if(edit_metal_type && edit_metal_shape && edit_metal_purity && edit_gpu && edit_quantity && edit_shop_name) {
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
                      target:"#addInv",
                      showConfirmButton: false,
                      timer: 3000
                    });
                    Toast.fire({
                      icon: 'success',
                      title: 'Inventory info updated successfully'
                    });
                  });
                  $('#dtInventory').DataTable().ajax.reload();
                } else {
                  $(function() {
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top',
                      target:"#addInv",
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

    $(document).on('change keyup blur','#ded_quantity',function(){
      var qty = $('#ded_quantity').val();
      var totgram = $('#avb_total_gram').val();
      if(qty!='' && totgram!=''){ 
        $('#ded_total_gram').val(qty*totgram);
      }
    });
     //deduct data
     function deductMember(id = null) {
      if(id) {
        // remove the error 
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-red").remove();
        // remove the id
        $("#member_id").remove();
        // fetch the member data
        $.ajax({
          url: 'getInventory',
            type: 'post',
            data: {member_id : id},
            dataType: 'json',
            success:function(response) {
              $('#avb_total_gram').val(response.grams_per_unit);
              $('#avb_quantity').val(response.quantity);
              $(".dedModal").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');
              $("#deductInv").unbind('submit').bind('submit', function() {
              $(".text-red").remove();
              var form = $(this);
              // validation
              var ded_quantity = $("#ded_quantity").val();
              var avb_quantity = $("#avb_quantity").val();
              
            if(ded_quantity == "") {
                    $("#ded_quantity").closest('.form-group').addClass('has-error');
                    $("#ded_quantity").after('<p class="text-red error-text">Please enter quantity!</p>');
            } else {
                    $("#ded_quantity").closest('.form-group').removeClass('has-error');
                    $("#ded_quantity").closest('.form-group').addClass('has-success');                   
            } 
            
            txn_type=$('#txn_type').val();
            
            if(txn_type=='deduct'){
				if(ded_quantity>avb_quantity) {
						$("#ded_quantity").closest('.form-group').addClass('has-error');
						$("#ded_quantity").after('<p class="text-red error-text">Quantity is more!</p>');
				} else {
						$("#ded_quantity").closest('.form-group').removeClass('has-error');
						$("#ded_quantity").closest('.form-group').addClass('has-success');                   
				}
			}

            if(ded_quantity) {
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
                      target:"#deductInv",
                      showConfirmButton: false,
                      timer: 3000
                    });
                    Toast.fire({
                      icon: 'success',
                      title: 'Inventory Updated successfully'
                    });
                  });
                  $('#dtInventory').DataTable().ajax.reload();
                  $('#closeUpdateModal').trigger('click');
                } else {
                  $(function() {
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top',
                      target:"#deductInv",
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
     
    //trans data
    function transMember(id = null) {
      if(id) {
        // remove the error 
        $(".form-group").removeClass('has-error').removeClass('has-success');
        $(".text-red").remove();
        // remove the id
        $("#member_id").remove();
        // fetch the member data
        $.ajax({
          url: 'getInventory',
          type: 'post',
          data: {member_id : id},
          dataType: 'json',
          success:function(response) {              
            $(".tranModal").append('<input type="hidden" name="member_id" id="member_id" value="'+response.id+'"/>');
          }
        });
      } else{
        alert("Error : Refresh the page again");
      }
    }
    
    //trans data
    function transMember(id = null) {
    if(id) {
      $("#member_id").remove();      
		var dtMetalInventory = $('#dtMetalInventory').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
      "destroy": true,
			"ordering": true,
			"info": true,
			"autoWidth": true,
			"responsive": true,
			"columnDefs": [],
			dom: 'Bfrtip',					
				ajax: {
					type: 'POST',
					url: 'dtMetalInventory',
					data: function(data) {
						data.bid = id
					},
				},
			"order": [] 
		});//Datatable View
    $('#dtMetalInventory').DataTable().ajax.reload();
      } else{
          alert("Error : Refresh the page again");
        }
    }
</script>

 

