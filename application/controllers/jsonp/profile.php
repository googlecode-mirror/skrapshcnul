<?php

/**
 * System Administrative Page
 */
class Profile extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('form_validation');
		$this -> load -> library('input');
		$this -> load -> library('ion_auth');
		$this -> load -> library('json');
		$this -> load -> library('ls_notifications');
		$this -> load -> library('ls_profile');
		$this -> load -> library('session');
		$this -> load -> database();
		$this -> load -> helper('url');
		$this -> load -> model('invitation_model');
		$this -> load -> model('page_steps_completed_model');
		$this -> load -> model('preferences_model');
		$this -> load -> model('schedules_model');
		$this -> load -> model('user_lunch_wishlist_model');
		$this -> load -> helper('logger');
		
		// Request Params: alt = json | , 
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> call = (isset($_REQUEST['call'])) ? $_REQUEST['call'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';
		$this -> request_method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : '';
		
		// Authentication
		$this -> json -> is_autheticated();
	}

	function index () {
		echo "Welcome to Lunchsparks JSON.";
	}
	
	function is_alias_available() {
		
		if ($this -> input -> get()) {
			$input = $this -> input -> get();
			
			$this -> data['results'] = $this -> ls_profile -> is_alias_available($input);
			
		}
		
		$this -> json -> json_prep($this -> data);
	}
	
}