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
		$this -> data['is_logged_in_admin'] = $this -> ion_auth -> is_admin();

		// Check if user is logged in
		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$this -> data['user_id'] = $this -> user_id = $this -> session -> userdata('user_id');

		$this -> data['steps_completed'] = $this -> page_steps_completed_model -> select($this -> user_id);

		// Request Params: alt = json | ,
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';

		$this -> start_time = time();
	}

	function index() {
		//e.g /survey/?event_id=7

		$event_id = $this -> input -> get('event_id');
		if (!is_numeric($event_id) && !$event_id) {
			redirect('404');
		}

		$this -> data['event_info'] = $this -> ls_survey -> prepareDataForSurvey($this -> user_id, $event_id);

		// Render view data
		$this -> data['head_title'] = 'Survey | Lunchsparks';
		$this -> data['tpl_page_id'] = 'survey#index';
		$this -> data['tpl_page_title'] = "Survey";
		// Render views
		$this -> data['main_content'] = 'base/survey/index';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function event() {
		//e.g /survey/event_id/7

		$event_id = $this -> input -> get('event_id');
		$this -> data['info'] = $this -> ls_survey -> prepareDataForSurvey($this -> user_id, $event_id);

		// Render view data
		$this -> data['head_title'] = 'Survey | Lunchsparks';
		$this -> data['tpl_page_id'] = 'survey#index';
		$this -> data['tpl_page_title'] = "Survey";
		// Render views
		$this -> data['main_content'] = 'base/survey/index';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function save() {
		//var_dump($_POST);
		
		$event_id = $this->input->post('event_id');
		$user_id = $this->input->post('user_id');
		
		$restaurant_id = $this->input->post('restaurant_id');
		$restaurant_point = $this->input->post('restaurant_point');
		$restaurant_review = $this->input->post('restaurant_review');
		
		$target_ids = $this->input->post('target_id');
		$target_reviews = $this->input->post('target_review');
		$target_points = $this->input->post('target_points');
		
		## ---------------
		## TODO data check
		## ---------------
		
		## Prepare Data To Store
		$this -> data['event_id'] = $event_id;
		$this -> data['user_id'] = $user_id;
		
		$feedback_to_restaurant = array();
		$feedback_to_restaurant['event_id'] = $event_id;
		$feedback_to_restaurant['user_id'] = $user_id;
		$feedback_to_restaurant['restaurant_id'] = $restaurant_id;
		$feedback_to_restaurant['restaurant_point'] = $restaurant_point;
		$feedback_to_restaurant['restaurant_review'] = $restaurant_review;
		$this -> data['feedback_to_restaurant'] = $feedback_to_restaurant;
		
		$this -> data['feedback_to_users'] = array();
		foreach ($target_ids as $key => $target_id) {
			$array = array();
			$array['event_id'] = $event_id;
			$array['user_id'] = $user_id;
			$array['target_id'] = $target_id;
			$array['target_review'] = $target_reviews[$key];
			$array['target_point'] = $target_points[$key];
			$this -> data['feedback_to_users'][] = $array;
		}
		
		var_dump($this -> data);
		
		$this -> ls_survey -> insertFeedback($this -> data);
		$result = $this -> ls_survey -> getCompletedSurvey($event_id, $user_id);

	}

	// for testing
	function generate_test_data() {
		$this -> places_model -> clearPlaces();
		$obj = array('name' => 'The White Rabbit', 'location' => '39C Harding Road');
		$this -> places_model -> insertPlace($obj);
		$obj = array('name' => 'The Brown Rabbit', 'location' => '1 Orchard Road');
		$this -> places_model -> insertPlace($obj);
	}

}
?>
