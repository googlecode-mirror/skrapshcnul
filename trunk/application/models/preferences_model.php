<?php

class Preferences_Model extends CI_Model {
	
	public $tables = array();
	
	public function __construct() {
		
		parent::__construct();
		
		// Table names
		$this -> tables['users_preferences']	= "lss_users_preferences";
		$this -> tables['global_preferences']	= "lss_global_preferences";
		$this -> tables['users_profile']		= "lss_users_profile";
		
	}
	
	function selectForCurrentUser() {
			
		$user_id = $this -> session -> userdata('user_id');
		
		$query = 
			" SELECT user_id, lup.preferences_ref_id, preferences_name, description, data, lup.created_on, lup.updated_on " . 
			" FROM lss_users_preferences AS lup" . 
			" LEFT JOIN lss_users_preferences_ref AS lupr ON lup.preferences_ref_id = lupr.preferences_ref_id " . 
			" WHERE user_id = '$user_id' " .
			" AND is_deleted = 0 ".
			" ORDER BY lup.preferences_ref_id ASC;";
		$mysql_result = $this -> db -> query($query);
		
		$result = array();
		if ($mysql_result->num_rows() > 0)
		{
			foreach ($mysql_result->result_array() as $row)
			{
			    if(!empty($row['data'])) {
			    	$row['data'] = explode(',', $row['data']);
			    } else {
			    	$row['data'] = array();
			    }
			    $result[$row['preferences_ref_id']] = $row;
			}
			
			return $result;
		   
		} else {
			
			## Initialize user preference rows// DATA completeness check
			$query = " SELECT * FROM lss_users_preferences_ref AS lupf;";
			$mysql_result = $this -> db -> query($query);
			foreach ($mysql_result->result_array() as $row)
			{// Build empty rows
				if (!isset($result[$row['preferences_ref_id']])) {
					
					$preferences_ref_id = $row['preferences_ref_id'];
					
					// Do INSERT of empty prefereces 
					$query = 
						" INSERT INTO lss_users_preferences " .
						" (user_id, preferences_ref_id, data, created_on, updated_on, is_deleted) " . 
						" VALUES ('$user_id', '$preferences_ref_id', '', NOW(), NOW(), 0) " .
						" ON DUPLICATE KEY UPDATE updated_on=NOW();";
					$mysql_result = $this -> db -> query($query);
					$id = $this -> db -> insert_id();
					
				    $result[] = array(
				    	'id'=>$id,
				    	'user_id'=>$user_id, 
				    	'preferences_ref_id'=>$row['preferences_ref_id'],
				    	'preferences_name'=>$row['preferences_name'],
				    	'description'=>$row['description']) ;
				}
			}
			
			return $this->selectForCurrentUser();
				
		}

	}
	
	function selectForCurrentUser_data_byPreferencesRefId($preferences_ref_id) {
		$user_id = $this -> session -> userdata('user_id');
		$query = 
			" SELECT user_id, lup.preferences_ref_id, preferences_name, description, data, lup.created_on, lup.updated_on " . 
			" FROM lss_users_preferences AS lup" . 
			" LEFT JOIN lss_users_preferences_ref AS lupr ON lup.preferences_ref_id = lupr.preferences_ref_id " . 
			" WHERE user_id = '$user_id' " .
			" AND lup.preferences_ref_id= '$preferences_ref_id'" .
			" AND is_deleted = 0;";
		$result = $this -> db -> query($query);
		if ($result->num_rows() > 0)
		{
			$result = $result->result();
			$data = trim($result[0]->data);
			if(!empty($data)) {
		    	$result = explode(',', $data);
		    } else {
		    	$result = array();
		    }
			return $result;
		}
	}

	function insertForCurrentUser($preferences_ref_id, $tag_value) {
		$user_id = $this -> session -> userdata('user_id');
		$tag_value = urldecode(trim($tag_value));
		
		if (!isset($tag_value) || empty($tag_value)) {
			return FALSE;
		}
		
		$data_arr = $this -> selectForCurrentUser_data_byPreferencesRefId($preferences_ref_id);
		
		if (!in_array($tag_value, $data_arr)) {
			array_push($data_arr, $tag_value);
			$data = implode(',', $data_arr);
			$query = 
				" UPDATE lss_users_preferences " .
				" SET data = '$data', updated_on = NOW() " . 
				" WHERE user_id = $user_id " .
				" AND preferences_ref_id = $preferences_ref_id ;";
			$mysql_result = $this -> db -> query($query);
			
			if ($this->db->affected_rows() > 0 ) {
				## Update global preference statistics
				$this->_global_preferences_add($tag_value);
			}
			
		}
		
		return $this -> selectForCurrentUser_data_byPreferencesRefId($preferences_ref_id);
	}
	
	function deleteForCurrentUser($preferences_ref_id, $tag_value) {
		$user_id = $this -> session -> userdata('user_id');
		$tag_value = urldecode(trim($tag_value));
		
		if (!isset($tag_value) || empty($tag_value)) {
			return FALSE;
		}
		
		$data_arr = $this -> selectForCurrentUser_data_byPreferencesRefId($preferences_ref_id);
		
		if (in_array($tag_value, $data_arr)) {
			$remo_arr = explode(',', $tag_value);
			$data_arr = array_diff($data_arr, $remo_arr);

			$data = implode(',', $data_arr);
			$query = 
				" UPDATE lss_users_preferences " .
				" SET data = '$data', updated_on = NOW() " . 
				" WHERE user_id = $user_id " .
				" AND preferences_ref_id = $preferences_ref_id ;";
			$mysql_result = $this -> db -> query($query);
			
			if ($this->db->affected_rows() > 0 ) {
				## Update global preference statistics
				$this->_global_preferences_delete($tag_value);
			}
		}
		
		return $this -> selectForCurrentUser_data_byPreferencesRefId($preferences_ref_id);
	}
	
	############################
	## Global Preference Data ##
	############################
	
	function global_preferences_select_count($keywords) {
		$keywords = urldecode($keywords);
		
		$query = 
			" SELECT * FROM " . $this->tables['global_preferences'] . 
			" WHERE `keywords` LIKE '%$keywords%' " . 
			" LIMIT 0, 50";
		//echo $query;
		$mysql_result = $this -> db -> query($query);
		
		if ($mysql_result->num_rows() > 0) {
			return $mysql_result->result_array();
		} else {
			return FALSE;
		}
	}
	
	function _global_preferences_add($keywords) {
		
		if(!$keywords) {
			return FALSE;
		} 
		
		$query = 
			" INSERT INTO " . $this -> tables['global_preferences'] . 
			" (`keywords`, `count`, `updated_on`) " . 
			" VALUES ('$keywords', 1, NOW()) " .
			" ON DUPLICATE KEY UPDATE count = count + 1, updated_on = NOW();";
		return $this -> db -> query($query);
	}
	
	function _global_preferences_delete($keywords) {
		
		if(!$keywords) {
			return FALSE;
		} 
		
		$query = 
			" INSERT INTO " . $this -> tables['global_preferences'] . 
			" (keywords, count, updated_on) " . 
			" VALUES ('$keywords', 0, NOW()) " .
			" ON DUPLICATE KEY UPDATE count = count - 1, updated_on = NOW();";
		return $this -> db -> query($query);
	}
	
	function global_preferences_recount($keywords) {
		
		$keywords = urldecode(trim($keywords));
		
		if(!$keywords) {
			return FALSE;
		} 
		
		$query = 
			" SELECT COUNT(data) AS count FROM " . $this -> tables['users_preferences'] . 
			" WHERE data LIKE '%$keywords%' ";
		$mysql_result = $this -> db -> query($query);
		
		$new_count = $mysql_result->row()->count;
		
		$query = 
			" UPDATE " . $this -> tables['global_preferences'] . 
			" SET count = $new_count ".
			" WHERE keywords = '$keywords' ";
		$mysql_result = $this -> db -> query($query);
		
		$query = 
			" SELECT count FROM " . $this -> tables['global_preferences'] . 
			" WHERE keywords = '$keywords' ";
		$mysql_result = $this -> db -> query($query);
		
		if ($mysql_result->num_rows() > 0) {
			return $mysql_result->row();
		} else {
			return FALSE;
		}
	}
	
	###############################
	## Preferences Search ##
	###############################
	
	function searchTag($keywords) {
		
		$keywords = urldecode(trim($keywords));
		
		if(!$keywords) {
			return FALSE;
		}
		
		$query = 
			" SELECT * FROM " . $this -> tables['users_preferences'] . " AS upre " . 
			" LEFT JOIN " . $this -> tables['users_profile'] . " AS up " .
			" ON `up`.`user_id` = `upre`.`user_id` " .
			" WHERE data LIKE '%$keywords%' " .
			" LIMIT 0, 500 ";
		$mysql_result = $this -> db -> query($query);
		
		if ($mysql_result->num_rows() > 0) {
			return $mysql_result->result_array();
		} else {
			return FALSE;
		}
		
		
	}
}
?>
