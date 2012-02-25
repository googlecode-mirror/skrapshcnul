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
		$this -> load -> library('ls_notifications');
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
	
	function index() {
		
		$this -> json -> json_prep($this -> data);

	}

	function set_notifications_as_read($type = 'json') {
		
		$notification_id = ($this -> input -> get('notification_id'));
		
		if (!isset($notification_id) || !is_numeric($notification_id)) {
			$this -> json -> json_prep($this -> data);
			return FALSE;
		}

		$this -> data['results'] = (bool)$this -> ls_notifications -> set_notifications_new_as_read($this -> session -> userdata['id'], $notification_id);
		
		$this -> json -> json_prep($this -> data);
	}

}
