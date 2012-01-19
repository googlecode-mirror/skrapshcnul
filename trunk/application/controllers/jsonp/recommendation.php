<?php

/**
 * System Administrative Page
 */
class Recommendation extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> library('input');
		$this -> load -> library('ion_auth');
		$this -> load -> library('json');
		$this -> load -> library('form_validation');
		$this -> load -> library('ls_notifications');
		$this -> load -> library('ls_profile');
		$this -> load -> library('ls_events');
		$this -> load -> library('ls_user_recommendation');
		$this -> load -> library('session');
		$this -> load -> helper('json');
		$this -> load -> helper('logger');
		$this -> load -> helper('url');
		$this -> load -> model('events_model');
		$this -> load -> model('user_recommendation_model');

		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> user_id = $this -> session -> userdata('user_id');

		// Request Params:
		$this -> request_method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : '';

		// Authentication
		$this -> json -> is_autheticated();
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

	public function add() {
		// Prepare _REQUEST data
		$fields['user_id'] = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : FALSE;
		$fields['target_user_id'] = isset($_REQUEST['target_user_id']) ? $_REQUEST['target_user_id'] : FALSE;
		$fields['reason'] = isset($_REQUEST['reason']) ? $_REQUEST['reason'] : FALSE;

		$this -> data['results'] = $this -> ls_user_recommendation -> create($fields);

		$this -> json -> json_prep($this -> data);

	}

	public function delete() {
		// Prepare _REQUEST data
		$fields['user_id'] = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : FALSE;
		$fields['target_user_id'] = isset($_REQUEST['target_user_id']) ? $_REQUEST['target_user_id'] : FALSE;

		//$this -> data['results'] = $this -> ls_user_recommendation -> delete($fields);

		## TODO

	}

	public function confirm() {
		// Prepare _REQUEST data
		$fields['user_id'] = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : FALSE;
		$fields['target_user_id'] = isset($_REQUEST['target_user_id']) ? $_REQUEST['target_user_id'] : FALSE;
		$fields['recommendation_id'] = isset($_REQUEST['recommendation_id']) ? $_REQUEST['recommendation_id'] : FALSE;

		$this -> data['results'] = $this -> ls_user_recommendation -> confirm($fields);
		
		$this -> json -> json_prep($this -> data);
		
	}

	public function reject() {
		// Prepare _REQUEST data
		$fields['user_id'] = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : FALSE;
		$fields['target_user_id'] = isset($_REQUEST['target_user_id']) ? $_REQUEST['target_user_id'] : FALSE;
		$fields['recommendation_id'] = isset($_REQUEST['recommendation_id']) ? $_REQUEST['recommendation_id'] : FALSE;

		$this -> data['results'] = $this -> ls_user_recommendation -> reject($fields);
		
		$this -> json -> json_prep($this -> data);

	}

}
