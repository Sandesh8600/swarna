<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
*  
* Class contains method to generate/verify generic checksum out of any given array
* 
*
*/
class Checksum{

	var $salt;
	var $ci;

	public function __construct()
	{

		//instantiate codeigniter scope object
		$this->ci=& get_instance();

		// set salt value for calculating checksum
		$this->salt="oiixmsuflwro974jjhzer034nu56p23m1kflk34lnk2kmfd9idnlsdkjg";
	}

	// checksum for validate query | order matters
	public function generate_checksum($params)
	{
		// var_dump($params);exit;
		$str = "";
		foreach ($params as $key => $value) {
			if(gettype($value) != "string") {
				$str.= json_encode($value);
			} else {
				$str.=$value;
			}
			$str.="|";
		}
		$checksum=hash("sha256",$str.$this->salt);
		return $checksum;
	}

	//function to validate  checksum | order matters
	public function validate_checksum($params){
		if(!isset($params) || !isset($params['CHECKSUMHASH'])){
			return false;
		}

		$responseCheckSum = $params['CHECKSUMHASH'];
		unset($params['CHECKSUMHASH']);
	 	$str = "";
		foreach ($params as $key => $value) {
			if(gettype($value) != "string") {
				$str.= json_encode($value);
			} else {
				$str.=$value;
			}
			$str.="|";
		} 
		//checksum calculation
		$checksum=hash("sha256",$str.$this->salt);
		
		//compare checksum
		if($responseCheckSum==$checksum){
			return true;

		} else {
                
			return false;

		}
    }

}

/* End of file Checksum.php */
/* Location: ./application/libraries/Checksum.php */
