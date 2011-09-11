<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Settings extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('url');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> session -> set_flashdata('system_message', '');

		if (!$this -> ion_auth -> logged_in()) {
			// Not Logged in? Redirect them back to login page.
			redirect('login', 'refresh');
		}
	}

	function index($value = '') {
		// Default to general
		$this -> general();
	}

	function general($value = '') {
		// Some logics here

		// Render view
		$this -> data['main_content'] = 'settings/general';
		$this -> load -> view('includes/tmpl_public', $this -> data);
	}

	function security() {

		// Render view
		$this -> data['main_content'] = 'settings/security';
		$this -> load -> view('includes/tmpl_public', $this -> data);
	}

	function notifications() {

		// Render view
		$this -> data['main_content'] = 'settings/notifications';
		$this -> load -> view('includes/tmpl_public', $this -> data);
	}

	function applications() {

		// Render view
		$this -> data['main_content'] = 'settings/applications';
		$this -> load -> view('includes/tmpl_public', $this -> data);
	}

	function mobile() {

		// Render view
		$this -> data['main_content'] = 'settings/mobile';
		$this -> load -> view('includes/tmpl_public', $this -> data);
	}

	function payments() {
		
		// Render view
		$this->data['main_content'] = 'settings/payments';
		$this -> load -> view('includes/tmpl_public', $this->data);
	}
}
