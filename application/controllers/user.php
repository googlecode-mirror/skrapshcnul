<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends CI_Controller {
	
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
		// Check if user is logged in
		if (!$this->ion_auth->logged_in()) {
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		} else {
			$this->profile();
		}
	}

	function profile() {
		
		/* dummy data */
		$user_data['profile_img'] = "Profile Picture";
		$user_data['name'] = "name";
		$user_data['title'] = "Platform Engineer";
		$user_data['company'] = "Lunchsparks Pte. Ltd.";
		$this->data['user_profile'] = $user_data;
		
		$activity_item['data'] = "&lt;User&gt; had lunch with &lt;User2&gt;. ";
		$this->data['activity_list'][] = $activity_item;
		
		$activity_item['data'] = "&lt;User&gt; has joined Lunchsparks. ";
		$this->data['activity_list'][] = $activity_item;
		
		
		
		
		$this->data['main_content'] = 'user/user_profile';
		$this -> load -> view('includes/tmpl_layout', $this->data);
	}

}
?>