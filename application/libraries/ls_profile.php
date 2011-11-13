<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Name:  Notification
 * Author: @stiucsib86
 * Created:  11.09.2011
 * Description:
 * Requirements: PHP5 or above
 */
class Ls_Profile {

	function __construct() {

		$this -> ci = &get_instance();
		$this -> ci -> load -> database();
		$this -> ci -> load -> config('linkedin_oauth', TRUE);
		$this -> ci -> load -> config('users', TRUE);
		$this -> ci -> load -> library('ion_auth');
		$this -> ci -> load -> library('session');
		$this -> ci -> load -> library('form_validation');
		$this -> ci -> load -> library('input');
		$this -> ci -> load -> helper('logger');
		$this -> ci -> load -> helper('linkedin/linkedin_api');
		$this -> ci -> load -> model('linkedin/linkedin_model');
		$this -> ci -> load -> model('preferences_model');
		$this -> ci -> load -> model('user_model');
		$this -> ci -> load -> model('user_rating_model');
		$this -> ci -> load -> model('user_lunch_wishlist_model');
		$this -> ci -> load -> model('user_lunch_buddy_model');
		$this -> ci -> load -> model('user_profile_model');
		
		// Set Config
		$this -> component_class = $this -> ci -> config -> item('component_class', 'ls_notifications');
		//auto-login the user if they are remembered
		if (!$this -> ci -> ion_auth -> logged_in() && get_cookie('identity') && get_cookie('remember_code')) {
			$this -> ci -> ion_auth = $this;
			$this -> ci -> ion_auth_model -> login_remembered_user();
		}

		$this -> ci -> ion_auth_model -> trigger_events('library_constructor');
	}
	
	function _prepare_profile_data($user_id) {
		try {
			// Linked In 
			$external_data['linkedin'] = $this -> ci -> linkedin_model -> selectLinkedInData($user_id);
			
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
				
				// Update ls_profile fields
				$fields['firstname']		= $linkedin_data->{'first-name'};
				$fields['lastname']			= $linkedin_data->{'last-name'};
				$fields['profile_img']		= $linkedin_data->{'picture-url'};
				$fields['mobile_number']	= $linkedin_data->{'phone-numbers'}->{'phone-number'}->{'phone-number'};
				
				$this -> ci -> user_profile_model -> update_fromLinkedInData($user_id, $fields);
				
				return $this->data['profile'];
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
	
	function _prepare_profile_statistics($user_id) {
		
		// User Rating
		$this->data['profile_stats']['rating'] = $this -> ci -> user_rating_model -> selectRating($user_id);
		if (!$this->data['profile_stats']['rating']) {
			$this->data['profile_stats']['rating'] = 0;
		} else {
			$this->data['profile_stats']['rating'] = $this->data['profile_stats']['rating']->points;
		}
		
		// Verfified Name
		$this->data['profile_stats']['verified_name'] = '';
		
		// Add To Lunch state
		$this->data['profile_stats']['lunch_wishlist'] = $this -> ci -> user_lunch_wishlist_model->select_list($user_id);
		
		// Lunch buddy list
		if(!isset($this->data['profile_stats']['lunch_buddy_list'])) {
			$this->data['profile_stats']['lunch_buddy_list'] =$this -> ci -> user_lunch_buddy_model->select_list($user_id);
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
		
		return $this->data['profile_stats'];
		
	}

}
?>