<?php
require_once(APPPATH . '/controllers/test/Toast.php');

class Messages_model_tests extends Toast
{  
	function __construct() {
		parent::__construct(__FILE__);    
		$this -> load -> model("messages_model");
	}

	/**
	 * Clear table before each individual test	 
	 */
	function _pre() {
	  $this -> messages_model -> clear();
	}

	/**
	 * Clear the table after each individual test	 
	 */
	function _post() {
	  $this -> messages_model -> clear();
	}

	/* TESTS BELOW */
	function test_one() {
	  for ($i = 1; $i <= 5; ++$i) {
	    $success = $this -> messages_model -> insert(U_SYSTEM, $i, U_USER, $i + $i, 
	      M_SUGGESTION, "wow", NULL, NULL);
      $this -> _assert_equals($success, TRUE);
      
      $result = $this -> messages_model -> select($i);
      $result = $result -> result();      
      $this -> _assert_equals($result[0] -> index, $i);
      $this -> _assert_equals($result[0] -> from_type, U_SYSTEM);      
      $this -> _assert_equals($result[0] -> from_id, $i);
      $this -> _assert_equals($result[0] -> to_type, U_USER);
      $this -> _assert_equals($result[0] -> to_id, $i + $i);
      $this -> _assert_equals($result[0] -> message_type, M_SUGGESTION);
      $this -> _assert_equals($result[0] -> message_content, "wow");
      $this -> _assert_equals($result[0] -> previous, NULL);
      $this -> _assert_equals($result[0] -> next, NULL);      
    }
	}
  
  function test_two() {
    for ($i = 1; $i <= 5; ++$i) {
      $success = $this -> messages_model -> insert(U_SYSTEM, $i, U_USER, $i + $i, 
        M_SUGGESTION, "awesome", ($i + 4) % 5, ($i + 1) % 5);
      $this -> _assert_equals($success, TRUE);
      
      $result = $this -> messages_model -> select($i);
      $result = $result -> result();      
      $this -> _assert_equals($result[0] -> index, $i);
      $this -> _assert_equals($result[0] -> from_type, U_SYSTEM);      
      $this -> _assert_equals($result[0] -> from_id, $i);
      $this -> _assert_equals($result[0] -> to_type, U_USER);
      $this -> _assert_equals($result[0] -> to_id, $i + $i);
      $this -> _assert_equals($result[0] -> message_type, M_SUGGESTION);
      $this -> _assert_equals($result[0] -> message_content, "awesome");
      $this -> _assert_equals($result[0] -> previous, ($i + 4) % 5);
      $this -> _assert_equals($result[0] -> next, ($i + 1) % 5);      
    }
  }

}
