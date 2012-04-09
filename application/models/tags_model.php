<?php

/**
 * User Name
 */
class Tags_model extends CI_Model {

	function __construct() {
		$this -> load -> config('tables/tags', TRUE);
		$this -> load -> library('session');

		## Initialize DB
		$this -> tables = $this -> config -> item('tables', 'tables/tags');

		$this -> user_id = $this -> session -> userdata('user_id');

	}

	private function _init_params($fields = FALSE, $options = FALSE) {
		
		$this -> fields = $fields;
		$this -> options = $options;
		
		## ---------- Pagination ----------
		## Set Default Values
		if (!isset($this -> options['offset'])) {
			$options['offset'] = 0;
		}
		if (!isset($this -> options['row_count'])) {
			$options['row_count'] = 30;
		}
		if (isset($this -> options['page'])) {
			if (!isset($this -> options['offset'])) {
				$this -> options['offset'] = ($this -> options['page'] - 1) * $this -> options['row_count'];
			}
		}
		
	}
	
	public function select_tag ($fields = FALSE, $options = FALSE) {
		
		$this -> _init_params($fields, $options);
		
		if (!isset($this -> fields['tags'])) {
			return FALSE;
		}
		
		$this -> db -> select('*');
		$this -> db -> from($this -> tables['global_preferences'] . ' AS gp');
		$this -> db -> where('keywords', $this -> fields['tags']);
		
		$mysql_result = $this -> db -> get();
		if ($mysql_result -> num_rows() > 0) {
			$result = ($mysql_result -> row_array());
			return $result;
		} else {
			return FALSE;
		}
	}
	
	public function select_tag_statistics($fields = FALSE, $options = FALSE) {
		
		## Places
		$this -> db -> select('*');
		$this -> db -> from($this -> tables['global_preferences_places'] . ' AS gp');
		$this -> db -> where('keywords', $this -> fields['tags']);
		
		$mysql_result = $this -> db -> get();
		if ($mysql_result -> num_rows() > 0) {
			$temp = $mysql_result -> row_array();
			$results['places'] = $temp['count'];
		} else {
			$results['places'] = 0;
		}
		
		## Projects
		$this -> db -> select('*');
		$this -> db -> from($this -> tables['global_preferences_projects'] . ' AS gp');
		$this -> db -> where('keywords', $this -> fields['tags']);
		
		$mysql_result = $this -> db -> get();
		if ($mysql_result -> num_rows() > 0) {
			$temp = $mysql_result -> row_array();
			$results['projects'] = $temp['count'];
		} else {
			$results['projects'] = 0;
		}
		
		## Users
		$this -> db -> select('*');
		$this -> db -> from($this -> tables['global_preferences_users'] . ' AS gp');
		$this -> db -> where('keywords', $this -> fields['tags']);
		
		$mysql_result = $this -> db -> get();
		if ($mysql_result -> num_rows() > 0) {
			$temp = $mysql_result -> row_array();
			$results['users'] = $temp['count'];
		} else {
			$results['users'] = 0;
		}
		
		return $results;
	}

	function select_all_tags($fields = FALSE, $options = FALSE) {

		$this -> _init_params($fields, $options);
		
		if (isset($this -> options['type']) && !empty($this -> options['type'])) {
			
			## Filter by Filter Type
			return $this -> select_all_tags_filter($this -> fields, $this -> options);
			
		} else {
			
			$this -> db -> select('*');
			$this -> db -> from( $this -> tables['global_preferences'] . ' AS gp');
	
			## Search Filter
			if (isset($this -> fields['tags']) && !empty($this -> fields['tags'])) {
				$this -> db -> like('keywords', $this -> fields['tags']);
			}
	
			## Return results array OR result counts
			if (isset($this -> options['count_all_results']) && $this -> options['count_all_results'] == TRUE) {
				return $this -> db -> count_all_results();
			} else {
				$this -> db -> order_by('count', 'desc');
				$this -> db -> limit($this -> options['row_count'], $this -> options['offset']);
				$mysql_result = $this -> db -> get();
			}
			
			return $mysql_result -> result_array();
		}
	}

	private function select_all_tags_filter($fields = FALSE, $options = FALSE) {
		
		## ---------- Build Query ----------
		switch($options['category']) {
			case 'projects';
				$table = $this -> tables['global_preferences_projects'];
				break;
			default : 
				$table = $this -> tables['global_preferences'];
				break;
		}
		$this -> db -> select('*');
		$this -> db -> from( $table . ' AS gp');
		
		
		
		
		
	}

	function update($fields = FALSE, $options = FALSE) {

		if (!isset($fields['keywords']) || trim($fields['keywords']) == '') {
			return FALSE;
		}

		// Prepare Data to Write to DB
		if (isset($fields['short_description'])) {
			$data['short_description'] = trim($fields['short_description']);
		}
		if (isset($fields['description'])) {
			$data['description'] = trim($fields['description']);
		}
		// DB Query
		if (!$this -> select($fields['keywords'])) {
			## Do an INSERT
			$data['keywords'] = $fields['keywords'];
			$result = $this -> db -> insert($this -> tables['global_preferences'], $data);
		} else {
			## Do an UPDATE
			$this -> db -> where('keywords', $fields['keywords']);
			$result = $this -> db -> update($this -> tables['global_preferences'], $data);
		}

		return $result;

	}
	
	public function tag_count_increase($fields = FALSE, $options = FALSE) {
		
		if(!$fields['keywords']) { return FALSE; } 
		
		## ---------- Increase for specific table ----------
		switch($options['category']) {
			case 'projects';
				
				$query =	" INSERT INTO " . $this -> tables['global_preferences_projects'] . 
							" (`keywords`, `count`) " . 
							" VALUES ('".$fields['keywords']."', 1) " .
							" ON DUPLICATE KEY UPDATE count = count + 1 ;";
				$this -> db -> query($query);
				break;
			default : 
				break;
		}
		
		## ---------- Increase for global table ----------
		$query =	" INSERT INTO " . $this -> tables['global_preferences'] . 
					" (`keywords`, `count`) " . 
					" VALUES ('".$fields['keywords']."', 1) " .
					" ON DUPLICATE KEY UPDATE count = count + 1 ;";
		return $this -> db -> query($query);
	}

	public function tag_count_decrease($fields = FALSE, $options = FALSE) {
		
		if(!$fields['keywords']) { return FALSE; } 
		
		## ---------- Increase for specific table ----------
		switch($options['category']) {
			case 'projects';
				
				$query =	" INSERT INTO " . $this -> tables['global_preferences_projects'] . 
							" (`keywords`, `count`) " . 
							" VALUES ('".$fields['keywords']."', 1) " .
							" ON DUPLICATE KEY UPDATE count = count + 1 ;";
				$this -> db -> query($query);
				break;
			default : 
				break;
		}
		
		## ---------- Increase for global table ----------
		$query =	" INSERT INTO " . $this -> tables['global_preferences'] . 
					" (`keywords`, `count`) " . 
					" VALUES ('".$fields['keywords']."', 1) " .
					" ON DUPLICATE KEY UPDATE count = count + 1 ;";
		return $this -> db -> query($query);
	}
}
?>