<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Schedules extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this -> load -> database();
		$this -> load -> library('ion_auth');
		$this -> load -> library('ls_schedules');
		$this -> load -> library('session');
		$this -> load -> library('input');
		$this -> load -> model('page_steps_completed_model');
		$this -> load -> model('schedules_model');
		$this -> load -> helper('logger');

		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> data['is_logged_in_admin'] = $this->ion_auth->is_admin();
			
		// Check if user is logged in
		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		
		$this->user_id = $this -> session -> userdata('user_id');
		
		$this->data['steps_completed'] = $this -> page_steps_completed_model -> select($this->user_id);
		
		// Request Params: alt = json | , 
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';
		
		$this -> start_time = time();
		}

	function index() {
		$this -> data['timepicker'] = true;
		// load timepicker js
		$this -> data['googlemap'] = true;
		// load google map js
		
		
		$schedule = $this -> ls_schedules -> getSchedulesByUserId($this -> user_id);
		
		$this -> data['fixed_schedules']['results'] = $schedule;
		
		// Render view data
		$this -> data['head_title']		= 'Schedule | Lunchsparks'; 
		$this -> data['tpl_page_id']	= 'schedule#index';
		$this -> data['tpl_page_title'] = "Schedule";
		// Render views
		$this -> data['main_content'] = 'base/schedules/index';
		$this -> load -> view('includes/tmpl_layout_withGuides', $this -> data);
	}

	function add() {
		if ($this->input->post()) {
			$this -> _insert();
		}
		
		$this -> data['timepicker'] = true;
		// load timepicker js
		$this -> data['googlemap'] = true;
		// load google map js

		// Render view data
		$this -> data['head_title']		= 'Add Schedule | Lunchsparks'; 
		$this -> data['tpl_page_id']	= 'schedule#add';
		$this -> data['tpl_page_title'] = "Add Schedule";
		// Render views
		$this -> data['main_content'] = 'base/schedules/add';
		$this -> load -> view('includes/tmpl_layout_withGuides', $this -> data);
	}
	
	function edit() {
		
		// Check if the schedule id is present
		$array = $this->uri->uri_to_assoc(3);
		if(isset($array['id']) && !empty($array['id'])) {
			$this -> schedule_id = $array['id'];
		} else {
			redirect('/404/', 'refresh');
		}
		
		if ($this->input->post()) {
			$this -> _update();
		}
		
		// Check if user is logged in
		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		} else {
				
			$schedule = $this -> ls_schedules -> getScheduleByIndex($this -> schedule_id);
			$this -> data['schedule'] = $schedule;
			
			$this -> data['timepicker'] = true;
			// load timepicker js
			$this -> data['googlemap'] = true;
			// load google map js

			// Render view data
			$this -> data['head_title']		= 'Edit Schedule | Lunchsparks'; 
			$this -> data['tpl_page_id']	= 'schedule#edit';
			$this -> data['tpl_page_title'] = "Edit Schedule";
			// Render views
			$this -> data['main_content'] = 'base/schedules/edit';
			$this -> load -> view('includes/tmpl_layout_withGuides', $this -> data);
		}
	}

	private function _insert() {
		
		$repeat_params = array();
		foreach ($this -> input -> post("DAY") as $day) {
			$lunch = $this -> input -> post($day."_LUNCH");
			$repeat_param = array();
			if ($lunch) {
				$repeat_param['DAY'] = $day;
				$repeat_param['LUNCH'] = 1;
			}
			$dinner = $this -> input -> post($day."_DINNER");
			if ($dinner) {
				$repeat_param['DAY'] = $day;
				$repeat_param['DINNER'] = 1;
			}
			if (sizeof($repeat_param) > 0) {
				$repeat_params[$day] = $repeat_param;
			}
		}
		$this -> repeat_params = ($repeat_params);
		
		## Prepare Data Fields.
		$fields['user_id']			= $this -> user_id;
		$fields['name']				= $this -> input -> post("name");
		$fields['start_date']		= $this -> input -> post("start_date");
		$fields['start_time']		= $this -> input -> post("start_time");
		$fields['end_date']			= $this -> input -> post("start_date");
		$fields['end_time']			= $this -> input -> post("end_time");
		$fields['repeat_params']	= $this -> repeat_params;
		$fields['center_lat']		= $this -> input -> post("center_lat");
		$fields['center_lng']		= $this -> input -> post("center_lng");
		$fields['radius']			= $this -> input -> post("radius");
		
		$result = $this -> ls_schedules -> addSchedule($fields);
		
		redirect('schedules', 'refresh');
	}


	private function _update() {
		
		$repeat_params = array();
		foreach ($this -> input -> post("DAY") as $day) {
			$lunch = $this -> input -> post($day."_LUNCH");
			$repeat_param = array();
			if ($lunch) {
				$repeat_param['DAY'] = $day;
				$repeat_param['LUNCH'] = 1;
			}
			$dinner = $this -> input -> post($day."_DINNER");
			if ($dinner) {
				$repeat_param['DAY'] = $day;
				$repeat_param['DINNER'] = 1;
			}
			if (sizeof($repeat_param) > 0) {
				$repeat_params[$day] = $repeat_param;
			}
		}
		$this -> repeat_params = ($repeat_params);
		
		## Prepare Data Fields.
		$fields['schedule_id']		= $this -> schedule_id;
		$fields['user_id']			= $this -> user_id;
		$fields['name']				= $this -> input -> post("name");
		$fields['repeat_params']	= $this -> repeat_params;
		$fields['center_lat']		= $this -> input -> post("center_lat");
		$fields['center_lng']		= $this -> input -> post("center_lng");
		$fields['radius']			= $this -> input -> post("radius");
		
		$result = $this -> ls_schedules -> updateSchedule($fields);
		redirect('schedules', 'refresh');
	}

	function select() {
		
		$result = $this -> ls_schedules -> getSchedulesByUserId($this->user_id);
		
		if ($this -> alt == 'json') {
			$this -> _json_prep($result);
		} else {
			print_r(json_encode($result));
		}
		
	}

	function delete() {
		// URL format /schedules/delete/:index/
		
		// Check if the schedule id is present
		$array = $this->uri->uri_to_assoc(3);
		
		if(isset($array['index']) && !empty($array['index'])) {
			$schedule_id = $array['index'];
		} elseif( $this->input->post('index') ) {
			$schedule_id = $this->input->post('index');
		} elseif( isset($_REQUEST['index']) ) {
			$schedule_id = $_REQUEST['index'] ;
		} else {
			redirect('/404/', 'refresh');
		}
		
		if ($this -> alt == 'json') {
			$this -> ls_schedules -> deleteScheduleByIndex($schedule_id);
			$this -> select();
		} else {
			
		}
		
		$result = $this -> ls_schedules -> deleteScheduleByIndex($schedule_id);
		
	}
	
	function _json_prep($result) {
		$json_result['completed_in'] =  number_format(time() - $this -> start_time, 3, '.', '');
		$json_result['results'] = $result;
		print_r($this -> callback. '('.json_encode($json_result) .')');
	}

}
?>
