<?php
$this->db->select("*");
$this->db->from("category");
$query = $this->db->get();

?>

<?php
$this->db->select("*");
$this->db->from("subcategory");
$querymetal = $this->db->get();

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
$this->load->helper('date');
$c_date = date("Y-m-d");
$this->db->select("*");
$this->db->from("todaysratepergram");
$this->db->where("Timestamp", $c_date);
$queryrate = $this->db->get();

?>

<?php 
if($this->session->userdata("insertid"))
{
	$this->session->unset_userdata("insertid");
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Products</h1>
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
		
<div id='create-form'>
<!-- <h1 class='h1-title'></h1> -->
<div class="form-div">
	
	<div class="validation-errors"><?php echo validation_errors(); ?></div>
	<form action="<?php echo site_url("products/create"); ?>" method='POST' enctype="multipart/form-data" name="create_form" id="create-form-id">
		
		
	  <div class="form-block">
	       
	    
	       <div class="form-row" style="width:100%;display:flex;">
				<div class="form-column">
					<label class="radio-label">Category Name</label>
			        <select name="category_id" class="form-select valid" required="" aria-invalid="false">
						<option>Select Category</option>
						<?php
						foreach($query->result() as $row)
                          {
							echo '<option value='.$row->Category_ID.'>'.$row->Category_Name.'</option>';
						  }
						?>
			        </select>
					
			    </div>

				<div class="form-column">
					<label class="radio-label">SubCategory</label>
			        <select name="metal_id" class="form-select valid" required="" aria-invalid="false">
						<option>Select subcategory</option>
						<?php
						foreach($querymetal->result() as $rows)
                          {
							echo '<option value='.$rows->SubCategory_ID.'>'.$rows->SubCategory_Name.'</option>';
						  }
						?>
			        </select>
					
				</div>

				
				<div class="clear"></div>
			</div>

		
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Product Stock No</label>
					<input type="text" class="form-input" name="stock_no" placeholder="Product Stock No" value="<?php echo set_value('stock_no'); ?>" minlength='1' maxlength='50' required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Product Brand Name</label>
					<input type="text" class="form-input" name="full_name" placeholder="Product Brand Name" value="<?php echo set_value('full_name'); ?>" minlength='1' maxlength='50' required/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Product Approximate Metal Weight (g)</label>
					<input type="text" class="form-input" name="weight" placeholder="Product Approximate Metal Weight" value="<?php echo set_value('weight'); ?>" minlength='1' maxlength='50' required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Product Size(mm)</label>
					<input type="text" class="form-input" name="size" placeholder="Product Size" value="<?php echo set_value('size'); ?>" minlength='1' maxlength='50' required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Product Height(mm)</label>
					<input type="text" class="form-input" name="height" placeholder="Product Height" value="<?php echo set_value('height'); ?>" minlength='1' maxlength='50' required/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Product Width(mm)</label>
					<input type="text" class="form-input" name="width" placeholder="Product Width" value="<?php echo set_value('width'); ?>" minlength='1' maxlength='50' required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Product Shape</label>
					<input type="text" class="form-input" name="shape" placeholder="Product Shape" value="<?php echo set_value('shape'); ?>" minlength='1' maxlength='50' required/>
				</div>
				
				<!-- <div class="form-column">
					<label class="radio-label">Product Quality</label>
					<input type="text" class="form-input" name="quality" placeholder="Product Quality" value="<?php echo set_value('quality'); ?>" required/>
				</div> -->
				<div class="clear"></div>
			</div>

			

			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Submit" />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("products/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
		</div>
	</form>
	<script>
	$("#create-form-id").validate({
		rules: {
			/*repassword: {
				equalTo:'#user-password'
			}*/
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

<!-- <script>
$(document).ready(function() {
	var todayPrice = $('select[name=rate_id').find(":selected").val();
	alert(todayPrice);
	$('input[name=subtotal').val(todayPrice);
	
});

</script> -->
<script>
$(document).ready(function() {
	$('.sub_total').click(function(){
		var todayPrice = parseInt($('select[name=rate_id').find(":selected").val());

		todayPrice = todayPrice*parseInt($('input[name=weight_gms').val());
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
		    itemsprice = parseInt($('input[name=item_price'+i+']').val())+itemsprice;
		}

		wastagePercen = (todayPrice*parseInt($('input[name=making]').val()))/100;
		gst = (todayPrice*parseInt($('input[name=gst]').val()))/100;
		goldgst = (todayPrice*parseInt($('input[name=gold_gst]').val()))/100;
		// duty = (todayPrice*parseInt($('input[name=duty]').val()))/100;
		wastage = (todayPrice*parseInt($('input[name=wasatge]').val()))/100;
		// vat = (todayPrice*parseInt($('input[name=vat]').val()))/100;
		
		if(itemsprice > 1)
		{
		subtotal = todayPrice+itemsprice+wastagePercen+gst+goldgst+duty+wastage+vat;
		}else{
		subtotal = todayPrice+wastagePercen+gst+goldgst+duty+wastage+vat;

		}
		$('input[name=subtotal]').val(subtotal);

	});
	
});

</script>

<script>
$(document).ready(function() {
	$('.discount_total').click(function(){
		var subtotal = parseInt($('input[name=subtotal]').val());
		var discount = parseInt($('input[name=discount]').val());
		var gst = (subtotal*discount)/100;
		// alert(gst);
		var total = subtotal-gst;
		$('input[name=sub_discount]').val(total);
		$('input[name=total]').val(total);

	});
});
</script>
