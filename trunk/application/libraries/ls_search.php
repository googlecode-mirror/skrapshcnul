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
		$this -> ci -> load -> model('user_profile_model');
		$this -> ci -> load -> library('ls_profile');
	}
	
	function people()
	{
		$data=$this -> ci -> user_profile_model -> select_all();
		$final = array();
		foreach($data as $row=>$user_data)
		{
			$result['kind'] = "ls#person";
			try{
				$result['user_id'] = $user_data['user_id'];
				$result['id'] = $user_data['user_id'];
				$result['display_name'] = $user_data['firstname'];
				$result['firstname'] = $user_data['firstname'];
				$result['lastname'] = $user_data['lastname'];
				$result['profile_img'] = $user_data['profile_img'];
				$data2=$this -> ci -> ls_profile -> prepare_profile_data($user_data['user_id']);
				$result['headline'] = $data2['headline'];
				$result['ls_pub_url'] = $user_data['ls_pub_url'];
				$result['verification'] = $data2['verification'];					
			}catch(exception $e)
			{
				// echo "Exception caught $e";
			}
			array_push($final,$result);						
		}
		return $final;
	}
}
	