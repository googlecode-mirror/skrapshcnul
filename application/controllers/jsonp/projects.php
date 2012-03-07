<?php

/**
 * System Administrative Page
 */
class Projects extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> library('input');
		$this -> load -> library('ion_auth');
		$this -> load -> library('json');
		$this -> load -> library('ls_projects');
		$this -> load -> library('session');
		$this -> load -> helper('json_helper');
		$this -> load -> helper('logger');
		$this -> load -> helper('url');

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
		
		$fields = ($this -> input -> get());
		
		if ($fields) {
			$place_id = $this -> ls_places -> updatePlace();
			if ($place_id) {
				$this -> data['results']['place_id'] = $place_id;
			};
		}
		
		$this -> json -> json_prep($this -> data);
	}

	public function delete() {
		// Prepare _REQUEST data
		$fields['user_id'] = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : FALSE;
		$fields['target_user_id'] = isset($_REQUEST['target_user_id']) ? $_REQUEST['target_user_id'] : FALSE;

		//$this -> data['results'] = $this -> ls_user_recommendation -> delete($fields);

		## TODO
		
	}
	
	public function update_all_tags() {
		
		$input = json_decode(stripcslashes($_REQUEST['value']), TRUE);
		
		try {
			foreach($input as $key => $row) {
				$obj['project_id'] = $row['project_id'];
				$obj['tags_type_id'] = $row['tags_type_id'];
				$obj['tags_data'] = json_encode($row['tags_data']);
				$this -> data['results'] = $this -> ls_projects -> update_project($obj);
			}
		} catch (Exception $e) {
			// TODO Log error
		}
		
		$this -> json -> json_prep($this -> data);
		
	}

	public function update_field() {
		// Prepare _REQUEST data
		
		if (isset($_REQUEST['datafld']) && isset($_REQUEST['value']) && isset($_REQUEST['oid'])) {
			
			$fields = array();
			$fields['project_id'] = isset($_REQUEST['oid']) ? $_REQUEST['oid'] : FALSE;
			$fields[$_REQUEST['datafld']] = $_REQUEST['value'];
			
			if (isset($this -> user_id)) $fields['updated_by'] = $this -> user_id;
			
			$this -> data['results'] = $this -> ls_projects -> update_project($fields);
		} else {
			$result = FALSE;
		}
		
		$this -> json -> json_prep($this -> data);
		
	}

}