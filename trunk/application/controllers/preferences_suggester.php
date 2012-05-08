<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Preferences_suggester extends CI_Controller {

	function __construct() {
		//default constructor
		parent::__construct();
		$this -> load -> library('ion_auth');
		$this -> load -> library('ls_preferences');
		$this -> load -> model('linkedin/linkedin_model');

		// Check if user is logged in
		if (!$this -> ion_auth -> logged_in()) {
			//redirect them to the login page
			redirect('auth/login?redirect='.uri_string(), 'refresh');
		}
	}
	
	function _split_and_append($temp, &$words) 
	{
		$temp = preg_replace("/[[:punct:]]/", " ", $temp); // remove punctuation
		$array = preg_split("/([[:space:]])+/", $temp); // split by spaces
		foreach($array as $key => $value) { // append to $words
			$words[] = strtolower($value);
		}
	}
		
	function test() {
		$words = array();
		$this -> _split_and_append("Computer Science & Engineering, Computational Geometry, Computer Network 10,001+ employees", $words);
		var_dump($words);
	}
	
	function _iterate_children($xml, &$words) 
	{
		// get list of children nodes
		$children = $xml -> children();
		
		// if there is no children -> append $xml to $words
		if (count($children) == 0) 
		{
			$temp = (string)$xml;
			
			// only record words (no numberic values)
			if (!is_numeric($temp) && $temp != "") {
				$this -> _split_and_append($temp, $words);
			}
			
			return;
		}
		
		// if there are chilren -> iterate them
        foreach ($children as $name => $value) {
            $this -> _iterate_children($value, $words);
        }
    }
    
    function _binary_search($key, $array) 
	{
		$first = 0;
		$last = count($array) - 1;
		if ($last == 0) return FALSE;
		while ($first <= $last) {
			//echo $first . " " . $last . "</br>";
			$mid = (int)(($first + $last) / 2);
			$temp = $array[$mid];
			if ($temp == $key) return TRUE;
			else if ($temp < $key) $first = $mid + 1;
			else $last = $mid - 1;
		}
		return FALSE;
	}
	
	function _find($key, $words) 
	{
		// i.e. $key can contain multiple words e.g. "social media marketing"
		
		$key = preg_replace("/[[:punct:]]/", "", $key); // remove punctuation
		$array = preg_split("/([[:space:]])+/", $key); // split by spaces
		
		foreach($array as $key => $value) {			
			if ($this -> _binary_search($value, $words) != TRUE) {
				return FALSE;
			}
		}
		
		return TRUE;
	}

	/*
	 * call this function to suggest preperences
	 */ 
	function simple() 
	{
		// retrieve linkedin data as xml objects
		$xml = $this -> linkedin_model -> selectLinkedInDataForCurrentUser() -> data;
		//$xml = $this -> linkedin_model -> selectLinkedInData(3) -> data;
		$xml = new SimpleXMLElement($xml);
		
		// here is list of linkedin fields that will being considered
		$fields = array('headline', 'industry', 'specialties', 'associations', 
			'honors', 'interests', 'positions', 'educations');
		
		// establish a list of keywords from $xml->$fields 
		$words = array();
		foreach($fields as $key => $value) {
			if (isset($xml->{$value})) {
				$this -> _iterate_children($xml ->{$value}, $words);
			}
		}
		sort($words);
		
		// retrieve preferences
		$preferences = $this -> ls_preferences -> getAllPreferenceKeywords();
		
		// process
		$result -> looking_for = array("Investors", "Co-founders");
		
		$result -> available_for = array();
		foreach($preferences as $key => $value) {
			if ($this -> _find(strtolower($value['keywords']), $words)) {
				$result -> available_for[] = 
					ucwords(strtolower($value['keywords']));
			}
		}
	
		//var_dump(json_encode($result));
		return $result;
	}	
}
?>
