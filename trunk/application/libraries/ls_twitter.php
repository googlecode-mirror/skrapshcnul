<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Name:  Lunchsparks Twitter Library
 * Author: @stiucsib86
 * Created:  15.03.2012
 * Description:
 * Requirements: PHP5 or above
 */
class Ls_Twitter {

	function __construct() {

		$this -> ci = &get_instance();
		$this -> ci -> load -> library('twitter/tweet');
		$this -> ci -> load -> model('oauth_model');
		$this -> ci -> load -> model('twitter/twitter_model');

		// Enabling debug will show you any errors in the calls you're making, e.g:
		$this -> ci -> tweet -> enable_debug(TRUE);

	}

	public function login($fields = FALSE, $options = FALSE) {

		die('No implemented');

		$email = $this -> fb_data['user_profile']['email'];
		return $this -> ci -> oauth_model -> register($email);

	}

	public function select_data($fields = FALSE, $options = FALSE) {

		$result = $this -> ci -> twitter_model -> select_data();

		if (isset($result['data']) && !is_array($result['data'])) {
			$result['data'] = json_decode($result['data'], TRUE);
		}

		return $result;

	}

	public function update_data() {

		if ($this -> permission_denied())
			return FALSE;

		$tokens = $this -> ci -> tweet -> get_tokens();

		try {
			$user = $this -> ci -> tweet -> call('get', 'account/verify_credentials');
			$fields['tw_id'] = $user -> id;
			$fields['data']['profile'] = $user;

			$fields['data']['friends'] = $this -> ci -> tweet -> call('get', '1/friends/ids', array('screen_name' => $user -> screen_name));

			$fields['data']['suggestions'] = $this -> ci -> tweet -> call('get', '1/users/suggestions');

			$fields['data']['profile_image'] = $this -> get_profile_image_url($user -> profile_image_url_https);

			return $this -> ci -> twitter_model -> update_data($fields);

		} catch(Exception $e) {
			// Log error
		}

		return FALSE;

	}

	public function permission_denied() {

		if (isset($_REQUEST['denied'])) {
			return TRUE;
		}
		
		if (!$this -> ci -> tweet -> logged_in()) {
			// This is where the url will go to after auth.
			// ( Callback url )
			$this -> ci -> tweet -> set_callback($this -> getCurrentUrl());

			// Send the user off for login!
			$this -> ci -> tweet -> login();
			die();
		}
		
		return FALSE;

	}

	/**
	 * Returns the Current URL, stripping it of known FB parameters that should
	 * not persist.
	 *
	 * @return string The current URL
	 */
	public function getCurrentUrl() {
		if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
			$protocol = 'https://';
		} else {
			$protocol = 'http://';
		}
		$currentUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$parts = parse_url($currentUrl);

		$query = '';
		if (!empty($parts['query'])) {
			// drop known fb params
			$params = explode('&', $parts['query']);
			$retained_params = array();
			foreach ($params as $param) {
				if ($this -> shouldRetainParam($param)) {
					$retained_params[] = $param;
				}
			}

			if (!empty($retained_params)) {
				$query = '?' . implode($retained_params, '&');
			}
		}

		// use port if non default
		$port = isset($parts['port']) && (($protocol === 'http://' && $parts['port'] !== 80) || ($protocol === 'https://' && $parts['port'] !== 443)) ? ':' . $parts['port'] : '';

		// rebuild
		return $protocol . $parts['host'] . $port . $parts['path'] . $query;
	}

	// Helper function to get profile images of different sizes.
	// Size param references https://dev.twitter.com/docs/api/1/get/users/profile_image/:screen_name
	private function get_profile_image_url($profile_img_url = FALSE, $size = '') {

		if (!$profile_img_url)
			return FALSE;

		switch ($size) {
			case 'bigger' :
			case 'mini' :
			case 'normal' :
				return str_replace('_normal', $size, $profile_img_url);
				break;
			case 'original' :
			default :
				$size = '';
				return str_replace('_normal', $size, $profile_img_url);
				break;
		}

		return $profile_img_url;
	}

	// note this wrapper function exists in order to circumvent PHP’s
	//strict obeying of HTTP error codes.  In this case, Facebook
	//returns error code 400 which PHP obeys and wipes out
	//the response.
	private function curl_get_file_contents($URL) {
		$c = curl_init();
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($c, CURLOPT_URL, $URL);
		$contents = curl_exec($c);
		$err = curl_getinfo($c, CURLINFO_HTTP_CODE);
		curl_close($c);
		if ($contents)
			return $contents;
		else
			return FALSE;
	}

}
?>