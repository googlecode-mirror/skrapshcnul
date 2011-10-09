<?php

class Schedules_Model extends CI_Model {

	function _insertPick($userid, $name, $date, $time, $date_end, $time_end, $center_lat, $center_lng, $radius) {
		$datetime = $date . " " . $time;
		$datetime_end = $date_end . " " . $time_end;
		$query = 
			"INSERT INTO lss_schedules (user_id, name, start_date, end_date, center_lat, center_lng, radius) " . 
			" VALUES ('$userid', '$name', " . 
			" STR_TO_DATE('$datetime','%m/%d/%Y %h:%i %p'), " . 
			" STR_TO_DATE('$datetime_end','%m/%d/%Y %h:%i %p'), " . 
			" '$center_lat', '$center_lng', '$radius')";
		$success = $this -> db -> query($query);
		return $success;
	}

	function insertPickForCurrentUser($name, $date, $time, $date_end, $time_end, $center_lat, $center_lng, $radius) {
		$userid = $this -> session -> userdata('user_id');
		return $this -> _insertPick($userid, $name, $date, $time, $date_end, $time_end, $center_lat, $center_lng, $radius);
	}

	function _selectPick($userid) {
		$query = 
			" SELECT " . 
			" user_id, `index`, " . 
			" DATE(start_date) as startDate, TIME(start_date) as startTime, " . 
			" DATE(end_date) as endDate, TIME(end_date) as endTime, " . 
			" name, center_lat, center_lng, radius, params " . 
			" FROM lss_schedules " . 
			" WHERE user_id = '$userid';";
		$result = $this -> db -> query($query);
		return $result;
	}

	function selectPickForCurrentUser() {
		$userid = $this -> session -> userdata('user_id');
		return $this -> _selectPick($userid);
	}

	function _deletePick($userid, $index) {
		$query = "DELETE FROM lss_schedules " . "WHERE user_id = '$userid' AND `index` = '$index';";
		$result = $this -> db -> query($query);
		return $result;
	}

	function deletePickForCurrentUser($index) {
		$userid = $this -> session -> userdata('user_id');
		return $this -> _deletePick($userid, $index);
	}

}
?>
