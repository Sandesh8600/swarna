<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rest_server extends CI_Controller {

    public function index()
    {
        $this->load->helper('url');

        $this->load->view('rest_server');
    }

    public function index_get()
  	{
  		$this->bro4u->show_404();
  	}

  	public function index_post()
  	{
  		$this->bro4u->show_404();
  	}
}
