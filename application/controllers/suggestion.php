<?php
if (!defined('BASEPATH'))
        exit('No direct script access allowed');

class Suggestion extends CI_Controller {

        function __construct() {
                parent::__construct();
               
                $this -> load -> library('ion_auth');
                $this -> load -> library('session');
                $this -> load -> library('input');
                $this -> load -> model('suggestion_model');

                // Set Global Variables
                $this -> data['is_logged_in'] = $this -> ion_auth -> logged_in();              
        }

        function index() {
                // Check if user is logged in
                if (!$this -> ion_auth -> logged_in()) {
                        //redirect them to the login page
                        redirect('auth/login', 'refresh');
                } else {
                        $this -> data['main_content'] = 'suggestion/index';      
                        $this -> load -> view('includes/tmpl_layout', $this -> data);            
                }
        }
 
  function testselect() {
    echo "selectNonExpiredSuggestionsForCurrentUser:<br/>";
                $result = $this -> suggestion_model -> selectNonExpiredSuggestionsForCurrentUser();
                print_r(json_encode($result -> result()));
   
    echo "<br/><br/>";
    echo "selectAllSuggestions:<br/>";
   
    $userid = $this -> session -> userdata('user_id');
    $result = $this -> suggestion_model -> selectAllSuggestions($userid);
    print_r(json_encode($result -> result()));
        }      

        function testinsert() {
    $userid = $this -> session -> userdata('user_id');
    $res = $this -> suggestion_model -> insertSuggestion($userid, rand(1, 5), "A good guy.");
    print_r($res);
        }

  function testexpiry() {
    $userid = $this -> session -> userdata('user_id');
    print_r($this -> suggestion_model -> expiryAllSuggestions($userid));
  }
 
  function testrespond() {
    $array = array("3" => "ACCEPTED", "4" => "REJECTED", "1" => "REJECTED");
    print_r($this -> suggestion_model -> respondSuggestionsForCurrentUser($array));
  }
 
  function testdelete() {
    $userid = $this -> session -> userdata('user_id');
    print_r($this -> suggestion_model -> deleteSuggestion($userid, 3));
  }
}
?>

