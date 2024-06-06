<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class Inventory extends CI_Controller {

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		parent::__construct();

		$this->db->query("SET time_zone='+5:30'");
		
		//check if loggedin
		if(!$this->session->userdata("admin_id")){ redirect("login/validate"); }
		// $this->load->library('upload');
		// $this->load->helper(array('form', 'url'));
		$this->load->helper('common_functions');  
        $this->load->model('Inventory_model','invm');
	}
	
	public function browse(){
		$this->lib->render_view("modules/inventory/browse.php",$data);			
    }
    
    //Product Datatable view
	function dtInventory(){        
        $data = $row = array();        
        // Fetch member's records
        $memData = $this->invm->getRows($_POST);        
        $i = $_POST['start']+1;
        
        foreach($memData as $row){    
            $actionButton = '
            <ul class="list-inline"> 
                <!--<li class="list-inline-item"><a class="btn btn-outline-info text-info btn-xs" role="button" data-toggle="modal" 
                data-target="#editModal" data-backdrop="false" onclick="editMember('.$row->id.')"> Edit</a></li> -->
                <li class="list-inline-item"><a class="btn btn-outline-success text-success btn-xs" role="button" data-toggle="modal" 
                data-target="#deductModal" data-backdrop="false" onclick="deductMember('.$row->id.')">Add / Deduct</a></li>                 
                <!--<li class="list-inline-item d-print-none"><a class="btn btn-outline-danger text-danger btn-xs" role="button" 
                id="delete_inventory" data-id="'.$row->id.'" data-toggle="tooltip" title="Delete Inventory"> 
                Remove</a></li>-->  
                <li class="list-inline-item"><a class="btn btn-outline-primary text-primary btn-xs" role="button" data-toggle="modal" 
                data-target="#transModal" data-backdrop="false" onclick="transMember('.$row->id.')"> Trans</a></li> 
            </ul>';
            $data[] = array(
                $row->id,
                strtoupper($row->metal_type),
                $row->balance_grams,
                $row->created,                
                $actionButton
            );
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->invm->countAll(),
            "recordsFiltered" => $this->invm->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }
    
    //Add new inventory
    function addInventory(){
		$data=$this->invm->addInventory();
		echo json_encode($data);
	}

    //Delete the Inventory
	function delInventory(){
		$data=$this->invm->delInventory();
		echo json_encode($data);
	}

    //Get Single Inventory info
	function getInventory(){			
		$data=$this->invm->getInventory();
		echo json_encode($data);
	}
	//Update the Inventory
	function editInventory(){		
		$data=$this->invm->updInventory();
		echo json_encode($data);
	}
    //deduct the Inventory
	function updateInventory(){		
		$data=$this->invm->updateInventory();
		echo json_encode($data);
	}
	
	//Add new inventory
    function dtMetalInventory(){
		$data=$this->invm->dtMetalInventory();
		echo json_encode($data);
	}
    
    public function edit($user_id){
		
			$this->load->model("Order_model");

			$this->load->library("form_validation");
			
			
			$this->form_validation->set_rules("customer_id","customer_id", "required");
			
			
			if($this->form_validation->run()){
				
				$this->Order_model->update();
				
				$this->lib->set_status("Order details have been updated!");
				
				redirect("order/browse");

			} else { 
				
				
				$data['user']=$this->Order_model->fetch_user($user_id);

				$this->lib->render_view("modules/inventory/edit.php",$data);
			
			}
			
	}
	

	public function create()
	{
		$this->lib->render_view("modules/inventory/create.php");

		 $this->load->helper('date');
		 $c_date = date("Y-m-d h:i:s");
        // print_r($c_date);die;
		if($this->input->post('customer_id'))
		{
		$data = array(
			'Customer_Code' => $this->input->post('customer_id'),
			'Product_Code' => $this->input->post('product_id'),
			'Order_Date' => $c_date,
			'Required_date' => $this->input->post('required_date'),
			'Shipped_date' => $c_date,
			'Order_Status' => $this->input->post('status'),
			
			'Timestamp' => $c_date

			
		);
		
		if($this->db->insert('orders', $data))
		{
			$insert_id = $this->db->insert_id();
			$data1 = array(
			'Order_Code' => $insert_id,
			'Making_ChargesInPercent' => $this->input->post('making'),
			'Making_Charge_GSTInPercent' => $this->input->post('gst'),
			'Gold_GSTInPercent' => $this->input->post('gold_gst'),
			'Gold_Total' => $this->input->post('gold_total'),
            'WeightInGram' => $this->input->post('weight_gms'),
            'NetWeightInGram' => $this->input->post('wasatge'),
            'TodaysRatePerGram_ID' => $this->input->post('rate_id'),
            'WastageInPercent' => $this->input->post('wasatge'),
			'WeightOfWastageInGram' => $this->input->post('wasatge_gms'),
            'Making_total' => $this->input->post('making_total'),
            'Wastage_total' => $this->input->post('wastage_total'),
            'SubTotal' => $this->input->post('subtotal'),
            'Discount_On_Selling_Price' => $this->input->post('discount'),
			'SubTotal_After_Discount' => $this->input->post('sub_discount'),
            'Grand_Total' => $this->input->post('total'),
            
            
			'Timestamp' => $c_date
			);
			if($this->db->insert('pricebreakup', $data1))
		    {
				$getid = $insert_id;
				$val = $this->input->post('addval');
				
				for($i=1;$i<=$val;$i++)
				{
					
					$data2 = array(
						'Order_Code' => $getid,
						'Item_Code' => $this->input->post('items'.$i),
						'ProductItem_WeightInGram' => $this->input->post('item_wt'.$i),
						'ProductItem_Price' => $this->input->post('item_price'.$i),
						'Timestamp' => $c_date
					);
					$this->db->insert('productitems', $data2);
				}
				

			   
			        redirect(site_url("order/browse"));
				
			}

		}
	 }
	}
	
	
	

	function vieworder()
	{
		$this->lib->render_view("modules/order/vieworder.php");
	}
	

	function submitid()
	{
		$id = $this->input->post('typeid');
		$this->session->set_userdata('viewtask_id',$id);
		if($id)
		{
			//redirect(site_url("viewtask/browse"));
			redirect(site_url("order/vieworder"));

		}
	}

	public function mydelete()
    {
        $row_id = $this->input->post('partner_id');
        // print_r($row_id);
        $this->db->delete("orders",array("Order_Code"=>$row_id));
    }

	function update()
	{
		$this->lib->render_view("modules/order/update.php");
	}
	
	function status_create()
	{
		$this->load->helper('date');
		 $c_date = date("Y-m-d H:i:s");
		$data = array(
			'Order_Code' => $this->session->userdata('viewtask_id'),
			'Status' => $this->input->post('status'),
			'Description' => $this->input->post('description'),
			'admin_name' => $this->session->userdata("admin_name"),
			'Timestamp' => $c_date
		);

		if($this->db->insert('orderstatus', $data))
		{
			
			redirect(site_url("order/vieworder"));
			

		}
	}
	
	
	//create customer from order create screen
	public function ajax_update_customer(){
		
		$this->load->model("order_model");
		
		$customer_code=$this->input->post("customer_code");
		
		$response['Customer_Code']="";
		$response['status']=false;
		
		if($customer_code){
			
			$response['Customer_Code']=$customer_code;
			
			$this->order_model->update_customer($customer_code);
			
			$response['status']=true;
			
		} else {
			
			$customer_code=$this->order_model->create_customer();
			
			$response['Customer_Code']=$customer_code;
			
			$response['status']=true;
		
		}
		
		
		echo json_encode($response);
	
	}
		
	public function ajax_add_rate(){
		
		$this->load->model("Rate_model");
		
		$metal_type=$this->input->post("metal_type");
		$metal_rate=$this->input->post("metal_rate");
		
		$date = date("Y-m-d");
		$response['status']=false;
		$c_date = date("Y-m-d H:i:s");
		if($metal_rate){
			
			$response['metal_type']=$metal_type;
			$where_data = array(
							
				'metal_type'=>$metal_type,
				
			);
			$this->db->where( $where_data);
			$this->db->like('Timestamp', $date);
			$this->db->order_by("TodaysRatePerGram_ID", "desc");
			
			$this->db->from('todaysratepergram');
			
			$metal_rate_count =  $this->db->count_all_results(); 
			if($metal_rate_count>=2){
				
				$response['message']=" $metal_type Rate already added 2 times!";
			}
			else{
			$data = array(
				'TodaysRatePerGram' => $metal_rate,
				'metal_type'=>$metal_type,
				'Timestamp' => $c_date
	
				
			);
			
			if($this->db->insert('todaysratepergram', $data))
			{
				
				$response['status']=true;
				
	
			}
		}
			
		} 
		
		echo json_encode($response);
	
	}
	///create new order
	public function create_new_order(){
		
		//load form validation
		$this->load->library("form_validation");
		
		//load order model
		$this->load->model("Order_model");
		$metal_type=$this->input->post("metal_type");
		$this->form_validation->set_rules("Customer_Code_Selected","Customer", "required");
		$this->form_validation->set_rules("order_id","Order ID", "required");
		
		if($this->form_validation->run()){
			$config['upload_path']          = './uploads/order_receipts/';
			$config['allowed_types']        = 'jpeg|jpg|png|PNG|image/png';
			// $config['allowed_types']        = '*';
			$title = "receipt";
			$silver_files = $_FILES['receipt_silver_file'];
			$gold_files = $_FILES['receipt_gold_file'];
			$order_files = $_FILES['receipt_order_file'];
			
			$this->load->library('upload', $config);
			$Order_Code = $this->Order_model->create_new_order();
			$items=$this->input->post("item");
			if($items){
				
				foreach($items as $key=>$val):
					if(isset($order_files)){
			// 			echo "<pre>";
			// print_r($order_files);
						$_FILES['receipt_order_images']['name']= $order_files['name'][$key];
						$_FILES['receipt_order_images']['type']= $order_files['type'][$key];
						$_FILES['receipt_order_images']['tmp_name']= $order_files['tmp_name'][$key];
						$_FILES['receipt_order_images']['error']= $order_files['error'][$key];
						$_FILES['receipt_order_images']['size']= $order_files['size'][$key];
					
					//print_r($_FILES['receipt_order_images']);
						$fileName = $title .'_'. $$_FILES['receipt_order_images']['name'].'_'.strtotime("now");
						$config['file_name'] = $fileName;
						$this->upload->initialize($config);
						if(isset($_FILES['receipt_order_images']['name']) && $_FILES['receipt_order_images']['name']!=""){
							if ( ! $this->upload->do_upload('receipt_order_images'))
							{
									$error = array('error' => $this->upload->display_errors());
		
									print_r($error);
							}
							else
							{
									$receipt_gold_file_data = array('upload_data' => $this->upload->data());
									$receipt_file =$receipt_gold_file_data["upload_data"]["file_name"];
									$val['receipt_file'] = $receipt_file;
									
							}
						}
						
					}
					$val['Order_Code']=$Order_Code;
				// print_r( $val);
					$this->Order_model->add_order_items($Order_Code, $val);
				endforeach;
			
			}
			
			
			$receipts=$this->input->post("receipt");
			foreach ($receipts as $key => $val) {
				if(isset($gold_files)){
					$_FILES['receipt_gold_images']['name']= $gold_files['name'][$key];
					$_FILES['receipt_gold_images']['type']= $gold_files['type'][$key];
					$_FILES['receipt_gold_images']['tmp_name']= $gold_files['tmp_name'][$key];
					$_FILES['receipt_gold_images']['error']= $gold_files['error'][$key];
					$_FILES['receipt_gold_images']['size']= $gold_files['size'][$key];
				
				//print_r($_FILES['receipt_gold_images']);
					$fileName = $title .'gold_'. $$_FILES['receipt_gold_images']['name'].'_'.strtotime("now");
					$config['file_name'] = $fileName;
					$this->upload->initialize($config);
					if(isset($_FILES['receipt_gold_images']['name']) && $_FILES['receipt_gold_images']['name']!=""){
					if ( ! $this->upload->do_upload('receipt_gold_images'))
					{
							$error = array('error' => $this->upload->display_errors());

							print_r($error);
					}
					else
					{
							$receipt_gold_file_data = array('upload_data' => $this->upload->data());
							$receipt_file =$receipt_gold_file_data["upload_data"]["file_name"];
							$val['receipt_file'] = $receipt_file;
							
					}
					}
					
				}
				$this->Order_model->add_gold_receipt($Order_Code,$val);
				
			}
			$silver_receipts=$this->input->post("silver_receipt");
			foreach ($silver_receipts as $key => $val) {
				if(isset($silver_files)){
				$_FILES['receipt_gold_images']['name']= $silver_files['name'][$key];
				$_FILES['receipt_gold_images']['type']= $silver_files['type'][$key];
				$_FILES['receipt_gold_images']['tmp_name']= $silver_files['tmp_name'][$key];
				$_FILES['receipt_gold_images']['error']= $silver_files['error'][$key];
				$_FILES['receipt_gold_images']['size']= $silver_files['size'][$key];
				$fileName = $title .'silver_'. $$_FILES['receipt_gold_images']['name'].'_'.strtotime("now");
				$config['file_name'] = $fileName;
				$this->upload->initialize($config);
				if(isset($_FILES['receipt_gold_images']['name']) && $_FILES['receipt_gold_images']['name']!=""){
				if ( ! $this->upload->do_upload('receipt_gold_images'))
				{
						$error = array('error' => $this->upload->display_errors());

						print_r($error);
				}
				else
				{
						$receipt_gold_file_data = array('upload_data' => $this->upload->data());
						$receipt_file =$receipt_gold_file_data["upload_data"]["file_name"];
						$val['receipt_file'] = $receipt_file;
						
				}
			
				}
				}
				$this->Order_model->add_silver_receipt($Order_Code,$val);
			}
			
			
			$this->lib->set_status("Order created Successfully! ".$error['error']);
			// exit;
			redirect("order/browse");
			// redirect("order/browse?metal_type=$metal_type");
			
		} else {
			$metal_type = $this->input->get('metal_type');
			$data['categories']=$this->Order_model->fetch_category_array($metal_type);
			$data['workshops']=$this->Order_model->all_workshops();
			
			$data['rate_per_gram_gold']=$this->Order_model->get_rate_per_gram("gold");
			$data['rate_per_gram_silver']=$this->Order_model->get_rate_per_gram("silver");
			
			$data['stone_types']=$this->Order_model->get_stone_array();
			$data['stone_sub_types']=$this->Order_model->get_stone_sub_types();
			$data['metal_type']=$metal_type;
			$data['j_items']=$this->Order_model->getAllJwelleryItems();
		
			$this->lib->render_view("modules/order/create_new_order.php",$data);
		
		}
	
	}
	
	///create new order
	public function edit_new_order($order_id){
		
		if($order_id){
		$metal_type = $this->input->post_get('metal_type');
			//load form validation
			$this->load->library("form_validation");
			
			//load order model
			$this->load->model("Order_model");
			
			$this->form_validation->set_rules("Customer_Code_Selected","Customer", "required");
			$this->form_validation->set_rules("Order_Code","Order Code", "required");
			
			if($this->form_validation->run()){
				$items=$this->input->post("item");
			
				$Order_Code = $this->Order_model->update_new_order();
				$config['upload_path']          = './uploads/order_receipts/';
				$config['allowed_types']        = 'jpeg|jpg|png';
				$title = "receipt";
				$silver_files = $_FILES['receipt_silver_file'];
				$gold_files = $_FILES['receipt_gold_file'];
				$order_files = $_FILES['receipt_order_file'];
				$this->load->library('upload', $config);
				$receipt_file = "";
				if($items){
				
					foreach($items as $key=>$val):
						if(isset($order_files)){
				
							$_FILES['receipt_order_images']['name']= $order_files['name'][$key];
							$_FILES['receipt_order_images']['type']= $order_files['type'][$key];
							$_FILES['receipt_order_images']['tmp_name']= $order_files['tmp_name'][$key];
							$_FILES['receipt_order_images']['error']= $order_files['error'][$key];
							$_FILES['receipt_order_images']['size']= $order_files['size'][$key];
						
						//print_r($_FILES['receipt_order_images']);
							$fileName = $title .'_'. $$_FILES['receipt_order_images']['name'].'_'.strtotime("now");
							$config['file_name'] = $fileName;
							$this->upload->initialize($config);
							if(isset($_FILES['receipt_order_images']['name']) && $_FILES['receipt_order_images']['name']!=""){
								if ( ! $this->upload->do_upload('receipt_order_images'))
								{
										$error = array('error' => $this->upload->display_errors());
			
										print_r($error);
								}
								else
								{
										$receipt_gold_file_data = array('upload_data' => $this->upload->data());
										$receipt_file =$receipt_gold_file_data["upload_data"]["file_name"];
										$val['receipt_file'] = $receipt_file;
										
								}
								
							}
						}
						$val['Order_Code']=$Order_Code;
					
						$this->Order_model->add_order_items($Order_Code, $val);
					endforeach;
				
				}
				// echo "<pre>";
				// print_r($gold_files);
				$receipts=$this->input->post("receipt");
				foreach ($receipts as $key => $val) {
					if(isset($gold_files)){
						$_FILES['receipt_gold_images']['name']= $gold_files['name'][$key];
						$_FILES['receipt_gold_images']['type']= $gold_files['type'][$key];
						$_FILES['receipt_gold_images']['tmp_name']= $gold_files['tmp_name'][$key];
						$_FILES['receipt_gold_images']['error']= $gold_files['error'][$key];
						$_FILES['receipt_gold_images']['size']= $gold_files['size'][$key];
					
					//print_r($_FILES['receipt_gold_images']);
						$fileName = $title .'_'. $$_FILES['receipt_gold_images']['name'].'_'.strtotime("now");
						$config['file_name'] = $fileName;
						$this->upload->initialize($config);
						if(isset($_FILES['receipt_gold_images']['name']) && $_FILES['receipt_gold_images']['name']!=""){
							if ( ! $this->upload->do_upload('receipt_gold_images'))
							{
									$error = array('error' => $this->upload->display_errors());

									print_r($error);
							}
							else
							{
									$receipt_gold_file_data = array('upload_data' => $this->upload->data());
									$receipt_file =$receipt_gold_file_data["upload_data"]["file_name"];
									$val['receipt_file'] = $receipt_file;
									
							}
						}
						}
					$this->Order_model->add_gold_receipt($Order_Code,$val);
					
				}
				$silver_receipts=$this->input->post("silver_receipt");
				foreach ($silver_receipts as $key => $val) {
					if(isset($silver_files)){
					$_FILES['receipt_gold_images']['name']= $silver_files['name'][$key];
					$_FILES['receipt_gold_images']['type']= $silver_files['type'][$key];
					$_FILES['receipt_gold_images']['tmp_name']= $silver_files['tmp_name'][$key];
					$_FILES['receipt_gold_images']['error']= $silver_files['error'][$key];
					$_FILES['receipt_gold_images']['size']= $silver_files['size'][$key];
					$fileName = $title .'_'. $$_FILES['receipt_gold_images']['name'].'_'.strtotime("now");
					$config['file_name'] = $fileName;
					$this->upload->initialize($config);
				
					if ( ! $this->upload->do_upload('receipt_gold_images'))
					{
							$error = array('error' => $this->upload->display_errors());

							print_r($error);
					}
					else
					{
							$receipt_gold_file_data = array('upload_data' => $this->upload->data());
							$receipt_file =$receipt_gold_file_data["upload_data"]["file_name"];
							$val['receipt_file'] = $receipt_file;
							
					}
					
					}
					
					$this->Order_model->add_silver_receipt($Order_Code,$val);
				}
				// exit;
				$this->lib->set_status("Order updated Successfully! ".$error['error']);
					
				redirect("order/browse");
				
			} else {
				$data['order']=$this->Order_model->get_order($order_id);
				 $metal_type = $data['metal_type'] = $data['order']['metal_type'];
				$data['categories']=$this->Order_model->fetch_category_array($metal_type);
				$data['workshops']=$this->Order_model->all_workshops();
				$data['rate_per_gram_gold']=$this->Order_model->get_rate_per_gram("gold");
				$data['rate_per_gram_silver']=$this->Order_model->get_rate_per_gram("silver");
				
				
				$data['order_stones']=$this->Order_model->get_order_stones($order_id);
				
				$data['stone_types']=$this->Order_model->get_stone_array();
				// $data['stone_types']=$this->Order_model->get_stone_types();
				$data['stone_sub_types']=$this->Order_model->get_stone_sub_types();
				$data['stone_items']=$this->Order_model->get_stone_items();
				$data['j_items']=$this->Order_model->getAllJwelleryItems($metal_type);
			
				$this->lib->render_view("modules/order/edit_new_order.php",$data);
			
			}
		
		} else {
			
			show_404();
		
		}
	
	}
	
	
	///create new order
	public function view_new_order($order_id){
		
		if($order_id){
			//load order model
			$this->load->model("Order_model");
			
			$this->load->model("user_model");
				
			$data['order']=$this->Order_model->get_order($order_id);
			$data['order_stones']=$this->Order_model->get_order_stones($order_id);
			
			$data['customer']=$this->user_model->fetch_user($data['order']['Customer_Code']);
			$data['stone_types']=$this->Order_model->get_stone_types();
			$data['stone_sub_types']=$this->Order_model->get_stone_sub_types();
			$this->lib->render_view("modules/order/view_new_order.php",$data);
			
		
		
		} else {
			
			show_404();
		
		}
	
	}
	
	//fetch sub category
	public function get_sub_cat(){
		
		//load order model
		$this->load->model("Order_model");
		
		$id=$this->input->post("sub_cat_id");		
		$data['subcat']=$this->Order_model->get_sub_cat($id);		
		echo json_encode($data);
	
	}
	//fetch jItem
	public function get_jitem(){
		
		//load order model
		$this->load->model("Order_model");
		
		$id=$this->input->post("item_id");		
		$data['subcat']=$this->Order_model->get_jitem($id);		
		echo json_encode($data);
	
	}
	//fetch stone sub type
	public function get_stone_sub_type(){
		
		//load order model
		$this->load->model("Order_model");
		
		$id=$this->input->post("stone_sub_type_id");
		
		$data['stone_sub_type']=$this->Order_model->get_stone_sub_type($id);
		
		echo json_encode($data);
	
	}
	//fetch stone sub type
	public function get_stone_item(){
		
		//load order model
		$this->load->model("Order_model");
		
		$id=$this->input->post("stone_sub_type_id");
		
		$data['stone_item']=$this->Order_model->get_stone_item($id);
		// print_r($data['stone_item']);
		echo json_encode($data);
	
	}

	private function upload_files($path, $title, $files)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();

      //  foreach ($files['name'] as $key => $image) {
            $_FILES['images']['name']= $files['name'][$key];
            $_FILES['images']['type']= $files['type'][$key];
            $_FILES['images']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images']['error']= $files['error'][$key];
            $_FILES['images']['size']= $files['size'][$key];

            $fileName = $title .'_'. $image;
			$config['file_name'] = $fileName;
            $images[] = $fileName;

            

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
              //  $this->upload->data();
            } else {
                return false;
            }
       // }
        return $images;
    }

}
