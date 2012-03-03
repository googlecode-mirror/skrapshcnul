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
		email_lunchsparks_notifications();
		update_event_status_on_deadline_expire();
	}
	
	function email_lunchsparks_notifications()
	{
		$frequency = $this->config->item('cronjob_frequency');
		$sender = $this->config->item('cronjob_sender');
		$last_time = time() - ($frequency * 60);
		//Step 1: Collect all notifications
		$temp = $this -> ls_notifications_model -> get_notifications_cronjob($last_time);
		if($temp)
		{
			// Send out all emails
			try{
				foreach ($temp as $row) {
					echo $row['email']." ".$row['message'];
					try
					{
						$this -> send_email($sender,$row['email'],$row['message']);
					}catch(exception $e)
					{
						//echo "Exception caught : $e";  // Mail related issues
					}
				}		
			}catch(exception $e)
			{
				//echo "Exception caught : $e";  // Sql related issues
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
	
	function update_event_status_on_deadline_expire()
	{
		//Step 1: Collect all users
		$temp = $this -> ls_notifications_model -> get_event_id_list_deadline_expiry();
		if($temp)
		{
			try
			{
				$events_list="";
				foreach ($temp as $row) {
					$events_list.=$row['event_id'].",";
				}
				$events_list = substr($events_list,0,strlen($events_list)-1); // removing the extra comma at end of string
				$this -> ls_notifications_model -> set_event_id_deadline_expire_status($events_list);
			}catch(exception $e)
			{
				// echo "Exception caught : $e";  // Sql related issues
			}
				
		}
		else {
			// All events deadlines are already been set to cancel
			}
	} 
}
?>