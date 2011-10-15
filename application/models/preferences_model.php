<?php

class Preferences_Model extends CI_Model {

	function insertForCurrentUser($preferences_ref_id, $tag_value) {
		$user_id = $this -> session -> userdata('user_id');
		$tag_value = trim($tag_value);
		
		$data_arr = $this -> selectForCurrentUser_byPreferencesRefId($preferences_ref_id);
		//$data = !empty($result[0]->data) ? $result[0]->data : '';
		
		if(empty($data_arr)) {
			$query = 
				" INSERT INTO lss_users_preferences (user_id, preferences_ref_id, data, created_on, updated_on, is_deleted) " . 
				" VALUES ('$user_id', '$preferences_ref_id', '$tag_value', NOW(), NOW(), 0);";
			$mysql_result = $this -> db -> query($query);
		} else {
			if (!in_array($tag_value, $data_arr)) {
				array_push($data_arr, $tag_value);
				$data = implode(',', $data_arr);
				$query = 
					" UPDATE lss_users_preferences " .
					" SET data = '$data', updated_on = NOW() " . 
					" WHERE user_id = $user_id " .
					" AND preferences_ref_id = $preferences_ref_id ;";
				$mysql_result = $this -> db -> query($query);
			}
		}
		
		return $this -> selectForCurrentUser_byPreferencesRefId($preferences_ref_id);
	}

	function selectForCurrentUser() {
		$user_id = $this -> session -> userdata('user_id');
		$query = 
			" SELECT id, user_id, lup.preferences_ref_id, preferences_name, description, data, lup.created_on, lup.updated_on " . 
			" FROM lss_users_preferences AS lup" . 
			" LEFT JOIN lss_users_preferences_ref AS lupr ON lup.preferences_ref_id = lupr.preferences_ref_id " . 
			" WHERE user_id = '$user_id' " .
			" AND is_deleted = 0;";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result->num_rows() > 0)
		{
			foreach ($mysql_result->result_array() as $row)
			{
			    $row['data'] = explode(',', $row['data']);
			    $result[$row['preferences_ref_id']] = $row;
			}
		   
		}
		return $result;
	}
	
	function selectForCurrentUser_byPreferencesRefId($preferences_ref_id) {
		$user_id = $this -> session -> userdata('user_id');
		$query = 
			" SELECT id, user_id, lup.preferences_ref_id, preferences_name, description, data, lup.created_on, lup.updated_on " . 
			" FROM lss_users_preferences AS lup" . 
			" LEFT JOIN lss_users_preferences_ref AS lupr ON lup.preferences_ref_id = lupr.preferences_ref_id " . 
			" WHERE user_id = '$user_id' " .
			" AND lup.preferences_ref_id= '$preferences_ref_id'" .
			" AND is_deleted = 0;";
		$result = $this -> db -> query($query);
		if ($result->num_rows() > 0)
		{
			$result = $result->result();
			$result = explode(',', $result[0]->data);
			return $result;
		}
	}

	function updateForCurrentUser($preferences_ref_id, $data_item_value) {
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
