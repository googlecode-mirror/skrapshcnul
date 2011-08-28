<?php

/**
 *
 */

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		// Check if user is logged in
		$data['is_logged_in'] = $this -> session -> userdata('is_logged_in') ? TRUE : FALSE;
	}

	function index() {
		// Check if user is logged in
		$data['is_logged_in'] = $this -> session -> userdata('is_logged_in') ? TRUE : FALSE;

		$data['main_content'] = 'user_login';
		$this -> load -> view('includes/tmpl_layout', $data);
	}

	function signup() {
		// Check if user is logged in
		$data['is_logged_in'] = $this -> session -> userdata('is_logged_in') ? TRUE : FALSE;

		$data['main_content'] = 'user_signup';
		$this -> load -> view('includes/tmpl_layout', $data);
	}

	function validate_credentials() {
		// Check if user is logged in
		$data['is_logged_in'] = $this -> session -> userdata('is_logged_in') ? TRUE : FALSE;

		// Initialize from validation
		$this -> load -> library('form_validation');
		$this -> form_validation -> set_rules('username', 'Username', 'trim|required');
		$this -> form_validation -> set_rules('password', 'Password', 'trim|required');
		$this -> form_validation -> set_error_delimiters('<em>', '</em>');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> index();
		} else {
			// Field Validation passes
			$this -> load -> model('user_model');

			if ($this -> user_model -> validate()) {
				$data = array('username' => $this -> input -> post('username'), 'is_logged_in' => TRUE);

				$this -> session -> set_userdata($data);
				redirect('user/profile');
			} else {
				$this->session->set_flashdata('message', 'Invalid username/password!');
				$this -> form_validation -> set_message('username_check', 'Invalid username/password!');
				$this -> index();
			}

		}

	}

	function create_user() {
		// Check if user is logged in
		$data['is_logged_in'] = $this -> session -> userdata('is_logged_in') ? TRUE : FALSE;

		$this -> load -> library('form_validation');
		// field name, error message, validation rules
		$this -> form_validation -> set_rules('firstname', 'First Name', 'trim|required');
		$this -> form_validation -> set_rules('lastname', 'Last Name', 'trim|required');
		$this -> form_validation -> set_rules('email', 'Email Address', 'trim|required|valid_email');

		$this -> form_validation -> set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this -> form_validation -> set_rules('password', 'Password', 'trim|required|min_length[4]');
		$this -> form_validation -> set_rules('password2', 'Password2', 'trim|required||matches[password]');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> signup();
		} else {
			$this -> load -> model('user_model');
			if ($query = $this -> user_model -> create_user()) {
				$data['main_content'] = 'user_signup_success';
				$this -> load -> view('includes/tmpl_layout', $data);

			} else {
				$this -> form_validation -> set_message('required', 'An error occurred!');
				$this->session->set_flashdata('message', 'An error occurred.');
				$this->signup();
			}
		}

	}

}
?>