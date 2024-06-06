<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class voucher extends CI_Controller {

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		parent::__construct();

		$this->db->query("SET time_zone='+5:30'");
		
		//check if loggedin
		if(!$this->session->userdata("admin_id")){ redirect("login/validate"); }
	}

    public function browse(){
		
        $page=$this->input->get("page");
        
        if(!$page){
                
            $page=0;
        }
        
        $page_size=25;
        
        if($this->input->get("page_size")>0){
            $page_size=$this->input->get("page_size");
        }
        
        $page_start=$page_size*$page;

        //load category model
        $this->load->model("Voucher_model");
        
        $result=$this->Voucher_model->get_users($page_start,$page_size);
        
        $data['users']=$result['records'];
        $data['total']=$result['total_records'];
        $data['page_size']=$page_size;
        $data['current_page']=$page+1;
        $data['total_pages']=$data['total']/$page_size;
        $data['total_pages']=$data['total_pages']<1?1:$data['total_pages'];
        
        if($data['total_pages']>(int)($data['total_pages'])){
            $data['total_pages']=(int)($data['total_pages'])+1;
        }
        
        $data['next_page']=false;
        $data['next_page_num']=$page+1;
        $data['prev_page']=true;
        $data['prev_page_num']=$page-1;
        
        if($data['total']>(($page+1) * $page_size)){
            $data['next_page']=true;
        }
        
        if($page==0){
            $data['prev_page']=false;
        }
        

        $this->lib->render_view("modules/workshop/browse.php",$data);

}

public function create()
	{
		$this->lib->render_view("modules/workshop/voucher/create.php");

		$this->load->helper('date');
		 $c_date = date("Y-m-d H:i:s");

		if($this->input->post('full_name'))
		{
		$data = array(
			'Workshop_Name' => $this->input->post('full_name'),
			'Workshop_Address' => $this->input->post('address'),
			'Workshop_GoldBalanceInGram' => $this->input->post('balance'),
			'Workshop_Contact_Mobile_Number1' => $this->input->post('number1'),
			'balance_inr' => $this->input->post('balance_inr'),
			'Workshop_Email_Id' => $this->input->post('email'),
			'id_proof_type' => $this->input->post('id_proof_type'),
			'id_proof_number' => $this->input->post('id_proof_number'),
			'Timestamp' => $c_date
		);
		
		$id_proof_file=$this->lib->upload_file("id_proof_file",$this->config->item("base_upload_path"));
			if($id_proof_file){ $values['id_proof_file']=$id_proof_file; }
		
		if($this->db->insert('workshops', $data))
		{
			
			redirect(site_url("workshop/browse"));
			

		}
	 }
	}

    // public function show(){

    //     $data['user']=$this->Voucher_model->fetch_users();
    //     $this->lib->render_view("modules/goldtransaction/browse.php",$data);
    // }
}