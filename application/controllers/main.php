<?php

/**
 * Main Page
 */
class Main extends CI_Controller {

	function __construct() {
		parent::__construct();
		// Check if user is logged in
		$data['is_logged_in'] = $this->session->userdata('is_logged_in') ? TRUE : FALSE;
	}
	
	function index($value = '') {
		// Check if user is logged in
		$data['is_logged_in'] = $this->session->userdata('is_logged_in') ? TRUE : FALSE;
		
		$data['main_content'] = 'main';
		$this -> load -> view('includes/tmpl_public', $data);
	}
	
	function _getTotalUsers() {
		
	} 
}
?>