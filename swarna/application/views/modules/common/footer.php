</div>

<style>
  .input-date-width{width:100px !important;}
.confirm {
  display: none;
}
.confirm > div:first-of-type {
  position: fixed;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  top: 0px;
  left: 0px;
}
.confirm > div:last-of-type {
  padding: 10px 20px;
  background: white;
  position: absolute;
  width: auto;
  height: auto;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  border-radius: 5px;
  border: 1px solid #333;
}
.confirm > div:last-of-type div:first-of-type {
  min-width: 150px;
  padding: 10px;
}
.confirm > div:last-of-type div:last-of-type {
  text-align: right;
}
</style>


<div class="confirm">
  <div></div>
  <div>
    <div id="confirmMessage">Confirm text</div>
    <div>
      <input id="confirmYes" type="button" class="form-button small-button bg-green" value="Delete" style="background:red!important;"/>
      <input id="confirmNo" type="button" class="form-button small-button bg-green" value="Cancel" />
    </div>
  </div>
</div>



<footer id="footer">
				<div class="box-width">
					
					<div class="left">
						2019-20 &copy; Peak Prep. All Rights Reserved.
					</div>
					<div class="right">
						<ul class="footer-menu">
							<li><a href="<?php echo site_url("home"); ?>"></a></li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
			</footer>

</div>
<?php if($status_message=$this->session->userdata("status_message")): ?>
	 <div class="status-message"><?php echo $status_message; ?><div style="text-align:center; padding-top:20px;"><button onclick="hide_status_message();" class="form-button micro-button bg-grey">&nbsp;&nbsp;Ok&nbsp;&nbsp;</button></div></div>
	 <script>
		
		$(document).ready(function(){
			
					show_status_message();
			}); 
		
		
	 </script>
	<?php 
	
	endif;
	
	$this->session->unset_userdata("status_message");
	$this->session->unset_userdata("error_message");
	 
	?>
<div id="black-shade"></div>
<div id="popup">
			<div id="popup-container">
				<div id="popup-contents"></div>
			</div>
			<div id="popup-close" onclick='hide_popup();'><i class="far fa-times-circle"></i></div>
			<div class="clear"></div>
		</div>
<div id="ajax-loader"><img src="<?php echo base_url("images/loader.svg"); ?>" width="100"></div>





<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/plugins/jquery-ui/jquery-ui.min.js');?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('assets/plugins/chart.js/Chart.min.js');?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/plugins/sparklines/sparkline.js');?>"></script>
<!-- JQVMap -->
<script src="<?php echo base_url('assets/plugins/jqvmap/jquery.vmap.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js');?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/plugins/jquery-knob/jquery.knob.min.js');?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/plugins/moment/moment.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.js');?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js');?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url('assets/plugins/summernote/summernote-bs4.min.js');?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.js');?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/dist/js/demo.js');?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/dist/js/pages/dashboard.js');?>"></script>

<script>
// Add the following code if you want the name of the file appear on select
function change_file_input(){
		$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});

		$("input[type=file]").each(function() {
			$(this).rules("add", {
				accept: "image/*",
				messages: {
					accept: "Only jpeg, jpg or png images"
				}
			});
		});
	}
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
	//convert_to_grams
	function convert_to_grams(number){
		number = extractNumericValue(number);
		new_number =  fixFloat(number,2);
		new_number = fixFloat(new_number,3);
		// console.log(new_number);
	return  new_number;
		
	}
	function convert_to_number(a){
			
			a=a.replace(/\,/g,'');
			return parseFloat(a);
	}
</script>
</body>
</html>
