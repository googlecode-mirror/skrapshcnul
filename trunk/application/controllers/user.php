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
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> library('input');
		$this -> load -> helper('logger');
		$this -> load -> helper('linkedin/linkedin_api');
		$this -> load -> model('linkedin/linkedin_model');
		$this -> load -> model('preferences_model');

		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();

		// Initialize
		if ($this -> data['is_logged_in']) {
			if ($this -> session -> userdata('linkedin_pulled') == NULL) {
				$this -> session -> set_userdata('linkedin_pulled', $this -> linkedin_model -> selectLinkedInDataForCurrentUser() != NULL);
			}
		}
		
		// Request Params: alt = json | , 
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> call = (isset($_REQUEST['call'])) ? $_REQUEST['call'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';
		$this -> request_method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : '';
		
		$this -> start_time = time();
		
		// Check if user is logged in
		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login?redirect='.uri_string(), 'refresh');
		}
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

		/* dummy data */
		if(!isset($user_data['cover_background'])) {
			$user_data['cover_background'] = base_url() . "/skin/images/960/cover_background.jpg";
		}
		if(!isset($user_data['profile_img'])) {
			$user_data['profile_img'] = base_url() . "/skin/images/180/silhouette_male.jpg";
		}
		if(!isset($user_data['profile_img_thumb'])) {
			$user_data['profile_img_thumb'] = base_url() . "/skin/images/180/silhouette_male.jpg";
		}
		if(!isset($user_data['name'])) {
			$user_data['name'] = "Bing Han, Goh";
		}
		$user_data['position'] = "Platform Engineer";
		$user_data['company'] = "Lunchsparks Pte. Ltd.";
		$user_data['country_lives'] = "Singapore";
		$this -> data['user_profile'] = $user_data;

		$lunch_buddy_list[] = array('name' => 'Mike Shinoda', 'profile_img' => 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/275478_100002977900608_1522924766_q.jpg');
		$lunch_buddy_list[] = array('name' => 'Chris Kalani', 'profile_img' => 'http://profile.ak.fbcdn.net/hprofile-ak-ash2/276072_506749663_2438631_q.jpg');
		$lunch_buddy_list[] = array('name' => 'Robert Scoble', 'profile_img' => 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/174530_501319654_5423543_q.jpg');
		$lunch_buddy_list[] = array('name' => 'Julie Zhuo', 'profile_img' => 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/49138_206186_1910_q.jpg');

		$this -> data['lunch_buddy_list'] = $lunch_buddy_list;

		$activity_list[] = array('message' => "&lt;User&gt; had lunch with &lt;User2&gt;. ", 'created_on' => time());
		$activity_list[] = array('message' => "&lt;User&gt; had lunch with &lt;User2&gt;. ", 'created_on' => time());
		$this -> data['activity_list'] = $activity_list;

		// Initialize
		if ($this -> session -> userdata('linkedin_pulled') == NULL) {
			$this -> session -> set_userdata('linkedin_pulled', $this -> linkedin_model -> selectLinkedInDataForCurrentUser() != NULL);
		}
		$external_data['linkedin'] = $this -> linkedin_model -> selectLinkedInDataForCurrentUser();
		$this -> data['external_data'] = $external_data;
		
		// Render views
		$this -> data['tpl_page_id'] = 'profile';
		$this -> data['main_content'] = 'user/user_profile';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function sync() {

		redirect('settings/sync', 'refresh');

	}
	
	function preferences() {
		
		if ($this -> alt == 'json') {
			
			$this -> _preferences_json();
			
		} else {
			
			$results = $this -> preferences_model -> selectForCurrentUser();
			$this -> data['preferences'] =  json_encode($results);
			$this -> data['networking'] =  $results;
			$this -> data['career'] =  $results;
			$this -> data['offer'] =  $results;
			
			// Render views
			$this -> data['tpl_page_id'] = 'preferences';
			$this -> data['main_content'] = 'user/preferences';
			$this -> load -> view('includes/tmpl_layout', $this -> data);
		}
		
	}

	function _preferences_json() {
		
		$preferences_ref_id = isset($_REQUEST['preferences_ref_id']) ? $_REQUEST['preferences_ref_id'] : '';
		$tag_value = isset($_REQUEST['tag_value']) ? $_REQUEST['tag_value'] : '';
		
		//$this -> request_method = 'POST';
		
		$data = 'Some file data';

		Logger::log($data);
		
		switch ($this -> request_method) {
			case 'GET' : 
				$results = $this -> preferences_model -> selectForCurrentUser();
				break;
			case 'POST' :
				if ($tag_value) {
					$results = $this -> preferences_model -> insertForCurrentUser($preferences_ref_id, $tag_value);
				} else {
					$results = $this -> preferences_model -> selectForCurrentUser_byPreferencesRefId($preferences_ref_id);
				}
				break;
			case 'DELETE' :
				$results = $this -> preferences_model -> deleteForCurrentUser();
				break;
			default :
				$results = 'error';
		}
		
			//var_dump($results);
			//die();
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
		//header('Cache-Control: no-cache, must-revalidate');
		//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		//header('Content-type: application/json');
		
		
		if ($this -> callback) {
			$json_result['completed_in'] =  number_format(time() - $this -> start_time, 3, '.', '');
			$json_result['results'][] = $results;
			print_r($this -> callback. '('.json_encode($json_result) .')');
		} else {
			$json_result = $results;
			print_r(json_encode($json_result));
		}
		
	}

}
?>
