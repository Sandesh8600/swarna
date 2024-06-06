<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class Payment extends CI_Controller {

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
			$this->load->model("Payment_model");
			
			$result=$this->Payment_model->get_users($page_start,$page_size);
			
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
			

			$this->lib->render_view("modules/payment/browse.php",$data);

    }
    
    public function edit($user_id){
		
			$this->load->model("Payment_model");

			$this->load->library("form_validation");
			
			
			$this->form_validation->set_rules("order_date","order_date", "required");
			
			
			if($this->form_validation->run()){
				
				$this->Payment_model->update();
				
				$this->lib->set_status("Payment details have been updated!");
				
				redirect("order/vieworder");

			} else { 
				
				
				$data['user']=$this->Payment_model->fetch_user($user_id);

				$this->lib->render_view("modules/payment/edit.php",$data);
			
			}
			

	}


	public function create()
	{
		$this->lib->render_view("modules/payment/create.php");

		$this->load->helper('date');
		 $c_date = date("Y-m-d H:i:s");

		if($this->input->post('order_date'))
		{
		$data = array(
			// 'Customer_Code' => $this->input->post('customer'),
			'Order_Code' => $this->session->userdata('viewtask_id'),

			'Date_Of_Order' => $this->input->post('order_date'),
			'purity' => $this->input->post('percentage'),
			'Payment_Method' => $this->input->post('method'),
			'Quantity' => $this->input->post('quantity'),
			'Percentage' => $this->input->post('purity'),
			'Amount' => $this->input->post('amount'),
			'Total_gold' => $this->input->post('estimated'),

			'Payment_Status' => $this->input->post('status'),
			
			'Timestamp' => $c_date

			
		);
		// print_r($data);die;
		if($this->input->post('method') == 'gold')
		{
			$gold = $this->input->post('quantity');
			$this->db->select('*');
			$this->db->from('goldbalance');
			$query = $this->db->get()->row();
			$val = $query->Masterbalance + $gold;
			$id = $query->Goldbalance_id;
			$update = array(
				'Masterbalance' => $val
			);
			$this->db->update("goldbalance", $update, array("Goldbalance_id"=>$id));
			
		}
		
		if($this->db->insert('payments', $data))
		{
			
			redirect(site_url("order/vieworder"));
			

		}
	 }
	}

	

	function submitid()
	{
		$id = $this->input->post('typeid');
		$this->session->set_userdata('viewtask_id',$id);
		if($id)
		{
			redirect(site_url("viewtask/browse"));
		}
	}

	public function mydelete()
    {
        $row_id = $this->input->post('partner_id');
        print_r($row_id);
        $this->db->delete("payments",array("Payment_code"=>$row_id));
    }
	
	

}
