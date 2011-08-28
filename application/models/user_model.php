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
		$this -> db -> where('username', $this -> input -> post('username'));
		$this -> db -> where('password', md5($this -> input -> post('password')));
		$query = $this -> db -> get('lss_users');

		if ($query -> num_rows == 1) {
			return true;
		}
	}

	function create_user() {
		$new_member_insert_data = array(
				'firstname' => $this -> input -> post('firstname'), 
				'lastname' => $this -> input -> post('lastname'), 
				'email' => $this -> input -> post('email'), 
				'username' => $this -> input -> post('username'), 
				'password' => md5($this -> input -> post('password')),
				'createdOn' => $this -> input -> post('createdOn'),
				'updatedOn' => $this -> input -> post('updatedOn'),
				'lastLoginOn' => $this -> input -> post('lastLoginOn'),
		);
		
		$insert = $this->db->insert('lss_users', $new_member_insert_data);
		return $insert;
	}

}
?>