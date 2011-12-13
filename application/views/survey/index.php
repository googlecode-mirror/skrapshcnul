<br>
<form>
	1. Rating restaurant: <span id="stars-cap"></span>
	<div id="stars-wrapper2" class="abc">
		<select name="selrate">
			<option value="1">Very poor</option>
			<option value="2">Not that bad</option>
			<option value="3">Average</option>
			<option value="4" selected="selected">Good</option>
			<option value="5">Perfect</option>
		</select>
	</div>
	<br>
	<br>
	2. Rating lunch buddy: <span id="stars-cap"></span>
	<div id="stars-wrapper3" class="abc">
		<select name="selrate">
			<option value="1">Very poor</option>
			<option value="2">Not that bad</option>
			<option value="3">Average</option>
			<option value="4" selected="selected">Good</option>
			<option value="5">Perfect</option>
		</select>
	</div>
	<br>
	<br>
	3. You know friends who should meet this lunch buddy?
	<br>
	 
  <div id="fb-root"></div>
  <script src="http://connect.facebook.net/en_US/all.js"></script>
  <p>
    <input type="button"
      onclick="sendRequestToRecipients(); return false;"
      value="Send Request to Users Directly"
    />
    <input type="text" value="User ID" name="user_ids" />
    </p>
  <p>
  <input type="button"
    onclick="sendRequestViaMultiFriendSelector(); return false;"
    value="Send Request to Many Users with MFS"
  />
  </p>
  
  <script>
    FB.init({
      appId  : '155182144562932',
      status : true,
      cookie : true,
      frictionlessRequests : true,
      oauth: true
    });

    function sendRequestToRecipients() {
      var user_ids = document.getElementsByName("user_ids")[0].value;
      FB.ui({method: 'apprequests',
        message: 'My Great Request',
        to: user_ids, 
      }, requestCallback);
    }

    function sendRequestViaMultiFriendSelector() {
      FB.ui({method: 'apprequests',
        message: 'My Great Request'
      }, requestCallback);
    }
    
    function requestCallback(response) {
      console.log(response);
    }
  </script>
</html>
</form>
