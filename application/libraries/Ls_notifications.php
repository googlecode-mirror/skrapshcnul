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
		if (!$this -> ci -> ion_auth -> logged_in() && get_cookie('identity') && get_cookie('remember_code')) {
			$this -> ci -> ion_auth = $this;
			$this -> ci -> ion_auth_model -> login_remembered_user();
		}

		$this -> ci -> ion_auth_model -> trigger_events('library_constructor');
	}

	/**
	 * Function for components to set notifications
	 */
	function set_notification($component_id, $identity, $message, $url = '') {

		if (!$this -> ci -> ls_notifications_model -> set_notification($component_id, $identity, $message, $url)) {
			echo $this -> ci -> ls_notifications_model -> errors();
			return FALSE;
		}

	}

	function get_notifications($identity) {
		if (empty($identity)) {
			return FALSE;
		}
		$number_of_notifications = 30;

		$results = $this -> ci -> ls_notifications_model -> get_notifications($identity, $number_of_notifications);

		foreach ($results as $key => $value) {
			$results[$key]['component_class'] = $this -> component_class[$value['component_id']];
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

}
?>