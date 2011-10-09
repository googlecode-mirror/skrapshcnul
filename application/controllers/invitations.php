<?php

/**
 * System Administrative Page
 */
class Invitations extends CI_Controller {

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
	}

	function index($value = '') {
		redirect('invitations/all', 'refresh');
	}

	function all($value = '') {
		// Render view
		$this -> data['tpl_page_id'] = 'all';
		$this -> data['main_content'] = 'invitations/all';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function invite() {

		// Render view
		$this -> data['tpl_page_id'] = 'invite';
		$this -> data['main_content'] = 'invitations/invite';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function status() {

		// Dummy Data
		$this -> data['invites'][] = array('invitee_email' => 'test@test.com', 'invitation_code' => 'test', 'joined_on' => '1234');
		$this -> data['number_invites'] = 0;
		$this -> data['number_signup'] = 0;

		// Render view
		$this -> data['tpl_page_id'] = 'status';
		$this -> data['main_content'] = 'invitations/status';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

}
?>