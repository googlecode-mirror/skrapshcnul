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
		$this -> load -> library('ls_survey');
		$this -> load -> model('page_steps_completed_model');
		$this -> load -> model('schedules_model');			
		
		//$this -> config -> load('facebook_oauth');

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
		//e.g www.lunchsparks.me/survey?event_id=7		
		$event_id = $this -> input -> get('event_id');
		$this -> data['main_content'] = 'survey/index';
		$this -> data['info'] = $this -> ls_survey -> prepareDataForSurvey($this -> user_id, $event_id);
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function receive_survey() {
		print_r($_POST);
		$this -> survey -> insertSurveyData($_POST);
	}
	
	// for testing
	function generate_test_data() {		
		$this -> restaurant_model -> clearRestaurants();
		$obj = array('name' => 'The White Rabbit', 'location' => '39C Harding Road');
		$this -> restaurant_model -> insertRestaurant($obj);
		$obj = array('name' => 'The Brown Rabbit', 'location' => '1 Orchard Road');
		$this -> restaurant_model -> insertRestaurant($obj);
	}
}
?>
