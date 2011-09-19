<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User extends CI_Controller {
	
	function __construct() {    
    //default constructor
		parent::__construct();    
    
    //load database, libraries, helpers, models
		$this->load->database();    
    
    $this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
    $this->load->library('input');				        
    
    $this->load->helper('logger');
    $this->load->helper('linkedin/linkedin_api');        
    
    $this->load->model('linkedin/linkedin_model');
    
		// Set Global Variables
		$this->data['is_logged_in'] = $this->ion_auth->logged_in();
	}

	function index() {
		// Check if user is logged in
		if (!$this->ion_auth->logged_in()) {
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		} else {
			$this->profile();
		}
	}

	function profile() {
    // Check if user is logged in
		if (!$this->ion_auth->logged_in()) {
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
    
		/* dummy data */
		$user_data['profile_img'] = "Profile Picture";
		$user_data['name'] = "name";
		$user_data['title'] = "Platform Engineer";
		$user_data['company'] = "Lunchsparks Pte. Ltd.";
		$this->data['user_profile'] = $user_data;
		
		$activity_item['data'] = "&lt;User&gt; had lunch with &lt;User2&gt;. ";
		$this->data['activity_list'][] = $activity_item;
		
		$activity_item['data'] = "&lt;User&gt; has joined Lunchsparks. ";
		$this->data['activity_list'][] = $activity_item;
								
		$this->data['main_content'] = 'user/user_profile';
		$this -> load -> view('includes/tmpl_layout', $this->data);
	}  
  
  function pullLinkedInData() {
     /**
     * Helper function that checks to see that we have a 'set' $_SESSION that we can
     * use for the demo.
     */ 
    function oauth_session_exists() {
      if((is_array($_SESSION)) && (array_key_exists('oauth', $_SESSION))) {
        return TRUE;
      } else {
        return FALSE;
      }
    }

    try {      
      session_start();
      
      // display constants
      $API_CONFIG = array(
        'appKey'       => $config['linkedin_appKey'],
        'appSecret'    => $config['linkedin_appSecret'],
        'callbackUrl'  => NULL
      );
      define('CONNECTION_COUNT', 20);
      define('PORT_HTTP', '80');
      define('PORT_HTTP_SSL', '443');
      define('UPDATE_COUNT', 10);

      // set index
      $_REQUEST[LINKEDIN::_GET_TYPE] = (isset($_REQUEST[LINKEDIN::_GET_TYPE])) ? 
        $_REQUEST[LINKEDIN::_GET_TYPE] : '';

      switch($_REQUEST[LINKEDIN::_GET_TYPE]) {
        case 'initiate': 
          // check for the correct http protocol (i.e. is this script being served via http or https)
          if(!empty($_SERVER['HTTPS'])) {
            $protocol = 'https';
          } else {
            $protocol = 'http';
          }

          // set the callback url
          $API_CONFIG['callbackUrl'] = $protocol . '://' . 
            $_SERVER['SERVER_NAME'] . 
            ((($_SERVER['SERVER_PORT'] != PORT_HTTP) || ($_SERVER['SERVER_PORT'] != PORT_HTTP_SSL)) ? ':' . $_SERVER['SERVER_PORT'] : '') . 
            $_SERVER['PHP_SELF'] . '?' . LINKEDIN::_GET_TYPE . '=initiate&' . LINKEDIN::_GET_RESPONSE . '=1';

          $OBJ_linkedin = new LinkedIn($API_CONFIG);

          // check for response from LinkedIn
          $_GET[LINKEDIN::_GET_RESPONSE] = (isset($_GET[LINKEDIN::_GET_RESPONSE])) ? 
            $_GET[LINKEDIN::_GET_RESPONSE] : '';

          if(!$_GET[LINKEDIN::_GET_RESPONSE]) {
            // LinkedIn hasn't sent us a response, the user is initiating the connection

            // send a request for a LinkedIn access token
            $response = $OBJ_linkedin->retrieveTokenRequest();
            if($response['success'] === TRUE) {
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
            $response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_GET['oauth_verifier']);
            if($response['success'] === TRUE) {
              // the request went through without an error, gather user's 'access' tokens
              $_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];

              // set the user as authorized for future quick reference
              $_SESSION['oauth']['linkedin']['authorized'] = TRUE;

              // pulling everything in LinkedIn
              $fields = "id," . "first-name," . "last-name," . "headline," .
                      "location," . "industry," . "distance," . 
                      "relation-to-viewer," . "current-share," . 
                      "connections," . "num-connections," . 
                      "num-connections-capped," . "summary," . "specialties," . 
                      "proposal-comments," . "associations," . "honors," . 
                      "interests," . "positions," . "publications," . 
                      "patents," . "languages,". "skills," . 
                      "certifications," . "educations," . 
                      "three-current-positions," . "three-past-positions," .
                      "num-recommenders," . "recommendations-received," .
                      "phone-numbers," . "im-accounts," . "twitter-accounts," .
                      "date-of-birth," . "main-address," . 
                      "member-url-resources," . "picture-url," .
                      "site-standard-profile-request," . 
                      "api-public-profile-request," .
                      "site-public-profile-request," .
                      "api-standard-profile-request," .
                      "public-profile-url";                      
              
              $info = $OBJ_linkedin->profile('~:(' . $fields . ')');

              if($info['success'] === TRUE) {
                // store user's data in database
                $info['linkedin'] = new SimpleXMLElement($info['linkedin']);
                $linkedin_data = $info['linkedin']->asXML();
                
                //Logger::log($linkedin_data);
                
                if ($this->linkedin_model->insertLinkedInDataForCurrentUser($linkedin_data)) {
                  ?>
                  Your profile has been synchronized with Linkedin! Redirecting...
                  <?php
                  redirect('user/profile', 'refresh');
                }
                else {
                  ?>
                  Error occurred! Please try again later.
                  <?
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

        default:
          ?>
          Error: No page found!
          <?php
          break;
      }
    } catch(LinkedInException $e) {
      // exception raised by library call
      echo $e->getMessage();
    }
  }
}
?>
