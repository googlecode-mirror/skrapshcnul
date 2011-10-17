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
		$this -> load -> model('invitation_model');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> session -> set_flashdata('system_message', '');

		// Initialize
		if ($this -> data['is_logged_in']) {
			if ($this -> session -> userdata('linkedin_pulled') == NULL) {
				$this -> session -> set_userdata('linkedin_pulled', $this -> linkedin_model -> selectLinkedInDataForCurrentUser() != NULL);
			}
		}
		
		$this->user_id = $this -> session -> userdata('user_id');
		
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
		
		$invitation = $this -> invitation_model -> selectInvitation($this->user_id);
		if (!($invitation)){
			$this->data['invitation']['invitation_left'] = 0;
		} else {
			$this->data['invitation']['invitation_left'] = $invitation->invitation_left;
		}

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