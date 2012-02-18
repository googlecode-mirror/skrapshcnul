<?php

/*
 * Model to store user's linkedin data into database
 */

class Linkedin_Model extends CI_Model {    
  
  function clearTables() {
  	$this -> db -> truncate("lss_linkedin_data");
  }
  
  /*
   * insert linkedin data into database (xml format)
   */
  function insertLinkedInData($userid, $data) {    
    $data = addslashes($data);    
    $query = "INSERT INTO lss_linkedin_data (id, data) " . 
             "VALUES ('$userid','$data')" . 
             "ON DUPLICATE KEY UPDATE data = '$data', timestamp = NOW();";
    $success = $this->db->query($query);   
    return $success;
  }   
  
  function insertLinkedInDataForCurrentUser($data) {
    $userid = $this->session->userdata('user_id');    
    return $this->insertLinkedInData($userid, $data);
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
  
  function selectLinkedInData($userid) {
  	return $this->_selectLinkedinData($userid);
  }
  
  function doneSynchronized($user_id) {
  	$this -> db -> set('timestamp');
  	$this -> db -> where('id', $user_id);
  	$result = $this -> db -> get('lss_linkedin_data');
  	$result = $result -> result();
	if (empty($result)) return FALSE;
	else return TRUE; 
  }
}

?>
