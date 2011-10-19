<?php

/*
 * Tien: I haven't tested updatePick because it is not easy to test it without the layout.
 */

class Schedules_Model extends CI_Model {
  
	function _insertPick($userid, $name, $date, $time, $date_end, $time_end, $center_lat, $center_lng, $radius, $repeat) {
		$datetime_start = trim($date) . " " . trim($time);
		$datetime_end = trim($date_end) . " " . trim($time_end);
		$query = 
			"INSERT INTO lss_schedules (user_id, name, start_date, end_date, repeat_params, center_lat, center_lng, radius) " . 
			" VALUES ('$userid', '$name', " . 
			" STR_TO_DATE('$datetime_start','%m/%d/%Y %T'), " . 
			" STR_TO_DATE('$datetime_end','%m/%d/%Y %T'), " .
			" '$repeat', " .
			" '$center_lat', '$center_lng', '$radius')";
		$success = $this -> db -> query($query);
		return $success;
	}

	function insertPickForCurrentUser($name, $date, $time, $date_end, $time_end, $center_lat, $center_lng, $radius, $repeat) {
		$userid = $this -> session -> userdata('user_id');
		return $this -> _insertPick($userid, $name, $date, $time, $date_end, $time_end, $center_lat, $center_lng, $radius, $repeat);
	}

	function _selectPick($userid) {
		$query = 
			" SELECT " . 
			" user_id, `index`, " . 
			" DATE(start_date) as startDate, TIME(start_date) as startTime, " . 
			" DATE(end_date) as endDate, TIME(end_date) as endTime, " . 
			" name, center_lat, center_lng, radius, repeat_params " . 
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
  
  function updatePick($userid, $index, $name, $date, $time, 
          $date_end, $time_end, $center_lat, $center_lng, $radius) {
    
    $datetime_start = $date . " " . $time;
		$datetime_end = $date_end . " " . $time_end;
		$query = 
			"UPDATE lss_schedules " . 
			" SET name = '$name' " . 
		    " , start_date = STR_TO_DATE('$datetime_start','%m/%d/%Y %T') " . 
		    " , end_date = STR_TO_DATE('$datetime_end','%m/%d/%Y %T') " . 
		    " , center_lat = '$center_lat', center_lng = '$center_lng' " . 
		    " , radius = '$radius' " .
		    " WHERE user_id = '$userid' AND `index` = '$index';";
		$success = $this -> db -> query($query);
		return $success;
  }
  
  function updatePickForCurrentUser($index, $name, $date, $time, 
          $date_end, $time_end, $center_lat, $center_lng, $radius) {
    
    $userid = $this -> session -> userdata('user_id');
    return $this -> _updatePick($userid, $index);
  }
  
}
?>
