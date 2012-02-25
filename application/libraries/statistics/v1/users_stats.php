<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Name:  Notification
 * Author: @stiucsib86
 * Created:  20120225
 * Description:
 * 
 * Requirements: PHP5 or above
 */
class Users_Stats {

	function __construct() {

		$this -> ci = &get_instance();
		$this -> ci -> load -> database();
		$this -> ci -> load -> config('linkedin_oauth', TRUE);
		$this -> ci -> load -> config('users', TRUE);
		$this -> ci -> load -> library('ion_auth');
		$this -> ci -> load -> library('input');
		$this -> ci -> load -> library('ls_profile');
		$this -> ci -> load -> library('form_validation');
		$this -> ci -> load -> library('session');
		$this -> ci -> load -> helper('image/image_resize');
		$this -> ci -> load -> helper('logger');
		$this -> ci -> load -> model('statistics/users_statistics_model');

		// Set Config
		$this -> component_class = $this -> ci -> config -> item('component_class', 'ls_notifications');
		//auto-login the user if they are remembered
		if (!$this -> ci -> ion_auth -> logged_in() && get_cookie('identity') && get_cookie('remember_code')) {
			$this -> ci -> ion_auth = $this;
			$this -> ci -> ion_auth_model -> login_remembered_user();
		}

		$this -> ci -> ion_auth_model -> trigger_events('library_constructor');
	}
	
	function totalUsers() {
		
		$totalUsers = $this -> ci -> users_statistics_model -> getTotalUsers();
		
		## Format Data for HighchartsJS
		
		// Populate x-axis
		$x_axis = array();
		$series_data = array();
		if (sizeof($totalUsers) > 0) {
			foreach ($totalUsers as $rows) {
				$xAxis[] = $rows['year_month'];
				$series_data[] = intval($rows['total_users']);
			};
		};
		
		$results['title']['text'] = 'Lunchsparks Total Users';
		$results['xAxis']['categories'] = $xAxis;
		$results['yAxis']['title']['text'] = 'Total Users';
		
		$results['series']['name'] = 'Total Users Per Month';
		$results['series']['stack'] = 'users';
		$results['series']['data'] = $series_data;
		
		//var_dump($results);
		
		return $results;
	}
}
?>