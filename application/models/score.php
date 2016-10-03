<?php
class Score extends CI_Model{
	private $score =0;
	
    /*
     * increment score
    */
	public function addScore(){
		$this->score +=1;
	}
	
    /*
     * return score for quiz
    */
	public function getScore(){
		return $this->score;
	} 
}