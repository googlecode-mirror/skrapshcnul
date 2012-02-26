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
		$this -> data['head_title'] = 'Upcoming Events | Lunchsparks';
		$this -> data['tpl_page_id'] = "upcoming";
		$this -> data['tpl_page_title'] = "Upcoming Events";

		$this -> data['main_content'] = 'base/errors/error_404';
		$this -> load -> view('includes/tmpl_singlebox', $this -> data);
		
	}

}
