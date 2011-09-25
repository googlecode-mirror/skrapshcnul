<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Model
*
* Author:  Ben Edmunds
* 		   ben.edmunds@gmail.com
*	  	   @benedmunds
*
* Added Awesomeness: Phil Sturgeon
*
* Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  10.01.2009
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
	protected $messages;

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
		
		$this->trigger_events('model_constructor');
	}

	/**
	 * register
	 *
	 * @return bool
	 * @author Mathew
	 **/
	public function register_twitter($username, $password, $email, $additional_data = false, $groups = array())
	{
		$this->trigger_events('pre_register');
		
	    if ($this->identity_column == 'email' && $this->email_check($email))
	    {
			$this->ion_auth->set_error('account_creation_duplicate_email');
			return FALSE;
	    }
	    elseif ($this->identity_column == 'username' && $this->username_check($username))
	    {
			$this->ion_auth->set_error('account_creation_duplicate_username');
			return FALSE;
	    }

	    // If username is taken, use username1 or username2, etc.
	    if ($this->identity_column != 'username')
	    {
			for($i = 0; $this->username_check($username); $i++)
			{
				if($i > 0)
				{
					$username .= $i;
				}
			}
	    }
		
	    // IP Address
	    $ip_address = $this->input->ip_address();
	    $salt       = $this->store_salt ? $this->salt() : FALSE;
	    $password	= $this->hash_password($password, $salt);

	    // Users table.
	    $data = array(
			'username'   => $username,
			'password'   => $password,
			'email'      => $email,
			'ip_address' => $ip_address,
			'created_on' => now(),
			'last_login' => now(),
			'active'     => 1
			 );

	    if ($this->store_salt)
	    {
			$data['salt'] = $salt;
	    }
	    
	    $this->trigger_events('extra_set');

	    $this->db->insert($this->tables['users'], $data);

	    $id = $this->db->insert_id();


		if (!empty($groups))
		{
			//add to groups
			foreach ($groups as $group)
			{
				$this->add_to_group($group, $id);
			}
		}
		
		//add to default group if not already set
		$default_group = $this->where('name', $this->config->item('default_group', 'ion_auth'))->group()->row();
		if (isset($default_group->id) && isset($groups) && !empty($groups) && !in_array($default_group->id, $groups) || !isset($groups) || empty($groups))
		{
			$this->add_to_group($default_group->id, $id);
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

		$this->trigger_events('post_register');
		
	    return $this->db->affected_rows() > 0 ? $id : false;
	}

	/**
	 * login
	 *
	 * @return bool
	 * @author Mathew
	 **/
	public function login($identity, $password, $remember=FALSE)
	{
		$this->trigger_events('pre_login');
		
	    if (empty($identity) || empty($password) || !$this->identity_check($identity))
	    {
			$this->set_message('login_unsuccessful');
			return FALSE;
	    }

	    $this->trigger_events('extra_where');
		
	    $query = $this->db->select($this->identity_column.', id, password')
		                  ->where($this->identity_column, $identity)
		                  ->where('active', 1)
		                  ->limit(1)
		                  ->get($this->tables['users']);

	    $result = $query->row();

	    if ($query->num_rows() == 1)
	    {
			$password = $this->hash_password_db($identity, $password);

			if ($result->password === $password)
			{
				$this->update_last_login($result->id);

				$session_data = array(
							$this->identity_column => $result->{$this->identity_column},
							'id'                   => $result->id, //kept for backwards compatibility
							'user_id'              => $result->id, //everyone likes to overwrite id so we'll use user_id
						 );

				$this->session->set_userdata($session_data);

				if ($remember && $this->config->item('remember_users', 'ion_auth'))
				{
					$this->remember_user($result->id);
				}
				
				// Update Login Histroy Table
				$this->add_login_history($identity);
				
				$this->trigger_events(array('post_login', 'post_login_successful'));
				$this->set_message('login_successful');

				return TRUE;
			}
	    }

		$this->trigger_events('post_login_unsuccessful');
		$this->set_message('login_unsuccessful');
	    return FALSE;
	}


}
