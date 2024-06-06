<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class GoldCalculation extends CI_Controller {

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		parent::__construct();

		$this->db->query("SET time_zone='+5:30'");
		
		//check if loggedin
		if(!$this->session->userdata("admin_id")){ redirect("login/validate"); }
		// $this->load->library('upload');
		// $this->load->helper(array('form', 'url'));
		$this->load->helper('common_functions');  
        $this->load->model('GoldCalculation_model','gcm');
	}
	
	public function browse(){
		$this->lib->render_view("modules/gcalculation/browse.php",$data);			
    }
    
    //Product Datatable view
	function dtGoldCalculation(){        
        $data = $row = array();        
        // Fetch member's records
        $memData = $this->gcm->getRows($_POST);        
        $i = $_POST['start']+1;
        
        foreach($memData as $row){    
            $actionButton = '
            <ul class="list-inline"> 
                <li class="list-inline-item"><a class="btn btn-outline-info text-info btn-xs" role="button" data-toggle="modal" 
                data-target="#GcViewModal" data-backdrop="false" onclick="viewGC('.$row->id.')"> View</a></li>             
                <li class="list-inline-item d-print-none"><a class="btn btn-outline-danger text-danger btn-xs" role="button" 
                id="delete_gc" data-id="'.$row->id.'" data-toggle="tooltip" title="Delete"> 
                Remove</a></li>
            </ul>';
            $data[] = array(
                $row->id,
                $row->final_gold,
                $row->less_in_pure_gms, 
                $row->copper_grams, 
                $row->melting_loss, 
                _dtf($row->created_on),                
                $actionButton
            );
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->gcm->countAll(),
            "recordsFiltered" => $this->gcm->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }

	function dtReceiptpop(){
		$data=$this->gcm->dtReceiptpop();
		echo json_encode($data);
	}

	function dtInventorypop(){
		$data=$this->gcm->dtInventorypop();
		echo json_encode($data);
	}
    
    //Add new inventory
    function addInventory(){
		$data=$this->gcm->addInventory();
		echo json_encode($data);
	}

    //Delete the Inventory
	function delGoldCalculation(){
		
		$gold_calculation_id=$this->input->post("gold_calculation_id");
		
		$data=$this->gcm->delGoldCalculation($gold_calculation_id);
		echo json_encode($data);
	}

    //Get Single Inventory info
	function getInventory(){			
		$data=$this->gcm->getInventory();
		echo json_encode($data);
	}
	//Update the Inventory
	function editInventory(){		
		$data=$this->gcm->updInventory();
		echo json_encode($data);
	}
    //deduct the Inventory
	function deductInventory(){		
		$data=$this->gcm->deductInventory();
		echo json_encode($data);
	}

	//Add new inventory
    function dtMetalInventory(){
		$data=$this->gcm->dtMetalInventory();
		echo json_encode($data);
	}
    

	//create gold calculation
	public function create()
	{
		
		//load form validation
		$this->load->library("form_validation");
		
		//load order model
		$this->form_validation->set_rules("copper_for_pure_gold","copper_for_pure_gold", "required");
		$this->form_validation->set_rules("final_copper","final_copper", "required");
		$this->form_validation->set_rules("less_in_pure_total","less_in_pure_total", "required");
		$this->form_validation->set_rules("final_gold_grams","final_gold_grams", "required");
		$this->form_validation->set_rules("melting_loss_grams","melting_loss_grams", "required");
		
		if($this->form_validation->run()){
			
			$this->gcm->addMelting();
			
			redirect("GoldCalculation/browse");
			
		} else {
		
			$this->lib->render_view("modules/gcalculation/create.php");

		}
	}
	
	

	
	public function getGc(){
		
		$gc_id=$this->input->post('gold_calculation_id');
		
		if($gc_id){
			
			$gc=$this->gcm->fetch_gc($gc_id);
			
			?>
			
			
			
			<table class="table table-striped table-bordered nowrap" style="width:100%;  font-size:13px;">
				<thead class="bg-light">
					<tr>
						<th>Type</th>
						<th>Gold Grams</th>
						<th>Std %</th>
						<th>%</th>
						<th>Diff %</th>
						<th>Less in pure gms</th>
						<th>Customer</th>
						<th>Item</th>
					</tr>
				</thead>
				<tbody class="details">
					<?php foreach($gc['receipts'] as $rc): ?>
					<tr>
						<td>Receipt #<?php echo $rc['receipt_id']; ?></td>
						<td><?php echo $rc['net_weight']; ?></td>
						<td>92.5%</td>
						<td><?php echo 92.5-$rc['diff_percent']; ?>%</td>
						<td><?php echo $rc['diff_percent']; ?>%</td>
						<td><?php echo $rc['less_in_pure_grams']; ?></td>
						<td><?php echo $rc['customer']; ?></td>
						<td><?php echo $rc['j_items']; ?></td>
					</tr>
					<?php endforeach; ?>
					
					<?php foreach($gc['pure_golds'] as $pg): ?>
					<tr>
						<td>Pure Gold #<?php echo $pg['pure_gold_id']; ?></td>
						<td><?php echo $pg['grams']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>Pure Gold</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						
						<td><strong>Copper 8% on pure gold</strong></td>
						<td><?php echo $gc['copper_grams']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						
						<td><strong>Final Copper</strong></td>
						<td><?php echo $gc['final_copper_grams']; ?></td>
						<td></td>
						<td></td>
						<td><strong>Less in pure total</strong></td>
						<td><?php echo $gc['less_in_pure_gms']; ?></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						
						<td><strong>Final Gold</strong></td>
						<td><?php echo $gc['final_gold']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						
						<td><strong>Melting Loss in Grams</strong></td>
						<td><?php echo $gc['melting_loss']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					
				</tfoot>
			</table>
			
			<?php
			
		} else {
			
			echo "GC not found";
		
		}
	
	}
	
	

	

}
