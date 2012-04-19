<div class="container c-pages radial-grey shadow-rounded">
	<div style="padding: 30px;">
		<div class="row-fluid">
			<div class="span6">
				<div id="login_form">
					<h1>Change Password</h1>
					
					<?php if (isset($message) && !empty($message)) { ?>
						<div class="alert">
							<i class="icon-warning-sign"></i> <?php echo $message; ?>
						</div>
						<script>
							jQuery(function(){
								jQuery( ".alert" ).effect('shake', 500);
							});
						</script>
					<?php } ?>
					<div class="clearfix">&nbsp;</div>

					<form method="post" accept-charset="utf-8" class="form-horizontal">
						<fieldset>
							<div class="control-group">
								<label class="control-label" for="input01">Old Password</label>
								<div class="controls">
									<?php echo form_input($old_password); ?>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">New Password</label>
								<div class="controls">
									<?php echo form_input($new_password); ?>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="input01">Confirm New Password</label>
								<div class="controls">
									<?php echo form_input($new_password_confirm); ?>
								</div>
							</div>

							<?php echo form_input($user_id); ?>

							<div class="form-actions">
								<button type="submit" class="btn btn-primary btn-large">
									Save changes
								</button>
								<button class="btn">
									Cancel
								</button>
							</div>
						</fieldset>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
