<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> config('linkedin_oauth', TRUE);
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> helper('logger');
		$this -> load -> helper('url');
		$this -> load -> model('preferences_model');
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
		
		
		
		
		// Render views data
		$this -> data['head_title']		= 'Search | Lunchsparks';
		$this -> data['tpl_page_id'] = "search#overview";
		$this -> data['tpl_page_title'] = "Search";
		// Render Views
		$this -> data['main_content'] = 'search/index';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}
	
	function tag() {
		$query = $this->uri->segment(3, 0);
		
		if (empty($query)) {
			redirect("search/index");
		}
		
		## Prepare Data
		$this -> data['query_result']['keyword']			= urldecode($query);
		$this -> data['query_result']['similar_keywords']	= array();
		$this -> data['query_result']['count']				= 0;
		
		## TODO Record Search 
		
		## TODO Get Statistics
		$results = $this -> preferences_model -> global_preferences_select_count($query);
		//var_dump($results);
		if (count($results) > 1) {
			foreach ($results as $result) {
				$this -> data['query_result']['similar_keywords'][]	= urldecode($result['keywords']);
				$this -> data['query_result']['count'] 				+= $result['count'];
			}
		} else {
			$this -> data['query_result']['similar_keywords'][]	= FALSE;
			$this -> data['query_result']['count'] 				+= $results[0]['count'];
		}
		$this -> data['users'] = $this -> preferences_model -> searchTag($query);
		
		// Render views data
		$this -> data['head_title']		= 'Search | Lunchsparks';
		$this -> data['tpl_page_id'] = "search#tag";
		$this -> data['tpl_page_title'] = "Search Tag";
		// Render Views
		$this -> data['main_content'] = 'search/tag';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
		
	}

}
