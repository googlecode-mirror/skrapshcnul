<?
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/  

  $con = array(
    'appId' => $this -> config -> item('facebook_app_id'),
    'secret' => $this -> config -> item('facebook_app_secret')
  );

  $facebook = new Facebook($con);
  $user_id = $facebook->getUser();
?>

<html>
  <head></head>
  <body>    

  <?
    if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {

        $user_profile = $facebook->api('/me','GET');
        echo "Name: " . $user_profile['name'];

        $user_friends = $facebook->api('/me/friends','GET');        
        $user_friends = $user_friends['data'];

        $t = 0;
        echo "<hr>";        
        foreach ($user_friends as $one) {
          echo "<img src='https://graph.facebook.com/" . $one['id'] . "/picture'></img>";
          if (++$t % 19 == 0) echo "<br>";
        }
        echo "<hr>";

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl(); 
        echo '<br>Please <a href="' . $login_url . '">login.</a><br><br>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {

      // No user, print a link for the user to login
      $login_url = $facebook->getLoginUrl();
      echo '<br>Please <a href="' . $login_url . '">login.</a><br><br>';

    }

  ?>

  </body>
</html>
