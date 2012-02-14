<?php

/*
 * restaurant model 
 */
class Places_Model extends CI_Model {
	const _RESTAURANT_TABLE_ = "lss_places";
	const _RESTAURANT_VERIFIED_TABLE_ = "lss_places_verification_status";
	
	/*
	 *  Delete tables
	 *  Warning: Only for testing.
	 */
	function clearPlaces() {
		$query = "TRUNCATE TABLE " . self::_RESTAURANT_TABLE_;
		return $this -> db -> query($query);
	}
	
	/*
	 * Insert
	 */
	function insertPlace($obj) {
		$name = $obj['name'];
		$location = $obj['location'];
		
		if (empty($name) || empty($location)) return FALSE;
		
		$query = "INSERT INTO " . self::_RESTAURANT_TABLE_ .
		         " (name, location, valid) " .
		         " VALUES ('$name', '$location', '1');";
		return $this -> db -> query($query);         
	}
	
	/*
	 * Select
	 */
	function selectPlaceById($id) {
		$query = "SELECT * FROM " . self::_RESTAURANT_TABLE_ .
		         " WHERE `place_id` = '$id';";
		$obj = $this -> db -> query($query);
		if ($obj -> num_rows() != 1) return NULL;
		else return $obj -> row_array();
	}
}
?>
