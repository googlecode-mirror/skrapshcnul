<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Events extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this -> load -> database();
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('input');
		$this -> load -> library('ls_events');
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

		$this -> data['steps_completed'] = $this -> page_steps_completed_model -> select($this -> user_id);

	}

	function index() {
		
		$this -> data['events']['suggestions'] = ($this -> ls_events -> getUserEventMatched($this -> user_id));
		$this -> data['events']['past_events'] = ($this -> ls_events -> getUserEvent_past($this -> user_id));
		$this -> data['events']['auto_recommendation'] = ($this -> ls_events -> getUserEventSuggestion($this -> user_id));
		
		// Render view data
		$this -> data['head_title']		= 'Events'; 
		$this -> data['tpl_page_id']	= 'Events#index';
		$this -> data['tpl_page_title'] = "Events";
		// Render views
		$this -> data['main_content'] = 'base/events/index';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function upcoming() {
		
		$this -> data['events']['suggestions'] = ($this -> ls_events -> getUserEventMatched($this -> user_id));
		
		// Render views data
		$this -> data['head_title'] = 'Upcoming Events | Lunchsparks';
		$this -> data['tpl_page_id'] = "upcoming";
		$this -> data['tpl_page_title'] = "Upcoming Events";

		$this -> data['main_content'] = 'events/upcoming';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function past() {

		$this -> data['events']['past_events'] = ($this -> ls_events -> getUserEvent_past($this -> user_id));
		
		// Render views data
		$this -> data['head_title'] = 'Past Events | Lunchsparks';
		$this -> data['tpl_page_id'] = "past";
		$this -> data['tpl_page_title'] = "Past Events";

		$this -> data['main_content'] = 'events/past';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function suggestions() {
		
		$this -> data['events']['auto_recommendation'] = ($this -> ls_events -> getUserEventSuggestion($this -> user_id));
		
		// Render views data
		$this -> data['head_title'] = 'Suggestion | Lunchsparks';
		$this -> data['tpl_page_id'] = 'suggestions';
		$this -> data['tpl_page_title'] = "Suggestion";

		$this -> data['main_content'] = 'base/events/suggestions';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function insert() {
		$result = $this -> schedules_model -> insertPickForCurrentUser($this -> input -> post("date"), $this -> input -> post("time"), $this -> input -> post("center_lat"), $this -> input -> post("center_lng"), $this -> input -> post("radius"));
		echo $result;
	}

	function select() {
		$result = $this -> schedules_model -> selectPickForCurrentUser();
		print_r(json_encode($result -> result()));
	}

	function delete() {
		$result = $this -> schedules_model -> deletePickForCurrentUser($this -> input -> post("index"));
		echo $result;
	}

}
?>
