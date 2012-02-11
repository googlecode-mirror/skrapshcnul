<?php

/*
 * restaurant model 
 */
class Survey_Model extends CI_Model {
  
  public $tables = array();

  public function __construct() {
    $this -> load -> config('tables/survey', TRUE);
    $this -> tables = $this -> config -> item('tables', 'tables/survey');
  }
  			
	/*
	 *  Delete tables
	 *  Warning: Only for testing.
	 */
	function clearTables() {
		$query = "TRUNCATE TABLE " . $this -> tables['feedback_to_restaurant'];
		$result1 = $this -> db -> query($query);
		$query = "TRUNCATE TABLE " . $this -> tables['feedback_to_user'];
		$result2 = $this -> db -> query($query);
		return $result1 && $result2;
	}
	
	/*
	 * Insert
	 */
	function insertFeedbackToRestaurant($obj) {
		$index = $obj['event_id'];
		$user_id = $obj['user_id'];
		$res_id = $obj['restaurant_id'];
		$res_point = $obj['restaurant_point'];
		$res_review = $obj['restaurant_review'];
		
		if (empty($index) || empty($user_id) || empty($res_id) 
		    || empty($res_point) || empty($res_review)) return FALSE;
		
		$query = "INSERT INTO " . $this -> tables['feedback_to_restaurant'] .
		         " (event_id, user_id, restaurant_id, restaurant_point, " . 
		         " restaurant_review) " .
		         " VALUES ('$index', '$user_id', '$res_id', '$res_point', " . 
		         " '$res_review');";
		return $this -> db -> query($query);
	}
	
	function insertFeedbackToUser($obj) {
		$index = $obj['event_id'];
		$user_id = $obj['user_id'];
		$tar_id = $obj['target_id'];
		$tar_point = $obj['target_point'];
		$tar_review = $obj['target_review'];
		
		if (empty($index) || empty($user_id) || empty($tar_id) || 
		    empty($tar_point) || empty($tar_review)) return FALSE;
		
		$query = "INSERT INTO " . $this -> tables['feedback_to_user'] .
		         " (event_id, user_id, target_id, target_point, target_review) " .
		         " VALUES ('$index', '$user_id', '$tar_id', '$tar_point', " . 
		         " '$tar_review');";
		return $this -> db -> query($query);
	}
	
	function getFeedbackToUsers($event_id, $user_id) {
		$query = "SELECT * FROM " . $this -> tables['feedback_to_user'] .
				 " WHERE event_id = '$event_id' AND user_id = '$user_id'";
		$result = $this -> db -> query($query);
		if (empty($result)) return NULL;
		else return $result -> result_array(); 
	} 
	
	function getFeedbackToRestaurant($event_id, $user_id) {
		$query = "SELECT * FROM " . $this -> tables['feedback_to_restaurant'] .
				 " WHERE event_id = '$event_id' AND user_id = '$user_id'";
		$result = $this -> db -> query($query);				 
		if (empty($result)) return NULL;
		else if ($result -> num_rows() != 1) return NULL;
		else return $result -> row_array();
	}
}
?>
