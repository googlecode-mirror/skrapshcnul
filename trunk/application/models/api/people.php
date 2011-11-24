<?php

/**
 * User Name
 */
class People extends CI_Model {

	const _TABLE_ = "lss_users_profile";
	public function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	function select($user_id) {

		if (!$user_id) {
			return FALSE;
		}

		$query = " SELECT * FROM " . self::_TABLE_ . " WHERE `user_id` = '$user_id' ;";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result -> num_rows() > 0) {
			return $mysql_result -> row_array();
		} else {
			$query = " INSERT INTO " . self::_TABLE_ . " (user_id, updated_on) " . " VALUES ('$user_id', NOW()) ";
			$this -> db -> query($query);

			return $this -> select($user_id);
		}
	}

}
?>