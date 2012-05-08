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
		
		
		
		// Render view data
		$this -> data['head_title']		= 'Dashboard | Lunchsparks'; 
		$this -> data['tpl_page_id']	= 'user#profile';
		$this -> data['tpl_page_title'] = "Profile Overview";
		// Render view layout
		$this -> data['main_content']	= 'base/dashboard/index';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
		
	}
	
	function profile() {
		
	}
}
?>