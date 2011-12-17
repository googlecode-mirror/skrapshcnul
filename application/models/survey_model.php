<?php

/*
 * restaurant model 
 */
class Survey_Model extends CI_Model {	
	const _SURVEY_TABLE_ = "lss_survey_data";
	
	/*
	 *  Delete tables
	 *  Warning: Only for testing.
	 */
	function clearSurveyModel() {
		$query = "TRUNCATE TABLE " . self::_SURVEY_TABLE_;
		return $this -> db -> query($query);
	}
	
	/*
	 * Insert
	 */
	function insertSurveyData($obj) {
		$index = $obj['index'];
		$user_id = $obj['user_id'];
		$tar_id = $obj['target_id'];
		$tar_point = $obj['target_point'];
		$tar_review = $obj['target_review'];
		$res_id = $obj['restaurant_id'];
		$res_point = $obj['restaurant_point'];
		$res_review = $obj['restaurant_review'];		
		
		if (empty($index) || empty($user_id) || empty($tar_id) || 
		    empty($tar_point) || empty($tar_review) || empty($res_id) 
		    || empty($res_point) || empty($res_review)) return FALSE;
		
		$query = "INSERT INTO " . self::_SURVEY_TABLE_ .
		         " (`index`, user_id, target_id, target_point, target_review, " . 
		         " restaurant_id, restaurant_point, restaurant_review) " .
		         " VALUES ('$index', '$user_id', '$tar_id', '$tar_point', " . 
		         " '$tar_review', '$res_id', '$res_point', '$res_review');";
		return $this -> db -> query($query);
	}
}
?>
