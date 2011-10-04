<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Schedules extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this -> load -> database();
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('input');
		$this -> load -> helper('logger');
		
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
	}

	function index() {
		// Check if user is logged in
		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		} else {
      $this -> data['main_content'] = 'schedules/schedules_view';
      $this -> data['googlemap'] = true;
      $this -> load -> view('includes/tmpl_layout', $this -> data);            
		}
	}
}
?>
