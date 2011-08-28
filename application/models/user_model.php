<?php

/**
 * User Name
 */
class User_model extends CI_Model {

	public function getAll($value = '') {
		$q = $this -> db -> get('lss_users');

		if ($q -> num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data = $row;
			}

			return $data;
		} else {
			return NULL;
		}

	}

	function validate() {
		try {
			// Username doesn't exist
			$this -> db -> where('username', $this -> input -> post('username'));
			$this -> db -> where('password', md5($this -> input -> post('password')));
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
				$query = array('firstname' => $this -> input -> post('firstname'), 'lastname' => $this -> input -> post('lastname'), 'email' => $this -> input -> post('email'), 'username' => $this -> input -> post('username'), 'password' => md5($this -> input -> post('password')), 'createdOn' => $this -> input -> post('createdOn'), 'updatedOn' => $this -> input -> post('updatedOn'), 'lastLoginOn' => $this -> input -> post('lastLoginOn'), );

				$insert = $this -> db -> insert('lss_users', $query);
				return $insert;
			}
		} catch (Exception $e) {

		}
	}

}
?>