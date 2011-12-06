<?php

class User_States_Model extends CI_Model {
    const _STATE_TABLE_ = "lss_users_states";
        
    function clear() {
        $query = "TRUNCATE TABLE " . self::_STATE_TABLE_;        
        return $this -> db -> query($query);
    }
    
    /*
     * Operations implementation:    
     */    
    function setState($user_id, $state) {
        if ($state === "A" || $state === "B" || $state === "C" || 
            $state === "D" || $state === "E" || $state === "F" ||
            $state === "G" || $state === "H" || $state === "I") {
                
            $this -> db -> trans_start();
            
            $query = "UPDATE " . self::_STATE_TABLE_ .
                     " SET valid = '0'" . 
                     " WHERE user_id = '$user_id' AND valid = '1';";
            $this -> db -> query($query); // no matter this passes or fails, just go on
            
            $query = "INSERT INTO " . self::_STATE_TABLE_ . 
                     " (user_id, state, valid) VALUES" . 
                     " ('$user_id', '$state', '1');";
            $result = $this -> db -> query($query);
            
            $this -> db -> trans_complete();
            
            return $result;
        }
        else return FALSE;
    }
        
    function selectStateByUserId($user_id) {
        $query = "SELECT * FROM " . self::_STATE_TABLE_ .
                 " WHERE user_id = '$user_id' AND valid = '1';";
        return $this -> db -> query($query);
    }
}
?>
