<?php

/*
 * Recommendation system - the most important system of lunchsparks
 * What does this system do?
 * 1. Allow algorithm system to automatically recommends users to meet.
 * 2. Allow users to choose who to meet among their recommendations.
 * 3. Allow algorithm system to match users based on their choices.
 * 4. Allow users to accept/refuse a match.
 * 5. When both users accept, create a lunch for both parties.
 * Note in terminology: "a match" = "a negotiated recommendation".  
 */
class Recs_Model extends CI_Model {
	const _AUTO_RECS_TABLE_ = "lss_0_auto_recs";
	const _SELECTED_RECS_TABLE_ = "lss_0_selected_recs";
	const _NEGOTIATED_RECS_TABLE_ = "lss_0_negotiated_recs";
	const _ACCEPTED_RECS_TABLE_ = "lss_0_accepted_recs";
	const _SUCCESSFUL_RECS_TABLE_ = "lss_0_successful_recs";
	const _TIME_LOCATION_TABLE_ = "lss_0_recs_time_location";
	    
    /*
     * Helper 
     */
	function _which($table) {		
		if ($table === self::_AUTO_RECS_TABLE_ || 
			$table === self::_SELECTED_RECS_TABLE_ ||
			$table === self::_NEGOTIATED_RECS_TABLE_ ||
			$table === self::_ACCEPTED_RECS_TABLE_ ||
			$table === self::_SUCCESSFUL_RECS_TABLE_ ||
			$table === self::_TIME_LOCATION_TABLE_) return $table;
		else return NULL;
	}
	
	/*
	 *  Delete tables
	 *  Warning: Only for testing.
	 */
	function _clear($table) {
		$table = $this -> _which($table);
		if (empty($table)) return NULL;
				
		$query = "TRUNCATE TABLE " . $table . ";";		
		return $this -> db -> query($query);
	}
	
	function clearAutoRecs() {
		return $this -> _clear(self::_AUTO_RECS_TABLE_);
	}
	
	function clearSelectedRecs() {
		return $this -> _clear(self::_SELECTED_RECS_TABLE_);
	}
	
	function clearNegotiatedRecs() {
		return $this -> _clear(self::_NEGOTIATED_RECS_TABLE_);
	}
	
	function clearAcceptedRecs() {
		return $this -> _clear(self::_ACCEPTED_RECS_TABLE_);
	}
	
	function clearSuccessfulRecs() {
		return $this -> _clear(self::_SUCCESSFUL_RECS_TABLE_);
	}
	

    /*
     * Insertion
     */
    
    // auto    
	function insertAutoRec($obj) {    		
		$user_id = $obj['user_id'];
		$rec_id = $obj['rec_id'];
		$rec_reason = $obj['rec_reason'];
		
		if (empty($user_id) || empty($rec_id)) return FALSE;
		if (empty($rec_reason)) $rec_reason = 'NULL';
		
		$query = "INSERT INTO " . self::_AUTO_RECS_TABLE_ . 
		         " (user_id, rec_id, rec_reason, valid) VALUES" . 
		         " ('$user_id', '$rec_id', '$rec_reason', '1');";
		 
		return $this -> db -> query($query);
	}    
			
	
	// selected
	function _insertRec($table, $index) {
		$table = $this -> _which($table);
		if (empty($table)) return FALSE;
		
        $query = "INSERT INTO " . $table .
                 " (`index`, valid) VALUES ('$index', '1');";       
        return $this -> db -> query($query);
    }
    
	function insertSelectedRec($index) {
		return $this -> _insertRec(self::_SELECTED_RECS_TABLE_, $index);
	}
	
	// negotiated
	function insertNegotiatedRec($index) {
		return $this -> _insertRec(self::_NEGOTIATED_RECS_TABLE_, $index);
	}
	
	// accepted
	function insertAcceptedRec($index) {
		return $this -> _insertRec(self::_ACCEPTED_RECS_TABLE_, $index);
	}
	
	// successful
	function insertSuccessfulRec($index) {
		return $this -> _insertRec(self::_SUCCESSFUL_RECS_TABLE_, $index);
	}
    
	
	/*
     * Selection
     */    
     
    // auto   
	function selectAutoRecsByUserId($user_id) { // can return more than one record
		$query = "SELECT * FROM " . self::_AUTO_RECS_TABLE_ .
		         " WHERE user_id = '$user_id' AND valid = '1';";
		$obj = $this -> db -> query($query);
		if (empty($obj)) return NULL;
		else {
			$obj  = $obj -> result();
			return $obj;
		}
    }
	
    function _selectRecByIndex($table, $index) { // return only one record
		$table = $this -> _which($table);
		if (empty($table)) return NULL;
    	    
		$query = "SELECT * FROM " . $table .
		         " WHERE `index` = '$index' AND valid = '1';";
		$obj = $this -> db -> query($query);
		
		if (empty($obj)) return NULL;
		else if ($obj -> num_rows() != 1) return NULL;
		else {
			$obj = $obj -> result();			
			return $obj[0];
		}
    }
	
	function selectAutoRecByIndex($index) {
		return $this -> _selectRecByIndex(self::_AUTO_RECS_TABLE_, $index);		
	}
	
	// selected
	function selectSelectedRecByIndex($index) {
		return $this -> _selectRecByIndex(self::_SELECTED_RECS_TABLE_, $index);
	}
	
	// negotiated
	function selectNegotiatedRecByIndex($index) {
		return $this -> _selectRecByIndex(self::_NEGOTIATED_RECS_TABLE_, $index);
	}
	
	// accepted
	function selectAcceptedRecByIndex($index) {
		return $this -> _selectRecByIndex(self::_ACCEPTED_RECS_TABLE_, $index);
	}
	
	// successful
	function selectSuccessfulRecByIndex($index) {
		return $this -> _selectRecByIndex(self::_SUCCESSFUL_RECS_TABLE_, $index);
	}
	
	function selectSuccessfulRecByUserId($user_id) {
		$query = "SELECT * FROM " . 
		         " (SELECT " . self::_AUTO_RECS_TABLE_ . ".index, " . self::_AUTO_RECS_TABLE_ . ".user_id" . 
		         " FROM " . self::_AUTO_RECS_TABLE_ . 
		         " INNER JOIN " . self::_SUCCESSFUL_RECS_TABLE_ .
		         " ON " . self::_AUTO_RECS_TABLE_ . ".index " . 
		         " = " . self::_SUCCESSFUL_RECS_TABLE_ . ".index) temp ".
				 " WHERE temp.user_id = $user_id";
		$result = $this -> db -> query($query);
		if (empty($result)) return NULL;
		else if ($result -> num_rows() != 1) return NULL; 
		else {
			$result = $result -> result();
			return $result[0] -> index;
		}
	}
    
	/*
	 * Deletion
	 */	
	 
	// auto
    function removeAutoRecsByUserId($user_id) { // can remove more than 1 record
        $query = "UPDATE " . self::_AUTO_RECS_TABLE_ .
                 " SET valid = '0'" .
                 " WHERE user_id = '$user_id' AND valid = '1';";
        return $this -> db -> query($query);
    }
	
    function _removeRecByIndex($table, $index) { // can remove only 1 record
    	$table = $this -> _which($table);
		if (empty($table)) return FALSE;
		
        $query = "UPDATE " . $table .
                 " SET valid = '0'" .
                 " WHERE `index` = '$index' AND valid = '1';";
        return $this -> db -> query($query);
    }
	
	function removeAutoRecByIndex($index) {
		return $this -> _removeRecByIndex(self::_AUTO_RECS_TABLE_, $index);
	}
	
	// selected
	function removeSelectedRecByIndex($index) {
		return $this -> _removeRecByIndex(self::_SELECTED_RECS_TABLE_, $index);
	}
	
	// negotiated
	function removeNegotiatedRecByIndex($index) {
		return $this -> _removeRecByIndex(self::_NEGOTIATED_RECS_TABLE_, $index);
	}
	
	// accepted
	function removeAcceptedRecByIndex($index) {
		return $this -> _removeRecByIndex(self::_ACCEPTED_RECS_TABLE_, $index);
	}
	
	// successful
	function removeSuccessfulRecByIndex($index) {
		return $this -> _removeRecByIndex(self::_SUCCESSFUL_RECS_TABLE_, $index);
	}
	
	/*
	 * Model for _TIME_LOCATION_TABLE_
	 */
	function clearTimeLocations() {
		return $this -> _clear(self::_TIME_LOCATION_TABLE_);
	}
	
	function insertTimeLocation($obj) {
		$index = $obj['index'];
		$date = $obj['date'];
		$time = $obj['time'];
		$restaurant_id = $obj['restaurant_id'];
		
		if (empty($index) || empty($date) || empty($time) || 
			empty($restaurant_id)) return FALSE;
		
		$query = "INSERT INTO " . self::_TIME_LOCATION_TABLE_ . 
		         " (`index`, date, time, restaurant_id, valid) VALUES" . 
		         " ('$index', '$date', '$time', '$restaurant_id', '1');";
		 
		return $this -> db -> query($query);
	}
	
	function selectTimeLocationByIndex($index) { // return only 1 result	
		$query = "SELECT * FROM " . self::_TIME_LOCATION_TABLE_ .
		         " WHERE `index` = '$index' AND valid = '1';";
		$obj = $this -> db -> query($query);
		if (empty($obj)) return FALSE;
		else if ($obj -> num_rows() != 1) return FALSE;
		else {
			$obj  = $obj -> result();
			return $obj[0];
		}
	}
	
	function removeTimeLocationByIndex($index) {
		$query = "UPDATE " . self::_TIME_LOCATION_TABLE_ .
                 " SET valid = '0'" .
                 " WHERE `index` = '$index' AND valid = '1';";
        return $this -> db -> query($query);
	}
	
	/*
	 * A set of operations to retrieve data for specific layouts
	 */ 
	 
	// for survey, we need: lunch buddy info (name, id), restaurant info (name, id)
	function prepareDataForSurvey() {
		$this -> db -> trans_start();
		
		$result = array();
		
		$user_id = $this -> session -> userdata('user_id'); // current user id		
		
		$index = $this -> selectSuccessfulRecByUserId($user_id); // get the index of the match
		$result['index'] = $index;
		
		// retrieve lunch partner
		$obj = $this -> selectAutoRecByIndex($index);
		$target_id = $obj -> rec_id; // get target id		
		
		$this -> load -> model('user_profile_model');
		$result['partner'] = (object) $this -> user_profile_model -> select($target_id);		
				
		// retrieve restaurant info
		$obj = $this -> selectTimeLocationByIndex($index);
		$restaurant_id = $obj -> restaurant_id;
		
		$this -> load -> model('places_model');
		$result['restaurant'] = $this -> places_model -> selectPlaceById($restaurant_id);		
		 
		$this -> db -> trans_complete();
		
		return (object) $result;
	}
}
?>
