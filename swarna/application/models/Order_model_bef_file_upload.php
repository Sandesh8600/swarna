<?php
    class Order_model extends CI_Model{

    	public function __construct()
		  {
			$this->load->database();
		  }

		//fetch todays rate per gram
		public function get_rate_per_gram($type){
			
			$query=$this->db->query("select TodaysRatePerGram as rate_per_gram from todaysratepergram where date(Timestamp)=curdate() and metal_type=? order by Timestamp desc", $type);
			
			$result=$query->row_array();
			
			if($result){
				return $result['rate_per_gram'];
			} else {
				return 0;
			}
		
		
		}


      /*
      * @author akshay@neutreum.com
      * @description to retrive a user by user_id
      */
      public function fetch_user($user_id){


        // $query=$this->db->query("select u.*, account_info.* from customer u join account_info ON account_info.Customer_id = u.Customer_id where u.Customer_id=?", array($user_id));
        $query=$this->db->query("select u.*,pricebreakup.* from orders u join pricebreakup ON pricebreakup.Order_Code = u.Order_Code where u.Order_Code=?", array($user_id));
		
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
			
			$where.=" and u.Order_Code=?";
			
			array_push($count_params,$user_id);
			array_push($params,$user_id);
		 }


		 if($this->input->get_post("customer_email")){
			
			$parent_email=$this->input->get("customer_email");
			
			$where.=" and customers.Customer_Email=?";
			
			array_push($count_params,$parent_email);
			array_push($params,$parent_email);
		 }

		 if($this->input->get_post("phone_number")){
			
			$parent_email=$this->input->get("phone_number");
			
			$where.=" and customers.Customer_Mobile_Number1=?";
			
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
		 
		 $user_fields=array("Order_Code","Timestamp");
		 if(in_array($sort_key,$user_fields) and ($sort_type=="desc" or $sort_type=="asc")){
			
			$sort_query=" order by $sort_key $sort_type";
			
		 }
		 	 
		 //add page start and page size
		 array_push($params,$page_start, (int)$page_size);

        //count total 
        $count_query=$this->db->query("select count(u.Order_Code) as total_records from orders u join customers ON customers.Customer_Code = u.Customer_Code where 1 ".$where, $count_params);
        $count_results=$count_query->row_array();
        
        //build query
        $query=$this->db->query("select u.*, customers.Customer_Name, customers.Customer_Mobile_Number1, (select count(id) from order_items where Order_Code=u.Order_Code) as total_items, (select count(id) from order_items where Order_Code=u.Order_Code and Workshop_Code>0) as total_items_assigned from orders u join customers ON customers.Customer_Code = u.Customer_Code where 1 ".$where.$sort_query." limit ?,?",$params);
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
			'Customer_Code' => $this->input->post('customer_id'),
			'Product_Code' => $this->input->post('product_id'),
			'Order_Date' => $this->input->post('order_date'),
			'Required_date' => $this->input->post('required_date'),
			'Shipped_date' => $this->input->post('shipped_date'),
			'Order_Status' => $this->input->post('status'),
			
				);  


				$data1 = array(
					'Order_Code' => $user_id,
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
				
					$val = $this->input->post('addval');
					
			
					for($i=1;$i<=$val;$i++)
					{
					$pid = $this->input->post('hiddenproducts'.$i);
					$data2 = array(
						'Order_Code' => $user_id,
						'Item_Code' => $this->input->post('items'.$i),
						'ProductItem_WeightInGram' => $this->input->post('item_wt'.$i),
						'ProductItem_Price' => $this->input->post('item_price'.$i),
						'Timestamp' => $c_date
					);
					if($pid)
					{
						$this->db->update("productitems", $data2, array("ProductItem_Code"=>$pid));
					}else{
						$this->db->insert('productitems', $data2);
					}
				}
					
				
		  if($this->input->post("Password")){
			
				$values['Password']=$this->input->post("Password");
			
		  }
				
		   $this->db->update("orders", $values, array("Order_Code"=>$user_id));
		   $this->db->update("pricebreakup", $data1, array("Price_Code"=>$this->input->post('hiddenprice')));
		   return true;
		  
	   }
	   
	   
	   //update customer details
	   
       public function update_customer($customer_code){
		   
		 
			$c_date = date("Y-m-d H:i:s");
		   
		  $values=array(
			'Customer_Name' => $this->input->post('customer_name'),
			'Customer_Email' => $this->input->post('email'),
			'Customer_Pincode' => $this->input->post('pincode'),
			'Customer_Billing_address' => $this->input->post('address'),
			'Customer_City' => $this->input->post('city'),
			'Customer_Mobile_Number1' => $this->input->post('phone'),
			'pan' => $this->input->post('pan'),
			'opening_balance' => $this->input->post('opening_balance'),
			'Timestamp' => $c_date,
			"Customer_Status"=>$this->input->post("Status")
			);  
					
				
		   $this->db->update("customers", $values, array("Customer_Code"=>$customer_code));
		   
		   return true;
		  
	   }
	   
	   //update customer details from ajax
	   public function create_customer()
	  {
		
		 $c_date = date("Y-m-d H:i:s");

		 
		$data = array(
			'Customer_Name' => $this->input->post('customer_name'),
			'Customer_Email' => $this->input->post('email'),
			'Customer_Pincode' => $this->input->post('pincode'),
			'Customer_Billing_address' => $this->input->post('address'),
			
			'Customer_City' => $this->input->post('city'),
			'pan' => $this->input->post('pan'),
			'opening_balance' => $this->input->post('opening_balance'),
			'Customer_Mobile_Number1' => $this->input->post('phone'),
			
			'Timestamp' => $c_date,
			'Customer_Status' => 1
		);
		
		$this->db->insert('customers', $data);
		
		$Customer_Code=$this->db->insert_id();
		
		return $Customer_Code;
		
	 
	}
	   
	   
	 //fetch categories and sub categories
	 public function fetch_category_array(){
		 
		$query=$this->db->query("select *, '' as sub_categories from category");
		
		$categories=$query->result_array();
		
		foreach($categories as $key=>$val):
		
			$query1=$this->db->query("select * from subcategory where Category_ID=?", $val['Category_ID']);
			$categories[$key]['sub_categories']=$query1->result_array();
		
		endforeach;
		
		return $categories;
	 
	 }
	 
	 //fetch sub categories by category id
	 public function get_subcats_by_cat($cat_id){
		
		$query=$this->db->query("select * from subcategory where Category_ID=?", $cat_id);
		
		return $query->result_array();
		 
	 }
	   
	   
	  //fetch all workshops
	  public function all_workshops(){
		  
		$query=$this->db->query("select * from workshops");
		
		return $query->result_array();
	  
	  } 
	  
	  
	  //create new order 
	  public function create_new_order($receipt_gold_file_data,$receipt_silver_file_data){
		  
	  
			$values=array(
					"orderid"=>$this->input->post("order_id"),
					"Customer_Code"=>$this->input->post("Customer_Code_Selected"),
					"Order_Date"=>date("Y-m-d")
					);
					
			$this->db->insert("orders", $values);
			
			$Order_Code=$this->db->insert_id();
			
			if($Order_Code){
				
				$items=$this->input->post("item");
				
				if($items){
					$i=1;
					foreach($items as $key=>$val):
					
						$items[$key]['Order_Code']=$Order_Code;
					//	$items[$key]['making_charges']=$this->input->post("making_charge_per_gram_"+$i+"");
					$i++;
					endforeach;
				
					$this->db->insert_batch("order_items", $items);
				
				}
				
				// echo "<pre>"; print_r($items);
				// echo "</pre>";
				
				$stones=$this->input->post("stone");
				
				if($stones){
					
					foreach($stones as $key=>$val):
					
						$stones[$key]['order_id']=$Order_Code;
					
					endforeach;
				
					$this->db->insert_batch("order_stones", $stones);
				
				}
				
				
				//add receipts
				$receipts=$this->input->post("receipt");
				
				if($receipts){
					if($receipt_gold_file_data["upload_data"]["file_name"]!=''){
					echo	$receipt_file =$receipt_gold_file_data["upload_data"]["file_name"];
					}
					foreach($receipts as $key=>$val):
					
						$receipts[$key]['Order_Code']=$Order_Code;
						
						$val['Order_Code']=$Order_Code;
						$val['receipt_file'] = $receipt_file;
						$this->db->insert("payments", $val);
					
					endforeach;
				
					
				
				}
				//add cash receipts
				$cash_receipts=$this->input->post("cash_receipt");
				
				if($cash_receipts){
					
					foreach($cash_receipts as $key=>$val):
					
						//$cash_receipts[$key]['Order_Code']=$Order_Code;
						
						$val['Order_Code']=$Order_Code;
						
						$this->db->insert("payments", $val);
					
					endforeach;
				
					
				
				}
				
				//add receipts
				$silver_receipts=$this->input->post("silver_receipt");
				
				if($silver_receipts){
					if($receipt_silver_file_data["upload_data"]["file_name"]!=''){
						echo $receipt_silver_file =$receipt_silver_file_data["upload_data"]["file_name"];
					}
					foreach($silver_receipts as $key=>$val):
					
						$silver_receipts[$key]['Order_Code']=$Order_Code;
						
						$val['Order_Code']=$Order_Code;
						
						$this->db->insert("payments", $val);
					
					endforeach;
				
					
				
				}
			
			}
			exit;
			return true;
	  
	  }
	  
	  
	  
	  //update new order 
	  public function update_new_order(){
		  
			$order_code=$this->input->post("Order_Code");
	  
			$values=array(
					"Customer_Code"=>$this->input->post("Customer_Code_Selected"),
					"Order_Status"=>$this->input->post("Order_Status"),
					);
					
			$this->db->update("orders", $values, array("Order_Code"=>$order_code));
			
			
			if($order_code){
				
				//remove old items
				$this->db->delete("order_items", array("Order_Code"=>$order_code));
				
				$items=$this->input->post("item");
				
				if($items){
					
					foreach($items as $key=>$val):
					
						$items[$key]['Order_Code']=$order_code;
					
					endforeach;
				
					$this->db->insert_batch("order_items", $items);
				
				}
				
				//remove old items
				$this->db->delete("order_stones", array("order_id"=>$order_code));
				
				$stones=$this->input->post("stone");
				
				if($stones){
					
					foreach($stones as $key=>$val):
					
						$stones[$key]['order_id']=$order_code;
					
					endforeach;
				
					$this->db->insert_batch("order_stones", $stones);
				
				}
				
				
				//remove old receipts
				$this->db->delete("payments", array("Order_Code"=>$order_code));
				
				$receipts=$this->input->post("receipt");
				
				if($receipts){
					
					foreach($receipts as $key=>$val):
					
						$receipts[$key]['Order_Code']=$order_code;
						
						$val['Order_Code']=$order_code;
						
						$this->db->insert("payments", $val);
					
					endforeach;
				
				}
				
				
				//add receipts
				$silver_receipts=$this->input->post("silver_receipt");
				
				if($silver_receipts){
					
					foreach($silver_receipts as $key=>$val):
					
						$silver_receipts[$key]['Order_Code']=$order_code;
						
						$val['Order_Code']=$order_code;
						
						$this->db->insert("payments", $val);
					
					endforeach;
				
				}
				//add cash receipts
				$cash_receipts=$this->input->post("cash_receipt");
				
				if($cash_receipts){
					
					foreach($cash_receipts as $key=>$val):
					
						$cash_receipts[$key]['Order_Code']=$order_code;
						
						$val['Order_Code']=$order_code;
						
						$this->db->insert("payments", $val);
					
					endforeach;
				
					
				
				}
			
			}
			
			return true;
	  
	  }
	  
	  //fetch order
	  public function get_order($order_id){
		  
			//order
			$query=$this->db->query("select o.*, (select Customer_Name from customers where Customer_Code=o.Customer_Code) as Customer_Name from orders o where Order_Code=?", $order_id);
			$order=$query->row_array();
			
			//order items
			$query=$this->db->query("select oi.*, (select Workshop_Name from workshops where Workshop_Code=oi.Workshop_Code) as Workshop_Name, (select Category_Name from category where Category_ID=oi.Category_ID) as Category_Name, (select SubCategory_Name from subcategory where SubCategory_ID=oi.SubCategory_ID) as SubCategory_Name from order_items oi where oi.Order_Code=?", $order_id);
			$order['order_items']=$query->result_array();
			
			//fetch customer
			$query_customer=$this->db->query("select * from customers where Customer_Code=?", $order['Customer_Code']);
			$order['customer']=$query_customer->row_array();
			
			//get order payments
			$query2=$this->db->query("select * from payments where Order_Code=?", $order_id);
			
			$order['payments']=$query2->result_array();
			
			return $order;
	  
	  }
	  
	  //fetch sub cat
	  public function get_sub_cat($id){
		
			$query=$this->db->query("select * from subcategory where SubCategory_ID=?", $id);
			
			return $query->row_array();
		  
	  }
	  
	  
	  //fetch stone type
	  public function get_stone_types(){
		
			$query=$this->db->query("select * from stone_type");
			
			return $query->result_array();
		  
	  }
	  
	  //fetch stone sub type
	  public function get_stone_sub_types(){
		
			$query=$this->db->query("select * from stone_sub_type");
			
			return $query->result_array();
		  
	  }
	  
	  
	  //fetch stone sub type
	  public function get_stone_sub_type($id){
		
			$query=$this->db->query("select * from stone_sub_type where id=?", $id);
			
			return $query->row_array();
		  
	  }
	  
	  //fetch order stones
	  public function get_order_stones($order_code){
		  
		 
			$query=$this->db->query("select * from order_stones where order_id=?", $order_code);
			
			return $query->result_array();
		 
		}
	 
}
