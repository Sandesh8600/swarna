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

.wrapper {margin: 10px auto; position: relative;}
.counter {
    background-color: #d9e2e6;
    padding: 11px 0;
    border-radius: 5px;
    /* border-top-right-radius: 7px; */
    width: 14%; 
    border: 1px solid #ccc;
}
.count-title { font-size: 22px; font-weight: bold;  margin-top: 10px; margin-bottom: 0; text-align: center; }
.count-text { font-size: 13px; font-weight: normal;  margin-top: 10px; margin-bottom: 0; text-align: center; }
.fa-2x { margin: 0 auto; float: none; display: table; color: #4ad1e5; }
.ot-blk{
    background: #f7f7f7;
	display:inline-grid;
    width: 100%;
    padding: 20px 10px 0px 10px;	
    border-radius:5px;
}
.col_fourth {
    position: relative;
    display: inline;
    display: inline-block;
    float: left;
    margin-right: 2%;
    margin-bottom: 10px;
}
</style>
<style>
.c-store-features {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.c-store-features__feature {
    flex: 1;
    min-width: 200px;
    max-width: 330px;
    margin: 30px 20px 50px 20px;
    font-size: 14px;
    color: #555;
    text-align: center;
}
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}
#myImg:hover{
    opacity:0.5;
}
fieldset, img {
    border: 0;
}
img {
    vertical-align: middle;
}
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    padding-top: 10px;
    padding-bottom:80px;
    left: 0;
    top: 0;
    width: 85%;
    height: 90%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.9);
}
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}
.modal-content, #caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}
.modal-content {
    margin: auto;
    display: block;
    /* width: 80%;
    max-width: 700px; */
}
fieldset, img {
    border: 0;
}
img {
    vertical-align: middle;
}
</style>

<?php
$this->db->select("*");
$this->db->from("orders");
$this->db->where("Order_Code",$this->session->userdata('viewtask_id'));
$order = $this->db->get()->row();
// print_r($order->Product_Code);
?>

<?php
if($order->Product_Code)
{
    $this->db->select("p.*");
    $this->db->from("products p");
    $this->db->where("p.Product_Code",$order->Product_Code);
    $product = $this->db->get()->row();
    // print_r($product);



    
$this->db->select("p.*,items.*");
$this->db->from("productitems p");
$this->db->join("items","items.Item_Code = p.Item_Code");
$this->db->where("Order_Code",$this->session->userdata('viewtask_id'));
$productitems = $this->db->get();
// print_r($productitems);



} 

if($order->Customer_Code)
{
$this->db->select("*");
$this->db->from("customers");
$this->db->where("Customer_Code",$order->Customer_Code);
$customer = $this->db->get()->row();
// print_r($customer);
}
?>

<?php
$this->db->select("*");
$this->db->from("pricebreakup");
$this->db->where("Order_Code",$this->session->userdata('viewtask_id'));
$pricebreak = $this->db->get()->row();

    $this->db->select("*");
	$this->db->from("orderstatus");
	$this->db->order_by('Status_id','desc');
	$this->db->where("Order_Code",$this->session->userdata('viewtask_id'));
	$getstat = $this->db->get();
    if($getstat->row())
    {
    $stat=$getstat->row();
    }else{
        $stat = array('Status'=>'none');
        $stat = (object) $stat;
    }
    // print_r($stat);
    ?>

	<style>
@media print
{
  .module-block
  {
    display: none;
  }
  #header{
	  display:none;
  }
  #drawer-menu{
	display:none;
  }
  .conn{
      display:none;
  }
}
@media (min-width: 992px){
.col-lg-2 {
    -webkit-flex: 0 0 16.666667%;
    -ms-flex: 0 0 16.666667%;
    flex: 0 0 20%;
    max-width: 20%;
}
}

	</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>View Order #<?php echo $this->session->userdata('viewtask_id');?></h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">	        <a href="<?php echo site_url("order/browse"); ?>" class="btn btn-primary">Back to Orders</a>
                  </li>
              
               </ol>

          </div>
          
        </div>

        <div class="row">
          <div class="col-lg-2 col-5">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>₹ <?php echo $pricebreak->Grand_Total;?></h3>

                <p>Grand Total</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-5">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $pricebreak->Discount_On_Selling_Price;?><sup style="font-size: 20px">%</sup></h3>

                <p>Discount</p>
              </div>
              <div class="icon">
                 <i class="ion ion-pie-graph"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-5">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>₹ <?php echo $pricebreak->SubTotal;?></h3>

                <p>SubTotal</p>
              </div>
              <div class="icon">
              <i class="ion ion-bag"></i>

              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-2 col-5">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>₹ <?php echo $pricebreak->TodaysRatePerGram_ID;?></h3>

                <p>Rate Per Gram</p>
              </div>
              <div class="icon">
                 <i class="ion ion-stats-bars"></i>

              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-2 col-5">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php if($stat->Status){ echo $stat->Status; }?></h3>

                <p>Order Status</p>
              </div>
              <div class="icon">
                 <i class="fa fa-times-circle"></i>

              </div>
              
            </div>
          </div>
          <!-- ./col -->
        </div>


      </div><!-- /.container-fluid -->
    </section>
<!-- search content -->





<!-- Main content Products-->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                Products #<?php echo $this->session->userdata('viewtask_id');?>
				</h3>
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
                                <th><a>Product ID <i class="fas fa-sort-down"></a></th>
								<th><a>Product&nbsp;Stock Number <i class="fas fa-sort-down"></a></th>
								<th><a>Product&nbsp; Name <i class="fas fa-sort-down"></a></th>
                                <th><a>Gold weight in gm's <i class="fas fa-sort-down"></a></th>
                                <th><a>Items <i class="fas fa-sort-down"></a></th>

								<th><a>Action</a></th>
                    </tr>
                  </thead>
                  <tbody>
						  <tr>
                          <td><?php echo $product->Product_Code ?></td>
								<td><?php echo $product->Product_Stock_No ?></td>
								<td><?php echo $product->Product_Brand_Name ?></td>
								<td><?php echo $pricebreak->WeightInGram ?>g</td>

                                <td>
                                    <table>
                                        <tr style="background: #fff;">
                                           <th><a>Item Name <i class="fas fa-sort-down"></a></th>
								           <th><a>Item Weight <i class="fas fa-sort-down"></a></th>
								           <th><a>Item Price <i class="fas fa-sort-down"></a></th>
                                        </tr>
                                        <?php foreach($productitems->result() as $rows){?>

                                        <tr>
                                            <td><?php echo $rows->Item_Name ?></td>
								            <td><?php echo $rows->ProductItem_WeightInGram ?>g</td>
								            <td>₹<?php echo $rows->ProductItem_Price ?></td>
                                        </tr>
                                        <?php }?>
                                    </table>

                                </td>
                                <td>
									<!-- <a href="<?php echo site_url("products/edit/".$product->Product_Code); ?>" class="" title="Edit Membership"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i>Edit</a> -->
									<form action="<?php echo site_url("products/submitid"); ?>" method="post">
									<input type="hidden" value="<?php echo $product->Product_Code;?>" name="typeid">
									<button type="submit" style="border:none;background:transparent;color:blue;cursor:pointer;">Gallery</button>
									</form>
									
								</td>

								
						  </tr>
				  
                  </tbody>
                </table>
    <div id='create-form' style="margin-top:60px;">
            <h1 class='h1-title'>Gallery</h1>
            <?php
            $this->db->select("*");
            $this->db->from("productimages");
            $this->db->where("Product_Code",$product->Product_Code);
            $query = $this->db->get();
            ?>
            <section class="c-store-features">
            <?php
            foreach($query->result() as $row)
            {
                echo '<article class="c-store-features__feature">
                <img class="myImg" id="myImg" src='.base_url($row->ProductImage).' alt="Snow" style="width:100%;max-width:300px">
                </article>';
            }
            ?>
            
          </section>
    </div>
    <!-- The Modal -->
<div id="myModal" class="modal" style="margin-top: 58px;margin-left: 210px;">
  <span class="close" style="cursor:pointer;z-index: 999;">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
              </div>
              
            </div>
            <!-- /.card -->
         </div>
      </div>
    </section>




<!-- unknown rows -->





<!-- Main content Products-->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                Customer #<?php echo $order->Customer_Code;?>
				</h3>
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
                                <th><a>Customer ID <i class="fas fa-sort-down"></a></th>
								<th><a>Customer Name <i class="fas fa-sort-down"></a></th>
								<th><a>Email <i class="fas fa-sort-down"></a></th>
                                <th><a>Address <i class="fas fa-sort-down"></a></th>
                                <th><a>Landline No. <i class="fas fa-sort-down"></a></th>
                                <th><a>Mobile No.1 <i class="fas fa-sort-down"></a></th>
                                <th><a>Mobile No.2 <i class="fas fa-sort-down"></a></th>
                    </tr>
                  </thead>
                  <tbody>
						  <tr>
                                <td><?php echo $customer->Customer_Code ?></td>
								<td><?php echo $customer->Customer_Name ?></td>
								<td><?php echo $customer->Customer_Email ?></td>
								<td><?php echo $customer->Customer_Billing_address ?></td>
								<td><?php echo $customer->Customer_Phone_Number ?></td>
								<td><?php echo $customer->Customer_Mobile_Number1 ?></td>
								<td><?php echo $customer->Customer_Mobile_Number2 ?></td>

								
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = jQuery('.myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.click(function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
});

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>

 <script>
  // Used to toggle the menu on small screens when clicking on the menu button
    function myFunction() {
      var x = document.getElementById("navDemo");
      var y = document.getElementById("x_mark");
      var close = document.getElementById("y_mark");
      var show = '<i class="fa fa-bars" id="x_mark"></i>';
      var z = '<i class="fa fa-close" id="y_mark" style="font-size:18px;"></i>';
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        y.outerHTML = z;
      } else { 

        x.className = x.className.replace(" w3-show", "");
        close.outerHTML = show;
      }
    }

    
   
	</script>


<?php
    $query=$this->db->query("select u.*,workshops.*,orders.*,tasktype.* from taskstoworkshop u join workshops ON workshops.Workshop_Code = u.Workshop_Code join orders ON orders.Order_Code = u.Order_Code 
    join tasktype ON tasktype.TaskType_Id = u.TaskType_Id where u.Order_code=".$this->session->userdata('viewtask_id')."");
    $results=$query->result();
    // print_r($results);
    ?>


<!-- Main content Products-->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                View Tasks
				</h3>
				<div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                  <li class="breadcrumb-item"><a href="<?php echo site_url("viewtask/create"); ?>" class="btn btn-primary">Add Tasks</a>
				    </li>    
                    
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                                <th><a>Task ID <i class="fas fa-sort-down"></a></th>
								<th><a>Task&nbsp;Name <i class="fas fa-sort-down"></a></th>
								<th><a>Workshop&nbsp;Code <i class="fas fa-sort-down"></a></th>
                                <th><a>Task Description <i class="fas fa-sort-down"></a></th>
                                <th><a>Task Status <i class="fas fa-sort-down"></a></th>

                                <th><a>Start Date <i class="fas fa-sort-down"></a></th>
                                <th><a>End Date <i class="fas fa-sort-down"></a></th>
								<th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($results as $res){?>
						  <tr>
								<td><?php echo $res->Task_Id ?></td>
								<td><?php echo $res->Task_Title ?></td>
								<td><?php echo $res->Workshop_Name ?>/<?php echo $res->Workshop_Code ?></td>
								<td><?php echo $res->Task_Description ?></td>
                                <td>
									<?php if($res->Task_Status==1): ?>
									<i class="fa fa-play-circle" style=" font-size:1.3em; position:relative; top:2px; color:#9c3;" title='In Progress'></i> In Progress
									<?php else: ?>
									<i class="fa fa-times-circle" style=" font-size:1.3em; position:relative; top:2px; color:#ffa5a5;" title='Closed'></i> Closed
									<?php endif; ?>
									
								</td>
								<td><?php echo $res->Start_Date ?></td>
								<td><?php echo $res->End_Date ?></td>
								
                                <td>
									<a href="<?php echo site_url("viewtask/edit/".$res->Task_Id); ?>" class="" title="Edit Membership"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i>Edit</a>
									
								</td>

								 
                            </tr>
                            <?php }?>
				  
                  </tbody>
                </table>
                
              </div>
              
            </div>
            <!-- /.card -->
         </div>
      </div>
    </section>



    <!-- end -->

    <?php
    $this->db->select("*");
	$this->db->from("orderstatus");
	$this->db->where("Order_Code",$this->session->userdata('viewtask_id'));
	$status = $this->db->get();
    $stat=$status->result();
    // print_r($results);
    ?>





<!-- Main content Products-->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                Update Status
				</h3>
				<div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                  <li class="breadcrumb-item"><a href="<?php echo site_url("order/update"); ?>" class="btn btn-primary">Update</a>
				    </li>    
                    
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                               <th><a>Status ID <i class="fas fa-sort-down"></a></th>
								<th><a>Status <i class="fas fa-sort-down"></a></th>
								<th><a>Description <i class="fas fa-sort-down"></a></th>
								<th><a>Admin Name <i class="fas fa-sort-down"></a></th>
                                <th><a>Time <i class="fas fa-sort-down"></a></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($stat as $resstat){?>
						  <tr>
								<td><?php echo $resstat->Status_id ?></td>
								<td><?php echo $resstat->Status ?></td>
								<td><?php echo $resstat->Description ?></td>
								<td><?php echo $resstat->admin_name ?></td>
								<td><?php echo $resstat->Timestamp ?></td>
                                

								 
                            </tr>
                            <?php }?>
				  
                  </tbody>
                </table>
                
              </div>
              
            </div>
            <!-- /.card -->
         </div>
      </div>
    </section>



    <!-- end -->

    <?php
    $querys=$this->db->query("select u.*,workshops.*,taskstoworkshop.* from golddepositeticket u join workshops ON workshops.Workshop_Code = u.Workshop_Code join taskstoworkshop ON taskstoworkshop.Task_Id = u.Task_Id 
    where u.Order_code=".$this->session->userdata('viewtask_id')."");
    $result=$querys->result();
    // print_r($result);
    ?>




    


<!-- Main content Products-->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                Gold Deposit Ticket
				</h3>
				<div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                  <li class="breadcrumb-item"><a href="<?php echo site_url("Golddeposit/create"); ?>" class="btn btn-primary">Deposit Gold</a>
				    </li>    
                    
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                    <th><a>Ticket ID <i class="fas fa-sort-down"></a></th>
								<th><a>Workshop&nbsp;Name/ID <i class="fas fa-sort-down"></a></th>
								<th><a>Deposite Gold In Grams <i class="fas fa-sort-down"></a></th>
                                <th><a>Task Title/Id <i class="fas fa-sort-down"></a></th>
                                <th><a>Ticket_title <i class="fas fa-sort-down"></a></th>

                                <th><a>Ticket Description <i class="fas fa-sort-down"></a></th>
                                <th><a>Ticket Priority <i class="fas fa-sort-down"></a></th>
                                <th><a>Status <i class="fas fa-sort-down"></a></th>

								<th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($result as $ress){?>
						  <tr>
								<td><?php echo $ress->Ticket_Id ?></td>
								<td><?php echo $ress->Workshop_Name ?>/<?php echo $ress->Workshop_Code ?></td>
								<td><?php echo $ress->Deposite_GoldInGrams ?></td>
								<td><?php echo $ress->Task_Title ?>/<?php echo $ress->Task_Id ?></td>
								<td><?php echo $ress->Ticket_title ?></td>
								<td><?php echo $ress->Ticket_Description ?></td>
								<td><?php echo $ress->Ticket_Priority ?></td>

								
                                <td>
									<?php if($ress->Ticket_Status==1): ?>
									<i class="fa fa-play-circle" style=" font-size:1.3em; position:relative; top:2px; color:#9c3;" title='In Progress'></i> In Progress
									<?php else: ?>
									<i class="fa fa-times-circle" style=" font-size:1.3em; position:relative; top:2px; color:#ffa5a5;" title='Closed'></i> Closed
									<?php endif; ?>
									
								</td>
								
                                <td>
									<a href="<?php echo site_url("Golddeposit/edit/".$ress->Ticket_Id); ?>" class="" title="Edit Membership"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i>Edit</a>
									
								</td>

								 
                            </tr>
                            <?php }?>
				  
                  </tbody>
                </table>
                
              </div>
              
            </div>
            <!-- /.card -->
         </div>
      </div>
    </section>



    <!-- end -->

    <?php
    $query1=$this->db->query("select u.* from payments u 
    where u.Order_code=".$this->session->userdata('viewtask_id')."");
    $result1=$query1->result();
    // print_r($result);
    ?>



    
<!-- Main content Products-->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                Payment Transactions
                      <span style="color:red">&nbsp;&nbsp;&nbsp;Total Gold Received : <?php $b=0; foreach($result1 as $res1){ $b = $res1->Quantity+$b; } echo $b;?>g</span>
                      <span style="color:red">&nbsp;&nbsp;&nbsp;Total Amount(INR) : ₹<?php $c=0; foreach($result1 as $res1){ $c = $res1->Amount+$c; } echo $c;?></span>
				</h3>
				<div class="card-tools">
                  <ul class="pagination pagination-sm float-right">
                  <li class="breadcrumb-item"><a href="<?php echo site_url("payment/create"); ?>" class="btn btn-primary">Add Transaction</a>
				    </li>    
                    
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                    <th><a>Payment Code <i class="fas fa-sort-down"></a></th>
								
								<th><a>Payment Date <i class="fas fa-sort-down"></a></th>
                                <th><a>Payment Method <i class="fas fa-sort-down"></a></th>

                                <th><a>Gold in Grams  <i class="fas fa-sort-down"></a></th>
                                <th><a>Metal/Puriity <i class="fas fa-sort-down"></a></th>
                                <th><a>Percentage <i class="fas fa-sort-down"></a></th>

                                <th><a>Amount <i class="fas fa-sort-down"></a></th>
                                <th><a>Estimated Gold <i class="fas fa-sort-down"></a></th>
                                <th><a>Payment Status <i class="fas fa-sort-down"></a></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($result1 as $res1){?>
						  <tr>
								<td><?php echo $res1->Payment_code ?></td>
								
								<td><?php echo $res1->Date_Of_Order ?></td>
								
								<td style="color:red;"><?php echo $res1->Payment_Method ?></td>
                                <td><?php echo $res1->Quantity ?>g</td>
                                <td><?php echo $res1->Percentage ?>%</td>
								<td>₹<?php echo $res1->purity ?>/g</td>
								<td>₹<?php echo $res1->Amount ?></td>

								<td><?php echo $res1->Total_gold ?>g</td>
								
                                <td>
									<?php if($res1->Payment_Status==1): ?>
									<i class="fa fa-play-circle" style=" font-size:1.3em; position:relative; top:2px; color:#9c3;" title='In Progress'></i> In Complete
									<?php else: ?>
									<i class="fa fa-times-circle" style=" font-size:1.3em; position:relative; top:2px; color:#ffa5a5;" title='Closed'></i> Received
									<?php endif; ?>
									
								</td>
								
                                <!-- <td>
									<a href="<?php echo site_url("payment/edit/".$res1->Payment_code); ?>" class="" title="Edit Membership"><i class="fas fa-pencil-alt" style=" font-size:1.3em; position:relative; top:2px; color:#ffb800;"></i>Edit</a>
									
								</td> -->

								 
                            </tr>
                            <?php }?>
				  
                  </tbody>
                </table>

                <div class="form-row" style="text-align: center !important;margin: auto;width: max-content;margin-top: 30px;">
              <div class="form-column">
                <label class="radio-label" style="font-size:24px;">Bill Type</label>
                <select name="bill" id="bill" class="form-select valid" aria-invalid="false">
						<option>Select Bill Type</option>
						<option>Print Invoice</option>		        
						<option>Print Estimated</option>		        
                </select>
                </div>
                <div class="clear"></div>
            </div>
            <script>
            $('#bill').change(function(){
                if(this.value == 'Print Invoice')
                {
                    $('#p_invoice').css('display','block');
                    $('#p_bill').css('display','none');
                    $('.popbill').css('display','none');
                }
                if(this.value == 'Print Estimated')
                {
                    $('#p_invoice').css('display','none');
                    $('#p_bill').css('display','block');
                    $('.popbill').css('display','block');

                }
            });
            </script>
			<div class="form-row" style="text-align: center !important;margin: auto;width: max-content;margin-top: 30px;">
                <a href="#popup_estimated"> <button type="button" class="form-button bg-green" id="p_bill" style="font-size:20px;display:none;">Print Estimated</button>
				</a>
					      
				<a href="#popup_invoice"> <button type="button" class="form-button bg-green" id="p_invoice" style="font-size:20px;display:none;">Print Invoice</button>
				</a>
                <div class="clear"></div>
			</div>
                
              </div>
              
            </div>
            <!-- /.card -->
         </div>
      </div>
    </section>



    <!-- end -->

















<script>
function myPrint()
{
    
    window.print();
}
</script>

<style>
.form-row {
	display:flex;
    /* width: max-content; */
    margin: auto;
}
.head{
	font-size:17px;
	font-weight:600;
	color:#444;
}
.trow{
	background-color:#fff!important;
	border:none;
}
.trow td{
	border:none;
}
.close {
	position: absolute;
	top: 10px;
	right: 20px;
	transition: all 200ms;
	font-size: 30px;
	font-weight: bold;
	text-decoration: none;
	color: #333;
  }
  
  .overlay {
	position: fixed;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	background: rgba(0, 0, 0, 0.7);
	visibility: hidden;
	opacity: 0;
	z-index:999;
  }
  .overlay:target {
	visibility: visible;
	opacity: 1;
  }


  
  .popup {
	margin: 10px auto;
	padding: 40px;
	background: #fff;
	border-radius: 5px;
	width:95%;
	height:95%;
	position: relative;
	overflow-y: hidden;
	/* transition: all 5s ease-in-out; */
	
  }
  
  .popup h2 {
	margin-top: 0;
	color: #333;
	font-family: Tahoma, Arial, sans-serif;
  }
  .popup .close {
	position: absolute;
	top: 10px;
	right: 20px;
	transition: all 200ms;
	font-size: 30px;
	font-weight: bold;
	text-decoration: none;
	color: #333;
  }
  .popup .close:hover {
	color: rgb(56, 21, 255);
  }
  .popup .content {
	max-height: 100%;
	overflow-y: scroll;
  }
.table1 {display:block; }
.rows1 { display:block;}
.cell1 {display:inline-block;}
</style>



<div id="popup_invoice" class="overlay" style="height:100%;z-index: 99999;">
            <div class="popup models_pop-up" style="margin-top:0px;height:100%;overflow-y:scroll;">
            
              <a class="close closure" href="#">×</a>
              
            
            
		<button type="button" class="form-button bg-green" onclick="myPrint()" name="submit" style="font-size:20px;"><i class='fas fa-print'></i></button>
        
  <div class="module-title-section printing_module" style="margin: 20px;padding-bottom:40px;">

    <div class="module-content-section" data-aos="fade-up">
         
                <div class="fit-form">
				    <div class="form-row" style="width:100%;text-align:center;background:red;">
                        <div class="form-column" style="width:max-content;">
                            <h2 class="radio-label" style="font-size:25px!important;color:#fff;text-align:center;padding:15px;">Swarna Jewellers</h2>
                       </div>
                       <div class="form-column" style="width:max-content;margin:auto;">
                            <h2 class="radio-label" style="font-size:25px!important;color:#fff;text-align:center;padding:15px;">Invoice</h2>
                       </div>
                       <div class="form-column" style="width:max-content;float:right;padding:15px;">
                      <?php $this->load->helper('date');
		                    $c_date = date("d-m-Y");?>

                          <a style="color:#fff;font-weight:600;font-size:16px;">Date : </a>
                          <a style="color:#fff;"><?php echo $c_date;?></a>
                       </div>
                       <div class="clear"></div>
                       
                    </div>

                    <div class="form-row" style="padding-top:10px;">
                        <label class="radio-label">Address :</label><a>&nbsp;#901, Tower9, Prestige Bhagamane Temple Bell, R.r Nagar, Bangalore, 560098</a>
                        <div class="clear"></div>
                    </div>
                    <div class="form-row" style="padding-bottom:10px;">
                        <label class="radio-label">GSTIN :</label><a>&nbsp;1GSTIN4BNG105SWARNA</a>
                        <div class="clear"></div>
                    </div>

                    <div class="form-row" style="width:100%;display:flex;">
                        <div class="table1" style="width:100%;border:1px solid #000;padding:30px 10px;">
                            <div class="rows1" style="margin-left:20px;">
                                <h2 class="radio-label" style="font-size:20px!important;">Customer Details #<?php echo $customer->Customer_Code ?></h2>
                                <div class="cell1" style="font-size:17px;font-weight:600;min-width:80px;">Name </div>
                                <div class="cell1" style="font-size:17px;font-weight:600;">: </div>
                                <div class="cell1" style="font-size:17px;font-weight:500;"><?php echo $customer->Customer_Name ?></div>
                            </div>
                            <div class="rows1" style="margin-left:20px;">
                                <div class="cell1" style="font-size:17px;font-weight:600;min-width:80px;">Address </div>
                                <div class="cell1" style="font-size:17px;font-weight:600;">: </div>

                                <div class="cell1" style="font-size:17px;font-weight:500;"><?php echo $customer->Customer_Billing_address ?></div>
                            </div>
                            <div class="rows1" style="margin-left:20px;">
                                <div class="cell1" style="font-size:17px;font-weight:600;min-width:80px;">Pincode </div>
                                <div class="cell1" style="font-size:17px;font-weight:600;">: </div>

                                <div class="cell1" style="font-size:17px;font-weight:500;"><?php echo $customer->Customer_Pincode ?></div>
                            </div>
       
                        </div>
                        
                        <div class="clear"></div>
                    </div>

                    <div class="form-row" style="width:100%;display:flex;">
                        <div class="table1" style="width:100%;border:1px solid #000;min-height:150px;">
                            <div class="rows1" style="border-bottom:1px solid #000;width: 100%;display: flex;">
                                <div class="cell radio-label" style="flex:1;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Description</div>
                                <div class="cell radio-label" style="width:10%;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Quantity</div>
                                <div class="cell radio-label" style="width:10%;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Rate</div>
                                <div class="cell radio-label" style="width:20%;padding-left:30px;padding:10px;margin:0;">Amount</div>
                            
                            </div>

                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;">Gold Weight</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;"><?php echo $pricebreak->WeightInGram ?>g</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">₹<?php echo $pricebreak->TodaysRatePerGram_ID ?></div>
                                <div class="cell1" style="width:20%;padding:10px;margin:0;">₹<?php $price=$pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram;
                                echo $pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram ?></div>
                            
                            </div>
                            <?php $gold = $pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram;
                            $k=0; 
                            $v=0;
                             foreach($productitems->result() as $rows){
                                 $v=$k;
                                $k++;
                                }?>
                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;font-weight:600;">Items</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">-----</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">-----</div>
                                <div class="cell1" style="width:20%;padding:10px;margin:0;">-----</div>
                            </div>
                           
                            <?php $k=0; $s=0; foreach($productitems->result() as $rows){?>
                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;"><?php echo $rows->Item_Name ?></div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;"><?php echo $rows->ProductItem_WeightInGram ?>g</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">₹<?php echo $rows->ProductItem_Price ?></div>
                                <div class="cell1" style="width:20%;padding:10px;margin:0;"><?php $k=$rows->ProductItem_Price+$k; if($v == $s){ echo '₹'.$k;} ?></div>
                            </div>
                            <?php $s++; }?>

                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;font-weight:600;">---------------</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">-----</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">-----</div>
                                <div class="cell1" style="width:20%;padding:10px;margin:0;">-----</div>
                            </div>
                            
<!--                             
                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;">Gold GST</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">-</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;"><?php echo $pricebreak->Gold_GSTInPercent ?>%</div>
                                <div class="cell1" style="width:20%;padding:10px;border-right:1px solid #000;margin:0;">₹<?php $gst = (($pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram)*$pricebreak->Gold_GSTInPercent)/100;
                                echo (($pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram)*$pricebreak->Gold_GSTInPercent)/100; ?></div>
                            
                            </div>

                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;">Making Charges</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">-</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;"><?php echo $pricebreak->Making_ChargesInPercent ?>%</div>
                                <div class="cell1" style="width:20%;padding:10px;border-right:1px solid #000;margin:0;">₹<?php $m=(($k+$gold)*$pricebreak->Making_ChargesInPercent)/100;
                                echo (($k+$gold)*$pricebreak->Making_ChargesInPercent)/100; ?></div>
                            
                            </div>

                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;">Making Charges GST</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">-</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;"><?php echo $pricebreak->Making_Charge_GSTInPercent ?>%</div>
                                <div class="cell1" style="width:20%;padding:10px;border-right:1px solid #000;margin:0;">₹<?php $m_gst=((($k+$gold)*$pricebreak->Making_ChargesInPercent)/100*$pricebreak->Making_Charge_GSTInPercent)/100; 
                                echo ((($k+$gold)*$pricebreak->Making_ChargesInPercent)/100*$pricebreak->Making_Charge_GSTInPercent)/100; ?></div>
                            
                            </div> -->

                            <div class="rows1" style="width: 100%;display: flex;border-bottom:1px solid #000;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;">Wastage</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;"><?php echo $pricebreak->WeightOfWastageInGram ?>g</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">₹<?php echo $pricebreak->Wastage_total ?></div>
                                <div class="cell1" style="width:20%;padding:10px;"></div>
                            
                            </div>
                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;margin:0;"></div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;font-weight:600;">Total</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;"><?php $tots = $k+$price;?></div>
                                <div class="cell1" style="width:20%;padding:10px;">₹<?php echo $tots;?></div>
                            
                            </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-row" style="width:100%;display:flex;">
                        <div class="table1" style="width:55%;min-height:150px;">
                            <div class="form-row" style="margin:unset;">
                                <div class="form-column">
                                    <h2 class="radio-label" style="font-size:16!important">Terms & Conditions</h2>
                                </div>
                            </div>
                            <div class="form-row" style="margin:unset;">
                                <div class="form-column">
                                    <h2 style="font-size:15px!important">1. ________________________________________</h2>
                                </div>
                            </div>
                            <div class="form-row" style="margin:unset;">
                                <div class="form-column">
                                    <h2 style="font-size:15px!important">2. ________________________________________</h2>
                                </div>
                            </div>
                            <div class="form-row" style="margin:unset;">
                                <div class="form-column">
                                    <h2 style="font-size:15px!important">3. ________________________________________</h2>
                                </div>
                            </div>
                        </div>
                        <div class="table1" style="width:45%;min-height:150px;">
                            <div class="rows1" style="border:1px solid #000;width: 100%;display: flex;">
                                <div class="cell radio-label" style="flex:1;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">GST(gold+items)</div>
                                <div class="cell radio-label" style="width:27%;padding-left:30px;padding:10px;margin:0;border-right:1px solid #000;"><?php echo $pricebreak->Gold_GSTInPercent ?>%</div>
                                <div class="cell radio-label" style="width:40%;padding-left:30px;padding:10px;margin:0;">₹<?php $gst = ($tots*$pricebreak->Gold_GSTInPercent)/100;
                                echo ($tots*$pricebreak->Gold_GSTInPercent)/100; ?></div>
                                
                            </div>
                            <div class="rows1" style="border:1px solid #000;width: 100%;display: flex;">
                                <div class="cell radio-label" style="flex:1;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Making Charges</div>
                                <div class="cell radio-label" style="width:27%;padding-left:30px;padding:10px;margin:0;border-right:1px solid #000;"><?php echo $pricebreak->Making_ChargesInPercent ?>%</div>
                                <div class="cell radio-label" style="width:40%;padding-left:30px;padding:10px;margin:0;">₹<?php $m=(($k+$gold)*$pricebreak->Making_ChargesInPercent)/100;
                                echo (($k+$gold)*$pricebreak->Making_ChargesInPercent)/100; ?></div>
                                
                            </div>
                            <div class="rows1" style="border:1px solid #000;width: 100%;display: flex;">
                                <div class="cell radio-label" style="flex:1;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Making Charges GST</div>
                                <div class="cell radio-label" style="width:27%;padding-left:30px;padding:10px;margin:0;border-right:1px solid #000;"><?php echo $pricebreak->Making_Charge_GSTInPercent ?>%</div>
                                <div class="cell radio-label" style="width:40%;padding-left:30px;padding:10px;margin:0;">₹<?php $m_gst=((($k+$gold)*$pricebreak->Making_ChargesInPercent)/100*$pricebreak->Making_Charge_GSTInPercent)/100; 
                                echo ((($k+$gold)*$pricebreak->Making_ChargesInPercent)/100*$pricebreak->Making_Charge_GSTInPercent)/100; ?></div>
                                
                            </div>
                            <div class="rows1" style="border:1px solid #000;width: 100%;display: flex;">
                                <div class="cell radio-label" style="flex:1;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Sub Total</div>
                                <div class="cell radio-label" style="width:27%;padding-left:30px;padding:10px;margin:0;border-right:1px solid #000;">=</div>
                                <div class="cell radio-label" style="width:40%;padding-left:30px;padding:10px;margin:0;">₹<?php $sub_tot=$tots+$gst+$m+$m_gst; echo $tots+$gst+$m+$m_gst; ?></div>
                                
                            </div>
                            <div class="rows1" style="border:1px solid #000;width: 100%;display: flex;">
                                <div class="cell radio-label" style="flex:1;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Discount</div>
                                <div class="cell radio-label" style="width:27%;padding-left:30px;padding:10px;margin:0;border-right:1px solid #000;"><?php echo $pricebreak->Discount_On_Selling_Price ?>%</div>
                                <div class="cell radio-label" style="width:40%;padding-left:30px;padding:10px;margin:0;">₹<?php $dis=(($sub_tot)*$pricebreak->Discount_On_Selling_Price)/100; 
                                $dis = number_format($dis, 2, '.', '');
                                echo $dis; ?></div>
                                
                            </div>

                            <div class="rows1" style="border:1px solid #000;width: 100%;display: flex;background: #cdfccd;">
                                <div class="cell radio-label" style="flex:1;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Grand Total</div>
                                <div class="cell radio-label" style="width:27%;padding-left:30px;padding:10px;margin:0;"></div>
                                <div class="cell radio-label" style="width:40%;padding-left:30px;padding:10px;margin:0;">₹<?php echo round($sub_tot-$dis);?></div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-row" style="width:100%;display:flex;margin-top:40px;margin-bottom:60px;margin-left:50px;">
                                <div class="form-column">
                                    <h2 class="radio-label" style="font-size:16!important">Signature</h2>
                                </div>
                    </div>

					
					<!-- End Product -->

                    
                    <!-- <div class="form-row blocks-right">
					      <input type="submit" class="form-button bg-green" name="submit" value="Submit">
					      <button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('http://3dcopilot.com/manage.3dcopilot.com/admin/browse');"><i class="fas fa-arrow-left" aria-hidden="true"></i> Go Back</button>
					
				     <div class="clear"></div>
			        </div> -->
                </div>
          
     </div>
</div>
</div>
</div>



<div id="popup_estimated" class="overlay" style="height:100%;z-index: 99999;">
            <div class="popup models_pop-up" style="margin-top:0px;height:100%;overflow-y:scroll;">
            
              <a class="close closure" href="#">×</a>
              
            
            
		<button type="button" class="form-button bg-green" onclick="myPrint()" name="submit" style="font-size:20px;"><i class='fas fa-print'></i></button>
        
  <div class="module-title-section printing_module" style="margin: 20px;padding-bottom:40px;">

    <div class="module-content-section" data-aos="fade-up">
         
                <div class="fit-form">
				    <div class="form-row" style="width:100%;text-align:center;background:red;">
                        <div class="form-column" style="width:max-content;">
                            <h2 class="radio-label" style="font-size:25px!important;color:#fff;text-align:center;padding:15px;">Swarna Jewellers</h2>
                       </div>
                       <div class="form-column" style="width:max-content;margin:auto;">
                            <h2 class="radio-label" style="font-size:25px!important;color:#fff;text-align:center;padding:15px;">Estimated</h2>
                       </div>
                       <div class="form-column" style="width:max-content;float:right;padding:15px;">
                      <?php $this->load->helper('date');
		                    $c_date = date("d-m-Y");?>

                          <a style="color:#fff;font-weight:600;font-size:16px;">Date : </a>
                          <a style="color:#fff;"><?php echo $c_date;?></a>
                       </div>
                       <div class="clear"></div>
                       
                    </div>

                    <div class="form-row" style="padding:10px;">
                        <label class="radio-label">Address :</label><a>&nbsp;#901, Tower9, Prestige Bhagamane Temple Bell, R.r Nagar, Bangalore, 560098</a>
                        <div class="clear"></div>
                    </div>
                    <!-- <div class="form-row" style="padding-bottom:10px;">
                        <label class="radio-label">GSTIN :</label><a>&nbsp;1GSTIN4BNG105SWARNA</a>
                        <div class="clear"></div>
                    </div> -->

                    <div class="form-row" style="width:100%;display:flex;">
                        <div class="table1" style="width:100%;border:1px solid #000;padding:30px 10px;">
                            <div class="rows1" style="margin-left:20px;">
                                <h2 class="radio-label" style="font-size:20px!important;">Customer Details #<?php echo $customer->Customer_Code ?></h2>
                                <div class="cell1" style="font-size:17px;font-weight:600;min-width:80px;">Name </div>
                                <div class="cell1" style="font-size:17px;font-weight:600;">: </div>
                                <div class="cell1" style="font-size:17px;font-weight:500;"><?php echo $customer->Customer_Name ?></div>
                            </div>
                            <div class="rows1" style="margin-left:20px;">
                                <div class="cell1" style="font-size:17px;font-weight:600;min-width:80px;">Address </div>
                                <div class="cell1" style="font-size:17px;font-weight:600;">: </div>

                                <div class="cell1" style="font-size:17px;font-weight:500;"><?php echo $customer->Customer_Billing_address ?></div>
                            </div>
                            <div class="rows1" style="margin-left:20px;">
                                <div class="cell1" style="font-size:17px;font-weight:600;min-width:80px;">Pincode </div>
                                <div class="cell1" style="font-size:17px;font-weight:600;">: </div>

                                <div class="cell1" style="font-size:17px;font-weight:500;"><?php echo $customer->Customer_Pincode ?></div>
                            </div>
       
                        </div>
                        
                        <div class="clear"></div>
                    </div>

                    <div class="form-row" style="width:100%;display:flex;">
                        <div class="table1" style="width:100%;border:1px solid #000;min-height:150px;">
                            <div class="rows1" style="border-bottom:1px solid #000;width: 100%;display: flex;">
                                <div class="cell radio-label" style="flex:1;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Description</div>
                                <div class="cell radio-label" style="width:10%;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Quantity</div>
                                <div class="cell radio-label" style="width:10%;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Rate</div>
                                <div class="cell radio-label" style="width:20%;padding-left:30px;padding:10px;margin:0;">Amount</div>
                            
                            </div>

                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;">Gold Weight</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;"><?php echo $pricebreak->WeightInGram ?>g</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">₹<?php echo $pricebreak->TodaysRatePerGram_ID ?></div>
                                <div class="cell1" style="width:20%;padding:10px;margin:0;">₹<?php $price=$pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram;
                                echo $pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram ?></div>
                            
                            </div>
                            <?php $gold = $pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram;
                            $k=0; 
                            $v=0;
                             foreach($productitems->result() as $rows){
                                 $v=$k;
                                $k++;
                                }?>
                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;font-weight:600;">Items</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">-----</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">-----</div>
                                <div class="cell1" style="width:20%;padding:10px;margin:0;">-----</div>
                            </div>
                           
                            <?php $k=0; $s=0; foreach($productitems->result() as $rows){?>
                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;"><?php echo $rows->Item_Name ?></div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;"><?php echo $rows->ProductItem_WeightInGram ?>g</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">₹<?php echo $rows->ProductItem_Price ?></div>
                                <div class="cell1" style="width:20%;padding:10px;margin:0;"><?php $k=$rows->ProductItem_Price+$k; if($v == $s){ echo '₹'.$k;} ?></div>
                            </div>
                            <?php $s++; }?>

                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;font-weight:600;">---------------</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">-----</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">-----</div>
                                <div class="cell1" style="width:20%;padding:10px;margin:0;">-----</div>
                            </div>
                            
<!--                             
                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;">Gold GST</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">-</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;"><?php echo $pricebreak->Gold_GSTInPercent ?>%</div>
                                <div class="cell1" style="width:20%;padding:10px;border-right:1px solid #000;margin:0;">₹<?php $gst = (($pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram)*$pricebreak->Gold_GSTInPercent)/100;
                                echo (($pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram)*$pricebreak->Gold_GSTInPercent)/100; ?></div>
                            
                            </div>

                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;">Making Charges</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">-</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;"><?php echo $pricebreak->Making_ChargesInPercent ?>%</div>
                                <div class="cell1" style="width:20%;padding:10px;border-right:1px solid #000;margin:0;">₹<?php $m=(($k+$gold)*$pricebreak->Making_ChargesInPercent)/100;
                                echo (($k+$gold)*$pricebreak->Making_ChargesInPercent)/100; ?></div>
                            
                            </div>

                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;">Making Charges GST</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">-</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;"><?php echo $pricebreak->Making_Charge_GSTInPercent ?>%</div>
                                <div class="cell1" style="width:20%;padding:10px;border-right:1px solid #000;margin:0;">₹<?php $m_gst=((($k+$gold)*$pricebreak->Making_ChargesInPercent)/100*$pricebreak->Making_Charge_GSTInPercent)/100; 
                                echo ((($k+$gold)*$pricebreak->Making_ChargesInPercent)/100*$pricebreak->Making_Charge_GSTInPercent)/100; ?></div>
                            
                            </div> -->

                            <div class="rows1" style="width: 100%;display: flex;border-bottom:1px solid #000;">
                                <div class="cell1" style="flex:1;padding:10px;border-right:1px solid #000;margin:0;">Wastage</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;"><?php echo $pricebreak->WeightOfWastageInGram ?>g</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;">₹<?php echo $pricebreak->Wastage_total ?></div>
                                <div class="cell1" style="width:20%;padding:10px;"></div>
                            
                            </div>
                            <div class="rows1" style="width: 100%;display: flex;">
                                <div class="cell1" style="flex:1;padding:10px;margin:0;"></div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;font-weight:600;">Total</div>
                                <div class="cell1" style="width:10%;padding:10px;border-right:1px solid #000;margin:0;"><?php $tots = $k+$price;?></div>
                                <div class="cell1" style="width:20%;padding:10px;">₹<?php echo $tots;?></div>
                            
                            </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-row" style="width:100%;display:flex;">
                        <div class="table1" style="width:55%;min-height:150px;">
                            <div class="form-row" style="margin:unset;">
                                <div class="form-column">
                                    <h2 class="radio-label" style="font-size:16!important">Terms & Conditions</h2>
                                </div>
                            </div>
                            <div class="form-row" style="margin:unset;">
                                <div class="form-column">
                                    <h2 style="font-size:15px!important">1. ________________________________________</h2>
                                </div>
                            </div>
                            <div class="form-row" style="margin:unset;">
                                <div class="form-column">
                                    <h2 style="font-size:15px!important">2. ________________________________________</h2>
                                </div>
                            </div>
                            <div class="form-row" style="margin:unset;">
                                <div class="form-column">
                                    <h2 style="font-size:15px!important">3. ________________________________________</h2>
                                </div>
                            </div>
                        </div>
                        <div class="table1" style="width:45%;min-height:150px;">
                            <div class="rows1" style="border:1px solid #000;width: 100%;display: flex;">
                                <div class="cell radio-label" style="flex:1;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">GST(gold+items)</div>
                                <div class="cell radio-label" style="width:27%;padding-left:30px;padding:10px;margin:0;border-right:1px solid #000;"><?php echo $pricebreak->Gold_GSTInPercent ?>%</div>
                                <div class="cell radio-label" style="width:40%;padding-left:30px;padding:10px;margin:0;">₹<?php $gst = ($tots*$pricebreak->Gold_GSTInPercent)/100;
                                echo ($tots*$pricebreak->Gold_GSTInPercent)/100; ?></div>
                                
                            </div>
                            <div class="rows1" style="border:1px solid #000;width: 100%;display: flex;">
                                <div class="cell radio-label" style="flex:1;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Making Charges</div>
                                <div class="cell radio-label" style="width:27%;padding-left:30px;padding:10px;margin:0;border-right:1px solid #000;"><?php echo $pricebreak->Making_ChargesInPercent ?>%</div>
                                <div class="cell radio-label" style="width:40%;padding-left:30px;padding:10px;margin:0;">₹<?php $m=(($k+$gold)*$pricebreak->Making_ChargesInPercent)/100;
                                echo (($k+$gold)*$pricebreak->Making_ChargesInPercent)/100; ?></div>
                                
                            </div>
                            <div class="rows1" style="border:1px solid #000;width: 100%;display: flex;">
                                <div class="cell radio-label" style="flex:1;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Making Charges GST</div>
                                <div class="cell radio-label" style="width:27%;padding-left:30px;padding:10px;margin:0;border-right:1px solid #000;"><?php echo $pricebreak->Making_Charge_GSTInPercent ?>%</div>
                                <div class="cell radio-label" style="width:40%;padding-left:30px;padding:10px;margin:0;">₹<?php $m_gst=((($k+$gold)*$pricebreak->Making_ChargesInPercent)/100*$pricebreak->Making_Charge_GSTInPercent)/100; 
                                echo ((($k+$gold)*$pricebreak->Making_ChargesInPercent)/100*$pricebreak->Making_Charge_GSTInPercent)/100; ?></div>
                                
                            </div>
                            <div class="rows1" style="border:1px solid #000;width: 100%;display: flex;">
                                <div class="cell radio-label" style="flex:1;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Sub Total</div>
                                <div class="cell radio-label" style="width:27%;padding-left:30px;padding:10px;margin:0;border-right:1px solid #000;">=</div>
                                <div class="cell radio-label" style="width:40%;padding-left:30px;padding:10px;margin:0;">₹<?php $sub_tot=$tots+$gst+$m+$m_gst; echo $tots+$gst+$m+$m_gst; ?></div>
                                
                            </div>
                            <div class="rows1" style="border:1px solid #000;width: 100%;display: flex;">
                                <div class="cell radio-label" style="flex:1;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Discount</div>
                                <div class="cell radio-label" style="width:27%;padding-left:30px;padding:10px;margin:0;border-right:1px solid #000;"><?php echo $pricebreak->Discount_On_Selling_Price ?>%</div>
                                <div class="cell radio-label" style="width:40%;padding-left:30px;padding:10px;margin:0;">₹<?php $dis=(($sub_tot)*$pricebreak->Discount_On_Selling_Price)/100; 
                                $dis = number_format($dis, 2, '.', '');
                                echo $dis; ?></div>
                                
                            </div>

                            <div class="rows1" style="border:1px solid #000;width: 100%;display: flex;background: #cdfccd;">
                                <div class="cell radio-label" style="flex:1;padding-left:30px;padding:10px;border-right:1px solid #000;margin:0;">Grand Total</div>
                                <div class="cell radio-label" style="width:27%;padding-left:30px;padding:10px;margin:0;"></div>
                                <div class="cell radio-label" style="width:40%;padding-left:30px;padding:10px;margin:0;">₹<?php echo round($sub_tot-$dis);?></div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-row" style="width:100%;display:flex;margin-top:40px;margin-bottom:60px;margin-left:50px;">
                                <div class="form-column">
                                    <h2 class="radio-label" style="font-size:16!important">Signature</h2>
                                </div>
                    </div>

					
					<!-- End Product -->

                    
                    <!-- <div class="form-row blocks-right">
					      <input type="submit" class="form-button bg-green" name="submit" value="Submit">
					      <button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('http://3dcopilot.com/manage.3dcopilot.com/admin/browse');"><i class="fas fa-arrow-left" aria-hidden="true"></i> Go Back</button>
					
				     <div class="clear"></div>
			        </div> -->
                </div>
          
     </div>
</div>
</div>
</div>





<div id="popup_bill" class="overlay" style="height:100%">
            <div class="popup models_pop-up popbill" style="margin-top:0px;height:100%;overflow-y:scroll;">
            
              <a class="close closure" href="#">×</a>
              
            
            
		<button type="button" class="form-button bg-green" onclick="myPrint()" name="submit" style="font-size:20px;"><i class='fas fa-print'></i></button>
        
  <div class="module-title-section printing_module" style="margin: 20px;padding-bottom:40px;">

    <div class="module-content-section" data-aos="fade-up">
         <form method="POST" enctype="multipart/form-data" action="#">
                <div class="fit-form">

				    <div class="form-row">
                        <div class="form-column">
                            <h2 class="radio-label" style="font-size:20px!important">Swarna Jewellers</h2>
                       </div>
                    </div>
					<div class="form-row">
                        <div class="form-column" style="display:flex;">
                            <label class="radio-label" style="font-size:16px!important;">Customer Details</label>
						</div>
                    </div>
					<div class="table-container" style="width: max-content;margin: auto;">
					<table>
					   <tr class="trow">
					      <td class="radio-label">Customer ID</td><td class="radio-label">#<?php echo $customer->Customer_Code ?></td>
					   </tr>
					   <tr class="trow">
					      <td class="radio-label">Customer Name</td><td class="radio-label"><?php echo $customer->Customer_Name ?></td>
					   </tr>
					   
					</table>
					</div>
					<div class="form-row">
                        <div class="form-column">
                            <h2 class="radio-label">------------------------------------------------------------------------</h2>
                        
                       </div>
                    </div>
					<!-- End Customer -->

					<div class="form-row">
                        <div class="form-column" style="display:flex;">
                            <label class="radio-label" style="font-size:16px!important;">Product Details</label>
						</div>
                    </div>
					<div class="table-container" style="width: max-content;margin: auto;">
					<table>
					   <tr class="trow">
					      <td class="radio-label">Product ID</td><td class="radio-label">#<?php echo $product->Product_Code ?></td>
					   </tr>
					   <tr class="trow">
					      <td class="radio-label">Product Name</td><td class="radio-label"><?php echo $product->Product_Brand_Name ?></td>
					   </tr>
					   
					</table>
					</div>
					<div class="form-row">
                        <div class="form-column">
                            <h2 class="radio-label">------------------------------------------------------------------------</h2>
                        
                       </div>
                    </div>
					<!-- End Product -->



					
					<div class="form-row">
                        <div class="form-column" style="display:flex;">
                            <label class="radio-label" style="font-size:16px!important;">Items Details</label>
						</div>
                    </div>
					<div class="table-container" style="width: max-content;margin: auto;">
					<table>
                                        <tr style="background: #fff;">
                                           <th><a>Item Name</a></th>
								           <th><a>Item Weight</a></th>
								           <th><a>Item Price</a></th>
                                        </tr>
                                        <?php foreach($productitems->result() as $rows){?>

                                        <tr>
                                            <td><?php echo $rows->Item_Name ?></td>
								            <td><?php echo $rows->ProductItem_WeightInGram ?>g</td>
								            <td>₹<?php echo $rows->ProductItem_Price ?></td>
                                        </tr>
                                        <?php }?>
                    </table>
					</div>
					<div class="form-row">
                        <div class="form-column">
                            <h2 class="radio-label">------------------------------------------------------------------------</h2>
                        
                       </div>
                    </div>
					<!-- End Items -->

					<div class="form-row">
                        <div class="form-column" style="display:flex;">
                            <label class="radio-label" style="font-size:16px!important;">Order Details</label>
						</div>
                    </div>
					<div class="table-container" style="width: max-content;margin: auto;">
					<table>
					   <tr class="trow">
					      <td class="radio-label">Order ID</td><td class="radio-label">#<?php echo $this->session->userdata('viewtask_id');?></td>
					   </tr>
					   <?php
    $this->db->select("*");
	$this->db->from("orderstatus");
	$this->db->order_by('Status_id','desc');
	$this->db->where("Order_Code",$this->session->userdata('viewtask_id'));
	$getstat = $this->db->get();
    // $stat=$getstat->row();
    if($getstat->row())
    {
    $stat=$getstat->row();
    }else{
        $stat = array('Status'=>'none');
        $stat = (object) $stat;
    }
    // print_r($stat);
    ?>
					   <tr class="trow">
					      <td class="radio-label">Order Status</td><td class="radio-label">#<?php if($stat->Status){ echo $stat->Status; }?></td>
					   </tr>
					   
					   
					</table>
					</div>
					<div class="form-row">
                        <div class="form-column">
                            <h2 class="radio-label">------------------------------------------------------------------------</h2>
                        
                       </div>
                    </div>
					<!-- End Status -->
                    <div class="form-row">
                        <div class="form-column" style="display:flex;">
                            <label class="radio-label" style="font-size:16px!important;">Payment Transactions</label>
						</div>
                    </div>
                    <div class="table-container" style="width: max-content;margin: auto;">
					<table>
                    <?php $amount = 0;
                    foreach($result1 as $res1){?>
					   
                       <tr class="trow">
					      <td class="radio-label">Gold Recived</td><td class="radio-label"><?php echo $res1->Quantity ?>g</td>
					   </tr>
                       <tr class="trow">
					      <td class="radio-label">Purity Percentage</td><td class="radio-label"><?php echo $res1->Percentage ?>%</td>
					   </tr>
                       <tr class="trow">
					      <td class="radio-label">Total Gold</td><td class="radio-label"><?php echo $res1->Total_gold ?>g</td>
					   </tr>
                       <tr class="trow">
					      <td class="radio-label">Amount Received</td><td class="radio-label">₹<?php echo $res1->Amount ?></td>
					   </tr>
                    <?php $amount = $res1->Amount+$amount;
                }?>

                       
                    </table>
                    </div>


                    <div class="form-row">
                        <div class="form-column">
                            <h2 class="radio-label">------------------------------------------------------------------------</h2>
                        
                       </div>
                    </div>

					
					<div class="form-row">
                        <div class="form-column" style="display:flex;">
                            <label class="radio-label" style="font-size:16px!important;">Payment Details</label>
						</div>
                    </div>
					<div class="table-container" style="width: max-content;margin: auto;">
					<table>
					   <tr class="trow">
					      <td class="radio-label">Gold Weight</td><td class="radio-label"><?php echo $pricebreak->WeightInGram ?>g</td>
					   </tr>
					   
					   <tr class="trow">
					      <td class="radio-label">Rate Per Grams</td><td class="radio-label">₹<?php echo $pricebreak->TodaysRatePerGram_ID ?></td>
					   </tr>
					   <tr class="trow">
					      <td class="radio-label">Total Gold Rate</td><td class="radio-label">₹<?php echo $pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram ?></td>
					   </tr>
                       <tr class="trow">
					      <td class="radio-label">Gold GST In Percent(<?php echo $pricebreak->Gold_GSTInPercent ?>%)</td>
						  
                          <td class="radio-label">₹<?php echo (($pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram)*$pricebreak->Gold_GSTInPercent)/100; ?></td>
					   </tr>
                       <tr class="trow">
					      <td class="radio-label">Total Gold(Rate+GST)</td>
						  <td class="radio-label">₹<?php echo $pricebreak->Gold_Total ?></td>
                          <!-- <td class="radio-label">₹<?php echo (($pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram)*$pricebreak->Gold_GSTInPercent)/100; ?></td> -->
					   </tr>
					   <tr class="trow">
					      <td class="radio-label">Making Charges In Percent(Gold+Items)</td>
						  <td class="radio-label"><?php echo $pricebreak->Making_ChargesInPercent ?>%</td>
                          <!-- <td class="radio-label">₹<?php echo (($pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram)*$pricebreak->Making_ChargesInPercent)/100; ?></td> -->
					   </tr>
					   <tr class="trow">
					      <td class="radio-label">Making Charge GST In Percent</td>
                          <td class="radio-label"><?php echo $pricebreak->Making_Charge_GSTInPercent ?>%</td>
						  <!-- <td class="radio-label">₹<?php echo  (((($pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram)*$pricebreak->Making_ChargesInPercent)/100)*$pricebreak->Making_Charge_GSTInPercent)/100; ?></td> -->
					   </tr>

                       <tr class="trow">
					      <td class="radio-label">Making Charge Total(Charge+GST)</td>
                          <td class="radio-label">₹<?php echo $pricebreak->Making_total ?></td>
						  <!-- <td class="radio-label">₹<?php echo  (((($pricebreak->TodaysRatePerGram_ID*$pricebreak->WeightInGram)*$pricebreak->Making_ChargesInPercent)/100)*$pricebreak->Making_Charge_GSTInPercent)/100; ?></td> -->
					   </tr>
					   
					   <!-- <tr class="trow">
					      <td class="radio-label">Customs Duty In Percent(<?php echo $product->CustomsDutyInPercent;?>%)</td>
						  <td class="radio-label">₹<?php echo (($product->TodaysRatePerGram_ID*$product->WeightInGram)*$product->CustomsDutyInPercent)/100; ?></td>
					   </tr> -->
                       <tr class="trow">
					      <td class="radio-label">Wastage</td><td class="radio-label"><?php echo $pricebreak->WeightOfWastageInGram ?>g</td>
					   </tr>
                       <tr class="trow">
					      <td class="radio-label">Wastage Price</td><td class="radio-label">₹<?php echo $pricebreak->Wastage_total ?></td>
					   </tr>
					  
					   <tr class="trow">
					      <td class="radio-label">SubTotal</td><td class="radio-label">₹<?php echo $pricebreak->SubTotal ?></td>
					   </tr>
					   <tr class="trow">
					      <td class="radio-label">Discount</td><td class="radio-label"><?php echo $pricebreak->Discount_On_Selling_Price ?>%</td>
					   </tr>
					   <tr class="trow">
					      <td class="radio-label">Total</td><td class="radio-label">₹<?php echo $pricebreak->Grand_Total ?></td>
					   </tr>

                       <tr class="trow">
					      <td class="radio-label">Remaining </td><td class="radio-label">₹<?php echo $pricebreak->Grand_Total-$amount;?></td>
					   </tr>
					   
					</table>
					</div>
					<div class="form-row">
                        <div class="form-column">
                            <h2 class="radio-label">------------------------------------------------------------------------</h2>
                        
                       </div>
                    </div>

					<div class="form-row">
                        <div class="form-column" style="display:flex;">
                            <label class="radio-label" style="font-size:16px!important;">Thanks For Shopping</label>
						</div>
                    </div>
					<!-- End Product -->

                    
                    <!-- <div class="form-row blocks-right">
					      <input type="submit" class="form-button bg-green" name="submit" value="Submit">
					      <button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('http://3dcopilot.com/manage.3dcopilot.com/admin/browse');"><i class="fas fa-arrow-left" aria-hidden="true"></i> Go Back</button>
					
				     <div class="clear"></div>
			        </div> -->
                </div>
          </form>
     </div>
</div>
</div>
</div>


</div></div></div></div>
</section>
</div>