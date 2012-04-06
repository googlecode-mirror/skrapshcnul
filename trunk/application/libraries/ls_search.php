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
	}
	
	function people($fields = FALSE, $options = FALSE) {
			
		$results = $this -> ci -> user_model -> select_all_users($fields, $options);
		
		## Scope
		if (!isset($options['scope'])) {
			switch($options['scope']) {
				case 'friends' :
				case 'extended_network' :
				default:
					break;
			}
		}
		
		foreach ($results as $key => $user_data) {
			$results[$key]['kind'] = "ls#person";
			$results[$key] = $this -> ci -> ls_profile -> getPublicProfile($user_data['user_id']);
		}
		
		//var_dump($results);
		
		return $results;
		
	}
	
	 function tags($fields = FALSE, $options = FALSE) {
	 	
	 }

}
