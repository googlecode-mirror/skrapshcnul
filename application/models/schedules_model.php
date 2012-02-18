<?php

/*
 * Hello! This is new version of schedule model (updated on 2/18/2012)
 */

/*
 CREATE TABLE IF NOT EXISTS `lss_schedules` (
 `index` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `name` varchar(50) NOT NULL,
 `repeat_params` varchar(14) NOT NULL DEFAULT '00000000000000',
 `center_lat` double NOT NULL,
 `center_lng` double NOT NULL,
 `radius` double NOT NULL,
 `created_on` datetime NOT NULL,
 `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 KEY `index` (`index`)
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

 INSERT INTO  `binghan_llunch`.`lss_schedules` (`user_id` ,`name` ,`repeat_params` ,`center_lat` ,`center_lng` ,`radius` ,`created_on` ,`updated_on`)
 VALUES ('1',  'Daily Schedule',  '00000011000000',  '1.35145008855939',  '103.87279988916',  '1911.92212649337', NOW( ) , CURRENT_TIMESTAMP);
 */

class Schedules_Model extends CI_Model {

	function __construct() {
		$this -> load -> config('tables/schedules', TRUE);

		## Initialize DB
		$this -> tables = $this -> config -> item('tables', 'tables/schedules');
	}

	function clearTables() {// WARNING: only for testing
		return $this -> db -> truncate($this -> tables['schedules']);
	}

	function addSchedule($obj) {
		// obj must has: user_id, repeat_params,
		// center_lat, center_lng, radius.
		// 'name' is optional.
		if (empty($obj))
			return FALSE;
		
		$columns = array('user_id', 'name', 'repeat_params', 'center_lat', 'center_lng', 'radius');

		foreach ($columns as $key => $value) {
			if (isset($value))
				$data[$value] = $obj[$value];
		}
		
		// created_on
		$data['created_on'] = date('Y-m-d H:i:s');

		// insert
		return $this -> db -> insert($this -> tables['schedules'], $data);
	}

	function doneScheduled($user_id) {
		$this -> db -> set('index');
	  	$this -> db -> where('user_id', $user_id);
	  	$result = $this -> db -> get($this -> tables['schedules']);
	  	$result = $result -> result();
		if (empty($result)) return FALSE;
		else return TRUE; 
	}
	
	function getSchedulesByUserId($user_id) {
		$result = $this -> db -> get_where($this -> tables['schedules'], array('user_id' => $user_id));
		return $result -> result_array();
	}

	function getScheduleByIndex($index) {
		$result = $this -> db -> get_where($this -> tables['schedules'], array('index' => $index));
		return $result -> row_array();
	}

	function deleteScheduleByIndex($index) {
		return $this -> db -> delete($this -> tables['schedules'], array('index' => $index));
	}

	function updateSchedule($obj) {

		if (empty($obj))
			return FALSE;
		// error

		## must have either 'index' or 'schedule_id' field
		if (isset($obj['schedule_id']))
			$index = $obj['schedule_id'];
		else if (isset($obj['index']))
			$index = $obj['index'];
		else
			return FALSE;

		## Prepare data
		$data = array();

		$columns = array('name', 'repeat_params', 'center_lat', 'center_lng', 'radius');

		foreach ($columns as $key => $value) {
			if (isset($value))
				$data[$value] = $obj[$value];
		}
		
		## execute query
		$this -> db -> where('index', $index);
		$this -> db -> update($this -> tables['schedules'], $data);

		if ($this -> db -> affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
?>
