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

class User extends REST_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('session');
		$this -> load -> library('ion_auth');
		$this -> load -> library('ls_profile');
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
		
		if (isset($this->ruri_assoc['details']) && method_exists($this, $this->ruri_assoc['details'])) {
			$this -> {$this->ruri_assoc['details']}();
		} else {
			
			$this -> _index($method);
			
		}

	}
	
	protected function _index($user_id = FALSE) {
		
		if (!is_numeric($user_id)) {
			// If its not numeric, then search for alias.
			// Convert alias to user_id, if exist
			
			// TODO : Check for alias
			$user_id = 1;
			
		}
		
		if (!$user_id) {
			
			$error['type'] = "OAuthException";
			$error['code'] = 803;
			$error['message'] = "Some of the aliases you requested do not exist: $user_id";
			$this -> json_result['errors'][] = $error;
			$this -> response($this -> json_result, 404);
			
		}
		
		## TODO Temp: Forced function call "index"
		$this -> index_public(1);
		
		## TODO: Check for access validity
		##   redirect to $this -> index_public() if not.
		
		// Set me to current user_id
		if (!$this -> session -> userdata('user_id')) {
			// There is no user session, or user is not logged in
			return $this -> index_public($user_id);
		} else {
			$this -> index($user_id);
		}
		
	}

	protected function index($user_id = FALSE) {
		
		// TODO @iamneit
		//   Reference for data structure https://sites.google.com/a/lunchsparks.me/developers-api-internal/api/user
		
		
		$results['kind'] = "ls#peopleFeed";
		$results['title'] = "People Search Feed";
		$results['selfLink'] = "";
		$results['nextPage'] = "";
		$this -> json_result['results'][] = $results;
		
		$this -> response($this -> json_result);

	}

	protected function index_public($user_id = FALSE) {
		
		// TODO @iamneit
		//   convert the following by retrieving from database.
		
		// Retrieve public data
		/*
		$results['kind'] = "ls#user";
		$results['id'] = "1";
		$results['name']['display_name'] = "Bing Han, Goh";
		$results['name']['first_name'] = "Bing Han";
		$results['name']['last_name'] = "Goh";
		$results['link'] = "https://lunchsparks.me/pub/stiucsib86";
		$results['headline'] = "Application developer at Lunchsparks";
		$results['location']['city'] = "Singapore";
		$results['verification']['status'] = TRUE;
		$results['ratings']['reputation'] = 19;
		$results['added_to_wishlist']['status'] = FALSE;
		$results['added_to_wishlist']['enabled'] = FALSE;
		*/
		
		$fields['user_id'] = $user_id;
		$results = $this -> ls_profile -> getPublicProfile($fields);
		
		$this -> json_result['results'][] = $results;
		$this -> response($this -> json_result);
		
	}

	protected function accounts($value = FALSE) {
		
		/*$error['type'] = "OAuthException";
		$error['code'] = 803;
		$error['message'] = "You do not have access to the user data: $user_id";
		$this -> json_result['errors'][] = $error;
		$this -> response($error, 404);*/
	}
	
	
}
?>