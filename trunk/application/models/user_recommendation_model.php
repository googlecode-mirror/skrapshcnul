<?php

/**
 * Recommendation Model
 */
class User_Recommendation_model extends CI_Model {

	public $tables = array();

	public function __construct() {
		$this -> load -> config('tables/recommendations', TRUE);

		## Initialize DB
		$this -> tables = 
			$this -> config -> item('tables', 'tables/recommendations');

	}
	
	function clearTables() { // WARNING: only for testing
		return $this -> db -> truncate(
			$this -> tables['user_recommendations']);
	}
	
	/*
	 * Function: get user recommendation for user <code>user_id</code>
	 * 
	 * @param	user_id		the id of the user
	 * @return	all user recommendations by the system for this user
	 * 
	 * old name: getUserEventSuggestion
	 */
	function getUserRecommendationsByUserId($user_id) {

		if (!$user_id) {
			return FALSE;
		}

		$query = " SELECT * FROM " . $this -> tables['user_recommendations'];
		$query .= " WHERE `user_id` = '$user_id' ;";

		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> result_array();
		} else {
			return FALSE;
		}
	}

	/*
	 * Function: return the number of total approved recommendations
	 * 
	 * old name: getUserEventSuggestion_count
	 */
	function countApprovedUserRecommendations() {

		$query = " SELECT count(*) as count FROM " . $this -> tables['user_recommendations'];
		$query .= " WHERE `approved` = 1 ";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> row() -> count;
		} else {
			return FALSE;
		}
	}

	/*
	 * Function: get approved user recommendations with page options
	 * 
	 * @param	fields	{page, per_page}
	 * 
	 * old name: getUserEventSuggestion_all_by_page
	 */
	function getApprovedUserRecommendations($fields = FALSE) {

		$page = isset($field['page']) ? $field['page'] : 0;
		$per_page = isset($field['per_page']) ? $field['per_page'] : 30;

		$query = " SELECT * FROM " . $this -> tables['user_recommendations'];
		$query .= " WHERE `approved` = 1 ";
		$query .= " LIMIT $page , $per_page ";

		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> result_array();
		} else {
			return FALSE;
		}
	}

	/* 
	 * Function: count number of inapproved user recommendations
	 * 
	 * old name: getPastUserEventSuggestion_count 
	 */
	function countUnapprovedUserRecommendations() {

		$query = " SELECT count(*) as count FROM " . $this -> tables['user_recommendations'];
		$query .= " WHERE `approved` = 0 ";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> row() -> count;
		} else {
			return FALSE;
		}
	}

	/*
	 * Function: get unapproved user recommendations with page options
	 * 
	 * @params	fields	{page, per_page}
	 * 
	 * old name: getPastUserEventSuggestions_all_by_page
	 */
	function getUnapprovedUserRecommendations($fields = FALSE) {

		$page = isset($field['page']) ? $field['page'] : 0;
		$per_page = isset($field['per_page']) ? $field['per_page'] : 30;

		$query = " SELECT * FROM " . $this -> tables['user_recommendations'];
		$query .= " WHERE `approved` = 0 ";
		$query .= " LIMIT $page , $per_page ";

		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> result_array();
		} else {
			return FALSE;
		}
	}	

	function getUserRecommendationByUserIdAndTargetUserId($fields = FALSE) {
		// Set Data Values
		$user_id = isset($fields['user_id']) ? $fields['user_id'] : FALSE;
		$target_user_id = isset($fields['target_user_id']) ? $fields['target_user_id'] : FALSE;
		
		// Check for existing record
		$query = " SELECT * FROM " . $this -> tables['user_recommendations'];
		$query .= " WHERE `user_id` = '" . $user_id . "'";
		$query .= " AND `rec_id` = '" . $target_user_id . "'";
		$mysql_result = $this -> db -> query($query);

		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> result_array();
		} else {
			return NULL;
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
		
		// Logic approvedation
		if ($user_id == $target_user_id) {
			return FALSE;
		}
		
		$result = $this -> getUserRecommendationByUserIdAndTargetUserId($fields);
		if (!empty($result)) {
			// do not create duplicate entry
			return FALSE;
		}
			
		$query = " INSERT INTO " . $this -> tables['user_recommendations'];
		$query .= " (`user_id`, `rec_id`, `rec_reason`, `approved`) ";
		$query .= " VALUES ('" . $user_id . "', '" . $target_user_id . "', '" . $reason . "', 1)";

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
		//$query .= " (`index`, `approved`, `timestamp` ) ";
		//$query .= " VALUES ('$recommendation_id', '1', NOW() ) ";
		//$query .= " ON DUPLICATE KEY UPDATE approved = 1, timestamp = NOW() ";
		
		$query = " UPDATE " . $this -> tables['user_recommendations'];
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
		
		$query = " UPDATE " . $this -> tables['user_recommendations'];
		$query .= " SET `selected` = -1, `timestamp` = NOW()";
		$query .= " WHERE `index` = '$recommendation_id'";
		
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
	
	/*
	 * Function: is the recommendation {user, target} confirmed?
	 */
	function isConfirmed_($user, $target) {
		$result = $this -> db -> get_where(
			$this -> tables['user_recommendations'], 
		    array('user_id' => $user, 'rec_id' => $target, 'selected' => '1'));
		$result = $result -> result();
		if (empty($result)) {
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	
	/*
	 */
	function countPendingUserRecommendation($user_id) {

		$query = " SELECT count(*) as count FROM " . $this -> tables['user_recommendations'];
		$query .= " WHERE `approved` = 1 AND `selected` = 0; ";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> row() -> count;
		} else {
			return FALSE;
		}
	}
}
