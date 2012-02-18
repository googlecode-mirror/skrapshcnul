<?php
require_once(APPPATH . '/controllers/test/Toast.php');

class User_recommendation_model_tests extends Toast
{  
    function __construct() {
        parent::__construct(__FILE__);    
        $this -> load -> model('user_recommendation_model');
    }

    /**
     * Clear table before each individual test   
     */
    function _pre() {
    	$this -> user_recommendation_model -> clearTables();
    }

    /**
     * Clear the table after each individual test    
     */
    function _post() {
    }
    
    /* TESTS BELOW */
    function test_one() {
    	$obj = array();
		$obj['user_id'] = 1;
		$obj['target_user_id'] = 2;
		$obj['rec_reason'] = 'She is nice!';		
		$this -> _assert_true($this -> user_recommendation_model -> 
			createUserRecommendation($obj) == TRUE);
		
		$obj['user_id'] = 2;
		$obj['target_user_id'] = 1;
		$obj['rec_reason'] = 'He is good!';
		$this -> _assert_true($this -> user_recommendation_model -> 
			createUserRecommendation($obj) == TRUE);
		
		$this -> _assert_true($this -> user_recommendation_model -> 
			isConfirmed(1, 2) == FALSE);
		$this -> _assert_true($this -> user_recommendation_model -> 
			isConfirmed(2, 1) == FALSE);
			
		## confirm and double-check
		$o['user_id'] = 2;
		$o['target_user_id'] = 1;
		$o['recommendation_id'] = 2;
		$this -> _assert_true($this -> user_recommendation_model -> 
			confirm($o) == TRUE);
		$this -> _assert_true($this -> user_recommendation_model -> 
			isConfirmed(1, 2) == FALSE);
		$this -> _assert_true($this -> user_recommendation_model -> 
			isConfirmed(2, 1) == TRUE);
    }
}
