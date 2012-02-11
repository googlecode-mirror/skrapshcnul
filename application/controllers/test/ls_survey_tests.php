<?php
require_once(APPPATH . '/controllers/test/Toast.php');

class Ls_survey_tests extends Toast
{  
    function __construct() {
        parent::__construct(__FILE__);    
        $this -> load -> library('ls_survey');
    }

    /**
     * Clear table before each individual test   
     */
    function _pre() {
    	$this -> ls_survey -> clearTables();
    }

    /**
     * Clear the table after each individual test    
     */
    function _post() {
    }
    
    /* TESTS BELOW */
    function test_one() {
    	$a = array();
    	$a['event_id'] = 7;
		$a['user_id'] = 1;
		$a['target_id'] = 6;
		$a['target_point'] = 8.7;
		$a['target_review'] = 'He is awesome!';
		
		$aa = array();
    	$aa['event_id'] = 7;
		$aa['user_id'] = 1;
		$aa['target_id'] = 8;
		$aa['target_point'] = 9;
		$aa['target_review'] = 'He is good!';
		
		$b = array();
		$b['event_id'] = 7;
		$b['user_id'] = 1;
		$b['restaurant_id'] = 6;
		$b['restaurant_point'] = 10;
		$b['restaurant_review'] = 'The food is awesome!';
		
		$obj = array();
    	$obj['feedback_to_restaurant'] = $b;
		$obj['feedback_to_users'] = array();
		$obj['feedback_to_users'][0] = $a;
		$obj['feedback_to_users'][1] = $aa;
		  	
		$result = $this -> ls_survey -> insertFeedback($obj);
		
    	$this -> _assert_true($result != FALSE);
		
		$result = $this -> ls_survey -> getCompletedSurvey(7, 1);
		$obj['feedback_to_restaurant']['timestamp'] =
			$result['feedback_to_restaurant']['timestamp'];
		$obj['feedback_to_users']['0']['timestamp'] =
			$result['feedback_to_users']['0']['timestamp'];
		$obj['feedback_to_users']['1']['timestamp'] =
			$result['feedback_to_users']['1']['timestamp'];
				
		$this -> _assert_true($obj == $result);
    }
}
