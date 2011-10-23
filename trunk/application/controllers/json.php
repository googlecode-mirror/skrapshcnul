<?php

/**
 * System Administrative Page
 */
class Json extends CI_Controller {

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
		$this -> load -> model('schedules_model');
		$this -> load -> model('invitation_model');
		$this -> load -> helper('logger');
		
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> session -> set_flashdata('system_message', '');
	}

	function index($value = '') {
		echo "Welcome to Lunchsparks JSON.";
	}

	function check_notifications($type = 'json') {

		$this -> data['notifications'] = $this -> ls_notifications -> get_notifications($this -> session -> userdata['id']);

		if (!$this -> data['notifications'])
			$this -> data['notifications'] = array();

		if ($type == "ajax") {

		} else {
			echo json_encode($this -> data['notifications']);
		}
	}

	function check_notifications_new($type = 'json') {

		if (!isset($this -> session -> userdata['id'])) {
			return json_encode(FALSE);
		}

		$this -> data['notifications'] = $this -> ls_notifications -> check_notifications_new($this -> session -> userdata['id']);

		if ($type == "ajax") {

		} else {
			echo json_encode($this -> data['notifications']);
		}
	}

	function set_notifications_new_as_read($type = 'json') {

		$asso_array = ($this -> uri -> uri_to_assoc(3));

		if (isset($asso_array['notification_id'])) {
			$notification_id = $asso_array['notification_id'];
		} else {
			$notification_id = $this -> input -> post('notification_id');
		}

		$string = 'notification_123';
		if (strstr($string, 'notification_')) {
			$array = str_ireplace('notification_', '', $string);
		}
		print_r($array);

		if (!isset($this -> session -> userdata['id'])) {
			echo json_encode(FALSE);
			return FALSE;
		} else if (empty($notification_id)) {
			echo json_encode(FALSE);
			echo 'no notification';
			return FALSE;
		}

		$result = (bool)$this -> ls_notifications -> set_notifications_new_as_read($this -> session -> userdata['id'], $notification_id);

		if ($type == "ajax") {

		} else {
			echo json_encode($result ? 'success' : FALSE);
		}
	}

	function getTotalUsers() {
		echo json_encode($this -> ion_auth -> getTotalUsers() + 11);
	}
	
	function schedules() {
		
		$callback = $_REQUEST['callback'];
		$call = $_REQUEST['call'];
		
	}
	

}
?>