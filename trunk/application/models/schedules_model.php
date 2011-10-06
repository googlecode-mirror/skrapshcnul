<?php

class Schedules_Model extends CI_Model {    
 
  function _insertPick($userid, $date, $time, $center_lat, $center_lng, $radius) {
    $datetime = $date . " " . $time;
    $query = "INSERT INTO lss_schedules (user_id, datetime, center_lat, center_lng, radius) " . 
             "VALUES ('$userid', STR_TO_DATE('$datetime','%m/%d/%Y %h:%i %p'), " .
             "'$center_lat', '$center_lng', '$radius')";
    $success = $this->db->query($query);
    return $success;
  }   
  
  function insertPickForCurrentUser($date, $time, $center_lat, $center_lng, $radius) {
    $userid = $this->session->userdata('user_id');
    return $this->_insertPick($userid, $date, $time, $center_lat, $center_lng, $radius);
  }
  
  function _selectPick($userid) {
    $query = "SELECT " .
             "  user_id, `index`, " . 
             "  DATE(datetime) as date, TIME(datetime) as time, " . 
             "  center_lat, center_lng, radius " . 
             "FROM lss_schedules " . 
             "WHERE user_id = '$userid';";
    $result = $this->db->query($query);    
    return $result;
  }
  
  function selectPickForCurrentUser() {
    $userid = $this->session->userdata('user_id');
    return $this->_selectPick($userid);
  }
  
  function _deletePick($userid, $index) {
    $query = "DELETE FROM lss_schedules " . 
             "WHERE user_id = '$userid' AND `index` = '$index';";
    $result = $this->db->query($query);    
    return $result;
  }
  
  function deletePickForCurrentUser($index) {
    $userid = $this->session->userdata('user_id');
    return $this->_deletePick($userid, $index);
  }
}

?>
