<div class="container c-pages radial-grey shadow-rounded">
	<div class="forms" style="padding: 30px;">
		<h1>Create Account <small>Complete the follow details to create an account.</small></h1>
		<?php if (isset($message)) { ?>
		<div class="alert alert-block">
			<?php echo $message;?>
		</div>
		<?php }?>

		<div class="row-fluid">
			<div class="span6"></div>
			<div class="span6"></div>
		</div>
		<?php echo form_open("auth/signup");?>
		<div class="form-horizontal">
			<fieldset>
				
				<legend>Account Information</legend>
						
				<div class="control-group">
					<label class="control-label" for="email">Email</label>
					<div class="controls">
						<?php echo form_input($email);?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="password">Password</label>
					<div class="controls">
						<?php echo form_input($password);?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="password_confirm">Confirm Password</label>
					<div class="controls">
						<?php echo form_input($password_confirm);?>
					</div>
				</div>
				
				<legend>Pesonal Information</legend>
				
				<div class="control-group">
					<label class="control-label" for="first_name">First Name</label>
					<div class="controls">
						<?php echo form_input($first_name);?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="first_name">Last Name</label>
					<div class="controls">
						<?php echo form_input($last_name);?>
					</div>
				</div>
				
				<?php echo form_input($invitation_key);?>
				
				<div class="form-actions">
					<button type="submit" name="submit" class="btn btn-primary btn-large">Create User</button>
				</div>
				
				<?php echo form_close();?>
			</fieldset>
		</div>
	</div>
	<?php /*
	if(isset($success) && $success) {
		if(isset($status) && $status) {
			echo "<pre>" . print_r($response, TRUE) . "</pre>";
		} else {
			echo "Error retrieving profile information:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response) . "</pre>";
		}
	} else { ?>
		<form id="linkedin_connect_form" action="/index.php/auth/test" method="get">
			<input type="hidden" name="<?php echo LINKEDIN::_GET_TYPE;?>" id="<?php echo LINKEDIN::_GET_TYPE;?>" value="initiate" />
			<input type="submit" value="Connect to LinkedIn" />
		</form>
	<?php } */ ?>
</div>
