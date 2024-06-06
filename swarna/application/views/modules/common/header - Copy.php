<!DOCTYPE html>
<html>
<head>
<title>Swarna control</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<!-- for title img -->
<link rel="shortcut icon" type="image/icon" href="<?php echo base_url("images/favicon.png"); ?>"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

<link rel="stylesheet" href="<?php echo base_url("css/main.css?v=".time()); ?>" />
<link rel="stylesheet" href="<?php echo base_url("css/responsive.css"); ?>" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <link rel="stylesheet" href="<?php echo base_url("css/jquery.bxslider.css"); ?>">
 <script> var base_url="<?php echo base_url(); ?>"; </script>
<script src="<?php echo base_url("js/lib/jquery-3.3.1.min.js"); ?>" ></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrJg0RpzxQkcu-WBvZtC_t-IJRlhjSerQ&libraries=geometry,places"></script>
<script src="<?php echo base_url("js/lib/jquery.validate.min.js"); ?>" ></script>
<script src="<?php echo base_url("js/lib/additional-methods.min.js"); ?>" ></script>
<script src="<?php echo base_url("js/main.js"); ?>" ></script>
<script src="https://cdn.tiny.cloud/1/y3up4qnvvapm7nfuzipoi6bwnn7jjgjfao0s3s5dc8yciugj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<script>tinymce.init({selector:'.inline-editor'});</script>

  
  <script>

$( function() {
    
    $(".datepicker").datepicker({
			
      changeMonth: true,
      changeYear: true,
      dateFormat: "dd-mm-yy"
    
		});
     
 });



 

</script>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
$(document).ready(function(){
  AOS.init();
});
</script>






  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css');?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css');?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css');?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jqvmap/jqvmap.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css');?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css');?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.css');?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/summernote/summernote-bs4.min.css');?>">





</head>
<body>
<style>
.dropdown-menu {
    min-width: 100%;
    
    /* display: none; */
    position: relative;
    z-index: 999;
    left: 0;
    display: none;
}
.dropdown-menu {
    min-width: 100%;
    background: #eee;
    /* display: none; */
    position: relative;
    z-index: 999;
    left: 0;
    display: none;
}
.dropcon {
    /* background: steelblue; */
    color: rgb(231, 230, 230);
}
.dropdown-menu1 {
    min-width: 100%;
    
    /* display: none; */
    position: relative;
    z-index: 999;
    left: 0;
    display: none;
}
.dropdown-menu1 {
    min-width: 100%;
    background: #eee;
    /* display: none; */
    position: relative;
    z-index: 999;
    left: 0;
    display: none;
}
.dropdown-menu2 {
    min-width: 100%;
    
    /* display: none; */
    position: relative;
    z-index: 999;
    left: 0;
    display: none;
}
.dropdown-menu2 {
    min-width: 100%;
    background: #eee;
    /* display: none; */
    position: relative;
    z-index: 999;
    left: 0;
    display: none;
}
.dropcon {
    /* background: steelblue; */
    color: rgb(231, 230, 230);
}
</style>



<div class="wrapper">

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo base_url('assets/dist/img/AdminLTELogo.png');?>" alt="AdminLTELogo" height="60" width="60" style="display: none;">
  </div>






  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="<?php echo site_url("login/logout"); ?>" role="button">
          <i class="fas fa-th-large"></i> Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->




 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed;height: 100%;">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url('assets/dist/img/AdminLTELogo.png');?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SWARNA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $this->session->userdata("admin_name"); ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		   <li class="nav-header">Sales</li>
          
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
			  Customers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendar
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Kanban Board
              </p>
            </a>
          </li>
         
          
         
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>












<div id="container" style="display:none;">
			<header id="header" data-aos="fade-down" data-aos-duration="150">
				<div>
				<div class="header-inner">
					<?php if($this->session->userdata("admin_id") and false): ?>
					<div id="main-menu-cta">
						<i id="main-menu-icon" class="fas fa-grip-horizontal"></i>
					</div>
					<?php endif; ?>
				<div id="header-logo">
					<a href="<?php echo base_url(); ?>" style="font-size:25px; font-weight:bold; color:#fff; display:inline-block; padding:5px 0px;">Swarna Jewellers</a>
				</div>
				
				<div id="header-menu">
					<ul>
						
						<?php if($this->session->userdata("admin_id")): ?>
						<li><i>[ Welcome <?php echo $this->session->userdata("admin_name"); ?> ]</i></li>
						<?php endif; ?>
						
						<li><a href="<?php echo base_url(); ?>">Home</a></li>
						
						<?php if($this->session->userdata("admin_id")): ?>
						<li><a href="<?php echo site_url("login/logout"); ?>">Logout</a></li>
						<?php endif; ?>
						
					</ul>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				</div>
				</div>
			</header>
			<?php 
				
				$class=$this->router->fetch_class();
				$method=$this->router->fetch_method();
				
			
			?>
			<div id="drawer-menu" style="<?php if($class=="login"): echo "display:none;"; endif; ?>" data-aos="fade-right">
					<nav id="main-nav">
						<?php if($this->session->userdata("admin_id")): ?>
						
						<!-- <a class="main-nav-item<?php if($class=="dashboard"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("dashboard"); ?>">
							<div class="nav-item-icon"><i class="fas fa-list"></i></div>
							<div class="nav-item-label">Dashboard</div>
							<div class="clear"></div>
						</a>	 -->

<script>
    $(document).ready(function(){
		
        // Show hide popover
        $(".downdrop").click(function(){
            $('.dropdown').find(".dropdown-menu").slideToggle("fast");
			    if($('.down').is(":visible")){
				   $('.down').css('display','none');
			       $('.right').css('display','block');
			        sessionStorage.removeItem("val");

                } else{
                    $('.down').css('display','block');
			        $('.right').css('display','none');
			        sessionStorage.setItem("val", "dropdown");

                }
			
        });
		var val=sessionStorage.getItem("val");
		if(val != null)
		{
			// alert(val);
			$(".downdrop a").click();
		}
    });
    
</script>
						
	<div class="dropdown" style="width:100%;">
        <div class="downdrop">
	    <a class="main-nav-item<?php if($class=="admin"): echo " active-nav-item"; endif; ?>">
							<!-- <div class="nav-item-icon"><i class="fas fa-user-secret"></i></div>fas fa-angle-right -->
							<div class="nav-item-label" style="flex:1;font-size:18px;font-weight:bold;">Sales</div>
							<i class="fas fa-angle-down down" style="float:right;font-size:18px;display:none;"></i>
							<i class="fas fa-angle-right right" style="float:right;font-size:18px;"></i>

							<div class="clear"></div>
		</a>
		</div>
    <div class="dropdown-menu w3-bar-block w3-card-4 dropcon" style="display: none;">
       <div style="width:100%;">
	             <a class="main-nav-item<?php if($class."/".$method=="user/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("user/browse"); ?>">
							<div class="nav-item-icon"><i class="fas fa-users"></i></div>
							<div class="nav-item-label">Customers</div>
							<div class="clear"></div>
				</a>

				<a class="main-nav-item<?php if($class."/".$method=="order/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("order/browse"); ?>">
							<div class="nav-item-icon"><i class="fab fa-first-order-alt"></i></div>
							<div class="nav-item-label">Orders List</div>
							<div class="clear"></div>
				</a>
       </div>
    </div>
  </div>



  <script>
    $(document).ready(function(){
        // Show hide popover
        $(".downdrop1").click(function(){
            $('.dropdown1').find(".dropdown-menu1").slideToggle("fast");
			if($('.down1').is(":visible")){
				   $('.down1').css('display','none');
			       $('.right1').css('display','block');
			       sessionStorage.removeItem("val1");

                } else{
                    $('.down1').css('display','block');
			        $('.right1').css('display','none');
			        sessionStorage.setItem("val1", "dropdown1");

                }
        });
		var val1=sessionStorage.getItem("val1");
		if(val1 != null)
		{
			// alert(val);
			$(".dropdown1 a").click();
		}
    });
</script>
  <div class="dropdown1" style="width:100%;">
        <div class="downdrop1">
	    <a class="main-nav-item<?php if($class=="admin"): echo " active-nav-item"; endif; ?>">
							<!-- <div class="nav-item-icon"><i class="fas fa-user-secret"></i></div> -->
							<div class="nav-item-label" style="flex:1;font-size:18px;font-weight:bold;">Jewellary</div>
							<i class="fas fa-angle-down down1" style="float:right;font-size:18px;display:none;"></i>
							<i class="fas fa-angle-right right1" style="float:right;font-size:18px;"></i>
							<div class="clear"></div>
		</a>
		</div>
    <div class="dropdown-menu1 w3-bar-block w3-card-4 dropcon" style="display: none;">
       <div style="width:100%;">
	            <a class="main-nav-item<?php if($class."/".$method=="jewellary/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("jewellary/browse"); ?>">
							<div class="nav-item-icon"><i class="fas fa-user-friends" aria-hidden="true"></i></div>
							<div class="nav-item-label">Jewellary Manage</div>
							<div class="clear"></div>
						</a>

						<a class="main-nav-item<?php if($class."/".$method=="workshop/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("workshop/browse"); ?>">
							<div class="nav-item-icon"><i class="fas fa-user-friends" aria-hidden="true"></i></div>
							<div class="nav-item-label">Workshops</div>
							<div class="clear"></div>
						</a>
						<a class="main-nav-item<?php if($class."/".$method=="products/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("products/browse"); ?>">
							<div class="nav-item-icon"><i class='fas fa-ring'></i></div>
							<div class="nav-item-label">Catalog Management</div>
							<div class="clear"></div>
						</a>
						<a class="main-nav-item<?php if($class."/".$method=="items/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("items/browse"); ?>">
							<div class="nav-item-icon"><i class="far fa-life-ring"></i></div>
							<div class="nav-item-label">Addon Items </div>
							<div class="clear"></div>
						</a>
       </div>
    </div>
  </div>


  <script>
    $(document).ready(function(){
        // Show hide popover
        $(".downdrop2").click(function(){
            $('.dropdown2').find(".dropdown-menu2").slideToggle("fast");
			    if($('.down2').is(":visible")){
				   $('.down2').css('display','none');
			       $('.right2').css('display','block');
				   sessionStorage.removeItem("val2");

                } else{
			        sessionStorage.setItem("val2", "dropdown2");

                    $('.down2').css('display','block');
			        $('.right2').css('display','none');
                }
        });
		var val2=sessionStorage.getItem("val2");
		if(val2 != null)
		{
			// alert(val);
			$(".dropdown2 a").click();
		}
    });
</script>
  <div class="dropdown2" style="width:100%;">
        <div class="downdrop2">
	    <a class="main-nav-item<?php if($class=="admin"): echo " active-nav-item"; endif; ?>">
							<!-- <div class="nav-item-icon"><i class="fas fa-user-secret"></i></div> -->
							<div class="nav-item-label" style="flex:1;font-size:18px;font-weight:bold;">Settings</div>
							<i class="fas fa-angle-down down2" style="float:right;font-size:18px;display:none;"></i>
							<i class="fas fa-angle-right right2" style="float:right;font-size:18px;"></i>
							<div class="clear"></div>
		</a>
		</div>
    <div class="dropdown-menu2 w3-bar-block w3-card-4 dropcon" style="display: none;">
       <div style="width:100%;">
	          <a class="main-nav-item<?php if($class."/".$method=="rate/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("rate/browse"); ?>">
							<div class="nav-item-icon"><i class='fas fa-calendar-alt'></i></div>
							<div class="nav-item-label">Todays gold rate entry</div>
							<div class="clear"></div>
						</a>

						<a class="main-nav-item<?php if($class."/".$method=="category/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("category/browse"); ?>">
							<div class="nav-item-icon"><i class="fas fa-globe"></i></div>
							<div class="nav-item-label">Categories</div>
							<div class="clear"></div>
						</a>
						<a class="main-nav-item<?php if($class."/".$method=="subcategory/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("subcategory/browse"); ?>">
							<div class="nav-item-icon"><i class="fas fa-sitemap"></i></div>
							<div class="nav-item-label">Sub Categories</div>
							<div class="clear"></div>
						</a>
						<a class="main-nav-item<?php if($class."/".$method=="metal/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("metal/browse"); ?>">
							<div class="nav-item-icon"><i class="far fa-window-restore"></i></div>
							<div class="nav-item-label">Gold Purity</div>
							<div class="clear"></div>
						</a>
						<a class="main-nav-item<?php if($class."/".$method=="tasktype/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("tasktype/browse"); ?>">
							<div class="nav-item-icon"><i class="fas fa-tasks"></i></div>
							<div class="nav-item-label">Task Types</div>
							<div class="clear"></div>
						</a>
						<a class="main-nav-item<?php if($class=="admin"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("admin/browse"); ?>">
							<div class="nav-item-icon"><i class="fas fa-user-secret"></i></div>
							<div class="nav-item-label">User Management</div>
							<div class="clear"></div>
						</a>
       </div>
    </div>
  </div>					
						<!--<a class="main-nav-item<?php if($class=="admin"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("admin/browse"); ?>">
							<div class="nav-item-icon"><i class="fas fa-user-secret"></i></div>
							<div class="nav-item-label">Moderators</div>
							<div class="clear"></div>
						</a>

						<a class="main-nav-item<?php if($class."/".$method=="rate/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("rate/browse"); ?>">
							<div class="nav-item-icon"><i class='fas fa-calendar-alt'></i></div>
							<div class="nav-item-label">Today's Rate Per Gram</div>
							<div class="clear"></div>
						</a>

						<a class="main-nav-item<?php if($class."/".$method=="user/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("user/browse"); ?>">
							<div class="nav-item-icon"><i class="fas fa-users"></i></div>
							<div class="nav-item-label">Customers</div>
							<div class="clear"></div>
						</a>

						<a class="main-nav-item<?php if($class."/".$method=="category/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("category/browse"); ?>">
							<div class="nav-item-icon"><i class="fas fa-globe"></i></div>
							<div class="nav-item-label">Category</div>
							<div class="clear"></div>
						</a>

						<a class="main-nav-item<?php if($class."/".$method=="subcategory/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("subcategory/browse"); ?>">
							<div class="nav-item-icon"><i class="fas fa-sitemap"></i></div>
							<div class="nav-item-label">Sub Category</div>
							<div class="clear"></div>
						</a>

						<a class="main-nav-item<?php if($class."/".$method=="metal/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("metal/browse"); ?>">
							<div class="nav-item-icon"><i class="far fa-window-restore"></i></div>
							<div class="nav-item-label">Metal/Purity</div>
							<div class="clear"></div>
						</a>

						<a class="main-nav-item<?php if($class."/".$method=="items/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("items/browse"); ?>">
							<div class="nav-item-icon"><i class="far fa-life-ring"></i></div>
							<div class="nav-item-label">Items</div>
							<div class="clear"></div>
						</a>

						<a class="main-nav-item<?php if($class."/".$method=="products/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("products/browse"); ?>">
							<div class="nav-item-icon"><i class='fas fa-ring'></i></div>
							<div class="nav-item-label">Products</div>
							<div class="clear"></div>
						</a>

						

						<a class="main-nav-item<?php if($class."/".$method=="workshop/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("workshop/browse"); ?>">
							<div class="nav-item-icon"><i class="fas fa-user-friends" aria-hidden="true"></i></div>
							<div class="nav-item-label">Workshop</div>
							<div class="clear"></div>
						</a>

						<a class="main-nav-item<?php if($class."/".$method=="jewellary/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("jewellary/browse"); ?>">
							<div class="nav-item-icon"><i class="fas fa-user-friends" aria-hidden="true"></i></div>
							<div class="nav-item-label">Jewellary Manage</div>
							<div class="clear"></div>
						</a>

						<a class="main-nav-item<?php if($class."/".$method=="tasktype/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("tasktype/browse"); ?>">
							<div class="nav-item-icon"><i class="fas fa-tasks"></i></div>
							<div class="nav-item-label">Task Type</div>
							<div class="clear"></div>
						</a>

						<a class="main-nav-item<?php if($class."/".$method=="order/browse"): echo " active-nav-item"; endif; ?>" href="<?php echo site_url("order/browse"); ?>">
							<div class="nav-item-icon"><i class="fab fa-first-order-alt"></i></div>
							<div class="nav-item-label">Orders</div>
							<div class="clear"></div>
						</a>-->

						 

						<?php endif; ?>
					</nav>
			</div>
			<div class="header-top-margin"></div>
			<div id="drawer-spacer"></div>
			<div id="data-container">
