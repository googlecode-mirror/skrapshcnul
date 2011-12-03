<?php

/*
 * Messages is the main system for user communications
 */
class Messages_Model extends CI_Model {

  const _TABLE_ = "lss_users_messages";
      
  function clear() { // clear all data in lss_messages table
    $query = "TRUNCATE TABLE " . self::_TABLE_ . ";";
    return $this -> db -> query($query);
  }
     
  function insert($ft, $fi, $tt, $ti, $mt, $mc, $previous, $next) {
    $pre_string = ($previous == NULL) ? "NULL" : "'$previous'";
    $next_string = ($next == NULL) ? "NULL" : "'$next'";    
    $query = 
      "INSERT INTO " . self::_TABLE_ .  
      " (from_type, from_id, to_type, to_id, " . 
      "  message_type, message_content, previous, next) " .
      " VALUES ('$ft', '$fi', '$tt', '$ti', " . 
      "  '$mt', '$mc', $pre_string, $next_string);";
    return $this -> db -> query($query);
  }
	
  function editContent($ft, $fi, $tt, $ti, $mt, $mc, $previous, $next, $timestamp) {
    $query = 
      "UPDATE " . self::_TABLE_ .
      " SET message_content = '$mc' " . 
      " WHERE from_type = '$ft' AND from_id = '$fi' AND " . 
      "  to_type = '$tt' AND to_id = '$ti' AND message_type = '$mt'";
    return $this -> db -> query($query);
  }
  
  function select($index) {
    $query = 
      "SELECT * FROM " . self::_TABLE_ . " WHERE `index` = '$index';";
    return $this -> db -> query($query);
  }
}
?>
