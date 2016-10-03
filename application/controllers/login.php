<?php

class Login extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('login_model');
    }
    
    function index(){
        $this->load->view('login_view');
    }
      
    /**
     * called by login_view form
     * checks details against db
     * creates new session on success
     */
    function validate_credentials(){
        $query = $this->login_model->login_user();
        
        if($query){
            $data = array(
                'username' => $this->input->post('username'),
                'logged_in' => true
            );
            // userdata set for login checks
            $this->session->set_userdata($data);
            redirect('/admin');
        }
        else { //incorrect details
			redirect('/login');
        }
    }
}