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
		$this -> ci -> load -> helper('image/image_resize');
		$this -> ci -> load -> helper('logger');
		$this -> ci -> load -> helper('linkedin/linkedin_api');
		$this -> ci -> load -> model('linkedin/linkedin_model');
		$this -> ci -> load -> model('invitation_model');
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

	function getPublicProfile($fields = FALSE, $options = FALSE) {
		
		if (!$fields) return FALSE;
		
		if(!isset($fields['user_id']) || !is_numeric($fields['user_id'])) {
			return FALSE;
		}
		
		$data = $this -> ci -> user_profile_model -> select($fields['user_id']);
		
		## Default Values
		if (empty($data['profile_img']) || !@getimagesize($data['profile_img'])) {
			$data['profile_img'] = base_url() . "skin/images/svgs/silhouette_male.svg";
		};
		if (empty($data['firstname'])) {
			$data['firstname'] = $data['username'];
		};
		
		## Output Data
		$result['kind'] = "ls#person";
		$result['id'] = $data['id'];
		$result['display_name'] = $data['firstname'];
		if (isset($data['lastname']) && !empty($data['lastname'])) {
			$result['display_name'] .= ', ' . $data['lastname'];
		}
		$result['fullname']['first'] = $data['firstname'];
		$result['fullname']['last'] = $data['lastname'];
		$result['profile_img'] = $data['profile_img'];
		$result['headline'] = $data['headline'];
		$result['location'] = $data['location'];
		$result['ls_pub_url'] = $data['ls_pub_url'];
		if (isset($data['verification']))
			$result['verification'] = $data['verification'];
		
		// Options
		if (1 || isset($options['stats'])) {
			$result['statistics'] = $this -> ci -> user_profile_model -> select_statistics($fields['user_id']);
		}
		
		return $result;
		
	}

	public function select_all_users($fields = FALSE, $options = FALSE) {
		
		## ---------- Pagination ----------
		if (!isset($options['offset'])) {
			$options['offset'] = 0;
		}
		if (!isset($options['row_count'])) {
			$options['row_count'] = 30;
		}
		if (isset($options['page'])) {
			if (!isset($options['offset'])) {
				$options['offset'] = ($options['page'] - 1) * $options['row_count'];
			}
		}
		if (isset($options['count_all_results']) && $options['count_all_results']) {
			return $this -> ci -> user_model -> select_all_users($fields, $options);
		}
		## ---------- [END] Pagination ----------
		
		$results = $this -> ci -> user_model -> select_all_users($fields, $options);
		
		## TODO Filter by Scope
		if (isset($options['scope'])) {
			switch($options['scope']) {
				case 'friends' :
				case 'extended_network' :
				default:
					break;
			}
		}
		
		## Get User Public Data
		foreach ($results as $key => $user_data) {
			$fields['user_id'] = $user_data['user_id'];
			$results[$key] = $this -> ci -> ls_profile -> getPublicProfile($fields);
		}
		
		return $results;
		
		
	}
	
	private function _init($user_id) {
		
		$profile = $this -> ci -> user_profile_model -> select($user_id);
		$social_links = $this -> ci -> user_profile_model -> select_social_links($user_id);
		$invitation = $this -> ci -> invitation_model -> selectInvitation($user_id);
		
		$profile['first_name'] = $profile['firstname'];
		$profile['last_name'] = $profile['lastname'];
		
		## Data Sanitization
		if (!is_array($profile)) $social = json_decode(json_encode($profile), TRUE);
		if (!is_array($social_links)) $social_links = json_decode(json_encode($social_links), TRUE);
		if (!is_array($invitation)) $invitation = json_decode(json_encode($invitation), TRUE);
		$results = array_merge($invitation, $social_links, $profile);
		return $results;
	}
	
	function prepare_profile_data($user_id = FALSE) {
		
		if(!$user_id || !is_numeric($user_id)) {
			return FALSE;
		}
		
		try {
			$this->data['profile'] = $this -> _init($user_id);
			
			$this -> _prepare_profile_data_default($user_id);
			
			#####################
			##  Linked In
			###################### 
			$external_data['linkedin'] = $this -> ci -> linkedin_model -> selectLinkedInData($user_id);
			
			if (isset($external_data['linkedin'] -> data)) {
				$linkedin_data = new SimpleXMLElement($external_data['linkedin'] -> data);
				
				//var_dump($linkedin_data);
				
				// Setup Profile Picture
				if ($linkedin_data->{'picture-url'}) {
					$this->data['profile']['profile_img'] = ($linkedin_data->{'picture-url'}).'';
				}
				if(($linkedin_data->{'first-name'})) {
					$this->data['profile']['first_name'] = ($linkedin_data->{'first-name'}).'';
				}
				if(($linkedin_data->{'last-name'})) {
					$this->data['profile']['last_name'] = ($linkedin_data->{'last-name'}).'';
				}
				if(($linkedin_data->{'headline'})) {
					$this->data['profile']['headline'] = ($linkedin_data->{'headline'}).'';
				}
				if(($linkedin_data->{'location'})) {
					$this->data['profile']['location'] = json_decode(json_encode($linkedin_data->{'location'}), TRUE);
				}
				if(($linkedin_data->{'positions'})) {
					//$this->data['profile']['positions'] = json_decode(json_encode($linkedin_data->{'positions'}), TRUE);
					foreach($linkedin_data->{'positions'}->position as $position) {
						$this->data['profile']['positions'][] = json_decode(json_encode($position), TRUE);
					}
				}
				if(($linkedin_data->{'public-profile-url'})) {
					$this->data['profile']['social_network']['linkedin_url'] = json_decode(json_encode($linkedin_data->{'public-profile-url'}), TRUE);
				}
				if(($linkedin_data->{'educations'})) {
					foreach($linkedin_data->{'educations'}->education as $education) {
						$this->data['profile']['educations'][] = json_decode(json_encode($education), TRUE);
					}
				}
				if(($linkedin_data->{'interests'})) {
					$this->data['profile']['interests'] = json_decode(json_encode($linkedin_data->{'interests'}), TRUE);
				}
				
				## Update ls_profile fields
				$fields['firstname']		= $linkedin_data->{'first-name'};
				$fields['lastname']			= $linkedin_data->{'last-name'};
				$fields['profile_img']		= $linkedin_data->{'picture-url'};
				$fields['mobile_number']	= $linkedin_data->{'phone-numbers'}->{'phone-number'}->{'phone-number'};
				$fields['location']			= $linkedin_data->{'location'}->{'name'};
				$this -> ci -> user_profile_model -> update_fromLinkedInData($user_id, $fields);
				
				## Update Profile Social Links
				$linkedin_public_profile_url = $linkedin_data->{'public-profile-url'};
				if (!empty($linkedin_public_profile_url)) {
					$fields['linkedin'] = $linkedin_public_profile_url;
					$this -> ci -> user_profile_model -> update_social_links($user_id, $fields);
				}
				
			}
			
			## TODO Twitter
			
			## Verification Status
			$this->data['profile']['verification'] = $this -> ci -> user_profile_model -> get_verification_status($user_id);
			
			## Finally
			return $this->data['profile'];
			
		} catch (exception $e) {
			
		}
	}

	private function _prepare_profile_data_default($user_id = FALSE) {
		
		if (!$user_id || !is_numeric($user_id)) {
			return FALSE;
		}
		
		// Setup Cover Photo
		if(!isset($this->data['profile']['cover_background'])) {
			$this->data['profile']['cover_background'] = base_url() . "skin/images/960/cover_background.jpg";
		}
		// Setup Profile Picture
		if (!isset($this->data['profile']['profile_img'])) {
			$this->data['profile']['profile_img'] = base_url().'skin/images/100/icon_no_photo_no_border_offset_100x100.png';
			$this->data['profile']['profile_img'] = base_url() . "skin/images/svgs/silhouette_male.svg";
		}
		
		$user_details = $this -> ci -> user_model -> select_user($user_id);
		$fullname = $user_details?explode(' ',$user_details->username):FALSE;
		$firstname = isset($fullname[0]) ? $fullname[0] : 'John';
		$lastname = isset($fullname[1]) ? $fullname[1] : '';
		
		// Setup first name last name
		if(!isset($this->data['profile']['first_name'])) {
			$this->data['profile']['first_name'] = $firstname;
		}
		if(!isset($this->data['profile']['last_name'])) {
			$this->data['profile']['last_name'] = $lastname;
		}
		if(!isset($this->data['profile']['headline'])) {
			$this->data['profile']['headline'] = '';
		}
		if(!isset($this->data['profile']['location'])) {
			$this->data['profile']['location'] = '';
		}
	}
	
	function prepare_profile_statistics($user_id) {
		
		// User Rating
		$this->data['profile_stats']['rating'] = $this -> ci -> user_rating_model -> selectRating($user_id);
		if (!$this->data['profile_stats']['rating']) {
			$this->data['profile_stats']['rating'] = 0;
		} else {
			$this->data['profile_stats']['rating'] = $this->data['profile_stats']['rating']->points;
		}
		
		// Verfified Name
		// TODO
		$this->data['profile_stats']['verified_name'] = '';
		
		// Add To Lunch state
		$this->data['profile_stats']['lunch_wishlist'] = $this -> ci -> user_lunch_wishlist_model->select_list($user_id);
		
		// Lunch buddy list
		if(!isset($this->data['profile_stats']['lunch_buddy_list'])) {
			$this->data['profile_stats']['lunch_buddy_list'] = $this -> ci -> user_lunch_buddy_model->select_list($user_id);
		}
		
		/*
		$lunch_buddy_list[] = array('name' => 'Mike Shinoda', 'profile_img' => 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/275478_100002977900608_1522924766_q.jpg');
		$lunch_buddy_list[] = array('name' => 'Chris Kalani', 'profile_img' => 'http://profile.ak.fbcdn.net/hprofile-ak-ash2/276072_506749663_2438631_q.jpg');
		$lunch_buddy_list[] = array('name' => 'Robert Scoble', 'profile_img' => 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/174530_501319654_5423543_q.jpg');
		$lunch_buddy_list[] = array('name' => 'Julie Zhuo', 'profile_img' => 'http://profile.ak.fbcdn.net/hprofile-ak-snc4/49138_206186_1910_q.jpg');
		$this->data['profile_stats']['lunch_buddy_list'] = $lunch_buddy_list;
		*/
		
		// TODO
		$this->data['profile_stats']['similar_user'] = array();
		
		if(!isset($this->data['profile_stats']['activity_list'])) {
			$this->data['profile_stats']['activity_list'] = array();
		}
		
		/*
		$activity_list[] = array('message' => "&lt;User&gt; had lunch with &lt;User2&gt;. ", 'created_on' => time());
		$activity_list[] = array('message' => "&lt;User&gt; had lunch with &lt;User2&gt;. ", 'created_on' => time());
		$this -> data['activity_list'] = $activity_list;
		*/
		
		return $this->data['profile_stats'];
		
	}

	function update($fields = FALSE, $options = FALSE) {
		
		if (!$fields) { return FALSE; }
		
		return $this -> user_profile_model($fields);
		
	}

	private function _sample_data_for_prepare_profile_statistics() {
		
	}

	function prepare_profile_social_links($user_id) {
		if (empty($user_id)) {
			return FALSE;
		}
		
		return $this -> ci -> user_profile_model -> select_social_links($user_id);
		
	}
	
	function generate_profile_image_pin($user_id, $profile_img) {
		
		// *** 1) Initialise / load image
		$resizeObj = new Image_resize($profile_img);
		
		// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
		$resizeObj -> resizeImage(32, 32, 'auto');
	
		// *** 3) Save image
		$resizeObj -> saveImage('media/images/profile/32/'.$user_id.'.jpg', 100);
		
		
	}
	
	function select_lunch_wishlist($fields = FALSE, $options = FALSE) {
		
		if (!$fields['user_id']) return FALSE; 	
		
		$results = $this -> ci -> user_lunch_wishlist_model->select_list($fields['user_id']);
		
		if (!$results) return FALSE;
		
		## TODO - fix the return result.
		$results = json_decode(json_encode($results), TRUE);
		
		foreach ($results as $key => $user_data) {
			$results[$key]['kind'] = "ls#person";
			$fields['user_id'] = 
			$results[$key] = $this -> ci -> ls_profile -> getPublicProfile($fields);
		}
		
		return $results;
		
	}
	
}
?>