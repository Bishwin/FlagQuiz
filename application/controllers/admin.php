<?php

class Admin extends CI_Controller{
    
    private $logged_in;
    
    function __construct(){
        parent::__construct();
        //check session data exists
        if($this->session->userdata('logged_in')){
            $this->logged_in = true; 
        }
        else {
            $this->logged_in = false;
        }
	}
    
    // load admin UI if logged in
    // if not, direct to login page
    function index(){
        if($this->logged_in){
            $this->load->view('adminUI_view');
        }
        else {
            $this->load->view('login_view');
        }
    }
}