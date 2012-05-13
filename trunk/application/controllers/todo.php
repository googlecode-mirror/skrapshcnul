<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Todo extends CI_Controller {

	function __construct() {
		//default constructor
		parent::__construct();

		//load database, libraries, helpers, models
		$this -> load -> library('ion_auth');
		
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> data['is_logged_in_admin'] = $this->ion_auth->is_admin();
		
		// Check if user is logged in
		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login?redirect='.uri_string(), 'refresh');
		}
		
	}

	function index() {
		
		// Render view data
		$this -> data['head_title']		= 'Lunchsparks'; 
		$this -> data['tpl_page_id']	= 'user#profile';
		$this -> data['tpl_page_title'] = "Profile Overview";
		// Render view layout
		$this -> data['main_content']	= 'base/todo/index';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

}
?>
