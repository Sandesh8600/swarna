<?php
    class Main_models extends CI_Model{

    	public function __construct()
		{
			$this->load->database();
		}

      /*
      * @author akshay@neutreum.com
      * @description to retrive a comment by id
      */
      public function fetch_record($id){

        $this->db->select('*');
        $this->db->from('models');
        $this->db->where('model_id',$id);
        $query = $this->db->get();

        return $query->row();

      }
	
    }?>