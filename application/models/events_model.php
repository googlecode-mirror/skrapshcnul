<?php

/**
 * Event Model
 */
class Events_model extends CI_Model {

	public $tables = array();

	public function __construct() {
		$this -> load -> config('tables/events', TRUE);

		## Initialize DB
		$this -> tables = $this -> config -> item('tables', 'tables/events');

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

}
