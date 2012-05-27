<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Event extends REST_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('session');
		$this -> load -> library('ion_auth');
		$this -> load -> library('ls_exception');
		$this -> load -> library('ls_events');
		$this -> load -> database();
		$this -> load -> helper('url');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> data['is_logged_in_admin'] = $this->ion_auth->is_admin();
		$this->user_id = $this -> session -> userdata('user_id');
	}

	/**
	 * Remap URI Segments
	 */
	function _remap($method = FALSE) {
		
		## TODO: testing

		$event_id = $method;
		
		switch ($this -> _detect_method()) {
			case 'get':
				//no need to retrieve event by event_id
				break;
			case 'post':
				$result = $this->ls_events->create($this->_post_args);
				$this->response($result);
				break;
			case 'put':
				$result = $this->ls_events->rvsp($this->_put_args);
				$this->response($result);
				break;
			case 'delete':
				// no need to delete event
				break;
		}
		
	}

}
?>