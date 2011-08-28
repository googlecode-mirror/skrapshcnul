<?php

/**
 * Static Pages
 */
class Pages extends CI_Controller {

	public function index($value = '') {
		$data['main_content'] = 'main';
		$this -> load -> view('includes/tmpl_layout', $data);
	}
	
	public function about($value = '') {
		$data['main_content'] = '/pages/about';
		$this -> load -> view('includes/tmpl_layout', $data);
	}

}
?>