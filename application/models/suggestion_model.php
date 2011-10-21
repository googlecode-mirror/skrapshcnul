<?php

/*
 * Please see models/sql_scripts/tien_llunch.sql for lss_suggestion schema
 */

class Suggestion_Model extends CI_Model {
 
  function _selectNonExpiredSuggestions($userid) {
    $query =
      "SELECT * " .
      "  FROM lss_suggestion " .
      "  WHERE userid = '$userid' AND expired = '0';";
    $result = $this -> db -> query($query);
    return $result;
  }
 
  function selectNonExpiredSuggestionsForCurrentUser() {
    $userid = $this -> session -> userdata('user_id');
    return self::_selectNonExpiredSuggestions($userid);
  }
 
  function _respondSuggestions($userid, $responds) {
   
    // extract from $responds list of accepted and rejected suggestions    
    $accept = "";
    $reject = "";
    $got_accept = false;
    $got_reject = false;
    foreach ($responds as $id => $respond) {
      if ($respond == "ACCEPTED") {
        if ($got_accept) $accept = $accept . " OR ";
        $accept = $accept . " suggested_userid = '$id' ";
        $got_accept = true;
      }
      else {
        if ($got_reject) $reject = $reject . " OR ";
        $reject = $reject . " suggested_userid = '$id' ";
        $got_reject = true;
      }
    }
   
    // update suggestions
    $success1 = false;
    $success2 = false;
   
    $this -> db -> trans_start(); // start transaction is important to keep data consistent
   
    if ($accept != "") {
      $query =
        "UPDATE lss_suggestion " .
        "  SET respond = 'ACCEPTED' " .
        "  WHERE expired = '0' AND userid = '$userid' " .
        "  AND " . $accept . ";";
      $success1 = $this -> db -> query($query);
    }
    else {
      $success1 = true;
    }
   
    if ($reject != "") {
      $query =
        "UPDATE lss_suggestion " .
        "  SET respond = 'REJECTED' " .
        "  WHERE expired = '0' AND userid = '$userid' " .
        " AND " . $reject . ";";
      $success2 = $this -> db -> query($query);
    }
    else {
      $success2 = true;
    }
   
    $this -> db -> trans_complete();
   
    return $success1 && $success2;
  }
 
  function respondSuggestionsForCurrentUser($responds) {
    $userid = $this -> session -> userdata('user_id');
    return self::_respondSuggestions($userid, $responds);
  }
 
  /*
   * Methods below are for admin only;
   */
  function insertSuggestion($userid, $suggested_userid, $reason) {
    $query =
      "INSERT INTO lss_suggestion (userid, suggested_userid, reason, respond, expired)" .
      "  VALUES ('$userid', '$suggested_userid', '$reason', 'WAITING', '0')";
    $success = $this -> db -> query($query);
    return $success;
  }
 
  function deleteSuggestion($userid, $suggested_userid) {
    $query =
      "DELETE FROM lss_suggestion " .
      "  WHERE expired = '0' " .
      "  AND userid = '$userid' " .
      "  AND suggested_userid = '$suggested_userid';";
    $success = $this -> db -> query($query);
                return $success;
  }
 
  function selectAllSuggestions($userid) {
    $query =
      "SELECT * " .
      "  FROM lss_suggestion " .
      "  WHERE userid = '$userid';";
    $result = $this -> db -> query($query);
    return $result;
  }    
 
  function expiryAllSuggestions($userid) {
    // after user attends a meeting -> expiry all suggestions
    $query =
      "UPDATE lss_suggestion " .
      "  SET expired = '1' " .
      "  WHERE userid = '$userid' AND expired = '0';";
    $result = $this -> db -> query($query);
    return $result;
  }
}
?>

