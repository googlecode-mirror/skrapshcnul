<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Ls_Schedules {

	function __construct() {
		$this -> ci = &get_instance();
		$this -> ci -> load -> model('user_profile_model');
		$this -> ci -> load -> model('schedules_model');
	}

	function clearTables() {// WARNING: only for testing
		return $this -> ci -> schedules_model -> clearTables();
	}

	/*
	 * @param	obj		schedule information; must have user_id,
	 * 					repeat_params, center_lat, center_lng, radius;
	 * 					'name' and 'disabled' is optional
	 */
	function addSchedule($obj) {
		if (isset($obj['repeat_params']) && is_array($obj['repeat_params'])) {
			$obj['repeat_params'] = json_encode($obj['repeat_params']);
		};
		
		return $this -> ci -> schedules_model -> addSchedule($obj);
	}

	/*
	 * @param	$user_id	user id
	 */
	function getSchedulesByUserId($user_id) {
		$results = $this -> ci -> schedules_model -> getSchedulesByUserId($user_id);
		
		if (sizeof($results > 0)) {
			foreach ($results as $key => $item) {
				$results[$key]['repeat_params'] = json_decode($item['repeat_params'], TRUE);
			}
		}
		
		return $results;
		
	}

	/*
	 * @param	index	schedule id
	 */
	function getScheduleByIndex($index) {
		$results = $this -> ci -> schedules_model -> getScheduleByIndex($index);
		$results['repeat_params'] = json_decode($results['repeat_params'], TRUE);
		return $results;
		
	}

	/*
	 * @param	index	schedule id
	 */
	function deleteScheduleByIndex($index) {
		return $this -> ci -> schedules_model -> deleteScheduleByIndex($index);
	}

	/*
	 * @param	obj		schedule information; must have 'index' or
	 * 					'schedule_id'
	 */
	function updateSchedule($obj) {
		if (isset($obj['repeat_params']) && is_array($obj['repeat_params'])) {
			$obj['repeat_params'] = json_encode($obj['repeat_params']);
		};
		
		return $this -> ci -> schedules_model -> updateSchedule($obj);
	}

}
?>
