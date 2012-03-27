<div class="c-pages radial-grey shadow-rounded">
	<div class="forms">
		<h1>Create User</h1>
		<p>
			Please enter the users information below.
		</p>
		<?php if (isset($message)) { ?>
		<div id="infoMessage" class="ui-state-highlight ui-corner-all" style="padding:0 10px; margin: 5px 0;">
			<?php echo $message;?>
		</div>
		<?php } ?>
		<?php echo form_open("auth/signup");?>
		<fieldset>
			<legend>
				Account Information
			</legend>
			<p>
				Email:
				<br />
				<?php echo form_input($email);?>
			</p>
			<p>
				Password:
				<br />
				<?php echo form_input($password);?>
			</p>
			<p>
				Confirm Password:
				<br />
				<?php echo form_input($password_confirm);?>
			</p>
		</fieldset>
		<fieldset>
			<legend>
				Pesonal Information
			</legend>
			<p>
				First Name: <?php echo form_input($first_name);?>
			</p>
			<p>
				Last Name:
				<br />
				<?php echo form_input($last_name);?>
			</p>
			<p>
				<?php echo form_submit('submit', 'Create User');?>
				<?php echo form_input($invitation_key);?>
			</p>
			<?php echo form_close();?>
		</fieldset>
	</div>
<?php	if(isset($success) && $success)
{
	if(isset($status) && $status)
	{
		echo "<pre>" . print_r($response, TRUE) . "</pre>";
	}
	else {
		echo "Error retrieving profile information:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response) . "</pre>";
	}
}
else {
	?>
<form id="linkedin_connect_form" action="/index.php/auth/test" method="get">
<input type="hidden" name="<?php echo LINKEDIN::_GET_TYPE;?>" id="<?php echo LINKEDIN::_GET_TYPE;?>" value="initiate" />
<input type="submit" value="Connect to LinkedIn" />
</form>	
	<?php
}
?>
</div>
