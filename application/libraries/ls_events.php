<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Name:  Notification
 * Author: @stiucsib86
 * Created:  11.09.2011
 * Description:
 *
 *	Handler for user recommendations
 *	1. user recommendations
 * 		- auto recommendations
 * 		- selected recommendations
 * 	2. user matched
 * 		- negotiated
 *
 *
 *
 *
 *
 * Requirements: PHP5 or above
 */
class Ls_Events {

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
		$this -> ci -> load -> model('events_model');

		// Set Config
		$this -> component_class = $this -> ci -> config -> item('component_class', 'ls_notifications');
		//auto-login the user if they are remembered
		if (!$this -> ci -> ion_auth -> logged_in() && get_cookie('identity') && get_cookie('remember_code')) {
			$this -> ci -> ion_auth = $this;
			$this -> ci -> ion_auth_model -> login_remembered_user();
		}

		$this -> ci -> ion_auth_model -> trigger_events('library_constructor');
	}

	function getUserEventSuggestion($user_id) {

		$events = ($this -> ci -> events_model -> getUserEventSuggestion($user_id));
		
		if (!$events) {
			return array();
		}
		
		// Populate Target User Profile Info
		if (count($events) > 0) {
			foreach ($events as $key => $item) {
				$events[$key]['rec_id_profile'] = ($this -> ci -> user_profile_model -> select($item['rec_id']));
			}
		}

		return $events;

	}

	function getUserEventMatched($user_id) {
		
		$events = ($this -> ci -> events_model -> getUserEventMatched($user_id));
		
		if (!$events) {
			return array();
		}
		
		if (count($events) > 0) {
			
			foreach ($events as $key => $event) {
	
				$event_id = ($event['event_id']);
				$users = ($this -> ci -> events_model -> getEventAllUsers($event_id));
				
				// Populate Target User Profile Info
				foreach ($users as $key2 => $user) {
					$users[$key2]['rec_id_profile'] = ($this -> ci -> user_profile_model -> select($user['user_id']));
					if ($user_id == $user['user_id']) {
						$events[$key]['current_user'] = $user;
					}
				}
				
				$events[$key]['participant'] = $users;
				
			}
			
		}
		
		return $events;

	}
	
	function getUserEvent_past($fields = FALSE) {
		
		if (!$fields) {
			return FALSE;
		}
		
		if (!isset($fields['user_id'])) {
			return FALSE;
		}
		
		$user_id = $fields['user_id'];
		
		$events = ($this -> ci -> events_model -> getUserEvent_past($user_id));
		
		if (!$events) {
			return array();
		}
		
		if (count($events) > 0) {	
			foreach ($events as $key => $event) {
	
				$event_id = ($event['event_id']);
				$users = ($this -> ci -> events_model -> getEventAllUsers($event_id));
				
				// Populate Target User Profile Info
				foreach ($users as $key2 => $user) {
					$users[$key2]['rec_id_profile'] = ($this -> ci -> user_profile_model -> select($user['user_id']));
					if ($user_id == $user['user_id']) {
						$events[$key]['current_user'] = $user;
					}
				}
				
				$events[$key]['participant'] = $users;
				
			}
			
		}
		
		return $events;
		
	}
	
	function rsvp($fields = FALSE) {
		
		if (!$fields) {
			return FALSE;
		}
		
		if (isset($fields['user_id']) && !is_numeric($fields['user_id'])) {
			return FALSE;
		}
		
		if (isset($fields['event_id']) && !is_numeric($fields['event_id'])) {
			return FALSE;
		}
		
		if (!$fields['action']) {
			return FALSE;
		} 
			
		switch($fields['action']) {
			case 'confirm' :
			case 1 :
				$fields['action'] = 1;
				break;
			case 'reject' :
			case 'decline' :
			case 0 :
				$fields['action'] = -1;
				break;
			default : 
				$fields['action'] = 0;
				break;
		}
				
		return $this -> ci -> events_model -> event_RSVP($fields);
	}
	
	function create($fields = FALSE) {
		
		if(!$fields) {
			return FALSE;
		}
		
		## TODO Create Event for both users (user & target_user)
		$this -> ci -> db -> trans_off();
		$this -> ci -> db -> trans_start();
		{
			$this -> data = $this -> ci -> events_model -> createEvent($fields);
		}
		$this -> ci -> db -> trans_complete();
		
		if ($this -> ci -> db -> trans_status()) {
			## Set Notifications
			/* $notification['component_id'] = $this -> component_info['component_id'];
			$notification['user_id'] = $fields['target_user_id'];
			$notification['message'] = "You have new recommendations";
			$notification['url'] = "/events/suggestions";
			$this -> ci -> ls_notifications -> set_notification($notification); */
		}

		if ($this -> data) {
			return $this -> data;
		} else {
			return FALSE;
		}
		
	}
	
	function getAllUpcomingEvents() {
		
		$events = $this -> ci -> events_model -> getAllUpcomingEvents();
		
		if (!$events) {
			return array();
		}
		
		foreach ($events as $key => $event) {
			foreach ($event['participants'] as $key2 => $user){
				$user_profile = ($this -> ci -> user_profile_model -> select($user['user_id']));
				$events[$key]['participants'][$key2]['user_profile'] = $user_profile;
			}
		}
		
		return $events;
	}
	
	function getAllPastEvents() {
		
		$events = $this -> ci -> events_model -> getAllPastEvents();
		
		if (!$events) {
			return array();
		}
		
		foreach ($events as $key => $event) {
			foreach ($event['participants'] as $key2 => $user){
				$user_profile = ($this -> ci -> user_profile_model -> select($user['user_id']));
				$events[$key]['participants'][$key2]['user_profile'] = $user_profile;
			}
		}
		
		return $events;
	}
}
?>