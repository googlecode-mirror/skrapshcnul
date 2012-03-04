<?php

/**
 * Projects Page
 */
class Projects extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('email');
		$this -> load -> library('form_validation');
		$this -> load -> library('input');
		$this -> load -> library('ion_auth');
		$this -> load -> library('ls_projects');
		$this -> load -> library('session');
		$this -> load -> database();
		$this -> load -> helper('url');
		$this -> load -> model('invitation_model');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> data['is_logged_in_admin'] = $this -> ion_auth -> is_admin();
		$this -> session -> set_flashdata('system_message', '');

		// Initialize
		if (!$this -> data['is_logged_in']) {
			// Not Logged in? Redirect them back to login page.
			redirect('login', 'refresh');
		}

		$this -> user_id = $this -> session -> userdata('user_id');

	}
	
	/**
	 * Remap 
	 */
	function _remap($method) {
		switch($method) {
			case 'edit' :
				$this -> edit();
				break;
			case 'add' :
				$this -> add();
				break;
			case 'insert_test_data' :
				$this -> insert_test_data();
				break;
			default :
				$this -> index();
		}
	}
	
	function index($value = FALSE) {

		$projects_id = $this -> uri -> segment(2);

		## TODO
		## If Projects_id is numeric, check for id,
		## else, try to search for Projects name.

		if (!is_numeric($projects_id)) {
			return $this -> listing();
		}
		
		$this -> data['project'] = $this -> ls_projects -> select_project($projects_id);
		if ($this -> ls_projects -> has_edit_permission($this -> data['project'])) {
			$this -> data['has_edit_permission'] = TRUE;
		}
		
		// Render view data
		$this -> data['head_title'] = 'Places | Lunchsparks';
		$this -> data['tpl_page_id'] = 'places#index';
		$this -> data['tpl_page_title'] = "Places";
		// Render views
		$this -> data['main_content'] = 'base/projects/index';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}
	
	function listing() {
		
		redirect('404');
		
		// Render view data
		$this -> data['head_title'] = 'Projects Listing | Lunchsparks';
		$this -> data['tpl_page_id'] = 'projects#index';
		$this -> data['tpl_page_title'] = "Projects";
		// Render views
		$this -> data['main_content'] = 'base/projects/listing';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
		
	}

	function add() {

		$fields = ($this -> input -> post());
		if ($fields && (sizeof($fields) > 1)) {
			$project_id = $this -> ls_projects -> insert_project($fields);
			if ($project_id) {
				redirect('/projects/' . $project_id);
			};
		}

		// Render view data
		$this -> data['head_title'] = 'Projects | Lunchsparks';
		$this -> data['tpl_page_id'] = 'projects#add';
		$this -> data['tpl_page_title'] = "Add New Project";
		// Render views
		$this -> data['main_content'] = 'base/projects/add';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function edit($value = FALSE) {

		$projects_id = $this -> uri -> segment(3);

		if (!is_numeric($projects_id)) {
			return FALSE;
		}

		$this -> data['project'] = $this -> ls_projects -> select_project($projects_id);

		// Render view data
		$this -> data['head_title'] = 'Places | Lunchsparks';
		$this -> data['tpl_page_id'] = 'places#edit';
		$this -> data['tpl_page_title'] = "Edit Places";
		// Render views
		$this -> data['main_content'] = 'base/projects/edit';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}
	
	function insert_test_data() {
		
		echo $this-> ls_projects -> insertProjects_test_data();
		
	}

}
?>