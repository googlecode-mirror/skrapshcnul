<?php

/**
 * User Name
 */
class User_model extends CI_Model {
	
	function __construct() {
		$this -> load -> config('tables/users', TRUE);
		$this -> load -> library('session');

		## Initialize
		$this -> tables = $this -> config -> item('tables', 'tables/users');
		$this -> user_id = $this -> session -> userdata('user_id');
	}
	
	private function _init_params($fields = FALSE, $options = FALSE) {
		
		$this -> fields = $fields;
		$this -> options = $options;

		## Set Default Values
		if (!isset($this -> options['offset'])) {
			$options['offset'] = 0;
		}
		if (!isset($this -> options['row_count'])) {
			$options['row_count'] = 30;
		}
		
	}
	
	function select_user($user_id = NULL) {
		
		if (!isset($user_id)) {
			return FALSE;
		}
		
		$query = " SELECT * FROM `lss_users` WHERE `id` = $user_id";
		$mysql_result = $this -> db -> query($query);
		if ($mysql_result->num_rows() > 0) {
			return $mysql_result->row();
		} else {
			return FALSE;
		}
	}
	
	function select_user_id_by_username($username) {
		
		if(!$username) {
			return FALSE;
		} else {
			$query = " SELECT id AS user_id FROM `lss_users` WHERE `username` = '$username' ;";
			$mysql_result = $this -> db -> query($query);
			if ($mysql_result->num_rows() > 0) {
				return $mysql_result->row()->user_id;
			} else {
				return FALSE;
			}
		}
	}
	
	public function select_all_users($fields = FALSE, $options = FALSE) {
		
		## Build Query
		$this -> db -> select('*');
		$this -> db -> from($this -> tables['users'] . ' AS u');
		$this -> db -> join($this -> tables['users_profile'] . ' AS up', 'up.user_id = u.id', 'left');
		
		## Search Filter
		if (isset($fields['q'])) {
			$this -> db -> like('username', $this -> fields['q']);
			$this -> db -> or_like('email', $this -> fields['q']);
			$this -> db -> or_like('alias', $this -> fields['q']);
			$this -> db -> or_like('firstname', $this -> fields['q']);
			$this -> db -> or_like('lastname', $this -> fields['q']);
		}
		if (isset($this -> fields['tags'])) {
			$this -> db -> join($this -> tables['users_preferences'] . ' AS upref', 'upref.user_id = u.id', 'left');
			$this -> db -> like('data', $this -> fields['tags']);
			$this -> db -> group_by('u.id');
		}
		
		## Return results array OR result counts
		if (isset($this -> options['count_all_results']) && $this -> options['count_all_results'] == TRUE) {
			return $this -> db -> count_all_results();
		} else {
			$this -> db -> limit($this -> options['row_count'], $this -> options['offset']);
			$mysql_result = $this -> db -> get();
		}
		
		return $mysql_result -> result_array();
		
	}
	
	function is_user_account_valid($user_id) {
		
		if(!$user_id) {
			return FALSE;
		} else {
			$query = " SELECT id AS user_id FROM `lss_users` WHERE `id` = '$user_id' AND active=1;";
			$mysql_result = $this -> db -> query($query);
			
			if ($mysql_result->num_rows() > 0) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}
	
	function validate() {
		try {
			// Username doesn't exist
			$this -> db -> where('username', $this -> input -> post('username'));
			$this -> db -> where('password', $this->_prep_password(($this -> input -> post('password'))));
			$query = $this -> db -> get('lss_users');

			if ($query -> num_rows == 1) {
				return true;
			}
		} catch (Exception $e) {

		}

	}

	function _is_username_exist() {
		try {
			$this -> db -> select('username');
			$query = $this -> db -> get('lss_users');
			if ($query -> num_rows) {
				return true;
			}

		} catch (Exception $e) {

		}
	}
	
	function create_user() {
		try {
			if (!$this -> _is_username_exist()) {
				$query = array('firstname' => $this -> input -> post('firstname'), 'lastname' => $this -> input -> post('lastname'), 'email' => $this -> input -> post('email'), 'username' => $this -> input -> post('username'), 'password' => $this->_prep_password(($this -> input -> post('password'))), 'createdOn' => $this -> input -> post('createdOn'), 'updatedOn' => $this -> input -> post('updatedOn'), 'lastLoginOn' => $this -> input -> post('lastLoginOn'), );

				$insert = $this -> db -> insert('lss_users', $query);
				return $insert;
			}
		} catch (Exception $e) {

		}
	}
	
	/*
	 *  Private function to encryp/decryp password 
	 */
	private function _prep_password($value='')
	{
		$secret = "THIS IS THE SECRET KEY TO ENCRYP THE PASSWORD";
		return sha1($value.$secret);
	}
	
	

}
?>