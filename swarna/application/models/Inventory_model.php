<?php
    class Inventory_model extends CI_Model{

    public function __construct(){
        $this->load->database();
        $output = array('success' => false, 'messages' => array());
        // Set table name
        $this->table = 'metal_inventory';
        // Set orderable column fields
        $this->column_order = array('id','metal_type', 'metal_shape', 'grams_per_unit', 'quantity','purchased_from','last_updated');
        // Set searchable column fields
        $this->column_search = array('id','metal_type', 'metal_shape', 'grams_per_unit', 'quantity','purchased_from','last_updated');
        
        // Set default order
        $this->order = array('created' => 'desc');
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
    function updateInventory(){      
        $id=$this->input->post('member_id');    
        $grams = $this->input->post('grams');
        $rate_per_gram = $this->input->post('rate_per_gram');
        $ded_Remarks = $this->input->post('ded_Remarks');
        $shop_user_name = $this->input->post('shop_user_name');
        $txn=$this->input->post('txn_type');
        
        $txn_type='c';
        if($txn=='deduct'){
			$txn_type='d';
		}
		
		$inventory=$this->getInventory();
		
		$new_balance=$inventory['balance_grams'];
        if($txn=='deduct'){
			$new_balance=$inventory['balance_grams']-$grams;
		} else {
			$new_balance=$inventory['balance_grams']+$grams;
		}
		$update_inv=array('balance_grams'=>$new_balance);
		$this->db->update('metal_inventory', $update_inv, array('id'=>$id));
        
        $ded_created = date('y-m-d h:i:s');
        $data = array('metal_inventory_id'=>$id, 'txn_type'=>$txn_type, 'grams'=>$grams, 
        'rate_per_gram'=>$rate_per_gram, 'remarks'=>$ded_Remarks, 'shop_user_name'=>$shop_user_name,'created'=>$ded_created);     
        $result = $this->db->insert('metal_inventory_passbook', $data);        

        if($result){
            $output['success'] = true;
            $output['messages'] = 'Inventory Updated successfully!';  
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
        $exp=$this->db->select('*')
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
                $row->grams,
                $row->rate_per_gram,
                $row->remarks,
                $row->shop_user_name,
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
