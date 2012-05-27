<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Name:  Exception
 * Author: @iamneit
 */
class Ls_Exception {
	
	function __construct() {

		//
		// General Exception
		//
		define("tGeneralException", 1000);
		define("cIncorrectExceptionType", 1);
		define("cIncorrectExceptionCode", 2);
	
		//
		// Api Exception
		//
		define("tApiException", 700);
		define("cApiExceptionIncorrectAlias", 1);
		define("cApiExceptionMeNotLoggedIn", 2);
		define("cApiExceptionIncorrectUser", 3);
		define("cApiExceptionIncorrectMethod", 99);
		
		define("cApiExceptionIncorrectEventId", 11);
	}
	
	/*
	 * return an array that represents an exception
	 */
	public static function get_error($type, $code, $message) {
		
		if (constant("t". $type) == NULL) {
			$error['type'] = "GeneralException";
			$error['code'] = constant("cIncorrectExceptionType");
			$error['message'] = "No exception type: $type";
			return $error;
		}
		
		if (constant("c". $type. $code) == NULL) {
			$error['type'] = "GeneralException";
			$error['code'] = "cIncorrectExceptionCode";
			$error['message'] = "No exception code: $code";
			return $error;
		}
		
		$error['type'] = $type;
		$error['code'] = constant("t". $type) + constant("c". $type. $code);
		$error['message'] = $code. ": ". $message;  
		return $error;
	}
}
?>