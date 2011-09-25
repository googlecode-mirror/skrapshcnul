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

class mainpage_elements_model extends CI_Model {

	protected $table_name = 'mainpage_elements';

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
		$this -> load -> helper('cookie');
		$this -> load -> helper('date');
		$this -> load -> library('session');

		//initialize db tables data
		$this -> tables = array('mainpage_elements' => "lss_mainpage_elements");

		//initialize messages and error
		$this -> messages = array();
		$this -> errors = array();

		//initialize our hooks object
		$this -> _hooks = new stdClass;

		$this -> trigger_events('model_constructor');
	}

	function get($provider = '') {

		$this -> trigger_events('pre_get_mainpage_successful');

		if (empty($provider)) {
			$this -> set_error('Provider does not exist');
			return FALSE;
		}

		try {
			$query = $this -> db -> select('data') -> where('provider', $provider) -> get($this -> tables['mainpage_elements']);

			$result = $query -> result_array();

			if ($query -> num_rows() >= 1) {

				$this -> trigger_events('post_get_mainpage_successful');

				return $result;
			}
		} catch (Exception $e) {

		}

		$this -> trigger_events('post_get_mainpage_unsuccessful');
		$this -> set_message('get_mainpage_unsuccessful');

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
	public function set_message($message) {
		$this -> messages[] = $message;

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
	public function set_error($error) {
		$this -> errors[] = $error;

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
	public function errors() {
		$_output = '';
		foreach ($this->errors as $error) {
			$_output .= $this -> error_start_delimiter . $this -> lang -> line($error) . $this -> error_end_delimiter;
		}

		return $_output;
	}

}
