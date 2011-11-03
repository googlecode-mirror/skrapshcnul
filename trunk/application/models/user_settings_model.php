<?php

/**
 * User Name
 */
class User_Settings_model extends CI_Model {

	const _TABLE_SECU_ = "lss_users_settings_security";
	const _TABLE_NOTI_ = "lss_users_settings_notification";
	const _TABLE_NOTI_PHONE_ = "lss_users_settings_notification_phone";
	const _TABLE_NOTI_EMAIL_ = "lss_users_settings_notification_email";

	function select_security($user_id) {

		if (!$user_id) {
			return FALSE;
		}
		
		$query = " SELECT * FROM " . self::_TABLE_SECU_ . " WHERE `user_id` = '$user_id' ;";
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
		$query = "INSERT INTO " . self::_TABLE_SECU_ . 
			" (user_id, secure_browsing, updated_on) " . 
			" VALUES ('$user_id', '$secure_browsing', NOW()) " . 
			" ON DUPLICATE KEY UPDATE " .
				" `secure_browsing` = '$secure_browsing', ".
				" `updated_on` = NOW();";
		return $this -> db -> query($query);
	}

	function select_notification($user_id) {

		if (!$user_id) {
			return FALSE;
		}
		
		$query = " SELECT * FROM " . self::_TABLE_NOTI_ . " WHERE `user_id` = '$user_id' ;";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> row_array();
		} else {
			return FALSE;
		}
	}

	function update_notification($user_id, $fields) {

		if (!$user_id) {
			return FALSE;
		}
		
		// Get existing records
		$data = $this -> select_notification($user_id);
		
		// Prepare Data to Write to DB
		$chrome_desktop_notification = isset($fields['chrome_desktop_notification']) ? $fields['chrome_desktop_notification'] : $data['chrome_desktop_notification'];
		
		// DB Query
		$query = "INSERT INTO " . self::_TABLE_NOTI_ . 
			" (user_id, chrome_desktop_notification, updated_on) " . 
			" VALUES ('$user_id', '$chrome_desktop_notification', NOW()) " . 
			" ON DUPLICATE KEY UPDATE " .
				" `chrome_desktop_notification` = '$chrome_desktop_notification', ".
				" `updated_on` = NOW();";
		return $this -> db -> query($query);
	}
}
?>