<?php

/**
 * Main Page
 */
class Main extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> library('ion_auth');
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> database();
		$this -> load -> helper('url');
		$this -> load -> model('mainpage_elements_model');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
		$this -> session -> set_flashdata('system_message', '');
	}

	function index($value = '') {
		$this->data['ls_testimonial_list'] = $this->_getTestimonial();
		
		// Render view
		$this -> data['main_content'] = 'main/main';
		$this -> load -> view('includes/tmpl_public', $this -> data);
	}

	function getTwitterTimeline($format = 'json') {

		if ($format == 'json') {
			$result = $this -> mainpage_elements_model -> get('Twitter');

			echo stripslashes($result[0]['data']);
		}
	}

	function _getTestimonial() {
		$testimonial[] = array('name' => 'Shilpa', 'company' => 'Cofounder of Apsnartgallery.org', 'nationality' => 'Indian', 'message' => 'This is amazing. I\'ll definitely use it when it is launched.');
		$testimonial[] = array('name' => 'Steven Goh', 'company' => 'Cofounder of Crtleff', 'nationality' => 'Singaporean', 'message' => 'Awesome. Looking forward to it.');
		$testimonial[] = array('name' => 'Yi Seng', 'company' => 'Cofounder of Deals89', 'nationality' => 'Malaysian', 'message' => 'Lunchsparks will create a great opportunities! It will really help in matching the right person from different or same industry, providing business opportunity to work together!');
		$testimonial[] = array('name' => 'Kenny Lee', 'company' => 'Cofounder of Silver Solutions', 'nationality' => 'Singaporean', 'message' => 'Disrupt the current way of networking!');
		$testimonial[] = array('name' => 'Jorene', 'company' => 'Continuum', 'nationality' => 'Singaporean', 'message' => "Looking forward to using Lunchsparks. It'll be convenient and effortless to meet people from whom I can learn from, and I'm sure these professionals will offer sound advice too!");
		$testimonial[] = array('name' => 'Tan Peck Ying', 'company' => 'NUS Enterprise', 'nationality' => 'Singaporean', 'message' => 'Your platform can potentially overcome the limitations of human match-making and bring great value to the community!');
		return $testimonial;
	}

}
?>