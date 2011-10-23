<div class='mainInfo'>
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
</div>
