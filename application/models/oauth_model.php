<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Model
*
* Author:  Bing Han
* 		   stiucsib86@gmail.com
*	  	   @stiucsib86
*
* Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
* Original Author name has been kept but that does not mean that the method has not been modified.
*
* Requirements: PHP5 or above
*
*/

//  CI 2.0 Compatibility
if(!class_exists('CI_Model')) { class CI_Model extends Model {} }


class Oauth_model extends CI_Model
{
	/**
	 * Holds an array of tables used
	 *
	 * @var string
	 **/
	public $tables = array();

	/**
	 * activation code
	 *
	 * @var string
	 **/
	public $activation_code;

	/**
	 * forgotten password key
	 *
	 * @var string
	 **/
	public $forgotten_password_code;

	/**
	 * new password
	 *
	 * @var string
	 **/
	public $new_password;

	/**
	 * Identity
	 *
	 * @var string
	 **/
	public $identity;

	/**
	 * Where
	 *
	 * @var array
	 **/
	public $_where = array();

	/**
	 * Limit
	 *
	 * @var string
	 **/
	public $_limit = NULL;

	/**
	 * Offset
	 *
	 * @var string
	 **/
	public $_offset = NULL;

	/**
	 * Order By
	 *
	 * @var string
	 **/
	public $_order_by = NULL;

	/**
	 * Order
	 *
	 * @var string
	 **/
	public $_order = NULL;
	
	/**
	 * Hooks
	 *
	 * @var object
	 **/
	protected $_hooks;

	/**
	 * Response
	 *
	 * @var string
	 **/
	protected $response = NULL;

	/**
	 * message (uses lang file)
	 *
	 * @var string
	 **/

	/**
	 * error message (uses lang file)
	 *
	 * @var string
	 **/
	protected $errors = array();

	/**
	 * error start delimiter
	 *
	 * @var string
	 **/
	protected $error_start_delimiter;

	/**
	 * error end delimiter
	 *
	 * @var string
	 **/
	protected $error_end_delimiter;
	

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->load->library('session');
		$this->lang->load('ion_auth');
		$this->load->model('ion_auth_model');

		//initialize db tables data
		$this->tables  = $this->config->item('tables', 'ion_auth');
		$this->columns = $this->config->item('columns', 'ion_auth');

		//initialize data
		$this->identity_column = $this->config->item('identity', 'ion_auth');
		$this->store_salt      = $this->config->item('store_salt', 'ion_auth');
		$this->salt_length     = $this->config->item('salt_length', 'ion_auth');
		$this->join			   = $this->config->item('join', 'ion_auth');
		
		//initialize messages and error
		$this->messages = array();
		$this->errors = array();
		$this->message_start_delimiter = $this->config->item('message_start_delimiter', 'ion_auth');
		$this->message_end_delimiter   = $this->config->item('message_end_delimiter', 'ion_auth');
		$this->error_start_delimiter   = $this->config->item('error_start_delimiter', 'ion_auth');
		$this->error_end_delimiter     = $this->config->item('error_end_delimiter', 'ion_auth');
		
		//initialize our hooks object
		$this->_hooks = new stdClass;
		
	}

	/**
	 * register
	 *
	 * @return bool
	 * @author stiucsib86
	 **/
	public function register($email) {
		
		if (!isset($email)) return FALSE;
		
	    if ($this->identity_column == 'email' && $this->ion_auth_model->email_check($email)) {
			// Existing Account
			// Proceed to login
			$this -> login($email);
			
	    } else {
	    	
	    	// Create a new account
			$username = $email;
			
		    // IP Address
		    $ip_address = $this->input->ip_address();
	
		    // Users table.
		    $data = array(
				'username'   => $username,
				'email'      => $email,
				'ip_address' => $ip_address,
				'created_on' => now(),
				'last_login' => now(),
				'active'     => 1
				 );
		    
		    $this->db->insert($this->tables['users'], $data);
	
		    $id = $this->db->insert_id();
			
			//add to default group if not already set
			$default_group = $this->ion_auth_model->where('name', $this->config->item('default_group', 'ion_auth'))->group()->row();
			if (isset($default_group->id) && isset($groups) && !empty($groups) && !in_array($default_group->id, $groups) || !isset($groups) || empty($groups))
			{
				$this->ion_auth_model->add_to_group($default_group->id, $id);
			}
			
		    // Meta table.
		    $data = array($this->join['users'] => $id);
	
		    if (!empty($this->columns))
		    {
				foreach ($this->columns as $input)
				{
					if (is_array($additional_data) && isset($additional_data[$input]))
					{
						$data[$input] = $additional_data[$input];
					}
				}
		    }
	
		    $this->db->insert($this->tables['meta'], $data);
	
		    return $this->db->affected_rows() > 0 ? $id : false;
	    }
	}

	/**
	 * login
	 *
	 * @return bool
	 * @author stiucsib86
	 **/
	public function login($identity, $remember=FALSE) {
		
	    if (empty($identity) || !$this->ion_auth_model->identity_check($identity)) {
			return FALSE;
	    }

	    $this->db->select($this->identity_column.', id');
		$this->db->where($this->identity_column, $identity);
		$this->db->where('active', 1);
		$this->db->limit(1);
		$query = $this->db->get($this->tables['users']);

	    $result = $query->row();

	    if ($query->num_rows() == 1) {
			
			$this->ion_auth_model->update_last_login($result->id);

			$session_data = array(
						$this->identity_column => $result->{$this->identity_column},
						'id'                   => $result->id, //kept for backwards compatibility
						'user_id'              => $result->id, //everyone likes to overwrite id so we'll use user_id
					 );

			$this->session->set_userdata($session_data);

			if ($remember && $this->config->item('remember_users', 'ion_auth'))
			{
				$this->ion_auth_model->remember_user($result->id);
			}
			
			// Update Login Histroy Table
			$this->ion_auth_model->add_login_history($identity);
			
			return TRUE;
	    }
		
	    return FALSE;
	}


}
