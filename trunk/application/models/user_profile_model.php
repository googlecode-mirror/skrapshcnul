<?php

/**
 * User Name
 */
class User_Profile_model extends CI_Model {

	const _TABLE_ = "lss_users_profile";
	const _TABLE_SOCIAL_LINKS = "lss_users_profile_social_links";
	
	function select($user_id) {

		if (!$user_id) {
			return FALSE;
		}
		
		$query = " SELECT * FROM " . self::_TABLE_ . " WHERE `user_id` = '$user_id' ;";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> row_array();
		} else {
			$query = 
				" INSERT INTO " . self::_TABLE_ . 
				" (user_id, updated_on) " . 
				" VALUES ('$user_id', NOW()) ";
			$this -> db -> query($query);
			
			return $this->select($user_id);
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
		$alias			= isset($fields['alias']) ? $fields['alias'] : $data['alias'];
		$firstname		= isset($fields['firstname']) ? $fields['firstname'] : $data['firstname'];
		$lastname		= isset($fields['lastname']) ? $fields['lastname'] : $data['lastname'];
		$mobile_number	= isset($fields['mobile_number']) ? $fields['mobile_number'] : $data['mobile_number'];
		$delivery_email	= isset($fields['delivery_email']) ? $fields['delivery_email'] : $data['delivery_email'];
		$profile_img	= isset($fields['profile_img']) ? $fields['profile_img'] : $data['profile_img'];
		
		// DB Query
		$query = "INSERT INTO " . self::_TABLE_ . 
			" (user_id, alias, firstname, lastname, mobile_number, delivery_email, profile_img, updated_on) " . 
			" VALUES ('$user_id', '$alias', '$firstname', '$lastname', '$mobile_number', '$delivery_email', '$profile_img', NOW()) " . 
			" ON DUPLICATE KEY UPDATE " .
				" `alias` = '$alias', ".
				" `firstname` = '$firstname', " .
				" `lastname` = '$lastname', " .
				" `mobile_number` = '$mobile_number', " .
				" `delivery_email` = '$delivery_email', " .
				" `profile_img` = '$profile_img', " .
				" `updated_on` = NOW();";
				
		// if Alias changed, update Social Link
		if (!empty($alias)) {
			$fields['lunchsparks'] = base_url()."pub/".$alias;
			$this -> update_social_links($user_id, $fields);
		} else {
			$fields['lunchsparks'] = base_url()."pub/".$user_id;
			$this -> update_social_links($user_id, $fields);
		}
				
		return $this -> db -> query($query);

	}

	function update_fromLinkedInData($user_id, $fields) {
		// Get existing records
		$data = $this -> select($user_id);
		
		// Prepare Data to Write to DB
		## Alias
		if (isset($data['alias']) && !empty($data['alias'])) {
			$alias = $data['alias'];
		} else {
			$alias = isset($fields['alias']) ? $fields['alias'] : "" ;
		}
		## Firstname
		if (isset($data['firstname']) && !empty($data['firstname'])) {
			 $firstname = $data['firstname'];
		} else {
			$firstname = isset($fields['firstname']) ? $fields['firstname'] : "";
		}
		## Lastname
		if (isset($data['lastname']) && !empty($data['lastname'])) { $lastname =  $data['lastname'];
		} else {
			$lastname = isset($fields['lastname']) ? $fields['lastname'] : "";
		}
		## Mobile Number
		if (isset($data['mobile_number']) && !empty($data['mobile_number'])) {
			$mobile_number = $data['mobile_number'];
		} else {
			$mobile_number = isset($fields['mobile_number']) ? $fields['mobile_number'] : "" ;
		}
		## Delivery Email
		if (isset($data['delivery_email']) && !empty($data['delivery_email'])) {
			$delivery_email	= $data['delivery_email'];
		} else {
			$delivery_email	= isset($fields['delivery_email']) ? $fields['delivery_email'] : "" ;
		}
		## Profile Image
		if (isset($data['profile_img']) && !empty($data['profile_img'])) {
			$profile_img = $data['profile_img'];
		} else {
			$profile_img = isset($fields['profile_img']) ? $fields['profile_img'] : "" ;
		}
		
		// DB Query
		$query = "INSERT INTO " . self::_TABLE_ . 
			" (user_id, firstname, lastname, mobile_number, delivery_email, profile_img, updated_on) " . 
			" VALUES ('$user_id', '$firstname', '$lastname', '$mobile_number', '$delivery_email', '$profile_img', NOW()) " . 
			" ON DUPLICATE KEY UPDATE " .
				" `firstname` = '$firstname', " .
				" `lastname` = '$lastname', " .
				" `mobile_number` = '$mobile_number', " .
				" `delivery_email` = '$delivery_email', " .
				" `profile_img` = '$profile_img', " .
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
	
	## Social Elements
	
	function select_social_links($user_id) {
		
		if (!$user_id) { return FALSE; }
		
		$query = " SELECT * FROM " . self::_TABLE_SOCIAL_LINKS . " WHERE `user_id` = '$user_id' ;";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> row_array();
		} else {
			$query = 
				" INSERT INTO " . self::_TABLE_SOCIAL_LINKS . 
				" (user_id, lunchsparks, updated_on) " . 
				" VALUES ('$user_id', '".base_url("/pub/".$user_id)."', NOW()) ";
			$this -> db -> query($query);
			
			return $this->select_social_links($user_id);
		}
	}
	
	function update_social_links($user_id, $fields) {
		
		if (!$user_id) { return FALSE; }
		
		// Get existing records
		$data = $this -> select_social_links($user_id);
		
		// Prepare Data to Write to DB
		$lunchsparks	= isset($fields['lunchsparks']) ? $fields['lunchsparks'] : $data['lunchsparks'];
		$linkedin		= isset($fields['linkedin']) ? $fields['linkedin'] : $data['linkedin'];
		$twitter		= isset($fields['twitter']) ? $fields['twitter'] : $data['twitter'];
		$facebook		= isset($fields['facebook']) ? $fields['facebook'] : $data['facebook'];
		
		// DB Query
		$query = "INSERT INTO " . self::_TABLE_SOCIAL_LINKS . 
			" (user_id, lunchsparks, linkedin, twitter, facebook, updated_on) " . 
			" VALUES ('$user_id', '$lunchsparks', '$linkedin', '$twitter', '$facebook', NOW()) " . 
			" ON DUPLICATE KEY UPDATE " .
				" `lunchsparks` = '$lunchsparks', " .
				" `linkedin` = '$linkedin', " .
				" `twitter` = '$twitter', " .
				" `facebook` = '$facebook', " .
				" `updated_on` = NOW();";
		return $this -> db -> query($query);
		
	}
	
}
?>