<?php
class Quiz extends CI_Controller{
	//set number of questions for quiz
	private $qNum = 10;
	
	function __construct(){
		parent::__construct();
		$this->load->model('country_model');
	}
	
	public function index(){
		$this->load->view('index');
	}
        
	public function start(){
		$guess = $this->input->post();	
		if(empty($guess)){
			//if no data get questions and start quiz
			$data = $this->country_model->getQuiz($this->qNum);
			$data['qNum'] = $this->qNum;
			$this->load->view('question_view',$data);
		}
		else{
			//send data to model and display results
				$guessstr = implode('#',$guess);
				$results = $this->country_model->checkQuestions($guessstr);
				$results['qNum'] = $this->qNum;
				$this->load->view('results_view',$results);
		}
	}
}