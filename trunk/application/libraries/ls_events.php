<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*
CREATE TABLE IF NOT EXISTS `lss_events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_status` int(3) NOT NULL COMMENT '0 = pending request; -1 = cancelled ; 1 = confirmed upcomming event; 2 = past event',
  `date` datetime NOT NULL,
  `location` varchar(100) NOT NULL,
  `reason` text NOT NULL,
  `deadline` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

Check test/ls_events_tests.php for examples.
*/

class Ls_Events {

	function __construct() {

		$this -> ci = &get_instance();
		$this -> ci -> load -> database();
		$this -> ci -> load -> config('linkedin_oauth', TRUE);
		$this -> ci -> load -> config('users', TRUE);
		$this -> ci -> load -> library('ion_auth');
		$this -> ci -> load -> library('input');
		$this -> ci -> load -> library('ls_profile');
		$this -> ci -> load -> library('form_validation');
		$this -> ci -> load -> library('session');
		$this -> ci -> load -> library('ls_user_recommendation');
		
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
		$this -> ci -> load -> model('places_model');

		// Set Config
		$this -> component_class = $this -> ci -> config -> item('component_class', 'ls_notifications');
		//auto-login the user if they are remembered
		if (!$this -> ci -> ion_auth -> logged_in() && get_cookie('identity') && get_cookie('remember_code')) {
			$this -> ci -> ion_auth = $this;
			$this -> ci -> ion_auth_model -> login_remembered_user();
		}

		$this -> ci -> ion_auth_model -> trigger_events('library_constructor');
	}

	function clearTables() { // WARNING: only for testing
		return $this -> ci -> events_model -> clearTables();
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
	
	function _verify($users) {
		$cnt = count($users);
		for ($i = 0; $i < $cnt; ++$i) {
			for ($j = 0; $j < $cnt; ++$j) if ($i != $j &&
				!$this -> ci -> ls_user_recommendation -> 
				isConfirmed($users[$i], $users[$j])) {
			
				return FALSE;
			}
		}
		return TRUE;
	}
	
	/*
	 */
	function create($fields = FALSE) {
		
		if(!$fields) {
			return FALSE;
		}
		
		## Create Event for users (user & target_user)		
		## all users must have accepted their recommedations beforehand
		
		if (!$this -> _verify($fields['user_ids'])) {
			return FALSE;
		}
		
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
	
	/*
	 * Function: get events of user <code>user</code> with status options
	 * 
	 * @param	user_id			id of user
	 * @param	status_list		which kind of events you want to retrieve
	 *                          e.g. {-1, 0, 2}, {0, 1}
	 * 
	 * return 					an array of events with information
	 */
	function getEvents($user_id, $status_list) {
        $events = ($this -> ci -> events_model -> 
        	getEventsByUserId($user_id, $status_list));
			
        if (!$events) {
            return array();
        }
        
        if (count($events) > 0) {
            foreach ($events as $key => $event) {
                $restaurant_id = $event['location'];                            
                $events[$key]['location'] = 
                    $this -> ci -> places_model -> 
                    selectPlaceById($restaurant_id);
                
                $event_id = ($event['event_id']);
                $users = ($this -> ci -> events_model -> 
                	getAllUsersByEventId($event_id));
                
                // Populate Target User Profile Info
                foreach ($users as $key2 => $user) {
                    $users[$key2]['rec_id_profile'] = ($this -> ci -> 
                    	user_profile_model -> select($user['user_id']));
						
                    if ($user_id == $user['user_id']) {
                            $events[$key]['current_user'] = $user;
                    }
                }
                
                $events[$key]['participant'] = $users;
            }
        }
        
        return $events;
    }
	
	/*
	 * Function: get events with status options
	 * 
	 * @param	status_list		which kind of events you want to retrieve
	 *                          e.g. {-1, 0, 2}, {0, 1}
	 * 
	 * return 					an array of events with information
	 */
	function getAllEvents($status_list) {
		
		$events = $this -> ci -> events_model -> getAllEvents($status_list);
		
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