<?php
require_once(APPPATH . '/controllers/test/Toast.php');

class Recs_model_tests extends Toast
{  
    function __construct() {
        parent::__construct(__FILE__);    
        $this -> load -> model("recs_model");
    }

    /**
     * Clear table before each individual test	 
     */
    function _pre() {
        $this -> _assert_equals($this -> recs_model -> clearTables(), TRUE);
    }

    /**
     * Clear the table after each individual test	 
     */
    function _post() {
        $this -> _assert_equals($this -> recs_model -> clearTables(), TRUE);        
    }
    
    /* TESTS BELOW */
    function _dumpRecs($table, $n) {
        if ($table == "AUT") {         
            for ($i = 1; $i < $n; ++$i) {
                for ($j = 1; $j <= $i; ++$j) {
                    $this -> _assert_equals(
                        $this -> recs_model -> insertAutoRecs($table, $i, $j, 
                            "You should meet this guy."), 
                        TRUE );
                }       
            }
        }
        else {
            for ($i = 1; $i < $n; ++$i) {
                $this -> _assert_equals(
                    $this -> recs_model -> insertRecs($table, $i), 
                    TRUE );
            }
        }
    }    
    
    function test_selectRecsByUserId_and_ByIndex_AUT() {
        $n = 10;
        $this -> _dumpRecs("AUT", $n);
        
        $index = 0;
        for ($i = 1; $i < $n; ++$i) {
            $result = $this -> recs_model -> selectRecsByUserId("AUT", $i);
            $result = $result -> result();
            $this -> _assert_equals(count($result), $i);
            $cnt = 0;
            foreach ($result as $r) {                
                $this -> _assert_equals($r -> index, ++$index);                
                $this -> _assert_equals($r -> rec_id, ++$cnt);
                $this -> _assert_equals($r -> user_id, $i);
                $this -> _assert_equals($r -> rec_reason, "You should meet this guy.");
                
                // get the same record using selectRecsByIndex
                $s = $this -> recs_model -> selectRecsByIndex("AUT", $index);
                $s = $s -> result();
                $this -> _assert_equals(count($s), 1);
                $this -> _assert_equals($r -> index, $s[0] -> index);
                $this -> _assert_equals($r -> user_id, $s[0] -> user_id);
                $this -> _assert_equals($r -> rec_id, $s[0] -> rec_id);                
                $this -> _assert_equals($r -> rec_reason, $s[0] -> rec_reason);
                $this -> _assert_equals($r -> timestamp, $s[0] -> timestamp);
            }
        }
    }

    function test_selectRecsByUserId_and_ByIndex_SEL_NEG_ACC_SUC() {
        for ($k = 0; $k < 4; ++$k) {
            switch ($k) {
                case 0: $table = "SEL"; break;
                case 1: $table = "NEG"; break;
                case 2: $table = "ACC"; break;
                case 3: $table = "SUC"; break; 
            }
            
            $n = 10;
            $this -> _dumpRecs($table, $n);
            
            $index = 0;
            for ($i = 1; $i < $n; ++$i) {
                $result = $this -> recs_model -> selectRecsByIndex($table, $i);            
                $result = $result -> result();
                $this -> _assert_equals(count($result), 1);
                $this -> _assert_equals($result[0] -> index, $i);
            }
        }
    }

    function test_removeRecsByUserId_AUT() {
        $n = 10;
        $this -> _dumpRecs("AUT", $n);
        
        for ($i = 1; $i < $n; ++$i) {
            $result = $this -> recs_model -> removeRecsByUserId("AUT", $i);
            $this -> _assert_equals($result, TRUE);
            
            $result = $this -> recs_model -> selectRecsByUserId("AUT", $i);            
            $this -> _assert_equals($result -> result(), NULL);
            
            if ($i < $n - 1) {
                $result = $this -> recs_model -> selectRecsByUserId("AUT", $i + 1);
                $this -> _assert_not_equals($result -> result(), NULL);
            }
        }
    }
    
    function test_removeRecsByIndex_AUT() {
        $n = 10;
        $this -> _dumpRecs("AUT", $n);
        
        for ($i = 1; $i <= $n * ($n - 1) / 2; ++$i) {            
            $result = $this -> recs_model -> removeRecsByIndex("AUT", $i);
            $this -> _assert_equals($result, TRUE);
            
            $result = $this -> recs_model -> selectRecsByIndex("AUT", $i);            
            $this -> _assert_equals($result -> result(), NULL);
            
            if ($i < $n * ($n - 1) / 2) {
                $result = $this -> recs_model -> selectRecsByIndex("AUT", $i + 1);
                $this -> _assert_not_equals($result -> result(), NULL);
            }
        }
    }
    
    function test_removeRecsByIndex_SEL_NEG_ACC_SUC() {
        for ($k = 0; $k < 4; ++$k) {
            switch ($k) {
                case 0: $table = "SEL"; break;
                case 1: $table = "NEG"; break;
                case 2: $table = "ACC"; break;
                case 3: $table = "SUC"; break; 
            }
            
            $n = 10;
            $this -> _dumpRecs($table, $n);
        
            for ($i = 1; $i < $n; ++$i) {            
                $result = $this -> recs_model -> removeRecsByIndex($table, $i);
                $this -> _assert_equals($result, TRUE);
                
                $result = $this -> recs_model -> selectRecsByIndex($table, $i);            
                $this -> _assert_equals($result -> result(), NULL);
                
                if ($i < $n - 1) {
                    $result = $this -> recs_model -> selectRecsByIndex($table, $i + 1);
                    $this -> _assert_not_equals($result -> result(), NULL);
                }
            }
        }
    }
    
}
