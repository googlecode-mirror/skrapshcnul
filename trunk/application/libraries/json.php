<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Name:  JSON
 * Author: @stiucsib86
 * Created:  11.09.2011
 * Description:
 * Requirements: PHP5 or above
 */
class Json {

	function __construct() {

		$this -> ci = &get_instance();
		$this -> ci -> load -> database();
		$this -> ci -> load -> config('users', TRUE);
		$this -> ci -> load -> library('ion_auth');
		$this -> ci -> load -> library('session');
		$this -> ci -> load -> library('form_validation');
		$this -> ci -> load -> library('input');
		$this -> ci -> load -> helper('image/image_resize');
		$this -> ci -> load -> helper('logger');

		// Request Params: alt = json |
		$this -> alt = (isset($_REQUEST['alt'])) ? $_REQUEST['alt'] : FALSE;
		$this -> call = (isset($_REQUEST['call'])) ? $_REQUEST['call'] : FALSE;
		$this -> callback = (isset($_REQUEST['callback'])) ? $_REQUEST['callback'] : FALSE;
		$this -> token = (isset($_REQUEST['token'])) ? $_REQUEST['token'] : FALSE;

		// Statistics
		$this -> start_time = time();

	}

	private function _initialize() {

		if (!$this -> _is_autheticated()) {
			$error['domain'] = "global";
			$error['reason'] = "invalidAuthorization";
			$error['message'] = "Invalid Authorization Data. Please Login to continue.";
			$error['locationType'] = "Authorization";
			$error['location'] = "Authorization";
			$data['errors'] = $error;
			$this -> json_prep($data);
			die();
		}

	}

	function is_autheticated() {

		// Token Access
		if ($this -> token) {
			## TODO do token autentication
			return TRUE;
		}

		// Session Access
		if ($this -> ci -> ion_auth -> logged_in()) {
			$this -> user_id = $this -> ci -> session -> userdata('user_id');

		}
	}

	private function _indent($json) {

		$result = '';
		$pos = 0;
		$strLen = strlen($json);
		$indentStr = '  ';
		$newLine = "\n";
		$prevChar = '';
		$outOfQuotes = true;

		for ($i = 0; $i <= $strLen; $i++) {

			// Grab the next character in the string.
			$char = substr($json, $i, 1);

			// Are we inside a quoted string?
			if ($char == '"' && $prevChar != '\\') {
				$outOfQuotes = !$outOfQuotes;

				// If this character is the end of an element,
				// output a new line and indent the next line.
			} else if (($char == '}' || $char == ']') && $outOfQuotes) {
				$result .= $newLine;
				$pos--;
				for ($j = 0; $j < $pos; $j++) {
					$result .= $indentStr;
				}
			}

			// Add the character to the result string.
			$result .= $char;

			// If the last character was the beginning of an element,
			// output a new line and indent the next line.
			if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
				$result .= $newLine;
				if ($char == '{' || $char == '[') {
					$pos++;
				}

				for ($j = 0; $j < $pos; $j++) {
					$result .= $indentStr;
				}
			}

			$prevChar = $char;
		}

		return $result;
	}

	function json_prep($data, $extras = FALSE) {

		//header('Cache-Control: no-cache, must-revalidate');
		//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		switch($this -> alt) {
			case 'json' :
				header('Content-type: application/json');
				break;
			default :
				header('Content-type: application/json');
				break;
		}

		if (!empty($data['errors'])) {
			// Contains error
			if ($this -> callback) {
				print_r($this -> callback . '(' . json_encode($data['errors']) . ')');
			} else {
				print_r($this -> _indent(json_encode($data['errors'])));
			}
		} else {
			$this -> json_result['completed_in'] = number_format(time() - $this -> start_time, 3, '.', '');
			if (empty($data['results'])) {
				$this -> json_result['results'] = FALSE;
				$this -> json_result['reason'] = "No results";
			} else {
				$this -> json_result['results'] = $data['results'];
			}

			if ($this -> callback) {
				print_r($this -> callback . '(' . json_encode($this -> json_result) . ')');
			} else {
				print_r($this -> _indent(json_encode($this -> json_result)));
			}
		}
	}

}
?>