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