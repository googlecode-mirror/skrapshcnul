<?php

/*
 * Tien: I haven't tested updatePick because it is not easy to test it without the layout.
 */

class Schedules_Model extends CI_Model {

	function _insertPick($userid, $name, $date, $time, $date_end, $time_end, $center_lat, $center_lng, $radius, $repeat) {
		$datetime_start = trim($date) . " " . trim($time);
		$datetime_end = trim($date_end) . " " . trim($time_end);
		$query = "INSERT INTO lss_schedules (user_id, name, start_date, end_date, repeat_params, center_lat, center_lng, radius) " . " VALUES ('$userid', '$name', " . " STR_TO_DATE('$datetime_start','%m/%d/%Y %T'), " . " STR_TO_DATE('$datetime_end','%m/%d/%Y %T'), " . " '$repeat', " . " '$center_lat', '$center_lng', '$radius')";
		$success = $this -> db -> query($query);
		return $success;
	}

	function insertPickForCurrentUser($name, $date, $time, $date_end, $time_end, $center_lat, $center_lng, $radius, $repeat) {
		$userid = $this -> session -> userdata('user_id');
		return $this -> _insertPick($userid, $name, $date, $time, $date_end, $time_end, $center_lat, $center_lng, $radius, $repeat);
	}

	function _selectPick($userid) {
		$query = " SELECT " . " user_id, `index`, " . " DATE(start_date) as startDate, TIME(start_date) as startTime, " . " DATE(end_date) as endDate, TIME(end_date) as endTime, " . " name, center_lat, center_lng, radius, repeat_params " . " FROM lss_schedules " . " WHERE user_id = '$userid';";
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

	function updateScheduleForCurrentUser($fields) {
		
		## Prepare data
		$schedule_id	= isset($fields['schedule_id']) ? $fields['schedule_id'] : '';
		$user_id		= isset($fields['user_id']) ? $fields['user_id'] : '';
		$name			= isset($fields['name']) ? $fields['name'] : '';
		$start_date		= isset($fields['start_date']) ? $fields['start_date'] : '';
		$start_time		= isset($fields['start_time']) ? $fields['start_time'] : '';
		$end_date		= isset($fields['end_date']) ? $fields['end_date'] : '';
		$end_time		= isset($fields['end_time']) ? $fields['end_time'] : '';
		$repeat_params	= isset($fields['repeat_params']) ? $fields['repeat_params'] : '';
		$center_lat		= isset($fields['center_lat']) ? $fields['center_lat'] : '';
		$center_lng		= isset($fields['center_lng']) ? $fields['center_lng'] : '';
		$radius			= isset($fields['radius']) ? $fields['radius'] : '';
		
		$datetime_start	= trim($start_date) . " " . trim($start_time);
		$datetime_end	= trim($end_date) . " " . trim($end_time);
		
		## Data Validation
		if (empty($schedule_id) || !is_numeric($schedule_id) ) return FALSE;
		if (empty($user_id) || !is_numeric($user_id)) return FALSE;
		
		//$userid, $index, $name, $date, $time, $date_end, $time_end, $center_lat, $center_lng, $radius
		$query = 
			" UPDATE lss_schedules SET 
				name = '$name', 
				start_date = '$datetime_start', 
				end_date = '$datetime_end', 
				repeat_params = '$repeat_params', 
				center_lat = '$center_lat', 
				center_lng = '$center_lng', 
				radius = '$radius', 
				updated_on = NOW() " . 
			" WHERE `index` = '$schedule_id' AND `user_id` = '$user_id' ";
		$mysql_result = $this -> db -> query($query);
		
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	## Schdeles
	function selectSchedule($schedule_id) {
		$userid = $this -> session -> userdata('user_id');
		if (!$userid) {
			return FALSE;
		}
		$query	= 
			" SELECT user_id, `index`, DATE(start_date) as start_date, TIME_FORMAT(start_date, '%H:%i') as start_time, DATE(end_date) as end_date, TIME_FORMAT(end_date, '%H:%i') as end_time, name, center_lat, center_lng, radius, repeat_params " . 
			" FROM lss_schedules " . 
			" WHERE user_id = '$userid' ";
			" AND index = '$schedule_id' ";
		$mysql_result = $this -> db -> query($query);
		
		if ($mysql_result->num_rows() > 0) {
			return $mysql_result->row_array();
		} else {
			return FALSE;
		}
		
	}
}
?>
