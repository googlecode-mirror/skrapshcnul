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
class Ls_User_Recommendation {

	function __construct() {

		$this -> ci = &get_instance();
		$this -> ci -> load -> database();
		$this -> ci -> load -> config('linkedin_oauth', TRUE);
		$this -> ci -> load -> config('tables/events', TRUE);
		$this -> ci -> load -> config('users', TRUE);
		$this -> ci -> load -> library('ion_auth');
		$this -> ci -> load -> library('session');
		$this -> ci -> load -> library('form_validation');
		$this -> ci -> load -> library('input');
		$this -> ci -> load -> library('ls_notifications');
		$this -> ci -> load -> helper('image/image_resize');
		$this -> ci -> load -> helper('logger');
		$this -> ci -> load -> model('user_recommendation_model');

		// Set Config
		$this -> component_class = $this -> ci -> config -> item('component_class', 'ls_notifications');
		//auto-login the user if they are remembered
		if (!$this -> ci -> ion_auth -> logged_in() && get_cookie('identity') && get_cookie('remember_code')) {
			$this -> ci -> ion_auth = $this;
			$this -> ci -> ion_auth_model -> login_remembered_user();
		}

		$this -> ci -> ion_auth_model -> trigger_events('library_constructor');

		// Initialize Library
		$this -> _initialize();
	}

	
	function getUserRecommendations($user_id) {
		
		$results  = ($this -> ci -> events_model -> getUserEventSuggestion($user_id));
		
		// Populate Target User Profile Info
		foreach ($results as $key=>$item) {
			$results[$key]['rec_id_profile'] = ($this -> ci -> user_profile_model -> select($item['rec_id']));
		}
		
		return $results;
		
	}
	

	private function _initialize() {
		$fields['keywords'] = 'Recommendation';
		$this -> component_info = $this -> ci -> ls_notifications_model -> get_component_info($fields);
	}

	public function create($fields) {

		if (empty($fields)) {
			return FALSE;
		}

		// Data values Validation

		if (!(isset($fields['user_id']) && is_numeric($fields['user_id']))) {
			## TODO log error
			return FALSE;
		}

		if (!(isset($fields['target_user_id']) && is_numeric($fields['target_user_id']))) {
			## TODO log error
			return FALSE;
		}

		if (!isset($fields['reason'])) {
			$fields['reason'] = '';
		}

		## TODO Create Event for both users (user & target_user)
		$this -> ci -> db -> trans_off();
		$this -> ci -> db -> trans_start();
		{
			$result = $this -> ci -> user_recommendation_model -> createUserRecommendation($fields);
			$this -> data[] = $result['0'];
			//$fields2 = $fields;
			//$fields2['user_id'] = $fields['target_user_id'];
			//$fields2['target_user_id'] = $fields['user_id'];
			//$result = $this -> ci -> user_recommendation_model -> createUserRecommendation($fields2);
			//$this -> data[] = $result['0'];
		}
		$this -> ci -> db -> trans_complete();
		
		if ($this -> ci -> db -> trans_status()) {
			## Set Notifications
			$notification['component_id'] = $this -> component_info['component_id'];
			$notification['user_id'] = $fields['target_user_id'];
			$notification['message'] = "You have new recommendations";
			$notification['url'] = "/events/suggestions";
			$this -> ci -> ls_notifications -> set_notification($notification);
		}

		if ($this -> data) {
			return $this -> data;
		} else {
			return FALSE;
		}

	}

	public function delete($fields) {
		return true;
	}
	
	public function confirm($fields) {
		
		// Data values Validation

		if (!(isset($fields['recommendation_id']) && is_numeric($fields['recommendation_id']))) {
			## TODO log error
			return FALSE;
		}
		
		$this -> ci -> db -> trans_off();
		$this -> ci -> db -> trans_start();
		{
			$this->data[] = $this -> ci -> user_recommendation_model -> confirm($fields);
		}
		$this -> ci -> db -> trans_complete();
		
		if ($this -> ci -> db -> trans_status()) {
			## TODO - Set Admin Notification
			/*$notification['component_id'] = $this -> component_info['component_id'];
			$notification['user_id'] = $fields['target_user_id'];
			$notification['message'] = "You have new recommendations";
			$notification['url'] = "/events/suggestions";
			$this -> ci -> ls_notifications -> set_notification($notification);*/
		}
		
		if ($this -> data) {
			return $this -> data;
		} else {
			return FALSE;
		}
	}
	
	public function reject($fields) {
		
		// Data values Validation

		if (!(isset($fields['recommendation_id']) && is_numeric($fields['recommendation_id']))) {
			## TODO log error
			return FALSE;
		}
		
		$this -> ci -> db -> trans_off();
		$this -> ci -> db -> trans_start();
		{
			$this->data[] = $this -> ci -> user_recommendation_model -> reject($fields);
		}
		$this -> ci -> db -> trans_complete();
		
		if ($this -> ci -> db -> trans_status()) {
			## TODO - Set Admin Notification
			/*$notification['component_id'] = $this -> component_info['component_id'];
			$notification['user_id'] = $fields['target_user_id'];
			$notification['message'] = "You have new recommendations";
			$notification['url'] = "/events/suggestions";
			$this -> ci -> ls_notifications -> set_notification($notification);*/
		}
		
		if ($this -> data) {
			return $this -> data;
		} else {
			return FALSE;
		}
	}
}
?>