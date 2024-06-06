<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class User extends CI_Controller {

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
			$this->load->model("user_model");
			
			$result=$this->user_model->get_users($page_start,$page_size);
			
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
			

			$this->lib->render_view("modules/user/browse.php",$data);

    }
    
    public function edit($user_id){
		
			$this->load->model("user_model");

			$this->load->library("form_validation");
			
			
			$this->form_validation->set_rules("full_name","full_name", "required");
			
			
			if($this->form_validation->run()){
				
				$this->user_model->update();
				
				$this->lib->set_status("Customer details have been updated!");
				
				redirect("user/browse");

			} else { 
				
				
				$data['user']=$this->user_model->fetch_user($user_id);

				$this->lib->render_view("modules/user/edit.php",$data);
			
			}
			

	}
	

	public function create()
	{
		$this->lib->render_view("modules/user/create.php");

		$this->load->helper('date');
		 $c_date = date("Y-m-d H:i:s");

		 if($this->session->userdata('user_id'))
		 {
			$this->session->unset_userdata('user_id');
		 }

		if($this->input->post('full_name'))
		{
		$data = array(
			'Customer_Name' => $this->input->post('full_name'),
			'Customer_Email' => $this->input->post('email'),
			'Customer_Pincode' => $this->input->post('pincode'),
			'Customer_Billing_address' => $this->input->post('current'),
			
			'Customer_City' => $this->input->post('city'),
			'pan' => $this->input->post('pan'),
			'opening_balance' => $this->input->post('opening_balance'),
			'silver_opening_balance' => $this->input->post('opening_silver_balance'),
			'making_charge' => $this->input->post('making_charge'),
			'Customer_Mobile_Number1' => $this->input->post('phone1'),
			
			'Timestamp' => $c_date,
			'Customer_Status' => 1
		);
		
		if($this->db->insert('customers', $data))
		{
			
			redirect(site_url("user/browse"));
			

		}
	 }
	}

	function order()
	{
		$id = $this->input->post('typeid');
		$this->session->set_userdata('user_id',$id);
		if($id)
		{
			//redirect(site_url("viewtask/browse"));
			redirect(site_url("order/create"));

		}
	}
	
	public function mydelete()
    {
        $row_id = $this->input->post('partner_id');
        print_r($row_id);
        $this->db->delete("customers",array("Customer_Code"=>$row_id));
    }
    
    public function search_customer(){
		
		
		$this->load->model("user_model");
		
		
		$data=$this->user_model->search_customer();
		
		echo json_encode($data);
		
	
	}

}
