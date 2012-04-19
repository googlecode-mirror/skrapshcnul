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
class Ls_User_Settings {

	function __construct() {

		$this -> ci = &get_instance();
		$this -> ci -> load -> database();
		$this -> ci -> load -> library('session');
		$this -> ci -> load -> model('user_settings_model');
		
		$this -> user_id = $this -> ci -> session -> userdata('user_id');
		
	}

	function select_notifications($fields = FALSE, $options = FALSE) {

		if (!$fields)
			return FALSE;

		if (!isset($fields['user_id']) || !is_numeric($fields['user_id'])) {
			return FALSE;
		}

		$results['email'] = $this -> ci -> user_settings_model -> select_notifications_emails($fields['user_id']);
		$results['phone'] = $this -> ci -> user_settings_model -> select_notifications_phone($fields['user_id']);

		return $results;

	}

	function update_notifications($fields = FALSE, $options = FALSE) {
		
		if (!isset($fields)) return FALSE;
		
		if (isset($fields['email'])) {
			$data = array();
			$data = $fields['email'];
			$data['user_id'] = $this -> user_id;
			$results = $this -> ci -> user_settings_model -> update_notifications_email($data, $options);
		}
		
		if (isset($fields['phone'])) {
			$data = array();
			$data = $fields['phone'];
			$data['user_id'] = $this -> user_id;
			$results = $this -> ci -> user_settings_model -> update_notifications_phone($data, $options);
		}
		
		return $results;
		
	}

}
?>