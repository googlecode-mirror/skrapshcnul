<?php
require_once(APPPATH . '/controllers/test/Toast.php');

class Recs_model_tests extends Toast
{  
    function __construct() {
        parent::__construct(__FILE__);    
        $this -> load -> model("recs_model");
    }

    /**
     * Do nothing before each individual test	 
     */
    function _pre() {       
    }

    /**
     * Do nothing after each individual test	 
     */
    function _post() {
    }
    
	/* TESTS */
	function test_AutoRecs() {
		// test clear
		$this -> _assert_equals($this -> recs_model -> clearAutoRecs(), TRUE);
		
		// test insert
		$n = 5;
		for ($i = 1; $i <= $n; ++$i) {
			for ($j = 1; $j <= $i; ++$j) {
				$obj = array('user_id' => $i, 'rec_id' => $j, 'rec_reason' => 'This guy is funny.');
				$result = $this -> recs_model -> insertAutoRec($obj);
				$this -> _assert_equals($result, TRUE);
		    }
		}
		
		// test select by user id
		$cnt = 0;
		for ($i = 1; $i <= $n; ++$i) {
			$result = $this -> recs_model -> selectAutoRecsByUserId($i);
			$this -> _assert_equals(count($result), $i);
			for ($j = 1; $j <= $i; ++$j) {
				$obj = $result[$j - 1];
				$this -> _assert_equals($obj -> index, ++$cnt);
				$this -> _assert_equals($obj -> user_id, $i);
				$this -> _assert_equals($obj -> rec_id, $j);
				$this -> _assert_equals($obj -> rec_reason, 'This guy is funny.');				
			}
		}
		
		// test select by index
		$cnt = 0;
		for ($i = 1; $i <= $n; ++$i) {
			for ($j = 1; $j <= $i; ++$j) {
				$obj = $this -> recs_model -> selectAutoRecByIndex(++$cnt);				
				$this -> _assert_equals($obj -> index, $cnt);
				$this -> _assert_equals($obj -> user_id, $i);
				$this -> _assert_equals($obj -> rec_id, $j);
				$this -> _assert_equals($obj -> rec_reason, 'This guy is funny.');
			}
		}
		
		// test remove by user id
		for ($i = 1; $i <= $n; ++$i) {
			$this -> _assert_equals($this -> recs_model -> removeAutoRecsByUserId($i), TRUE);
			$this -> _assert_equals($this -> recs_model -> selectAutoRecsByUserId($i), FALSE);
			if ($i < $n) {
				$this -> _assert_equals($this -> recs_model -> selectAutoRecsByUserId($i + 1), TRUE);
			}
			else {
				$this -> _assert_equals($this -> recs_model -> selectAutoRecsByUserId($i + 1), FALSE);
			}
		}
		
		// test remove by index
		for ($i = 1; $i <= 3; ++$i) {
			$obj = array('user_id' => $i, 'rec_id' => $i + 1, 'rec_reason' => 'This guy is funny.');
			$result = $this -> recs_model -> insertAutoRec($obj);
			$this -> _assert_equals($result, TRUE);
		}
				
		for ($i = $n * ($n + 1) / 2 + 1; $i < $n * ($n + 1) / 2 + 3; ++$i) {
			$this -> _assert_equals($this -> recs_model -> removeAutoRecByIndex($i), TRUE);
			$this -> _assert_equals($this -> recs_model -> selectAutoRecByIndex($i), FALSE);
			$this -> _assert_equals($this -> recs_model -> selectAutoRecByIndex($i + 1), TRUE);			
		}
		
		$this -> _assert_equals($this -> recs_model -> clearAutoRecs(), TRUE);
	}

	function test_SelectedRecs() {
		// test clear
		$this -> _assert_equals($this -> recs_model -> clearSelectedRecs(), TRUE);
		
		// test insert
		$this -> _assert_equals($this -> recs_model -> insertSelectedRec(1), TRUE);
		$this -> _assert_equals($this -> recs_model -> insertSelectedRec(10), TRUE);		
		
		// test select by index
		$this -> _assert_equals($this -> recs_model -> selectSelectedRecByIndex(1), TRUE);
		$this -> _assert_equals($this -> recs_model -> selectSelectedRecByIndex(10), TRUE);		
		$this -> _assert_equals($this -> recs_model -> selectSelectedRecByIndex(2), FALSE);
		$this -> _assert_equals($this -> recs_model -> selectSelectedRecByIndex(11), FALSE);		
		
		// test remove by index
		$this -> _assert_equals($this -> recs_model -> removeSelectedRecByIndex(1), TRUE);
		$this -> _assert_equals($this -> recs_model -> selectSelectedRecByIndex(1), FALSE);
		$this -> _assert_equals($this -> recs_model -> selectSelectedRecByIndex(10), TRUE);
		$this -> _assert_equals($this -> recs_model -> removeSelectedRecByIndex(10), TRUE);		
		$this -> _assert_equals($this -> recs_model -> selectSelectedRecByIndex(10), FALSE);
		
		$this -> _assert_equals($this -> recs_model -> clearSelectedRecs(), TRUE);
	}

	function test_NegotiatedRecs() {
		// test clear
		$this -> _assert_equals($this -> recs_model -> clearNegotiatedRecs(), TRUE);
		
		// test insert
		$this -> _assert_equals($this -> recs_model -> insertNegotiatedRec(1), TRUE);
		$this -> _assert_equals($this -> recs_model -> insertNegotiatedRec(10), TRUE);		
		
		// test select by index
		$this -> _assert_equals($this -> recs_model -> selectNegotiatedRecByIndex(1), TRUE);
		$this -> _assert_equals($this -> recs_model -> selectNegotiatedRecByIndex(10), TRUE);		
		$this -> _assert_equals($this -> recs_model -> selectNegotiatedRecByIndex(2), FALSE);
		$this -> _assert_equals($this -> recs_model -> selectNegotiatedRecByIndex(11), FALSE);		
		
		// test remove by index
		$this -> _assert_equals($this -> recs_model -> removeNegotiatedRecByIndex(1), TRUE);
		$this -> _assert_equals($this -> recs_model -> selectNegotiatedRecByIndex(1), FALSE);
		$this -> _assert_equals($this -> recs_model -> selectNegotiatedRecByIndex(10), TRUE);
		$this -> _assert_equals($this -> recs_model -> removeNegotiatedRecByIndex(10), TRUE);		
		$this -> _assert_equals($this -> recs_model -> selectNegotiatedRecByIndex(10), FALSE);
		
		$this -> _assert_equals($this -> recs_model -> clearNegotiatedRecs(), TRUE);
	}

	function test_AcceptedRecs() {
		// test clear
		$this -> _assert_equals($this -> recs_model -> clearAcceptedRecs(), TRUE);
		
		// test insert
		$this -> _assert_equals($this -> recs_model -> insertAcceptedRec(1), TRUE);
		$this -> _assert_equals($this -> recs_model -> insertAcceptedRec(10), TRUE);		
		
		// test select by index
		$this -> _assert_equals($this -> recs_model -> selectAcceptedRecByIndex(1), TRUE);
		$this -> _assert_equals($this -> recs_model -> selectAcceptedRecByIndex(10), TRUE);		
		$this -> _assert_equals($this -> recs_model -> selectAcceptedRecByIndex(2), FALSE);
		$this -> _assert_equals($this -> recs_model -> selectAcceptedRecByIndex(11), FALSE);		
		
		// test remove by index
		$this -> _assert_equals($this -> recs_model -> removeAcceptedRecByIndex(1), TRUE);
		$this -> _assert_equals($this -> recs_model -> selectAcceptedRecByIndex(1), FALSE);
		$this -> _assert_equals($this -> recs_model -> selectAcceptedRecByIndex(10), TRUE);
		$this -> _assert_equals($this -> recs_model -> removeAcceptedRecByIndex(10), TRUE);		
		$this -> _assert_equals($this -> recs_model -> selectAcceptedRecByIndex(10), FALSE);
		
		$this -> _assert_equals($this -> recs_model -> clearAcceptedRecs(), TRUE);
	}

	function test_SuccessfulRecs() {
		// test clear
		$this -> _assert_equals($this -> recs_model -> clearSuccessfulRecs(), TRUE);
		
		// test insert
		$this -> _assert_equals($this -> recs_model -> insertSuccessfulRec(1), TRUE);
		$this -> _assert_equals($this -> recs_model -> insertSuccessfulRec(10), TRUE);		
		
		// test select by index
		$this -> _assert_equals($this -> recs_model -> selectSuccessfulRecByIndex(1), TRUE);
		$this -> _assert_equals($this -> recs_model -> selectSuccessfulRecByIndex(10), TRUE);		
		$this -> _assert_equals($this -> recs_model -> selectSuccessfulRecByIndex(2), FALSE);
		$this -> _assert_equals($this -> recs_model -> selectSuccessfulRecByIndex(11), FALSE);		
		
		// test remove by index
		$this -> _assert_equals($this -> recs_model -> removeSuccessfulRecByIndex(1), TRUE);
		$this -> _assert_equals($this -> recs_model -> selectSuccessfulRecByIndex(1), FALSE);
		$this -> _assert_equals($this -> recs_model -> selectSuccessfulRecByIndex(10), TRUE);
		$this -> _assert_equals($this -> recs_model -> removeSuccessfulRecByIndex(10), TRUE);		
		$this -> _assert_equals($this -> recs_model -> selectSuccessfulRecByIndex(10), FALSE);
	}

	function test_TimeLocations() {
		// test clear
		$this -> _assert_equals($this -> recs_model -> clearTimeLocations(), TRUE);
		
		// test insert
		$obj = array('index' => 1, 'date' => '2010-12-25', 'time' => '12:00:00', 'restaurant_id' => 10012321);
		$this -> _assert_equals($this -> recs_model -> insertTimeLocation($obj), TRUE);
		
		$obj = array('index' => 10, 'date' => '2010-12-26', 'time' => '14:00:00', 'restaurant_id' => 10012322);
		$this -> _assert_equals($this -> recs_model -> insertTimeLocation($obj), TRUE);
		
		// test select
		$obj = $this -> recs_model -> selectTimeLocationByIndex(1);		
		$this -> _assert_equals($obj -> index, 1);
		$this -> _assert_equals($obj -> date, '2010-12-25');
		$this -> _assert_equals($obj -> time, '12:00:00');
		$this -> _assert_equals($obj -> restaurant_id, 10012321);
		
		$obj = $this -> recs_model -> selectTimeLocationByIndex(10);		
		$this -> _assert_equals($obj -> index, 10);
		$this -> _assert_equals($obj -> date, '2010-12-26');
		$this -> _assert_equals($obj -> time, '14:00:00');
		$this -> _assert_equals($obj -> restaurant_id, 10012322);
		
		// test remove				
		$this -> _assert_equals($this -> recs_model -> removeTimeLocationByIndex(1), TRUE);
		$this -> _assert_equals($this -> recs_model -> selectTimeLocationByIndex(1), FALSE);
		$this -> _assert_equals($this -> recs_model -> selectTimeLocationByIndex(10), TRUE);
		$this -> _assert_equals($this -> recs_model -> removeTimeLocationByIndex(10), TRUE);
		$this -> _assert_equals($this -> recs_model -> selectTimeLocationByIndex(10), FALSE);
		
		$this -> _assert_equals($this -> recs_model -> clearTimeLocations(), TRUE);
	}
}
