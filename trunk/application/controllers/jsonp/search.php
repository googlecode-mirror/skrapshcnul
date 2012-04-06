<?php

/**
 * System Administrative Page
 */
class Search extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('input');
		$this -> load -> library('ion_auth');
		$this -> load -> library('json');
		$this -> load -> library('ls_profile');
		$this -> load -> library('ls_search');
		$this -> load -> library('session');
		$this -> load -> database();
		$this -> load -> helper('url');
		$this -> load -> helper('json');
		$this -> load -> helper('logger');

		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();

		$this -> user_id = $this -> session -> userdata('user_id');

		// Request Params: alt = json | ,
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> call = (isset($_REQUEST['call'])) ? $_REQUEST['call'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';
		$this -> request_method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : '';

		// Authentication
		$this -> json -> is_autheticated();

	}

	function index() {

		echo 'Welcome to Lunchsparks JSON Autocomplete';

	}

	function people() {
		
		$fields = array();
		$fields['q'] = $this -> input -> get('q');
		if (!$fields['q']) {
			$error['domain'] = "global";
			$error['reason'] = "invalidParameter";
			$error['message'] = "Invalid value 'keywords'.";
			$error['locationType'] = "parameter";
			$error['location'] = "keywords";
			$this -> data['errors'] = $error;
			return $this -> json -> json_prep($this -> data['errors']);
		}
		
		$this -> data['results'] = $this -> ls_search -> people($fields);
		
		$this -> json -> json_prep($this -> data);

	}

	function network()
	{
		$keywords = $this -> input -> get('keywords');
		if (!$keywords) {
			$error['domain'] = "global";
			$error['reason'] = "invalidParameter";
			$error['message'] = "Invalid value 'keywords'.";
			$error['locationType'] = "parameter";
			$error['location'] = "keywords";
			$this -> data['errors'] = $error;
			return $this -> json -> json_prep($this -> data['errors']);
		}
		## TODO - Map to functions
		$preferences = $this -> preferences_model -> selectForCurrentUser();
		$pref_array = array();
		if($preferences)
			{
				foreach($preferences[1]['data'] as $value)
				{
					array_push($pref_array,$value);
				}
			}
		$asso_array = ($this -> uri -> uri_to_assoc(5));
		//SELECT  `keywords` 
		$this -> db -> select('*');
		$this -> db -> from('lss_global_preferences AS lgp');
		$this -> db -> like('keywords', $keywords);
		$this -> db -> order_by('count','desc');
		if($pref_array)
		$this -> db -> where_not_in('keywords',$pref_array);
		//$this -> db -> join('lss_users_profile_social_links AS lupsl', 'lupsl.user_id = lup.user_id', 'left');
		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			$this -> data['results'] = ($query -> result_array());
		}
		
		$this -> json -> json_prep($this -> data);
		
	}

	function places() {

		//$keywords = ($this -> uri -> segment(4));
		$keywords = $this -> input -> get('keywords');
		if (!$keywords) {
			$error['domain'] = "global";
			$error['reason'] = "invalidParameter";
			$error['message'] = "Invalid value 'keywords'.";
			$error['locationType'] = "parameter";
			$error['location'] = "keywords";
			$this -> data['errors'] = $error;
			return $this -> json -> json_prep($this -> data['errors']);
		}

		## TODO - Map to functions
		$asso_array = ($this -> uri -> uri_to_assoc(5));
		
		$results = $this -> ls_places -> searchPlace($keywords);
		
		if (sizeof($results) > 0 ) {
			$this -> data['results'] = $results;
		}
		
		$this -> json -> json_prep($this -> data);

	}

}
