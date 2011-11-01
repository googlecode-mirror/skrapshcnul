<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Settings extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> helper('logger');
		$this -> load -> helper('linkedin/linkedin_api');
		$this -> load -> model('linkedin/linkedin_model');
		$this -> load -> helper('url');
		$this -> load -> config('linkedin_oauth', TRUE);
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> session -> set_flashdata('system_message', '');

		if (!$this -> ion_auth -> logged_in()) {
			// Not Logged in? Redirect them back to login page.
			redirect('login', 'refresh');
		}
		
		// Request Params: alt = json | , 
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> call = (isset($_REQUEST['call'])) ? $_REQUEST['call'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';
		$this -> request_method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : '';
		
		$this -> start_time = time();
		
	}

	function index($value = '') {
		// Default to general
		$this -> overview();
	}

	function overview($value = '') {

		// Tpl setup
		$this -> data['tpl_page_id'] = "overview";
		$this -> data['tpl_page_title'] = "Account Overview";

		// Render view
		$this -> data['main_content'] = 'settings/overview';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function sync() {
		switch($this->uri->segment(3)) {
			case 'pullLinkedInData' :
				$this -> pullLinkedInData();
		}

		$external_data['linkedin'] = $this -> linkedin_model -> selectLinkedInDataForCurrentUser();
		$this -> data['external_data'] = $external_data;

		// Tpl setup
		$this -> data['tpl_page_id'] = "sync";
		$this -> data['tpl_page_title'] = "Sync";

		// Render view
		$this -> data['main_content'] = 'settings/sync';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function security() {

		// Tpl setup
		$this -> data['tpl_page_id'] = "security";
		$this -> data['tpl_page_title'] = "Security";

		// Render view
		$this -> data['main_content'] = 'settings/security';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function privacy() {

		// Tpl setup
		$this -> data['tpl_page_id'] = "privacy";
		$this -> data['tpl_page_title'] = "Privacy";

		// Render view
		$this -> data['main_content'] = 'settings/privacy';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function language() {

		// Tpl setup
		$this -> data['tpl_page_id'] = "language";
		$this -> data['tpl_page_title'] = "Language";

		// Render view
		$this -> data['main_content'] = 'settings/language';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function notifications() {

		// Tpl setup
		$this -> data['tpl_page_id'] = "notifications";
		$this -> data['tpl_page_title'] = "Notifications";

		// Render view
		$this -> data['main_content'] = 'settings/notifications';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function applications() {

		// Tpl setup
		$this -> data['tpl_page_id'] = "applications";
		$this -> data['tpl_page_title'] = "Applications";

		// Render view
		$this -> data['main_content'] = 'settings/applications';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function mobile() {

		// Tpl setup
		$this -> data['tpl_page_id'] = "mobile";
		$this -> data['tpl_page_title'] = "Mobile";

		// Render view
		$this -> data['main_content'] = 'settings/mobile';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function payments() {

		// Tpl setup
		$this -> data['tpl_page_id'] = "payments";
		$this -> data['tpl_page_title'] = "Payments";

		// Render view
		$this -> data['main_content'] = 'settings/Payments';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
	}

	function pullLinkedInData() {
		/**
		 * Helper function that checks to see that we have a 'set' $_SESSION that we can
		 * use for the demo.
		 */
		
		function oauth_session_exists() {
			if ((is_array($_SESSION)) && (array_key_exists('oauth', $_SESSION))) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		try {
			session_start();

			// display constants
			$API_CONFIG = array('appKey' => $this -> config -> item('linkedin_appKey', 'linkedin_oauth'), 'appSecret' => $this -> config -> item('linkedin_appSecret', 'linkedin_oauth'), 'callbackUrl' => NULL);
			define('CONNECTION_COUNT', 20);
			define('PORT_HTTP', '80');
			define('PORT_HTTP_SSL', '443');
			define('UPDATE_COUNT', 10);

			// set index
			$_REQUEST[LINKEDIN::_GET_TYPE] = (isset($_REQUEST[LINKEDIN::_GET_TYPE])) ? $_REQUEST[LINKEDIN::_GET_TYPE] : '';

			switch($_REQUEST[LINKEDIN::_GET_TYPE]) {
				case 'initiate' :
				// check for the correct http protocol (i.e. is this script being served via http or https)
					if (!empty($_SERVER['HTTPS'])) {
						$protocol = 'https';
					} else {
						$protocol = 'http';
					}

					// set the callback url
					$API_CONFIG['callbackUrl'] = $protocol . '://' . $_SERVER['SERVER_NAME'] . ((($_SERVER['SERVER_PORT'] != PORT_HTTP) || ($_SERVER['SERVER_PORT'] != PORT_HTTP_SSL)) ? ':' . $_SERVER['SERVER_PORT'] : '') . $_SERVER['PHP_SELF'] . '?' . LINKEDIN::_GET_TYPE . '=initiate&' . LINKEDIN::_GET_RESPONSE . '=1';

					$OBJ_linkedin = new LinkedIn($API_CONFIG);

					// check for response from LinkedIn
					$_GET[LINKEDIN::_GET_RESPONSE] = (isset($_GET[LINKEDIN::_GET_RESPONSE])) ? $_GET[LINKEDIN::_GET_RESPONSE] : '';

					if (!$_GET[LINKEDIN::_GET_RESPONSE]) {
						// LinkedIn hasn't sent us a response, the user is initiating the connection

						// send a request for a LinkedIn access token
						$response = $OBJ_linkedin -> retrieveTokenRequest();
						if ($response['success'] === TRUE) {		
							// store the request token
							$_SESSION['oauth']['linkedin']['request'] = $response['linkedin'];
					
							// redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
							header('Location: ' . LINKEDIN::_URL_AUTH . $response['linkedin']['oauth_token']);
						} else {
							// bad token request
							echo "Request token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
						}
					} else {
						// LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
						$response = $OBJ_linkedin -> retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_GET['oauth_verifier']);
						if ($response['success'] === TRUE) {
							// the request went through without an error, gather user's 'access' tokens
							$_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];

							// set the user as authorized for future quick reference
							$_SESSION['oauth']['linkedin']['authorized'] = TRUE;

							// pulling everything in LinkedIn
							$fields = "id," . "first-name," . "last-name," . "headline," . "location," . "industry," . "distance," . "relation-to-viewer," . "current-share," . "connections," . "num-connections," . "num-connections-capped," . "summary," . "specialties," . "proposal-comments," . "associations," . "honors," . "interests," . "positions," . "publications," . "patents," . "languages," . "skills," . "certifications," . "educations," . "three-current-positions," . "three-past-positions," . "num-recommenders," . "recommendations-received," . "phone-numbers," . "im-accounts," . "twitter-accounts," . "date-of-birth," . "main-address," . "member-url-resources," . "picture-url," . "site-standard-profile-request," . "api-public-profile-request," . "site-public-profile-request," . "api-standard-profile-request," . "public-profile-url";

							$info = $OBJ_linkedin -> profile('~:(' . $fields . ')');

							if ($info['success'] === TRUE) {
								// store user's data in database
								$info['linkedin'] = new SimpleXMLElement($info['linkedin']);
								$linkedin_data = $info['linkedin'] -> asXML();

								//Logger::log($linkedin_data);

								if ($this -> linkedin_model -> insertLinkedInDataForCurrentUser($linkedin_data)) {
									//echo 'Your profile has been synchronized with Linkedin! Redirecting...';
									redirect('user/profile', 'refresh');
								} else {
									echo 'Error occurred! Please try again later.';
								}
							} else {
								// profile retrieval failed
								echo "Error retrieving profile information:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($info) . "</pre>";
							}
						} else {
							// bad token access
							echo "Access token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
						}
					}
					break;

				default :
					echo 'Error: No page found!';
					break;
			}
		} catch(LinkedInException $e) {
			// exception raised by library call
			echo $e -> getMessage();
		}
	}

}
