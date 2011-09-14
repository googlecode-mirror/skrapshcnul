<?php

/**
 * System Administrative Page
 */
class Ajax extends CI_Controller {

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
		echo "Welcome to API";
	}
	
	function autosuggestusername($value = '') {
		// TODO
		// Render view
		$this->data['main_content'] = 'admin/index';
		$this -> load -> view('includes/tmpl_layout', $this->data);
	}
	
	function check_no_new_notifications() {
		// TODO
	} 
}
?>