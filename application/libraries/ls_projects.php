<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Name:		Projects Library
 * Author:		@stiucsib86
 * Created:		11.09.2011
 * Description:
 * Requirements: PHP5 or above
 */
class Ls_Projects {

	function __construct() {

		$this -> ci = &get_instance();
		$this -> ci -> load -> config('linkedin_oauth', TRUE);
		$this -> ci -> load -> config('users', TRUE);
		$this -> ci -> load -> library('form_validation');
		$this -> ci -> load -> library('input');
		$this -> ci -> load -> library('ion_auth');
		$this -> ci -> load -> library('ls_profile');
		$this -> ci -> load -> library('session');
		$this -> ci -> load -> model('projects_model');

		// Set Config
		$this -> component_class = $this -> ci -> config -> item('component_class', 'ls_notifications');
		//auto-login the user if they are remembered
		if (!$this -> ci -> ion_auth -> logged_in() && get_cookie('identity') && get_cookie('remember_code')) {
			$this -> ci -> ion_auth = $this;
			$this -> ci -> ion_auth_model -> login_remembered_user();
		}
		$this -> ci -> ion_auth_model -> trigger_events('library_constructor');
		
		// Set Global Variables
		$this -> data['is_logged_in_admin'] = $this -> ci -> ion_auth -> is_admin();
		$this -> user_id = $this -> ci -> session -> userdata('user_id');
	}

	function select_project($fields = FALSE) {

		if (!$fields) {
			return FALSE;
		}

		if (!$fields['projects_id']) {
			return FALSE;
		}

		$results = array();
		$results = $this -> ci -> projects_model -> select_project($fields['projects_id']);
		$results['apps'] = $this -> ci -> projects_model -> select_project_apps($fields['projects_id']);
		$results['external_urls'] = $this -> ci -> projects_model -> select_project_external_url($fields['projects_id']);
		$results['screenshots'] = $this -> ci -> projects_model -> select_project_screenshots($fields['projects_id']);
		$results['tags'] = $this -> ci -> projects_model -> select_project_tags($fields['projects_id']);
		$results['team_members'] = $this -> ci -> projects_model -> select_project_team_member($fields['projects_id']);
		$results['verified_status'] = $this -> ci -> projects_model -> select_project_verification($fields['projects_id']);

		## TODO
		## Dummy Data - statistics
		$results['statistics']['followers'] = 0;
		$results['statistics']['favourite'] = 0;

		if (isset($results['created_by']) && is_numeric($results['created_by'])) {
			$results['created_by'] = $this -> ci -> ls_profile -> getPublicProfile($results['created_by']);
		}
		foreach ($results['team_members'] as $key => $value) {
			if ($user_id = $value['user_id'] && is_numeric($value['user_id'])) {
				$results['team_members'][$key]['pub_profile'] = $this -> ci -> ls_profile -> getPublicProfile($value['user_id']);
			}
		}

		//$results['statistics'] = $this -> ci -> projects_model -> select_project_statistic($fields['projects_id']);

		return $results;

	}

	function selectProjects_all() {

		$results = $this -> ci -> projects_model -> selectProjects_all();

		return $results;
	}

	function insert_project($fields = FALSE) {

		if (!$fields) {
			return FALSE;
		}

		$fields['created_by'] = $this -> user_id;

		return $result = $this -> ci -> projects_model -> insertProject($fields);
	}

	function update_project($fields = FALSE) {

		if (!isset($fields['project_id'])) {
			return FALSE;
		}

		if (isset($fields['tags_type_id']) && isset($fields['tags_data'])) {
			$result = $this -> ci -> projects_model -> update_project_tags($fields);
		}
		## TODO Update function for other fields.

		return $result;
	}

	function search_projects($keywords = FALSE) {

		if (!$keywords) {
			return FALSE;
		}

		return $this -> ci -> places_model -> searchPlace($keywords);

	}

	function insertProjects_test_data() {

		return $this -> ci -> projects_model -> insert_projects_test_data();

	}
	
	function has_edit_permission($project = FALSE) {
		
		if (!$project) { return FALSE; }
		if (isset($project['created_by']) && $project['created_by'] == $this -> user_id) {
			return TRUE;
		}
		
		if (isset($project['created_by']['id']) && $project['created_by']['id'] == $this -> user_id) {
			return TRUE;
		}
		if (isset($this -> data['is_logged_in_admin']) && $this -> data['is_logged_in_admin']) {
			return TRUE;
		}
	}

}
?>