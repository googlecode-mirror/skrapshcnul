<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ls_Survey {
	function __construct() {
		$this -> ci = &get_instance();
		$this -> ci -> load -> model('user_profile_model');
		$this -> ci -> load -> model('places_model');
		$this -> ci -> load -> model('events_model');
		$this -> ci -> load -> model('survey_model');		
	}	
		
	function clearTables() { // WARNING: only for testing
		$this -> ci -> survey_model -> clearTables();
	}	
		
	function insertFeedback($obj) {
		// check controllers/test/ls_survey_tests.php/test_one 
		// for an example of which format $obj should have 		
		$result = $this -> ci -> survey_model -> 
			insertFeedbackToRestaurant($obj['feedback_to_restaurant']);
		if (empty($result)) return FALSE;
			
		foreach ($obj['feedback_to_users'] as $i => $value) {
			$result = $this -> ci -> survey_model -> 
				insertFeedbackToUser($obj['feedback_to_users'][$i]);
			if (empty($result)) return FALSE;
		}
		
		return TRUE;
	}
	
	function prepareDataForSurvey($user_id, $event_id) {
		$this -> ci -> db -> trans_start();
		
		$result = array();
		
		// retrieve event information
		$result['event_info'] = 
			$this -> ci -> events_model -> getEventById($event_id);
			
		// retrieve buddies information
		$result['buddies_info'] =
			$this -> ci -> events_model -> 
			getLunchBuddiesByEventId($event_id, $user_id);
		// Populate Target User Profile Info
		foreach ($result['buddies_info'] as $key => $user) {
			$result['buddies_info'][$key]['rec_id_profile'] = ($this -> ci -> user_profile_model -> select($user['user_id']));
		}
		
		// retrieve restaurant information
		$restaurant_id = $result['event_info']['location'];
		$result['restaurant_info'] = 
			$this -> ci -> places_model -> 
			selectPlaceById($restaurant_id);
						
		$this -> ci -> db -> trans_complete();
		
		return $result;
	}
	
	function getCompletedSurvey($event_id, $user_id) {
		$result = array();
		
		$result['feedback_to_users'] = 
			$this -> ci -> survey_model -> 
			getFeedbackToUsers($event_id, $user_id);
			
		$result['feedback_to_restaurant'] = 
			$this -> ci -> survey_model -> 
			getFeedbackToRestaurant($event_id, $user_id);
			
		return $result;
	}
}
?>