<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */

class Logout extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
		// Check if user is logged in
		$data['is_logged_in'] = $this -> session -> userdata('is_logged_in') ? TRUE : FALSE;
		$data['is_logged_in'] = TRUE;
	}

	function index() {
		if (!$this->ion_auth->logged_in()) {
			$this->login();
		} else {
			redirect('auth/logout', 'refresh');
		}
	}
}
?>