<?php

/*
 * restaurant model 
 */
class Places_Model extends CI_Model {
	const _PLACES_TABLE_ = "lss_places";
	const _PLACES_VERIFIED_TABLE = "lss_places_verification_status"; 
	const _PLACES_XTRA_RESTAURANT_TABLE = "lss_places_xtra_restaurant";
	
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
	function insertPlace($obj = FALSE) {
		
		if (!$obj) return FALSE;
		if (empty($obj['name'])) return FALSE;
		
		$data = array();
		if (isset($obj['name'])) { $data['name'] = ($obj['name']); }
		if (isset($obj['logo'])) { $data['logo'] = ($obj['logo']); }
		if (isset($obj['primary_phone'])) { $data['primary_phone'] = ($obj['primary_phone']); }
		if (isset($obj['url'])) { $data['url'] = ($obj['url']); }
		if (isset($obj['location'])) { $data['location'] = ($obj['location']); }
		if (isset($obj['geo_lat'])) { $data['geo_lat'] = ($obj['geo_lat']); }
		if (isset($obj['geo_long'])) { $data['geo_long'] = ($obj['geo_long']); }
		if (isset($obj['valid'])) { $data['valid'] = ($obj['valid']); }
		$data['created_on'] = 'NOW()';
		
		if ($this->db->insert(self::_PLACES_TABLE_, $data)) {
			
			## Xtra information
			$obj['place_id'] = $this->db->insert_id();
			$this -> insert_place_verification($obj);
			$this -> insert_place_xtra_restaurant($obj);
			
			return $obj['place_id'];
		};
		
		return FALSE;
	}
	
	private function insert_place_verification($obj = FALSE) {
		
		if (!isset($obj['place_id'])) { return FALSE; }
		
		$data = array();
		if (isset($obj['place_id'])) { $data['place_id'] = ($obj['place_id']); }
		if (isset($obj['status'])) { $data['status'] = ($obj['status']); }
		if (isset($obj['remarks'])) { $data['remarks'] = ($obj['remarks']); }
		if (isset($obj['updated_by'])) { $data['updated_by'] = ($obj['updated_by']); }
		$data['created_on'] = 'NOW()';
		
		return $this->db->insert(self::_PLACES_VERIFIED_TABLE, $data);
	}
	
	private function insert_place_xtra_restaurant($obj = FALSE) {
		
		if (!isset($obj['place_id'])) { return FALSE; }
		
		$data = array();
		if (isset($obj['place_id'])) { $data['place_id'] = ($obj['place_id']); }
		if (isset($obj['cuisine'])) { $data['cuisine'] = ($obj['cuisine']); }
		if (isset($obj['opening_hours'])) { $data['opening_hours'] = ($obj['opening_hours']); }
		if (isset($obj['special_features'])) { $data['special_features'] = ($obj['special_features']); }
		if (isset($obj['extras'])) { $data['extras'] = ($obj['extras']); }
		$data['created_on'] = 'NOW()';
		
		return $this->db->insert(self::_PLACES_XTRA_RESTAURANT_TABLE, $data);
	}
	
	function updatePlace($obj = FALSE) {
		
		if (!isset($obj['place_id'])) { return FALSE; }
		
		$data = array();
		if (isset($obj['name'])) { $data['name'] = ($obj['name']); }
		if (isset($obj['logo'])) { $data['logo'] = ($obj['logo']); }
		if (isset($obj['primary_phone'])) { $data['primary_phone'] = ($obj['primary_phone']); }
		if (isset($obj['url'])) { $data['url'] = ($obj['url']); }
		if (isset($obj['location'])) { $data['location'] = ($obj['location']); }
		if (isset($obj['geo_lat'])) { $data['geo_lat'] = ($obj['geo_lat']); }
		if (isset($obj['geo_long'])) { $data['geo_long'] = ($obj['geo_long']); }
		if (isset($obj['valid'])) { $data['valid'] = ($obj['valid']); }
		$where = array (
			'place_id' => isset($obj['place_id']) ? trim($obj['place_id']) : FALSE
		);

		if (sizeof($data) > 0) {
			return $this->db->update(self::_PLACES_TABLE_, $data, $where); 
		} else {
			return FALSE;
		}
		
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

		if (sizeof($data) > 0) {
			return $this->db->update(self::_PLACES_VERIFIED_TABLE, $data, $where); 
		} else {
			return FALSE;
		}
	}
	
	function updatePlace_xtra_restaurants($obj) {
		
		$data = array();
		if (isset($obj['cuisine'])) { $data['cuisine'] = ($obj['cuisine']); }
		if (isset($obj['opening_hours'])) { $data['opening_hours'] = ($obj['opening_hours']); }
		if (isset($obj['special_features'])) { $data['special_features'] = ($obj['special_features']); }
		if (isset($obj['extras'])) { $data['extras'] = ($obj['extras']); }
		$where = array (
			'place_id' => isset($obj['place_id']) ? trim($obj['place_id']) : FALSE
		);
		if (sizeof($data) > 0) {
			return $this->db->update(self::_PLACES_XTRA_RESTAURANT_TABLE, $data, $where); 
		} else {
			return FALSE;
		}
		
	}
	
	/*
	 * Select
	 */
	function selectPlaceById($place_id) {
		
		if (!isset($place_id)) { return FALSE; }
		
		$where = array();
		$where['place_id'] = $place_id;
		
		$mysql_result = $this->db->get_where(self::_PLACES_TABLE_, $where);
		
		return $mysql_result -> row_array();
	}
	
	function selectPlace_verification($place_id) {
		
		if (!isset($place_id)) { return FALSE; }
		
		$where = array();
		$where['place_id'] = $place_id;
		
		$mysql_result = $this->db->get_where(self::_PLACES_VERIFIED_TABLE, $where);
		
		return $mysql_result -> row_array();
	}
	
	function selectPlace_xtra_restaurant($place_id) {
		
		if (!isset($place_id)) { return FALSE; }
		
		$where = array();
		$where['place_id'] = $place_id;
		
		$mysql_result = $this->db->get_where(self::_PLACES_XTRA_RESTAURANT_TABLE, $where);
		
		return $mysql_result -> row_array();
	}
}
?>
