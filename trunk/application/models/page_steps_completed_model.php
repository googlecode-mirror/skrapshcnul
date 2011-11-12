<?php

/**
 * User Name
 */
class Page_Steps_Completed_model extends CI_Model {
	
	const _TABLE_ = "lss_page_completed_step";
	
	function select($user_id) {
		if(!$user_id) {
			return FALSE;
		}
		$query = " SELECT * FROM " . self::_TABLE_ . " WHERE `user_id` = '$user_id' ;";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> row_array();
		} else {
			$query = " INSERT INTO " . self::_TABLE_ . " (`user_id`, `updated_on`) VALUE ('$user_id', NOW())";
			$mysql_result = $this -> db -> query($query);
			return $this->select($user_id);
		}
	}
	
	function toggle_is_hidden($user_id) {
		
		if(!$user_id) {
			return FALSE;
		}
		
		$data = $this->select($user_id);
		$is_hidden = isset($data['is_hidden']) ? $data['is_hidden'] : 0;
		
		$query = 
			" INSERT INTO " . self::_TABLE_ . "(`user_id`, `is_hidden`, `updated_on`) VALUE ($user_id, $is_hidden, NOW()) " . 
			" ON DUPLICATE KEY UPDATE `is_hidden` = NOT is_hidden, `updated_on`=NOW()";
		$mysql_result = $this -> db -> query($query);
		
		return $mysql_result;
	}
	
	function toggle_is_disabled($user_id) {
		
		if(!$user_id) {
			return FALSE;
		}
		
		$data = $this->select($user_id);
		$is_disabled = isset($data['is_disabled']) ? $data['is_disabled'] : 0;
		
		$query = 
			" INSERT INTO " . self::_TABLE_ . "(`user_id`, `is_disabled`, `updated_on`) VALUE ($user_id, $is_disabled, NOW()) " . 
			" ON DUPLICATE KEY UPDATE `is_disabled` = NOT is_disabled, `updated_on`=NOW()";
		$mysql_result = $this -> db -> query($query);
		
		return $mysql_result;
	}
	
}

?>