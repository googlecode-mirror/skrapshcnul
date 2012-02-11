<?php

/*
 * restaurant model 
 */
class Restaurant_Model extends CI_Model {	
	const _RESTAURANT_TABLE_ = "lss_restaurants";
	
	/*
	 *  Delete tables
	 *  Warning: Only for testing.
	 */
	function clearRestaurants() {
		$query = "TRUNCATE TABLE " . self::_RESTAURANT_TABLE_;
		return $this -> db -> query($query);
	}
	
	/*
	 * Insert
	 */
	function insertRestaurant($obj) {
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
	function selectRestaurantById($id) {
		$query = "SELECT * FROM " . self::_RESTAURANT_TABLE_ .
		         " WHERE `restaurant_id` = '$id';";
		$obj = $this -> db -> query($query);
		if ($obj -> num_rows() != 1) return NULL;
		else return $obj -> row_array();
	}
}
?>
