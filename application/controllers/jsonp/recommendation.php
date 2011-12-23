<?php

/**
 * System Administrative Page
 */
class Recommendation extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> library('ls_profile');
		$this -> load -> library('ion_auth');
		$this -> load -> library('input');
		$this -> load -> library('json');
		$this -> load -> database();
		$this -> load -> helper('url');
		$this -> load -> helper('json');
		$this -> load -> helper('logger');
		$this -> load -> model('events_model');
		
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> user_id = $this -> session -> userdata('user_id');
		
		// Request Params: 
		$this -> request_method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : '';
		
		// Authentication
		$this -> json -> is_autheticated();
	}

	public function _remap($method) {
		switch ($method) {
			case 'ongoing' : 
			case 'past' :
				$this -> $method();
				break;
			default :
				$this -> index();
				break;
		}
	}

	function index() {
		$userid = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : FALSE;
		if (!$userid || !is_numeric($userid)) {
			$error['domain'] = "global";
			$error['reason'] = "invalidParameter";
			$error['message'] = "Invalid value 'userId'. Values must match the following regular expression: 'me|[0-9]+'";
			$error['locationType'] = "parameter";
			$error['location'] = "userId";
			$this -> data['errors'] = $error;
			return $this -> json -> json_prep($this -> data['errors']);
		}
		
		## TODO - Map to functions
		$asso_array = ($this -> uri -> uri_to_assoc(4));
		
		$this -> results = $this -> ls_profile -> getPublicProfile($userid);
		
		$this -> json -> json_prep($this -> results);

	}
	
	function ongoing () {
		
		$this -> data['results'] = $this -> events_model -> getUserEventSuggestion_all_by_page();
		
		$this -> json -> json_prep($this -> data);
		
	}
	
	function create() {
		// Prepare _REQUEST data
		
	}

}
