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
class Ls_Guides {

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
		$this -> ci -> load -> library('session');		
		$this -> ci -> load -> model('schedules_model');
		$this -> ci -> load -> library('ls_events');
		$this -> ci -> load -> library('ls_user_recommendation');
		
		// Set Config
		$this -> component_class = $this -> ci -> config -> item('component_class', 'ls_notifications');
		//auto-login the user if they are remembered
		if (!$this -> ci -> ion_auth -> logged_in() && get_cookie('identity') && get_cookie('remember_code')) {
			$this -> ci -> ion_auth = $this;
			$this -> ci -> ion_auth_model -> login_remembered_user();
		}

		$this -> ci -> ion_auth_model -> trigger_events('library_constructor');
	}
	
	function getWelcomeGuide_States($user_id = FALSE) {
		
		## TODO for @Tien
		## Expected result: array of states for each steps 
		## E.g: 
		## 		array['step1'][state] = "Completed";
		## 		array['step1'][reason] = "";
		## 		array['step2'][state] = "Incomplete";
		## 		array['step1'][reason] = "No preference specified.";
		
		if (!$user_id || !is_numeric($user_id)) { return FALSE;}
		
		## has user synchronized linkedin?
		if ($this -> ci -> linkedin_model -> doneSynchronized($user_id)) {
			$result['step1']['state'] = "Completed";
		}
		else {
			$result['step1']['state'] = "Incomplete";
			$result['step1']['reason'] = "No data synced.";
		}
		
		## has user indicate preferences ?
		if ($this -> ci -> preferences_model -> donePreferenced($user_id)) {
			$result['step2']['state'] = "Completed";
		}
		else {
			$result['step2']['state'] = "Incomplete";
			$result['step2']['reason'] = "No preferences set.";
		}
		
		## has user scheduled ?
		if ($this -> ci -> schedules_model -> doneScheduled($user_id)) {
			$result['step3']['state'] = "Completed";
		}
		else {
			$result['step3']['state'] = "Incomplete";
			$result['step3']['reason'] = "No schedule set.";
		}
		
		## pending requests ?
		## pending recommendations ?
		$count = array();
		$count['pending_requests'] = $this -> ci -> ls_events -> 
			countPendingEventRequests($user_id);
		$count['pending_recommendations'] = $this -> ci -> 
			ls_user_recommendation -> countPendingUserRecommendations($user_id);
		
		if ($count['pending_requests'] == 0 && 
			$count['pending_recommendations'] == 0) {
				
			$result['step4']['state'] = "Completed";
		}
		else {
			$result['step4']['state'] = "Incomplete";			
			$result['step4']['reason'] = json_encode($count);
		}
		
		return $result;
		
	}

}
?>