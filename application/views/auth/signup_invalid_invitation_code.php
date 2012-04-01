<div class="container c-pages radial-grey shadow-rounded">
	<div style="padding: 30px;">
		<div class="row-fluid">
			<div class="span6">
				<form id="invitation-signup" class="form-horizontal" action="/auth/signup" method="post">
					
					<legend>Signup</legend>
					<div class="clearfix">&nbsp;</div>
					
					<?php if (isset($invitation_key_val) && !empty($invitation_key_val)) { ?>
						<div class="alert">
							<i class="icon-info-sign"></i> Opps... You have entered an invalid invitation code.
						</div>
					<?php }?>
					
					<div class="control-group">
						<label class="control-label" for="invitation_key">Invitation Key</label>
						<div class="controls">
							<input name="invitation_key" required="required" type="text" class="input-xlarge" id="invitation_key" placeholder="Invitation key" />
						</div>
					</div>
					
					<div style="text-align: center;">
						<button class="btn btn-primary btn-large">Sign Up</button>
					</div>
					
					<div class="clearfix">&nbsp;</div>
					
					<div class="box-padding">
						<div class="alert alert-info">
							Don't have invitation key? Sign up to become our Alpha testers <?php echo anchor('http://eepurl.com/ftkI-/', 'here', 'style="text-decoration:underline;"');?>.
						</div>
					</div>
						
				</form>
			</div>
			
			<div class="span6">
				<div style="text-align: center; margin: 10px auto;">
					<h2>Already have an account?</h2>
					<div class="clearfix">&nbsp;</div>
					<a href="/auth/login" class="btn btn-primary btn-large">Login Here!</a>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<br>
	</div>
</div>