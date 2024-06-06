<?php
    class Workshop_model extends CI_Model{

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
        $query=$this->db->query("select u.* from workshops u where u.Workshop_Code=?", array($user_id));
		
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
			
			$where.=" and u.Workshop_Code=?";
			
			array_push($count_params,$user_id);
			array_push($params,$user_id);
		 }
		 
		 if($this->input->get_post("firstname")){
			
			$firstname=$this->input->get("firstname");
			
			$where.=" and u.Workshop_Name=?";
			
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
			
			$where.=" and u.Workshop_Code=?";
			
			array_push($count_params,$parent_email);
			array_push($params,$parent_email);
		 }
		 
		 if($this->input->get("created_to")){
			
			$created_from=date('Y-m-d',strtotime($this->input->get("created_from")));
			$created_to=date('Y-m-d',strtotime($this->input->get("created_to")));
			
			$where.=" and (date(u.TimeStamp) between ? and ?)";
			
			array_push($count_params,$created_from, $created_to);
			array_push($params,$created_from, $created_to);
		 }
		 
		 
		 //sort logic
		 $sort_key=$this->input->get("sort_key",true);
		 $sort_type=$this->input->get("sort_type",true);
		 
		 $sort_query="";
		 
		 $user_fields=array("Item_Code","Item_Name","TimeStamp");
		 if(in_array($sort_key,$user_fields) and ($sort_type=="desc" or $sort_type=="asc")){
			
			$sort_query=" order by $sort_key $sort_type";
			
		 }
		 	 
		 //add page start and page size
		 array_push($params,$page_start, (int)$page_size);

        //count total 
        $count_query=$this->db->query("select count(u.Workshop_Code) as total_records from workshops u where 1 ".$where, $count_params);
        $count_results=$count_query->row_array();
        
        //build query
        $query=$this->db->query("select u.* from workshops u where 1 ".$where.$sort_query." limit ?,?",$params);
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
			'Workshop_Name' => $this->input->post('full_name'),
			'Workshop_Address' => $this->input->post('address'),
			'Workshop_GoldBalanceInGram' => $this->input->post('balance'),
			'Workshop_Contact_Mobile_Number1' => $this->input->post('number1'),
			'balance_inr' => $this->input->post('balance_inr'),
			'Workshop_Email_Id' => $this->input->post('email'),
			'id_proof_number' => $this->input->post('id_proof_number'),
			'id_proof_type' => $this->input->post('id_proof_type'),
			'Timestamp' => $c_date
				);  
					
			$id_proof_file=$this->lib->upload_file("id_proof_file",$this->config->item("base_upload_path"));
			if($id_proof_file){ $values['id_proof_file']=$id_proof_file; }
				
		   $this->db->update("workshops", $values, array("Workshop_Code"=>$user_id));
		   
		   return true;
		  
	   }

//======================================

public function get_records(){
	$result=$this->db->query("select (select count( u.item_id) from order_items u where Workshop_Code NOT IN(0,'NULL')) Total_items, count( distinct u.Workshop_Code) as total_workshops, (select count( u.item_id) from order_items u where Workshop_Code NOT IN(0,'NULL') and status not in('assigned','Completed')) as balance,sum(approx_grams)+sum(wastage)as TW_order, (select sum(approx_grams)+sum(wastage) from order_items u where Workshop_Code Not IN(0,'NULL')and status in ('assigned')) as work_order_given  from order_items u" );
	$record=$result->row_array();	
     $voucher=$this->db->query("select sum(gold_per_voucher) as Tgp_voucher from workshops" );
	 $record['voucher']=$voucher->row_array();
	 $record['tgp_assigned']=$record['work_order_given'] - $record['voucher']['Tgp_voucher'];
	 $record['voucher_gold']=$record['TW_order'] - $record['voucher']['Tgp_voucher'];

	   return $record;
}	

public function get_each_records(){
	$query=$this->db->query("select  distinct Workshop_Code,  count(distinct item_id) T_assigned, sum(approx_grams) + sum(wastage)  AS TW_order,  (select count( u.item_id) from order_items u where Workshop_Code NOT IN(0,'NULL') and status not in('assigned','Completed')) from
order_items where Workshop_Code not in(0,'NULL')
group by
    Workshop_Code 
   ");
       

 return $query->result_array();
}

public function get_workshop_by_id($id){
	$query=$this->db->query("select count(distinct Order_Code) as no_orders, count(distinct item_id) as total_items, sum(approx_grams) + sum(wastage)  AS TW_order from order_items u where u.Workshop_Code=?", array($id));	
	$result=$query->row_array();
        return $result;
}
public function get_workshop_by_status($id){
$this->db->select('status');
$this->db->from('order_items'); 
$this->db->where('workshop_code', $id);

$query = $this->db->get();

$result = $query->result_array();
return $result;
}

public function get_customer($id){
	$this->db->select('COUNT(DISTINCT customers.Customer_Code) as customer_count');
	$this->db->from('orders');
	$this->db->join('order_items', 'order_items.order_Code = orders.order_Code');
	$this->db->join('customers', 'Customers.customer_Code = orders.Customer_Code');
	$this->db->where('order_items.Workshop_Code', $id);

	$query = $this->db->get();
	$result=$query->row_array();
        return $result;
}

public function get_order_details($id){
	// $this->db->distinct();
	$this->db->select('order_items.order_code, sum(order_items.approx_grams + order_items.wastage) as tgrams, order_items.status, jitems.item_name, customers.Customer_Name');
$this->db->from('order_items');
$this->db->join('jitems', 'order_items.item_id = jitems.item_id', 'left');
$this->db->join('orders', 'orders.order_code = order_items.order_code', 'left');
$this->db->join('customers', 'customers.customer_code = orders.customer_code', 'right');
$this->db->where('order_items.Workshop_Code', $id);
$this->db->group_by('order_items.order_code, order_items.status, jitems.item_name, customers.Customer_Name'); // Group by necessary columns
$query = $this->db->get();

        $result = $query->result_array();
        return $result;
}
public function get_customers($id){

	$this->db->select('customer_name');
	$this->db->from('orders');
	$this->db->join('order_items', 'order_items.order_Code = orders.order_Code');
	$this->db->join('customers', 'Customers.customer_Code = orders.Customer_Code');
	$this->db->where('order_items.Workshop_Code', $id);

	$query = $this->db->get();
	$result=$query->result_array();
        return $result;
}

public function get_order($order_id){
		  
	//order
	$query=$this->db->query("select o.*, (select Customer_Name from customers where Customer_Code=o.Customer_Code) as Customer_Name from orders o where Order_Code=?", $order_id);
	$order=$query->row_array();
	
	//order items
	$query=$this->db->query("select oi.*, (select Workshop_Name from workshops where Workshop_Code=oi.Workshop_Code) as Workshop_Name, (select Category_Name from category where Category_ID=oi.Category_ID) as Category_Name, (select SubCategory_Name from subcategory where SubCategory_ID=oi.SubCategory_ID) as SubCategory_Name,  (select item_name from jitems where item_id=oi.item_id) as item_name, (select wastage_type from jitems where item_id=oi.item_id) as wastage_type,  (select wastage_percent from jitems where item_id=oi.item_id) as wastage_percent from order_items oi where oi.Order_Code=?", $order_id);
	// echo $this->db->last_query();
	$order['order_items']=$query->result_array();
	// print_r($order['order_items']);
	//fetch customer
	$query_customer=$this->db->query("select * from customers where Customer_Code=?", $order['Customer_Code']);
	$order['customer']=$query_customer->row_array();
	
	//get order payments
	$query2=$this->db->query("select * from payments where Order_Code=?", $order_id);
	
	$order['payments']=$query2->result_array();
	
	return $order;

}

}
