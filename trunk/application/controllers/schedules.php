<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Schedules extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this -> load -> database();
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('input');
		$this -> load -> model('schedules_model');
		$this -> load -> helper('logger');

		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		
		// Request Params: alt = json | , 
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';
		
		$this -> start_time = time();
		
	}

	function index() {
		// Check if user is logged in
		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		} else {
			$this -> data['timepicker'] = true;
			// load timepicker js
			$this -> data['googlemap'] = true;
			// load google map js
			
			
			$this -> data['fixed_schedules']['results'] = $this -> schedules_model -> selectPickForCurrentUser() -> result();

			$this -> data['main_content'] = 'schedules/index';
			$this -> data['tpl_page_id'] = 'index';
			$this -> load -> view('includes/tmpl_layout', $this -> data);
		}
	}

	function add() {
		// Check if user is logged in
		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		} else {
			
			if ($this->input->post()) {
				$this -> insert();
			}
			
			$this -> data['timepicker'] = true;
			// load timepicker js
			$this -> data['googlemap'] = true;
			// load google map js

			$this -> data['main_content'] = 'schedules/add';
			$this -> data['tpl_page_id'] = 'add';
			$this -> load -> view('includes/tmpl_layout', $this -> data);
		}
	}
	
	function edit() {
		// Check if the schedule id is present
		$array = $this->uri->uri_to_assoc(3);
		if(isset($array['id']) && !empty($array['id'])) {
			$schedule_id = $array['id'];
		} else {
			redirect('/404/', 'refresh');
		}
		
		// Check if user is logged in
		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		} else {
			$this -> data['timepicker'] = true;
			// load timepicker js
			$this -> data['googlemap'] = true;
			// load google map js

			$this -> data['tpl_page_id'] = 'add';
			$this -> data['main_content'] = 'schedules/edit';
			$this -> load -> view('includes/tmpl_layout', $this -> data);
		}
	}

	function insert() {
		$result = $this -> schedules_model -> insertPickForCurrentUser(
			$this -> input -> post("name"), 
			$this -> input -> post("start_date"), 
			$this -> input -> post("start_time"), 
			$this -> input -> post("start_date"), 
			$this -> input -> post("end_time"), 
			$this -> input -> post("center_lat"), 
			$this -> input -> post("center_lng"), 
			$this -> input -> post("radius"));
		redirect('schedules', 'refresh');
	}

	function select() {
				
		$result = $this -> schedules_model -> selectPickForCurrentUser();
		
		if ($this -> alt == 'json') {
			$this -> _json_prep($result -> result());
		} else {
			print_r(json_encode($result -> result()));
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
			$this -> schedules_model -> deletePickForCurrentUser($schedule_id);
			$this -> select();
		} else {
			
		}
		
		$result = $this -> schedules_model -> deletePickForCurrentUser($schedule_id);
		//redirect('schedules', 'refresh');
		
		/*if ($result) {
			$data['result'] = "Successfully deleted";
		} else {
			$data['result'] = "Delete failed";
		}
		$this -> data['tpl_page_id'] = 'delete';
		$this -> data['main_content'] = 'schedules/delete';
		$this -> load -> view('includes/tmpl_layout', $this -> data);*/
	}
	
	function _json_prep($result) {
		$json_result['completed_in'] =  number_format(time() - $this -> start_time, 3, '.', '');
		$json_result['results'] = $result;
		print_r($this -> callback. '('.json_encode($json_result) .')');
	}

}
?>
