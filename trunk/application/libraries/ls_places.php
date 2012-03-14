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
class Ls_Places{

	function __construct() {

		$this -> ci = &get_instance();
		$this -> ci -> load -> config('linkedin_oauth', TRUE);
		$this -> ci -> load -> config('users', TRUE);
		$this -> ci -> load -> library('form_validation');
		$this -> ci -> load -> library('input');
		$this -> ci -> load -> library('ion_auth');
		$this -> ci -> load -> library('session');
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

	function selectPlaceById($fields = FALSE) {
		
		if (!$fields) { return FALSE;}
		
		if (!$fields['places_id']) { return FALSE; }
		
		$results = array();
		$results = $this -> ci -> places_model -> selectPlaceById($fields['places_id']);
		$results['statistics'] = $this -> selectPlace_statistic($fields['places_id']);
		$results['recent_lunches'] = $this -> selectPlace_recent_lunches($fields['places_id']);
		$results['verified_status'] = $this -> selectPlace_verification($fields['places_id']);
		$results['restaurant_info'] = $this -> selectPlace_xtra_restaurant($fields['places_id']);
		
		return $results; 

	}
	
	function selectPlace_statistic($fields = FALSE) {
		
		if (!$fields) { return FALSE;}
		
		if (!$fields['places_id']) { return FALSE; }
		
		## TODO - @dataTeam, populate these data.
		$statistics = array();
		$statistics['total_lunches'] = 90;
		$statistics['ratings']['average'] = 4.2;
		$statistics['ratings']['highest'] = 30;
		$statistics['ratings']['lowest'] = 30;
		$statistics['ratings']['total_number_rated'] = 30;
		
		return $statistics;
		
	}
	
	function selectPlace_recent_lunches($fields = FALSE) {
		
		if (!$fields) { return FALSE;}
		
		if (!$fields['places_id']) { return FALSE; }
		
		$recent_lunches = array();
		
		return $recent_lunches;
		
	}
	
	function selectPlace_verification($fields = FALSE) {
		
		if (!$fields) { return FALSE;}
		
		if (!$fields['places_id']) { return FALSE; }
		
		## TODO - @dataTeam, populate these data.
		/*$verified_status = array();
		$verified_status['status'] = 1;
		$verified_status['remarks'] = "Coffee partner, discount 10%;";*/
		
		$results = $this -> ci -> places_model -> selectPlace_verification($fields['place_id']);
		
		return $results;
	}
	
	function selectPlace_xtra_restaurant($fields = FALSE) {
		
		if (!$fields) { return FALSE;}
		
		if (!$fields['places_id']) { return FALSE; }
		
		## TODO - @dataTeam, populate these data.
		/*$verified_status = array();
		$verified_status['status'] = 1;
		$verified_status['remarks'] = "Coffee partner, discount 10%;";*/
		
		$results = $this -> ci -> places_model -> selectPlace_xtra_restaurant($fields['place_id']);
		
		return $results;
	}
	
	function select_all_places() {
		
		$results = $this -> ci -> places_model -> select_all_places();
		
		foreach($results as $key => $value) {
			$results[$key]['statistics']['rating'] = 0;
			$results[$key]['statistics']['favourites'] = 0;
		}
		
		return $results;
	}
	
	function insertPlace($fields = FALSE) {
		return $result = $this -> ci -> places_model -> insertPlace($fields);;
	}
	
	function updatePlace($fields = FALSE) {
		
		if (!isset($fields['place_id'])) { return FALSE; }
		
		if (isset($fields['name']) || isset($fields['logo']) || isset($fields['primary_phone']) || isset($fields['url']) || isset($fields['location']) || isset($fields['geo_lat']) || isset($fields['geo_long']) || isset($fields['valid'])) {
			$result = $this -> ci -> places_model -> updatePlace($fields);
		}
		if (isset($fields['status']) || isset($fields['remarks'])) {
			$result = $this -> ci -> places_model -> updatePlace_verification($fields);
		}
		if (isset($fields['cuisine']) || isset($fields['opening_hours']) || isset($fields['special_features']) || isset($fields['extras'])) {
			$result = $this -> ci -> places_model -> updatePlace_xtra_restaurants($fields);
		}
		
		return $result;
	}

	function searchPlace($keywords = FALSE) {
		
		if (!$keywords) {return FALSE;}
		
		return $this -> ci -> places_model -> searchPlace($keywords);
		
	}
}
?>