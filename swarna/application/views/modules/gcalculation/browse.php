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
            <h1>Gold Calculation </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url("GoldCalculation/create"); ?>"><button class="btn btn-primary">Create Gold Melting</button></a></li>
              
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
                <table id="dtGoldCalculation" class="table table-striped table-bordered nowrap" style="width:100%;">			
                    <thead>
                        <tr>
                            <th>ID</th>					          
                            <th>Final Gold</th>
                            <th>Less in pure grm</th>
                            <th>Copper gms</th>
                            <th>Melting Loss</th>
                            <th>Created On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
              </div>              
            </div>
            <!-- /.card -->
         </div>
      </div>
    </section>
    
   
    <!-- View Gold Calculation model Model -->
    <div class="modal fade" id="GcViewModal" data-backdrop="static" role="dialog">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document"><!-- Model Dialog -->
        <div class="modal-content sl-modal-content"><!-- Model Content -->                
          <div class="modal-header sl-modal-header bg-primary"><!-- Model Header -->
            <h5><i class="fa fa-arrows-v" aria-hidden="true"></i> Gold Calculation #<span id='show-gc-id'></span> </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div><!-- \Model Header -->
          <div class="modal-body sl-modal-body"> <!-- Model Body -->
            <div class="row"> <!-- Row -->                    
              <div class="col-md-12"><!-- col-6 -->
                <div  id="show-gc">
                  gc details here
                 </div>                                                            
              </div><!-- \col-6 -->                   
            </div><!-- \Row -->
          </div><!-- \Model Body -->  
        </div><!-- \Model Content -->
      </div><!-- \Model Dialog -->
    </div>
    <!-- \Edit Member Model -->

    
</div>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<script>
    $(document).ready(function(){
      var dtGoldCalculation = $('#dtGoldCalculation').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "responsive": true,
        "columnDefs": [{ targets: [0], className: 'dt-center valign dt-w3' },
                        { targets: [1,2,3,4,5], className: 'dt-left valign dt-w25' },
                        {targets: [6], className: 'dt-center dt-w22 valign'}],
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
                "url": "dtGoldCalculation/",
                "type": "POST"
            },
      });
      //To Select the id of member to delete
      $(document).on('click', '#delete_gc', function(e){ 
        var gold_calculation_id = $(this).data('id');
        GcDelete(gold_calculation_id);
        e.preventDefault();
      });
    });//end doc ready function
    //Delete Swal popup
    function GcDelete(gold_calculation_id){  
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
              url: 'delGoldCalculation',
              type: 'POST',
                data: {gold_calculation_id : gold_calculation_id},
                dataType: 'json'
              })
              .done(function(response){
                  Swal.fire(
                        'Deleted!',
                        response.messages,
                        'success'
                  );
                  $('#dtGoldCalculation').DataTable().ajax.reload();
              })
              .fail(function(){
              swal.fire('Oops...', 'Something went wrong !', 'error');
              });
          });
            },
        allowOutsideClick: false
      })  
    }

    

    $(document).on('change keyup blur','#ded_quantity',function(){
      var qty = $('#ded_quantity').val();
      var totgram = $('#avb_total_gram').val();
      if(qty!='' && totgram!=''){ 
        $('#ded_total_gram').val(qty*totgram);
      }
    });
    
     
    //trans data
    function viewGC(id = null) {
    if(id) {
		
		$('#show-gc-id').html(id)
      
		$.post('<?php echo site_url('GoldCalculation/getGc'); ?>', {gold_calculation_id:id}, function(data){
			
			$('#show-gc').html(data);
			
		});
		
      } else{
          alert("Error : Refresh the page again");
        }
    }
</script>

 

