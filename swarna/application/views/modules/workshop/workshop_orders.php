<style>
.col_half { width: 49%; }
.col_third { width: 32%; }
.col_fourth { width: 23.5%; }
.col_fifth { width: 18.4%; }
.col_sixth { width: 15%; }
.col_three_fourth { width: 74.5%;}
.col_twothird{ width: 66%;}
.col_half,
.col_third,
.col_twothird,
.col_fourth,
.col_three_fourth,
.col_fifth{
	position: relative;
	display:inline;
	display: inline-block;
	float: left;
	margin-right: 2%;
	margin-bottom: 20px;
}
.end { margin-right: 0 !important; }
/* Column Grids End */

.wrapper {margin: 30px auto; position: relative;}
.counter {
    background-color: #d9e2e6;
    padding: 11px 0;
    border-radius: 5px;
    /* border-top-right-radius: 7px; */
    width: 14%; 
    border: 1px solid #ccc;
}
.count-title { font-size: 17px; font-weight: bold;  margin-top: 10px; margin-bottom: 0; text-align: center; }
.count-text { font-size: 13px; font-weight: normal;  margin-top: 10px; margin-bottom: 0; text-align: center; }
.fa-2x { margin: 0 auto; float: none; display: table; color: #4ad1e5; }
.ot-blk{
    background: #f7f7f7;
	display:inline-grid;
    width: 100%;
    padding: 20px 10px 0px 10px;	
    border-radius:5px;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"> -->
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
    <div class="content-wrapper">
  <section class="content ms-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
<div class="card-header">


<h1 id="workshop_code"><?php echo "workshop ".$id; ?></h1>
        
</div>
<div class="card-body">
			<div class="container mt-4 mb-4">
            <div class="row">
            <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                <div class="box">
                    <h3>Total Orders</h3>
                    <p><?php echo $workshop['no_orders'] ;?></p>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                <div class="box">
                    <h3>No OF J Items</h3>
                    <p><?php echo $workshop['total_items'];?></p>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                <div class="box">
                    <h3>Total GMS</h3>
                    <p><?php echo $workshop['TW_order'];?></p>
                </div>
            </div>
          
            <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-4">
                <div class="box">
                    <h3> completed Order</h3>
                    
					<?php  $count=0; foreach ($status as $row): ?>
            <?php if ($row['status'] == 'completed' ): ?>
				<p> <?php $count++ ; ?></p>	  
            <?php endif; ?>
        <?php endforeach; ?>
		<p> <?php echo $count++ ; ?></p>	
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-4">
                <div class="box">
                    <h3>Assigned Order</h3>
                    <?php  $count=0; foreach ($status as $row): ?>
            <?php if ($row['status'] == 'assigned' ): ?>
				<p> <?php $count++ ; ?></p>	  
            <?php endif; ?>
        <?php endforeach; ?>
		<p> <?php echo $count++ ; ?></p>	  
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-4 col-xl-4 mt-4">
                <div class="box">
                    <h3>Total Customers</h3>
                    <p><?php echo $cust['customer_count']; ?></p>
                </div>
            </div>
          
        </div>
    </div>
</div>

</div>
         </div>
      </div>
    </section>
<!-- --------------------------------section 2--------------------------------------- -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="Orderlist" class="table table-striped table-bordered nowrap" style="width:100%;">			
                    <thead>
                    <tr>
        <th>SI NO</th>
        <th>ORDER NO</th>
        <th>J ITEMS</th>
		<th>GMS</th>
		<th>STATUS</th>
		<th>CUSTOMER</th>
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
   




</div>
 </div>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0-beta3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> 
    

	      
<script>
    $(document).ready(function(){
        // e.preventDefault();
        var id = <?php echo json_encode($id); ?>;
        // var workshop_code = $('#workshop_code').val();
        var postData = {
            id: id,
            
        };
       $('#Orderlist').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "responsive": true,
        "columnDefs":  [{
    "defaultContent": "-",
    "targets": "_all"
  }],
        dom: 'Bfrtit',
        "order": [],
            // Load data from an Ajax source
            "ajax": {
                "url": "<?= base_url('workshop/view_workshop') ?>",
                "type": "POST",
                "data": postData,
                "dataType": 'json',
               
            },
      });
	});
    e.preventDefault();
    function viewod(id = null) {
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