<?php
    class Category_model extends CI_Model{

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
        $query=$this->db->query("select u.* from category u where u.Category_ID=?", array($user_id));
		
		$result=$query->row_array();

        return $result;

      }
      public function fetch_user_name($user_name, $metal_type){


        // $query=$this->db->query("select u.*, account_info.* from customer u join account_info ON account_info.Customer_id = u.Customer_id where u.Customer_id=?", array($user_id));
        $query=$this->db->query("select u.* from category u where u.Category_Name=? and metal_type", array($user_name), array($metal_type));
		
		$result=$query->row_array();

        return $result;

      }
      
      public function fetch_subcat($id){
		  
        $query=$this->db->query("select * from subcategory where SubCategory_ID=?", array($id));
		
		$result=$query->row_array();

        return $result;

      }
	  public function fetch_jitem($id){
		  
        $query=$this->db->query("select * from jitems where item_id=?", array($id));
		
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
			
			$where.=" and u.Category_ID=?";
			
			array_push($count_params,$user_id);
			array_push($params,$user_id);
		 }
		 
		 if($this->input->get_post("firstname")){
			
			$firstname=$this->input->get("firstname");
			
			$where.=" and u.Category_Name=?";
			
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
			
			$where.=" and u.Category_ID=?";
			
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
		
		 if($this->input->get("metal_type")!=""){
			
			$metal_type=$this->input->get("metal_type");
			
			$where.=" and metal_type = ? ";
			
			array_push($count_params,$metal_type);
			array_push($params,$metal_type);
		 }
		 
		 //sort logic
		 $sort_key=$this->input->get("sort_key",true);
		 $sort_type=$this->input->get("sort_type",true);
		 
		 $sort_query="";
		 
		 $user_fields=array("Category_ID","Category_Name","Timestamp");
		 if(in_array($sort_key,$user_fields) and ($sort_type=="desc" or $sort_type=="asc")){
			
			$sort_query=" order by $sort_key $sort_type";
			
		 }
		 	 
		 //add page start and page size
		 array_push($params,$page_start, (int)$page_size);

        //count total 
		//echo "select count(u.Category_ID) as total_records from category u where 1 ".$where, $count_params;
        $count_query=$this->db->query("select count(u.Category_ID) as total_records from category u where 1 ".$where, $count_params);
        $count_results=$count_query->row_array();
        
        //build query
        $query=$this->db->query("select u.* from category u where 1 ".$where.$sort_query." limit ?,?",$params);
        $results=$query->result_array();

       
        
        //fetch sub categories
        foreach($results as $key=>$val):        
			$results[$key]['subcategories']=$this->getSubCategories($val['Category_ID']);
        endforeach;
        
        $data['records']=$results;
		$data['total_records']=$count_results['total_records'];
        return $data;

      }
      
	  public function getSubCategories($categoryId){
		$query=$this->db->query("select * from subcategory where Category_ID=?", $categoryId);
		$subcategories = $query->result_array();
		foreach($subcategories as $key=>$val):        
			$subcategories[$key]['jitems']=$this->getJwelleryItems($val['SubCategory_ID']);
        endforeach;
		return $subcategories;
	  }

	  public function getJwelleryItems($subCategoryId){
		
		$query=$this->db->query("select * from jitems where SubCategory_ID=?", $subCategoryId);
		$jitems= $query->result_array();		
		
		return $jitems; 
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
			'Category_Name' => $this->input->post('full_name'),
			'metal_type' => $this->input->post('metal_type'),
			'Timestamp' => $c_date
				);  
					
				
				
		   $this->db->update("category", $values, array("Category_ID"=>$user_id));
		   
		   return true;
		  
	   }
	   
	   /**
       * @author akshay@neutreum.com
       * @description to update a child profile info
       * */
       public function update_subcat(){
		   
		  $user_id=$this->input->post("subcategory_id"); 
		  $this->load->helper('date');
		 $c_date = date("Y-m-d H:i:s");
		   
		  $values=array(
			'Category_ID' => $this->input->post('category_id'),
			'SubCategory_Name' => $this->input->post('full_name'),
			//'SubCategory_Name' => $this->db->escape($this->input->post('full_name')),
			// 'making_charges_per_gram'=>$this->input->post('making_charges_per_gram'),
			// 'wastage_percent'=>$this->input->post('wastage_percent'),
			
			'Timestamp' => $c_date
				);  
		
				
		   $this->db->update("subcategory", $values, array("SubCategory_ID"=>$user_id));
		   
		   return true;
		  
	   }

	   /**
       * @author poonam
       * @description to update a jItem  info
       * */
	  public function update_jitem(){
		   
		$user_id=$this->input->post("item_id"); 
		$this->load->helper('date');
	   $c_date = date("Y-m-d H:i:s");
		 
		$values=array(
		  'Category_ID' => $this->input->post('category_id'),
		  'item_name' => $this->input->post('full_name'),
		  'SubCategory_ID' => $this->input->post('subcategory_id'),
		  'making_charges_per_gram'=>$this->input->post('making_charges_per_gram'),
		  'wastage_percent'=>$this->input->post('wastage_percent'),
		  'wastage_type'=>$this->input->post('wastage_type'),
		  
		  'Timestamp' => $c_date
			  );  
	  
			  
		 $this->db->update("jitems", $values, array("item_id"=>$user_id));
		//  echo $this->db->last_query();
		//  exit;
		 return true;
		
	 }
	   
}
