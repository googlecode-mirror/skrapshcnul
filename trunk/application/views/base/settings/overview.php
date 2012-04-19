<div class="container">

	<div class="row-fluid">
		<div class="span3">
			<?php $this -> load -> view('base/settings/includes/sidetab'); ?>
		</div>
		<div class="span9 hasLeftCol">
			<div class="content-area">

				<h2>General Account Settings</h2>
				<div class="clearfix">&nbsp;</div>
				
				<form name="account_settings" method="post" class="form-horizontal">
					<fieldset>

						<legend>
							System Notifications
						</legend>

						<div class="control-group">
							<label class="control-label" for="alias">Alias</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="alias" name="alias" value="<?php echo !empty($settings['alias']) ? ($settings['alias']) : '' ?>" placeholder="username" > <span class="help-inline hidden"></span>
								<p class="help-block"><span class="label">Tips</span> You alias will be the identifier for your profile. E.g. http://lunchsparks.me/pub/<i>username</i></p>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="firstname">First Name</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="firstname" name="firstname" value="<?php echo !empty($settings['firstname']) ? ($settings['firstname']) : '' ?>" placeholder="firstname" >
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="lastname">Last Name</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="lastname" name="lastname" value="<?php echo !empty($settings['lastname']) ? ($settings['lastname']) : '' ?>" placeholder="lastname" >
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="alias">Current City</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="location" name="location" value="<?php echo !empty($settings['location']) ? ($settings['location']) : '' ?>" placeholder="location" >
							</div>
						</div>
						
					</fieldset>
					
					<fieldset>
						
						<legend>
							Notification
						</legend>
						
						<div class="control-group">
							<label class="control-label" for="alias">Email</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="delivery_email" name="delivery_email" value="<?php echo !empty($settings['delivery_email']) ? ($settings['delivery_email']) : '' ?>" placeholder="email@example.com" >
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="alias">Phone</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="mobile_number" name="mobile_number" value="<?php echo !empty($settings['mobile_number']) ? ($settings['mobile_number']) : '' ?>" placeholder="+6599998888">
							</div>
						</div>
						
						
					</fieldset>
					
					<div class="form-actions">
						<button type="submit" class="btn btn-primary btn-large">
							Save changes
						</button>
					</div>
					
				</form>
				
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

<script>
jQuery(function() {
	jQuery('input[name=alias]').change(function() {
		is_alias_available();
	});
});

function is_alias_available() {
	
	var dfd = new jQuery.Deferred();
	
	var alias = jQuery('input[name=alias]').val();
	jQuery.getJSON('/jsonp/profile/is_alias_available?alt=json&callback=?', {
		alias: alias
	}, function(data) {
		console.log(data);
		if (data.results) {
			jQuery('input[name=alias]').next().addClass('hidden');
			jQuery('input[name=alias]').parentsUntil('.control-group').parent().removeClass('warning');
			dfd.resolve(true);
		} else {
			jQuery('input[name=alias]').parentsUntil('.control-group').parent().addClass('warning');
			jQuery('input[name=alias]').next().html('Alias not available.');
			jQuery('input[name=alias]').next().removeClass('hidden');
			dfd.reject(false);
		}
	})
	
	// Return the Promise so caller can't change the Deferred
	return dfd.promise();
}
</script>