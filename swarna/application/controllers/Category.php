<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class Category extends CI_Controller {

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
		 $metal_type=$this->input->get_post("metal_type"); 
			//load category model
			$this->load->model("Category_model");
			
			$data=array();
			
			//edit category
			if($this->input->get("edit_form")=="yes"){
				
				$this->load->library("form_validation");
				$this->form_validation->set_rules("full_name","full_name", "required");
				
				
				if($this->form_validation->run()){
					
					$this->Category_model->update();
					
					$this->lib->set_status("Category have been updated!");
					
					redirect("category/browse?metal_type=$metal_type");

				} else { 
					$data['cat']=$this->Category_model->fetch_user($this->input->get("category_id"));
				
				}
				
			}
			
			//create category
			if($this->input->get("create_form")=="yes"){
				
				$this->load->library("form_validation");
				$this->form_validation->set_rules("full_name","full_name", "required");
				
				
				if($this->form_validation->run()){
					
					$c_date = date("Y-m-d H:i:s");
					
					$data = array(
							'Category_Name' => $this->input->post('full_name'),
							'metal_type' => $this->input->post('metal_type'),
							'Timestamp' => $c_date
						);
						$result = $this->Category_model->fetch_user_name($this->input->post("full_name"), $this->input->post('metal_type'));

						if($result){
							$this->lib->set_status(" Category already exist.");
							
						}
						else{
							$this->db->insert('category', $data);
							$this->lib->set_status("New Category has been added!");
						}
					
						
					
						redirect("category/browse?metal_type=$metal_type");

				}
				
			
			}
			
			//edit category
			if($this->input->get("subcat_edit_form")=="yes"){
				
				$this->load->library("form_validation");
				$this->form_validation->set_rules("full_name","full_name", "required");
				$this->form_validation->set_rules("category_id","Category", "required");
				
				if($this->form_validation->run()){
					
					$this->Category_model->update_subcat();
					
					$this->lib->set_status("Sub J TYpe have been updated!");
					
					redirect("category/browse?metal_type=$metal_type");

				} else { 
					
					
					$data['subcategory']=$this->Category_model->fetch_subcat($this->input->get("subcategory_id"));
				
				}
				
			}
			
			//create sub category
			if($this->input->get("subcat_create_form")=="yes"){
				
				$this->load->library("form_validation");
				$this->form_validation->set_rules("full_name","full_name", "required");
				$this->form_validation->set_rules("category_id","Category", "required");
				
				if($this->form_validation->run()){
					
					$c_date = date("Y-m-d H:i:s");
					
					$data = array(
							'SubCategory_Name' => $this->input->post('full_name'),
							'Category_ID' => $this->input->post('category_id'),
							'Timestamp' => $c_date,
							// 'making_charges_per_gram'=>$this->input->post('making_charges_per_gram'),
							// 'wastage_percent'=>$this->input->post('wastage_percent'),
						);
						
						$this->db->insert('subcategory', $data);
						$this->lib->set_status("New Sub Category has been added!");
						redirect("category/browse?metal_type=$metal_type");
				}
			}
		//create J Items
		if($this->input->get("jitem_create_form")=="yes"){
				
			$this->load->library("form_validation");
			$this->form_validation->set_rules("full_name","full_name", "required");
			$this->form_validation->set_rules("category_id","Category", "required");
			
			if($this->form_validation->run()){
				
				$c_date = date("Y-m-d H:i:s");
				
				$data = array(
						'item_name' => $this->input->post('full_name'),
						'Category_ID' => $this->input->post('category_id'),
						'SubCategory_ID' => $this->input->post('sub_category_id'),
						'Timestamp' => $c_date,
						'making_charges_per_gram'=>$this->input->post('making_charges_per_gram'),
						'wastage_percent'=>$this->input->post('wastage_percent'),
						'wastage_type'=>$this->input->post('wastage_type'),
						'metal_type'=>$this->input->post('metal_type'),
					);
					// print_r($data); 
					$this->db->insert('jitems', $data);
					//  echo $this->db->last_query();
					$this->lib->set_status("New J Item has been added!");
					redirect("category/browse?metal_type=$metal_type");
			}
		}
		//edit jItem
		if($this->input->get("jitem_edit_form")=="yes"){
				
			$this->load->library("form_validation");
			$this->form_validation->set_rules("full_name","full_name", "required");
			$this->form_validation->set_rules("category_id","Category", "required");
			
			if($this->form_validation->run()){
				
				$this->Category_model->update_jitem();
				
				$this->lib->set_status("J Item have been updated!");
				
				redirect("category/browse?metal_type=$metal_type");

			} else { 
				
				$data['jwellery_item']=$this->Category_model->fetch_jitem($this->input->get("jitem_id"));
				
				$data['subcategory']=$this->Category_model->fetch_subcat($data['jwellery_item']["SubCategory_ID"]);
				
			}
			
		}
		
			$page=$this->input->get("page");
			
			if(!$page){
					
				$page=0;
			}
			
			$page_size=25;
			
			if($this->input->get("page_size")>0){
				$page_size=$this->input->get("page_size");
			}
			
			$page_start=$page_size*$page;

			
			
			$result=$this->Category_model->get_users($page_start,$page_size);
			
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
			
		
			$this->lib->render_view("modules/category/browse.php",$data);

    }
    
    public function edit($user_id){
		$metal_type=$this->input->get_post("metal_type"); 
			$this->load->model("Category_model");

			$this->load->library("form_validation");
			$this->form_validation->set_rules("full_name","full_name", "required");
			
			
			if($this->form_validation->run()){
				
				$this->Category_model->update();
				
				$this->lib->set_status("Category have been updated!");
				
				redirect("category/browse?metal_type=$metal_type");

			} else { 
				
				
				$data['user']=$this->Category_model->fetch_user($user_id);

				$this->lib->render_view("modules/category/edit.php",$data);
			
			}
			

	}
	

	public function create()
	{
		$this->lib->render_view("modules/category/create.php");
		$metal_type=$this->input->get_post("metal_type"); 
		$this->load->helper('date');
		$c_date = date("Y-m-d H:i:s");

		if($this->input->post('full_name'))
		{
			$data = array(
				'Category_Name' => $this->input->post('full_name'),
				'Timestamp' => $c_date

				
			);
			
			if($this->db->insert('category', $data))
			{
				
				redirect(site_url("category/browse?metal_type=$metal_type"));
				

			}
		}
	}
	
	public function mydelete()
    {
        $row_id = $this->input->post('partner_id');
        //print_r($row_id);
        $this->db->delete("category",array("Category_ID"=>$row_id));
    }
	public function deleteSubcat()
    {
        $row_id = $this->input->post('partner_id');
        //print_r($row_id);
        $this->db->delete("subcategory",array("SubCategory_ID"=>$row_id));
    }
	public function deleteJItem()
    {
        $row_id = $this->input->post('partner_id');
        //print_r($row_id);
        $this->db->delete("jitems",array("item_id"=>$row_id));
    }
	

}
