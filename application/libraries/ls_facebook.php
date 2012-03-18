<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Name:  Lunchsparks Facebook Library
 * Author: @stiucsib86
 * Created:  15.03.2012
 * Description:
 * Requirements: PHP5 or above
 */
class Ls_Facebook {

	function __construct() {

		$this -> ci = &get_instance();
		$this -> ci -> load -> config('facebook_oauth', TRUE);
		$this -> ci -> load -> model('facebook/facebook_model');
		$this -> ci -> load -> model('oauth_model');

		$this -> fbconfig = $this -> ci -> config -> item('facebook', 'facebook_oauth');
		## Facebook Config
		$config = array('appId' => $this -> fbconfig['app_id'], 'secret' => $this -> fbconfig['app_secret'], 'fileUpload' => true,       // Indicates if the CURL based @ syntax for file uploads is enabled.
		);
		$this -> ci -> load -> library('facebook-php-sdk/facebook', $config);
		$user = $this -> ci -> facebook -> getUser();

		// We may or may not have this data based on whether the user is logged in.
		//
		// If we have a $user id here, it means we know the user is logged into
		// Facebook, but we don't know if the access token is valid. An access
		// token is invalid if the user logged out of Facebook.
		$user_profile = null;
		if ($user) {
			try {
				// Proceed knowing you have a logged in user who's authenticated.
				$user_profile = $this -> ci -> facebook -> api('/me?fields=id,name,link,email');
			} catch (FacebookApiException $e) {
				error_log($e);
				$user = null;
			}
		}
		// Login or logout url will be needed depending on current user state.
		if ($user) {
			$logoutUrl = $this -> ci -> facebook -> getLogoutUrl();
		} else {
			$loginUrl = $this -> ci -> facebook -> getLoginUrl();
		}

		$fb_data = array('user_profile' => $user_profile, 'uid' => $user, 'loginUrl' => $this -> ci -> facebook -> getLoginUrl(array('scope' => $this -> fbconfig['scope'], // app permissions
		'redirect_uri' => $this -> fbconfig['redirect_uri'] // URL where you want to redirect your users after a successful login
		)), 'logoutUrl' => $this -> ci -> facebook -> getLogoutUrl());

		$this -> ci -> session -> set_userdata('fb_data', $fb_data);
		$this -> fb_data = $fb_data;
	}

	public function login($fields = FALSE, $options = FALSE) {

		if (!isset($this -> fb_data['user_profile']['email']) && empty($this -> fb_data['user_profile']['email'])) {
			$redirect_uri = isset($fields['redirect_uri']) ? $fields['redirect_uri'] : $this -> fbconfig['redirect_uri'];
			redirect($this -> ci -> facebook -> getLoginUrl(array('scope' => $this -> fbconfig['scope'], // app permissions
			'redirect_uri' => $redirect_uri)));
		}

		$email = $this -> fb_data['user_profile']['email'];
		return $this -> ci -> oauth_model -> register($email);

	}

	public function select_data($fields = FALSE, $options = FALSE) {

		$result = $this -> ci -> facebook_model -> select_data();
		if (isset($result['data']) && !is_array($result['data'])) {
			$result['data'] = json_decode($result['data'], TRUE);
		}
		if (isset($result['data']['id'])) {
			$result['picture']['normal'] = 'https://graph.facebook.com/'.$result['data']['id'].'/picture?type=normal&access_token=' . $this -> ci -> facebook -> getAccessToken();
		}
		
		return $result;

	}

	public function update_data() {

		try {
				
			$user_profile = $this -> fql_wrapper('https://graph.facebook.com/me');

		} catch(Exception $e) {
			// Log error
		}

		$fields['uid'] = $user_profile['id'];
		$fields['data'] = $user_profile;
		
		return $this -> ci -> facebook_model -> update_data($fields);

	}
	
	public function permission_denied() {
		
		if (isset($_REQUEST['error_reason']) && $_REQUEST['error_reason'] = 'user_denied') {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}
	
	private function fql_wrapper($graph_url = FALSE, $options = FALSE) {
		
		if (!$graph_url) return FALSE;

		if (!strpos($graph_url, 'access_token')) {
			if (!strpos($graph_url, '?')) {
				$graph_url .= "?access_token=" . $this -> ci -> facebook -> getAccessToken();
			} else {
				$graph_url .= "&access_token=" . $this -> ci -> facebook -> getAccessToken();
			}
		}
		
		// Attempt to query the graph:
		$response = $this -> curl_get_file_contents($graph_url);
		$decoded_response = json_decode($response, TRUE);
		
		$params = array();
		if (isset($options['redirect_uri'])) {
			$params['redirect_uri'] = $options['redirect_uri'];
		}
		$dialog_url = $this -> ci -> facebook -> getLoginUrl(array_merge(array('scope' => $this -> fbconfig['scope']), $params));
		
		//Check for errors
		if (isset($decoded_response['error'])) {
			// check to see if this is an oAuth error:
			if ($decoded_response['error']['type'] == "OAuthException") {
				// Retrieving a valid access token.
				echo("<script> top.location.href='" . $dialog_url . "'</script>");
			} else {
				echo "other error has happened";
			}
		} else {
			// success
			return $decoded_response;
		}
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