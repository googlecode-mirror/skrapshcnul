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

}
