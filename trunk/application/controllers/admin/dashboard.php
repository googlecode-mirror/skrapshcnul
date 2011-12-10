<?php

/**
 * System Administrative Page
 */
class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->database();
		$this->load->helper('url');
		// Set Global Variables
		$this -> data['is_logged_in'] = $this->ion_auth->logged_in();
		$this -> data['is_logged_in_admin'] = $this->ion_auth->is_admin();
		
		if (!$this->data['is_logged_in_admin']) {
			redirect('404');
		}
		
		$this->is_pagination = isset($_REQUEST['pagination']) ? $_REQUEST['pagination'] : '1';
		$this->pagination->offset = isset($_REQUEST['per_page']) ? $_REQUEST['per_page'] : 0;
		$this->order_by = isset($_REQUEST['order_by']) ? $_REQUEST['order_by'] : "";
		
		// Create pagination links
		$this -> data['pagination_links'] = $this->pagination->create_links();
	}
	
	function index($value = '') {
		
		// Render views data
		$this -> data['head_title']		= 'Admin | Lunchsparks';
		$this -> data['tpl_page_id'] = "overview";
		$this -> data['tpl_page_title'] = "Account Overview";
		// Render views
		$this->data['main_content'] = 'admin/index';
		$this -> load -> view('includes/tmpl_admin', $this->data);
	}
	
	function users($value = '') {
		
		$this -> data['results']['total_records'] = $this->db->count_all_results('lss_users');
		
		$config['base_url']		= site_url('admin/dashboard/users')."?pagination=1";
		$config['total_rows']	= $this -> data['results']['total_records'];
		$config['per_page']		= 30;
		$config['enable_query_strings']	= TRUE;
		$config['page_query_string']	= TRUE;
		$this->pagination->initialize($config);
		
		// Retrieve paginated results, using the dynamically determined offset
		$this->db->limit($config['per_page'], $this->pagination->offset);
		$this->db->select('id AS user_id, email, created_on, last_login, active, alias, firstname, lastname, profile_img, lunchsparks');
		$this->db->from('lss_users AS lu');
		$this->db->join('lss_users_profile AS lup', 'lup.user_id = lu.id');
		$this->db->join('lss_users_profile_social_links AS lupsl', 'lupsl.user_id = lu.id');
		if (!empty($this->order_by)) {
			$this->db->order_by($this->order_by, "asc");
		} else {
			$this->db->order_by('user_id', "asc");
		}
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$this -> data['results']['users'] = $query->result();
		} else {
			$this -> data['results']['users'] = array();
		}
		
		// Render views data
		$this -> data['head_title']		= 'Admin | Lunchsparks';
		$this -> data['tpl_page_id']	= "users";
		$this -> data['tpl_page_title']	= "Users Overview";
		// Render views
		$this->data['main_content']		= 'admin/users';
		$this -> load -> view('includes/tmpl_admin', $this->data);
	}
	
	function users_invites() {
		
		$this -> data['results']['total_records'] = $this->db->count_all_results('lss_users_invitations');
		
		$config['base_url']		= site_url('admin/dashboard/users_invites')."?pagination=1";
		$config['total_rows']	= $this -> data['results']['total_records'];
		$config['per_page']		= 30;
		$config['enable_query_strings']	= TRUE;
		$config['page_query_string']	= TRUE;
		$this->pagination->initialize($config);
		
		// Retrieve paginated results, using the dynamically determined offset
		$this->db->limit($config['per_page'], $this->pagination->offset);
		$this->db->select('*');
		$this->db->from('lss_users_invitations AS lui');
		$this->db->join('lss_users_profile AS lup', 'lup.user_id = lui.user_id');
		$this->db->join('lss_users_profile_social_links AS lupsl', 'lupsl.user_id = lui.user_id');
		if (!empty($this->order_by)) {
			$this->db->order_by($this->order_by, "asc");
		} else {
			$this->db->order_by('lui.user_id', "asc");
		}
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$this -> data['results']['users'] = $query->result();
		} else {
			$this -> data['results']['users'] = array();
		}
		
		// Render views data
		$this -> data['head_title']		= 'Admin | Lunchsparks';
		$this -> data['tpl_page_id']	= "users_invites";
		$this -> data['tpl_page_title']	= "Users Invite Overview";
		// Render views
		$this->data['main_content']		= 'admin/users_invites';
		$this -> load -> view('includes/tmpl_admin', $this->data);
	}

	function preferences() {
		
		$this -> data['results']['total_records'] = $this->db->count_all_results('lss_global_preferences');
		
		$config['base_url']		= site_url('admin/dashboard/users_invites')."?pagination=1";
		$config['total_rows']	= $this -> data['results']['total_records'];
		$config['per_page']		= 30;
		$config['enable_query_strings']	= TRUE;
		$config['page_query_string']	= TRUE;
		$this->pagination->initialize($config);
		
		// Retrieve paginated results, using the dynamically determined offset
		$this->db->limit($config['per_page'], $this->pagination->offset);
		$this->db->select('*');
		$this->db->from('lss_global_preferences');
		if (!empty($this->order_by)) {
			$this->db->order_by($this->order_by, "asc");
		} else {
			$this->db->order_by('count', "desc");
		}
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$this -> data['results']['preferences'] = $query->result();
		} else {
			$this -> data['results']['preferences'] = array();
		}
		
		// Render views data
		$this -> data['head_title']		= 'Admin | Lunchsparks';
		$this -> data['tpl_page_id']	= "preferences";
		$this -> data['tpl_page_title']	= "Preferences Overview";
		// Render views
		$this->data['main_content']		= 'admin/preferences';
		$this -> load -> view('includes/tmpl_admin', $this->data);
		
	}

	function recommendations() {
		
		
		
		
		
		// Render views data
		$this -> data['head_title']		= 'Recommendations | Lunchsparks';
		$this -> data['tpl_page_id']	= "recommendations";
		$this -> data['tpl_page_title']	= "Recommendations Overview";
		// Render views
		$this->data['main_content']		= 'admin/recommendations';
		$this -> load -> view('includes/tmpl_admin', $this->data);
		
	}
}
?>