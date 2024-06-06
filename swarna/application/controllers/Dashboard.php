<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class Dashboard extends CI_Controller {

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		parent::__construct();

		$this->db->query("SET time_zone='+5:30'");
		
		//check if loggedin
		if(!$this->session->userdata("admin_id")){ redirect("login/validate"); }
	
	}

	public function index()
	{
		
		$this->lib->render_view('modules/dashboard/dashboard');
		
	}
 
}
