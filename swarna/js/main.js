function copy_input(input_id) {
  /* Get the text field */
  var copyText = document.getElementById(input_id);

  /* Select the text field */
  copyText.select();

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Join URL copied!");
}

function hide_status_message(){
	
	$("#black-shade").hide();	
	$(".status-message").slideUp();
	$(".status-message").html("");
		
}

function show_status_message(){
	
	$("#black-shade").show();	
	$(".status-message").slideDown();
		
}

/*
 * @author shree@wvs.in
 * @function show_popup
 * @Description Function to open a popup modal with custom contents
 * */
 function show_popup(popup_contents){

	// popup_contents will contain the html data to be displayed inside the popup
	$("#popup-contents").html(popup_contents);

	$("#black-shade").fadeIn();
	$("#popup").fadeIn();

 }

/*
 * @author shree@wvs.in
 * @function show_popup
 * @Description Function to close a popup modal with custom contents
 * */
 function hide_popup(){

	$("#popup").fadeOut();
	$("#black-shade").fadeOut();
	
	// popup_contents will contain the html data to be displayed inside the popup
	$("#popup-contents").html('');

 }


/*
 * @author shree@wvs.in
 * @function show_loader
 * @Description This function is to enable/show ajax loader svg div layer
 * */
function show_loader(){
		$("#ajax-loader").fadeIn();
	}

/*
 * @author shree@wvs.in
 * @function hide_loader
 * @Description This function is to disable/hide ajax loader svg div layer
 * */
function hide_loader(){
		$("#ajax-loader").fadeOut();
	}

/*
 * @author shree@wvs.in
 * @function confirm url action
 * @Description to confirm an url action
 * */

function confirm_action(url, message){
	
	var txt;
	var r = confirm(message);
	if (r == true) {
	  window.location.assign(url);
	}
}


$(document).ready(function(){
	
	
	setTimeout(function(){ hide_status_message();}, 4000);
	
	//to toggle drawer menu
	$("#main-menu-cta").click(function(){
		$("#drawer-menu").animate({'width': 'toggle'});

		if($( "#main-menu-icon" ).hasClass( "fa-grip-horizontal" )){
			$("#main-menu-icon").removeClass('fa-grip-horizontal');
			$("#main-menu-icon").addClass('fa-arrow-left');
		} else {
			$("#main-menu-icon").removeClass('fa-arrow-left');
			$("#main-menu-icon").addClass('fa-grip-horizontal');
		}


	 });


});


function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}
