<?php

class Login_model extends CI_Model{
    
    function __construct(){
        parent::__construct();
	}
  
    /**
     * validates form data against db "users"
     * @return true|false if in db
     */
    public function login_user(){
        $username = $this->input->post('username');   
        $password = $this->input->post('password');
     
        $this->db->where(array(
            'username' => $username,
            'password' => sha1($password)
        ));
        $result = $this->db->get('users');
        
        if($result->num_rows == 1){
            return true;
        }
        else {
            return false;
        }
        
    }
}