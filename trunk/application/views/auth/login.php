<div class="container c-pages radial-grey shadow-rounded">
	<div style="padding: 30px;">
		<div class="row-fluid">
			<div class="span6">
				<div id="login_form">
					
					<h1><?php echo $title;?></h1>
					<div class="clearfix">&nbsp;</div>
					
					<?php if($this->session->flashdata('message' )) { ?>
						<div class="alert">
							<i class="icon-warning-sign"></i> <?php echo $this -> session -> flashdata('message');?>.
						</div>
						<script>
							jQuery(function(){
								jQuery( ".alert" ).effect('shake', 500);
							});
						</script>
					<?php } ?>
					
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
					<div class="clearfix">&nbsp;</div>
					<p>
						<?php echo anchor('auth/forgot_password', 'Forgot Password?');?>
					</p>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="span6">
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
	</div>
	<div class="clearfix">&nbsp;</div>
</div>