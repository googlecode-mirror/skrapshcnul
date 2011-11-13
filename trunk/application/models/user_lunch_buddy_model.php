<?php

/*
 * Messages is a underneat system for suggestion, chat
 */
class User_Lunch_Buddy_Model extends CI_Model {

	const _TABLE_ = "lss_users_lunch_buddy";

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

	function update($user_id, $target_user_id) {
		if(!$user_id || !$target_user_id) {
			return FALSE;
		} 
		
		$query = "INSERT INTO " . self::_TABLE_ . 
			" (user_id, target_user_id, created_on) " . 
			" VALUES ($user_id, $target_user_id, NOW()) " .
			" ON DUPLICATE KEY UPDATE updated_on = NOW();";
		return $this -> db -> query($query);
	}

}
?>
