<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Name:  Notification
 * Author: @stiucsib86
 * Created:  11.09.2011
 * Description:
 * Requirements: PHP5 or above
 */
class Ls_Tags {

	function __construct() {

		$this -> ci = &get_instance();
		$this -> ci -> load -> database();
		$this -> ci -> load -> library('ion_auth');
		$this -> ci -> load -> library('session');
		$this -> ci -> load -> library('input');
		$this -> ci -> load -> helper('logger');
		$this -> ci -> load -> model('tags_model');
		
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
	
	private function _init_default_values($fields = FALSE, $options = FALSE) {
		
		if (!isset($fields['tag_icon']) || empty($fields['tag_icon'])) {
			$fields['tag_icon'] = '/skin/images/svgs/bookmark.svg';
		}
		
		return $fields;
		
	}
	
	public function select_tag ($fields = FALSE, $options = FALSE) {
		
		$this -> _init_params($fields, $options);
		
		$results = $this -> ci -> tags_model -> select_tag($fields, $options);
		
		$results = $this -> _init_default_values($results);
		$results['statistics'] = $this -> ci -> tags_model -> select_tag_statistics($fields, $options);
		
		return $results;
		
	}
	
	public function select_all_tags($fields = FALSE, $options = FALSE) {
		
		$this -> _init_params($fields, $options);
		
		$results = $this -> ci -> tags_model -> select_all_tags($fields, $options);
		
		return $results;
		
	}
	
	public function tag_count_increase($fields = FALSE, $options = FALSE) {
		
		if(!$fields['keywords']) { return FALSE; }
		if(!$options['category']) { return FALSE; }
		
		$this -> tags_model -> tag_count_increase($fields, $options);
		
	}
	
	public function tag_count_decrease($fields = FALSE, $options = FALSE) {
		
		if(!$fields['keywords']) { return FALSE; }
		if(!$options['category']) { return FALSE; }
		
		$this -> tags_model -> tag_count_decrease($fields, $options);
		
	}
}
?>