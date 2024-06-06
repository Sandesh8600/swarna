<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class Goldtransaction extends CI_Controller {

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
			$this->load->model("Goldtransaction_model");
			$this->load->model("Voucher_model");
			$result=$this->Goldtransaction_model->get_users($page_start,$page_size);
			$data['result']=$this->Voucher_model->fetch_users();
        //  print_r($data['result']);
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
			
			$this->lib->render_view("modules/goldtransaction/browse.php",$data);

    }
    
    public function edit($user_id){
		
			$this->load->model("Goldtransaction_model");

			$this->load->library("form_validation");
			
			
			$this->form_validation->set_rules("gold","gold", "required");
			
			
			if($this->form_validation->run()){
				
				$this->Goldtransaction_model->update();
				
				$this->lib->set_status("Ticket have been updated!");
				
				redirect("goldtransaction/browse");

			} else { 
				
				
				$data['user']=$this->Goldtransaction_model->fetch_user($user_id);

				$this->lib->render_view("modules/goldtransaction/edit.php",$data);
			
			}
			

	}
	

	public function create()
	{
		$this->lib->render_view("modules/goldtransaction/create.php");

		$this->load->helper('date');
		 $c_date = date("Y-m-d H:i:s");
		 
		if($this->input->post('gold'))
		{
	$this->db->select('*');
	$this->db->from('goldbalance');
	$balance = $this->db->get()->row();
			
			
			if ($this->input->post('gold') < $balance->Masterbalance)
            {
                $data = array(
					'Entity_Type' => $this->input->post('entity_type'),
					'Entity_Id' => $this->session->userdata('workshop_id'),
					
					'Gold_in_Grams' => $this->input->post('gold'),
					'Transaction_Type' => $this->input->post('type'),
					// 'From_Entity_Id' => $this->input->post('from_entity_id'),
					// 'From_Entity_Type' => $this->input->post('from_entity'),
					'Comments' => $this->input->post('comments'),
					'Timestamp' => $c_date
		
					
				);
				// print_r($data);die;
				
				if($this->db->insert('gold_transaction', $data))
				{
					$gold = $this->input->post('gold');
					$this->db->select('*');
					$this->db->from('goldbalance');
					$query = $this->db->get()->row();
					if($this->input->post('type') == 'Debit')
					{
					$val = $query->Masterbalance + $gold;

					}else{
					$val = $query->Masterbalance - $gold;
					}
					$id = $query->Goldbalance_id;
					$update = array(
						'Masterbalance' => $val
					);
					if($this->db->update("goldbalance", $update, array("Goldbalance_id"=>$id)))
					{
						$this->db->select('*');
					    $this->db->from('workshops');
					    $shop = $this->db->get()->row();
					    if($this->input->post('type') == 'Debit')
					     {
					        $bal = $shop->Workshop_GoldBalanceInGram - $gold;

					     }else{
					         $bal = $shop->Workshop_GoldBalanceInGram + $gold;
					     }
						 $upshop = array(
							 'Workshop_GoldBalanceInGram' => $bal
						 );
						 if($this->db->update("workshops", $upshop, array("Workshop_Code"=>$shop->Workshop_Code)))
					      {
					
						     redirect(site_url("goldtransaction/browse"));
						  }
					}
					
		
				}

            }
            elseif ($this->input->post('gold') > $balance->Masterbalance)
            {
                    $this->session->set_flashdata('golds','The Gold(grams) must be less than '.$balance->Masterbalance.'g, Insufficient Balance.');
                    return FALSE;
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
        $this->db->delete("golddepositeticket",array("Ticket_Id"=>$row_id));
    }
	
	

}
