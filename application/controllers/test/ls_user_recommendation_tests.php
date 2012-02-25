<?php
require_once(APPPATH . '/controllers/test/Toast.php');

class Ls_user_recommendation_tests extends Toast
{  
    function __construct() {
        parent::__construct(__FILE__);    
        $this -> load -> library('ls_user_recommendation');		
    }

    /**
     * Clear table before each individual test   
     */
    function _pre() {
    	$this -> ls_user_recommendation -> clearTables();
    }

    /**
     * Clear table after each individual test    
     */
    function _post() {
    	$this -> ls_user_recommendation -> clearTables();
    }
    
    /* TESTS BELOW */
    function test_one() {
    	## insert data	
    	$obj['user_id'] = 1;
		$obj['target_user_id'] = 2;
		$obj['reason'] = "He is good!";
		$this -> _assert_true($this -> ls_user_recommendation -> create($obj));
		
		$obj['user_id'] = 1;
		$obj['target_user_id'] = 3;
		$obj['reason'] = "He is nice!";
		$this -> _assert_true($this -> ls_user_recommendation -> create($obj));

		$obj['user_id'] = 2;
		$obj['target_user_id'] = 1;
		$obj['reason'] = "He is awesome!";
		$this -> _assert_true($this -> ls_user_recommendation -> create($obj));
		
		## insert duplicate
		$obj['user_id'] = 1;
		$obj['target_user_id'] = 2;
		$obj['reason'] = "He is great!";
		$this -> _assert_false($this -> ls_user_recommendation -> create($obj));
		
		## confirm
		$this -> _assert_true($this -> ls_user_recommendation -> 
			confirm(array("recommendation_id" => 1)));
		
		$result1 = $this -> ls_user_recommendation -> 
			getUserRecommendationsByUserId(1);
		
		$this -> _assert_true($result1[0]['user_id'] == 1);
		$this -> _assert_true($result1[0]['rec_id'] == 2);
		$this -> _assert_true($result1[0]['rec_reason'] === "He is good!");
		$this -> _assert_true($result1[0]['selected'] == 1);
		
		$this -> _assert_true($result1[1]['user_id'] == 1);
		$this -> _assert_true($result1[1]['rec_id'] == 3);
		$this -> _assert_true($result1[1]['rec_reason'] === "He is nice!");
		$this -> _assert_true($result1[1]['selected'] == 0);
		
		## reject
		$this -> _assert_true($this -> ls_user_recommendation -> 
			reject(array("recommendation_id" => 3)));
		
		$result2 = $this -> ls_user_recommendation -> 
			getUserRecommendationsByUserId(2);
		
		$this -> _assert_true($result2[0]['user_id'] == 2);
		$this -> _assert_true($result2[0]['rec_id'] == 1);
		$this -> _assert_true($result2[0]['rec_reason'] === "He is awesome!");
		$this -> _assert_true($result2[0]['selected'] == -1);
		
		## count
		$this -> _assert_true($this -> ls_user_recommendation -> 
			countApprovedUserRecommendations() == 3);
			
		$this -> _assert_true($this -> ls_user_recommendation -> 
			countUnApprovedUserRecommendations() == 0);
			
		## getApprovedUserRecommendations
		$result3 = $this -> ls_user_recommendation ->
			getApprovedUserRecommendations(array("page" => 0, "per_page" => 10));
		
		$this -> _assert_true($result1[0] === $result3[0]);
		$this -> _assert_true($result1[1] === $result3[1]);
		$this -> _assert_true($result2[0] === $result3[2]);
		
		## getUnpprovedUserRecommendations
		$result4 = $this -> ls_user_recommendation ->
			getUnapprovedUserRecommendations(array("page" => 0, "per_page" => 10));
		$this -> _assert_true($result4 == NULL);
    }
}
