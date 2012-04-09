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
	
	public function select_projects() {
		
		$requests = ($this -> input -> get());
		
		if (isset($requests['user_id'])) {
			$fields['user_id'] = $requests['user_id'];
		}
		
		if (isset($requests['page'])) {
			$options['page'] = $requests['page'];
		}
		
		var_dump($options);
		var_dump($fields);
		
		$this -> data['projects'] = $this -> ls_projects -> select_all_projects($fields, $options);
		
	}

	public function add() {
		
		$fields = ($this -> input -> get());
		
		$uri_segment = $this->uri->segment(4);
		if (isset($uri_segment)) {
			switch($uri_segment) {
				case 'members' :
					$this -> data['results'] = $this -> ls_projects -> insert_project_team_member($fields);
				default :
					break;
			} 
		} else {
			if ($fields) {
				//$place_id = $this -> ls_places -> updatePlace();
				if ($place_id) {
					//$this -> data['results']['place_id'] = $place_id;
				};
			}
		}
		
		$this -> json -> json_prep($this -> data);
	}
	
	public function remove() {
		
		$fields = ($this -> input -> get());
		
		$uri_segment = $this->uri->segment(4);
		if (isset($uri_segment)) {
			switch($uri_segment) {
				case 'members' :
					$this -> data['results'] = $this -> ls_projects -> remove_project_team_member($fields);
				default :
					break;
			} 
		}
		
		$this -> json -> json_prep($this -> data);
		
	}
	
	public function update_tags() {
		
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

	public function update() {
		// Prepare _REQUEST data
		
		$input = ($this -> input -> get());
		
		if (!isset($input['project_id'])) {
			$this -> data['results'] = $this -> ls_projects -> insert_project($input);
		} else {
			$this -> data['results'] = $this -> ls_projects -> update_project($input);
		}
		
		$this -> json -> json_prep($this -> data);
		
	}

}
