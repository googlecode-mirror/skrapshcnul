<?php
require_once(APPPATH . '/controllers/test/Toast.php');

class Ls_guides_tests extends Toast
{  
    function __construct() {
        parent::__construct(__FILE__);    
        $this -> load -> library('ls_guides');		
    }

    /**
     * Clear table before each individual test   
     */
    function _pre() {
    	$this -> linkedin_model -> clearTables();
    }

    /**
     * Do nothing after each individual test    
     */
    function _post() {
    }
    
    /* TESTS BELOW */
    function test_one() {
    	$this -> _assert_true($this -> linkedin_model -> 
    		insertLinkedInData(1, "<data>Hallo</data>"));
    	$result = $this -> ls_guides -> getWelcomeGuide_States(1);
		var_dump($result);
    }
}
