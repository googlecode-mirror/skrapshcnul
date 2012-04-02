<div class="container c-pages">
	<div id="places-container" style="padding: 10px;">
		<h1><?php echo $tpl_page_title; ?></h1>
		
		<form method="post" id="add-project" class="form-horizontal">
			<fieldset>
				<div class="row">
					<div class="span10">
						<legend>Project Information</legend>
						<div class="caption"></div>
						
						<div class="control-group">
							<label class="control-label" for="logo">Logo</label>
							<div class="controls">
								<input name="logo" type="text" class="input-xlarge" id="logo" placeholder="Project logo URL">
								<p class="help-block"></p>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="name">Name</label>
							<div class="controls">
								<input name="name" type="text" class="input-xlarge" id="name" placeholder="Project name">
								<p class="help-block"></p>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="description">Description</label>
							<div class="controls">
								<input name="description" type="text" class="input-xlarge" id="description" placeholder="Project description">
								<p class="help-block"></p>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="cover_img">Cover Image</label>
							<div class="controls">
								<input name="cover_img" type="text" class="input-xlarge" id="cover_img" placeholder="Project cover image URL">
								<p class="help-block"></p>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="cover_img">Cover Image</label>
							<div class="controls">
								<input name="cover_img" type="text" class="input-xlarge" id="cover_img" placeholder="Project cover image URL">
								<p class="help-block"></p>
							</div>
						</div>
						
						<div class="clearfix">&nbsp;</div>
						
						<legend>Project Web Links</legend>
						
						<div class="control-group">
							<label class="control-label" for="homepage">Homepage</label>
							<div class="controls">
								<input name="homepage" type="text" class="input-xlarge" id="homepage" placeholder="Project homepage">
								<p class="help-block"></p>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="github_url">Github Page</label>
							<div class="controls">
								<input name="github_url" type="text" class="input-xlarge" id="github_url" placeholder="Github URL">
								<p class="help-block"></p>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="facebook_url">Facebook Page</label>
							<div class="controls">
								<input name="facebook_url" type="text" class="input-xlarge" id="facebook_url" placeholder="Facebook URL">
								<p class="help-block"></p>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="twitter_url">Twitter Profile</label>
							<div class="controls">
								<input name="twitter_url" type="text" class="input-xlarge" id="twitter_url" placeholder="Twitter URL">
								<p class="help-block"></p>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="gplus_url">Google+ Page</label>
							<div class="controls">
								<input name="gplus_url" type="text" class="input-xlarge" id="gplus_url" placeholder="Google+ URL">
								<p class="help-block"></p>
							</div>
						</div>
						
						<div class="clearfix">&nbsp;</div>
						
						<legend>Project Mobile Apps Information</legend>
						
						<div class="control-group">
							<label class="control-label" for="ios_app_store_url">Apple App Store</label>
							<div class="controls">
								<input name="ios_app_store_url" type="text" class="input-xlarge" id="ios_app_store_url" placeholder="iOS App Store URL">
								<p class="help-block"></p>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="android_market_url">Android Market</label>
							<div class="controls">
								<input name="android_market_url" type="text" class="input-xlarge" id="android_market_url" placeholder="Android Market URL">
								<p class="help-block"></p>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="wp_market_url">Windows Phone Marketplace</label>
							<div class="controls">
								<input name="wp_market_url" type="text" class="input-xlarge" id="wp_market_url" placeholder="Windows Phone Marketplace URL">
								<p class="help-block"></p>
							</div>
						</div>
						
						<?php if(isset($is_logged_in_admin) && $is_logged_in_admin == TRUE) { ?>
						
						<div class="clearfix">&nbsp;</div>
						
						<legend>Verification Status</legend>
						
						<div class="control-group">
							<label class="control-label" for="verified_status">Status</label>
							<div class="controls">
								<input name="verified_status" type="text" class="input-xlarge" id="verified_status" placeholder="Verification status">
								<p class="help-block"></p>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="remarks">Remarks</label>
							<div class="controls">
								<input name="remarks" type="text" class="input-xlarge" id="remarks" placeholder="Verification remarks">
								<p class="help-block"></p>
							</div>
						</div>
						
						<?php } ?>
					</div>
				</div>
				
				<div class="form-actions">
					<button type="submit" class="btn btn-primary btn-large"><i class="icon-pencil icon-white"></i> Add Project</button> 
					<button class="btn btn-inverse" href="#" onclick="history.back();"><i class="icon-remove-sign icon-white"></i> Back</button>
				</div>
				
				
				<div class="clearfix">&nbsp;</div>
								
			</fieldset>
			
			
		</form>
		
		
	</div>
</div>
<div class="clearfix">&nbsp;</div>
