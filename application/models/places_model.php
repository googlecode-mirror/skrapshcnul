<?php

/*
 * restaurant model 
 */
class Places_Model extends CI_Model {
	const _PLACES_TABLE_ = "lss_places";
	const _PLACES_VERIFIED_TABLE = "lss_places_verification_status";
	
	/*
	 *  Delete tables
	 *  Warning: Only for testing.
	 */
	function clearPlaces() {
		$query = "TRUNCATE TABLE " . self::_PLACES_TABLE_;
		return $this -> db -> query($query);
	}
	
	/*
	 * Insert
	 */
	function insertPlace($obj) {
		$name = $obj['name'];
		$location = $obj['location'];
		
		if (empty($name) || empty($location)) return FALSE;
		
		$query = "INSERT INTO " . self::_PLACES_TABLE_ .
		         " (name, location, valid, created_on) " .
		         " VALUES ('$name', '$location', '1', NOW());";
		return $this -> db -> query($query);         
	}
	
	function updatePlace($obj = FALSE) {
		
		if (!isset($obj['place_id'])) { return FALSE; }
		
		$data = array();
		if (isset($obj['name'])) { $data['name'] = ($obj['name']); }
		if (isset($obj['logo'])) { $data['logo'] = ($obj['logo']); }
		if (isset($obj['location'])) { $data['location'] = ($obj['location']); }
		if (isset($obj['geo_lat'])) { $data['geo_lat'] = ($obj['geo_lat']); }
		if (isset($obj['geo_long'])) { $data['geo_long'] = ($obj['geo_long']); }
		if (isset($obj['valid'])) { $data['valid'] = ($obj['valid']); }
		$where = array (
			'place_id' => isset($obj['place_id']) ? trim($obj['place_id']) : FALSE
		);

		return $this->db->update(self::_PLACES_TABLE_, $data, $where); 
		
	}

	function updatePlace_verification($obj = FALSE) {
		
		if (!isset($obj['place_id'])) { return FALSE; }
		
		$data = array();
		if (isset($obj['status'])) { $data['status'] = ($obj['status']); }
		if (isset($obj['remarks'])) { $data['remarks'] = ($obj['remarks']); }
		if (isset($obj['updated_by'])) { $data['updated_by'] = ($obj['updated_by']); }
		$where = array (
			'place_id' => isset($obj['place_id']) ? trim($obj['place_id']) : FALSE
		);
		
		//var_dump($data);
		//var_dump($where);

		return $this->db->update(self::_PLACES_VERIFIED_TABLE, $data, $where); 
	}
	
	/*
	 * Select
	 */
	function selectPlaceById($id) {
		$query = "SELECT * FROM " . self::_PLACES_TABLE_ .
		         " WHERE `place_id` = '$id';";
		$obj = $this -> db -> query($query);
		if ($obj -> num_rows() != 1) return NULL;
		else return $obj -> row_array();
	}
	
	function selectPlaceVerification($place_id) {
		$where = array();
		$where['place_id'] = $place_id;
		
		$mysql_result = $this->db->get_where(self::_PLACES_VERIFIED_TABLE, $where);
		
		return  $mysql_result -> row_array();
	}
}
?>
