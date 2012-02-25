<?php  


class Notification extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this -> load -> library('ls_notifications');
		$this->load->library('email');
		
		$this->config->load('cronjob_notification');
		
		$this -> load -> model('ls_notifications_model');
	}

	function index() {
		
	}
	
	function sample()
	{
		$frequency = $this->config->item('cronjob_frequency');
		$sender = $this->config->item('cronjob_sender');
		$last_time = time() - ($frequency * 60);
		//Step 1: Collect all notifications
		$temp = $this -> ls_notifications_model -> get_notifications_cronjob($last_time);
		if($temp)
		{
			// Send out all emails
			foreach ($temp as $row) {
				echo $row['email']." ".$row['message'];
				$this -> send_email($sender,$row['email'],$row['message']);
			}
			
			
		}
		else {
			// All emails have already been dispatched
		}
	}
	
	function send_email($from,$to,$message)
	{
		$this->email->from($from, 'Lunchsparks');
		$this->email->to($to);
		$this->email->subject('Lunchsparks notifications');
		$this->email->message($message);
		$this->email->send();
	}
}
?>