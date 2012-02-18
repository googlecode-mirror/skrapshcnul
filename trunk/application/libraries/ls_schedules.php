<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ls_Schedules {
	
	function __construct() {
		$this -> ci = &get_instance();
		$this -> ci -> load -> model('user_profile_model');
		$this -> ci -> load -> model('schedules_model');
	}	
		
	function clearTables() { // WARNING: only for testing
		return $this -> ci -> schedules_model -> clearTables();
	}
	
	/*
	 * @param	obj		schedule information; must have user_id,  
	 * 					repeat_params, center_lat, center_lng, radius;
	 * 					'name' and 'disabled' is optional
	 */
	function addSchedule($obj) {
		return $this -> ci -> schedules_model -> addSchedule($obj);
	}
	
	/*
	 * @param	$user_id	user id
	 */
	function getSchedulesByUserId($user_id) {
		return 
			$this -> ci -> schedules_model -> getSchedulesByUserId($user_id);
	}
	
	/*
	 * @param	index	schedule id
	 */
	function getScheduleByIndex($index) {
		return $this -> ci -> schedules_model -> getScheduleByIndex($index);
	}
	
	/*
	 * @param	index	schedule id
	 */
	function deleteScheduleByIndex($index) {
		return 
			$this -> ci -> schedules_model -> deleteScheduleByIndex($index);
	}
	
	/*
	 * @param	obj		schedule information; must have 'index' or 
	 * 					'schedule_id'
	 */
	function updateSchedule($obj) {
		return $this -> ci -> schedules_model -> updateSchedule($obj);
	}
}
?>
