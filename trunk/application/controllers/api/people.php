<?php

/**
 * System Administrative Page
 */
class People extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('session');
		$this -> load -> library('ion_auth');
		$this -> load -> database();
		$this -> load -> helper('url');
	}
	
	function index($value = '') {
		
		## Check for access validity
		
		## Check for required parameters
		if (!isset($_REQUEST['query'])) {
			$error['reason'] = "required";
			$error['type'] = "parameter";
			$error['message'] = "Required parameter: query";
    		$this -> json_result['errors'][] = $error;
			$this -> _prep_json();
			return FALSE;
		}
		
		## Headers
		$this -> json_result['kind'] 		= "ls#peopleFeed";
		$this -> json_result['title']		= "People Search Feed";
		$this -> json_result['selfLink']	= "";
		$this -> json_result['nextPage']	= "";
		
		## Set request parameters
		$this->maxResults	= isset($_REQUEST['maxResults']) ?  $_REQUEST['maxResults'] : '10';
		
		
		
		$this -> json_result['results'][] = "";
		$this -> _prep_json();
		
		
	}
	
	private function _prep_json() {
		
		##header('Cache-Control: no-cache, must-revalidate');
		##header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		##header('Expires: '. date("r", time()));
		##header('Content-type: application/json; charset=UTF-8');
		
		##print_r(json_encode($this -> json_result));
		
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode($this -> json_result))
		    ->set_header("Cache-Control: no-store, no-cache, must-revalidate")
			->set_header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		
	}
}
?>