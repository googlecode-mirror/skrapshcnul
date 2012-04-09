<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> config('linkedin_oauth', TRUE);
		$this -> load -> config('pagination', TRUE);
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('ls_profile');
		$this -> load -> library('ls_search');
		$this -> load -> library('ls_tags');
		$this -> load -> library('pagination');
		$this -> load -> helper('logger');
		$this -> load -> helper('image/image_resize');
		$this -> load -> helper('url');
		$this -> load -> model('preferences_model');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> data['is_logged_in_admin'] = $this -> ion_auth -> is_admin();
		$this -> session -> set_flashdata('system_message', '');

		if (!$this -> ion_auth -> logged_in()) {
			// Not Logged in? Redirect them back to login page.
			redirect('login', 'refresh');
		}

		## Load Configurations
		$this -> pagination = $this -> config -> item('pagination', 'pagination');
		## User Id Check
		$this -> user_id = $this -> session -> userdata('user_id');

		$this -> _init();
	}

	private function _init() {

		## Initialization
		$this -> fields = array();
		$this -> requests = $this -> input -> get();
		$this -> options['row_count'] = $this -> pagination['per_page'];
		//$this -> options['row_count'] = 5;

		if (isset($requests['q'])) {
			$this -> fields['q'] = $this -> requests['q'];
			$this -> data['q'] = $this -> requests['q'];
		}
		if (!isset($requests['page'])) {
			$this -> options['page'] = 1;
		} else {
			$this -> options['page'] = $this -> requests['page'];
		}

		$this -> options['offset'] = ($this -> options['page'] - 1) * $this -> options['row_count'];

	}

	function index($value = '') {

		return $this -> people();

	}

	function people() {
		
		## Pagination
		$this -> options['count_all_results'] = TRUE;
		$this -> options['total_count'] = $this -> ls_search -> people($this -> fields, $this -> options);
		$this -> options['page_base_url'] = base_url() . '/search/people/';
		$this -> data['pagination'] = $this -> _pagination_details($this -> fields, $this -> options);
		
		## Results
		$this -> options['count_all_results'] = FALSE;
		$this -> data['users'] = $this -> ls_search -> people($this -> fields, $this -> options);

		// Render views data
		$this -> data['head_title'] = 'Search | Lunchsparks';
		$this -> data['tpl_page_id'] = "search#people";
		$this -> data['tpl_page_title'] = "Search People";
		// Render Views
		$this -> data['main_content'] = 'base/search/people';
		$this -> load -> view('includes/tmpl_layout', $this -> data);

	}

	function places() {

	}

	function projects() {
		
		## Pagination
		$this -> options['count_all_results'] = TRUE;
		$this -> options['total_count'] = $this -> ls_search -> projects($this -> fields, $this -> options);
		$this -> options['page_base_url'] = base_url() . '/search/projects/';
		$this -> data['pagination'] = $this -> _pagination_details($this -> fields, $this -> options);
		
		## Results
		$this -> options['count_all_results'] = FALSE;
		$this -> data['projects'] = $this -> ls_search -> projects($this -> fields, $this -> options);
		
		// Render view data
		$this -> data['head_title'] = 'Projects Listing | Lunchsparks';
		$this -> data['tpl_page_id'] = 'projects#index';
		$this -> data['tpl_page_title'] = "Projects";
		// Render views
		$this -> data['main_content'] = 'base/search/projects';
		$this -> load -> view('includes/tmpl_layout', $this -> data);

	}
	
	public function tag() {
		$this -> tags();
	}
	public function tags() {
		
		if (isset($this -> requests['q']['tags'])) {
			$tag_query = ($this -> requests['q']['tags']);
			unset($this -> requests['q']['tags']);
			redirect('/search/tags/'. $tag_query .'?q' . http_build_query($this -> requests));
		}
		
		## Tag Name
		if ($this -> uri -> segment(3)) {
			$tag_query = urldecode($this -> uri -> segment(3));
		}
		
		if (isset($tag_query) && !empty($tag_query)) {
			
			## Show Results for specific tag.
			$this -> data['q']['tags'] = $tag_query;
			$this -> fields['tags'] = urldecode($tag_query);
			
			## Show Similar Tags
			$this -> tags_details();
			
			## Search Type
			## - people, project, 
			$this -> options['type'] = $this -> input -> get('type');
			switch($this -> options['type']) {
				case 'places' :
					$this -> tags_places();
					break;
				case 'projects' : 
					$this -> tags_projects();
					break;
				case 'people' :
				default : 
					$this -> tags_people();
					break;
			}
			
		} else {
			## Show popular / trending tags.
			
			## Pagination
			$this -> options['count_all_results'] = TRUE;
			$this -> options['category'] = 'projects';
			$this -> options['total_count'] = $this -> ls_search -> tags_similar($this -> fields, $this -> options);
			$this -> options['page_base_url'] = base_url() . '/search/projects/';
			$this -> data['pagination'] = $this -> _pagination_details($this -> fields, $this -> options);
			
			## Results - Retrive Similar Tags
			$this -> options['count_all_results'] = FALSE;
			$this -> data['tags'] = $this -> ls_search -> tags_similar($this -> fields, $this -> options);
			
			// Render views data
			$this -> data['head_title'] = 'Search | Lunchsparks';
			$this -> data['tpl_page_id'] = "search#tag";
			$this -> data['tpl_page_title'] = "Search Tag";
			// Render Views
			$this -> data['main_content'] = 'base/search/tags';
			$this -> load -> view('includes/tmpl_layout', $this -> data);
			
		}
		
		

	}
	
	public function tags_details() {
		
		## ---------- TAGS ----------
		## Pagination
		/*$this -> options['count_all_results'] = TRUE;
		$this -> options['category'] = 'projects';
		$this -> options['total_count'] = $this -> ls_search -> tags_similar($this -> fields, $this -> options);
		$this -> options['page_base_url'] = base_url() . '/search/projects/';
		$this -> data['pagination']['tags'] = $this -> _pagination_details($this -> fields, $this -> options);*/
		## Results - Retrive Similar Tags
		$this -> options['count_all_results'] = FALSE;
		$this -> data['tag'] = $this -> ls_tags -> select_tag($this -> fields, $this -> options);
		$this -> data['tags_similar'] = $this -> ls_search -> tags_similar($this -> fields, $this -> options);
		
		
	}
	
	public function tags_people() {
		
		## Filter - People
		$this -> data['filter'] = 'people';
		
		## Pagination
		$this -> options['count_all_results'] = TRUE;
		$this -> options['total_count'] = $this -> ls_search -> people($this -> fields, $this -> options);
		$this -> options['page_base_url'] = base_url() . '/search/people/';
		$this -> data['pagination'] = $this -> _pagination_details($this -> fields, $this -> options);
		
		## Results
		$this -> options['count_all_results'] = FALSE;
		$this -> data['users'] = $this -> ls_search -> people($this -> fields, $this -> options);
		
		// Render views data
		$this -> data['head_title'] = 'Search | Lunchsparks';
		$this -> data['tpl_page_id'] = "people#tag";
		$this -> data['tpl_page_title'] = "Search Tag";
		// Render Views
		$this -> data['main_content'] = 'base/search/_tmpl_tags';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
		
	}

	public function tags_projects() {
		
		## Filter - People
		$this -> data['filter'] = 'projects';
		
		## Pagination
		$this -> options['count_all_results'] = TRUE;
		$this -> options['total_count'] = $this -> ls_search -> projects($this -> fields, $this -> options);
		$this -> options['page_base_url'] = base_url() . '/search/projects/' . $this -> fields['tags'] .'/';
		$this -> data['pagination'] = $this -> _pagination_details($this -> fields, $this -> options);
		
		## Results - Projects
		$this -> options['count_all_results'] = FALSE;
		$this -> data['projects'] = $this -> ls_search -> projects($this -> fields, $this -> options);
		
		// Render views data
		$this -> data['head_title'] = 'Search | Lunchsparks';
		$this -> data['tpl_page_id'] = "search#tag";
		$this -> data['tpl_page_title'] = "Search Tag";
		// Render Views
		$this -> data['main_content'] = 'base/search/_tmpl_tags';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
		
	}
	
	public function tags_places() {
		
		
		
		## Category - People
		$this -> data['category'] = 'people';
		
		// Render views data
		$this -> data['head_title'] = 'Search | Lunchsparks';
		$this -> data['tpl_page_id'] = "search#tag";
		$this -> data['tpl_page_title'] = "Search Tag";
		// Render Views
		$this -> data['main_content'] = 'base/search/tags';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}
	
	private function _pagination_details($fields = FALSE, $options = FALSE) {

		if (!isset($options['total_count']) && !is_numeric($options['total_count'])) {
			return false;
		}
		if (!isset($options['page'])) {
			$options['page'] = 1;
		}

		$options['offset'] = ($options['page'] - 1) * $options['row_count'];

		$requests = ($this -> input -> get());
		if (!$requests) {
			$requests = array();
		}

		## Current Page
		$result['current_page'] = $options['page_base_url'] . '?' . http_build_query($requests);
		
		## Next Page
		if ($options['page'] + 1 * $options['row_count'] < $options['total_count']) {
			$requests['page'] = $options['page'] + 1;
			$result['next_page_url'] = $options['page_base_url'] . '?' . http_build_query($requests);
		} else {
			return FALSE;
		}

		return $result;
	}

}
