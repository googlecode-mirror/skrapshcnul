<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Name:  Notification
 * Author: @stiucsib86
 * Created:  11.09.2011
 * Description:
 * Requirements: PHP5 or above
 */
class Ls_notifications {

	function __construct() {

		$this -> ci = &get_instance();
		$this -> ci -> load -> config('ion_auth', TRUE);
		$this -> ci -> load -> config('ls_notifications', TRUE);
		$this -> ci -> load -> library('email');
		$this -> ci -> load -> library('session');
		$this -> ci -> load -> library('tweet');
		$this -> ci -> lang -> load('ion_auth');
		$this -> ci -> load -> model('ion_auth_model');
		$this -> ci -> load -> model('ls_notifications_model');
		$this -> ci -> load -> helper('cookie');
		// Set Config
		$this -> component_class = $this -> ci -> config -> item('component_class', 'ls_notifications');
		//auto-login the user if they are remembered
		/*if (!$this -> ci -> ion_auth -> logged_in() && get_cookie('identity') && get_cookie('remember_code')) {
			$this -> ci -> ion_auth = $this;
			$this -> ci -> ion_auth_model -> login_remembered_user();
		}*/

		$this -> ci -> ion_auth_model -> trigger_events('library_constructor');

		// Initialize Library
		$this -> _initialize();
	}

	private function _initialize() {
		$fields['keywords'] = 'Notification';
		$this -> component_info = $this -> ci -> ls_notifications_model -> get_component_info($fields);
	}

	/**
	 * Function for components to set notifications
	 */
	function set_notification($fields = FALSE) {
		if (!$fields) {
			return FALSE;
		}

		if (!(isset($fields['component_id']) && is_numeric($fields['component_id']))) {
			return FALSE;
		}
		if (!(isset($fields['user_id']) && is_numeric($fields['user_id']))) {
			return FALSE;
		}
		if (!(isset($fields['message']))) {
			return FALSE;
		}
		if (!(isset($fields['url']))) {
			return FALSE;
		}
		
		$component_id = $fields['component_id'];
		$user_id = $fields['user_id'];
		$message = $fields['message'];
		$url = $fields['url'];

		if (!$this -> ci -> ls_notifications_model -> set_notification($component_id, $user_id, $message, $url)) {
			echo $this -> ci -> ls_notifications_model -> errors();
			return FALSE;
		}
		
		return TRUE;

	}

	function get_notifications($identity) {
		if (empty($identity)) {
			return FALSE;
		}
		$number_of_notifications = 30;

		$results = $this -> ci -> ls_notifications_model -> get_notifications($identity, $number_of_notifications);

		if (isset($results) && is_array($results)) {
			foreach ($results as $key => $value) {
				$fields['component_id'] = $value['component_id'];
				$results[$key]['component_class'] = $this -> ci -> ls_notifications_model -> get_component_info_by_id($fields);
			}
		}

		if ($results) {
			return $results;
		} else {
			return FALSE;
		}
	}

	function check_notifications_new($identity) {
		if (empty($identity)) {
			return FALSE;
		}

		$results = $this -> ci -> ls_notifications_model -> check_notifications_new($identity);

		if ($results) {
			return $results;
		} else {
			return FALSE;
		}
	}

	function get_notifications_new($identity) {
		if (empty($identity)) {
			return FALSE;
		}

		$results = $this -> ci -> ls_notifications_model -> get_notifications_new($identity);

		if ($results) {
			return $results;
		} else {
			return FALSE;
		}
	}

	function get_component_info($fields = FALSE) {

		if (!$fields) {
			return FALSE;
		}
		
		if (isset($fields['keywords']) && !empty($fields['keywords'])) {
			$keywords = isset($fields['keywords']) ? $fields['keywords'] : FALSE;
			return $this -> ci -> ls_notifications_model -> get_component_info($keywords);			
		}
		
		if (isset($fields['component_id']) && !empty($fields['component_id'])) {
			$component_id = isset($fields['component_id']) ? $fields['component_id'] : FALSE;
			return $this -> ci -> ls_notifications_model -> get_component_info_by_id($component_id);			
		} 
		

	}

	function set_notifications_new_as_read($identity = '', $notification_id = '') {
		if (empty($identity)) {
			return FALSE;
		} elseif (empty($notification_id)) {
			return FALSE;
		}

		$results = $this -> ci -> ls_notifications_model -> set_notifications_new_as_read($identity, $notification_id);

		if ($results) {
			return $results;
		} else {
			return FALSE;
		}
	}
	
	function header_states() {
		
		/*
		## TODO for @Tien / @kusum
		$result['events']['count'] = [num];
		$result['events'][hasNotification] = true/false;
		*/
		
		
	}
	
	
	function send_email_notifications()
	{
		return "ok";
	}
	
}
?>