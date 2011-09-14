<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 * Name:  Ion Auth Model
 *
 * Author:  @stiucsib86
 */

//  CI 2.0 Compatibility
if (!class_exists('CI_Model')) {
	class CI_Model extends Model {
	}

}

class Ls_notifications_model extends CI_Model {

	protected $table_name = 'notification';

	/**
	 * Holds an array of tables used
	 *
	 * @var string
	 **/
	public $tables = array();

	/**
	 * message (uses lang file)
	 *
	 * @var string
	 **/
	protected $messages;

	/**
	 * error message (uses lang file)
	 *
	 * @var string
	 **/
	protected $errors = array();

	public function __construct() {
		parent::__construct();
		$this -> load -> database();
		$this -> load -> config('ion_auth', TRUE);
		$this -> load -> config('ls_notifications', TRUE);
		$this -> load -> helper('cookie');
		$this -> load -> helper('date');
		$this -> load -> library('session');
		$this -> lang -> load('ion_auth');

		//initialize db tables data
		$this -> tables = $this -> config -> item('tables', 'ion_auth');
		$this -> tables = $this -> config -> item('tables', 'ls_notifications');
		$this -> columns = $this -> config -> item('columns', 'ion_auth');

		//initialize data
		$this -> identity_column = $this -> config -> item('identity', 'ion_auth');
		$this -> store_salt = $this -> config -> item('store_salt', 'ion_auth');
		$this -> salt_length = $this -> config -> item('salt_length', 'ion_auth');
		$this -> join = $this -> config -> item('join', 'ion_auth');

		//initialize messages and error
		$this -> messages = array();
		$this -> errors = array();
		$this -> message_start_delimiter = $this -> config -> item('message_start_delimiter', 'ion_auth');
		$this -> message_end_delimiter = $this -> config -> item('message_end_delimiter', 'ion_auth');
		$this -> error_start_delimiter = $this -> config -> item('error_start_delimiter', 'ion_auth');
		$this -> error_end_delimiter = $this -> config -> item('error_end_delimiter', 'ion_auth');

		//initialize our hooks object
		$this -> _hooks = new stdClass;

		$this -> trigger_events('model_constructor');
	}

	/**
	 * Function to write notification to database
	 */
	function set_notification($component_id, $identity, $message, $url = '' )
	{
		if(empty($component_id)) {
			$this -> set_error('Component id error');
			return FALSE;
		}
		if(empty($identity)) {
			$this -> set_error('User id cannot be empty');
			return FALSE;
		}
		if(empty($message)) {
			$this -> set_error('Message cannot be empty');
			return FALSE;
		}
		
		try {
			$this->trigger_events('pre_set_notification');
		
			$data = array(
				'component_id'	=> $component_id,
				'user_id'		=> $identity,
				'message'		=> $message,
				'url'			=> $url,
				'created_on'	=> now(),
				'read_on'		=> '',
				'is_hidden'     => 0
				 );
			
		    $this->db->insert($this->tables['notifications'], $data);
			
			$id = $this->db->insert_id();
			
			// TODO add notification to email queue
			
			$this->trigger_events('post_set_notification');
			
			return $this->db->affected_rows() > 0 ? $id : false;
			
		} catch (Exception $e) {
			$this -> set_message('Exception caught');
			return FALSE;
		}
		
	}

	function get_notifications($user_id = '', $number_of_items = 10) {

		if (empty($user_id)) {
			$this -> set_error('User does not exist');
			return FALSE;
		}

		$query = $this -> db -> select('component_id, message, created_on, url') -> where('user_id', $user_id) -> where('is_hidden', 0) -> limit($number_of_items) -> get($this -> tables['notifications']);
		//$query = $this->db->get($this->tables['notifications']);
		
		$result = $query -> result_array();

		if ($query -> num_rows() >= 1) {

			$this -> trigger_events('post_get_notification_successful');

			return $result;
		}

		$this -> trigger_events('post_get_notification_unsuccessful');
		$this -> set_message('get_notification_unsuccessful');
		return FALSE;
	}

	public function trigger_events($events) {
		if (is_array($events) && !empty($events)) {
			foreach ($events as $event) {
				$this -> trigger_events($event);
			}
		} else {
			if (isset($this -> _hooks -> $events) && !empty($this -> _hooks -> $events)) {
				foreach ($this->_hooks->$events as $name => $hook) {
					$this -> _call_hook($events, $name);
				}
			}
		}
	}
	
	
	/**
	 * set_message
	 *
	 * Set a message
	 *
	 * @return void
	 * @author @stiucsib86
	 **/
	public function set_message($message)
	{
		$this->messages[] = $message;

		return $message;
	}
	
	
	/**
	 * set_error
	 *
	 * Set an error message
	 *
	 * @return void
	 * @author @stiucsib86
	 **/
	public function set_error($error)
	{
		$this->errors[] = $error;

		return $error;
	}

	/**
	 * errors
	 *
	 * Get the error message
	 *
	 * @return void
	 * @author @stiucsib86
	 **/
	public function errors()
	{
		$_output = '';
		foreach ($this->errors as $error)
		{
			$_output .= $this->error_start_delimiter . $this->lang->line($error) . $this->error_end_delimiter;
		}

		return $_output;
	}

}
