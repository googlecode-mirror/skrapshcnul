<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 * Name:  Ion Auth Config
 *
 * Author: @stiucsib86
 * Created:  17.12.2011
 */

/**
 * Tables.
 **/

//$config['tables']['event_auto_recommendation'] = "lss_0_auto_recs";
$config['tables']['event_selected_recommendation'] = "lss_0_selected_recs";
$config['tables']['event_negotiated_recommendation'] = "lss_0_negotiated_recs";
$config['tables']['event_accepted_recommendation'] = "lss_0_accepted_recs";
$config['tables']['event_successful_recommendation'] = "lss_0_successful_recs";

$config['tables']['event_auto_recommendation'] = "lss_recommendations";

$config['tables']['events_event'] = "lss_events";
$config['tables']['events_users'] = "lss_events_users";

/* End of file /tables/events.php */
