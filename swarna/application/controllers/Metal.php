<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class Metal extends CI_Controller {

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

			//load metal model
			$this->load->model("Metal_model");
			
			$result=$this->Metal_model->get_users($page_start,$page_size);
			
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
			

			$this->lib->render_view("modules/metal/browse.php",$data);

    }
    
    public function edit($user_id){
		
			$this->load->model("Metal_model");

			$this->load->library("form_validation");
			
			
			$this->form_validation->set_rules("full_name","full_name", "required");
			
			
			if($this->form_validation->run()){
				
				$this->Metal_model->update();
				
				$this->lib->set_status("Metal details have been updated!");
				
				redirect("metal/browse");

			} else { 
				
				
				$data['user']=$this->Metal_model->fetch_user($user_id);

				$this->lib->render_view("modules/metal/edit.php",$data);
			
			}
			

	}
	

	public function create()
	{
		$this->lib->render_view("modules/metal/create.php");

		$this->load->helper('date');
		 $c_date = date("Y-m-d H:i:s");

		if($this->input->post('full_name'))
		{
		$data = array(
			'Purity_Name' => $this->input->post('full_name'),
			'Timestamp' => $c_date

			
		);
		
		if($this->db->insert('metalorpurity', $data))
		{
			
			redirect(site_url("metal/browse"));
			

		}
	 }
	}

	public function mydelete()
    {
        $row_id = $this->input->post('partner_id');
        print_r($row_id);
        $this->db->delete("metalorpurity",array("Purity_ID"=>$row_id));
    }
	
	

}
