<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Name:  Notification
 * Author: @kusum18
 * Created:  11.09.2011
 * Description:
 * Requirements: PHP5 or above
 */
class Ls_Search {

	function __construct() {
		$this -> ci = &get_instance();
		$this -> ci -> load -> model('user_model');
		$this -> ci -> load -> library('ls_profile');
		$this -> ci -> load -> library('ls_projects');
		$this -> ci -> load -> library('ls_tags');
	}
	
	function people($fields = FALSE, $options = FALSE) {
		
		if (isset($options['count_all_results']) && $options['count_all_results']) {
			return $this -> ci -> ls_profile -> select_all_users($fields, $options);
		}
		
		$results = $this -> ci -> ls_profile -> select_all_users($fields, $options);
		
		## TODO Scope
		if (isset($options['scope'])) {
			switch($options['scope']) {
				case 'friends' :
				case 'extended_network' :
				default:
					break;
			}
		}
		
		return $results;
		
	}
	
	function projects($fields = FALSE, $options = FALSE) {
		
		if (isset($options['count_all_results']) && $options['count_all_results']) {
			return $this -> ci -> ls_projects -> select_all_projects($fields, $options);
		}
		
		$results = $this -> ci -> ls_projects -> select_all_projects($fields, $options);
		
		## TODO Scope
		if (isset($options['scope'])) {
			switch($options['scope']) {
				case 'friends' :
				case 'extended_network' :
				default:
					break;
			}
		}
		
		return $results;
		
	}
	
	function tags_similar($fields = FALSE, $options = FALSE) {
	 	
		if (isset($options['count_all_results']) && $options['count_all_results']) {
			return $this -> ci -> ls_tags -> select_all_tags($fields, $options);
		}
		
		$results = $this -> ci -> ls_tags -> select_all_tags($fields, $options);
		
		return $results;
		
		
		## TODO Get Statistics
		$results = $this -> preferences_model -> global_preferences_select_count($query);
		//var_dump($results);
		if (count($results) > 1) {
			foreach ($results as $result) {
				$this -> data['query_result']['similar_keywords'][] = urldecode($result['keywords']);
				$this -> data['query_result']['count'] += $result['count'];
			}
		} else {
			$this -> data['query_result']['similar_keywords'][] = FALSE;
			$this -> data['query_result']['count'] += $results[0]['count'];
		}
		$this -> data['users'] = $this -> preferences_model -> searchTag($query);

		//var_dump($this -> data['users']);

		## Generate Thumbnail
		if (isset($this -> data['users']) && is_array($this -> data['users'])) {
			foreach ($this -> data['users'] as $user) {
				$this -> ls_profile -> generate_profile_image_pin($user['user_id'], $user['profile_img']);
			}
		}
		
	}

	function tags_people() {
		
		## TODO Scope
		if (isset($options['scope'])) {
			switch($options['scope']) {
				case 'friends' :
				case 'extended_network' :
				default:
					break;
			}
		}
		
	}
	
	function tags_projects() {
		
		## TODO Scope
		if (isset($options['scope'])) {
			switch($options['scope']) {
				case 'friends' :
				case 'extended_network' :
				default:
					break;
			}
		}
		
	}

}
