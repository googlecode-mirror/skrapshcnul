<div class="c-pages shadow-rounded">
	<div class="forms">
		<div class="column-2-left">
			<div id="login_form">
				<div class="pageTitle">
					<h1><?php echo $title;?></h1>
				</div>
				<div class="pageTitleBorder"></div>
				<div class="error-msg">
					<?php echo validation_errors('<p class="error">');?>
					<?php if($this->session->flashdata('message' )) { ?>
					<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
						<p>
							<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
							<?php echo $this -> session -> flashdata('message');?>
						</p>
					</div>
					<?php } ?>
				</div>
				
				<?php echo form_open("auth/login");?>
				<p>
					<label for="email">Email:</label>
					<?php echo form_input($email);?>
				</p>
				<p>
					<label for="password">Password:</label>
					<?php echo form_input($password);?>
				</p>
				<p>
					<label for="remember">Remember Me:</label>
					<?php echo form_checkbox('remember', '1', FALSE);?>
				</p>
				<p class="button-set">
					<?php echo form_submit('submit', 'Login');?>
					<?php echo anchor('auth/signup', 'Create Account');?>
				</p>
				<p>
					<small><?php echo anchor('auth/forgot_password', 'Forgot Password?');?></small>
				</p>
				<?php echo form_close(); ?>
			</div>
		</div>
		<div class="column-2-right">
			<h2>New to Lunchsparks?</h2>
			<div class="box-padding">
				Apply for membership today. We're letting people into our alpha on a rolling basis.
			</div>
			<div style="text-align: center;margin: 10px auto;">
				<a href="/auth/signup" class="button xl">Sign Up!</a>
			</div>
			
		</div>
		
	</div>
	<div class="clearfix"></div>
	<br />
</div>