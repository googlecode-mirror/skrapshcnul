<?php

/**
 * System Administrative Page
 */
class Invitations extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('session');
		$this -> load -> library('ion_auth');
		$this -> load -> library('email');
		$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('url');
		$this -> load -> helper('email');
		$this -> load -> model('invitation_model');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> data['is_logged_in_admin'] = $this->ion_auth->is_admin();
		$this -> session -> set_flashdata('system_message', '');

		// Initialize
		if (!$this -> data['is_logged_in']) {
			// Not Logged in? Redirect them back to login page.
			redirect('login', 'refresh');
		}
		
		$this->user_id = $this -> session -> userdata('user_id');
		
		// Request Params: alt = json | , 
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> call = (isset($_REQUEST['call'])) ? $_REQUEST['call'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';
		
		$this -> start_time = time();
	}

	function index($value = '') {
		redirect('invitations/all', 'refresh');
	}

	function all($value = '') {
		$this -> _prep_all_data();
		
		$this -> data['invite_logs'] = $this -> invitation_model -> selectInvitationLog($this->user_id);
		$this -> data['invite_logs_number_signup'] = $this -> invitation_model -> selectInvitationLog_signed_up($this->user_id);
		
		// Render view data
		$this -> data['head_title']		= 'Invitations | Lunchsparks'; 
		$this -> data['tpl_page_id']	= 'invitations#all';
		$this -> data['tpl_page_title'] = "Invitations";
		// Render views
		$this -> data['main_content'] = 'base/invitations/all';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function invite() {
		if ($this -> alt == 'json') {
			if ($this -> call == 'sendInvitation' && isset($_REQUEST['invitee_email'])) {
				if ($this -> invitation_model -> insertInvitationLog($this->user_id, $_REQUEST['invitee_email'])) {
					// Send Email to User
					$this->_sendInvitationEmail($_REQUEST['invitee_email']);
					$this -> _json_prep('Invitation Sent to '.$_REQUEST['invitee_email'].'!');
				} else {
					$this->_sendInvitationEmail($_REQUEST['invitee_email']);
					$this -> _json_prep('', 'Invitation has already been sent to this email.');
				}
				
			} elseif ($this -> call == 'checkInvitationLeft' ) {
				$invitation = $this -> invitation_model -> selectInvitation($this->user_id);
				print($invitation->invitation_left);
				
			} elseif ($this -> call == 'resendInvitation' && isset($_REQUEST['invitee_email'])) {
				if ($this->_sendInvitationEmail($_REQUEST['invitee_email'])) {
					$this -> _json_prep('Invitation Sent to '.$_REQUEST['invitee_email'].'!');
				} else {
					$this -> _json_prep('', 'Error sending invitation.');
				}
				
				// Render view
				//$this -> data['tpl_page_id'] = 'invite';
				//$this -> data['main_content'] = 'invitations/all';
				//$this -> load -> view('invitations/email/sendInvitation', $this -> data);
			}
		} else {
			$this -> _prep_all_data();
			// Render view
			$this -> data['tpl_page_id'] = 'invite';
			$this -> data['main_content'] = 'invitations/all';
			$this -> load -> view('includes/tmpl_layout', $this -> data);
		}
				
	}

	function status() {
		$this -> _prep_all_data();
		
		$this -> data['invite_logs'] = $this -> invitation_model -> selectInvitationLog($this->user_id);
		$this -> data['invite_logs_number_signup'] = $this -> invitation_model -> selectInvitationLog_signed_up($this->user_id);
		
		// Render view
		$this -> data['tpl_page_id'] = 'status';
		$this -> data['main_content'] = 'invitations/status';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}
	
	function _sendInvitationEmail($invitee_email) {
		
		$results = $this -> invitation_model -> selectInvitationLogForEmail($invitee_email);
		$this->data['invitation_code'] = $results->invitation_code;
		$this->data['invitee_email'] = $results->invitee_email;
		$this->data['sender_email'] = $results->email;
		$message = $this -> load -> view('/base/invitations/email/sendInvitation', $this->data, true);
		$this -> email->clear();
		$this -> email->set_newline("\r\n");
		$this -> email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
		$this -> email->to($results->invitee_email);
		$this -> email->subject($this->config->item('site_title', 'ion_auth') . ' - Invitation');
		$this -> email->message($message);
		if ($this->email->send())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
		
	}
	
	function _prep_all_data() {
		$invitation = $this -> invitation_model -> selectInvitation($this->user_id);
		if (!($invitation)){
			$this->data['invitation']['invitation_left'] = 0;
		} else {
			$this->data['invitation']['invitation_left'] = $invitation->invitation_left;
		}
		
	}

	function _json_prep($result, $error = false) {
		$json_result['completed_in'] =  number_format(time() - $this -> start_time, 3, '.', '');
		$json_result['results'] = $result;
		if ($error) {
			$json_result['error'] = $error;
		}
		
		if ($this -> callback) {
			print_r($this -> callback. '('.json_encode($json_result) .')');
		} else {
			print_r(json_encode($json_result));
		}
		
	}

}
?>