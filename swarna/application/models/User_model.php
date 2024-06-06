<?php
    class User_model extends CI_Model{

    	public function __construct()
		  {
			$this->load->database();
		  }

      /*
      * @author akshay@neutreum.com
      * @description to retrive a user by user_id
      */
      public function fetch_user($user_id){
       
        $query=$this->db->query("select u.* from customers u where u.Customer_Code=?", array($user_id));
		
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
			
			$where.=" and u.Customer_Code=?";
			
			array_push($count_params,$user_id);
			array_push($params,$user_id);
		 }
		 
		 if($this->input->get_post("firstname")){
			
			$firstname=trim($this->input->get("firstname"));
			
			$where.=" and u.Customer_Name like ?";
			
			array_push($count_params,"%".$firstname."%");
			array_push($params,"%".$firstname."%");
		 }
		 
		//   if($this->input->get_post("lastname")){
			
		// 	$lastname=$this->input->get("lastname");
			
		// 	$where.=" and u.Last_name=?";
			
		// 	array_push($count_params,$lastname);
		// 	array_push($params,$lastname);
		//  }
		 
		 if($this->input->get_post("parent_email")){
			
			$parent_email=trim($this->input->get("parent_email"));
			
			$where.=" and u.Customer_Email=?";
			
			array_push($count_params,$parent_email);
			array_push($params,$parent_email);
		 }

		 if($this->input->get_post("customer_mobile")){
			
			$parent_email=trim($this->input->get("customer_mobile"));
			
			$where.=" and u.Customer_Mobile_Number1=?";
			
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
		 
		 $sort_query="";
		 
		 $user_fields=array("Customer_Code","Customer_Name","Customer_Email","Timestamp","Customer_Status");
		 if(in_array($sort_key,$user_fields) and ($sort_type=="desc" or $sort_type=="asc")){
			
			$sort_query=" order by $sort_key $sort_type";
			
		 }
		 	 
		 //add page start and page size
		// array_push($params,$page_start, (int)$page_size);

        //count total 
        $count_query=$this->db->query("select count(u.Customer_Code) as total_records from customers u where 1 ".$where, $count_params);
        $count_results=$count_query->row_array();
        
        //build query
        $query=$this->db->query("select u.* from customers u where 1 ".$where.$sort_query." ",$params);
      //  $query=$this->db->query("select u.* from customers u where 1 ".$where.$sort_query." limit ?,?",$params);
        $results=$query->result_array();
//echo $this->db->last_query();
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
			'Customer_Name' => $this->input->post('full_name'),
			'Customer_Email' => $this->input->post('email'),
			'Customer_Pincode' => $this->input->post('pincode'),
			'Customer_Billing_address' => $this->input->post('current'),
			'Customer_City' => $this->input->post('city'),
			'Customer_Mobile_Number1' => $this->input->post('phone1'),
			'pan' => $this->input->post('pan'),
			'opening_balance' => $this->input->post('opening_balance'),
			'making_charge' => $this->input->post('making_charge'),
			'silver_opening_balance' => $this->input->post('silver_opening_balance'),
			'Timestamp' => $c_date,
			"Customer_Status"=>1
			);  
					
				
		   $this->db->update("customers", $values, array("Customer_Code"=>$user_id));
		   
		   return true;
		  
	   }
	   
	   
	   //search customer
	   public function search_customer(){
		   
			$data['status']=false;
			
			$mobile=$this->input->post("mobile");
			
			if($mobile){
				
				$query=$this->db->query("select * from customers where Customer_Mobile_Number1 like ?", "%".$mobile."%");
				$result=$query->row_array();
				
				if($result){
					
					$data['status']=true;
					
					$data['name']=$result['Customer_Name'];
					$data['email']=$result['Customer_Email'];
					$data['pincode']=$result['Customer_Pincode'];
					$data['address']=$result['Customer_Billing_address'];
					$data['city']=$result['Customer_City'];
					$data['pan']=$result['pan'];
					$data['opening_balance']=$result['opening_balance'];
					$data['silver_opening_balance']=$result['silver_opening_balance'];
					$data['making_charge']=$result['making_charge'];
					$data['Customer_Code']=$result['Customer_Code'];
				
				}
				
			}
			
			return $data;
	   
	   }
	   
	   
}
