<?php

/**
 * System Administrative Page
 */
class Json extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('invitation_model');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this->ion_auth->logged_in();
		$this -> data['is_logged_in_admin'] = $this->ion_auth->is_admin();
		
		if (!$this->data['is_logged_in_admin']) {
			redirect('404');
		}
		
		// Request Params: alt = json | , 
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> call = (isset($_REQUEST['call'])) ? $_REQUEST['call'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';
		$this -> request_method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : '';
		
		$this -> start_time = time();
	}
	
	function addInvitation() {
		
		if (!isset($_REQUEST['user_id']) && empty($_REQUEST['user_id']) && !is_numeric($_REQUEST['user_id'])) {
			return FALSE;
		}
		if (!isset($_REQUEST['add_invites']) && empty($_REQUEST['add_invites']) && !is_numeric($_REQUEST['add_invites'])) {
			return FALSE;
		}
		
		$user_id = $_REQUEST['user_id'];
		$add_invites = $_REQUEST['add_invites'];
		
		$results = $this->invitation_model->updateInvitation($user_id, $add_invites);
		
		$this->_json_prep($results);
	}
	
	function _json_prep($results) {
		//header('Cache-Control: no-cache, must-revalidate');
		//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		//header('Content-type: application/json');
		
		if ($this -> callback) {
			$this -> json_result['completed_in'] =  number_format(time() - $this -> start_time, 3, '.', '');
			$this -> json_result['results'][] = $results;
			print_r($this -> callback. '('.json_encode($this -> json_result) .')');
		} else {
			$this -> json_result = $results;
			print_r(json_encode($this -> json_result));
		}
		
	}
}
?>