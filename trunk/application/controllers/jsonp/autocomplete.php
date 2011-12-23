<?php

/**
 * System Administrative Page
 */
class Autocomplete extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> library('ls_profile');
		$this -> load -> library('ion_auth');
		$this -> load -> library('input');
		$this -> load -> library('json');
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

	function name() {

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

		$this -> db -> select('*');
		$this -> db -> from('lss_users_profile AS lup');
		$this -> db -> like('alias', $keywords);
		$this -> db -> or_like('firstname', $keywords);
		$this -> db -> or_like('lastname', $keywords);
		$this -> db -> join('lss_users_profile_social_links AS lupsl', 'lupsl.user_id = lup.user_id', 'left');
		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			$this -> data['results'] = ($query -> result_array());
		}

		$this -> json -> json_prep($this -> data);

	}


}
