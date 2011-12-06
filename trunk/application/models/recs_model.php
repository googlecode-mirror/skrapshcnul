<?php

/*
 * Recommendation system - the most important system of lunchsparks
 * What does this system do?
 * 1. Allow algorithm system to automatically recommends users to meet.
 * 2. Allow users to choose who to meet among their recommendations.
 * 3. Allow algorithm system to match users based on their choices.
 * 4. Allow users to accept/refuse a match.
 * 5. When both users accept, create a lunch for both parties.
 * Note in terminology: "a match" = "a negotiated recommendation".  
 */
class Recs_Model extends CI_Model {
    const _AUTO_RECS_TABLE_ = "lss_0_auto_recs";
    const _SELECTED_RECS_TABLE_ = "lss_0_selected_recs";
    const _NEGOTIATED_RECS_TABLE_ = "lss_0_negotiated_recs";
    const _ACCEPTED_RECS_TABLE_ = "lss_0_accepted_recs";
    const _SUCCESSFUL_RECS_TABLE_ = "lss_0_successful_recs";
	
    function clearTables() {		
        $this -> db -> trans_start(); // it is important to start a transaction
                                      // as this function changes > 1 tables 
        
        $q1 = "TRUNCATE TABLE " . self::_AUTO_RECS_TABLE_ . ";";
        $q2 = "TRUNCATE TABLE " . self::_SELECTED_RECS_TABLE_ . ";";
        $q3 = "TRUNCATE TABLE " . self::_NEGOTIATED_RECS_TABLE_ .";";
        $q4 = "TRUNCATE TABLE " . self::_ACCEPTED_RECS_TABLE_ . ";";
        $q5 = "TRUNCATE TABLE " . self::_SUCCESSFUL_RECS_TABLE_ . ";";        
        
        $result = $this -> db -> query($q1);
        $result = $result && $this -> db -> query($q2);
        $result = $result && $this -> db -> query($q3);
        $result = $result && $this -> db -> query($q4);
        $result = $result && $this -> db -> query($q5);
        
        $this -> db -> trans_complete();
        
        return $result;
    }
    
    /*
     * Helper 
     */
    function _which($code) {
        $code = strtoupper($code);
        if ($code === "AUT") return self::_AUTO_RECS_TABLE_;
        else if ($code === "SEL") return self::_SELECTED_RECS_TABLE_;
        else if ($code === "NEG") return self::_NEGOTIATED_RECS_TABLE_;
        else if ($code === "ACC") return self::_ACCEPTED_RECS_TABLE_;
        else if ($code === "SUC") return self::_SUCCESSFUL_RECS_TABLE_;
        else return NULL;
    }
    
    /*
     * Operations implementation:
     * 
     * Note: _AUTO_RECS_TABLE_ has different scheme in compared to other 
     * tables. It has different insertion and two addition queries: 
     * selectByUserId, and removeByUserId.
     */    
    function insertAutoRecs($table, $user_id, $rec_id, $rec_reason) {        
        if ($rec_reason == NULL) 
            $rec_reason = 'NULL';
        
        $query = "INSERT INTO " . self::_AUTO_RECS_TABLE_ . 
                 " (user_id, rec_id, rec_reason, valid) VALUES" . 
                 " ('$user_id', '$rec_id', '$rec_reason', '1');";
         
        return $this -> db -> query($query);
    }
    
    function insertRecs($table, $index) {
        $query = "INSERT INTO " . ($this -> _which($table)) .
                 " (`index`, valid) VALUES ('$index', '1');";       
        return $this -> db -> query($query);
    }
    
    // only applicable for _AUTO_RECS_TABLE_; 
    // other tables do not contain user_id
    function selectRecsByUserId($table, $user_id) {
        $query = "SELECT * FROM " . ($this -> _which($table)) .
                 " WHERE user_id = '$user_id' AND valid = '1';";
        return $this -> db -> query($query);
    }
    
    function selectRecsByIndex($table, $index) {
        $query = "SELECT * FROM " . ($this -> _which($table)) .
                 " WHERE `index` = '$index' AND valid = '1';";
        return $this -> db -> query($query);
    }
    
    // only applicable for _AUTO_RECS_TABLE_; 
    // other tables do not contain user_id
    function removeRecsByUserId($table, $user_id) {                
        $query = "UPDATE " . ($this -> _which($table)) .
                 " SET valid = '0'" .
                 " WHERE user_id = '$user_id' AND valid = '1';";
        return $this -> db -> query($query);
    }
    
    function removeRecsByIndex($table, $index) {
        $query = "UPDATE " . ($this -> _which($table)) .
                 " SET valid = '0'" .
                 " WHERE `index` = '$index' AND valid = '1';";
        return $this -> db -> query($query);                 
    }
}
?>
