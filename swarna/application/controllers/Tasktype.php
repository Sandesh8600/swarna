<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class Tasktype extends CI_Controller {

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
		
			$page=$this->input->get("page");
			
			if(!$page){
					
				$page=0;
			}
			
			$page_size=25;
			
			if($this->input->get("page_size")>0){
				$page_size=$this->input->get("page_size");
			}
			
			$page_start=$page_size*$page;

			//load category model
			$this->load->model("Tasktype_model");
			
			$result=$this->Tasktype_model->get_users($page_start,$page_size);
			
			$data['users']=$result['records'];
			$data['total']=$result['total_records'];
			$data['page_size']=$page_size;
			$data['current_page']=$page+1;
			$data['total_pages']=$data['total']/$page_size;
			$data['total_pages']=$data['total_pages']<1?1:$data['total_pages'];
			
			if($data['total_pages']>(int)($data['total_pages'])){
				$data['total_pages']=(int)($data['total_pages'])+1;
			}
			
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
			

			$this->lib->render_view("modules/tasktype/browse.php",$data);

    }
    
    public function edit($user_id){
		
			$this->load->model("Tasktype_model");

			$this->load->library("form_validation");
			
			
			$this->form_validation->set_rules("full_name","full_name", "required");
			
			
			if($this->form_validation->run()){
				
				$this->Tasktype_model->update();
				
				$this->lib->set_status("Task details have been updated!");
				
				redirect("tasktype/browse");

			} else { 
				
				
				$data['user']=$this->Tasktype_model->fetch_user($user_id);

				$this->lib->render_view("modules/tasktype/edit.php",$data);
			
			}
			

	}
	

	public function create()
	{
		$this->lib->render_view("modules/tasktype/create.php");

		$this->load->helper('date');
		 $c_date = date("Y-m-d H:i:s");

		if($this->input->post('full_name'))
		{
		$data = array(
			'TaskType_Name' => $this->input->post('full_name'),
			
			'Timestamp' => $c_date

			
		);
		
		if($this->db->insert('tasktype', $data))
		{
			
			redirect(site_url("tasktype/browse"));
			

		}
	 }
	}
	
	public function mydelete()
    {
        $row_id = $this->input->post('partner_id');
        print_r($row_id);
        $this->db->delete("tasktype",array("TaskType_Id"=>$row_id));
    }

}
