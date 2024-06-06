<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */

class Login extends CI_Controller {

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		parent::__construct();

		$this->db->query("SET time_zone='+5:30'");
		$this->load->model("login_model");
	}

	public function index()
	{
		$this->bro4u->show_404();
	}

	
	public function validate()
	{
		
		if($this->session->userdata("admin_id")){ redirect("user/browse"); }
		
		$this->load->library("form_validation");
			
			
		$this->form_validation->set_rules("email","Email", "required");
		$this->form_validation->set_rules("password","Password", "required");
		
		if($this->form_validation->run()){
				
				
			if($this->login_model->validate_login()){
			
				$this->lib->set_status("You have been successfully logged in!");
			
				redirect("admin/browse");
			
			} else {
				
				redirect("login/validate?login_error=yes");
			
			}
 
		} else { 
			
			$this->lib->render_view("modules/common/login.php");
		
		}
		
	}
	
	//logout function
	public function logout(){
		
		$this->login_model->logout();
		
		$this->lib->set_status("You are logged Out!");
		
		redirect("login/validate");
	
	}


}
