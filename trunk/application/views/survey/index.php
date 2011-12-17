<?
	$obj = $this -> recs_model -> prepareDataForSurvey();	
?>
<br>
	You just had lunch with <a href=<? echo '/pub/' . $obj -> partner -> alias; ?>> <? echo $obj -> partner -> firstname ?> </a>
	at <? echo $obj -> restaurant -> name; ?>
<br>
<br>
<form>
	1. Rating <? echo $obj -> restaurant -> name; ?>: 
	<span id="stars-cap"></span>
	<div id="stars-wrapper2" class="abc">
		<select name="selrate">
			<option value="1" selected="selected">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
	</div>
	<br>
	<br>
	<textarea style="width: 300px;height: 60px;">testimonial</textarea>
	<br>
	<br>
	
	2. Rating <a href=<? echo '/pub/' . $obj -> partner -> alias; ?>> <? echo $obj -> partner -> firstname ?></a>:
	<span id="stars-cap"></span>
	<div id="stars-wrapper3" class="abc">
		<select name="selrate">
			<option value="1" selected="selected">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
	</div>
	<br>
	<br>
	<textarea style="width: 300px;height: 60px;">testimonial</textarea>
	<br>
	<br>
	<input type="submit" value="submit"/>
</form>	

<br>
<br>
The form below is for testing. Delete it when you make the layout.<br>
Example of data being sent to server: Array ( [index] => 2 [user_id] => 6 [target_id] => 1 [target_point] => 5 [target_review] => He is awesome! [restaurant_id] => 1 [restaurant_point] => 4 [restaurant_review] => Good food! ) 
<form name="input" action="survey/receive_survey" method="post">
	<input type="text" name="index" value ="<? echo $obj -> index; ?>"/>
	<input type="text" name="user_id" value ="<? echo $this -> session -> userdata('user_id'); ?>"/>
	<input type="text" name="target_id" value ="<? echo $obj -> partner -> user_id; ?>"/>
	<input type="text" name="target_point" value ="5"/>
	<input type="text" name="target_review" value ="He is awesome!"/>
	<input type="text" name="restaurant_id" value ="<? echo $obj -> restaurant -> restaurant_id ?>"/>
	<input type="text" name="restaurant_point" value ="4"/>
	<input type="text" name="restaurant_review" value ="Good food!"/>
	<input type="submit" value="submit"/>
</form>
<br>

