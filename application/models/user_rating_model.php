<?php

/*
 * Tien: I haven't tested updatePick because it is not easy to test it without the layout.
 */

class User_Rating_Model extends CI_Model {

	function selectRating($userid) {
		$query = 
			" SELECT * " . 
			" FROM lss_users_ratings " . 
			" WHERE user_id = '$userid';";
		$mysql_result = $this -> db -> query($query);
		
		if (!($mysql_result->num_rows() > 0)) {
			// Initialize the stats
			$query = 
				" INSERT INTO lss_users_ratings ".
				" (user_id, created_on) " . 
				" VALUES ('$userid', NOW() ) " .
				" ON DUPLICATE KEY UPDATE points = 0;";
			$mysql_result = $this -> db -> query($query);
			
			$query = 
				" SELECT * " . 
				" FROM lss_users_ratings " . 
				" WHERE user_id = '$userid';";
			$mysql_result = $this -> db -> query($query);
			
		}
		
		return $mysql_result->row();
	}
	
	function insertRating($userid, $point_change, $remarks='') {
		
		$query = 
			" INSERT INTO lss_users_ratings_log ".
			" (userid, point_change, remarks, created_on, updated_on)" .
      		"  VALUES ('$userid', '$point_change', '$remarks', NOW(), NOW())";
		$mysql_result = $this -> db -> query($query);
		
		if ($this->db->affected_rows() > 0) {
			$query = 
				" INSERT INTO lss_users_ratings ".
				" (user_id, created_on) " . 
				" VALUES ('$userid', NOW() ) " .
				" ON DUPLICATE KEY UPDATE points = points + ".$point_change .";";
			$mysql_result = $this -> db -> query($query);
		}
		
		return $this->db->affected_rows();
	}

}
?>
