<?php

/**
 * System Administrative Page
 */
class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('form_validation');
		$this -> load -> library('input');
		$this -> load -> library('ion_auth');
		$this -> load -> library('ls_events');
		$this -> load -> library('session');
		$this -> load -> library('pagination');
		$this -> load -> database();
		$this -> load -> helper('url');
		$this -> load -> helper('form');
		$this -> load -> model('events_model');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> data['is_logged_in_admin'] = $this -> ion_auth -> is_admin();

		if (!$this -> data['is_logged_in_admin']) {
			redirect('404');
		}

		$this -> is_pagination = isset($_REQUEST['pagination']) ? $_REQUEST['pagination'] : '1';
		$this -> pagination -> offset = isset($_REQUEST['per_page']) ? $_REQUEST['per_page'] : 0;
		$this -> order_by = isset($_REQUEST['order_by']) ? $_REQUEST['order_by'] : "";

		// Create pagination links
		$this -> data['pagination_links'] = $this -> pagination -> create_links();
	}

	function index($value = '') {

		// Render views data
		$this -> data['head_title'] = 'Admin | Lunchsparks';
		$this -> data['tpl_page_id'] = "overview";
		$this -> data['tpl_page_title'] = "Account Overview";
		// Render views
		$this -> data['main_content'] = 'admin/index';
		$this -> load -> view('includes/tmpl_admin', $this -> data);
	}

	function users($value = '') {

		$this -> data['results']['total_records'] = $this -> db -> count_all_results('lss_users');

		$config['base_url'] = site_url('admin/dashboard/users') . "?pagination=1";
		$config['total_rows'] = $this -> data['results']['total_records'];
		$config['per_page'] = 30;
		$config['enable_query_strings'] = TRUE;
		$config['page_query_string'] = TRUE;
		$this -> pagination -> initialize($config);

		// Retrieve paginated results, using the dynamically determined offset
		$this -> db -> limit($config['per_page'], $this -> pagination -> offset);
		$this -> db -> select('id AS user_id, email, created_on, last_login, active, alias, firstname, lastname, profile_img, lunchsparks');
		$this -> db -> from('lss_users AS lu');
		$this -> db -> join('lss_users_profile AS lup', 'lup.user_id = lu.id');
		$this -> db -> join('lss_users_profile_social_links AS lupsl', 'lupsl.user_id = lu.id');
		if (!empty($this -> order_by)) {
			$this -> db -> order_by($this -> order_by, "asc");
		} else {
			$this -> db -> order_by('user_id', "asc");
		}
		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			$this -> data['results']['users'] = $query -> result();
		} else {
			$this -> data['results']['users'] = array();
		}

		// Render views data
		$this -> data['head_title'] = 'Admin | Lunchsparks';
		$this -> data['tpl_page_id'] = "users";
		$this -> data['tpl_page_title'] = "Users Overview";
		// Render views
		$this -> data['main_content'] = 'admin/users';
		$this -> load -> view('includes/tmpl_admin', $this -> data);
	}

	function users_invites() {

		$this -> data['results']['total_records'] = $this -> db -> count_all_results('lss_users_invitations');

		$config['base_url'] = site_url('admin/dashboard/users_invites') . "?pagination=1";
		$config['total_rows'] = $this -> data['results']['total_records'];
		$config['per_page'] = 30;
		$config['enable_query_strings'] = TRUE;
		$config['page_query_string'] = TRUE;
		$this -> pagination -> initialize($config);

		// Retrieve paginated results, using the dynamically determined offset
		$this -> db -> limit($config['per_page'], $this -> pagination -> offset);
		$this -> db -> select('*');
		$this -> db -> from('lss_users_invitations AS lui');
		$this -> db -> join('lss_users_profile AS lup', 'lup.user_id = lui.user_id');
		$this -> db -> join('lss_users_profile_social_links AS lupsl', 'lupsl.user_id = lui.user_id');
		if (!empty($this -> order_by)) {
			$this -> db -> order_by($this -> order_by, "asc");
		} else {
			$this -> db -> order_by('lui.user_id', "asc");
		}
		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			$this -> data['results']['users'] = $query -> result();
		} else {
			$this -> data['results']['users'] = array();
		}

		// Render views data
		$this -> data['head_title'] = 'Admin | Lunchsparks';
		$this -> data['tpl_page_id'] = "users_invites";
		$this -> data['tpl_page_title'] = "Users Invite Overview";
		// Render views
		$this -> data['main_content'] = 'admin/users_invites';
		$this -> load -> view('includes/tmpl_admin', $this -> data);
	}

	function preferences() {

		$this -> data['results']['total_records'] = $this -> db -> count_all_results('lss_global_preferences');

		$config['base_url'] = site_url('admin/dashboard/users_invites') . "?pagination=1";
		$config['total_rows'] = $this -> data['results']['total_records'];
		$config['per_page'] = 30;
		$config['enable_query_strings'] = TRUE;
		$config['page_query_string'] = TRUE;
		$this -> pagination -> initialize($config);

		// Retrieve paginated results, using the dynamically determined offset
		$this -> db -> limit($config['per_page'], $this -> pagination -> offset);
		$this -> db -> select('*');
		$this -> db -> from('lss_global_preferences');
		if (!empty($this -> order_by)) {
			$this -> db -> order_by($this -> order_by, "asc");
		} else {
			$this -> db -> order_by('count', "desc");
		}
		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			$this -> data['results']['preferences'] = $query -> result();
		} else {
			$this -> data['results']['preferences'] = array();
		}

		// Render views data
		$this -> data['head_title'] = 'Admin | Lunchsparks';
		$this -> data['tpl_page_id'] = "preferences";
		$this -> data['tpl_page_title'] = "Preferences Overview";
		// Render views
		$this -> data['main_content'] = 'admin/preferences';
		$this -> load -> view('includes/tmpl_admin', $this -> data);

	}

	function recommendations() {
		
		if ($this -> input -> post()) {
			$fields['user_name'] = $this -> input -> post('user_name');
			$fields['user_id'] = $this -> input -> post('user_id');
			$fields['target_user_name'] = $this -> input -> post('target_user_name');
			$fields['target_user_id'] = $this -> input -> post('target_user_id');
			$fields['reason'] = $this -> input -> post('reason');
			## TODO 
			## Save to DB
		}
		
		$this -> data['results']['recommendations_count'] = $this -> events_model -> getUserEventSuggestion_count();
		$this -> data['results']['recommendations'] = $this -> events_model -> getUserEventSuggestion_all_by_page();

		$this -> data['results']['past_recommendations_count'] = $this -> events_model -> getPastUserEventSuggestion_count();
		$this -> data['results']['past_recommendations'] = $this -> events_model -> getPastUserEventSuggestions_all_by_page();

		// Render views data
		$this -> data['head_title'] = 'Recommendations | Lunchsparks';
		$this -> data['tpl_page_id'] = "recommendations";
		$this -> data['tpl_page_title'] = "Recommendations Overview";
		// Render views
		$this -> data['main_content'] = 'admin/recommendations/overview';
		$this -> load -> view('includes/tmpl_admin', $this -> data);

	}

	function events() {
		
		if ($this -> input -> post()) {
			$fields['user_name'] = $this -> input -> post('user_name');
			$fields['user_id'] = $this -> input -> post('user_id');
			$fields['target_user_name'] = $this -> input -> post('target_user_name');
			$fields['target_user_id'] = $this -> input -> post('target_user_id');
			$fields['reason'] = $this -> input -> post('reason');
			## TODO 
			## Save to DB
		}
		
		$this -> data['results']['events_upcoming'] = $this -> ls_events -> getAllUpcomingEvents();
		$this -> data['results']['events_upcoming_count'] = count($this -> data['results']['events_upcoming']);
		
		$this -> data['results']['events_past'] = $this -> ls_events -> getAllPastEvents();
		$this -> data['results']['events_past_count'] = count($this -> data['results']['events_past']);
		
		// Render views data
		$this -> data['head_title'] = 'Events Overview | Lunchsparks';
		$this -> data['tpl_page_id'] = "events";
		$this -> data['tpl_page_title'] = "Events Overview";
		// Render views
		$this -> data['main_content'] = 'admin/events/overview';
		$this -> load -> view('includes/tmpl_admin', $this -> data);
		
	}
	
	function survey() {
		
		if ($this -> input -> post()) {
			$fields['user_name'] = $this -> input -> post('user_name');
			$fields['user_id'] = $this -> input -> post('user_id');
			$fields['target_user_name'] = $this -> input -> post('target_user_name');
			$fields['target_user_id'] = $this -> input -> post('target_user_id');
			$fields['reason'] = $this -> input -> post('reason');
			## TODO 
			## Save to DB
		}
		
		$this -> data['results']['recommendations_count'] = $this -> events_model -> getUserEventSuggestion_count();
		$this -> data['results']['recommendations'] = $this -> events_model -> getUserEventSuggestion_all_by_page();

		$this -> data['results']['past_recommendations_count'] = $this -> events_model -> getPastUserEventSuggestion_count();
		$this -> data['results']['past_recommendations'] = $this -> events_model -> getPastUserEventSuggestions_all_by_page();

		// Render views data
		$this -> data['head_title'] = 'Survey Overview | Lunchsparks';
		$this -> data['tpl_page_id'] = "survey";
		$this -> data['tpl_page_title'] = "Survey Overview";
		// Render views
		$this -> data['main_content'] = 'admin/survey/overview';
		$this -> load -> view('includes/tmpl_admin', $this -> data);
		
	}

}
?>