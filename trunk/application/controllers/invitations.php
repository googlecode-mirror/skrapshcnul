<?php

/**
 * System Administrative Page
 */
class Invitations extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('session');
		$this -> load -> library('ion_auth');
		$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('url');
		$this -> load -> model('invitation_model');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> session -> set_flashdata('system_message', '');

		// Initialize
		if (!$this -> data['is_logged_in']) {
			// Not Logged in? Redirect them back to login page.
			redirect('login', 'refresh');
		}
		
		$this->user_id = $this -> session -> userdata('user_id');
		
	}

	function index($value = '') {
		redirect('invitations/all', 'refresh');
	}

	function all($value = '') {
		$this -> _prep_all_data();
		// Render view
		$this -> data['tpl_page_id'] = 'all';
		$this -> data['main_content'] = 'invitations/all';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function invite() {
		if ($this->input->post('invitee_email')) {
			if ($this -> invitation_model -> insertInvitationLog($this->user_id, $this->input->post('invitee_email'))) {
				$this -> session -> set_flashdata('message', 'Invitation Sent!');
			}
		}
		
		$this -> _prep_all_data();

		// Render view
		$this -> data['tpl_page_id'] = 'invite';
		$this -> data['main_content'] = 'invitations/all';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}
	
	function test() {
		$this -> invitation_model -> insertInvitationLog($this->user_id, 'test@test.com');
	}

	function status() {
		$this -> _prep_all_data();

		// Dummy Data
		$this -> data['invite_logs'] = $this -> invitation_model -> selectInvitationLog($this->user_id);
		$this -> data['invite_logs_number_signup'] = $this -> invitation_model -> selectInvitationLog_signed_up($this->user_id);

		// Render view
		$this -> data['tpl_page_id'] = 'status';
		$this -> data['main_content'] = 'invitations/status';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}
	
	function _prep_all_data() {
		$invitation = $this -> invitation_model -> selectInvitation($this->user_id);
		if (!($invitation)){
			$this->data['invitation']['invitation_left'] = 0;
		} else {
			$this->data['invitation']['invitation_left'] = $invitation->invitation_left;
		}
		
	}

}
?>