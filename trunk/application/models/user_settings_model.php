<?php

/**
 * User Name
 */
class User_Settings_model extends CI_Model {

	const _TABLE_SECU_ = "lss_users_settings_security";
	const _TABLE_NOTI_ = "lss_users_settings_notification";
	const _TABLE_NOTI_PHONE_ = "lss_users_settings_notification_phone";
	const _TABLE_NOTI_EMAIL_ = "lss_users_settings_notification_email";

	function __construct() {
		$this -> load -> config('tables/settings', TRUE);
		$this -> load -> library('session');

		## Initialize DB
		$this -> tables = $this -> config -> item('tables', 'tables/settings');

		$this -> user_id = $this -> session -> userdata('user_id');
	}

	function select_security($user_id) {

		if (!$user_id) {
			return FALSE;
		}

		$query = " SELECT * FROM " . $this -> tables['lss_users_settings_security'] . " WHERE `user_id` = '$user_id' ;";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> row_array();
		} else {
			return FALSE;
		}
	}

	function update_security($user_id, $fields) {

		if (!$user_id) {
			return FALSE;
		}

		// Get existing records
		$data = $this -> select_security($user_id);

		// Prepare Data to Write to DB
		$secure_browsing = isset($fields['secure_browsing']) ? $fields['secure_browsing'] : $data['secure_browsing'];

		// DB Query
		$query = "INSERT INTO " . self::_TABLE_SECU_ . " (user_id, secure_browsing, updated_on) " . " VALUES ('$user_id', '$secure_browsing', NOW()) " . " ON DUPLICATE KEY UPDATE " . " `secure_browsing` = '$secure_browsing', " . " `updated_on` = NOW();";
		return $this -> db -> query($query);
	}

	function select_notifications_emails($fields = NULL, $options = NULL) {

		if (!isset($fields['user_id']) && !is_numeric($fields['user_id'])) {
			return FALSE;
		}

		$this -> db -> select('*');
		$this -> db -> from($this -> tables['lss_users_settings_notification_email'] . ' AS ne');
		$this -> db -> where('ne.user_id', $fields['user_id']);
		$mysql_result = $this -> db -> get();

		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> row_array();
		} else {
			## Initialize row
			$data = array('user_id' => $fields['user_id']);
			$this -> db -> insert($this -> tables['lss_users_settings_notification_email'], $data);

			return $this -> select_notifications_emails($fields, $options);

		}
	}

	function select_notifications_phone($fields = NULL, $options = NULL) {

		if (!isset($fields['user_id']) && !is_numeric($fields['user_id'])) {
			return FALSE;
		}

		$this -> db -> select('*');
		$this -> db -> from($this -> tables['lss_users_settings_notification_phone'] . ' AS np');
		$this -> db -> where('np.user_id', $fields['user_id']);
		$mysql_result = $this -> db -> get();

		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> row_array();
		} else {
			## Initialize row
			$data = array('user_id' => $fields['user_id']);
			$this -> db -> insert($this -> tables['lss_users_settings_notification_phone'], $data);

			return $this -> select_notifications_phone($fields, $options);

		}
	}

	function update_notifications_email($fields, $options) {

		if (!isset($fields['user_id'])) {
			return FALSE;
		}

		## Email Notifications Settings
		$data = array();
		if (isset($fields['system_notification'])) {
			$data['system_notification'] = ($fields['system_notification']);
		}
		if (isset($fields['system_notification'])) {
			$data['event_notification'] = ($fields['event_notification']);
		}
		if (isset($fields['system_notification'])) {
			$data['lunch_suggestion'] = ($fields['lunch_suggestion']);
		}
		if (isset($fields['system_notification'])) {
			$data['lunch_wishlist'] = ($fields['lunch_wishlist']);
		}
		if (isset($fields['system_notification'])) {
			$data['project_follow'] = ($fields['project_follow']);
		}
		if (isset($fields['system_notification'])) {
			$data['project_favaourite'] = ($fields['project_favaourite']);
		}

		// DB Query
		if (!$this -> select_notifications_emails($fields)) {
			## Do an INSERT
			$data['user_id'] = $fields['user_id'];
			$results = $this -> db -> insert($this -> tables['lss_users_settings_notification_email'], $data);
		} else {
			## Do an UPDATE
			$this -> db -> where('user_id', $fields['user_id']);
			$results = $this -> db -> update($this -> tables['lss_users_settings_notification_email'], $data);
		}

		return $results;
	}

	function update_notifications_phone($fields, $options) {

		if (!isset($fields['user_id'])) {
			return FALSE;
		}
		
		## Phone Notifications Settings
		$data = array();
		if (isset($fields['system_notification'])) {
			$data['system_notification'] = ($fields['system_notification']);
		}
		if (isset($fields['system_notification'])) {
			$data['event_notification'] = ($fields['event_notification']);
		}
		if (isset($fields['system_notification'])) {
			$data['lunch_suggestion'] = ($fields['lunch_suggestion']);
		}
		if (isset($fields['system_notification'])) {
			$data['lunch_wishlist'] = ($fields['lunch_wishlist']);
		}
		if (isset($fields['system_notification'])) {
			$data['project_follow'] = ($fields['project_follow']);
		}
		if (isset($fields['system_notification'])) {
			$data['project_favaourite'] = ($fields['project_favaourite']);
		}

		// DB Query
		if (!$this -> select_notifications_phone($fields)) {
			## Do an INSERT
			$data['user_id'] = $fields['user_id'];
			$results = $this -> db -> insert($this -> tables['lss_users_settings_notification_phone'], $data);
		} else {
			## Do an UPDATE
			$this -> db -> where('user_id', $fields['user_id']);
			$results = $this -> db -> update($this -> tables['lss_users_settings_notification_phone'], $data);
		}

		return $results;
	}
}
?>