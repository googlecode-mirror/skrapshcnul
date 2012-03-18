<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Facebook_model extends CI_Model {

	public function __construct() {
		
		parent::__construct();
		$this -> load -> config('tables/facebook', TRUE);
		$this -> load -> library('session');
		
		## Initialize tables
		$this -> tables = $this -> config -> item('tables', 'tables/facebook');
		
		$this -> user_id = $this -> session -> userdata('user_id');
	}
	
	function select_data($fields = FALSE, $options = FALSE) {
		
		if (!isset($fields)) return FALSE;
		if (!isset($this -> user_id)) return FALSE;
		
		$where = array();
		$where['user_id'] = $this -> user_id;
		
		$mysql_result = $this -> db -> get_where($this -> tables['facebook_data'], $where);

		return $mysql_result -> row_array();
		
	} 
	
	public function insert_data($fields = FALSE, $options = FALSE) {
		
		if (!isset($fields)) return FALSE;
		if (!isset($fields['uid'])) return FALSE;
		if (!isset($this -> user_id)) return FALSE;
		
		
	}
	
	public function update_data($fields = FALSE, $options = FALSE) {
		
		if (!isset($fields)) return FALSE;
		if (!isset($fields['uid'])) return FALSE;
		if (!isset($this -> user_id)) return FALSE;
		
		$data = array();
		if (isset($fields['uid'])) {
			$data['uid'] = ($fields['uid']);
		}
		if (isset($fields['data'])) {
			$data['data'] = json_encode($fields['data']);
		}
		
		if (!$this->select_data($fields)) {
			## No existing records, do an insert.
			$data['user_id'] = ($this -> user_id);
			$this -> db -> set('created_on', 'NOW()', FALSE);
			
			if (sizeof($data) > 0) {
				if ($this -> db -> insert($this -> tables['facebook_data'], $data)) {
					return $this -> db -> insert_id();
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
			
		} else {
			## Existing records, do an update.
			$where['user_id'] = $this -> user_id;
			
			if (sizeof($data) > 0) {
				return $this -> db -> update($this -> tables['facebook_data'], $data, $where);
			} else {
				return FALSE;
			}
		}
		
	}
	
	public function create_user() {
		
		
		
	}
	
	
}
