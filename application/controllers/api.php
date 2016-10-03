<?php

class Api extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('country_model');
    }

/*
 |--------------------------------
 | REST API
 |--------------------------------
 |
*/

    function country() {

        // FETCH DATA
        if($this->input->server('REQUEST_METHOD') == 'GET'){
            $id = $this->input->get('id');
            if($id != ''){
                $quiz = $this->country_model->getCountry($id);
                echo json_encode($quiz);
            }
            else {
                $countries = $this->country_model->get();
                echo json_encode($countries);
            }
        }
        // UPDATE DATA
        else if($this->input->server('REQUEST_METHOD') == 'PUT'){
            
            $json = file_get_contents('php://input');
            $data = json_decode($json,true);
            
            $id = $data['id'];
            $name = $data['name'];
            $flag = $data['flag'];

            //add to db
            $success = $this->country_model->updateCountry($id,$name, $flag);
           
            if($success){
                 echo json_encode(array( 'ok'=>1 ));
            }
            else {
                echo json_encode(array('ok'=>0));
            }
        }
        // DELETE DATA
        else if($this->input->server('REQUEST_METHOD') == 'DELETE'){
            $id = $this->input->get('id');
            
            $success = $this->country_model->deleteCountry($id);
            
            if($success){
                 echo json_encode(array( 'ok'=>1 ));
            }
            else {
                echo json_encode(array('ok'=>0));
            }
        }
        // CREATE DATA
        else if($this->input->server('REQUEST_METHOD') == 'POST'){
        
            $json = file_get_contents('php://input');
            $data = json_decode($json,true);
            
            $name = $data['name'];
            $flag = $data['flag'];
            
            $success = $this->country_model->addCountry($name, $flag);
                 echo json_encode(array( 'ok'=>1 ));
        }
        else {
                echo json_encode(array('ok'=>0));
            }
    }
}
