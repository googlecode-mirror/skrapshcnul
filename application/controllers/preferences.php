<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Preferences extends CI_Controller {

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
		$this -> load -> library('form_validation');
		$this -> load -> library('input');
		$this -> load -> library('ion_auth');
		$this -> load -> library('ls_profile');
		$this -> load -> library('ls_preferences');
		$this -> load -> library('session');
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
		
		$this -> data['preferences'] = $this -> ls_preferences -> selectForCurrentUser();
		
		// Render view data
		$this -> data['head_title']		= 'Preferences | Lunchsparks'; 
		$this -> data['tpl_page_id']	= 'user#preferences';
		$this -> data['tpl_page_title'] = "Preference Settings";
		// Render views
		$this -> data['main_content'] = 'base/preferences/index';
		$this -> load -> view('includes/tmpl_layout_withGuides', $this -> data);
		
	}
	
}
?>
