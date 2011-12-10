<?php

/**
 * System Administrative Page
 */
class Profile extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> library('ls_notifications');
		$this -> load -> library('ion_auth');
		$this -> load -> library('input');
		$this -> load -> database();
		$this -> load -> helper('url');
		$this -> load -> model('invitation_model');
		$this -> load -> model('page_steps_completed_model');
		$this -> load -> model('preferences_model');
		$this -> load -> model('schedules_model');
		$this -> load -> model('user_lunch_wishlist_model');
		$this -> load -> helper('logger');
		
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		
		$this->user_id = $this -> session -> userdata('user_id');
		
		// Request Params: alt = json | , 
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> call = (isset($_REQUEST['call'])) ? $_REQUEST['call'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';
		$this -> request_method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : '';
		
		$this -> start_time = time();
		
	}

	function index () {
		echo "Welcome to Lunchsparks JSON.";
	}
	
	function _json_prep($results) {
		//header('Cache-Control: no-cache, must-revalidate');
		//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		//header('Content-type: application/json');
		
		if ($this -> callback) {
			$this -> json_result['completed_in'] =  number_format(time() - $this -> start_time, 3, '.', '');
			$this -> json_result['results'][] = $results;
			print_r($this -> callback. '('.json_encode($this -> json_result) .')');
		} else {
			if (empty($this -> json_result['results'])) {
				$this -> json_result['results'] = FALSE;
			}
			print_r(json_encode($this -> json_result));
		}
		
	}
	
}