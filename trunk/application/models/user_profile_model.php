<?php

/**
 * User Name
 */
class User_Profile_model extends CI_Model {

	const _TABLE_ = "lss_users_profile";
	const _TABLE_SOCIAL_LINKS = "lss_users_profile_social_links";
	const _TABLE_VERIFICATION_STATUS = "lss_users_profile_verification_status";

	function __construct() {
		$this -> load -> config('tables/users', TRUE);
		$this -> load -> library('session');

		## Initialize DB
		$this -> tables = $this -> config -> item('tables', 'tables/users');

		$this -> user_id = $this -> session -> userdata('user_id');
	}

	function select($user_id) {

		if (!$user_id) {
			return FALSE;
		}

		$this -> db -> select('*');
		$this -> db -> from($this -> tables['users'] . ' AS u');
		$this -> db -> join($this -> tables['users_profile'] . ' AS up', 'up.user_id = u.id', 'left');
		$this -> db -> where('up.user_id', $user_id);
		$mysql_result = $this -> db -> get();

		if ($mysql_result -> num_rows() > 0) {
			$result = ($mysql_result -> row_array());
			if (trim($result['alias'])) {
				$result['ls_pub_url'] = "/pub/" . $result['alias'];
			} else {
				$result['ls_pub_url'] = "/pub/" . $result['user_id'];
			}
			return $result;
		} else {
			## Initialize row
			$data = array('user_id' => $fields['user_id']);
			$this -> db -> insert($this -> tables['users_profile'], $data);
			
			return $this -> select($user_id);
		}
	}

	public function select_statistics($fields = NULL, $options = NULL) {

		if (!isset($fields['user_id']) || !is_numeric($fields['user_id'])) {
			return FALSE;
		}

		$this -> db -> select('*');
		$this -> db -> from($this -> tables['users_profile_stats'] . ' AS ups');
		$this -> db -> where('ups.user_id', $fields['user_id']);
		$mysql_result = $this -> db -> get();

		if ($mysql_result -> num_rows() > 0) {
			
			$result = ($mysql_result -> row_array());
			return $result;
			
		} else {
			## Initialize row
			$data = array('user_id' => $fields['user_id']);
			$this -> db -> insert($this -> tables['users_profile_stats'], $data);
			
			return $this -> select_statistics($fields['user_id']);
		}
	}

	function select_all($fields = NULL, $options = NULL) {

		$this -> db -> select('*');
		$this -> db -> from($this -> tables['users_profile'] . ' AS up');
		$mysql_result = $this -> db -> query($query);

		if ($mysql_result -> num_rows() > 0) {

			$final = array();
			//var_dump($mysql_result->result_array());
			foreach ($mysql_result->result_array() as $row => $result) {
				if (trim($result['alias'])) {
					$result['ls_pub_url'] = "/pub/" . $result['alias'];
				} else {
					$result['ls_pub_url'] = "/pub/" . $result['user_id'];
				}
				array_push($final, $result);
			}
			return $final;
		} else {
			return FALSE;
		}
	}

	function update($user_id, $fields) {

		if (!$user_id) {
			return FALSE;
		}

		// Check for unique alias
		if (isset($fields['alias']) && !$this -> is_alias_available($fields['alias'])) {
			return FALSE;
		}

		// Prepare Data to Write to DB
		if (isset($fields['alias']) && (trim($fields['alias'])) != '') {
			$data['alias'] = trim($fields['alias']);
		}
		if (isset($fields['firstname'])) {
			$data['firstname'] = trim($fields['firstname']);
		}
		if (isset($fields['lastname'])) {
			$data['lastname'] = trim($fields['lastname']);
		}
		if (isset($fields['mobile_number'])) {
			$data['mobile_number'] = trim($fields['mobile_number']);
		}
		if (isset($fields['delivery_email'])) {
			$data['delivery_email'] = trim($fields['delivery_email']);
		}
		if (isset($fields['profile_img'])) {
			$data['profile_img'] = trim($fields['profile_img']);
		}
		if (isset($fields['headline'])) {
			$data['headline'] = trim($fields['headline']);
		}
		if (isset($fields['location'])) {
			$data['location'] = trim($fields['location']);
		}

		// DB Query
		if (!$this -> select($user_id)) {
			## Do an INSERT
			$data['user_id'] = $user_id;
			$result = $this -> db -> insert($this -> tables['users_profile'], $data);
		} else {
			## Do an UPDATE
			$this -> db -> where('user_id', $user_id);
			$result = $this -> db -> update($this -> tables['users_profile'], $data);
		}

		// if Alias changed, update Social Link
		if (!empty($alias)) {
			$fields['lunchsparks'] = base_url() . "pub/" . $alias;
			$this -> update_social_links($user_id, $fields);
		} else {
			$fields['lunchsparks'] = base_url() . "pub/" . $user_id;
			$this -> update_social_links($user_id, $fields);
		}

		return $result;

	}

	function update_fromLinkedInData($user_id, $fields) {
		// Get existing records
		$data = $this -> select($user_id);

		// Prepare Data to Write to DB
		## Alias
		if (isset($data['alias']) && !empty($data['alias'])) {
			$alias = $data['alias'];
		} else {
			$alias = isset($fields['alias']) ? $fields['alias'] : "";
		}
		## Firstname
		if (isset($data['firstname']) && !empty($data['firstname'])) {
			$firstname = $data['firstname'];
		} else {
			$firstname = isset($fields['firstname']) ? $fields['firstname'] : "";
		}
		## Lastname
		if (isset($data['lastname']) && !empty($data['lastname'])) { $lastname = $data['lastname'];
		} else {
			$lastname = isset($fields['lastname']) ? $fields['lastname'] : "";
		}
		## Mobile Number
		if (isset($data['mobile_number']) && !empty($data['mobile_number'])) {
			$mobile_number = $data['mobile_number'];
		} else {
			$mobile_number = isset($fields['mobile_number']) ? $fields['mobile_number'] : "";
		}
		## Delivery Email
		if (isset($data['delivery_email']) && !empty($data['delivery_email'])) {
			$delivery_email = $data['delivery_email'];
		} else {
			$delivery_email = isset($fields['delivery_email']) ? $fields['delivery_email'] : "";
		}
		## Profile Image
		if (isset($data['profile_img']) && !empty($data['profile_img'])) {
			$profile_img = $data['profile_img'];
		} else {
			$profile_img = isset($fields['profile_img']) ? $fields['profile_img'] : "";
		}
		## Location
		if (isset($data['location']) && !empty($data['location'])) {
			$location = $data['location'];
		} else {
			$location = isset($fields['location']) ? $fields['location'] : "";
		}

		// DB Query
		$query = "INSERT INTO " . self::_TABLE_ . " (user_id, firstname, lastname, mobile_number, delivery_email, profile_img, location, updated_on) " . " VALUES ('$user_id', '$firstname', '$lastname', '$mobile_number', '$delivery_email', '$profile_img', '$location', NOW()) " . " ON DUPLICATE KEY UPDATE " . " `firstname` = '$firstname', " . " `lastname` = '$lastname', " . " `mobile_number` = '$mobile_number', " . " `delivery_email` = '$delivery_email', " . " `profile_img` = '$profile_img', " . " `location` = '$location', " . " `updated_on` = NOW();";
		return $this -> db -> query($query);
	}

	function select_user_id_by_alias($alias) {

		if (!$alias) {
			return FALSE;
		} else {
			$query = " SELECT user_id FROM `lss_users_profile` WHERE `alias` = '$alias' ;";
			$mysql_result = $this -> db -> query($query);
			if ($mysql_result -> num_rows() > 0) {
				return $mysql_result -> row() -> user_id;
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

		if (!$user_id) {
			return FALSE;
		}

		$query = " SELECT * FROM " . self::_TABLE_SOCIAL_LINKS . " WHERE `user_id` = '$user_id' ;";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> row_array();
		} else {
			$query = " INSERT INTO " . self::_TABLE_SOCIAL_LINKS . " (user_id, lunchsparks, updated_on) " . " VALUES ('$user_id', '" . base_url("/pub/" . $user_id) . "', NOW()) ";
			$this -> db -> query($query);

			return $this -> select_social_links($user_id);
		}
	}

	function update_social_links($user_id, $fields) {

		if (!$user_id) {
			return FALSE;
		}

		// Get existing records
		$data = $this -> select_social_links($user_id);

		// Prepare Data to Write to DB
		$lunchsparks = isset($fields['lunchsparks']) ? $fields['lunchsparks'] : $data['lunchsparks'];
		$linkedin = isset($fields['linkedin']) ? $fields['linkedin'] : $data['linkedin'];
		$twitter = isset($fields['twitter']) ? $fields['twitter'] : $data['twitter'];
		$facebook = isset($fields['facebook']) ? $fields['facebook'] : $data['facebook'];

		// DB Query
		$query = "INSERT INTO " . self::_TABLE_SOCIAL_LINKS . " (user_id, lunchsparks, linkedin, twitter, facebook, updated_on) " . " VALUES ('$user_id', '$lunchsparks', '$linkedin', '$twitter', '$facebook', NOW()) " . " ON DUPLICATE KEY UPDATE " . " `lunchsparks` = '$lunchsparks', " . " `linkedin` = '$linkedin', " . " `twitter` = '$twitter', " . " `facebook` = '$facebook', " . " `updated_on` = NOW();";
		return $this -> db -> query($query);

	}

	## User Verification
	function get_verification_status($user_id = FALSE) {

		if (!$user_id) {
			return FALSE;
		}

		$query = " SELECT * FROM " . self::_TABLE_VERIFICATION_STATUS;
		$query .= " WHERE `user_id` = '" . $user_id . "' ";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			$result = ($mysql_result -> row_array());
			return $result;
		} else {
			return FALSE;
		}
	}

	function update_verification_status($fields = FALSE) {

		if (!$fields) {
			return FALSE;
		}

		// Get existing records
		$data = $this -> get_verification_status($user_id);

		// Prepare Data to Write to DB
		$user_id = isset($fields['user_id']) ? $fields['user_id'] : $data['user_id'];
		$status = isset($fields['status']) ? $fields['status'] : $data['status'];
		$remarks = isset($fields['remarks']) ? $fields['remarks'] : $data['remarks'];
		$updated_by = isset($fields['updated_by']) ? $fields['updated_by'] : $data['updated_by'];

		// DB Query
		$query = "INSERT INTO " . self::_TABLE_VERIFICATION_STATUS . " (user_id, status, remarks, updated_by, created_on, updated_on) " . " VALUES ('$user_id', '$status', '$remarks', '$updated_by', NOW(), NOW()) " . " ON DUPLICATE KEY UPDATE " . " `status` = '$status', " . " `remarks` = '$remarks', " . " `updated_by` = '$updated_by', " . " `updated_on` = NOW();";
		return $this -> db -> query($query);

	}

}
?>