<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Name:  Notification
 * Author: @stiucsib86
 * Created:  11.09.2011
 * Description:
 * Requirements: PHP5 or above
 */
class Ls_Scripts {

	function __construct() {

		$this -> ci = &get_instance();
		$this -> ci -> load -> driver('minify');
		
		$this -> js_files = array(
			'skin/js/lunchsparks/ls_autocomplete.js',
			'skin/js/lunchsparks/ls_bubble_info.js',
			'skin/js/lunchsparks/ls_cover_img.js',
			'skin/js/lunchsparks/ls_googlemap.js',
			'skin/js/lunchsparks/ls_guide.js',
			'skin/js/lunchsparks/ls_invitations.js',
			'skin/js/lunchsparks/ls_notifications.js', 
			'skin/js/lunchsparks/ls_preferences.js',
			'skin/js/lunchsparks/ls_recommendations.js',
			'skin/js/lunchsparks/ls_schedules.js',
			'skin/js/lunchsparks/ls_search.js',
			'skin/js/lunchsparks/ls_settings.js',
			'skin/js/lunchsparks/ls_steps_completed.js',
			'skin/js/lunchsparks/ls_users.js',
			'skin/js/lunchsparks/lunchsparks.js',
		);
			
		$this -> css_files = array(
			'skin/css/animation.css',
			'skin/css/autocomplete.css',
			'skin/css/buttons.css',
			'skin/css/bubble_info.css',
			'skin/css/boxes.css',
			'skin/css/carousel.css',
			'skin/css/colors.css',
			'skin/css/errors.css',
			'skin/css/fieldsets.css',
			'skin/css/guides.css',
			'skin/css/header.css',
			'skin/css/icons.css',
			'skin/css/invitation.css',
			'skin/css/layout.css',
			'skin/css/layout_singlebox.css',
			'skin/css/notification_icons.css',
			'skin/css/notifications.css',
			'skin/css/pages.css',
			'skin/css/pin.css',
			'skin/css/places.css',
			'skin/css/preferences.css',
			'skin/css/schedules.css',
			'skin/css/search.css',
			'skin/css/sidebars.css',
			'skin/css/style.css',
			'skin/css/tables.css',
			'skin/css/tags.css',
			'skin/css/user.css',
			'skin/css/user_profile.css',
			'skin/css/fonts/droid_sans.css',
			'skin/css/fonts/open_sans.css',
		);
		
		$this->_minify_css();
		$this->_minify_js();
		
		if(isset($_REQUEST['minify']) && ($_REQUEST['minify']) == 1) {
			$scripts['css_combined']	= $this->_minify_css(); 
			$scripts['js_combined']		= $this->_minify_js();
		}
		
		if (!strstr(base_url(), 'lunchsparks.me')){
			$scripts['css_combined']	= $this->_normal_css();
			$scripts['js_combined']		= $this->_normal_js();
		} else {
			$scripts['css_combined']	= $this->_minify_css(); 
			$scripts['js_combined']		= $this->_minify_js();
		}
		
		$this -> ci -> load -> vars($scripts);
		
	}
	
	function _minify_css() {
		$contents = $this->ci->minify->css->combine_files($this -> css_files);
		$this->ci->minify->save_file($contents, 'skin/css/all.css'); 
		return '<link rel="stylesheet" href="'.base_url().'skin/css/all.css" type="text/css" media="screen" charset="utf-8" />';
	}
	
	function _minify_js() {
		$contents = $this->ci->minify->js->combine_files($this -> js_files);
		$this->ci->minify->save_file($contents, 'skin/js/all.js'); 
		return '<script src="'.base_url().'skin/js/all.js"></script>'; 
	}
	
	function _normal_css() {
		$results = '';
		foreach ($this -> css_files as $item) {
			$results.=
				'<link rel="stylesheet" href="'.base_url().$item.'" type="text/css" media="screen" charset="utf-8" />';
		}
		return $results;
	}
	
	function _normal_js() {
		$results = '';
		foreach ($this -> js_files as $item) {
			$results.=
				'<script src="'.base_url().$item.'"></script>';
		}
		return $results;
	}
	
}
?>