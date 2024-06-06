<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class Rate extends CI_Controller {

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
		
			//load metal model
			$this->load->model("Rate_model");
			
			$data=array();
		
		
			//edit category
			if($this->input->get("edit_form")=="yes"){
				
				$this->load->library("form_validation");
				$this->form_validation->set_rules("full_name","full_name", "required");
				$this->form_validation->set_rules("metal_type","Metal Type", "required");
				
				
				if($this->form_validation->run()){
					
					$this->Rate_model->update();
					
					$this->lib->set_status("Rate have been updated!");
					
					redirect("rate/browse");

				} else { 
					
					
					$data['user']=$this->Rate_model->fetch_user($this->input->get("rate_id"));
				
				}
				
			}
			
			//create category
			if($this->input->get("create_form")=="yes"){
				
				$this->load->library("form_validation");
				$this->form_validation->set_rules("full_name","full_name", "required");
				$this->form_validation->set_rules("metal_type","Metal Type", "required");
				
				
				if($this->form_validation->run()){
					
					  $c_date = date("Y-m-d H:i:s");
					  $date = date("Y-m-d");
					  $metal_type  = $this->input->post('metal_type');
						if($this->input->post('full_name'))
						{
							
						$data = array(
							'TodaysRatePerGram' => $this->input->post('full_name'),
							'metal_type'=>$this->input->post('metal_type'),
							'Timestamp' => $c_date

							
						);
						$where_data = array(
							
							'metal_type'=>$this->input->post('metal_type'),
							
						);
						$this->db->where( $where_data);
						$this->db->like('Timestamp', $date);
						$this->db->order_by("TodaysRatePerGram_ID", "desc");
						// $query = $this->db->get('todaysratepergram');
						$this->db->from('todaysratepergram');
						// $metal_rate_detail = $query->result();
						$metal_rate_count =  $this->db->count_all_results(); 
						if($metal_rate_count>=2){
							$this->lib->set_status(" $metal_type Rate already added 2 times!");
							redirect(site_url("rate/browse?create_form=yes"));
						}
					
						else{
							$this->db->insert('todaysratepergram', $data);
							redirect(site_url("rate/browse"));
							//echo $this->db->last_query(); exit;
						}
					}
				
			
				}
			
			}
		
		
			$page=$this->input->get("page");
			
			if(!$page){
					
				$page=0;
			}
			
			$page_size=1;
			
			if($this->input->get("page_size")>0){
				$page_size=$this->input->get("page_size");
			}
			
			$page_start=$page_size*$page;
			
			$result=$this->Rate_model->get_users($page_start,$page_size);
			
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
			

			$this->lib->render_view("modules/rate/browse.php",$data);

    }
    
    public function edit($user_id){
		
			$this->load->model("Rate_model");

			$this->load->library("form_validation");
			
			
			$this->form_validation->set_rules("full_name","full_name", "required");
			
			
			if($this->form_validation->run()){
				
				$this->Rate_model->update();
				
				$this->lib->set_status("Today's Rate per grams have been updated!");
				
				redirect("rate/browse");

			} else { 
				
				
				$data['user']=$this->Rate_model->fetch_user($user_id);

				$this->lib->render_view("modules/rate/edit.php",$data);
			
			}
			

	}
	
	
	public function create()
	{
		$this->lib->render_view("modules/rate/create.php");

		$this->load->helper('date');
		 $c_date = date("Y-m-d H:i:s");
		$current_time = date("H:i");
		if($this->input->post('full_name'))
		{
		$data = array(
			'TodaysRatePerGram' => $this->input->post('full_name'),
			'Timestamp' => $c_date

			
		);
		
		if($this->db->insert('todaysratepergram', $data))
		{
			
			redirect(site_url("rate/browse"));
			

		}
	 }
	}
	public function get_metal_rate(){
		
		$this->load->model("Rate_model");
		
		$metal_type=$this->input->post("metal_type");
		
		
		$response['status']=false;
		$c_date = date("Y-m-d");
		if($metal_type){
			
			$response['metal_type']=$metal_type;
			
			$data = array(
				
				'metal_type'=>$metal_type,
				'date(Timestamp)' => $c_date
	
				
			);
			
			  $this->db->where( $data);
			  $this->db->order_by("TodaysRatePerGram_ID", "desc");
			  $query = $this->db->get('todaysratepergram');
			 $response['result'] = $query->result();
			// print_r($response['result']);
			if( $response['result']){
				$response['status']=true;
			}
			
			
		} 
		
		echo json_encode($response);
	
	}
	public function mydelete()
    {
        $row_id = $this->input->post('partner_id');
        print_r($row_id);
        $this->db->delete("todaysratepergram",array("TodaysRatePerGram_ID"=>$row_id));
    }

}
