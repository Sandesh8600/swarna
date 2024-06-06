<?php
$this->db->select("*");
$this->db->from("customers");
$query = $this->db->get();

?>

<?php
$this->db->select("*");
$this->db->from("products");
$queryp = $this->db->get();

?>

<?php 

$this->db->select("*");
$this->db->from("metalorpurity");
$querypurity = $this->db->get();
?>

<?php
$this->db->select("*");
$this->db->from("items");
$queryitems = $this->db->get();

?>

<?php 
$this->db->select("*");
$this->db->from("productitems");
$this->db->where("Order_Code",$user['Order_Code']);
$queryproductitems = $this->db->get();
?>



<?php
$this->db->select("*");
$this->db->from("orderstatustrack");
$orderstatus = $this->db->get();

?>

<?php
$countquery = $this->db->where("Order_Code",$user['Order_Code'])
->count_all_results('productitems');
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
$(document).ready(function () {
//change selectboxes to selectize mode to be searchable
   $("select").select2();
});
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Order Info</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
<!-- search content -->
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
				<div class="card-body">
	<div  class="" data-aos="fade-up">
	
<div id='edit-form'>
<!-- <h1 class='h1-title'></h1> -->
<div class="form-div">
	
	<div class="validation-errors"><?php echo validation_errors(); ?></div>
	<form action="<?php echo site_url("order/edit/".$user['Order_Code']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="User_id" value="<?php echo $user['Order_Code']; ?>" />
		<div class="form-block">

		    <div class="form-row">
				<div class="form-column">
					<label class="radio-label">Rate Per Gram</label>
					<input type="text" class="form-input" name="rate_id" placeholder="Rate Per Gram" minlength='1' maxlength='50' value="<?php echo set_value('making',$user['TodaysRatePerGram_ID']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>

		    <div class="form-row" style="width:100%;display:flex;">
				<div class="form-column">
					<label class="radio-label">Customer Name</label>
			        <select name="customer_id" class="form-select valid" required="" aria-invalid="false">
						
						<?php
						foreach($query->result() as $row)
                          {
							  if($row->Customer_Code == $user['Customer_Code'])
							  {
							      echo '<option value='.$row->Customer_Code.'>'.$row->Customer_Name.'('.$row->Customer_Code.')</option>';
							  }
						  }
						  ?>
						  <?php
						foreach($query->result() as $row)
                          {
							  if($row->Customer_Code != $user['Customer_Code'])
							  {
							      echo '<option value='.$row->Customer_Code.'>'.$row->Customer_Name.'('.$row->Customer_Code.')</option>';
							  }
						  }
						?>
			        </select>
					
				</div>

				<div class="form-column">
					<label class="radio-label">Product Name</label>
			        <select name="product_id" class="form-select valid" required="" aria-invalid="false">
						
						<?php
						foreach($queryp->result() as $rowp)
                          {
							if($rowp->Product_Code == $user['Product_Code'])
							{
							echo '<option value='.$rowp->Product_Code.'>'.$rowp->Product_Brand_Name.'('.$rowp->Product_Code.')</option>';
							}
						  }
						?>
						<?php
						foreach($queryp->result() as $rowp)
                          {
							if($rowp->Product_Code != $user['Product_Code'])
							{
							echo '<option value='.$rowp->Product_Code.'>'.$rowp->Product_Brand_Name.'('.$rowp->Product_Code.')</option>';
							}
						  }
						?>
			        </select>
					
				</div>
				<div class="clear"></div>
			</div>

		
			<div class="form-row">
				<!-- <div class="form-column">
					<label class="radio-label">Order Date</label>
					<input type="text" class="form-input datepicker" name="order_date" minlength='1' maxlength='50' placeholder="Order Date" value="<?php echo set_value('order_date',$user['Order_Date']); ?>" required/>
				</div> -->

				<div class="form-column">
					<label class="radio-label">Required Date</label>
					<input type="text" class="form-input datepicker" name="required_date" minlength='1' maxlength='50' placeholder="Required Date" value="<?php echo set_value('required_date',$user['Required_date']); ?>" required/>
				</div>

				<!-- <div class="form-column">
					<label class="radio-label">Shipped Date</label>
					<input type="text" class="form-input datepicker" name="shipped_date" minlength='1' maxlength='50' placeholder="Shipped Date" value="<?php echo set_value('shipped_date',$user['Shipped_date']); ?>" required/>
				</div> -->
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Order Status</label>
					<!-- <textarea class="form-input" name="status" placeholder="Order Status"  required><?php echo set_value('status',$user['Order_Status']); ?></textarea> -->
					<select name="status" class="form-select valid" required="" aria-invalid="false">
						
						<?php
						foreach($orderstatus->result() as $rowo)
                          {
							  if($rowo->orderstatustrack_name == $user['Order_Status'])
							  {
							      echo '<option>'.$rowo->orderstatustrack_name.'</option>';
							  }
						  }
						  foreach($orderstatus->result() as $rowo)
                          {
							  if($rowo->orderstatustrack_name != $user['Order_Status'])
							  {
							      echo '<option>'.$rowo->orderstatustrack_name.'</option>';
							  }
						  }
						?>
			        </select>
				</div>
				<div class="clear"></div>
			</div>


			<!-- pricedrop -->
<br/>
			<br/>
			<?php $k=1;?>

			<div class="form-row">
				<div class="form-column">
				<div style="display:flex;width:100%;">
					<label class="radio-label" style="flex: 1;">Items</label><a class="form-button small-button bg-green add_but">+ <!--ADD--></a><a class="form-button small-button bg-green delete_but" style="background:red!important">Delete</a>
					</div>
					

					<?php
					foreach($queryproductitems->result() as $rowproduct)
					{?>
					<input type="hidden" name="hiddenproducts<?php echo $k;?>" value="<?php echo $rowproduct->ProductItem_Code;?>">
					
					<div class="form-row row delrow<?php echo $k;?>">
  
					   <div class="form-column">
					        <label class="radio-label counter"><?php echo $k;?>)</label>
					        <!-- <input type="text" class="form-input" name="item_price" placeholder="Item Weight in gms" value="<?php echo set_value('item_price'); ?>" required/> -->
				        </div>

				        <div class="form-column">
						
					        <select name="items<?php echo $k;?>" class="form-select valid" required="" aria-invalid="false">
						            
						            <?php
									foreach($queryitems->result() as $rowitems)
                                    {
										if($rowitems->Item_Code == $rowproduct->Item_Code)
										{
							            echo '<option value='.$rowitems->Item_Code.'>'.$rowitems->Item_Name.'</option>';
										}
						            }
						            foreach($queryitems->result() as $rowitems)
                                    {
										if($rowitems->Item_Code != $rowproduct->Item_Code)
										{
							            echo '<option value='.$rowitems->Item_Code.'>'.$rowitems->Item_Name.'</option>';
										}
						            }
						            ?>
			                </select>
					        <!-- <input type="text" class="form-input" name="quality" placeholder="Product Quality" value="<?php echo set_value('quality'); ?>" required/> -->
				         
						   
						</div>

						<div class="form-column">
					        
					        <input type="text" class="form-input" name="item_wt<?php echo $k;?>" placeholder="Item Weight in gms" value="<?php echo $rowproduct->ProductItem_WeightInGram; ?>" required/>
				        </div>

						<div class="form-column">
					        
					        <input type="number" class="form-input" name="item_price<?php echo $k;?>" placeholder="0" value="<?php echo $rowproduct->ProductItem_Price; ?>" required/>
				        </div>
						<div class="clear"></div>
					</div>
				    <?php $k++;
					}
					?>
					<input type="hidden" class="hidden" name="addval" value="<?php echo $countquery;?>">
					<div class="recycler">
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<br/>
			<br/>
			
			<script>
			$(document).ready(function(){
				$(".add_but").click(function(){
					var hideval = $('.hidden').val();
					var addval = parseFloat(hideval)+1;
					//alert(addval);
					var output = "";
output += '<div class="form-row delrow'+addval+'">';
  
output += '<div class="form-column">';
output += '<label class="radio-label counter">'+addval+')</label>';
output += '</div>';

output += '<div class="form-column">';
   
output += '<select name="items'+addval+'" class="form-select valid" required="" aria-invalid="false">';
output += '<option>Select Item</option>';
output += '<?php
			   foreach($queryitems->result() as $rowitems)
			   {
				   echo '<option value='.$rowitems->Item_Code.'>'.$rowitems->Item_Name.'</option>';
			   }
			   ?>';
	   output += '</select>';
	  
	   output += '</div>';

	   output += '<div class="form-column">';
	   
	   output += '<input type="text" class="form-input" name="item_wt'+addval+'" placeholder="Item Weight in gms" minlength="1" maxlength="50" value="<?php echo set_value('item_wt'); ?>" required/>'
	   output += '</div>';

	   output += '<div class="form-column">';
	   
	   output += '<input type="number" class="form-input" name="item_price'+addval+'" placeholder="Item Price" minlength="1" maxlength="50" value="<?php echo set_value('item_price'); ?>" required/>';
	   output += '</div>';
	   output += '<div class="clear"></div>';
	   output += '</div>';
	   output += '</div>';
    
	   $('.recycler').append(output);
	   $('.hidden').val(addval);
				});
			});
			</script>

<script>
			$(document).ready(function(){
				$(".delete_but").click(function(){
					var hideval = $('.hidden').val();
					var addval = parseFloat(hideval)-1;
					//alert(addval);
					if(hideval > 1)
					{
					$('.delrow'+hideval+'').html('');
	                $('.hidden').val(addval);
					}else{
						$('.hidden').val(1);
					}
				});
			});
			</script>
<input type="hidden" name="hiddenprice" value="<?php echo $user['Price_Code'];?>">







        <div class="form-row">
				<!-- <div class="form-column">
					<label class="radio-label">Customs Duty In Percent</label>
					<input type="number" class="form-input" name="duty" placeholder="Customs Duty In Percent" value="<?php echo set_value('duty'); ?>" minlength='1' maxlength='50' required/>
				</div> -->
				
				<div class="form-column">
					<label class="radio-label">Gold Weight In Grams</label>
					<input type="number" class="form-input" name="weight_gms" placeholder="Gold Weight In Grams" value="<?php echo set_value('weight_gms',$user['WeightInGram']); ?>" minlength='1' maxlength='50' required/>
				</div>
				<script>
				$('input[name=weight_gms').keyup(function() {
					   var todayPrice = parseFloat($('input[name=rate_id').val());
					   todayPrice = todayPrice*parseFloat($(this).val());
                       $('input[name=gold_total]').val(todayPrice);
                });
				</script>

				<div class="form-column">
					<label class="radio-label">Gold Weight GST in Percent</label>
					<input type="number" class="form-input" name="gold_gst" placeholder="Gold Weight GST in Percent" value="<?php echo set_value('gold_gst',$user['Gold_GSTInPercent']); ?>" minlength='1' maxlength='50' required/>
				</div>
				<script>
				$('input[name=gold_gst').keyup(function() {
					   var todayPrice = parseFloat($('input[name=rate_id').val());
					   todayPrice = todayPrice*parseFloat($('input[name=weight_gms').val());
					   var gst = (todayPrice*parseFloat($(this).val()))/100;
					   var total = todayPrice+gst;
                       $('input[name=gold_total]').val(total);
					   $('input[name=subtotal]').val(total);
                });
				</script>
				<div class="form-column">
					<label class="radio-label">Gold Total</label>
					<input type="number" class="form-input" name="gold_total" placeholder="Gold Weight GST in Percent" value="<?php echo set_value('gold_total',$user['Gold_Total']); ?>" minlength='1' maxlength='50' required/>
				</div>
				
				<!--<div class="form-column">
					<label class="radio-label">Stone Wight In Grams</label>
					<input type="text" class="form-input" name="stone_gms" placeholder="Stone Wight In Grams" value="<?php echo set_value('stone_gms'); ?>" required/>
				</div>-->
				<div class="clear"></div>
			</div>
			
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Making Charges In Percent</label>
					<input type="number" class="form-input" name="making" placeholder="Making Charges In Percent" value="<?php echo set_value('making',$user['Making_ChargesInPercent']); ?>" minlength='1' maxlength='50' required/>
				</div>

				<script>
				$('input[name=making').keyup(function() {
					   var todayPrice = parseFloat($('input[name=rate_id').val());
					   todayPrice = todayPrice*parseFloat($('input[name=weight_gms').val());
                       var input = $(this).val();
					   var hideval = $('.hidden').val();
		               var i;
		               var itemsprice = 0;
					   for(i=1;i<=hideval;i++)
		                {
							if($('input[name=item_price'+i+']').val() > 0)
							{
		                    itemsprice = parseFloat($('input[name=item_price'+i+']').val())+itemsprice;
							}
		                }
						todayPrice = todayPrice+itemsprice;
                       var makingPercen = (todayPrice*parseFloat($('input[name=making]').val()))/100;
					   var total = makingPercen;
					   $('input[name=making_total').val(total);
					  
                });
				</script>
				
				<div class="form-column">
					<label class="radio-label">Making Charge GST In Percent</label>
					<input type="number" class="form-input" name="gst" placeholder="Making Charge GST In Percent" value="<?php echo set_value('gst',$user['Making_Charge_GSTInPercent']); ?>" minlength='1' maxlength='50' required/>
				</div>
				<script>
				$('input[name=gst').keyup(function() {
					var todayPrice = parseFloat($('input[name=rate_id').val());
					   todayPrice = todayPrice*parseFloat($('input[name=weight_gms').val());
                       var input = $('input[name=making').val();
					   var hideval = $('.hidden').val();
		               var i;
		               var itemsprice = 0;
					   for(i=1;i<=hideval;i++)
		                {
							if($('input[name=item_price'+i+']').val() > 0)
							{
		                    itemsprice = parseFloat($('input[name=item_price'+i+']').val())+itemsprice;
							}
		                }
						todayPrice = todayPrice+itemsprice;
                       var makingPercen = (todayPrice*parseFloat($('input[name=making]').val()))/100;
					//    var total = makingPercen;
					//    var todayPrice = parseFloat($('input[name=making_total').val());
					   var gst = (makingPercen*parseFloat($(this).val()))/100;
					   var total = makingPercen+gst;
                       $('input[name=making_total]').val(total);
					   $('input[name=subtotal]').val(parseFloat($('input[name=gold_total').val())+total);

                });
				</script>
				
				<div class="form-column">
					<label class="radio-label">Making Charge Total </label>
					<input type="number" class="form-input" name="making_total" placeholder="Making Charge Total" value="<?php echo set_value('making_total',$user['Making_total']); ?>" minlength='1' maxlength='50' required/>
				</div>
				<div class="clear"></div>
			</div>
			

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Wastage In Percent</label>
					<input type="number" class="form-input" name="wasatge" placeholder="Wastage In Percent" value="<?php echo set_value('wasatge',$user['WastageInPercent']); ?>" minlength='1' maxlength='50' required/>
				</div>
				<script>
				$('input[name=wasatge').keyup(function() {
					   var todayPrice = parseFloat($('input[name=rate_id').val());
					   todayPrice = todayPrice*parseFloat($('input[name=weight_gms').val());
					   var gst = (todayPrice*parseFloat($(this).val()))/100;
					   var total = gst;
					   var tdy = parseFloat($('input[name=weight_gms').val());
					   var gms = (parseFloat($(this).val())/100)*tdy;
					   $('input[name=wasatge_gms]').val(gms);
                       $('input[name=wastage_total]').val(total);
                });
				</script>
				
				<div class="form-column">
					<label class="radio-label">Weight Of Wastage In Grams</label>
					<input type="number" class="form-input" name="wasatge_gms" placeholder="Weight Of Wastage In Grams" value="<?php echo set_value('wasatge_gms',$user['WeightOfWastageInGram']); ?>" minlength='1' maxlength='50'required/>
				</div>
				<script>
				$('input[name=wasatge_gms').keyup(function() {
					   var todayPrice = parseFloat($('input[name=rate_id').val());
					   todayPrice = todayPrice*parseFloat($('input[name=weight_gms').val());
					   var gst = parseFloat($('input[name=rate_id').val())*parseFloat($(this).val());
					//    alert(gst);
					   var total = gst;
                       $('input[name=wastage_total]').val(total);
                });
				</script>
				
				<div class="form-column">
					<label class="radio-label">Wastage Total</label>
					<input type="text" class="form-input" name="wastage_total" placeholder="Wastage Total" value="<?php echo set_value('wastage_total',$user['Wastage_total']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>

			<!-- <br/>
			<br/>
			<a class="form-button small-button bg-green sub_total">SubTotal</a>
			<br/>
			<br/> -->
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">SubTotal</label>
					<input type="text" class="form-input" name="subtotal" placeholder="SubTotal" value="<?php echo set_value('subtotal',$user['SubTotal']); ?>" required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Discount On Selling Price</label>
					<input type="text" class="form-input" name="discount" placeholder="Discount On Selling Price" value="<?php echo set_value('discount',$user['Discount_On_Selling_Price']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>
			<!-- <br/>
			<br/>
			<a class="form-button small-button bg-green discount_total">Discount SubTotal</a>
			<br/>
			<br/> -->
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">SubTotal After Discount</label>
					<input type="text" class="form-input" name="sub_discount" placeholder="SubTotal After Discount" value="<?php echo set_value('sub_discount',$user['SubTotal_After_Discount']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Grand Total</label>
					<input type="text" class="form-input" name="total" placeholder="Grand Total" value="<?php echo set_value('total',$user['Grand_Total']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>
			
		</div>

		</div>
			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Save.." />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("order/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
		</div>
	</form>
	<script>
	$("#edit-form-id").validate({
		rules: {
			Repassword: {
				equalTo:'#category-password'
			}
		}
	});
	</script>
	</div>
</div>


	</div>
</div>

</div></div></div></div>
</section>
</div>

<script>
$(document).ready(function() {
	$('.sub_total').click(function(){
		var todayPrice = parseFloat($('select[name=rate_id').find(":selected").val());

		todayPrice = todayPrice*parseFloat($('input[name=weight_gms').val());
		var hideval = $('.hidden').val();
		var i;
		var itemsprice = 0;
		var wastagePercen = 0;
		var gst = 0;
		var goldgst = 0;
		var duty = 0;
		var wastage = 0;
		var vat = 0;
		var subtotal;
		for(i=1;i<=hideval;i++)
		{
		    itemsprice = parseFloat($('input[name=item_price'+i+']').val())+itemsprice;
		}

		var gold = parseFloat($('input[name=gold_total').val());
		var making = parseFloat($('input[name=making_total').val());
		var wastage = parseFloat($('input[name=wastage_total').val());

		if(itemsprice > 1)
		{
		subtotal = gold+making+itemsprice-wastage;
		}else{
			subtotal = gold+making-wastage;

		}
		$('input[name=subtotal]').val(subtotal);

	});
	
});

</script>

<script>
$(document).ready(function() {
	$('input[name=discount').keyup(function() {
		var subtotal = parseFloat($('input[name=subtotal]').val());
		var discount = parseFloat($('input[name=discount]').val());
		var gst = (subtotal*discount)/100;
		// alert(gst);
		var total = subtotal-gst;
		$('input[name=sub_discount]').val(total);
		$('input[name=total]').val(total);

	});
});
</script>
