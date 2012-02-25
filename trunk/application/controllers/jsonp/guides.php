<?php

/**
 * System Administrative Page
 */
class Guides extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> library('ion_auth');
		$this -> load -> library('input');
		$this -> load -> library('ls_guides');
		$this -> load -> library('json');
		$this -> load -> database();
		$this -> load -> helper('url');
		$this -> load -> helper('json');
		$this -> load -> helper('logger');

		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> user_id = $this -> session -> userdata('user_id');

		// Request Params: 
		$this -> request_method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : '';
		
		// Authentication
		$this -> json -> is_autheticated();
	}

	public function _remap($method) {
		if ($method == 'steps_completed') {
			$this -> $method();
		} else {
			$this -> index();
		}
	}

	function index() {
		
		$userid = ($this -> uri -> segment(3));
		if (!$userid || !is_numeric($userid)) {
			$error['domain'] = "global";
			$error['reason'] = "invalidParameter";
			$error['message'] = "Invalid value 'userId'. Values must match the following regular expression: 'me|[0-9]+'";
			$error['locationType'] = "parameter";
			$error['location'] = "userId";
			$this -> data['errors'] = $error;
			return $this -> json -> json_prep($this -> data);
		}
		
		$this -> json -> json_prep($this -> data);

	}
	
	function steps_completed() {
		
		if (!isset($this -> user_id)) {return FALSE;}
		
		$this -> data['results'] = $this -> ls_guides -> getWelcomeGuide_States($this -> user_id);
		
		$this -> json -> json_prep($this -> data);
	}

}
