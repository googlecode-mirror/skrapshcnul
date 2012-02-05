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
class Ls_Preferences {

	function __construct() {

		$this -> ci = &get_instance();
		$this -> ci -> load -> database();
		$this -> ci -> load -> config('linkedin_oauth', TRUE);
		$this -> ci -> load -> config('users', TRUE);
		$this -> ci -> load -> library('ion_auth');
		$this -> ci -> load -> library('session');
		$this -> ci -> load -> library('form_validation');
		$this -> ci -> load -> library('input');
		$this -> ci -> load -> helper('image/image_resize');
		$this -> ci -> load -> helper('logger');
		$this -> ci -> load -> helper('linkedin/linkedin_api');
		$this -> ci -> load -> model('linkedin/linkedin_model');
		$this -> ci -> load -> model('invitation_model');
		$this -> ci -> load -> model('preferences_model');
		$this -> ci -> load -> model('user_model');
		$this -> ci -> load -> model('user_rating_model');
		$this -> ci -> load -> model('user_lunch_wishlist_model');
		$this -> ci -> load -> model('user_lunch_buddy_model');
		$this -> ci -> load -> model('user_profile_model');
		
		// Set Config
		$this -> component_class = $this -> ci -> config -> item('component_class', 'ls_notifications');
		//auto-login the user if they are remembered
		if (!$this -> ci -> ion_auth -> logged_in() && get_cookie('identity') && get_cookie('remember_code')) {
			$this -> ci -> ion_auth = $this;
			$this -> ci -> ion_auth_model -> login_remembered_user();
		}

		$this -> ci -> ion_auth_model -> trigger_events('library_constructor');
	}

	function selectForCurrentUser() {
		
		return $this -> ci -> preferences_model -> selectForCurrentUser();;
		
	}

}
?>