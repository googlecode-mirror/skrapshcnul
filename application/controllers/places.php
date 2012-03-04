<?php

/**
 * System Administrative Page
 */
class Places extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('email');
		$this -> load -> library('form_validation');
		$this -> load -> library('input');
		$this -> load -> library('ion_auth');
		$this -> load -> library('ls_places');
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
			case 'restaurant' :
				$this -> restaurant();
				break;
			default :
				$this -> index();
		}
	}
	
	function index($value = FALSE) {

		$places_id = $this -> uri -> segment(2);
		
		if (!is_numeric($places_id)) {
			redirect('404');
		}

		$this -> data['places'] = $this -> ls_places -> selectPlaceById($places_id);

		// Render view data
		$this -> data['head_title'] = 'Places | Lunchsparks';
		$this -> data['tpl_page_id'] = 'places#index';
		$this -> data['tpl_page_title'] = "Places";
		// Render views
		$this -> data['main_content'] = 'base/places/index';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}
	
	function add() {
		
		$fields = ($this -> input -> post());
		if ($fields && sizeof($fields) > 1) {
			$place_id = $this -> ls_places -> insertPlace($fields);
			if (is_numeric($place_id)) {
				redirect('/places/'.$place_id);
			};
		}
		
		// Render view data
		$this -> data['head_title'] = 'Places | Lunchsparks';
		$this -> data['tpl_page_id'] = 'places#add';
		$this -> data['tpl_page_title'] = "Places";
		// Render views
		$this -> data['main_content'] = 'base/places/add';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}
	
	function edit($value = FALSE) {
		
		$places_id = $this -> uri -> segment(3);
		
		if (!is_numeric($places_id)) {
			return FALSE;
		}

		$this -> data['places'] = $this -> ls_places -> selectPlaceById($places_id);

		// Render view data
		$this -> data['head_title'] = 'Places | Lunchsparks';
		$this -> data['tpl_page_id'] = 'places#edit';
		$this -> data['tpl_page_title'] = "Edit Places";
		// Render views
		$this -> data['main_content'] = 'base/places/edit';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}
	
	function restaurant($value = FALSE) {
		
	}
	
}
?>