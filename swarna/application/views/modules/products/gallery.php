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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Gallery</h1>
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
            <form method="POST" enctype="multipart/form-data" action="<?php echo site_url('products/formsubmit');?>">
            <div class="form-div">
            <div class="form-block">
            <input type="hidden" name="productid" value="<?php echo $this->session->userdata("insertid");?>">
                <div class="form-row">
				    <div class="form-column">
					    <label class="radio-label">Select Images</label>
					    <input type="file" class="form-input" name="files" required/>
				    </div>
                    <div class="clear"></div>
			    </div>
				
            </div>
            <?php echo $this->session->flashdata('valid');?>
            <div class="form-row">
					<input type="submit" class="form-button" name="submit" value="Submit" />
					<button type="button" class="form-button bg-grey" name="submit" onclick="window.location.replace('<?php echo site_url("products/browse"); ?>');"><i class="fas fa-arrow-left"></i> Go Back</button>
					
				<div class="clear"></div>
			</div>
            </div>
            </form>
        </div>
        <div id='create-form' style="margin-top:60px;">
            <h1 class='h1-title'>Gallery</h1>
            <?php
            $this->db->select("*");
            $this->db->from("productimages");
            $this->db->where("Product_Code",$this->session->userdata("insertid"));
            $query = $this->db->get();
            ?>
            <section class="c-store-features">
            <?php
            foreach($query->result() as $row)
            {
                echo '<article class="c-store-features__feature">
                <img class="myImg" id="myImg" src='.base_url($row->ProductImage).' alt="Snow" style="width:100%;max-width:300px">
                <div class="c-store-features__title" onclick="myDelete('.$row->ProductImage_Id.')" style="color:red;cursor:pointer;">Delete</div>
            </article>';
            }
            ?>
            
          </section>
        </div>
    </div>
</div>


<!-- The Modal -->
<div id="myModal" class="modal" style="margin-top: 58px;margin-left: 210px;">
  <span class="close" style="cursor:pointer;">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
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

<script>
function myDelete(partner_id)
  {
    //    alert(partner_id);
       $.post("<?php echo site_url("products/mydelete");?>",
       {partner_id:partner_id}, function(data){
           window.location.href="<?php echo site_url("products/gallery"); ?>";
       });
  }
</script>
</div></div></div></div>
</section>
</div>