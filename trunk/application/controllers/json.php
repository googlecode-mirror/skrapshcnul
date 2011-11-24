<?php

/**
 * System Administrative Page
 */
class Json extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> library('ls_notifications');
		$this -> load -> library('ion_auth');
		$this -> load -> library('input');
		$this -> load -> database();
		$this -> load -> helper('url');
		$this -> load -> model('invitation_model');
		$this -> load -> model('page_steps_completed_model');
		$this -> load -> model('preferences_model');
		$this -> load -> model('schedules_model');
		$this -> load -> model('user_lunch_wishlist_model');
		$this -> load -> helper('logger');
		
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		
		$this->user_id = $this -> session -> userdata('user_id');
		
		// Request Params: alt = json | , 
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> call = (isset($_REQUEST['call'])) ? $_REQUEST['call'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';
		$this -> request_method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : '';
		
		$this -> start_time = time();
		
	}

	function index($value = '') {
		echo "Welcome to Lunchsparks JSON.";
	}

	function check_notifications($type = 'json') {

		$this -> data['notifications'] = $this -> ls_notifications -> get_notifications($this -> session -> userdata['id']);

		if (!$this -> data['notifications'])
			$this -> data['notifications'] = array();

		if ($type == "ajax") {

		} else {
			echo json_encode($this -> data['notifications']);
		}
	}

	function check_notifications_new($type = 'json') {

		if (!isset($this -> session -> userdata['id'])) {
			return json_encode(FALSE);
		}

		$this -> data['notifications'] = $this -> ls_notifications -> check_notifications_new($this -> session -> userdata['id']);

		if ($type == "ajax") {

		} else {
			echo json_encode($this -> data['notifications']);
		}
	}

	function set_notifications_new_as_read($type = 'json') {

		$asso_array = ($this -> uri -> uri_to_assoc(3));

		if (isset($asso_array['notification_id'])) {
			$notification_id = $asso_array['notification_id'];
		} else {
			$notification_id = $this -> input -> post('notification_id');
		}

		$string = 'notification_123';
		if (strstr($string, 'notification_')) {
			$array = str_ireplace('notification_', '', $string);
		}
		print_r($array);

		if (!isset($this -> session -> userdata['id'])) {
			echo json_encode(FALSE);
			return FALSE;
		} else if (empty($notification_id)) {
			echo json_encode(FALSE);
			echo 'no notification';
			return FALSE;
		}

		$result = (bool)$this -> ls_notifications -> set_notifications_new_as_read($this -> session -> userdata['id'], $notification_id);

		if ($type == "ajax") {

		} else {
			echo json_encode($result ? 'success' : FALSE);
		}
	}

	function getTotalUsers() {
		echo json_encode($this -> ion_auth -> getTotalUsers() + 31);
	}
	
	function getTotalLunches() {
		echo json_encode(6);
	}
	
	function checkAddToLunchWishList() {
		
		$this -> target_user_id = (isset($_REQUEST['target_user_id'])) ? $_REQUEST['target_user_id'] : '';
		$results = '';
			
		if(!$this -> user_id || !is_numeric($this -> user_id)) {
			$this -> json_result['error'][] = "NoUserId"; 
			$this -> json_result['results']['followed'] = FALSE;
			$this -> json_result['results']['disabled'] = TRUE;
		} elseif (!$this -> target_user_id || !is_numeric($this -> target_user_id)) {
			$this -> json_result['error'][] = "NoTargetUserId"; 
		} elseif ($this -> user_id == $this -> target_user_id) {
			$this -> json_result['results']['followed'] = TRUE;
			$this -> json_result['results']['disabled'] = TRUE;
		} else {
			$results = $this -> user_lunch_wishlist_model -> select_addToLunchStatus($this->user_id, $this -> target_user_id);
			if (empty($results)) {
				$this -> json_result['results']['followed'] = FALSE;
				$this -> json_result['results']['disabled'] = FALSE;
			} elseif ($results[0]['is_added']) {
				$this -> json_result['results']['followed'] = TRUE;
				$this -> json_result['results']['disabled'] = FALSE;
			} else {
				$this -> json_result['results']['followed'] = FALSE;
				$this -> json_result['results']['disabled'] = FALSE;
			}
		}
		
		$this->_json_prep($this -> json_result);
	}
	
	function addToLunchWishList() {
		
		$this -> target_user_id = (isset($_REQUEST['target_user_id'])) ? $_REQUEST['target_user_id'] : '';
		$results = '';
			
		if(!$this -> user_id) {
			$this -> json_result['error'][] = "NoUserId"; 
		} elseif (!$this -> target_user_id) {
			$this -> json_result['error'][] = "NoTargetUserId"; 
		} elseif ($this -> user_id == $this -> target_user_id) {
			$this -> json_result['results']['disabled'] = TRUE;
		} else {
			$results = $this -> user_lunch_wishlist_model -> toggle_addToLunchStatus($this->user_id, $this -> target_user_id);
			if ($results[0]['is_added']) {
				$this -> json_result['results']['followed'] = TRUE;
				$this -> json_result['results']['disabled'] = FALSE;
			} else {
				$this -> json_result['results']['followed'] = FALSE;
				$this -> json_result['results']['disabled'] = FALSE;
			}
		}
		
		$this->_json_prep($this -> json_result);
	}
	
	function preferences() {
		
		$preferences_id	= isset($_REQUEST['preference_id']) ? $_REQUEST['preference_id'] : '';
		$tag_value	= isset($_REQUEST['preference_tag']) ? $_REQUEST['preference_tag'] : '';
		
		switch ($this -> call) {
			case 'get' : 
				$this -> json_result['results'] = $this -> preferences_model -> selectForCurrentUser();
				break;
			case 'save' :
				if ($tag_value) {
					$this -> json_result['results'] = $this -> preferences_model -> insertForCurrentUser($preferences_id, $tag_value);
				} else {
					$this -> json_result['results'] = $this -> preferences_model -> selectForCurrentUser_byPreferencesRefId($preferences_id);
				}
				break;
			case 'delete' :
				if ($tag_value) {
					$this -> json_result['results'] = $this -> preferences_model -> deleteForCurrentUser($preferences_id, $tag_value);
				} else {
					$this -> json_result['results'] = $this -> preferences_model -> selectForCurrentUser_byPreferencesRefId($preferences_id);
				}
				break;
			case 'global_recount' :
				if ($tag_value) {
					$this -> json_result['results'] = $this -> preferences_model -> global_preferences_recount($tag_value);
				} else {
					$this -> json_result['results'] = $this -> preferences_model -> selectForCurrentUser_byPreferencesRefId($preferences_id);
				}
				break;
			default :
				$this -> json_result['error'] = TRUE;
				$this -> json_result['results'] = FALSE;
		}
		
		$this->_json_prep($this -> json_result);
		
	}
	
	function steps_completed_toggle_hide() {
		
		if(!$this -> user_id) {
			$this -> json_result['error'][] = "No user selected"; 
		} else {
			$results = $this -> page_steps_completed_model -> toggle_is_hidden($this->user_id);
			$this -> json_result['results'] = $results;
		}
		
		$this->_json_prep($this -> json_result);
	}
	
	function steps_completed_toggle_disabled() {
		
		if(!$this -> user_id) {
			$this -> json_result['error'][] = "No user selected"; 
		} else {
			$results = $this -> page_steps_completed_model -> toggle_is_disabled($this->user_id);
			$this -> json_result['results'] = $results;
		}
		
		$this->_json_prep($this -> json_result);
	}
	
	function test() {
		var_dump($_REQUEST);
	}
	
	function _json_prep($results) {
		//header('Cache-Control: no-cache, must-revalidate');
		//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		//header('Content-type: application/json');
		
		if ($this -> callback) {
			$this -> json_result['completed_in'] =  number_format(time() - $this -> start_time, 3, '.', '');
			$this -> json_result['results'][] = $results;
			print_r($this -> callback. '('.json_encode($this -> json_result) .')');
		} else {
			if (empty($this -> json_result['results'])) {
				$this -> json_result['results'] = FALSE;
			}
			print_r(json_encode($this -> json_result));
		}
		
	}
	

}
?>