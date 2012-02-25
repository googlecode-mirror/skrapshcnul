<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this -> load -> database();
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('input');
		$this -> load -> library('ls_events');
		$this -> load -> library('statistics/v1/users_stats');
		$this -> load -> model('page_steps_completed_model');
		$this -> load -> model('schedules_model');
		$this -> load -> model('events_model');
		$this -> load -> helper('logger');

		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> data['is_logged_in_admin'] = $this -> ion_auth -> is_admin();

		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$this -> user_id = $this -> session -> userdata('user_id');
	}

	function index() {
		
		$results_highchartsJS = $this -> users_stats -> totalUsers();
		
		## Format Data For HighchartsJS
		$this->data['user_statistics'] = $results_highchartsJS;
		
		// Render view data
		$this -> data['head_title']		= 'Users Statistic'; 
		$this -> data['tpl_page_id']	= 'stat_users#index';
		$this -> data['tpl_page_title'] = "Users Statistic";
		// Render views
		$this -> data['main_content'] = 'base/statistics/users';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}
}
?>
