<?php
    class Login_model extends CI_Model{

    	public function __construct()
		  {
			$this->load->database();
		  }

      /*
      * @author wvsoftek
      * @description to validate admin user login
      */
      public function validate_login(){

        $email=$this->input->post("email");
        $password=md5($this->input->post("password"));

        $query=$this->db->query("select admin_id, admin_name, email from admin where email=? and password=? and status=1", array($email, $password));
        $result=$query->row_array();

        if($result){

          //set Session
          $this->session->set_userdata($result);

          return true;

        } else {

          return false;

        }

      }

      /*
      * @author wvsoftek
      * @description to validate admin user login
      */
      public function logout(){

            $admin=array("admin_id","admin_name","email");
            $this->session->unset_userdata($admin);

      }

      /*
      * @author wvsoftek
      * @description to check if session exists
      */
      public function check_session(){

            $admin_id=$this->session->userdata("admin_id");

            if($admin_id){
              return true;
            } else {
              return false;
            }

      }

      public function randomPassword() {
          $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
          $pass = array(); //remember to declare $pass as an array
          $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
          for ($i = 0; $i < 8; $i++) {
              $n = rand(0, $alphaLength);
              $pass[] = $alphabet[$n];
          }
          return implode($pass); //turn the array into a string
      }

      /*
      * @author wvsoftek
      * @description to validate & reset password and send it to registered email
      */
      public function reset_password(){

        $email=$this->input->post("email");

        $query=$this->db->query("select admin_id, admin_name, email from admin where email=? and status=1", array($email));
        $result=$query->row_array();

        if($result){

          //generate new password
          $new_password=$this->randomPassword();
          //update records with new password
          $this->db->update("admin",array("password"=>md5($new_password)), array("admin_id"=>$result['admin_id']));

          //send new password to registered email
          $body="Dear ".$result['admin_name'].",<br/><br/>";
          $body.="Your new password for Phometo Dashboard is ".$new_password."<br/><br/>";
          $body.="- Phometo Webmaster";
          $subject="Phometo Password Reset Request";

          $this->lib->email_alert($result['email'], $subject, $body);

        }

      }

}
