<?php

/**
 * Event Model
 */
class Users_Statistics_model extends CI_Model {

	public $tables = array();
	

	public function __construct() {
		$this -> load -> config('tables/statistics', TRUE);
		$this -> load -> helper('logger');

		## Initialize DB
		$this -> tables = $this -> config -> item('tables', 'tables/statistics');

	}
	
	function getTotalUsers($fields = FALSE) {
		
		//$this -> _init_total_users_table();
		$this -> _update_total_users_table();
		
		$query = " SELECT * FROM " . $this -> tables['statistics_total_users'];
		$query .= "";
		
		$mysql_result = $this -> db -> query($query);
		
		if (empty($mysql_result)) return NULL;
		$results = $mysql_result -> result_array(); 
		
		return $results;
		
	}
	
	private function _update_total_users_table() {
		
		// Populate time range
		$end = time();
		$start = $month = strtotime("-12 month", $end);
		$total_users = 0;
		while($month < $end) {
			
			$value_year_month = date('Y-m-01', $month);
			$value_year_month_end = date('Y-m-01', strtotime("+1 month", $month));
			$month = strtotime("+1 month", $month);
			
			$query = " SELECT COUNT(*) AS count ";
			$query .= " FROM lss_users ";
			$query .= " WHERE FROM_UNIXTIME(`created_on`) < '$value_year_month_end'";
			$mysql_result = $this -> db -> query($query);
			$results = $mysql_result -> row_array();
			
			$query = " INSERT INTO " . $this -> tables['statistics_total_users'];
			$query .= " ( `year_month`, `total_users`, `created_on` )";
			$query .= " VALUES ( '$value_year_month', " . $results['count'] . ", NOW() )";
			$query .= " ON DUPLICATE KEY UPDATE `total_users` = " . $results['count'];
			
			$mysql_result = $this -> db -> query($query);
			
		}
		
		## Old Queries 
		/*$query = " SELECT COUNT(*) AS count, YEAR(FROM_UNIXTIME(`created_on`)) AS year, MONTH(FROM_UNIXTIME(`created_on`)) AS month ";
		$query .= " FROM lss_users ";
		$query .= " WHERE FROM_UNIXTIME(`created_on`) > DATE_SUB(NOW(), INTERVAL 12 MONTH)";
		$query .= " GROUP BY YEAR(FROM_UNIXTIME(`created_on`)), MONTH(FROM_UNIXTIME(`created_on`)) ";
		$query .= " ORDER by `created_on` ASC";
		$mysql_result = $this -> db -> query($query);
		
		if (empty($mysql_result)) return NULL;
		$results = $mysql_result -> result_array();*/
		
		/*$total_users = 0;
		foreach ($results as $year_month) {
			$total_users += $year_month['count'];
			
			//$value_year_month = date( 'Y-m-d H:i:s', $year_month['year'] . '-' . $year_month['month'] . '-00 00:00:00');
			$value_year_month = $year_month['year'] . '-' . $year_month['month'] . '-01';
			
			$query = " INSERT INTO " . $this -> tables['statistics_total_users'];
			$query .= " ( `year_month`, `total_users`, `created_on` )";
			//$query .= " VALUES ( DATE_FORMAT('" . $value_year_month . "', '%X %V') , '$total_users', NOW() )";
			$query .= " VALUES ( '$value_year_month' , '$total_users', NOW() )";
			$query .= " ON DUPLICATE KEY UPDATE ";
			//$query .= " `year_month` = DATE_FORMAT('" . $value_year_month . "', '%X %V'), `total_users` = '$total_users'";
			$query .= " `total_users` = '$total_users'";
			
			$mysql_result = $this -> db -> query($query);
		}*/
		
	}
}
