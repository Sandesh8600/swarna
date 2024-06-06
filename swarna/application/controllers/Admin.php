<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class Admin extends CI_Controller {

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		parent::__construct();

		$this->db->query("SET time_zone='+5:30'");
		
		//check if loggedin
		if(!$this->session->userdata("admin_id")){ redirect("login/validate"); }
	}

	public function browse(){
		
			//load models
			$this->load->model("admin_model");
			
			$data=array();
			
			//create
			if($this->input->get("create_form")=="yes"){
				
				$this->load->library("form_validation");
				$this->form_validation->set_rules("admin_name","Admin Name", "required");
				$this->form_validation->set_rules("email","Email", "required");
				$this->form_validation->set_rules("password","Password", "required");
				$this->form_validation->set_rules("status","Status", "required");
				
				if($this->form_validation->run()){
					
					$this->admin_model->create();
					
					$this->lib->set_status("New Admin record has been added successfully");
					
					redirect("admin/browse");

				}
			}
			
			
			//edit

			if($this->input->get("edit_form")=="yes"){
				
				$this->load->library("form_validation");
				$this->form_validation->set_rules("admin_name","Admin Name", "required");
				$this->form_validation->set_rules("email","Email", "required");
				$this->form_validation->set_rules("status","Status", "required");
				
				if($this->form_validation->run()){
					
					$this->admin_model->update();
					
					$this->lib->set_status("Admin record details have been updated!");
					
					redirect("admin/browse");

				} else { 
					$admin_id=$this->input->get("admin_id");
					$data['admin']=$this->admin_model->fetch_admin($admin_id);
				}
			
			}
			
		
			$page=$this->input->get("page");
			
			if(!$page){
					
				$page=0;
			}
			
			$page_size=10;
			
			$page_start=$page_size*$page;

			
			
			$result=$this->admin_model->get_admins($page_start,$page_size);
		
			$data['admins']=$result['records'];
			$data['total']=$result['total_records'];
			
			$data['next_page']=false;
			$data['next_page_num']=$page+1;
			$data['prev_page']=true;
			$data['prev_page_num']=$page-1;
			
			if($data['total']>(($page+1) * $page_size)){
				$data['next_page']=true;
			}
			
			if($page==0){
				$data['prev_page']=false;
			}

			$this->lib->render_view("modules/admin/browse.php",$data);

    }
    
    public function create(){
		
			//load  models
			$this->load->model("admin_model");

			$this->load->library("form_validation");
			$this->form_validation->set_rules("admin_name","Admin Name", "required");
			$this->form_validation->set_rules("email","Email", "required");
			$this->form_validation->set_rules("password","Password", "required");
			$this->form_validation->set_rules("status","Status", "required");
			
			if($this->form_validation->run()){
				
				$this->admin_model->create();
				
				$this->lib->set_status("New Admin record has been added successfully");
				
				redirect("admin/browse");

			} else { 
				
				$this->lib->render_view("modules/admin/create.php");
			
			}
			

    }
    
    public function edit($admin_id){
		
			//load  models
			$this->load->model("admin_model");

			$this->load->library("form_validation");
			$this->form_validation->set_rules("admin_name","Admin Name", "required");
			$this->form_validation->set_rules("email","Email", "required");
			$this->form_validation->set_rules("status","Status", "required");
			
			if($this->form_validation->run()){
				
				$this->admin_model->update();
				
				$this->lib->set_status("Admin record details have been updated!");
				
				redirect("admin/browse");

			} else { 
				
				
				$data['admin']=$this->admin_model->fetch_admin($admin_id);

				$this->lib->render_view("modules/admin/edit.php",$data);
			
			}
		

	}
	
	public function mydelete()
    {
        $row_id = $this->input->post('partner_id');
        print_r($row_id);
        $this->db->delete("admin",array("admin_id"=>$row_id));
    }


}
