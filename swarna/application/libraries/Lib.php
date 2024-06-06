<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
* Class contains general methods
*
*
*/
class Lib{


public function __construct()
{

	//instantiate codeigniter scope object
	$this->ci=& get_instance();
}

public function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}



//email alert function using msg91 gateway
public function email_alert_old($to, $subject, $body){

			$from="";

			$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://control.msg91.com/api/sendmail.php?body=".$body."&subject=".$subject."&to=".$to."&from=".$from."&authkey=<authkey>",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_SSL_VERIFYHOST => 0,
		  CURLOPT_SSL_VERIFYPEER => 0,
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  //echo "cURL Error #:" . $err;
		} else {
		  //echo $response;
		}

}

//email alert new smtp
public function email_alert($to, $subject, $body){
	

		$this->ci->load->library('email');
		
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['smtp_host'] = 'mail.peakprep.co.uk';
		$config['smtp_user'] = 'no-reply@peakprep.co.uk';
		$config['smtp_pass'] = 'Peakprep2020@!';
		$config['smtp_port'] = 465;
		$config['mailtype'] = 'html';

		$this->ci->email->initialize($config);

		$this->ci->email->from('no-reply@peakprep.co.uk', 'Peak Prep');
		$this->ci->email->to($to);

		$this->ci->email->subject($subject);
		$this->ci->email->message($body);

		$this->ci->email->send();

}

//funtion to load view with common header and footer
public function render_view($view_path, $data=array()){
		
		$this->ci->load->view("modules/common/header.php");
		$this->ci->load->view($view_path, $data);
		$this->ci->load->view("modules/common/footer.php");
		
		$this->unset_status();
		
}


 //function to set and remove status messages
 public function set_status($status_message){
			
	$this->ci->session->set_userdata(array("status_message"=>$status_message));		
			
 }
 
 //function to set and remove status messages
 public function unset_status(){
	 		
	$this->ci->session->unset_userdata("status_message");		
			
 }
 
 //function to upload image
 public function upload_image($file, $target_dir){
	 
			$file_name=basename($_FILES[$file]["name"]);
			
			 $file_name =  str_replace(' ', '_', $file_name);
			
			$target_file = $target_dir . $file_name;
			
			
			// Check if file already exists
			if (file_exists($target_file)){
				
				$rand=rand(10000,99999);
				$file_name=$rand . "_" . basename($_FILES[$file]["name"]);
				$file_name =  str_replace(' ', '_', $file_name);
				$target_file = $target_dir . $file_name;
			}
			
			if(move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {
				return $file_name;
			} else {
				return "";
			}
	
	}
	
	
	//function to upload file
	public function upload_file($file, $target_dir){
	 
			$file_name=basename($_FILES[$file]["name"]);
			
			 $file_name =  str_replace(' ', '_', $file_name);
			
			$target_file = $target_dir . $file_name;
			
			
			// Check if file already exists
			if (file_exists($target_file)){
				
				$rand=rand(10000,99999);
				$file_name=$rand . "_" . basename($_FILES[$file]["name"]);
				$file_name =  str_replace(' ', '_', $file_name);
				$target_file = $target_dir . $file_name;
			}
			
			if(move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)){
				return $file_name;
			} else {
				return "";
			}
	
	}
 

}

/* End of file Lib.php */
/* Location: ./application/libraries/Lib.php */
