<?php
    class GoldCalculation_model extends CI_Model{

    public function __construct(){
        $this->load->database();
        $output = array('success' => false, 'messages' => array());
        // // Set table name
        $this->table = 'gold_melting_calculation';
        // Set orderable column fields
        $this->column_order = array('id', 'final_gold', 'less_in_pure_gms', 'less_in_pure_percent', 'copper_grams', 'copper_percent', 'melting_loss', 'created_on');
        // Set searchable column fields
        $this->column_search = array('id', 'final_gold', 'less_in_pure_gms', 'less_in_pure_percent', 'copper_grams', 'copper_percent', 'melting_loss', 'created_on');
        
        // Set default order
        $this->order = array('created_on' => 'desc');
    }     
	
    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */
    public function getRows($postData){
        $this->_get_datatables_query($postData);        
        if($postData['length'] != -1){
            
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

       
    /*
     * Count all records
     */
    public function countAll(){
        
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData){
        
        $this->db->from($this->table);
 
        $i = 0;
        // loop searchable columns 
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
         
        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    
    function dtReceiptpop(){
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $exp=$this->db->select('py.Payment_code,py.Order_Code, py.Customer_Code, py.Grams, py.Quality, py.melting_loss, py.Timestamp, 
        py.jeweller_purity, py.melting_status, cu.Customer_Name, ji.item_name')
         ->from('payments py')
         ->join('orders odr', 'odr.Order_Code=py.Order_Code', 'left')
         ->join('customers cu', 'cu.Customer_Code=odr.Customer_Code', 'left')
         ->join('jitems ji', 'py.item_id=ji.item_id', 'left')
         ->where('py.melting_status','0')
         ->where('py.Payment_Method','gold')
         ->order_by("py.Order_Code", "desc")         
         ->get();
        $i=1;
        $output=[];
        $mlt = '';
        foreach ($exp->result() as $row) {
            if($row->melting_status==='0'){
                $mlt='<span class="badge badge-secondary">Unmelted</span>';
            }else{
                $mlt='<span class="badge badge-secondary">Melted</span>';
            }
            $actionButton = '
              <ul class="list-inline">  
                <li class="list-inline-item">
                <input type="checkbox" class="data-checkbox" value="1"></li>                
              </ul>';
              
              $net_weight_before_copper=($row->Grams-$row->melting_loss) * $row->jeweller_purity/100;
              
              $net_weight_after_copper=round($net_weight_before_copper+($net_weight_before_copper*7/100),3);

            $output[] = array(
                $row->Payment_code,
                $row->Order_Code,
                $row->Customer_Name,
                $row->Grams,
                $row->melting_loss,
                $row->jeweller_purity,
                $net_weight_after_copper,
                date('d-m-Y', strtotime($row->Timestamp)),
                $row->item_name,
                $mlt,
                $actionButton
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

    function dtInventorypop(){
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $exp=$this->db->select('id, metal_type, balance_grams')
         ->from('metal_inventory')
         ->where('metal_type','gold')
         ->order_by("created", "desc")         
         ->get();
        $i=1;
        $output=[];
        $text='';
        foreach ($exp->result() as $row) {
            $text = '<input type="text" class="form-control form-control-sm" id="pure-gold-quantity-'.$row->id.'" />';
            $actionButton = '
              <ul class="list-inline">  
                <li class="list-inline-item">
                <input type="checkbox" class="data-checkbox" value="1"></li>                
              </ul>';

            $output[] = array(
                $row->id,
                ucwords($row->metal_type),
                $row->balance_grams,
                $text,
                $actionButton
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

    //Add Inventory
    function addInventory(){          
        $metal_type = $this->input->post('metal_type');
        $metal_shape = $this->input->post('metal_shape');
        $metal_purity = $this->input->post('metal_purity');
        $gpu = $this->input->post('gpu');
        $quantity = $this->input->post('quantity');
        $shop_name = $this->input->post('shop_name');
        $created = date('y-m-d h:i:s');
        $data = array('metal_type'=>$metal_type, 'metal_shape'=>$metal_shape, 'grams_per_unit'=>$gpu, 
        'quantity'=>$quantity, 'created'=>$created, 'last_updated'=>$created, 
        'purchased_from'=>$shop_name, 'purity_percent'=>$metal_purity);     
        $result = $this->db->insert('metal_inventory',$data);        

        if($result){
            $output['success'] = true;
            $output['messages'] = 'Inventory Added successfully!';  
        }
        else{
            $output['success'] = false;
            $output['messages'] = 'Ooops! something went wrong';
        }
        return $output;
    }

    function delInventory(){
        $id=$this->input->post('member_id');
        $this->db->where('id', $id);
        $result=$this->db->delete('metal_inventory');
        if($result){
            $output['success'] = true;
            $output['messages'] = 'Successfully Removed Inventory';
        }else{
            $output['success'] = false;
            $output['messages'] = 'Error while removing Inventory!';
        }

        return($output);
    }

    function getInventory(){
        $id=$this->input->post('member_id');
        $gdoc=$this->db->get_where('metal_inventory', array('id'=>$id));
        return $gdoc->row_array(); 
    }

    //edit Inventory
    function updInventory(){      
        $id=$this->input->post('member_id');    
        $edit_metal_type = $this->input->post('edit_metal_type');
        $edit_metal_shape = $this->input->post('edit_metal_shape');
        $edit_metal_purity = $this->input->post('edit_metal_purity');
        $edit_gpu = $this->input->post('edit_gpu');
        $edit_quantity = $this->input->post('edit_quantity');
        $edit_shop_name = $this->input->post('edit_shop_name');
        $edit_created = date('y-m-d h:i:s');
        $data = array('metal_type'=>$edit_metal_type, 'metal_shape'=>$edit_metal_shape, 'grams_per_unit'=>$edit_gpu, 
        'quantity'=>$edit_quantity, 'last_updated'=>$edit_created, 
        'purchased_from'=>$edit_shop_name, 'purity_percent'=>$edit_metal_purity);     
        $result = $this->db->update('metal_inventory',$data,array('id'=>$id));        

        if($result){
            $output['success'] = true;
            $output['messages'] = 'Inventory Added successfully!';  
        }
        else{
            $output['success'] = false;
            $output['messages'] = 'Ooops! something went wrong';
        }
        return $output;
    }

    //deduct Inventory
    function deductInventory(){      
        $id=$this->input->post('member_id');    
        $ded_quantity = $this->input->post('ded_quantity');
        $ded_total_gram = $this->input->post('ded_total_gram');
        $ded_Remarks = $this->input->post('ded_Remarks');
        $txn_type='d';
        $ded_created = date('y-m-d h:i:s');
        $data = array('metal_inventory_id'=>$id, 'txn_type'=>$txn_type, 'quantity'=>$ded_quantity, 
        'grams'=>$ded_total_gram, 'remarks'=>$ded_Remarks, 'created'=>$ded_created);     
        $result = $this->db->insert('metal_inventory_passbook', $data);        

        if($result){
            $output['success'] = true;
            $output['messages'] = 'Deduction Added successfully!';  
        }
        else{
            $output['success'] = false;
            $output['messages'] = 'Ooops! something went wrong';
        }
        return $output;
    }

    //Datatable View
    function dtMetalInventory(){
		$bid = $this->input->post('bid');
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $exp=$this->db->select('id, metal_inventory_id, txn_type, quantity, grams, remarks, created')
         ->from('metal_inventory_passbook')
         ->where(array('metal_inventory_id'=>$bid))
         ->order_by('created', 'desc')
         ->get();
        $i=1;
        $output=[];        
        foreach ($exp->result() as $row) {         

            $output[] = array(
                $row->id,
                $row->metal_inventory_id,
                $row->txn_type,
                $row->quantity,
                $row->grams,
                $row->remarks,
                $row->created
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
    
    //update melting status
    function update_receipt_melting($receipt_id, $status=1){
		
		$values=array("melting_status"=>$status);
		
		$this->db->update("payments", $values, array("Payment_code"=>$receipt_id));
		
	}
	
	//inventory transaction
    function inventory_txn($inventory_id, $quantity, $txn_type, $comments){
		
		//fetch master record
		$query=$this->db->query("select * from metal_inventory where id=?", $inventory_id);
		$inventory=$query->row_array();
		
		$new_quantity=$inventory['balance_grams'];
		
		if($txn_type=='c'){
			$new_quantity=$inventory['balance_grams']+$quantity;
		}
		
		if($txn_type=='d'){
			$new_quantity=$inventory['balance_grams']-$quantity;
		}
		
		$values=array("balance_grams"=>$new_quantity);
		
		$this->db->update("metal_inventory", $values, array("id"=>$inventory_id));
		
		//insert txn
		$txn_values=array(
					"metal_inventory_id"=>$inventory_id,
					"txn_type"=>'d',
					"remarks"=>$comments,
					"grams"=>$quantity
					);
					
		$this->db->insert("metal_inventory_passbook",$txn_values);
		
	}
    
    //create gold calculation data
    function addMelting(){
		
		$values=array(
				"final_gold"=>$this->input->post("final_gold_grams"),
				"less_in_pure_gms"=>$this->input->post("less_in_pure_total"),
				"copper_grams"=>$this->input->post("copper_for_pure_gold"),
				"melting_loss"=>$this->input->post("melting_loss_grams"),
				"final_copper_grams"=>$this->input->post("final_copper")
				);
				
		$this->db->insert("gold_melting_calculation", $values);
		$gc_id=$this->db->insert_id();
		
		$receipts=$this->input->post("receipts");
		
		$pure_golds=$this->input->post("pure_gold");
		
		if($receipts){
			
			foreach($receipts as $key=>$val){
				$receipts[$key]['gold_melting_id']=$gc_id;
				
				$this->update_receipt_melting($receipts[$key]['receipt_id'],1);
			}
			
			$this->db->insert_batch("gold_melting_receipts",$receipts);
			
		}
		
		if($pure_golds){
			
			foreach($pure_golds as $key=>$val){
				$pure_golds[$key]['gold_melting_id']=$gc_id;
				
				$this->inventory_txn($pure_golds[$key]['pure_gold_id'], $pure_golds[$key]['quantity'], 'd', "For Gold calculation #".$gc_id);
			}
			
			$this->db->insert_batch("gold_melting_pure_gold",$pure_golds);
			
		}
		
		return true;
	
	}
	
	
	function delGoldCalculation($gc_id){
		
		
		//fetch receipts and update their status to unmelted
		$query=$this->db->query("select * from gold_melting_receipts where gold_melting_id=?", $gc_id);
		$receipts=$query->result_array();
		
		foreach($receipts as $grc){ $this->update_receipt_melting($grc['receipt_id'], 0); }
		
		//fetch pure golds and update back their used quantity
		$query=$this->db->query("select * from gold_melting_pure_gold where gold_melting_id=?", $gc_id);
		$pure_golds=$query->result_array();
		
		foreach($pure_golds as $gpg){ $this->inventory_txn($gpg['pure_gold_id'], $gpg['quantity'], 'c', "Gold calculation deleted #".$gc_id); }
		
		
		$this->db->where('gold_melting_id', $gc_id);
        $result=$this->db->delete('gold_melting_receipts');
        
        $this->db->where('gold_melting_id', $gc_id);
        $result=$this->db->delete('gold_melting_pure_gold');
		
		
        $id=$gc_id;
        $this->db->where('id', $id);
        $result=$this->db->delete('gold_melting_calculation');
        
        
        
        if($result){
            $output['success'] = true;
            $output['messages'] = 'Successfully Removed Gold melting record';
        }else{
            $output['success'] = false;
            $output['messages'] = 'Error while removing Gold melting record!';
        }

        return($output);
    }
    
    
    function fetch_gc($gc_id){
		
		//fetch gc
		$query=$this->db->query("select * from gold_melting_calculation where id=?", $gc_id);
		$gc=$query->row_array();
		
		//fetch receipts
		$query=$this->db->query("select * from gold_melting_receipts where gold_melting_id=?", $gc_id);
		$gc['receipts']=$query->result_array();
		
		//fetch pure golds
		$query=$this->db->query("select * from gold_melting_pure_gold where gold_melting_id=?", $gc_id);
		$gc['pure_golds']=$query->result_array();
		
		
		return $gc;
	}
}
