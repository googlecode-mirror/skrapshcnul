<?php

/**
 * Main Page
 */
class Index extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('url');
		$this -> load -> model('mainpage_elements_model');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> data['is_logged_in_admin'] = $this->ion_auth->is_admin();
		$this -> session -> set_flashdata('system_message', '');
		
		$this -> data['theme'] = '/base_mobile/';
	}

	function index($value = '') {
		
		$this->data['ls_testimonial_list'] = '';
		
		// Render view
		$this -> data['main_content'] = 'main/main';
		$this -> load -> view($this -> data['theme'].'_includes/tmpl_layout', $this -> data);
	}

}
?>