<h1>Create an Account</h1>
<div style="text-align: center;">
	<?php
echo validation_errors('<p class="error">');
if($this->session->flashdata('message')) :
	?>
	<p class="error">
		<?php echo $this -> session -> flashdata('message');?>
	</p>
	<?php endif;?>
</div>
<fieldset>
	<legend>
		Personal Information
	</legend>
	<?php

	echo form_open('login/create_user');
	echo form_input('email', set_value('email', 'Email Address'));
	echo form_input('firstname', set_value('firstname', 'First Name'));
	echo form_input('lastname', set_value('lastname', 'Last Name'));
	?>
</fieldset>
<fieldset>
	<legend>
		Login Info
	</legend>
	<?php
	echo form_input('username', set_value('username', 'Username'));
	echo form_input('password', set_value('password', 'Password'));
	echo form_input('password2', set_value('password2', 'Confirm Password'));

	echo form_submit('submit', 'Create Account');
	?>
</fieldset>