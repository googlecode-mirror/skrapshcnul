<div id="login_form">
	<h1>User Login</h1>
	<div style="text-align: center;">
		<?php
echo validation_errors('<p class="error">');
if($this->session->flashdata('message' )) :?>
		<p class="error">
			<?php echo $this -> session -> flashdata('message');?>
		</p>
		<?php endif;?>
	</div>
	<?php
	echo form_open('login/validate_credentials');
	echo form_input('username', 'Username');
	echo form_password('password', 'Password');
	echo form_submit('submit', 'Login');
	echo anchor('/login/signup', 'Create Account');
	echo validation_errors('<p class="error">');
	?>
</div>