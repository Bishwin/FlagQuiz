<?php
class Country_model extends CI_Model{
	private $names = [];
	private $answers = array();
	
	function __construct(){
        parent::__construct();
		$this->load->model('Score');
        
        $query = $this->db->query('SELECT name FROM country'); //get names from db
        if($query->num_rows()>0){
			foreach($query->result_array() as $row){
               	$this->names[] = $row['name'];
			}
        }	
	}
		
        
    /*
     * Get questions
     * returns array with question pool
     * the id of the correct answer
     * and flag url
    */
	private function getQuestion(){
		//create 4 choices
		$questPool = []; 
		$count = count($this->names);
		$counter1 = 0;
		while($counter1 < 4 ){	
			$rng = rand(0,$count - 1);
			$rngName = $this->names[$rng];
				
			if(!in_array($rngName,$questPool)){
				$questPool[] = $rngName; 
				$counter1++;
			}
		}	
		//pick correct answer out of the 4
		$error=0;
		$counter2 = 0;
		while($counter2 < 1){
			$max = count($questPool);
			$rng = rand(0,$max - 1);
			$correct = $questPool[$rng];
			
			if(!in_array($correct,$this->answers)){ //finding duplicate entires
				$this->answers[] = $correct; //add to answer array
				$counter2++;
			}else{
				$error++; //if > 4 questions have same answers and cannot select a unique answer
				if($error==4){
					return false;
				}
			}
		}
		//get flag/id for answer
		$id = $this->getID($correct);
		$flag = $this->getFlag($id);
	
		return array('countries'=>$questPool, 
			'answer'=>$correct, 'id'=>$id, 'image'=>$flag);
	}
	
    /*
     * getQuiz
     * returns array of question
    */
	public function getQuiz($qNum){
		//get x amount of questions
        $q=[];
        $counter=0;
        while($counter < $qNum){
			$result = $this->getQuestion();
			if(!$result === false){ //add to question array
				$q['question'][$counter] = $result;
				$counter++;
			}
		}
		return $q;
	}
    
    /*
     * Get Names
     * returns array with
     * country name and id
    */
    public function getNames(){
        $count = count($this->names);
        for($i=0; $i<$count;$i++){
            $data['countries'][$i]['country'] = $this->names[$i];
            $data['countries'][$i]['id'] = $this->getID($this->names[$i]);
        }
        return $data;
    }
	
    /*
     * check question is correct
     * returns true/false 
    */
	private function check($id, $name){
		$res = $this->getID($name);
		if($res == $id){
			$this->Score->addScore(); // increase score
            $this->updateAttempt($id,true); // update attempts for avg in db            
			return true; // correct answer
        }else{
            $this->updateAttempt($id,false);            
            return false; // incorrect answer
        }
	}
    
    /*
     * checkQuestions
     * process submitted questions
     * return array 
     * is correct, image url, country name, 
     * answer inputted, question average, quiz score
    */
	public function checkQuestions($str){
		$results = explode('#', $str);
		$id = 0; //stored on even indexes
		$country = 1; //stored on odd indexes
		$max = count($results)/2; //half array for question num
		
		for($i = 0; $i < $max; $i++){
			$data['results'][$i]['res'] = $this->check($results[$id],$results[$country]); // returns true or false
			$data['results'][$i]['image'] = $this->getFlag($results[$id]); // returns image
			$data['results'][$i]['country'] = $this->getCountry($results[$id]); // returns country name
			$data['results'][$i]['input'] = $results[$country]; // returns users input
            $data['results'][$i]['average'] = $this->getAverage($results[$id]); // returns average result of country
			$country+=2;
			$id+=2;
		}	
		$data['score']=$this->Score->getScore();
		return $data;
	}

    /*
     * get country
     * returns country name with id
    */
	public function getCountry($id){
		$sql = "SELECT name FROM country WHERE id = ?";
		$query = $this->db->query($sql, $id);
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				return $row->name;
			}
		}
	}
	
    /*
     * get ID
     * returns ID name with name
    */
	private function getID($country){
		$sql = "SELECT id FROM country WHERE name = ?";
		$query = $this->db->query($sql, $country);
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				return $row->id;
			}
		}
	}
    
    /*
     * get flag
     * returns flag with id
    */
	public function getFlag($id){
		$sql = "SELECT flag FROM country WHERE id = ?";
		$query = $this->db->query($sql, $id);
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				return $row->flag;
			}
		}
	}
    
    
    /*
     * RESTFUL API METHOD
     * get countries from db
    */
    public function get(){
		$sql = "SELECT * FROM country";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result();
		}
	}
    
    /*
     * RESTFUL API METHOD
     * update country to db
    */
    public function updateCountry($id, $name, $flag){
        $data = array(
            'name' => $name,
            'flag' => $flag
        );
        
        $this->db->where('id',$id);
        $this->db->update('country',$data);
        
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        } 
        else {
            return false;
        }
    }
    
    /*
     * RESTFUL API METHOD
     * delete country from db
    */
    public function deleteCountry($id){
        $sql = "DELETE FROM country WHERE id =?";
        $query = $this->db->query($sql, $id);
        
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        } 
        else {
            return false;
        }
    }
    
    /*
     * RESTFUL API METHOD
     * add country to db
    */
    public function addCountry($name, $flag){
        $data = array(
            'id' => null,
            'name' => $name,
            'flag' => $flag
        );
        
        $this->db->insert('country',$data);
    }
    
    /*
     * Update attempt and score
     * in country db
    */
    private function updateAttempt($id, $iscorrect){
        
        $this->db->where('id', $id);
        $this->db->set('attempts', 'attempts+1', FALSE);
        $this->db->update('country');
        
        if($iscorrect){
            $this->db->where('id', $id);
            $this->db->set('score', 'score+1', FALSE);
            $this->db->update('country');
        }
    }
    
    /*
     * getAverage
     * get score and attempts from db
     * returns average
    */
    private function getAverage($id){
        
        $sql = "SELECT score, attempts FROM country WHERE id =?";
        $query = $this->db->query($sql, $id);
		if($query->num_rows()>0){
            foreach($query->result() as $row){
                $score = $row->score;
                $attempts = $row->attempts;            
            }
        }
        // calculate average
        $result = ($score/$attempts)*100;
        // remove decimals if number is float
        if( is_float($result)){
            //$result = number_format($result,1,'.','');
            $result = intval($result);
        }
        return $result;
    }
}
    
