<?php

/*
 * Messages is a underneat system for suggestion, chat
 */
class User_Lunch_Wishlist_Model extends CI_Model {

	const _TABLE_ = "lss_users_lunch_wishlist";

	function clear() {// clear all data in lss_messages table
		$query = "TRUNCATE TABLE " . self::_TABLE_ . ";";
		return $this -> db -> query($query);
	}

	function select_list($user_id) {
		if(!$user_id) {
			return FALSE;
		} else {
			$query = "SELECT * " .
				" FROM " . self::_TABLE_ . " AS ulw " . 
				" LEFT JOIN `lss_users_profile` AS up ON up.`user_id` = ulw.`target_user_id` " .
				" WHERE ulw.`user_id` = $user_id ;";
			$mysql_result = $this -> db -> query($query);
			if ($mysql_result->num_rows() > 0) {
				return $mysql_result->result();
			} else {
				return FALSE;
			}
		}
	}
	
	function select_addToLunchStatus($user_id, $target_user_id = FALSE) {
		if(!$user_id || !$target_user_id || !is_numeric($user_id) || !is_numeric($target_user_id)) {
			return FALSE;
		} else {
			$query = "SELECT `is_added` FROM " . self::_TABLE_ . " WHERE `user_id` = $user_id AND `target_user_id` = $target_user_id;";
			$mysql_result = $this -> db -> query($query);
			return $mysql_result->result_array();
		}
	}

	function toggle_addToLunchStatus($user_id, $target_user_id) {
		if(!$user_id || !$target_user_id || !is_numeric($user_id) || !is_numeric($target_user_id)) {
			return FALSE;
		} else {
			$query = "INSERT INTO " . self::_TABLE_ . 
				" (user_id, target_user_id, updated_on) " . 
				" VALUES ($user_id, $target_user_id, NOW()) " .
				" ON DUPLICATE KEY UPDATE is_added = NOT is_added, updated_on=NOW();";
			$this -> db -> query($query);
			
			return $this -> select_addToLunchStatus($user_id, $target_user_id);
		}
	}

}
?>
