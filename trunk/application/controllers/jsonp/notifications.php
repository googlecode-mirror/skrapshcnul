<?php

/**
 * System Administrative Page
 */
class Notifications extends CI_Controller {

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

		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> user_id = $this -> session -> userdata('user_id');

		// Request Params: 
		$this -> request_method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : '';
		
		// Authentication
		$this -> json -> is_autheticated();
	}

	public function _remap($method) {
		if ($method == 'some_method_to_bypass') {
			$this -> $method();
		} else {
			$this -> index();
		}
	}

	function index() {
		
		$this -> json -> json_prep($this -> data);

	}

}
