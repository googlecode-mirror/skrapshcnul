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

	/* Matched Event */

	function createUserEventMatched($fields = FALSE) {

		if (!$fields['date']) {
			return FALSE;
		}
		if (!$field['location']) {
			return FALSE;
		}
		if (!$fields['users']) {
			return FALSE;
		}

		$date = $fields['date'];
		$location = $fields['location'];

		$query = " INSERT INTO " . $this -> tables['events_event'];
		$query .= " (`date`, `location`)  ";
		$query .= " VALUES ('$date', '$location') ";

		$mysql_result = $this -> db -> query($query);

		$event_id = $this -> db -> insert_id();

		if ($mysql_result) {
			$users = explode(',', $fields['users']);
			foreach ($users as $user) {

				$query = " INSERT INTO " . $this -> tables['events_users'];
				$query .= " (`event_id`, `user_id`)";
				$query .= " VALUES ('$event_id', '$user')";

				$mysql_result = $this -> db -> query($query);

				if (!$mysql_result) {
					return FALSE;
				}

			}
		} else {
			return FALSE;
		}

		return TRUE;
	}

	function getUserEventMatched($user_id) {

		if (!$user_id) {
			return FALSE;
		}

		$query = " SELECT ee.`event_id`, ee.`date`, `location`, ee.`created_on`, ee.`updated_on` ";
		$query .= " FROM " . $this -> tables['events_event'] . " AS ee";
		$query .= " LEFT JOIN " . $this -> tables['events_users'] . " AS eu ON `eu`.`event_id` = `ee`.`event_id` ";
		$query .= " WHERE `user_id` = '$user_id' ";
		$query .= " AND ee.`date` > NOW() ;";

		$mysql_result = $this -> db -> query($query);

		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> result_array();
		} else {
			return FALSE;
		}
	}

	function getEventAllUsers($event_id) {
		
		if (!$event_id) {
			return FALSE;
		}

		$query = " SELECT * FROM " . $this -> tables['events_users'];
		$query .= " WHERE `event_id` = '$event_id' ;";

		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> result_array();
		} else {
			return FALSE;
		}
		
	}
	
	function getUserEvent_past($fields = FALSE) {
		
		if (!$fields) {
			return FALSE;
		}
		
		if (!isset($fields['user_id'])) {
			return FALSE;
		}
		
		$user_id = $fields['user_id'];
		
		$query = " SELECT * FROM " . $this -> tables['events_event'] . " AS ee ";
		$query .= " LEFT JOIN " . $this -> tables['events_users'] . " AS eu ON ee.`event_id` = eu.`event_id` ";
		$query .= " WHERE `user_id` = '$user_id' ";
		$query .= " AND ee.`date` < NOW() ";

		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> result_array();
		} else {
			return FALSE;
		}
		
	}

	function event_RSVP($fields = FALSE) {

		if (!$fields) {
			return FALSE;
		}

		if (!isset($fields['oid']) || !is_numeric($fields['oid'])) {
			return FALSE;
		}
		
		if (!isset($fields['action']) || !is_numeric($fields['action'])) {
			var_dump($fields['action']);
			return FALSE;
		}
		
		$query = " UPDATE " . $this -> tables['events_users'];
		$query .= " SET `rsvp` = " . $fields['action'] . ", `updated_on` = NOW() ";
		$query .= " WHERE `id` = " . $fields['oid'];
		
		$mysql_result = $this -> db -> query($query);
		if ($this -> db -> affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
