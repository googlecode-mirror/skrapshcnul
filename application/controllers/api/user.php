<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('ion_auth');
		$this->load->library('ls_exception');
		$this->load->library('ls_profile');
		$this->load->library('ls_preferences');
		$this->load->library('ls_projects');
		$this->load->library('ls_wishlist');
		$this->load->library('ls_lunch_buddy');
		$this->load->library('ls_events');
		$this->load->database();
		$this->load->helper('url');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> data['is_logged_in_admin'] = $this->ion_auth->is_admin();
		$this->user_id = $this -> session -> userdata('user_id');
	}

	/**
	 * Remap URI Segments
	 */
	function _remap($method = FALSE) {
		
		//
		// first, get user_id
		//
		$user_id = $method;
		
		$this -> ruri_assoc = $this -> uri -> ruri_to_assoc();
		
		if (!is_numeric($user_id)) {
			//	If its not numeric, then search for alias.
			//	Convert alias to user_id, if exist
			if ($user_id == "me") {
				$user_id = $this -> session -> userdata('user_id');
				if (!$user_id) {
					$error = $this -> ls_exception -> get_error("ApiException",	
																"MeNotLoggedIn", 
																"");
					$this -> json_result['errors'][] = $error;  
					$this -> response($this -> json_result, 404);
				}
			}
			else {
				$error = $this -> ls_exception -> get_error("ApiException",	
															"IncorrectAlias",				
															"$user_id.");
				$this -> json_result['errors'][] = $error;
				$this -> response($this -> json_result, 404);
			}
		}
				
		//
		// second, get method
		//
		if (isset($this->ruri_assoc['details'])) {
			
			$method = $this->ruri_assoc['details'];
			
			if (method_exists($this, $method)) {
				$this -> {$this->ruri_assoc['details']}($user_id, $this -> ruri_assoc);
			}
			else {
				$error = $this -> ls_exception -> get_error("ApiException",
															"IncorrectMethod",
															"$method");
				$this -> json_result['errors'][] = $error;
				$this -> response($this -> json_result, 404);
			}
		} else {
			$this -> profile($user_id);
		}
	}
	
	/**
	 * handle query of the form /user/$user_id; return the general info for 
	 * account $user_id
	 */
	protected function profile($user_id = FALSE) {
		
		//	Check for access validity
		if ($this -> session -> userdata('user_id') == $user_id) {
			$this -> full_profile($user_id);
		} else {
			$this -> public_profile($user_id);
		}
	}

	/**
	 * return full profile for user $user_id
	 */
	private function full_profile($user_id = FALSE) {
		
		$results = $this -> ls_profile -> prepare_profile_data($user_id);
		
		$this -> json_result['results'][] = $results;
		$this -> response($this -> json_result);
	}

	/**
	 * return public profile for user $user_id
	 */
	private function _public_profile($user_id = FALSE) {
		
		$fields['user_id'] = $user_id;
		$results = $this -> ls_profile -> getPublicProfile($fields);
		
		$this -> json_result['results'][] = $results;
		$this -> response($this -> json_result);
		
	}
	
	protected function preferences($user_id = FALSE) {
		
		$result = $this -> ls_preferences -> selectPreferences($user_id);
		$this -> json_result['results'][] = $result;
		$this -> response($this -> json_result);
		
	}
	
	protected function projects($user_id = FALSE, $options = FALSE) {
		
		## TODO: add fields
		
		$fields['user_id'] = $user_id;
		$result = $this -> ls_projects -> select_all_projects($fields, $options);
		$this -> json_result['results'][] = $result;
		$this -> response($this -> json_result, 200);
	}
	
	protected function wishlist($user_id = FALSE, $options = FALSE) {
		
		$result = $this -> ls_wishlist -> wishlist($user_id);
		$this -> json_result['results'][] = $result;
		$this -> response($this -> json_result, 200);
	}
	
	protected function buddylist($user_id = FALSE) {
		$result = $this -> ls_lunch_buddy -> buddylist($user_id);
		$this -> json_result['results'][] = $result;
		$this -> response($this -> json_result, 200);
	}
	
	protected function similar_people($user_id = FALSE) {
		$this -> json_result['result'][] = "";
		$this -> response($this -> json_result, 200);
	}
	
	/*
	 * /api/user/me/details/events/format/json/s0/0/s1/1
	 */
	protected function events($user_id = FALSE, $options = FALSE) {
		$status = array();
		if (isset($options['s0'])) $status[] = $options['s0'];
		if (isset($options['s1'])) $status[] = $options['s1'];
		if (isset($options['s2'])) $status[] = $options['s2'];
		if (isset($options['s3'])) $status[] = $options['s3'];
		
		$result = $this->ls_events->getEvents($user_id, $status);
		$this->json_result['results'] = $result;
		$this->response($this->json_result, 200);
	}
}
?>