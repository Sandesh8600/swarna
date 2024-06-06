<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class Products extends CI_Controller {

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
			$this->load->model("Products_model");
			
			$result=$this->Products_model->get_users($page_start,$page_size);
			
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
			

			$this->lib->render_view("modules/products/browse.php",$data);

    }
    
    public function edit($user_id){
		
			$this->load->model("Products_model");

			$this->load->library("form_validation");
			
			
			$this->form_validation->set_rules("full_name","full_name", "required");
			
			
			if($this->form_validation->run()){
				
				$this->Products_model->update();
				
				$this->lib->set_status("Products details have been updated!");
				
				redirect("products/browse");

			} else { 
				
				
				$data['user']=$this->Products_model->fetch_user($user_id);

				$this->lib->render_view("modules/products/edit.php",$data);
			
			}
			

	}

	
	

	public function create()
	{
		$this->lib->render_view("modules/products/create.php");

		$this->load->helper('date');
		 $c_date = date("Y-m-d H:i:s");

		if($this->input->post('full_name'))
		{
		$data = array(
			'Category_ID' => $this->input->post('category_id'),
			'SubCategory_ID' => $this->input->post('metal_id'),
			'Product_Stock_No' => $this->input->post('stock_no'),
			'Product_Brand_Name' => $this->input->post('full_name'),
            'Product_Approximate_Metal_Weight' => $this->input->post('weight'),
            'Product_Size' => $this->input->post('size'),
            'Product_Height' => $this->input->post('height'),
            'Product_Width' => $this->input->post('width'),
            'Product_Shape' => $this->input->post('shape'),
            // 'Product_Purity' => $this->input->post('quality'),
            
			'Timestamp' => $c_date

			
		);
		
		if($this->db->insert('products', $data))
		{
			$insert_id = $this->db->insert_id();
			$this->session->set_userdata("insertid",$insert_id);
			
			        redirect(site_url("products/gallery"));
				
			
			

		}
	 }
	}

	function submitid()
	{
		$id = $this->input->post('typeid');
		$this->session->set_userdata("insertid",$id);
		redirect(site_url("products/gallery"));

	}


	public function gallery()
	{
		$this->lib->render_view("modules/products/gallery.php");
	}
	
	public function formsubmit(){
        $filename = $_FILES['files']['name'];
        $file_tmp = $_FILES['files']['tmp_name'];
        $dir = 'gallery/';
        $id = $this->input->post('productid');
        
        // $location = $dir.''.$path;
        // $imagepath = $path.'/'.$filename;
        
        if (move_uploaded_file($file_tmp, $dir.$filename)) {
            $location = $dir.''.$filename;
            $data = array(
                'ProductImage' => $location,
                'Product_Code' => $id
            );
            if($this->db->insert('productimages', $data))
            {
                $valid = "uploaded Successfully!";
                $this->session->set_flashdata('valid', $valid);
                redirect(site_url("products/gallery"));
            }
            else{
                $valid = "upload fail!";
                $this->session->set_flashdata('valid', $valid);
                redirect(site_url("products/gallery"));
            }
        }else{
            echo 'failed';
        }
    }

	public function mydelete()
    {
        $row_id = $this->input->post('partner_id');
        print_r($row_id);
        $this->db->delete("productimages",array("ProductImage_Id"=>$row_id));
    }

	public function myproductdelete()
    {
        $row_id = $this->input->post('partner_id');
        print_r($row_id);
        $this->db->delete("products",array("Product_Code"=>$row_id));
    }
	

}
