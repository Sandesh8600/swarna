<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class Workshop extends CI_Controller {

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		parent::__construct();

		$this->db->query("SET time_zone='+5:30'");
		$this->load->model('Workshop_model');
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
			$this->load->model("Workshop_model");
			
			$result=$this->Workshop_model->get_users($page_start,$page_size);
			$record=$this->Workshop_model->get_records();
			$eachRecord=$this->Workshop_model->get_each_records();
			$data['result']=$record;
			$data['workshop']=$eachRecord;
		
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
			//echo"------------------------"    ;    print_r($data['result']);
			 echo "------------------------------------------------------------------------------------------------------------------------" ; print_r($data['workshop']);

			// $this->lib->render_view("modules/workshop/browse.php",$data);
			$this->lib->render_view("modules/workshop/show.php",$data);
    }
    
    public function edit($user_id){
		
			$this->load->model("Workshop_model");

			$this->load->library("form_validation");
			
			
			$this->form_validation->set_rules("full_name","full_name", "required");
			
			
			if($this->form_validation->run()){
				
				$this->Workshop_model->update();
				
				$this->lib->set_status("Workshop details have been updated!");
				
				redirect("workshop/browse");

			} else { 
				
				
				$data['user']=$this->Workshop_model->fetch_user($user_id);

				$this->lib->render_view("modules/workshop/edit.php",$data);
			
			}
			

	}
	

	public function create()
	{
		$this->lib->render_view("modules/workshop/create.php");

		$this->load->helper('date');
		 $c_date = date("Y-m-d H:i:s");

		if($this->input->post('full_name'))
		{
		$data = array(
			'Workshop_Name' => $this->input->post('full_name'),
			'Workshop_Address' => $this->input->post('address'),
			'Workshop_GoldBalanceInGram' => $this->input->post('balance'),
			'Workshop_Contact_Mobile_Number1' => $this->input->post('number1'),
			'balance_inr' => $this->input->post('balance_inr'),
			'Workshop_Email_Id' => $this->input->post('email'),
			'id_proof_type' => $this->input->post('id_proof_type'),
			'id_proof_number' => $this->input->post('id_proof_number'),
			'Timestamp' => $c_date
		);
		
		$id_proof_file=$this->lib->upload_file("id_proof_file",$this->config->item("base_upload_path"));
			if($id_proof_file){ $values['id_proof_file']=$id_proof_file; }
		
		if($this->db->insert('workshops', $data))
		{
			
			redirect(site_url("workshop/browse"));
			

		}
	 }
	}
	
	public function mydelete()
    {
        $row_id = $this->input->post('partner_id');
        print_r($row_id);
        $this->db->delete("workshops",array("Workshop_Code"=>$row_id));
    }
	

	function submitid()
	{
		$id = $this->input->post('typeid');
		$this->session->set_userdata('workshop_id',$id);
		
      
		if($id)
		{
			//redirect(site_url("viewtask/browse"));
			redirect(site_url("goldtransaction/browse"));

		}
	}


	public function show($id){
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
			$this->load->model("Workshop_model");
			$workshop_code = $this->input->post('workshop_code');
			
			$result=$this->Workshop_model->get_users($page_start,$page_size);
			$data['id']=$id;
			$data['workshop'] = $this->Workshop_model->get_workshop_by_id($id);
			$data['status']=$this->Workshop_model->get_workshop_by_status($id);
			$data['cust']=$this->Workshop_model->get_customer($id);
			$data['orders']=$this->Workshop_model->get_order_details($id);
			$data['orders']['cust']=$this->Workshop_model->get_customers($id);

		//  echo "===================="; print_r($data['status']);
			// echo "=====+"; print_r($data['cust']);
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
			// =======================================
		//  	$datas= $row = array();        
        // // Fetch member's records
        // $oData=$this->Workshop_model->get_order_details($id);
		// 	// $odata['cust']=$this->Workshop_model->get_customers($id);      
        
        // $i=0;
        // foreach($oData as $row){    
		// 	$i++;
        //     $datas[] = array(
		// 		$i++,
		// 		$row['order_Code'],
		// 		$row['item_name'],
		// 		$row['tgrams'], 
		// 		$row['status'], 
            
        //     );
        // }
        
        // $output = array(
        //     "draw" => $_POST['draw'],
        //     "data" => $datas,
        // );
        
        // // Output to JSON format
        // echo json_encode($output);

			// $this->lib->render_view("modules/workshop/browse.php",$data);
			$this->lib->render_view("modules/workshop/workshop_orders.php",$data);
    
	}
// -------------------------------------------------
public function view_workshop(){
	$this->load->model('Workshop_model');
	
	$id= $this->input->post('id');
	$data= $row = array(); 
		
	   // Fetch member's records
	   $oData=$this->Workshop_model->get_order_details($id);
	
  $i=0;
   foreach($oData as $row){    
	  $i++;
	  $actionButton = '
	  <ul class="list-inline"> 
	  <li class="list-inline-item"> <a href="' . site_url("workshop/view_new_order/" . $row['order_code']) . '" style="color:green;cursor:pointer;margin-left:20px;">
	  <i class="fas fa-eye trashclass"></i>
 </a></li>             
		
	  </ul>';
	   $data[] = array(
	            $i,
		   $row['order_code'],
		   $row['item_name'],
		   $row['tgrams'], 
		   $row['status'], 
		   $row['Customer_Name'],
		   $actionButton
	   );
   }
   
   $output = array(
	   "draw" => $_POST['draw'],
	   "data" => $data,
   );
   
   // Output to JSON format
   echo json_encode($output);
	
	} 


	public function view_new_order($order_id){
		
		if($order_id){
			//load order model
			$this->load->model("Workshop_model");
			
			
			$data['order']=$this->Order_model->get_order($order_id);
			
			$this->lib->render_view("modules/workshop/view_orders.php",$data);
			
		
		
		} else {
			
			show_404();
		
		}
	
	}
	
	




}
