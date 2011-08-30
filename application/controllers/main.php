<?php

/**
 * Main Page
 */
class Main extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
		// Set Global Variables
		$this->data['is_logged_in'] = $this->ion_auth->logged_in();
		$this->session->set_flashdata('system_message', '');
	}
	
	function index($value = '') {
		// Render view
		$this->data['main_content'] = 'main';
		$this -> load -> view('includes/tmpl_public', $this->data);
	}
	
	function _getTotalUsers() {
		
	} 
}
?>