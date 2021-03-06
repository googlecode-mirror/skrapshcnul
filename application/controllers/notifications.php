<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

if (!class_exists('Controller')) {
	class Controller extends CI_Controller {
	}

}

/**
 * Author @stiucsib86
 * Date 2011-09-11
 */

class Notifications extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> config('ls_notifications', TRUE);
		$this -> load -> library('session');
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('ls_notifications');
		$this -> load -> database();
		$this -> load -> helper('url');
		// Set Config
		$this -> component_id = $this -> config -> item('component_id', 'ls_notifications');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
	}

	function index() {

		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$this -> data['notifications'] = $this -> ls_notifications -> get_notifications($this -> session -> userdata['id']);
		if (!$this -> data['notifications'])
			$this -> data['notifications'] = array();
		
		// Render view data
		$this -> data['head_title']		= 'Notifications'; 
		$this -> data['tpl_page_id']	= 'Notifications#index';
		$this -> data['tpl_page_title'] = "Notifications";
		// Render views
		$this -> data['main_content'] = 'base/notifications/index';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function minified($type = NULL) {

		$this -> data['notifications'] = $this -> ls_notifications -> get_notifications($this -> session -> userdata['id']);

		if (!$this -> data['notifications'])
			$this -> data['notifications'] = array();

		// Render view
		if ($type == "ajax") {

		} else {
			$this -> data['main_content'] = 'base/notifications/notification_mini';
			$this -> load -> view('includes/tmpl_nolayout', $this -> data);
		}

	}

	function test() {
		// Get User ID
		$user_id = $this -> session -> userdata['user_id'];
		
		$this -> ls_notifications -> set_notification($this -> component_id['system'], $user_id, "Test Notification");
		
		echo 'done';
	}

}
?>