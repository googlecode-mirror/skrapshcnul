<?php
require_once(APPPATH . '/controllers/test/Toast.php');

class User_states_model_tests extends Toast
{  
    function __construct() {
        parent::__construct(__FILE__);    
        $this -> load -> model("user_states_model");
    }

    /**
     * Clear table before each individual test   
     */
    function _pre() {
        $this -> _assert_equals($this -> user_states_model -> clear(), TRUE);
    }

    /**
     * Clear the table after each individual test    
     */
    function _post() {
        $this -> _assert_equals($this -> user_states_model -> clear(), TRUE);        
    }
    
    /* TESTS BELOW */
    function test_user_states_one() {
        $n = 10;
                
        for ($i = 1; $i <= $n; ++$i) {
            for ($j = 0; $j < $i; ++$j) {
                switch ($j % 9) {
                    case 0: $state = "A"; break;
                    case 1: $state = "B"; break;
                    case 2: $state = "C"; break;
                    case 3: $state = "D"; break;
                    case 4: $state = "E"; break;
                    case 5: $state = "F"; break;
                    case 6: $state = "G"; break;
                    case 7: $state = "H"; break;
                    case 8: $state = "I"; break;
                }
                
                // set new state
                $this -> _assert_equals($this -> user_states_model -> setState($i, $state), TRUE);
                
                // wait for some time
                usleep(20000);
                
                // get the state and check consistency
                $result = $this -> user_states_model -> selectStateByUserId($i);
                $this -> _assert_equals($result -> num_rows(), 1);
                $result = $result -> result();
                $this -> _assert_equals($result[0] -> state, $state);
            }
        }        
    }

    /* TESTS BELOW */
    function test_user_states_two() {
        $this -> _assert_equals($this -> user_states_model -> setState(1, "J"), FALSE);
        $this -> _assert_equals($this -> user_states_model -> setState(2, "0"), FALSE);
        $this -> _assert_equals($this -> user_states_model -> setState(3, "#"), FALSE);
        $this -> _assert_equals($this -> user_states_model -> setState(1000, "Hi"), FALSE);
    }
}
