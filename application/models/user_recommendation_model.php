<?php

/**
 * Event Model
 */
class User_Recommendation_model extends CI_Model {

	public $tables = array();

	public function __construct() {
		$this -> load -> config('tables/events', TRUE);

		## Initialize DB
		$this -> tables = $this -> config -> item('tables', 'tables/events');

	}
	
	function clearTables() { // WARNING: only for testing
		return $this -> db -> truncate(
			$this -> tables['event_auto_recommendation']);
	}

	function getUserEventSuggestion($user_id) {

		if (!$user_id) {
			return FALSE;
		}

		$query = " SELECT * FROM " . $this -> tables['event_auto_recommendation'];
		$query .= " WHERE `user_id` = '$user_id' ;";

		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> result_array();
		} else {
			return FALSE;
		}
	}

	function getUserEventSuggestion_count() {

		$query = " SELECT count(*) as count FROM " . $this -> tables['event_auto_recommendation'];
		$query .= " WHERE `valid` = 1 ";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> row() -> count;
		} else {
			return FALSE;
		}
	}

	function getUserEventSuggestion_all_by_page($fields = FALSE) {

		$page = isset($field['page']) ? $field['page'] : 0;
		$per_page = isset($field['per_page']) ? $field['per_page'] : 30;

		$query = " SELECT * FROM " . $this -> tables['event_auto_recommendation'];
		$query .= " WHERE `valid` = 1 ";
		$query .= " LIMIT $page , $per_page ";

		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> result_array();
		} else {
			return FALSE;
		}

	}

	function getPastUserEventSuggestion_count() {

		$query = " SELECT count(*) as count FROM " . $this -> tables['event_auto_recommendation'];
		$query .= " WHERE `valid` = 0 ";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> row() -> count;
		} else {
			return FALSE;
		}
	}

	function getPastUserEventSuggestions_all_by_page($fields = FALSE) {

		$page = isset($field['page']) ? $field['page'] : 0;
		$per_page = isset($field['per_page']) ? $field['per_page'] : 30;

		$query = " SELECT * FROM " . $this -> tables['event_auto_recommendation'];
		$query .= " WHERE `valid` = 0 ";
		$query .= " LIMIT $page , $per_page ";

		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> result_array();
		} else {
			return FALSE;
		}

	}
	
	function selectUserRecommendation($fields = FALSE) {
		// Set Data Values
		$user_id = isset($fields['user_id']) ? $fields['user_id'] : FALSE;
		$target_user_id = isset($fields['target_user_id']) ? $fields['target_user_id'] : FALSE;
		
		// Check for existing record
		$query = " SELECT * FROM " . $this -> tables['event_auto_recommendation'];
		$query .= " WHERE `user_id` = '" . $user_id . "'";
		$query .= " AND `rec_id` = '" . $target_user_id . "'";
		$query .= " AND `valid` = 1 ";
		$mysql_result = $this -> db -> query($query);

		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> result_array();
		} else {
			return FALSE;
		}
		
	}

	function createUserRecommendation($fields = FALSE) {

		if (!$fields) {
			return FALSE;
		}

		// Prepare Data Values
		$user_id = isset($fields['user_id']) ? $fields['user_id'] : FALSE;
		$target_user_id = isset($fields['target_user_id']) ? $fields['target_user_id'] : FALSE;
		$reason = isset($fields['reason']) ? $fields['reason'] : '';
		
		// Logic validation
		if ($user_id == $target_user_id) {
			return FALSE;
		}
		
		if ($result = $this -> selectUserRecommendation($fields)) {
			return $result;
		}
		
		$query = " INSERT INTO " . $this -> tables['event_auto_recommendation'];
		$query .= " (`user_id`, `rec_id`, `rec_reason`, `valid`) ";
		$query .= " VALUES ('" . $user_id . "', '" . $target_user_id . "', '" . $reason . "', 1)";

		$mysql_result = $this -> db -> query($query);
		if ($mysql_result) {
			return $this -> selectUserRecommendation($fields);
		} else {
			return FALSE;
		}
	}
	
	/* 
	 * @author binghan@lunchsparks.me
	 * @description confirmation for user recommendation 
	 */
	function confirm($fields = FALSE) {
		
		if (!$fields) {
			return FALSE;
		}
		
		// Prepare Data Value
		$user_id = isset($fields['user_id']) ? $fields['user_id'] : FALSE;
		$target_user_id = isset($fields['target_user_id']) ? $fields['target_user_id'] : FALSE;
		$recommendation_id = isset($fields['recommendation_id']) ? $fields['recommendation_id'] : '';
		
		//lss_0_auto_recs
		//lss_0_selected_recs
		//$query = " INSERT INTO lss_0_selected_recs ";
		//$query .= " (`index`, `valid`, `timestamp` ) ";
		//$query .= " VALUES ('$recommendation_id', '1', NOW() ) ";
		//$query .= " ON DUPLICATE KEY UPDATE valid = 1, timestamp = NOW() ";
		
		$query = " UPDATE " . $this -> tables['event_auto_recommendation'];
		$query .= " SET `selected` = 1, `timestamp` = NOW()";
		$query .= " WHERE `index` = '$recommendation_id'";
		
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}

	/* 
	 * @author binghan@lunchsparks.me
	 * @description confirmation for user recommendation 
	 */
	function reject($fields = FALSE) {
		
		if (!$fields) {
			return FALSE;
		}
		
		// Prepare Data Value
		$user_id = isset($fields['user_id']) ? $fields['user_id'] : FALSE;
		$target_user_id = isset($fields['target_user_id']) ? $fields['target_user_id'] : FALSE;
		$recommendation_id = isset($fields['recommendation_id']) ? $fields['recommendation_id'] : '';
		
		$query = " UPDATE " . $this -> tables['event_auto_recommendation'];
		$query .= " SET `selected` = 0, `timestamp` = NOW()";
		$query .= " WHERE `index` = '$recommendation_id'";
		
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
	
	/*
	 * 
	 */
	function isConfirmed($user, $target) {
		$result = $this -> db -> get_where(
			$this -> tables['event_auto_recommendation'], 
		    array('user_id' => $user, 'rec_id' => $target, 'selected' => '1'));
		$result = $result -> result();
		if (empty($result)) {
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
}
