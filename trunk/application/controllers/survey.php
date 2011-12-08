<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Survey extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this -> load -> database();
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('input');
		$this -> load -> model('page_steps_completed_model');
		$this -> load -> model('schedules_model');
		$this -> load -> helper('facebook/facebook');
		$this -> config -> load('facebook_oauth');

		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> data['is_logged_in_admin'] = $this->ion_auth->is_admin();
			
		// Check if user is logged in
		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		
		$this->user_id = $this -> session -> userdata('user_id');
		
		$this->data['steps_completed'] = $this -> page_steps_completed_model -> select($this->user_id);
		
		// Request Params: alt = json | , 
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';
		
		$this -> start_time = time();
	}

	function index() {
		$this -> data['main_content'] = 'survey/index';		
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}
	
	function suggest() {
		$this -> data['main_content'] = 'survey/fb_friends';
		$this -> load -> view('includes/tmpl_layout', $this -> data);	
	}
}
?>
