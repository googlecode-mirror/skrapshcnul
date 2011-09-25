<?php

/**
 * Static Pages
 */
class Pages extends CI_Controller {

	function __construct() {
		parent::__construct();
		// Load Common
		$this -> load -> library('session');
		$this -> load -> library('form_validation');
		$this -> load -> helper('url');
		$this -> load -> database();
		// Load Ion Auth
		$this -> load -> library('ion_auth');
		// Load Twitter Auth
		$this -> load -> library('tweet');
		$this -> tweet -> enable_debug(TRUE);
		// Set Global Variables
		$this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();
	}

	public function index($value = '') {
		$data['main_content'] = 'main';
		$this -> load -> view('includes/tmpl_public', $data);
	}

	public function about($value = '') {
		$this -> data['main_content'] = '/pages/about';
		$this -> load -> view('includes/tmpl_public', $this -> data);
	}

	public function press($value = '') {
		$this -> data['main_content'] = '/pages/press';
		$this -> load -> view('includes/tmpl_public', $this -> data);
	}

	public function careers($value = '') {
		$this -> data['main_content'] = '/pages/careers';
		$this -> load -> view('includes/tmpl_public', $this -> data);
	}

	public function privacy($value = '') {
		$this -> data['main_content'] = '/pages/privacy';
		$this -> load -> view('includes/tmpl_public', $this -> data);
	}

	public function terms($value = '') {
		$this -> data['main_content'] = '/pages/terms';
		$this -> load -> view('includes/tmpl_public', $this -> data);
	}

	public function help($value = '') {
		$this -> data['main_content'] = '/pages/help';
		$this -> load -> view('includes/tmpl_public', $this -> data);
	}

}
?>