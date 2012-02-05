<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Synchronize extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> config('linkedin_oauth', TRUE);
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> helper('logger');
		$this -> load -> helper('url');
		$this -> load -> helper('linkedin/linkedin_api');
		$this -> load -> model('linkedin/linkedin_model');
		$this -> load -> model('page_steps_completed_model');
		$this -> load -> model('user_profile_model');
		$this -> load -> model('user_settings_model');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> data['is_logged_in_admin'] = $this->ion_auth->is_admin();
		$this -> session -> set_flashdata('system_message', '');

		if (!$this -> ion_auth -> logged_in()) {
			// Not Logged in? Redirect them back to login page.
			redirect('login', 'refresh');
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

	function index($value = '') {
		switch($this->uri->segment(3)) {
			case 'pullLinkedInData' :
				$this -> pullLinkedInData();
		}

		$external_data['linkedin'] = $this -> linkedin_model -> selectLinkedInDataForCurrentUser();
		$this -> data['external_data'] = $external_data;

		// Tpl setup
		$this -> data['tpl_page_id'] = "sync";
		$this -> data['tpl_page_title'] = "Synchronize";

		// Render view
		$this -> data['main_content'] = 'base/synchronize/index';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}
}
