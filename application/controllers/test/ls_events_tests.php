<?php
require_once(APPPATH . '/controllers/test/Toast.php');

class Ls_events_tests extends Toast
{  
    function __construct() {
        parent::__construct(__FILE__);    
        $this -> load -> library('ls_events');
		$this -> load -> library('ls_user_recommendation');		
    }

    /**
     * Clear table before each individual test   
     */
    function _pre() {
    	$this -> ls_events -> clearTables();
		$this -> ls_user_recommendation -> clearTables();
    }

    /**
     * Clear tables after each individual test    
     */
    function _post() {
    	//$this -> ls_events -> clearTables();
		//$this -> ls_user_recommendation -> clearTables();
    }
    
    /* TESTS BELOW */
    function test_one() {
    	## create events without sufficient recommendations
    	$obj1['event_date'] = "2012-02-29 13:00:00";
		$obj1['event_location'] = 1;
		$obj1['reason'] = "";
		$obj1['deadline'] = "2012-03-01 15:00:00";
		$obj1['user_ids']['0'] = 1;
		$obj1['user_ids']['1'] = 2;
		$this -> _assert_false($this -> ls_events -> create($obj1));
		
		$obj2['event_date'] = "2012-03-1 15:00:00";
		$obj2['event_location'] = 2;
		$obj2['reason'] = "";
		$obj2['deadline'] = "2012-03-03 15:00:00";
		$obj2['user_ids']['0'] = 1;
		$obj2['user_ids']['1'] = 4;
		$this -> _assert_false($this -> ls_events -> create($obj2));
		
		## create recommendations
		$o['user_id'] = 1;
		$o['target_user_id'] = 2;
		$o['reason'] = "He is nice!";
		$this -> _assert_true($this -> ls_user_recommendation -> create($o));

		$o['user_id'] = 2;
		$o['target_user_id'] = 1;
		$o['reason'] = "He is awesome!";
		$this -> _assert_true($this -> ls_user_recommendation -> create($o));
		
		$this -> _assert_true($this -> ls_user_recommendation -> 
			confirm(array("recommendation_id" => 1)));
			
		$this -> _assert_true($this -> ls_user_recommendation -> 
			confirm(array("recommendation_id" => 2)));
			
		$o['user_id'] = 1;
		$o['target_user_id'] = 4;
		$o['reason'] = "She is nice!";
		$this -> _assert_true($this -> ls_user_recommendation -> create($o));

		$o['user_id'] = 4;
		$o['target_user_id'] = 1;
		$o['reason'] = "She is awesome!";
		$this -> _assert_true($this -> ls_user_recommendation -> create($o));
		
		$this -> _assert_true($this -> ls_user_recommendation -> 
			confirm(array("recommendation_id" => 3)));
			
		$this -> _assert_true($this -> ls_user_recommendation -> 
			confirm(array("recommendation_id" => 4)));	
		
		## now recreate event with sufficient recommendations
		$this -> _assert_true($this -> ls_events -> create($obj1));
		$this -> _assert_true($this -> ls_events -> create($obj2));
		
		##countPendingEventRequest
		$result = $this -> ls_events -> countPendingEventRequests(1);
		$this -> _assert_true($result == 2);
		
		$result = $this -> ls_events -> countPendingEventRequests(2);
		$this -> _assert_true($result == 1);
		
		$result = $this -> ls_events -> countPendingEventRequests(4);
		$this -> _assert_true($result == 1);
		
		## reject event
		$f['user_id'] = 1;
		$f['event_id'] = 1;
		$f['action'] = 'reject';
		$this -> _assert_true($this -> ls_events -> rsvp($f));
		
		$result = $this -> ls_events -> getEvents(1, array(-1 => true, 2 => true));
		$this -> _assert_true(count($result) == 1);
		
		$result = $this -> ls_events -> getEvents(1, array(0 => true));
		$this -> _assert_true(count($result) == 1);
		
		$result = $this -> ls_events -> getEvents(1, array(-1 => true, 0 => true));
		$this -> _assert_true(count($result) == 2);
		
		## confirm event
		$f['user_id'] = 1;
		$f['event_id'] = 2;
		$f['action'] = 'confirm';
		$this -> _assert_true($this -> ls_events -> rsvp($f));
		
		$f['user_id'] = 4;
		$f['event_id'] = 2;
		$f['action'] = 'confirm';
		$this -> _assert_true($this -> ls_events -> rsvp($f));
		
		$result = $this -> ls_events -> getEvents(1, array(-1 => true));
		$this -> _assert_true(count($result) == 1);
		
		$result = $this -> ls_events -> getEvents(1, array(-1 => true, 1 => true));
		$this -> _assert_true(count($result) == 2);
		
		## getAllEvents
		$result = $this -> ls_events -> getAllEvents(array(-1 => true));
		$this -> _assert_true(count($result) == 1);
		
		$result = $this -> ls_events -> getAllEvents(array(-1 => true, 1 => true));
		$this -> _assert_true(count($result) == 2);

		##countPendingEventRequest
		$result = $this -> ls_events -> countPendingEventRequests(1);
		$this -> _assert_true($result == 0);
		
		$result = $this -> ls_events -> countPendingEventRequests(2);
		$this -> _assert_true($result == 0);
		
		##countPendingUserRecommendations
		$result = $this -> ls_user_recommendation -> 
			countPendingUserRecommendations(1);
		$this -> _assert_true($result == 0);
		
		## create more recommendations
		for ($i = 10; $i < 15; ++$i) {
			$o['user_id'] = 1;
			$o['target_user_id'] = $i;
			$o['reason'] = "He is nice!";
			$this -> _assert_true($this -> ls_user_recommendation -> create($o));			
			$result = $this -> ls_user_recommendation -> 
				countPendingUserRecommendations(1);
			$this -> _assert_true($result == $i - 9);
		}
    }
}
