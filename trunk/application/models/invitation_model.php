<?php

class Invitation_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->config('invitations', TRUE);
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->load->library('session');
		$this->lang->load('ion_auth');
		//initialize db tables data
		$this->tables  = $this->config->item('tables', 'invitations');
		$this->columns = $this->config->item('columns', 'invitations');
		//initialize data
		$this->store_salt      = $this->config->item('store_salt', 'invitations');
		$this->salt_length     = $this->config->item('salt_length', 'invitations');
	}

	function selectInvitation($userid) {
		$query = 
			" SELECT * " . 
			" FROM lss_users_invitations " . 
			" WHERE user_id = '$userid';";
		$result = $this -> db -> query($query);
		return $result->row();
	}
	
	function insertRating($userid, $name, $date, $time, $date_end, $time_end, $center_lat, $center_lng, $radius, $repeat) {
		$datetime_start = trim($date) . " " . trim($time);
		$datetime_end = trim($date_end) . " " . trim($time_end);
		$query = 
			"INSERT INTO lss_schedules (user_id, name, start_date, end_date, repeat_params, center_lat, center_lng, radius) " . 
			" VALUES ('$userid', '$name', " . 
			" STR_TO_DATE('$datetime_start','%m/%d/%Y %T'), " . 
			" STR_TO_DATE('$datetime_end','%m/%d/%Y %T'), " . 
			" '$repeat', " . " '$center_lat', '$center_lng', '$radius')";
		$success = $this -> db -> query($query);
		return $success;
	}

	function updatePick($userid, $index, $name, $date, $time, $date_end, $time_end, $center_lat, $center_lng, $radius) {

		$datetime_start = $date . " " . $time;
		$datetime_end = $date_end . " " . $time_end;
		$query = 
			" UPDATE lss_schedules " . 
			" SET name = '$name' " . 
			" , STR_TO_DATE('$datetime_start','%m/%d/%Y %T') " . 
			" , end_date = STR_TO_DATE('$datetime_end','%m/%d/%Y %T') " . 
			" , center_lat = '$center_lat', center_lng = '$center_lng' " . 
			" , radius = '$radius' " . 
			" WHERE user_id = '$userid' " .
			" AND `index` = '$index';";
		$success = $this -> db -> query($query);
		return $success;
	}
	
	// Invitation_Log Section
	
	function selectInvitationLog($userid) {
		$query = 
			" SELECT * " . 
			" FROM lss_users_invitations_log " . 
			" WHERE user_id = '$userid';";
		$result = $this -> db -> query($query);
		return $result->result_array();
	}
	
	function selectInvitationLog_signed_up($userid) {
		$query = 
			" SELECT * " . 
			" FROM `lss_users_invitations_log` " . 
			" WHERE `user_id` = '$userid' ".
			" AND `joined_on` != null";
		$result = $this -> db -> query($query);
		return $result->result_array();
	}
	
	function insertInvitationLog($userid, $invitee_email) {
		
		$invitee_email = trim($invitee_email);
		// Generate Invitation Code
		$salt = $this -> salt();
		$invitation_code = $this -> _hash_invitation_code($invitee_email, $salt);
		
		$query = 
			" INSERT INTO lss_users_invitations_log ".
			" (user_id, invitee_email, invitation_code, salt, created_on) " . 
			" VALUES ('$userid', '$invitee_email', '$invitation_code', '$salt', NOW() ) " .
			" ON DUPLICATE KEY UPDATE invitee_email = '$invitee_email' ";
		$mysql_result = $this -> db -> query($query);
		
		if ($this->db->affected_rows()) {
			// Update Invitation left
			$query = 
				" INSERT INTO lss_users_invitations " . 
				" ( user_id, updated_on ) " .
				" VALUES ('$userid', NOW() )" . 
				" ON DUPLICATE KEY UPDATE invitation_left = invitation_left - 1 ";
			$mysql_result = $this -> db -> query($query);
		}
		
		return $this->db->affected_rows();
	}
	
	function selectInvitationLogForEmail($invitee_email) {
		$query = 
			" SELECT `user_id`, `email`, `invitee_email`, `invitation_code`, luil.`created_on`, `joined_on` " . 
			" FROM `lss_users_invitations_log` AS luil " . 
			" LEFT JOIN lss_users ON user_id = id " .
			" WHERE `invitee_email` = '$invitee_email' ".
			" AND `joined_on` IS NULL";
		$result = $this -> db -> query($query);
		return $result->row();
	}
	
	function updateJoinedOn($invitee_email = '') {
		if (empty($invitee_email)) {
			return FALSE;
		} else {
			$query = 
				" UPDATE  `lss_users_invitations_log` " . 
				" SET  `joined_on` = NOW( ) " . 
				" WHERE `invitee_email` =  '$invitee_email';";
			$mysql_result = $this -> db -> query($query);
			return $this->db->affected_rows();
		}
	}
	

	function _hash_invitation_code($invitee_email, $salt=false) {
		if (empty($invitee_email)) {
	    	return FALSE;
	    }
	    if ($this->store_salt && $salt) {
		    return  sha1($invitee_email . $salt);
	    }
	    else {
			$salt = $this->salt();
			return  $salt . substr(sha1($salt . $invitee_email), 0, -$this->salt_length);
	    }
		
	}
	
	/**
	 * Return salt, if not defined generates a random salt value.
	 *
	 * @return void
	 * @author binghan@lunchsparks.me
	 **/
	public function salt()
	{
		if ($this -> store_salt) {
			return substr($this -> store_salt, 0, $this->salt_length);
		} else {
			return substr(md5(uniqid(rand(), true)), 0, $this->salt_length);
		}
	}
}
?>
