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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Products Info</h1>
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
	<form action="<?php echo site_url("products/edit/".$user['Product_Code']); ?>" method='POST' enctype="multipart/form-data" name="edit_form" id="edit-form-id">
		<input type="hidden" name="User_id" value="<?php echo $user['Product_Code']; ?>" />
		<div class="form-block">

		    

		    <div class="form-row" style="width:100%;display:flex;">
				<div class="form-column">
					<label class="radio-label">Category Name</label>
			        <select name="category_id" class="form-select valid" required="" aria-invalid="false">
						<?php
						foreach($query->result() as $row)
                          {
							  if($row->Category_ID == $user['Category_ID'])
							  {
								echo '<option value='.$row->Category_ID.'>'.$row->Category_Name.'</option>';
							  }
						  }
						  foreach($query->result() as $row)
                          {
							  if($row->Category_ID != $user['Category_ID'])
							  {
								echo '<option value='.$row->Category_ID.'>'.$row->Category_Name.'</option>';
							  }
						  }
						?>
			        </select>
					
			</div>
			
				<div class="form-column">
					<label class="radio-label">Subcategory</label>
			        <select name="metal_id" class="form-select valid" required="" aria-invalid="false">
						<?php
						foreach($querymetal->result() as $rows)
                          {
							  if($rows->SubCategory_ID == $user['SubCategory_ID'])
							  {
								echo '<option value='.$rows->SubCategory_ID.'>'.$rows->SubCategory_Name.'</option>';
							  }
						  }
						  foreach($query->result() as $row)
                          {
							  if($rows->SubCategory_ID != $user['SubCategory_ID'])
							  {
								echo '<option value='.$rows->SubCategory_ID.'>'.$rows->SubCategory_Name.'</option>';
							  }
						  }
						?>
			        </select>
					
			</div>

			<!--<div class="form-column">
					<label class="radio-label">Product Purity</label>
					<select name="quality" class="form-select valid" required="" aria-invalid="false">
						<?php
						foreach($querypurity->result() as $rowpurity)
                          {
							  if($rowpurity->Purity_ID == $user['Product_Purity'])
							  {
								echo '<option value='.$rowpurity->Purity_ID.'>'.$rowpurity->Purity_Name.'</option>';
							  }
							  if($rowpurity->Purity_ID != $user['Product_Purity'])
							  {
								echo '<option value='.$rowpurity->Purity_ID.'>'.$rowpurity->Purity_Name.'</option>';
							  }
							
						  }
						?>
			        </select>
				</div>-->
				<div class="clear"></div>
			</div>
			
			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Product Stock No</label>
					<input type="text" class="form-input" name="stock_no" placeholder="Product Stock No" minlength='1' maxlength='50' value="<?php echo set_value('stock_no',$user['Product_Stock_No']); ?>" required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Product Brand Name</label>
					<input type="text" class="form-input" name="full_name" placeholder="Product Brand Name" minlength='1' maxlength='50' value="<?php echo set_value('full_name',$user['Product_Brand_Name']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Product Approximate Metal Weight</label>
					<input type="text" class="form-input" name="weight" placeholder="Product Approximate Metal Weight" minlength='1' maxlength='50' value="<?php echo set_value('weight',$user['Product_Approximate_Metal_Weight']); ?>" required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Product Size</label>
					<input type="text" class="form-input" name="size" placeholder="Product Size" minlength='1' maxlength='50' value="<?php echo set_value('size',$user['Product_Size']); ?>" required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Product Height</label>
					<input type="text" class="form-input" name="height" placeholder="Product Height" minlength='1' maxlength='50' value="<?php echo set_value('height',$user['Product_Height']); ?>" required/>
				</div>
				<div class="clear"></div>
			</div>

			<div class="form-row">
				<div class="form-column">
					<label class="radio-label">Product Width</label>
					<input type="text" class="form-input" name="width" placeholder="Product Width" minlength='1' maxlength='50' value="<?php echo set_value('width',$user['Product_Width']); ?>" required/>
				</div>
				
				<div class="form-column">
					<label class="radio-label">Product Shape</label>
					<input type="text" class="form-input" name="shape" placeholder="Product Shape" minlength='1' maxlength='50' value="<?php echo set_value('shape',$user['Product_Shape']); ?>" required/>
				</div>
				
				<!-- <div class="form-column">
					<label class="radio-label">Product Quality</label>
					<input type="text" class="form-input" name="quality" placeholder="Product Quality" value="<?php echo set_value('quality',$user['Product_Purity']); ?>" required/>
				</div> -->
				<div class="clear"></div>
			</div>

			





			
			<div class="form-row blocks-right">
					<input type="submit" class="form-button" name="submit" value="Save.." />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("products/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
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
