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
class Ls_Steps_Completed {

	function __construct() {

		$this -> ci = &get_instance();
		$this -> ci -> load -> database();
		$this -> ci -> load -> library('ion_auth');
		$this -> ci -> load -> library('session');
		$this -> ci -> load -> helper('logger');
		$this -> ci -> load -> model('page_steps_completed_model');
		// Set Config
	}
	
	function select($user_id) {
		return $this -> ci -> page_steps_completed_model -> select($user_id);
	}
	
	function toggle_is_hidden($user_id) {
		return $this -> ci -> page_steps_completed_model -> toggle_is_hidden($user_id);
	}
	

}
?>