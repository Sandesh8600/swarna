<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class Stones extends CI_Controller {

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
			
			//load model
			$this->load->model("stones_model");
			
			$data=array();
			
			//edit stone type
			if($this->input->get("edit_form")=="yes"){
				
				$this->load->library("form_validation");
				$this->form_validation->set_rules("name","Stone Type Name", "required");
				
				
				if($this->form_validation->run()){
					
					$this->stones_model->update_stone_type();
					
					$this->lib->set_status("Stone Type have been updated!");
					
					redirect("stones/browse");

				} else { 
					
					
					$data['stone_type']=$this->stones_model->fetch_stone_type($this->input->get("stone_type_id"));
				
				}
				
			}
			
			//create category
			if($this->input->get("create_form")=="yes"){
				
				$this->load->library("form_validation");
				$this->form_validation->set_rules("name","Stone Type Name", "required");
				
				
				if($this->form_validation->run()){
					
					
						if($this->stones_model->create_stone_type()==true)
					
							$this->lib->set_status("New Stone type has been added!");
					else $this->lib->set_status(" Stone type already exist");
						redirect("stones/browse");

				}
				
			
			}
			
			//edit stone sub type
			if($this->input->get("subcat_edit_form")=="yes"){
				
				$this->load->library("form_validation");
				$this->form_validation->set_rules("name","Stone Sub Type", "required");
				$this->form_validation->set_rules("stone_type_id","Stone Type", "required");
				//$this->form_validation->set_rules("rate","Rate", "required");
				
				if($this->form_validation->run()){
					
					$this->stones_model->update_stone_subtype();
					
					$this->lib->set_status("Stone sub type has been updated!");
					
					redirect("stones/browse");

				} else { 
					$data['stone_sub_type']=$this->stones_model->fetch_stone_subtype($this->input->get("stone_subtype_id"));
				
				}
				
			}
			
			//create sub category
			if($this->input->get("subcat_create_form")=="yes"){
				
				$this->load->library("form_validation");
				$this->form_validation->set_rules("name","Stone Sub Type", "required");
				$this->form_validation->set_rules("stone_type_id","Stone Type", "required");
				//$this->form_validation->set_rules("rate","Rate", "required");
				
				if($this->form_validation->run()){
					
						$this->stones_model->create_stone_subtype();
					
						$this->lib->set_status("New stone sub type has been added!");
					
						redirect("stones/browse");
				}			
			
			}
			//edit stone item
			if($this->input->get("item_edit_form")=="yes"){
					
				$this->load->library("form_validation");
				$this->form_validation->set_rules("name","Stone item", "required");
				$this->form_validation->set_rules("stone_type_id","Stone Type", "required");
				$this->form_validation->set_rules("rate","Rate", "required");
				
				if($this->form_validation->run()){
					
					$this->stones_model->update_stone_subtype();
					
					$this->lib->set_status("Stone item has been updated!");
					
					redirect("stones/browse");

				} else { 
					$data['stone_item']=$this->stones_model->fetch_stone_item($this->input->get("stone_item_id"));
					$data['stone_subtype']=$this->stones_model->fetch_stone_subtypes_by_stone($data['stone_item']['stone_type_id']);
				
				}
				
			}
			
			//create stone item
			if($this->input->get("item_create_form")=="yes"){
				
				$this->load->library("form_validation");
				$this->form_validation->set_rules("name","Stone Item", "required");
				$this->form_validation->set_rules("stone_type_id","Stone Type", "required");
				$this->form_validation->set_rules("rate","Rate", "required");
				
				if($this->form_validation->run()){
					
						$this->stones_model->create_stone_item();
					
						$this->lib->set_status("New stone item has been added!");
					
						redirect("stones/browse");
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
			$result=$this->stones_model->get_stones($page_start,$page_size);
			
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
			

			$this->lib->render_view("modules/stones/browse.php",$data);

    }
	public function mydelete()
    {
        $row_id = $this->input->post('partner_id');
        //print_r($row_id);
        $this->db->delete("stone_type",array("id"=>$row_id));
    }
	public function stoneSubTypeDelete()
    {
        $row_id = $this->input->post('partner_id');
        //print_r($row_id);
        $this->db->delete("stone_sub_type",array("id"=>$row_id));
    }
	public function itemDelete()
    {
        $row_id = $this->input->post('partner_id');
        //print_r($row_id);
        $this->db->delete("stone_items",array("id"=>$row_id));
    }

	//Update the Inventory
	function addStones(){	
		$this->load->model("stones_model");	
		$data=$this->stones_model->addStones();
		echo json_encode($data);
	}

	//Get Single Inventory info
	function getStones(){		
		$this->load->model("stones_model");		
		$data=$this->stones_model->getStones();
		echo json_encode($data);
	}

	//Update the Inventory
	function deductStones(){	
		$this->load->model("stones_model");	
		$data=$this->stones_model->deductStones();
		echo json_encode($data);
	}

	//Add new inventory
    function dtStonetran(){
		$this->load->model("stones_model");	
		$data=$this->stones_model->dtStonetran();
		echo json_encode($data);
	}
}
