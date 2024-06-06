<?php

    class Stones_model extends CI_Model{

    	public function __construct()
		  {
			$this->load->database();
		  }

      /*
      * @author akshay@neutreum.com
      * @description to retrive a stone by id
      */
      public function fetch_stone_type($id){

        $query=$this->db->query("select * from stone_type where id=?", array($id));
		
		$result=$query->row_array();

        return $result;

      }
      
      
      public function fetch_stone_subtype($id){
		  
        $query=$this->db->query("select * from stone_sub_type where id=?", array($id));
		
		$result=$query->row_array();

        return $result;

      }
      public function fetch_stone_item($id){
		  
        $query=$this->db->query("select * from stone_items where id=?", array($id));
		
		$result=$query->row_array();

        return $result;

      }
      public function fetch_stone_subtypes_by_stone($stone_id){
		  
        $query=$this->db->query("select * from stone_sub_type where stone_type_id=?", array($stone_id));
		
		$result=$query->result_array();

        return $result;

      }


      /*
      * @author akshay@neutreum.com
      * @description to get all stones
      */
      public function get_stones($page_start,$page_size){
		  
		 $where="";
		
		//   if($this->input->get_post("lastname")){
			
		// 	$lastname=$this->input->get("lastname");
			
		// 	$where.=" and u.Last_name=?";
			
		// 	array_push($count_params,$lastname);
		// 	array_push($params,$lastname);
		//  }
		 
		$count_params=array();
		$params=array();
		 $sort_query="";
		 	 
		 //add page start and page size
		 array_push($params,$page_start, (int)$page_size);

        //count total 
        $count_query=$this->db->query("select count(id) as total_records from stone_type u where 1 ".$where, $count_params);
        $count_results=$count_query->row_array();
        
        //build query
        $query=$this->db->query("select * from stone_type where 1 ".$where.$sort_query." limit ?,?",$params);
        $results=$query->result_array();

       
        
        //fetch sub categories
        foreach($results as $key=>$val):

			$results[$key]['stone_sub_types']=$this->getSubStoneType($val['id']);
        
        endforeach;
        
        $data['records']=$results;
		$data['total_records']=$count_results['total_records'];

        return $data;

      }
      public function getSubStoneType($categoryId){
		$query=$this->db->query("select * from stone_sub_type where stone_type_id=?", $categoryId);
		
		$subcategories = $query->result_array();
		
		foreach($subcategories as $key=>$val):  
			$subcategories[$key]['stone_items']=$this->getStoneItems($val['id']);
        endforeach;
		return $subcategories;
	  }

	  public function getStoneItems($subCategoryId){
		
		$query=$this->db->query("select * from stone_items where stone_subtype_id=?", $subCategoryId);
		
		$jitems= $query->result_array();		
		
		return $jitems; 
	  }
      
      /**
       * @author akshay@neutreum.com
       * @description to create a stone info
       * */
       public function create_stone_type(){
		  
		   
		  $values=array(
			'name' => $this->input->post('name'),
				);  
			$query=$this->db->query("select * from stone_type where name=?", array($values));
			$result=$query->row_array();

        if(count($result)<=0) {
		   $this->db->insert("stone_type", $values);
		 
		   return true;
		} else return false;
	   }
     
	   
	   /**
       * @author akshay@neutreum.com
       * @description to update a stone info
       * */
       public function update_stone_type(){
		   
		  $stone_id=$this->input->post("stone_type_id"); 
		  
		   
		  $values=array(
			'name' => $this->input->post('name'),
				);  
					
		   $this->db->update("stone_type", $values, array("id"=>$stone_id));
		   
		   return true;
		  
	   }
	   
	   /**
       * @author akshay@neutreum.com
       * @description to create a stone sub type info
       * */
       public function create_stone_subtype(){
		  
		   
		  $values=array(
			'stone_type_id'=>$this->input->post('stone_type_id'),
			'name' => $this->input->post('name'),
			'grams'=>$this->input->post('grams'),
			'carat'=>$this->input->post('carat'),
			'numbers'=>$this->input->post('numbers'),
			'cents'=>$this->input->post('cents'),
			'rate'=>$this->input->post('rate'),
			'unit'=>$this->input->post('unit')
			);  
				
		   $this->db->insert("stone_sub_type", $values);
		   
		   return true;		  
	   }
	   /**
       * @author poonam
       * @description to create a stone item info
       * */
	  public function create_stone_item(){
		  
		   
		$values=array(
		  'stone_type_id'=>$this->input->post('stone_type_id'),
		  'stone_subtype_id'=>$this->input->post('stone_subtype_id'),
		  'name' => $this->input->post('name'),
		  'grams'=>$this->input->post('grams'),
		  'carat'=>$this->input->post('carat'),
		  'numbers'=>$this->input->post('numbers'),
		  'cents'=>$this->input->post('cents'),
		  'rate'=>$this->input->post('rate'),
		  'unit'=>$this->input->post('unit')
		  );  
			  
		 $this->db->insert("stone_items", $values);
		 
		 return true;		  
	 }
	   
	   /**
       * @author akshay@neutreum.com
       * @description to update a stone sub type info
       * */
       public function update_stone_subtype(){
		  
		  $stone_subtype_id=$this->input->post("stone_subtype_id"); 
		   
		  $values=array(
			'stone_type_id'=>$this->input->post('stone_type_id'),
			'name' => $this->input->post('name'),
			'grams'=>$this->input->post('grams'),
			'carat'=>$this->input->post('carat'),
			'numbers'=>$this->input->post('numbers'),
			'cents'=>$this->input->post('cents')
			// 'rate'=>$this->input->post('rate'),
			// 'unit'=>$this->input->post('unit')
			);  
			
		   $this->db->update("stone_sub_type", $values, array("id"=>$stone_subtype_id));
		   
		   return true;
		  
	   }
	   /**
       * @author poonam
       * @description to update a stone sub type info
       * */
	  public function update_stone_item(){
		  
		$stone_item_id=$this->input->post("id"); 
		 
		$values=array(
		  'stone_type_id'=>$this->input->post('stone_type_id'),
		  'stone_subtype_id'=>$this->input->post("stone_subtype_id"),
		  'name' => $this->input->post('name'),
		  'grams'=>$this->input->post('grams'),
		  'carat'=>$this->input->post('carat'),
		  'numbers'=>$this->input->post('numbers'),
		  'cents'=>$this->input->post('cents'),
		  'rate'=>$this->input->post('rate'),
		  'unit'=>$this->input->post('unit')
		  );  
		  
		 $this->db->update("stone_items", $values, array("id"=>$stone_item_id));
		 
		 return true;
		
	 }

	function getStones(){
        $id=$this->input->post('member_id');
        $gdoc=$this->db->get_where('stone_items', array('id'=>$id));
        return $gdoc->row_array(); 
    }

	function addStones(){
		$id=$this->input->post('member_id');  
		$sqty = $this->input->post('sqty');
        $osqty = $this->input->post('osqty');
		$avbqty = $sqty + $osqty;
        $sremarks = $this->input->post('sremarks');
        $created = date('y-m-d h:i:s');
        $data = array('available_quantity'=>$avbqty);     
        $result = $this->db->update('stone_items',$data,array('id'=>$id));     
		
		$datat = array('stone_item_id'=>$id, 'quantity'=>$sqty, 'txn_type'=>'c', 'remarks'=>$sremarks);   
		$results = $this->db->insert('stone_inventory_passbook',$datat); 
        if($result && $results){
            $output['success'] = true;
            $output['messages'] = 'Stone Inventory Added successfully!';  
        }
        else{
            $output['success'] = false;
            $output['messages'] = 'Ooops! something went wrong';
        }
        return $output;
	}

	function deductStones(){
		$id=$this->input->post('member_id');  
		$dqty = $this->input->post('dqty');
        $dsqty = $this->input->post('dsqty');
		$avbqty = $dsqty - $dqty;
        $dremarks = $this->input->post('dremarks');
        $created = date('y-m-d h:i:s');
        $data = array('available_quantity'=>$avbqty);     
        $result = $this->db->update('stone_items',$data,array('id'=>$id));     
		
		$datat = array('stone_item_id'=>$id, 'quantity'=>$dqty, 'txn_type'=>'d', 'remarks'=>$dremarks);   
		$results = $this->db->insert('stone_inventory_passbook',$datat); 
        if($result && $results){
            $output['success'] = true;
            $output['messages'] = 'Stone Inventory Added successfully!';  
        }
        else{
            $output['success'] = false;
            $output['messages'] = 'Ooops! something went wrong';
        }
        return $output;
	}

	//Datatable View
    function dtStonetran(){
		$bid = $this->input->post('bid');
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $exp=$this->db->select('id, stone_item_id, quantity, txn_type, remarks, created')
         ->from('stone_inventory_passbook')
         ->where(array('stone_item_id'=>$bid))
         ->order_by('created', 'desc')
         ->get();
        $i=1;
        $output=[];        
        foreach ($exp->result() as $row) {         

            $output[] = array(
                $i++, 
				$row->quantity,
				$row->txn_type,
				$row->remarks,
				_dtf($row->created)
            ); 
        } 
        $result = array(
               "draw" => $draw,
                 "recordsTotal" => $exp->num_rows(),
                 "recordsFiltered" => $exp->num_rows(),
                 "data" => $output
            );
        return $result;  
        exit();
    }
}
