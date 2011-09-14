<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Name:  Lunchsparks Notifications Config
 * 
 * Author: @stiucsib86
 * 
 * Created:  20110911
 */

	/**
	 * Tables.
	 **/
	$config['tables']['notifications']   = 'notifications';
	
	/**
	 * Component Ids
	 */
	$config['component_id']['system']	= 1;
	$config['component_name']['1']		= "System";
	$config['component_class']['1']		= "ni-h0";
	$config['component_id']['auth']		= 2;
	$config['component_name']['2']		= "Authentication";
	$config['component_class']['2']		= "ni-h15";
	$config['component_id']['profile']	= 3;
	$config['component_name']['3']		= "Profile";
	$config['component_class']['3']		= "ni-h30";
	$config['component_id']['event']	= 4;
	$config['component_name']['4']		= "Event";
	$config['component_class']['4']		= "ni-h45";
	$config['component_id']['review']	= 5;
	$config['component_name']['5']		= "Review";
	$config['component_class']['5']		= "ni-h60";
	
	
/* End of file ls_notifications.php */
/* Location: ./application/config/ls_notifications.php */