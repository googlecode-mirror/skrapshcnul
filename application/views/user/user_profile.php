<?php
  
/**
 * display user_profile
 */

if ($this->session->userdata('linkedin_pulled') == NULL) {
  $this->session->set_userdata('linkedin_pulled', 
          $this->linkedin_model->selectLinkedInDataForCurrentUser() != NULL);
}

//Logger::log($this->session->userdata);

if ($this->session->userdata('linkedin_pulled') == FALSE) {
  // if user's data has not been pulled before -> suggest user to sync profile 
  // with Linkedin 
  ?>
  We have no information about you yet! Click to sync your profile with LinkedIn.
  <form id="linkedin_sync_form" action="pullLinkedInData" method="get">
    <input type="hidden" name="<?php echo LINKEDIN::_GET_TYPE;?>" id="<?php echo LINKEDIN::_GET_TYPE;?>" value="initiate" />
    <input type="submit" value="Sync" />
  </form>
  <?php
}
else {
  //query linkedin data from database
  $info = $this->linkedin_model->selectLinkedInDataForCurrentUser();  
  if ($info != NULL) {
    // if user's data already there -> firstly, request to update data
    ?>
    Last profile update: <?php echo($info->timestamp) ?>     
    <form id="linkedin_sync_form" action="pullLinkedInData" method="get">
      Just updated your LinkedIn's profile? Click to sync the changes with LunchSparks <input type="hidden" name="<?php echo LINKEDIN::_GET_TYPE;?>" id="<?php echo LINKEDIN::_GET_TYPE;?>" value="initiate" />
      <input type="submit" value="Sync" />
    </form> 
    <hr>    
    <?php  
    
    //secondly, display user's profile    
    $p = new SimpleXMLElement($info->data);
    ?>
        
    <h2> <?php echo($p->{'first-name'}) ?> <?php echo($p->{'last-name'}) ?> </h2>
    <?php echo($p->{'headline'}) ?>
    
            
    <dl>
    <?php foreach($p as $key => $value) { ?>
      <dt> <?php echo($key) ?> </dt>
      <dd> <?php echo($value) ?> </dd>      
    <?php
    }
    ?>
    </dl>;
    <?php
  }
  else {
    die('Server error! Please try again later.');
  }
}
?>
