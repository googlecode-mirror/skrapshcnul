<?php

/*
 * Model to store user's linkedin data into database
 */

class Linkedin_Model extends CI_Model {    
  
  /*
   * insert linkedin data into database (xml format)
   */
  function _insertLinkedInData($userid, $data) {    
    $data = addslashes($data);    
    $query = "INSERT INTO lss_linkedin_data (id, data) " . 
             "VALUES ('$userid','$data')" . 
             "ON DUPLICATE KEY UPDATE data = '$data', timestamp = NOW();";
    $success = $this->db->query($query);   
    return $success;    
  }   
  
  function insertLinkedInDataForCurrentUser($data) {
    $userid = $this->session->userdata('user_id');    
    return $this->_insertLinkedInData($userid, $data);
  }
  
  /*
   * select linkedin data from database (xml format)
   */
  function _selectLinkedInData($userid) {        
    $query = "SELECT data, timestamp FROM lss_linkedin_data WHERE id = '$userid';";
    $result = $this->db->query($query);    
    $data = $result->row();
    return $data;
  }
  
  function selectLinkedInDataForCurrentUser() {
    $userid = $this->session->userdata('user_id');
    return $this->_selectLinkedinData($userid);
  }
}

?>
