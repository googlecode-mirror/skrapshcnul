<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pub extends CI_Controller {

	function __construct() {
		//default constructor
		parent::__construct();

		//load database, libraries, helpers, models
		$this -> load -> database();
		$this -> load -> config('linkedin_oauth', TRUE);
		$this -> load -> config('users', TRUE);
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> library('input');
		$this -> load -> helper('logger');
		$this -> load -> helper('linkedin/linkedin_api');
		$this -> load -> model('linkedin/linkedin_model');
		$this -> load -> model('preferences_model');
		$this -> load -> model('user_model');
		$this -> load -> model('user_rating_model');
		$this -> load -> model('user_lunch_wishlist_model');
		$this -> load -> model('user_lunch_buddy_model');

		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();

		// Initialize
		if ($this -> data['is_logged_in']) {
			if ($this -> session -> userdata('linkedin_pulled') == NULL) {
				$this -> session -> set_userdata('linkedin_pulled', $this -> linkedin_model -> selectLinkedInDataForCurrentUser() != NULL);
			}
		}
		
		$this->user_id = $this -> session -> userdata('user_id');
		
		// Request Params: alt = json | , 
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : '';
		$this -> call = (isset($_REQUEST['call'])) ? $_REQUEST['call'] : '';
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : '';
		$this -> request_method = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : '';
		
		$this -> start_time = time();
	}

	function _remap($method) {
		$this->index();
	}

	function index() {

		$this->data['target_user_id'] = $this->uri->segment(2);
		if (!is_numeric($this->data['target_user_id'])) {
			$this->data['target_user_id'] = $this->user_model->select_user_id_by_username($this->uri->segment(2));
		}
		
		$this -> _prepare_profile_data();
		$this -> _prepare_profile_data_default();
		$this -> _prepare_profile_statistics();
		
		// Render views
		$this -> data['tpl_page_id'] = 'profile';
		$this -> data['main_content'] = 'pub/user_profile';
		$this -> load -> view('includes/tmpl_layout', $this -> data);
		
	}

	function _prepare_profile_data() {
		try {
			// Linked In 
			$external_data['linkedin'] = $this -> linkedin_model -> selectLinkedInData($this->data['target_user_id']);
			if (isset($external_data['linkedin'] -> data)) {
				$linkedin_data = new SimpleXMLElement($external_data['linkedin'] -> data);
				
				//var_dump($linkedin_data);
				
				// Setup Profile Picture
				if ($linkedin_data->{'picture-url'}) {
					$this->data['profile']['profile_img'] = ($linkedin_data->{'picture-url'}) ;
				}
				if(($linkedin_data->{'first-name'})) {
					$this->data['profile']['first_name'] = ($linkedin_data->{'first-name'});
				}
				if(($linkedin_data->{'last-name'})) {
					$this->data['profile']['last_name'] = ($linkedin_data->{'last-name'});
				}
				if(($linkedin_data->{'headline'})) {
					$this->data['profile']['headline'] = ($linkedin_data->{'headline'});
				}
				if(($linkedin_data->{'location'})) {
					$this->data['profile']['location'] = ($linkedin_data->{'location'});
				}
				if(($linkedin_data->{'positions'})) {
					foreach($linkedin_data->{'positions'}->position as $position) {
						$this->data['profile']['positions'][] = $position;
					}
				}
				if(($linkedin_data->{'public-profile-url'})) {
					$this->data['profile']['social_network']['linkedin_url'] = $linkedin_data->{'public-profile-url'};
				}
				if(($linkedin_data->{'educations'})) {
					foreach($linkedin_data->{'educations'}->education as $education) {
						$this->data['profile']['educations'][] = $education;
					}
				}
				if(($linkedin_data->{'interests'})) {
					$this->data['profile']['interests'] = $linkedin_data->{'interests'};
				}
				
				//var_dump($this->data['profile']);
			}
			
		} catch (exception $e) {
			
		}
	}

	function _prepare_profile_data_default() {
		
		// Setup Cover Photo
		if(!isset($this->data['profile']['cover_background'])) {
			$this->data['profile']['cover_background'] = base_url() . "/skin/images/960/cover_background.jpg";
		}
		// Setup Profile Picture
		if (!isset($this->data['profile']['profile_img'])) {
			$this->data['profile']['profile_img'] = base_url().'skin/images/100/icon_no_photo_no_border_offset_100x100.png';
			$this->data['profile']['profile_img'] = base_url() . "/skin/images/160/silhouette_male.jpg";
		}
		// Setup first name last name
		if(!isset($this->data['profile']['first_name'])) {
			$this->data['profile']['first_name'] = '';
		}
		if(!isset($this->data['profile']['last_name'])) {
			$this->data['profile']['last_name'] = '';
		}
		if(!isset($this->data['profile']['headline'])) {
			$this->data['profile']['headline'] = '';
		}
		if(!isset($this->data['profile']['location'])) {
			$this->data['profile']['location'] = '';
		}
	}

	function _prepare_profile_statistics() {
		
		// User Rating
		$this->data['profile_stats']['rating'] = $this -> user_rating_model -> selectRating($this->user_id);
		if (!$this->data['profile_stats']['rating']) {
			$this->data['profile_stats']['rating'] = 0;
		} else {
			$this->data['profile_stats']['rating'] = $this->data['profile_stats']['rating']->points;
		}
		
		// Verfified Name
		$this->data['profile_stats']['verified_name'] = '';
		
		// Add To Lunch state
		$this->data['profile_stats']['lunch_wishlist'] = $this->user_lunch_wishlist_model->select_list($this->user_id);
		
		// Lunch buddy list
		if(!isset($this->data['profile_stats']['lunch_buddy_list'])) {
			$this->data['profile_stats']['lunch_buddy_list'] =$this->user_lunch_buddy_model->select_list($this->user_id);
		}
		/*
		$lunch_buddy_list[] = array('name' => 'Mike Shinoda', 'profile_img' => 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/275478_100002977900608_1522924766_q.jpg');
		$lunch_buddy_list[] = array('name' => 'Chris Kalani', 'profile_img' => 'http://profile.ak.fbcdn.net/hprofile-ak-ash2/276072_506749663_2438631_q.jpg');
		$lunch_buddy_list[] = array('name' => 'Robert Scoble', 'profile_img' => 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/174530_501319654_5423543_q.jpg');
		$lunch_buddy_list[] = array('name' => 'Julie Zhuo', 'profile_img' => 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/49138_206186_1910_q.jpg');
		$this->data['profile_stats']['lunch_buddy_list'] = $lunch_buddy_list;
		*/
		
		if(!isset($this->data['profile_stats']['activity_list'])) {
			$this->data['profile_stats']['activity_list'] = array();
		}
		/*
		$activity_list[] = array('message' => "&lt;User&gt; had lunch with &lt;User2&gt;. ", 'created_on' => time());
		$activity_list[] = array('message' => "&lt;User&gt; had lunch with &lt;User2&gt;. ", 'created_on' => time());
		$this -> data['activity_list'] = $activity_list;
		*/
		if(!isset($this->data['profile_stats']['upcoming_lunches'])) {
			$this->data['profile_stats']['upcoming_lunches'] = array();
		}
		/*
		$activity_list[] = array('message' => "&lt;User&gt; had lunch with &lt;User2&gt;. ", 'created_on' => time());
		$activity_list[] = array('message' => "&lt;User&gt; had lunch with &lt;User2&gt;. ", 'created_on' => time());
		$this -> data['activity_list'] = $activity_list;
		*/
		
	}

	function _json_prep($results) {
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		
		
		if ($this -> callback) {
			$json_result['completed_in'] =  number_format(time() - $this -> start_time, 3, '.', '');
			$json_result['results'][] = $results;
			print_r($this -> callback. '('.json_encode($json_result) .')');
		} else {
			$json_result = $results;
			print_r(json_encode($json_result));
		}
		
	}

}
?>
