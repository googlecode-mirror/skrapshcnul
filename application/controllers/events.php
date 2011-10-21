<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Events extends CI_Controller {

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
		
		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
	}

	function index() {
		$this -> data['timepicker'] = true;
		// load timepicker js
		$this -> data['googlemap'] = true;
		// load google map js
		
		$this -> data['events']['upcoming'] = array();
		$this -> data['events']['past'] = array();
		
		
		$this -> data['tpl_page_id'] = 'index';
		$this -> data['main_content'] = 'events/index';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}
	
	function suggestions() {
		$this -> data['timepicker'] = true;
		// load timepicker js
		$this -> data['googlemap'] = true;
		// load google map js
		
		$this -> data['events']['suggestions'] = array();
		
		$this -> data['tpl_page_id'] = 'suggestions';
		$this -> data['main_content'] = 'events/suggestions';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function insert() {
		$result = $this -> schedules_model -> insertPickForCurrentUser($this -> input -> post("date"), $this -> input -> post("time"), $this -> input -> post("center_lat"), $this -> input -> post("center_lng"), $this -> input -> post("radius"));
		echo $result;
	}

	function select() {
		$result = $this -> schedules_model -> selectPickForCurrentUser();
		print_r(json_encode($result -> result()));
	}

	function delete() {
		$result = $this -> schedules_model -> deletePickForCurrentUser($this -> input -> post("index"));
		echo $result;
	}

}
?>
