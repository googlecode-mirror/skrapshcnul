<?php

/*
 * restaurant model
 */
class Projects_Model extends CI_Model {

	function __construct() {
		$this -> load -> config('tables/projects', TRUE);
		$this -> load -> library('session');

		## Initialize DB
		$this -> tables = $this -> config -> item('tables', 'tables/projects');

		$this -> user_id = $this -> session -> userdata('user_id');
	}

	/*
	 * Insert
	 */
	function insertProject($obj = FALSE) {

		if (!$obj)
			return FALSE;
		if (empty($obj['name']))
			return FALSE;

		$data = array();
		if (isset($obj['project_type_id'])) {
			$data['project_type_id'] = ($obj['project_type_id']);
		}
		if (isset($obj['name'])) {
			$data['name'] = ($obj['name']);
		}
		if (isset($obj['description'])) {
			$data['description'] = ($obj['description']);
		}
		if (isset($obj['logo'])) {
			$data['logo'] = ($obj['logo']);
		}
		if (isset($obj['cover_img'])) {
			$data['cover_img'] = ($obj['cover_img']);
		}
		if (isset($obj['video_src'])) {
			$data['video_src'] = ($obj['video_src']);
		}
		if (isset($obj['created_by'])) {
			$data['created_by'] = ($obj['created_by']);
		}
		$this -> db -> set('created_on', 'NOW()', FALSE);

		if ($this -> db -> insert($this -> tables['projects'], $data)) {

			## Xtra information
			$obj['project_id'] = $this -> db -> insert_id();
			$this -> insert_project_apps($obj);
			$this -> insert_project_external_url($obj);
			$this -> insert_project_screenshot($obj);
			$this -> insert_project_tags($obj);
			$this -> insert_project_team_member($obj);
			$this -> insert_project_verification($obj);

			return $obj['project_id'];
		};

		return FALSE;
	}

	private function insert_project_apps($obj = FALSE) {

		if (!isset($obj['project_id'])) {
			return FALSE;
		}

		$data = array();
		if (isset($obj['project_id'])) { $data['project_id'] = ($obj['project_id']);
		}
		if (isset($obj['ios_app_store_url'])) { $data['ios_app_store_url'] = ($obj['ios_app_store_url']);
		}
		if (isset($obj['android_market_url'])) { $data['android_market_url'] = ($obj['android_market_url']);
		}
		if (isset($obj['wp_market_url'])) { $data['wp_market_url'] = ($obj['wp_market_url']);
		}
		$this -> db -> set('created_on', 'NOW()', FALSE);

		return $this -> db -> insert($this -> tables['projects_apps'], $data);
	}

	private function insert_project_external_url($obj = FALSE) {

		if (!isset($obj['project_id'])) {
			return FALSE;
		}

		$data = array();
		if (isset($obj['project_id'])) { $data['project_id'] = ($obj['project_id']);
		}
		if (isset($obj['homepage'])) { $data['homepage'] = ($obj['homepage']);
		}
		if (isset($obj['github_url'])) { $data['github_url'] = ($obj['github_url']);
		}
		if (isset($obj['facebook_url'])) { $data['facebook_url'] = ($obj['facebook_url']);
		}
		if (isset($obj['twitter_url'])) { $data['twitter_url'] = ($obj['twitter_url']);
		}
		if (isset($obj['gplus_url'])) { $data['gplus_url'] = ($obj['gplus_url']);
		}
		$this -> db -> set('created_on', 'NOW()', FALSE);

		return $this -> db -> insert($this -> tables['projects_xurl'], $data);

	}

	private function insert_project_screenshot($obj = FALSE) {

		if (!isset($obj['project_id'])) {
			return FALSE;
		}

		$data = array();
		if (isset($obj['project_id'])) { $data['project_id'] = ($obj['project_id']);
		}
		if (isset($obj['project_id'])) { $data['project_id'] = ($obj['project_id']);
		}
		if (isset($obj['src'])) { $data['src'] = ($obj['src']);
		}
		if (isset($obj['is_external'])) { $data['is_external'] = ($obj['is_external']);
		}
		if (isset($obj['screenshot_details'])) { $data['screenshot_details'] = ($obj['screenshot_details']);
		}

		return $this -> db -> insert($this -> tables['projects_screenshots'], $data);
	}

	private function insert_project_tags($obj = FALSE) {

		if (!isset($obj['project_id'])) {
			return FALSE;
		}

		## Validate tags data as JSON string.
		if (is_array($obj['tags_data'])) { $obj['tags_data'] = json_encode($obj['tags_data']);
		}

		$data = array();
		if (isset($obj['project_id'])) { $data['project_id'] = ($obj['project_id']);
		}
		if (isset($obj['tags_type_id'])) { $data['tags_type_id'] = ($obj['tags_type_id']);
		}
		if (isset($obj['tags_cat_id'])) { $data['tags_cat_id'] = ($obj['tags_cat_id']);
		}
		if (isset($obj['tags_data'])) { $data['tags_data'] = ($obj['tags_data']);
		}
		$this -> db -> set('created_on', 'NOW()', FALSE);

		return $this -> db -> insert($this -> tables['projects_tags'], $data);
	}

	private function insert_project_team_member($obj = FALSE) {

		if (!isset($obj['project_id'])) {
			return FALSE;
		}

		$data = array();
		if (isset($obj['project_id'])) { $data['project_id'] = ($obj['project_id']);
		}
		if (isset($obj['user_id'])) { $data['user_id'] = ($obj['user_id']);
		}
		if (isset($obj['date_joined'])) { $data['date_joined'] = ($obj['date_joined']);
		}
		if (isset($obj['date_leaved'])) { $data['date_leaved'] = ($obj['date_leaved']);
		}
		$this -> db -> set('created_on', 'NOW()', FALSE);

		return $this -> db -> insert($this -> tables['projects_team'], $data);

	}

	private function insert_project_verification($obj = FALSE) {

		if (!isset($obj['project_id'])) {
			return FALSE;
		}

		$data = array();
		if (isset($obj['project_id'])) { $data['project_id'] = ($obj['project_id']);
		}
		if (isset($obj['status'])) { $data['status'] = ($obj['status']);
		}
		if (isset($obj['remarks'])) { $data['remarks'] = ($obj['remarks']);
		}
		if (isset($obj['updated_by'])) { $data['updated_by'] = ($obj['updated_by']);
		}
		$this -> db -> set('created_on', 'NOW()', FALSE);

		return $this -> db -> insert($this -> tables['projects_verification'], $data);
	}

	function update_project($obj = FALSE) {

		if (!isset($obj['project_id'])) {
			return FALSE;
		}

		$data = array();
		if (isset($obj['project_type_id'])) { $data['project_type_id'] = ($obj['project_type_id']);
		}
		if (isset($obj['name'])) { $data['name'] = ($obj['name']);
		}
		if (isset($obj['description'])) { $data['description'] = ($obj['description']);
		}
		if (isset($obj['cover_img'])) { $data['cover_img'] = ($obj['cover_img']);
		}
		if (isset($obj['video_src'])) { $data['video_src'] = ($obj['video_src']);
		}
		if (isset($obj['created_by'])) { $data['created_by'] = ($obj['created_by']);
		}
		$where = array('project_id' => isset($obj['project_id']) ? trim($obj['project_id']) : FALSE);

		if (sizeof($data) > 0) {
			return $this -> db -> update($this -> tables['projects'], $data, $where);
		} else {
			return FALSE;
		}

	}

	function update_project_apps($obj = FALSE) {

		if (!isset($obj['project_id'])) {
			return FALSE;
		}

		$data = array();
		if (isset($obj['ios_app_store_url'])) {
			$data['ios_app_store_url'] = ($obj['ios_app_store_url']);
		}
		if (isset($obj['android_market_url'])) {
			$data['android_market_url'] = ($obj['android_market_url']);
		}
		if (isset($obj['wp_market_url'])) {
			$data['wp_market_url'] = ($obj['wp_market_url']);
		}
		$where = array('project_id' => isset($obj['project_id']) ? trim($obj['project_id']) : FALSE);

		if (sizeof($data) > 0) {
			return $this -> db -> update($this -> tables['projects_apps'], $data, $where);
		} else {
			return FALSE;
		}
	}

	function update_project_xurl($obj = FALSE) {

		if (!isset($obj['project_id'])) {
			return FALSE;
		}

		$data = array();
		if (isset($obj['homepage'])) {
			$data['homepage'] = ($obj['homepage']);
		}
		if (isset($obj['github_url'])) {
			$data['github_url'] = ($obj['github_url']);
		}
		if (isset($obj['facebook_url'])) {
			$data['facebook_url'] = ($obj['facebook_url']);
		}
		if (isset($obj['twitter_url'])) {
			$data['twitter_url'] = ($obj['twitter_url']);
		}
		if (isset($obj['gplus_url'])) {
			$data['gplus_url'] = ($obj['gplus_url']);
		}

		$where = array('project_id' => isset($obj['project_id']) ? trim($obj['project_id']) : FALSE);

		if (sizeof($data) > 0) {
			return $this -> db -> update($this -> tables['projects_xurl'], $data, $where);
		} else {
			return FALSE;
		}
	}

	function update_project_screenshots($obj = FALSE) {

		if (!isset($obj['project_id'])) {
			return FALSE;
		}
		if (!isset($obj['project_screenshot_id'])) {
			return FALSE;
		}

		$data = array();
		if (isset($obj['src'])) {
			$data['src'] = ($obj['src']);
		}
		if (isset($obj['is_external'])) {
			$data['is_external'] = ($obj['is_external']);
		}
		if (isset($obj['screenshot_details'])) {
			$data['screenshot_details'] = ($obj['screenshot_details']);
		}

		$where = array('project_id' => isset($obj['project_id']) ? trim($obj['project_id']) : FALSE);
		$where = array('project_screenshot_id' => isset($obj['project_screenshot_id']) ? trim($obj['project_screenshot_id']) : FALSE);

		if (sizeof($data) > 0) {
			return $this -> db -> update($this -> tables['projects_screenshots'], $data, $where);
		} else {
			return FALSE;
		}
	}

	function update_project_tags($obj = FALSE) {

		if (!isset($obj['project_id'])) {
			return FALSE;
		}
		if (!isset($obj['tags_type_id'])) {
			return FALSE;
		}

		$data = array();
		if (isset($obj['tags_data'])) { $data['tags_data'] = ($obj['tags_data']);
		}
		$where = array('project_id' => isset($obj['project_id']) ? trim($obj['project_id']) : FALSE);
		$where = array('tags_type_id' => isset($obj['tags_type_id']) ? trim($obj['tags_type_id']) : FALSE);

		if (sizeof($data) > 0) {
			return $this -> db -> update($this -> tables['projects_tags'], $data, $where);
		} else {
			return FALSE;
		}
	}

	function update_project_team_member($obj = FALSE) {

		if (!isset($obj['project_id'])) {
			return FALSE;
		}
		if (!isset($obj['user_id'])) {
			return FALSE;
		}

		$data = array();
		if (isset($obj['date_joined'])) {
			$data['date_joined'] = ($obj['date_joined']);
		}
		if (isset($obj['date_leaved'])) {
			$data['date_leaved'] = ($obj['date_leaved']);
		}

		$where = array('project_id' => isset($obj['project_id']) ? trim($obj['project_id']) : FALSE);
		$where = array('user_id' => isset($obj['user_id']) ? trim($obj['user_id']) : FALSE);

		if (sizeof($data) > 0) {
			return $this -> db -> update($this -> tables['projects_team'], $data, $where);
		} else {
			return FALSE;
		}
	}

	function update_project_verification($obj = FALSE) {

		if (!isset($obj['project_id'])) {
			return FALSE;
		}

		$data = array();
		if (isset($obj['status'])) {
			$data['status'] = ($obj['status']);
		}
		if (isset($obj['remarks'])) {
			$data['remarks'] = ($obj['remarks']);
		}
		if (isset($obj['updated_by'])) {
			$data['updated_by'] = ($obj['updated_by']);
		}

		$where = array('project_id' => isset($obj['project_id']) ? trim($obj['project_id']) : FALSE);

		if (sizeof($data) > 0) {
			return $this -> db -> update($this -> tables['projects_verification'], $data, $where);
		} else {
			return FALSE;
		}
	}

	/*
	 * Select
	 */
	function select_project($project_id = FALSE) {

		if (!isset($project_id)) {
			return FALSE;
		}

		$where = array();
		$where['project_id'] = $project_id;

		$mysql_result = $this -> db -> get_where($this -> tables['projects'], $where);

		return $mysql_result -> row_array();
	}

	function select_project_apps($project_id = FALSE) {

		if (!isset($project_id)) {
			return FALSE;
		}

		$where = array();
		$where['project_id'] = $project_id;

		return $this -> db -> get_where($this -> tables['projects_apps'], $where) -> row_array();

	}

	function select_project_external_url($project_id = FALSE) {

		if (!isset($project_id)) {
			return FALSE;
		}

		$where = array();
		$where['project_id'] = $project_id;

		return $this -> db -> get_where($this -> tables['projects_xurl'], $where) -> row_array();
	}

	function select_project_screenshots($project_id = FALSE) {

		if (!isset($project_id)) {
			return FALSE;
		}

		$where = array();
		$where['project_id'] = $project_id;

		return $this -> db -> get_where($this -> tables['projects_screenshots'], $where) -> result_array();
	}

	function select_project_tags($project_id = FALSE) {

		if (!isset($project_id)) {
			return FALSE;
		}

		$where = array();
		$where['project_id'] = $project_id;

		$this -> db -> select('*');
		$this -> db -> from($this -> tables['projects_tags'] . ' AS pt');
		$this -> db -> join($this -> tables['projects_tags_xref'] . ' AS ptxf', 'ptxf.tags_type_id = pt.tags_type_id');
		$this -> db -> where($where);

		$mysql_result = $this -> db -> get();
		//$mysql_result = $this -> db -> get_where($this -> tables['projects_tags'], $where);
		if ($mysql_result -> num_rows() > 0) {
			$results = $mysql_result -> result_array();
			foreach ($results as $key => $value) {
				$results[$key]['tags_data'] = json_decode($results[$key]['tags_data'], TRUE);
			}
			return $results;
		} else {
			return NULL;
		}
	}

	function select_project_team_member($project_id = FALSE) {

		if (!isset($project_id)) {
			return FALSE;
		}

		$where = array();
		$where['project_id'] = $project_id;

		return $this -> db -> get_where($this -> tables['projects_team'], $where) -> result_array();

	}

	function select_project_verification($project_id = FALSE) {

		if (!isset($project_id)) {
			return FALSE;
		}

		$where = array();
		$where['project_id'] = $project_id;

		return $this -> db -> get_where($this -> tables['projects_verification'], $where) -> row_array();

	}

	function select_all_projects($fields = FALSE, $options = FALSE) {
		
		if (!isset($fields['limit_start'])) {
			$limit_start =  0;
		}
		
		if (!isset($fields['row_count'])) {
			$row_count =  30;
		}
		
		$this -> db -> select('*');
		$this -> db -> from($this -> tables['projects'] . ' AS pj');
		$this -> db -> join($this -> tables['projects_verification'] . ' AS pvt', 'pvt.project_id = pj.project_id', 'left');
		
		if (isset($fields['user_id'])) {
			$this -> db -> join($this -> tables['projects_team'] . ' AS pt', 'pt.project_id = pj.project_id', 'left');
			$this -> db -> like('user_id', $fields['user_id']);
		}
		$this->db->limit($row_count, $limit_start);
		$mysql_result = $this -> db -> get();

		return $mysql_result -> result_array();
		
	}

	function search_projects($keywords = FALSE) {

		if (!$keywords) {
			return FALSE;
		}

		$this -> db -> select('*');
		$this -> db -> from($this -> tables['projects'] . ' AS pj');
		$this -> db -> like('name', $keywords);
		$this -> db -> or_like('description', $keywords);
		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			return ($query -> result_array());
		} else {
			return FALSE;
		}

	}

	## TESTING PURPOSE

	function insert_projects_test_data() {
		$this -> clear_tables();

		$obj['name'] = 'Lunchsparks';
		$obj['description'] = 'Reinventing Networking for Entrepreneurs and Professionals';
		$obj['cover_img'] = '/skin/images/bg/open-graph.png';
		$obj['video_src'] = '';
		$obj['logo'] = '/skin/images/ls_logo.png';
		$obj['created_by'] = $this -> user_id;
		## Apps
		$obj['ios_app_store_url'] = '';
		$obj['android_market_url'] = '';
		$obj['wp_market_url'] = '';
		## External URLs
		$obj['homepage'] = 'http://lunchsparks.me/';
		$obj['github_url'] = '';
		$obj['facebook_url'] = 'https://www.facebook.com/Lunchsparks';
		$obj['twitter_url'] = 'http://twitter.com/lunchsparks';
		$obj['gplus_url'] = 'https://plus.google.com/111911727012857222672/posts';
		## Screenshots
		$obj['project_id'] = '';
		$obj['src'] = '/skin/images/screenshots/20120303_profile_page.png';
		$obj['is_external'] = '';
		$obj['screenshot_details'] = '';
		## Tags
		/*$arr = array();
		 $arr[] = "Networking";
		 $arr[] = "Professional";
		 $obj['tags_data'] = $arr;
		 $obj['tags_type_id'] = '1';*/
		## Team Members
		$obj['user_id'] = $this -> user_id;
		$obj['date_joined'] = 'NOW()';
		$obj['date_leaved'] = '';
		$obj['date_joined'] = '';
		## Verification
		$obj['project_id'] = '';
		$obj['status'] = '1';
		$obj['remarks'] = 'This website!';
		$obj['updated_by'] = $this -> user_id;

		return $this -> insertProject($obj);

	}

	function clear_tables() {// WARNING: only for testing
		$result = TRUE;
		foreach ($this -> tables as $key => $value) {
			$result = $result && ($this -> db -> truncate($value));
		}
		return $result;
	}

}
?>
