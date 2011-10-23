<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! class_exists('Controller'))
{
	class Controller extends CI_Controller {}
}

class Auth extends Controller {

	function __construct()
	{
		parent::__construct();
		// Load Common 
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->database();
		// Load Ion Auth
		$this -> load -> library('ion_auth');
		$this -> load -> model('invitation_model');
		// Load Twitter Auth
		$this->load->library('tweet');
		$this->tweet->enable_debug(TRUE);
		// Set Global Variables
		$this->data['is_logged_in'] = $this->ion_auth->logged_in();
	}

	//redirect if needed, otherwise display the user list
	function index()
	{
		
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin())
		{
			//redirect them to the home page because they must be an administrator to view this
			redirect($this->config->item('base_url'), 'refresh');
		}
		else
		{
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id);
			}
			
			$this->load->view('auth/index', $this->data);
		}
	}

	//log the user in
	function login()
	{
		
		if ($this->data['is_logged_in'])
		{
			//redirect them to the profile page
			redirect('user/profile', 'refresh');
		}
		
		$this->data['title'] = "Login";

		//validate form input
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{ 
			//check to see if the user is logging in
			//check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember))
			{ 
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect($this->config->item('base_url'), 'refresh');
			}
			else
			{ 
				//if the login was un-successful
				//redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				$this->session->set_flashdata('message', "Wrong username/password!");
				
				//redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
				$this->data['email'] = array('name' => 'email',
					'id' => 'email',
					'type' => 'text',
					'value' => $this->form_validation->set_value('email'),
  					'placeholder' => 'Email',
  					'required' => 'required',
				);
				$this->data['password'] = array('name' => 'password',
					'id' => 'password',
					'type' => 'password',
  					'placeholder' => 'Password',
  					'required' => 'required',
				);
				
				//Render
				//$this->data['main_content'] = '/auth/login';
				//$this -> load -> view('includes/tmpl_layout', $this->data);
				redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		} else { 
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'value' => $this->form_validation->set_value('email'),
  				'placeholder' => 'Email',
  				'required' => 'required',
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
  				'placeholder' => 'Password',
  				'required' => 'required',
			);
				
			// Render View
			//$this->load->view('auth/login', $this->data);
			$this->data['main_content'] = '/auth/login';
			$this -> load -> view('includes/tmpl_layout', $this->data);
		}
	}

	//log the user in
	function signup()
	{
		//print_r($this->session);
		$this->data['title'] = "Signup";
		
		if (isset($_REQUEST['invitation_key'])) {
			$this->data['invitation_key_val'] = $_REQUEST['invitation_key'];
		} elseif (($this->input->post('invitation_key'))) {
			$this->data['invitation_key_val'] = $this->input->post('invitation_key');
		} else {
			$this->data['invitation_key_val'] = '';
		}
		
		if (!($this->data['email_val'] = $this->ion_auth->check_invitation_code($this->data['invitation_key_val']))) {
		//if (FALSE) {
			// Render View
			//$this->load->view('auth/create_user', $this->data);
			$this->data['main_content'] = '/auth/signup_invalid_invitation_code';
			$this -> load -> view('includes/tmpl_layout', $this->data);
			
		} else {
						
			//validate form input
			$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
	
			if ($this->form_validation->run() == true)
			{
				$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
				$email = $this->input->post('email');
				$password = $this->input->post('password');
	
				$additional_data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'company' => $this->input->post('company'),
					'phone' => $this->input->post('phone1') . '-' . $this->input->post('phone2') . '-' . $this->input->post('phone3'),
				);
			}
	
			if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
			{
				if ($this->data['invitation_key_val']) {
					$this -> invitation_model-> updateJoinedOn($this->data['email_val']);
				}
				 
				//check to see if we are creating the user
				$message = "User successfully created.";
				$this->session->set_flashdata('message', $message);
				$this->data['message'] = $message;
				
				//redirect them back to the login page
				redirect('login', 'refresh');
			}
			else
			{ 
				//display the create user form
				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				
				$this->data['invitation_key'] = array(
					'name' => 'invitation_key',
					'id' => 'invitation_key',
					'value' => $this->data['invitation_key_val'],
					'type' => 'hidden',
				);
	
				$this->data['first_name'] = array('name' => 'first_name',
					'id' => 'first_name',
					'type' => 'text',
					'value' => $this->form_validation->set_value('first_name'),
	  				'placeholder' => 'First Name',
	  				'required' => 'required',
				);
				$this->data['last_name'] = array('name' => 'last_name',
					'id' => 'last_name',
					'type' => 'text',
					'value' => $this->form_validation->set_value('last_name'),
	  				'placeholder' => 'Last Name',
	  				'required' => 'required',
				);
				$this->data['email'] = array('name' => 'email',
					'id' => 'email',
					'type' => 'text',
					//'value' => $this->form_validation->set_value('email'),
					'value' => $this->data['email_val'],
	  				'placeholder' => 'Email',
	  				'required' => 'required',
	  				'readonly' => 'readonly',
				);
				$this->data['password'] = array('name' => 'password',
					'id' => 'password',
					'type' => 'password',
					'value' => $this->form_validation->set_value('password'),
	  				'placeholder' => 'Password',
	  				'required' => 'required',
				);
				$this->data['password_confirm'] = array('name' => 'password_confirm',
					'id' => 'password_confirm',
					'type' => 'password',
					'value' => $this->form_validation->set_value('password_confirm'),
	  				'placeholder' => 'Confirm Password',
	  				'required' => 'required',
				);
				
				// Render View
				//$this->load->view('auth/create_user', $this->data);
				$this->data['main_content'] = '/auth/signup';
				$this -> load -> view('includes/tmpl_layout', $this->data);
			}
		}
	}

	//log the user out
	function logout()
	{
		$this->data['title'] = "Logout";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them back to the page they came from
		redirect('auth', 'refresh');
	}

	//change password
	function change_password()
	{
		$this->form_validation->set_rules('old', 'Old password', 'required');
		$this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		$user = $this->ion_auth->get_user($this->session->userdata('user_id'));

		if ($this->form_validation->run() == false)
		{ //display the form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['old_password'] = array('name' => 'old',
				'id' => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array('name' => 'new',
				'id' => 'new',
				'type' => 'password',
			);
			$this->data['new_password_confirm'] = array('name' => 'new_confirm',
				'id' => 'new_confirm',
				'type' => 'password',
			);
			$this->data['user_id'] = array('name' => 'user_id',
				'id' => 'user_id',
				'type' => 'hidden',
				'value' => $user->id,
			);

			//render
			//$this->load->view('auth/change_password', $this->data);
			$this->data['main_content'] = '/auth/change_password';
			$this -> load -> view('includes/tmpl_layout', $this->data);
		}
		else
		{
			$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{ //if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/change_password', 'refresh');
			}
		}
	}

	//forgot password
	function forgot_password()
	{
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		if ($this->form_validation->run() == false)
		{
			//setup the input
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
				'type' => 'email',
				'required' => 'required',
				'placeholder' => 'Email Address',
			);
			//set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			//$this->load->view('auth/forgot_password', $this->data);
			$this->data['main_content'] = '/auth/forgot_password';
			$this -> load -> view('includes/tmpl_layout', $this->data);
		}
		else
		{
			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

			if ($forgotten)
			{ //if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code)
	{
		if (!isset($code)) {
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth/login", 'refresh');
		} else {
			$reset = $this->ion_auth->forgotten_password_complete($code);
	
			if ($reset)
			{  //if the reset worked then send them to the login page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh');
			}
			else
			{ //if the reset didnt work then send them back to the forgot password page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	//activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
			$activation = $this->ion_auth->activate($id, $code);
		else if ($this->ion_auth->is_admin())
			$activation = $this->ion_auth->activate($id);

		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	//deactivate the user
	function deactivate($id = NULL)
	{
		// no funny business, force to integer
		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', 'confirmation', 'required');
		$this->form_validation->set_rules('id', 'user ID', 'required|is_natural');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			//$this->load->view('auth/deactivate_user', $this->data);
			$this->data['main_content'] = '/auth/deactivate_user';
			$this -> load -> view('includes/tmpl_layout', $this->data);
			
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_404();
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			//redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	//create a new user
	function create_user()
	{
		$this->data['title'] = "Create User";

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		//validate form input
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('phone1', 'First Part of Phone', 'xss_clean|min_length[3]|max_length[3]');
		$this->form_validation->set_rules('phone2', 'Second Part of Phone', 'xss_clean|min_length[3]|max_length[3]');
		$this->form_validation->set_rules('phone3', 'Third Part of Phone', 'xss_clean|min_length[4]|max_length[4]');
		$this->form_validation->set_rules('company', 'Company Name', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');

		if ($this->form_validation->run() == true)
		{
			$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$additional_data = array('first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'company' => $this->input->post('company'),
				'phone' => $this->input->post('phone1') . '-' . $this->input->post('phone2') . '-' . $this->input->post('phone3'),
			);
		}
		if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
		{ //check to see if we are creating the user
			//redirect them back to the admin page
			$this->session->set_flashdata('message', "User Created");
			redirect("auth", 'refresh');
		}
		else
		{ //display the create user form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['first_name'] = array('name' => 'first_name',
				'id' => 'first_name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$this->data['last_name'] = array('name' => 'last_name',
				'id' => 'last_name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['company'] = array('name' => 'company',
				'id' => 'company',
				'type' => 'text',
				'value' => $this->form_validation->set_value('company'),
			);
			$this->data['phone1'] = array('name' => 'phone1',
				'id' => 'phone1',
				'type' => 'text',
				'value' => $this->form_validation->set_value('phone1'),
			);
			$this->data['phone2'] = array('name' => 'phone2',
				'id' => 'phone2',
				'type' => 'text',
				'value' => $this->form_validation->set_value('phone2'),
			);
			$this->data['phone3'] = array('name' => 'phone3',
				'id' => 'phone3',
				'type' => 'text',
				'value' => $this->form_validation->set_value('phone3'),
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->data['password_confirm'] = array('name' => 'password_confirm',
				'id' => 'password_confirm',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
			);
			
			// Render View
			//$this->load->view('auth/create_user', $this->data);
			$this->data['main_content'] = '/auth/create_user';
			$this -> load -> view('includes/tmpl_layout', $this->data);
			
		}
	}

	/* External Auth(s) Starts HERE */
	function twitter(){
		if ( !$this->tweet->logged_in() )
		{
			// This is where the url will go to after auth.
			// ( Callback url )
			$this->tweet->set_callback(site_url('auth/twitter_authed'));
			
			// Send the user off for login!
			$this->tweet->login();
		}
		else
		{
			// Logged in 
			$this->_post_twitter_authed();
		}
		
	}
	
	function twitter_authed() {
		$this->_post_twitter_authed();
	}
	
	/**
	 * Private function to handle post twitter authentication.
	 */
	function _post_twitter_authed() {
		
		$tokens = $this->tweet->get_tokens();
		
		// put temp credentials in session, we need this in the callback
		$this->session->set_userdata('oauth_token', $tokens['oauth_token']);
		$this->session->set_userdata('oauth_token_secret', $tokens['oauth_token_secret']);
		
		$user = $this->tweet->call('get', 'account/verify_credentials');
		
		// TODO Write data to DB
		print_r($user);
		
		$this->_users_provider_write($user);
		
		$this->data['temp_t_user'] = $user;
		
		$friendship 	= $this->tweet->call('get', 'friendships/show', array('source_screen_name' => $user->screen_name, 'target_screen_name' => 'elliothaughin'));
		$this->data['temp_t_friendship'] = $friendship;
		
		// If !user exist, create new user
		// else add to user account 
		
		// Render View
		$this->data['main_content'] = '/auth/twitter_authed';
		$this -> load -> view('includes/tmpl_layout', $this->data);
	}
	
	
	function _users_provider_write($user) {
		
		
	}
	
	/* Private Functions Starts HERE */
	
	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
				$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function email() {
		$this->data['identity'] = 'some-identity';
		$this->data['forgotten_password_code'] = 'somecode';
		$this->data['new_password'] = 'some-new-password';
		$this->data['id'] = 'some-id';
		$this->data['activation'] = 'some-activation';
		// Render View
		//$this->data['main_content'] = '/auth/email/new_password.tpl.php';
		//$this->data['main_content'] = '/auth/email/forgot_password.tpl.php';
		$this->data['main_content'] = '/auth/email/activate.tpl.php';
		$this -> load -> view('includes/tmpl_layout', $this->data);
	}
}
