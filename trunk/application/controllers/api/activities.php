<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		@stiucsib86
 */

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Activities extends REST_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('session');
		$this -> load -> library('ion_auth');
		$this -> load -> library('ls_profile');	
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
		
		$this->ruri_assoc = $this -> uri -> ruri_to_assoc();
		
		$this -> _activities($user_id = $method);

	}
	
	protected function _activities($user_id = FALSE) {
		
		switch($this->request->method) {
			case 'get' : 
				if (!is_numeric($user_id)) {
					$this -> _activities_public_get();
				} else {
					$this -> _activities_get($user_id);
				}
				break;
			default :
				$error['type'] = "RequestMethodException";
				$error['code'] = 803; // TODO set this to the correct error code.
				$error['message'] = "The HTTP Request Method you requested is not supported: $this->request->method";
				$this -> json_result['errors'][] = $error;
				$this -> response($this -> json_result, 404);
				break;
		}
		
		
	}

	protected function _activities_public_get() {
		
		// TODO @iamneit
		//   Reference for data structure https://sites.google.com/a/lunchsparks.me/developers-api-internal/api/user
		
		$this -> data['events']['auto_recommendation'] = ($this -> ls_user_recommendation -> getUserRecommendationsByUserId($this -> user_id));
		$this -> data['events']['suggestions'] = ($this -> ls_events -> getEvents($this -> user_id, array(0 => true)));
		$this -> data['events']['upcoming'] = ($this -> ls_events -> getEvents($this -> user_id, array(1 => true)));
		$this -> data['events']['past_events'] = ($this -> ls_events -> getEvents($this -> user_id, array(2 => true)));
		
		$this -> response($this -> json_result);

	}

	protected function _activities_get($user_id = FALSE) {
		
		// TODO @iamneit
		//   convert the following by retrieving from database.
		
		$this -> json_result['results']['suggestions'] = ($this -> ls_events -> getEvents($this -> user_id, array(0 => true)));
		$this -> json_result['results']['upcoming'] = ($this -> ls_events -> getEvents($this -> user_id, array(1 => true)));
		$this -> json_result['results']['past_events'] = ($this -> ls_events -> getEvents($this -> user_id, array(2 => true)));
		
		$this -> response($this -> json_result);
		
	}
	
}
?>