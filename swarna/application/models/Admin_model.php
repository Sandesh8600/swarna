<?php
    class Admin_model extends CI_Model{

    	public function __construct()
		  {
			$this->load->database();
		  }

      /*
      * @author wvsoftek
      * @description to retrive a admin by admin_id
      */
      public function fetch_admin($admin_id){


        $query=$this->db->query("select * from admin where admin_id=?", array($admin_id));
        $result=$query->row_array();

        return $result;

      }

      /*
      * @author wvsoftek
      * @description to get all admins records page
      */
      public function get_admins($page_start,$page_size){
        
        //count total 
        $count_query=$this->db->query("select count(admin_id) as total_records from admin");
        $count_results=$count_query->row_array();
        
        //retrieve page
        $query=$this->db->query("select admin_id, admin_name, email, status from admin limit ?,?",array($page_start, $page_size));
        $results=$query->result_array();

		$data['records']=$results;
		$data['total_records']=$count_results['total_records'];

        return $data;

      }
      
      /**
       * @author wvsoftek
       * @description to create a new admin
       * */
       public function create(){
		   
		  $values=array(
				"admin_name"=>$this->input->post("admin_name"),
				"email"=>$this->input->post("email"),
				"status"=>$this->input->post("status"),
				"password"=>md5($this->input->post("password"))
				);   
				
		   $this->db->insert("admin", $values);
		   
		   return true;
		  
	   }
	   
	   /**
       * @author wvsoftek
       * @description to update a admin record
       * */
       public function update(){
		   
		  $admin_id=$this->input->post("admin_id"); 
		   
		  $values=array(

				"admin_name"=>$this->input->post("admin_name"),
				"email"=>$this->input->post("email"),
				"status"=>$this->input->post("status")

				);   
				
			if($this->input->post("password")){
			
				$values['password']=md5($this->input->post("password"));
				
			}
				
		   $this->db->update("admin", $values, array("admin_id"=>$admin_id));   
		   return true;
		  
	   }

}
