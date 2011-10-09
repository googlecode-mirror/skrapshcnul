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
			
			
			$this -> data['fixed_schedules'] = $this -> schedules_model -> selectPickForCurrentUser() -> result();

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
		print_r(json_encode($result -> result()));
	}

	function delete() {
		// Check if the schedule id is present
		$array = $this->uri->uri_to_assoc(3);
		if(isset($array['id']) && !empty($array['id'])) {
			$schedule_id = $array['id'];
		} else {
			redirect('/404/', 'refresh');
		}
		
		$result = $this -> schedules_model -> deletePickForCurrentUser($array['id']);
		redirect('schedules', 'refresh');
		
		/*if ($result) {
			$data['result'] = "Successfully deleted";
		} else {
			$data['result'] = "Delete failed";
		}
		$this -> data['tpl_page_id'] = 'delete';
		$this -> data['main_content'] = 'schedules/delete';
		$this -> load -> view('includes/tmpl_layout', $this -> data);*/
	}

}
?>
