<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		//default constructor
		parent::__construct();

		//load database, libraries, helpers, models
		$this -> load -> database();
		$this -> load -> config('linkedin_oauth', TRUE);
		$this -> load -> config('users', TRUE);
		$this -> load -> driver('minify');
		$this -> load -> helper('logger');
		$this -> load -> helper('linkedin/linkedin_api');
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> library('input');
		$this -> load -> library('ls_profile');
		$this -> load -> model('linkedin/linkedin_model');
		$this -> load -> model('page_steps_completed_model');
		$this -> load -> model('preferences_model');
		$this -> load -> model('user_lunch_buddy_model');
		$this -> load -> model('user_lunch_wishlist_model');
		$this -> load -> model('user_rating_model');

		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> data['is_logged_in_admin'] = $this->ion_auth->is_admin();
		
		// Check if user is logged in
		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login?redirect='.uri_string(), 'refresh');
		}
		
		// Initialize
		if ($this -> data['is_logged_in']) {
			if ($this -> session -> userdata('linkedin_pulled') == NULL) {
				$this -> session -> set_userdata('linkedin_pulled', $this -> linkedin_model -> selectLinkedInDataForCurrentUser() != NULL);
			}
		}
		
		$this->user_id = $this -> session -> userdata('user_id');
		
		$this->data['steps_completed'] = $this -> page_steps_completed_model -> select($this->user_id);
		
		// Request Params: alt = json | , 
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> call = (isset($_REQUEST['call'])) ? $_REQUEST['call'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';
		$this -> request_method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : '';
		$this -> start_time = time();
		
	}

	function index() {
		// Check if user is logged in
		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		} else {
			$this -> profile();
		}
	}

	function profile() {
		
		$this -> data['user_id'] = $this -> session -> userdata('user_id');
		$this -> data['target_user_id'] = $this -> session -> userdata('user_id');
		
		$this -> data['profile']		= $this -> ls_profile -> _prepare_profile_data($this->user_id);
		$this -> data['profile_stats']	= $this -> ls_profile -> _prepare_profile_statistics($this->user_id);
		$this -> data['profile']['social_links'] = $this -> ls_profile -> prepare_profile_social_links($this->user_id);
		
		// Initialize
		if ($this -> session -> userdata('linkedin_pulled') == NULL) {
			$this -> session -> set_userdata('linkedin_pulled', $this -> linkedin_model -> selectLinkedInDataForCurrentUser() != NULL);
		}
		
		//$external_data['linkedin'] = $this -> linkedin_model -> selectLinkedInDataForCurrentUser();
		//$this -> data['external_data'] = $external_data;
		
		// Render view data
		$this -> data['head_title']		= $this -> data['profile']['first_name'] .' | Lunchsparks'; 
		$this -> data['tpl_page_id']	= 'profile';
		// Render view layout
		$this -> data['main_content']	= 'user/user_profile';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function sync() {

		redirect('settings/sync', 'refresh');

	}
	
	function preferences() {
		
		if ($this -> alt == 'json') {
			
			$this -> _preferences_json();
			
		} else {
			
			$this -> data['preferences'] = $this -> preferences_model -> selectForCurrentUser();
			
			// Render views
			$this -> data['tpl_page_id'] = 'preferences';
			$this -> data['main_content'] = 'user/preferences';
			$this -> load -> view('includes/tmpl_layout', $this -> data);
		}
		
	}

	function _preferences_json() {
		
		/*$preferences_id	= $this->uri->segment(3);
		$tag_value		= $this->uri->segment(4);*/
		
		$preferences_id	= isset($_REQUEST['preference_id']) ? $_REQUEST['preference_id'] : '';
		$tag_value	= isset($_REQUEST['preference_tag']) ? $_REQUEST['preference_tag'] : '';
		
		switch ($this -> call) {
			case 'get' : 
				$results = $this -> preferences_model -> selectForCurrentUser();
				break;
			case 'save' :
				if ($tag_value) {
					$results = $this -> preferences_model -> insertForCurrentUser($preferences_id, $tag_value);
				} else {
					$results = $this -> preferences_model -> selectForCurrentUser_byPreferencesRefId($preferences_id);
				}
				break;
			case 'delete' :
				if ($tag_value) {
					$results = $this -> preferences_model -> deleteForCurrentUser($preferences_id, $tag_value);
				} else {
					$results = $this -> preferences_model -> selectForCurrentUser_byPreferencesRefId($preferences_id);
				}
				break;
			default :
				$this -> json_result['error'] = TRUE;
				$results = FALSE;
		}
		
		$this -> _json_prep($results);
	}

	function friends() {

		// Render views
		$this -> data['tpl_page_id'] = 'friends';
		$this -> data['main_content'] = 'user/friends';
		$this -> load -> view('includes/tmpl_layout', $this -> data);

	}

	function messages() {

		$this -> data['tpl_page_id'] = 'messages';
		$this -> data['main_content'] = 'user/messages';
		$this -> load -> view('includes/tmpl_layout', $this -> data);

	}

	function invitation() {
		$this -> invites();
	}

	function invites() {
		// Check if user is logged in
		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login/?redirect='.uri_string(), 'refresh');
		}
		
		$this->data['user_invitation_list'] = array();

		// Render views
		$this -> data['tpl_page_id'] = 'invitations';
		$this -> data['main_content'] = 'user/invites';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function _json_prep($results) {
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		
		if ($this -> callback) {
			$this->json_result['completed_in']	=  number_format(time() - $this -> start_time, 3, '.', '');
			$this->json_result['results'][]		= $results;
			print_r($this -> callback. '('.json_encode($this->json_result) .')');
		} else {
			$this->json_result['results'] = $results;
			print_r(json_encode($this->json_result));
		}
		
	}

}
?>
