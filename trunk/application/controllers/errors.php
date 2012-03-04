<?php

/**
 * System Administrative Page
 */
class Errors extends CI_Controller {

    public function __construct() {
            parent::__construct();
    }
	
	function index() {
		
        $this -> page_404();

	}
	
	function page_404() {
		
        $this->output->set_status_header('404');
        $data['content'] = 'error_404'; // View name
        
		// Render views data
		$this -> data['head_title'] = '404 | Lunchsparks';
		$this -> data['tpl_page_id'] = "404";
		$this -> data['tpl_page_title'] = "404 Not Found";

		$this -> data['main_content'] = 'base/errors/error_404';
		$this -> load -> view('includes/tmpl_singlebox', $this -> data);
		
	}

}
