<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Settings extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> config('linkedin_oauth', TRUE);
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> helper('logger');
		$this -> load -> helper('url');
		$this -> load -> helper('linkedin/linkedin_api');
		$this -> load -> model('linkedin/linkedin_model');
		$this -> load -> model('user_profile_model');
		$this -> load -> model('user_settings_model');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> data['is_logged_in_admin'] = $this->ion_auth->is_admin();
		$this -> session -> set_flashdata('system_message', '');

		if (!$this -> ion_auth -> logged_in()) {
			// Not Logged in? Redirect them back to login page.
			redirect('login', 'refresh');
		}
		
		$this->user_id = $this -> session -> userdata('user_id');
		
		// Request Params: alt = json | , 
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> call = (isset($_REQUEST['call'])) ? $_REQUEST['call'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';
		$this -> request_method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : '';
		
		$this -> start_time = time();
		
	}

	function index($value = '') {
		// Default to general
		$this -> overview();
	}

	function overview($value = '') {
		
		if ($this -> alt == 'json') {
			$datafld = isset($_REQUEST['datafld']) ? $_REQUEST['datafld'] : '';
			$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';
			if ($datafld && $value) {
				$fields = array($datafld => $value);
				$result = $this -> user_profile_model -> update($this->user_id, $fields);
			} else {
				$result = FALSE;
			}
			
			$this -> _json_prep($result);
		} else {
			
			$this -> data['settings'] = $this -> user_profile_model -> select($this->user_id);

			// Render views data
			$this -> data['head_title']		= 'Settings | Lunchsparks';
			$this -> data['tpl_page_id'] = "overview";
			$this -> data['tpl_page_title'] = "Account Overview";
			// Render Views
			$this -> data['main_content'] = 'base/settings/overview';
			$this -> load -> view('includes/tmpl_layout', $this -> data);
		}
	}

	function sync() {
		switch($this->uri->segment(3)) {
			case 'pullLinkedInData' :
				$this -> pullLinkedInData();
		}

		$external_data['linkedin'] = $this -> linkedin_model -> selectLinkedInDataForCurrentUser();
		$this -> data['external_data'] = $external_data;

		// Tpl setup
		$this -> data['tpl_page_id'] = "sync";
		$this -> data['tpl_page_title'] = "Sync";

		// Render view
		$this -> data['main_content'] = 'base/settings/sync';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function security() {

		if ($this -> alt == 'json') {
			$datafld = isset($_REQUEST['datafld']) ? $_REQUEST['datafld'] : '';
			$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';
			if (!empty($datafld)) {
				$fields = array($datafld => $value);
				$result = $this -> user_settings_model -> update_security($this->user_id, $fields);
			} else {
				$result = FALSE;
			}
			
			$this -> _json_prep($result);
		} else {
			
			$this -> data['settings']['security'] = $this -> user_settings_model -> select_security($this->user_id);
			//var_dump($this -> data['settings']['security']);
			
			// Tpl setup
			$this -> data['tpl_page_id'] = "security";
			$this -> data['tpl_page_title'] = "Security";
	
			// Render view
			$this -> data['main_content'] = 'base/settings/security';
			$this -> load -> view('includes/tmpl_layout', $this -> data);
		}
	}

	function privacy() {

		// Tpl setup
		$this -> data['tpl_page_id'] = "privacy";
		$this -> data['tpl_page_title'] = "Privacy";

		// Render view
		$this -> data['main_content'] = 'base/settings/privacy';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function language() {

		// Tpl setup
		$this -> data['tpl_page_id'] = "language";
		$this -> data['tpl_page_title'] = "Language";

		// Render view
		$this -> data['main_content'] = 'base/settings/language';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function notifications() {

		if ($this -> alt == 'json') {
			$datafld = isset($_REQUEST['datafld']) ? $_REQUEST['datafld'] : '';
			$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : '';
			if (!empty($datafld)) {
				$fields = array($datafld => $value);
				$result = $this -> user_settings_model -> update_notification($this->user_id, $fields);
			} else {
				$result = FALSE;
			}
			
			$this -> _json_prep($result);
		} else {
			
			$this -> data['settings']['notification'] = $this -> user_settings_model -> select_notification($this->user_id);
			//var_dump($this -> data['settings']['notification']);
			
			// Tpl setup
			$this -> data['tpl_page_id'] = "notifications";
			$this -> data['tpl_page_title'] = "Notifications";
	
			// Render view
			$this -> data['main_content'] = 'base/settings/notifications';
			$this -> load -> view('includes/tmpl_layout', $this -> data);
		}
	}

	function applications() {

		// Tpl setup
		$this -> data['tpl_page_id'] = "applications";
		$this -> data['tpl_page_title'] = "Applications";

		// Render view
		$this -> data['main_content'] = 'base/settings/applications';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function mobile() {

		// Tpl setup
		$this -> data['tpl_page_id'] = "mobile";
		$this -> data['tpl_page_title'] = "Mobile";

		// Render view
		$this -> data['main_content'] = 'base/settings/mobile';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function payments() {

		// Tpl setup
		$this -> data['tpl_page_id'] = "payments";
		$this -> data['tpl_page_title'] = "Payments";

		// Render view
		$this -> data['main_content'] = 'base/settings/Payments';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}
	
	function _json_prep($result) {
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		
		$json_result['completed_in'] =  number_format(time() - $this -> start_time, 3, '.', '');
		$json_result['results'] = $result;
		print_r($this -> callback. '('.json_encode($json_result) .')');
	}

}
