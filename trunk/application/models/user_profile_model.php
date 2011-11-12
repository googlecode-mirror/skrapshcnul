<?php

/**
 * User Name
 */
class User_Profile_model extends CI_Model {

	const _TABLE_ = "lss_users_profile";

	function select($user_id) {

		if (!$user_id) {
			return FALSE;
		}
		
		$query = " SELECT * FROM " . self::_TABLE_ . " WHERE `user_id` = '$user_id' ;";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> row_array();
		} else {
			return FALSE;
		}
	}

	function update($user_id, $fields) {

		if (!$user_id) {
			return FALSE;
		}
		
		// Get existing records
		$data = $this -> select($user_id);
		
		// Check for unique alias
		if (isset($fields['alias']) && !$this -> is_alias_available($fields['alias'])) {
			return FALSE;
		}
		
		// Prepare Data to Write to DB
		$alias = isset($fields['alias']) ? $fields['alias'] : $data['alias'];
		$firstname = isset($fields['firstname']) ? $fields['firstname'] : $data['firstname'];
		$lastname = isset($fields['lastname']) ? $fields['lastname'] : $data['lastname'];
		$mobile_number = isset($fields['mobile_number']) ? $fields['mobile_number'] : $data['mobile_number'];
		$delivery_email = isset($fields['delivery_email']) ? $fields['delivery_email'] : $data['delivery_email'];
		
		// DB Query
		$query = "INSERT INTO " . self::_TABLE_ . 
			" (user_id, alias, firstname, lastname, mobile_number, delivery_email, updated_on) " . 
			" VALUES ('$user_id', '$alias', '$firstname', '$lastname', '$mobile_number', '$delivery_email', NOW()) " . 
			" ON DUPLICATE KEY UPDATE " .
				" `alias` = '$alias', ".
				" `firstname` = '$firstname', " .
				" `lastname` = '$lastname', " .
				" `mobile_number` = '$mobile_number', " .
				" `delivery_email` = '$delivery_email', " .
				" `updated_on` = NOW();";
		return $this -> db -> query($query);

	}

	function select_user_id_by_alias($alias) {
		
		if(!$alias) {
			return FALSE;
		} else {
			$query = " SELECT user_id FROM `lss_users_profile` WHERE `alias` = '$alias' ;";
			$mysql_result = $this -> db -> query($query);
			if ($mysql_result->num_rows() > 0) {
				return $mysql_result->row()->user_id;
			} else {
				return FALSE;
			}
		}
	}

	function is_alias_available($alias) {
		if (!$alias) {
			return FALSE;
		}
		
		$query = " SELECT * FROM " . self::_TABLE_ . " WHERE `alias` = '$alias' ";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

}
?>