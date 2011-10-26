<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
		// Set Global Variables
		$this->data['is_logged_in'] = $this->ion_auth->logged_in();
	}

	function index() {
		redirect('user/profile', 'refresh');
	}
}
?>