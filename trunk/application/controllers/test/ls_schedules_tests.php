<?php
require_once(APPPATH . '/controllers/test/Toast.php');

class Ls_schedules_tests extends Toast
{  
    function __construct() {
        parent::__construct(__FILE__);    
        $this -> load -> library('ls_schedules');
    }

    /**
     * Clear table before each individual test   
     */
    function _pre() {
    	$this -> ls_schedules -> clearTables();
    }

    /**
     * Do nothing after each individual test    
     */
    function _post() {
    }
    
    /* TESTS BELOW */
    function test_one() {
    		
		## insert new data
    	$obj = array();
		
		$obj[0] = array();
		$obj[0]['user_id'] = 1;
		$obj[0]['name'] = 'Daily Schedule'; 
		$obj[0]['repeat_params'] = '01110110111000';
		$obj[0]['center_lat'] = '100.00';
		$obj[0]['center_lng'] = '101.00';
		$obj[0]['radius'] = '102.00';
		$obj[0]['disabled'] = '1';
		
		$obj[1] = array();
		$obj[1]['user_id'] = 1;
		$obj[1]['name'] = 'Holiday Schedule';
		$obj[1]['repeat_params'] = '00000000000000';
		$obj[1]['center_lat'] = '100.00';
		$obj[1]['center_lng'] = '101.00';
		$obj[1]['radius'] = '102.00';
		$obj[1]['disabled'] = '0';
		
		 
    	$this -> _assert_true(
    		$this -> ls_schedules -> addSchedule($obj[0]) == TRUE);
			
		$this -> _assert_true(
			$this -> ls_schedules -> addSchedule($obj[1]) == TRUE);
		
		## get old data and double-check
		$result = $this -> ls_schedules -> getSchedulesByUserId(10);
		$this -> _assert_true(count($result) == 2);
		
		for ($i = 0; $i < 2; ++$i) {
			foreach($obj[$i] as $key => $value) {
				$this -> _assert_true($result[$i][$key] == $value);
			}
		}
		
		for ($i = 0; $i < 2; ++$i) {
			$result = $this -> ls_schedules -> getScheduleByIndex($i + 1);
			foreach($obj[$i] as $key => $value) {
				$this -> _assert_true($result[$key] == $value);
			}
		}
		
		## update data and double-check
		$o = array();
		$o['index'] = 1;
		$o['name'] = NULL; 
		$o['repeat_params'] = '11111111111111';
		$o['center_lat'] = '200.00';
		$o['center_lng'] = '201.00';
		$o['radius'] = '202.00';
		$o['disabled'] = '0';
		
		$this -> _assert_true(
			$this -> ls_schedules -> updateSchedule($o) == TRUE);
		
		$result = $this -> ls_schedules -> getScheduleByIndex(1);
		foreach($o as $key => $value) {
			$this -> _assert_true($result[$key] == $value);
		}		
		
		## delete data and double-check
		for ($i = 0; $i < 2; ++$i) {
			$this -> _assert_true(
				$this -> ls_schedules -> deleteScheduleByIndex($i + 1) == TRUE);
		}
    }
}
