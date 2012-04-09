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

	function select_project($fields = FALSE, $options = FALSE) {

		if (!$fields) {
			return FALSE;
		}

		if (!$fields['project_id']) {
			return FALSE;
		}
		
		$results = array();
		if (isset($options['simple']) && $options['simple']) {
			$results = $this -> ci -> projects_model -> select_project($fields['project_id']);
			$results['external_urls'] = $this -> ci -> projects_model -> select_project_external_url($fields['project_id']);
			$results['tags'] = $this -> ci -> projects_model -> select_project_tags($fields['project_id']);
			$results['team_members'] = $this -> ci -> projects_model -> select_project_team_member($fields['project_id']);
		} else {
			$results = $this -> ci -> projects_model -> select_project($fields['project_id']);
			$results['apps'] = $this -> ci -> projects_model -> select_project_apps($fields['project_id']);
			$results['external_urls'] = $this -> ci -> projects_model -> select_project_external_url($fields['project_id']);
			$results['screenshots'] = $this -> ci -> projects_model -> select_project_screenshots($fields['project_id']);
			$results['tags'] = $this -> ci -> projects_model -> select_project_tags($fields['project_id']);
			$results['team_members'] = $this -> ci -> projects_model -> select_project_team_member($fields['project_id']);
			$results['verified_status'] = $this -> ci -> projects_model -> select_project_verification($fields['project_id']);
		}

		## TODO
		## Dummy Data - statistics
		$results['statistics']['followers'] = 0;
		$results['statistics']['favourites'] = 0;
		
		## Data Default Value
		$results = $this -> _set_default_values($results, $options);
		
		## Privacy and Permission
		
		if (isset($results['created_by']) && is_numeric($results['created_by'])) {
			$results['created_by'] = $this -> ci -> ls_profile -> getPublicProfile($results['created_by']);
		}
		
		if (isset($results['team_members']) && is_array($results['team_members'])) {
			foreach ($results['team_members'] as $key => $value) {
				if ($user_id = $value['user_id'] && is_numeric($value['user_id'])) {
					$results['team_members'][$key]['pub_profile'] = $this -> ci -> ls_profile -> getPublicProfile($value['user_id']);
				}
			}
		}
		//$results['statistics'] = $this -> ci -> projects_model -> select_project_statistic($fields['projects_id']);

		return $results;

	}
	
	function select_all_projects($fields = FALSE, $options = FALSE) {
		
		## ---------- Pagination ----------
		if (!isset($options['offset'])) {
			$options['offset'] = 0;
		}
		if (!isset($options['row_count'])) {
			$options['row_count'] = 30;
		}
		if (isset($options['page'])) {
			if (!isset($options['offset'])) {
				$options['offset'] = ($options['page'] - 1) * $options['row_count'];
			}
		}
		if (isset($options['count_all_results']) && $options['count_all_results']) {
			return $this -> ci -> projects_model -> select_all_projects($fields, $options);
		}
		## ---------- [END] Pagination ----------
		
		$results = $this -> ci -> projects_model -> select_all_projects($fields, $options);
		
		if (is_array($results)) {
			foreach ($results as $key => $project) {
				$param['project_id'] = $project['project_id'];
				$options['simple'] = TRUE;
				$results[$key] = $this -> select_project($param, $options);
				
				## Data Default Value
				$results[$key] = $this -> _set_default_values($results[$key], $options);
			}
		}
		
		return $results;
	}

	function insert_project($fields = FALSE) {

		if (!$fields) {
			return FALSE;
		}

		$fields['created_by'] = $this -> user_id;
		$fields['user_id'] = $this -> user_id;

		return $result = $this -> ci -> projects_model -> insertProject($fields);
	}

	function update_project($fields = FALSE) {

		if (!isset($fields['project_id'])) {
			return FALSE;
		}
		
		if (isset($fields['name']) || isset($fields['description']) || isset($fields['logo']) || isset($fields['cover_img'])) {
			$result = $this -> ci -> projects_model -> update_project($fields);
		}
		if (isset($fields['ios_app_store_url']) || isset($fields['android_market_url']) || isset($fields['wp_market_url'])) {
			$result = $this -> ci -> projects_model -> update_project_apps($fields);
		}
		if (isset($fields['homepage']) || isset($fields['github_url']) || isset($fields['facebook_url']) || isset($fields['twitter_url']) || isset($fields['gplus_url'])) {
			$result = $this -> ci -> projects_model -> update_project_xurl($fields);
		}
		if (isset($fields['src']) || isset($fields['is_external']) || isset($fields['screenshot_details'])) {
			$result = $this -> ci -> projects_model -> update_project_screenshots($fields);
		}
		if (isset($fields['tags_type_id']) && isset($fields['tags_data'])) {
			$result = $this -> ci -> projects_model -> update_project_tags($fields);
		}
		if (isset($fields['date_joined']) || isset($fields['date_leaved'])) {
			$result = $this -> ci -> projects_model -> update_project_team_member($fields);
		}
		if (isset($fields['status']) || isset($fields['remarks']) || isset($fields['updated_by'])) {
			$result = $this -> ci -> projects_model -> update_project_verification($fields);
		}
		
		return $result;
	}

	function insert_project_team_member($fields = FALSE, $options = FALSE) {
		
		if (!isset($fields['project_id'])) {
			return FALSE;
		}
		
		if (!isset($fields['user_id'])) {
			return FALSE;
		}
		
		$result = $this -> ci -> projects_model -> insert_project_team_member($fields);
		
		return $result;
		
	}
	
	function remove_project_team_member($fields = FALSE, $options = FALSE) {
		
		if (!isset($fields['project_id'])) {
			return FALSE;
		}
		
		if (!isset($fields['user_id'])) {
			return FALSE;
		}
		
		$result = $this -> ci -> projects_model -> remove_project_team_member($fields);
		
		return $result;
		
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
	
	protected function _set_default_values($results, $options) {
		
		## Data Default Value
		if (!isset($results['cover_img']) || !@getimagesize ($results['cover_img'])) {
			$results['cover_img'] = base_url() . '/skin/images/bg/world6-equirectangular.jpg';
		}
	
		if (!isset($results['logo']) || !@getimagesize($results['logo'])) {
			$results['logo'] = base_url() . '/skin/images/svgs/question.svg';
		}
		
		return $results;
	} 

}
?>