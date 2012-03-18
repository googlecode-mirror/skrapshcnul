<div class="c-pages radial-grey shadow-rounded">
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
					<label class="checkbox">
						<?php echo form_checkbox('remember', '1', FALSE);?> Remember Me
					</label>
				</p>
				<p class="button-set">
					<button type="submit" class="btn btn-primary btn-large"><i class="icon-user icon-white"></i> Login</button> or 
					<a href="/auth/signup" class="btn">Create Account</a>
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
				<a href="/auth/signup" class="btn btn-primary btn-large">Sign Up!</a>
			</div>
			<?php /*<div style="text-align: center;margin: 10px auto;">
				<a href="/auth/facebook" class="btn btn-primary btn-large">Login with Facebook</a>
			</div> */ ?>
		</div>
		
	</div>
	<div class="clearfix"></div>
	<br />
</div>