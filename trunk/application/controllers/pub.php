<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pub extends CI_Controller {

	function __construct() {
		//default constructor
		parent::__construct();

		//load database, libraries, helpers, models
		$this -> load -> database();
		$this -> load -> config('linkedin_oauth', TRUE);
		$this -> load -> config('users', TRUE);
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> library('input');
		$this -> load -> library('ls_profile');
		$this -> load -> helper('logger');
		$this -> load -> helper('linkedin/linkedin_api');
		$this -> load -> model('linkedin/linkedin_model');
		$this -> load -> model('preferences_model');
		$this -> load -> model('user_model');
		$this -> load -> model('user_profile_model');
		$this -> load -> model('user_rating_model');
		$this -> load -> model('user_lunch_wishlist_model');
		$this -> load -> model('user_lunch_buddy_model');

		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> data['is_logged_in_admin'] = $this->ion_auth->is_admin();
		
		$this->user_id = $this -> session -> userdata('user_id');
		
		// Request Params: alt = json | , 
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> call = (isset($_REQUEST['call'])) ? $_REQUEST['call'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';
		$this -> request_method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : '';
		
		$this -> start_time = time();
	}

	function _remap($method) {
		$this->index();
	}

	function index() {

		$this->data['target_user_id'] = $this->uri->segment(2);
		if (!is_numeric($this->data['target_user_id'])) {
			$this->data['target_user_id'] = $this->user_profile_model->select_user_id_by_alias($this->uri->segment(2));
		}

		if (!$this->user_model->is_user_account_valid($this->data['target_user_id'])) {
			redirect('404');
		} elseif (!$this->data['target_user_id'] || empty($this->data['target_user_id'])) {
			redirect('404');
		}
		
		$this -> data['profile']		= $this -> ls_profile -> _prepare_profile_data($this->data['target_user_id']);
		$this -> data['profile_stats']	= $this -> ls_profile -> _prepare_profile_statistics($this->data['target_user_id']);
		$this -> data['profile']['social_links'] = $this -> ls_profile -> prepare_profile_social_links($this->data['target_user_id']);
		$this -> data['preferences'] = $this -> preferences_model -> selectPreferences($this->data['target_user_id']);
		
		// Render views
		$this -> data['tpl_page_id'] = 'profile';
		$this -> data['main_content'] = 'pub/user_profile';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
		
	}

	function _json_prep($results) {
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		
		if ($this -> callback) {
			$json_result['completed_in'] =  number_format(time() - $this -> start_time, 3, '.', '');
			$json_result['results'][] = $results;
			print_r($this -> callback. '('.json_encode($json_result) .')');
		} else {
			$json_result = $results;
			print_r(json_encode($json_result));
		}
		
	}

}
?>
