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
		$this -> load -> model('recs_model');
		$this -> load -> model('restaurant_model');
		$this -> load -> model('survey_model');
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

	function receive_survey() {
		print_r($_POST);
		$this -> survey_model -> insertSurveyData($_POST);
	}
	
	// for testing
	function generate_test_data() {
		$this -> recs_model -> clearAutoRecs();
		$this -> recs_model -> clearSuccessfulRecs();
		$this -> recs_model -> clearTimeLocations();
		$this -> restaurant_model -> clearRestaurants();
		
		$obj = array('user_id' => 1, 'rec_id' => 6, 'rec_reason' => 'This guy is funny.');
		$this -> recs_model -> insertAutoRec($obj);
		
		$obj = array('user_id' => 6, 'rec_id' => 1, 'rec_reason' => 'Awesome guy.');
		$this -> recs_model -> insertAutoRec($obj);
		
		$obj = array('user_id' => 2, 'rec_id' => 3, 'rec_reason' => 'Awesome guy.');
		$this -> recs_model -> insertAutoRec($obj);
		
		$obj = array('user_id' => 3, 'rec_id' => 2, 'rec_reason' => 'Awesome guy.');
		$this -> recs_model -> insertAutoRec($obj);
		
		$this -> recs_model -> insertSuccessfulRec(1);
		$this -> recs_model -> insertSuccessfulRec(2);
		
		$obj = array('index' => 1, 'date' => '2010-12-25', 'time' => '10:00:00', 'restaurant_id' => 1);
		$this -> recs_model -> insertTimeLocation($obj);
				
		$obj = array('index' => 2, 'date' => '2010-12-25', 'time' => '10:00:00', 'restaurant_id' => 1);
		$this -> recs_model -> insertTimeLocation($obj);
		
		$obj = array('name' => 'The White Rabbit', 'location' => '39C Harding Road');
		$this -> restaurant_model -> insertRestaurant($obj);
		$obj = array('name' => 'The Brown Rabbit', 'location' => '1 Orchard Road');
		$this -> restaurant_model -> insertRestaurant($obj);
	}
}
?>
