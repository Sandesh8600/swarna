<?php
    class Rate_model extends CI_Model{

    	public function __construct()
		  {
			$this->load->database();
		  }

      /*
      * @author akshay@neutreum.com
      * @description to retrive a user by user_id
      */
      public function fetch_user($user_id){


        $query=$this->db->query("select u.* from todaysratepergram u where u.TodaysRatePerGram_ID=?", array($user_id));
		
		$result=$query->row_array();

        return $result;

      }


      /*
      * @author akshay@neutreum.com
      * @description to get all user records
      */
      public function get_users($page_start,$page_size){
		  
		 $where="";
		
		$count_params=array();
		$params=array();
		
		if($this->input->get_post("user_id")>0){
			
			$user_id=$this->input->get("user_id");
			
			$where.=" and u.TodaysRatePerGram_ID=?";
			
			array_push($count_params,$user_id);
			array_push($params,$user_id);
		 }
		 
		 if($this->input->get_post("firstname")){
			
			$firstname=$this->input->get("firstname");
			
			$where.=" and u.TodaysRatePerGram=?";
			$limit_query = "";
			array_push($count_params,$firstname);
			array_push($params,$firstname);
		 }
		 
		//   if($this->input->get_post("lastname")){
			
		// 	$lastname=$this->input->get("lastname");
			
		// 	$where.=" and u.Last_name=?";
			
		// 	array_push($count_params,$lastname);
		// 	array_push($params,$lastname);
		//  }
		 
		 if($this->input->get_post("parent_email")){
			
			$parent_email=$this->input->get("parent_email");
			
			$where.=" and u.Customer_Email=?";
			
			array_push($count_params,$parent_email);
			array_push($params,$parent_email);
		 }

		 if($this->input->get_post("customer_id")){
			
			$parent_email=$this->input->get("customer_id");
			
			$where.=" and u.TodaysRatePerGram_ID=?";
			
			array_push($count_params,$parent_email);
			array_push($params,$parent_email);
		 }
		
		 if($this->input->get("created_to")){
			
			$created_from=date('Y-m-d',strtotime($this->input->get("created_from")));
			$created_to=date('Y-m-d',strtotime($this->input->get("created_to")));
			
			$where.=" and (date(u.Timestamp) between ? and ?)";
			
			array_push($count_params,$created_from, $created_to);
			array_push($params,$created_from, $created_to);
		 }
		 
		 
		 //sort logic
		 $sort_key=$this->input->get("sort_key",true);
		 $sort_type=$this->input->get("sort_type",true);
		 
		 $sort_query="order by TodaysRatePerGram_ID desc";
		 
		 $user_fields=array("TodaysRatePerGram_ID","TodaysRatePerGram","Timestamp");
		 if(in_array($sort_key,$user_fields) and ($sort_type=="desc" or $sort_type=="asc")){
			
			$sort_query=" order by $sort_key $sort_type";
			
		 }
		 	 
		 //add page start and page size
		 if($page_size>1){
			array_push($params,$page_start, (int)$page_size);
			$limit_query = "limit $page_start, $page_size";
		 }
		

        //count total 
        $count_query=$this->db->query("select count(u.TodaysRatePerGram_ID) as total_records from todaysratepergram u where 1 ".$where, $count_params);
        $count_results=$count_query->row_array();
        
        //build query
        $query=$this->db->query("select u.* from todaysratepergram u where 1 ".$where.$sort_query." $limit_query ");
		//  echo $this->db->last_query(); exit;
        $results=$query->result_array();

        $data['records']=$results;
		$data['total_records']=$count_results['total_records'];

        return $data;

      }
      
      
     
	   
	   /**
       * @author akshay@neutreum.com
       * @description to update a child profile info
       * */
       public function update(){
		   
		  $user_id=$this->input->post("User_id"); 
		  $this->load->helper('date');
		 $c_date = date("Y-m-d H:i:s");
		   
		  $values=array(
			'TodaysRatePerGram' => $this->input->post('full_name'),
			'metal_type' => $this->input->post('metal_type'),
			'Timestamp' => $c_date
				);  
					
		
				
		   $this->db->update("todaysratepergram", $values, array("TodaysRatePerGram_ID"=>$user_id));
		   
		   return true;
		  
	   }
	   
}
