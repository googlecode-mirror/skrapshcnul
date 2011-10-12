<?php

class Preferences_Model extends CI_Model {

	function insertForCurrentUser($preferences) {
		$user_id = $this -> session -> userdata('user_id');
		$query = 
			" INSERT INTO lss_users_preferences (user_id, preferences, created_on, updated_on, is_deleted) " . 
			" VALUES ('$user_id', '$preferences', NOW(), NOW(), 0);";
		$result = $this -> db -> query($query);
		return $result;
	}

	function selectForCurrentUser() {
		$user_id = $this -> session -> userdata('user_id');
		$query = 
			" SELECT id, user_id, preferences, created_on, updated_on " . 
			" FROM lss_users_preferences " . 
			" WHERE user_id = '$user_id' " .
			" AND is_deleted = 0;";
		$result = $this -> db -> query($query);
		return $result;
	}

	function updateForCurrentUser($preferences) {
		$user_id = $this -> session -> userdata('user_id');
		$query = 
			" UPDATE lss_users_preferences " . 
			" SET " .
			" preferences = '" . $preferences . "', ".
			" updated_on = NOW() " .
			" WHERE user_id = " . $user_id .
			" AND is_deleted = 0 ;";
		$result = $this -> db -> query($query);
		return $result;
	}

	function deleteForCurrentUser() {
		$user_id = $this -> session -> userdata('user_id');
		$query = 
			" UPDATE lss_users_preferences " . 
			" SET " .
			" is_deleted = 1, " . 
			" updated_on = NOW() " .
			" WHERE user_id = " . $user_id ;
		$result = $this -> db -> query($query);
		return $result;
	}
	
}
?>
