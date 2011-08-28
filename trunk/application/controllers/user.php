<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->_is_logged_in();
	}

	function index() {

		$this -> load -> model('user_model');
		$data['results'] = $this -> user_model -> getAll();

		// Load view with data
		$this -> load -> view('user_login', $data);
	}

	function profile() {
		$data['main_content'] = 'user_profile';
		$this -> load -> view('includes/tmpl_layout', $data);
	}

	public function logout($value = '') {
		$this -> load -> view('user_logout');
	}

	function _is_logged_in() {
		// Check session
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		if (!isset($is_logged_in) || $is_logged_in != TRUE) {
			echo "You dont have permission";
		}

	}

}
?>