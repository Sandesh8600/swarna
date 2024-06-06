<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions


class Models extends CI_Controller {

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

		parent::__construct();

		$this->db->query("SET time_zone='+5:30'");
		
		//check if loggedin
        if(!$this->session->userdata("admin_id")){ redirect("login/validate"); }
        
    }

    public function model_s(){

        $this->lib->render_view("modules/models/models");

    }

    public function create(){

        $this->lib->render_view("modules/models/create");

    }
    
    public function insert(){

        $model_name = $this->input->post('model_name');
        $width = $this->input->post('width');
        $height = $this->input->post('height');

        $data = array(
                'model_name' => $model_name,
                'width' => $width,
                'Height' => $height
        );

        $this->db->insert('models', $data);
        redirect(site_url("models/model_s"));
    }

    public function edit(){
        $id = $this->input->post('model_id');
        // print_r($id);die;
        //load  models
        $this->load->model("Main_models");

        $this->load->library("form_validation");
        
            
            $data['models']=$this->Main_models->fetch_record($id);

            $this->lib->render_view("modules/models/edit.php",$data);
   
      }

      public function update()
    {
        $id = $this->input->post('id');
        $model_name = $this->input->post('model_name');
        $width = $this->input->post('width');
        $height = $this->input->post('height');
       
            $data = array(
                'model_name' => $model_name,
                'width' => $width,
                'Height' => $height
            );
            $this->db->set($data);
		    $this->db->where('model_id', $id);
            $this->db->update('models');
            redirect(site_url("models/model_s"));
    }


    public function mydelete()
    {
        $row_id = $this->input->post('partner_id');
        print_r($row_id);
        $this->db->delete("models",array("model_id"=>$row_id));
    }
}?>