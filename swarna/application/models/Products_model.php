<?php
    class Products_model extends CI_Model{

    	public function __construct()
		  {
			$this->load->database();
		  }

      /*
      * @author akshay@neutreum.com
      * @description to retrive a user by user_id
      */
      public function fetch_user($user_id){


        // $query=$this->db->query("select u.*, account_info.* from customer u join account_info ON account_info.Customer_id = u.Customer_id where u.Customer_id=?", array($user_id));
        $query=$this->db->query("select u.* from products u where u.Product_Code=?", array($user_id));
		
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
			
			$where.=" and u.Product_Code=?";
			
			array_push($count_params,$user_id);
			array_push($params,$user_id);
		 }
		 
		 if($this->input->get_post("firstname")){
			
			$firstname=$this->input->get("firstname");
			
			$where.=" and u.Product_Brand_Name=?";
			
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
			
			$where.=" and u.Product_Code=?";
			
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
		 
		 $user_fields=array("Product_Code","Product_Brand_Name","Timestamp");
		 if(in_array($sort_key,$user_fields) and ($sort_type=="desc" or $sort_type=="asc")){
			
			$sort_query=" order by $sort_key $sort_type";
			
		 }
		 	 
		 //add page start and page size
		 array_push($params,$page_start, (int)$page_size);

        //count total 
        $count_query=$this->db->query("select count(u.Product_Code) as total_records from products u where 1 ".$where, $count_params);
        $count_results=$count_query->row_array();
        
        //build query
        $query=$this->db->query("select u.*,category.Category_Name,subcategory.SubCategory_Name from products u join category ON category.Category_ID = u.Category_ID join subcategory ON subcategory.SubCategory_ID = u.SubCategory_ID where 1 ".$where.$sort_query." limit ?,?",$params);
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

				
				
		  if($this->input->post("Password")){
			
				$values['Password']=$this->input->post("Password");
			
		  }
				
		   $this->db->update("products", $values, array("Product_Code"=>$user_id));
		   
		   return true;
		  
	   }
	   
}
