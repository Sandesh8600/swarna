<?php
function decimal_number($number, $places){
    return number_format((float)$number, $places, '.', '');
}
function convert_to_grams($number){
   $number = number_format((float)$number, 2, '.', '');
   $new_number = number_format((float)$number, 3, '.', '');
   
   return  $new_number;
}

//for date stamp formatting
function _dtf($date){
	
	return date('d-m-Y h:i A',strtotime($date));

}

//for date formatting to indian
function _dt($date){
	
	return date('d-m-Y',strtotime($date));

}

//metal/gold 
