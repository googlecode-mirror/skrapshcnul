<?php

/**
 * Event Model
 */
class Events_model extends CI_Model {

	public $tables = array();

	function __construct() {
		$this -> load -> config('tables/events', TRUE);
		$this -> load -> helper('logger');

		## Initialize DB
		$this -> tables = $this -> config -> item('tables', 'tables/events');

	}
	
	function clearTables() { // WARNING: only for testing
		$result = TRUE;
		foreach ($this -> tables as $key => $value) {
			$result = $result && ($this -> db -> truncate($value));
		}
		return $result;
	}


	/*-----------------------------------------------------------------------
	 * Section 1: Manipulate an event using its id 
	 *-----------------------------------------------------------------------*/
		
	/*
	 * Function: Get information about an event given its id.
	 * @param 	event_id	the event id
	 */
	function getEventByEventId($event_id) {
		$query = "SELECT * FROM `lss_events` WHERE `event_id` = '$event_id';";
		$result = $this -> db -> query($query);
		if (empty($result)) return NULL; // error
		else if ($result -> num_rows() != 1) return NULL; // error
		else return $result -> row_array(); 
	}
	
	/*
	 * Function: Get information about lunch buddies that participate 
	 * in an event <code>event_id</code> with user <code>user_id</code>.
	 * 
	 * @param	event_id	the event id
	 * @param 	user_id		the user id 
	 */
	function getLunchBuddiesByEventId($event_id, $user_id) {
		$query = "SELECT * FROM `lss_events_users` " . 
				 "WHERE `event_id` = '$event_id' ". 
				 "AND `user_id` != '$user_id';";
		$result = $this -> db -> query($query);
		if (empty($result)) return NULL; // error
		else return $result -> result_array();
	}
	
	/*
	 * Function: Get all users of an event
	 * 
	 * @param	event_id	id of the event;
	 * @return				an array of user information that participate in 
	 *                      this event;
	 */
	function getAllUsersByEventId($event_id) {

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
	
	/*
	 * Function: Change status of an event.
	 *  (+) status = -1 ==> this event request has been cancelled;
	 * 	(+) status = 0 ==> this is still an event request, waiting for confirm;
	 * 	(+) status = 1 ==> this event request has been confirmed, and 
	 *                     it now is an upconming event;
	 *  (+) status = 2 ==> this event request was confirmed, and 
	 *                     the corresponding event was already over (past event).
	 * 
	 * @param 	event_id	the event id
	 * @param	status 		the new status
	 */
	function updateEventStatus($event_id, $status) {
		$query = "UPDATE " . $this -> tables['events_event'] .
				 " SET event_status = '$status' " .
				 " WHERE event_id = '$event_id'; ";
		return $this -> db -> query($query);
	}

	/*
	 * Function: Check if this event has been confirmed by everyone
	 * 
	 * @param	event_id	the id of the event
	 * @return	TRUE/FALSE	the event has/has not been confirmed
	 */
	private function hasBeenConfirmedByEveryone($event_id) {
		$query = "SELECT * FROM " . $this -> tables['events_users'] .
				 " WHERE event_id = '$event_id' " .
				 " AND rsvp != 1; ";
		$result = $this -> db -> query($query);				 
		if ($result -> num_rows() == 0) {
			return TRUE; // confirmed
		}
		else {
			return FALSE; // there is still someone with rsvp != 1
		}
	}
	
	/* 
	 * Function: Create lunch event for a list of users
	 * 
	 * @param	fields		{date, location, list of users} 
	 */
	function createEvent($fields = FALSE) {
		
		/* Data Validation */
		if (!$fields) {
			return FALSE;
		}
		if (!isset($fields['event_date'])) {
			return FALSE;
		}
		if (!isset($fields['event_location'])) {
			return FALSE;
		}
		if (!isset($fields['user_ids'])) {
			return FALSE;
		} elseif (count($fields['user_ids']) < 2) {
			return FALSE;
		}
		if (!isset($fields['reason'])) {
			return FALSE;
		}
		if (!isset($fields['deadline'])) {
			return FALSE;
		}
		
		/* Prepare Data Values */
		$date = $fields['event_date'];
		$location = $fields['event_location'];
		$reason = $fields['reason'];
		$due = $fields['deadline'];
		$user_ids = $fields['user_ids'];

		/* SQL Queries */

		$query = " INSERT INTO " . $this -> tables['events_event'];
		$query .= " ( `date`, `location`, `reason`, `created_on`, `deadline`) ";
		$query .= " VALUES ( '$date', '$location', '$reason', NOW(), '$due' ) ";

		$mysql_result = $this -> db -> query($query);
		if ($this -> db -> affected_rows()) {

			$results['last_insert_id'] = $this -> db -> insert_id();

			foreach ($user_ids as $user_id) {
				$query = " INSERT INTO " . $this -> tables['events_users'];
				$query .= " ( `event_id`, `user_id`, `rsvp`, `updated_on`) ";
				$query .= " VALUES ( '" . $results['last_insert_id'] . "', '$user_id', '0', NOW() ) ";

				$mysql_result = $this -> db -> query($query);
				if (!$this -> db -> affected_rows()) {
					return FALSE;
				}
			}

		} else {
			return FALSE;
		}

		return $results;

	}	
	
	/*
	 * Function: Update event respond
	 * 
	 * @param 	fields 		{event_id, user_id, action(-1, 0, 1)} 
	 */
	function event_RSVP($fields = FALSE) {

		if (!$fields) {
			return FALSE;
		}

		if (!isset($fields['event_id']) || !is_numeric($fields['event_id'])) {
			return FALSE;
		}
		
		if (!isset($fields['user_id']) || !is_numeric($fields['user_id'])) {
			return FALSE;
		}

		if (!isset($fields['action']) || !is_numeric($fields['action'])) {
			var_dump($fields['action']);
			return FALSE;
		}

		$query = " UPDATE " . $this -> tables['events_users'];
		$query .= " SET `rsvp` = " . $fields['action'] . ", `updated_on` = NOW() ";
		$query .= " WHERE `event_id` = " . $fields['event_id'];
		$query .= " AND `user_id` = " . $fields['user_id'];

		$mysql_result = $this -> db -> query($query);
		
		if ($this -> db -> affected_rows()) {
		} else {
			return FALSE;
		}
		
		if ($fields['action'] == -1) 
			// this guy rejects the event -> cancel the event
			return $this -> updateEventStatus($fields['event_id'], -1);
		
		else if ($fields['action'] == 1) {
			if ($this -> hasBeenConfirmedByEveryone($fields['event_id']))
				// if everyone confirmed this event -> mark it as upcoming event
				return $this -> updateEventStatus($fields['event_id'], 1);
		}
		
		return TRUE;
	}
	
	
	/*-----------------------------------------------------------------------
	 * Section 3: Manipulation events of an user  
	 *-----------------------------------------------------------------------*/
	
	/* 
	 * Function: get events of user <code>user_id</code> with status options
	 * 
	 * @param	user_id			id of the user;
	 * @param	status_list		an array that indicates which events should be 
	 *                          returned e.g. {-1, 0} or {-1, 1, 2};
	 * @return					an array of events with information;
	 * 
	 * old name: getUserEvent_request 
	 */
	function getEventsByUserId($user_id, $status_list) {

		if (!$user_id || !$status_list) {
			return FALSE;
		}
		
		$options = "(";
		$added = FALSE;
		for ($i = -1; $i <= 2; ++$i) {
			if (!empty($status_list[$i])) {
				if ($added) $options .= " OR ";
				$options .=  "ee.`event_status` = " . $i;
				$added = TRUE;
			}
		}
		$options .= ")";

		$query = " SELECT ee.`event_id`, ee.`event_status`, ee.`date`, `location`, ee.`deadline`, ee.`created_on`, ee.`updated_on` ";
		$query .= " FROM " . $this -> tables['events_event'] . " AS ee";
		$query .= " LEFT JOIN " . $this -> tables['events_users'] . " AS eu ON `eu`.`event_id` = `ee`.`event_id` ";
		$query .= " WHERE `user_id` = '$user_id' ";
		$query .= " AND " . $options;

		$mysql_result = $this -> db -> query($query);

		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> result_array();
		} else {
			return FALSE;
		}
	}
	
	/* @section Admin Functions */

	/* 
	 * Function: get events with status options
	 * 
	 * @param	status_list		an array that indicates which events should be 
	 *                          returned e.g. {-1, 0} or {-1, 1, 2};
	 * @return					an array of events with information;
	 * 
	 * old name: getUserEvent_request 
	 */
	function getAllEvents($status_list) {

		// TODO check admin level
		if (!$status_list) {
			return NULL;
		}
		
		$options = "(";
		$added = FALSE;
		for ($i = -1; $i <= 2; ++$i) {
			if (!empty($status_list[$i])) {
				if ($added) $options .= " OR ";
				$options .=  "ee.`event_status` = " . $i;
				$added = TRUE;
			}
		}
		$options .= ")";

		$query = " SELECT * FROM " . $this -> tables['events_event'] . " AS ee ";
		$query .= " WHERE " . $options;

		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {

			$events = $mysql_result -> result_array();

			foreach ($events as $key => $event) {
				$events[$key]['participants'] = $this -> getAllUsersByEventId($event['event_id']);
			}

			return $events;
		} else {
			return FALSE;
		}
	}
	
	function countPendingEventRequests($user_id = FALSE) {
		
		if (!$user_id) {
			return NULL;
		}
		
		$query = " SELECT COUNT(*) AS count";
		$query .= " FROM " . $this -> tables['events_event'] . " AS ee";
		$query .= " LEFT JOIN " . $this -> tables['events_users'] . " AS eu ON `eu`.`event_id` = `ee`.`event_id` ";
		$query .= " WHERE `user_id` = '$user_id' AND `event_status` = 0 AND `rsvp` = 0";
		
		$mysql_result = $this -> db -> query($query);

		if ($mysql_result -> num_rows() > 0) {
			$row = $mysql_result -> row_array();
			return $row['count'];
		} else {
			return FALSE;
		}
		
	}
}
