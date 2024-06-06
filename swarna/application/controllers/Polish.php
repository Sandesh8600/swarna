<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class Polish extends CI_Controller {

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
			$order_type=array('polish') ; //, 'repair'
			if(!$page){
					
				$page=0;
			}
			
			$page_size=25000000;
			
			if($this->input->get("page_size")>0){
				$page_size=$this->input->get("page_size");
			}
			
			$page_start=$page_size*$page;

			//load order model
			$this->load->model("Polish_model");
			
			$result=$this->Polish_model->get_users($page_start,$page_size,$order_type);
			
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
			

			$this->lib->render_view("modules/polish/browse.php",$data);
			
    }
    
    public function edit($user_id){
		
			$this->load->model("Polish_model");

			$this->load->library("form_validation");
			$this->form_validation->set_rules("customer_id","customer_id", "required");
			
			
			if($this->form_validation->run()){
				
				$this->Polish_model->update();
				
				$this->lib->set_status("Order details have been updated!");
				
				redirect("polish/browse");

			} else { 
				
				
				$data['user']=$this->Polish_model->fetch_user($user_id);

				$this->lib->render_view("modules/polish/edit.php",$data);
			
			}
			
	}
	

	public function create()
	{
		$this->lib->render_view("modules/polish/create.php");

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
				

			   
			        redirect(site_url("polish/browse"));
				
			}

		}
	 }
	}
	
	
	

	function vieworder()
	{
		$this->lib->render_view("modules/polish/vieworder.php");
	}
	

	function submitid()
	{
		$id = $this->input->post('typeid');
		$this->session->set_userdata('viewtask_id',$id);
		if($id)
		{
			//redirect(site_url("viewtask/browse"));
			redirect(site_url("polish/vieworder"));

		}
	}

	public function mydelete()
    {
        $row_id = $this->input->post('partner_id');
        
        $this->db->delete("polish_orders",array("Order_Code"=>$row_id));
    }

	function update()
	{
		$this->lib->render_view("polish/polish/update.php");
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
			
			redirect(site_url("polish/vieworder"));
			

		}
	}
	
	
	//create customer from order create screen
	public function ajax_update_customer(){
		
		$this->load->model("Polish_model");
		
		$customer_code=$this->input->post("customer_code");
		
		$response['Customer_Code']="";
		$response['status']=false;
		
		if($customer_code){
			
			$response['Customer_Code']=$customer_code;
			
			$this->Polish_model->update_customer($customer_code);
			
			$response['status']=true;
			
		} else {
			
			$customer_code=$this->Polish_model->create_customer();
			
			$response['Customer_Code']=$customer_code;
			
			$response['status']=true;
		
		}
		
		
		echo json_encode($response);
	
	}
		
		
	///create new order
	public function create_new_order(){
		
		//load form validation
		$this->load->library("form_validation");
		
		//load order model
		$this->load->model("Polish_model");
		$metal_type = $this->input->post_get('metal_type');
		$this->form_validation->set_rules("Customer_Code_Selected","Customer", "required");
		$this->form_validation->set_rules("order_id","Order ID", "required");
		
		if($this->form_validation->run()){
			$config['upload_path']          = './uploads/order_receipts/';
			$config['allowed_types']        = 'jpeg|jpg|png';
			$title = "receipt";
			$silver_files = $_FILES['receipt_silver_file'];
			$gold_files = $_FILES['receipt_gold_file'];
			$order_files = $_FILES['receipt_order_file'];
			$this->load->library('upload', $config);
			$Order_Code = $this->Polish_model->create_new_order();
			$items=$this->input->post("item");
			//print_r($items);
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
						if(isset($_FILES['receipt_order_images']['name']) && $_FILES['receipt_order_images']['name']!=""){
						$this->upload->initialize($config);
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
				
					$this->Polish_model->add_order_items($Order_Code, $val);
				endforeach;
			
			}
			
			$receipts=$this->input->post("receipt");
			foreach ($receipts as $key => $val) {
				
				$this->Polish_model->add_gold_receipt($Order_Code,$val);
			
			}
			$silver_receipts=$this->input->post("silver_receipt");
			foreach ($silver_receipts as $key => $val) {
				
				$this->Polish_model->add_silver_receipt($Order_Code,$val);
			}
			
			
			$this->lib->set_status("Order created Successfully! ".$error['error']);
			//exit;
			redirect("polish/browse");
			
		} else {
			//$metal_type = $this->input->get_post('metal_type');
			$data['categories']=$this->Polish_model->fetch_category_array($metal_type);
			$data['workshops']=$this->Polish_model->all_workshops();
			//$data['metal_type'] = $data['order']['metal_type'];
			$data['rate_per_gram_gold']=$this->Polish_model->get_rate_per_gram("gold");
			$data['rate_per_gram_silver']=$this->Polish_model->get_rate_per_gram("silver");
			
			$data['stone_types']=$this->Polish_model->get_stone_types();
			$data['stone_sub_types']=$this->Polish_model->get_stone_sub_types();
			
		
			$this->lib->render_view("modules/polish/create_new_order.php",$data);
		
		}
	
	}
	
	///create new order
	public function edit_new_order($order_id){
		
		if($order_id){
		$metal_type = $this->input->post_get('metal_type');
			//load form validation
			$this->load->library("form_validation");
			
			//load order model
			$this->load->model("Polish_model");
			$items=$this->input->post("item");
			$this->form_validation->set_rules("Customer_Code_Selected","Customer", "required");
			$this->form_validation->set_rules("Order_Code","Order Code", "required");
			
			if($this->form_validation->run()){
				$config['upload_path']          = './uploads/order_receipts/';
			$config['allowed_types']        = 'jpeg|jpg|png|PNG|image/png';
		//	$config['allowed_types']        = '*';
			$title = "receipt";
				$order_files = $_FILES['receipt_order_file'];
				$this->load->library('upload', $config);
				$Order_Code = $this->Polish_model->update_new_order();
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
								echo	$receipt_file =$receipt_gold_file_data["upload_data"]["file_name"];
									$val['receipt_file'] = $receipt_file;
									
							}
							
						}
						}
						$val['Order_Code']=$Order_Code;
					
						$this->Polish_model->add_order_items($Order_Code, $val);
					endforeach;
				
				}
				$receipts=$this->input->post("receipt");
				foreach ($receipts as $key => $val) {
					
					$this->Polish_model->add_gold_receipt($Order_Code,$val);
					
				}
				$silver_receipts=$this->input->post("silver_receipt");
				foreach ($silver_receipts as $key => $val) {
					
					$this->Polish_model->add_silver_receipt($Order_Code,$val);
				}
				$this->lib->set_status("Order updated Successfully! ".$error['error']);
					
				redirect("polish/browse?metal_type=$metal_type");
				
			} else {
				$data['order']=$this->Polish_model->get_order($order_id);
				$metal_type = $data['metal_type'] = $data['order']['metal_type'];
				$data['categories']=$this->Polish_model->fetch_category_array($metal_type);
				$data['workshops']=$this->Polish_model->all_workshops();
				$data['rate_per_gram_gold']=$this->Polish_model->get_rate_per_gram("gold");
				$data['rate_per_gram_silver']=$this->Polish_model->get_rate_per_gram("silver");
				
				
				$data['order_stones']=$this->Polish_model->get_order_stones($order_id);
				
				$data['stone_types']=$this->Polish_model->get_stone_types();
				$data['stone_sub_types']=$this->Polish_model->get_stone_sub_types();
			
				$this->lib->render_view("modules/polish/edit_new_order.php",$data);
			
			}
		
		} else {
			
			show_404();
		
		}
	
	}
	
	
	///create new order
	public function view_new_order($order_id){
		
		if($order_id){
		
			
			
			//load order model
			$this->load->model("Polish_model");
			
			$this->load->model("user_model");
			
			
				
				
				$data['order']=$this->Polish_model->get_order($order_id);
				
				$data['customer']=$this->user_model->fetch_user($data['order']['Customer_Code']);
			
				$this->lib->render_view("modules/polish/view_new_order.php",$data);
			
		
		
		} else {
			
			show_404();
		
		}
	
	}
	
	//fetch sub category
	public function get_sub_cat(){
		
		//load order model
		$this->load->model("Polish_model");
		
		$id=$this->input->post("sub_cat_id");
		
		$data['subcat']=$this->Polish_model->get_sub_cat($id);
		
		echo json_encode($data);
	
	}
	
	//fetch stone sub type
	public function get_stone_sub_type(){
		
		//load order model
		$this->load->model("Polish_model");
		
		$id=$this->input->post("stone_sub_type_id");
		
		$data['stone_sub_type']=$this->Polish_model->get_stone_sub_type($id);
		
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
