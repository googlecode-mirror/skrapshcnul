<fieldset>
	<legend>
		Project Information
	</legend>
	<div class="control-group">
		<label class="control-label" for="name">Name</label>
		<div class="controls">
			<input id="name" name="name" title="name" class="input-xlarge" type="text" value="<?php echo $project['name'];?>" placeholder="Project name">
			<p class="help-block">
				
			</p>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="description">Description</label>
		<div class="controls">
			<input id="description" name="description" title="description" class="input-xlarge" type="text" value="<?php echo $project['description'];?>" placeholder="Project Description">
			<p class="help-block">
				
			</p>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="logo">Logo</label>
		<div class="controls">
			<input id="logo" name="logo" title="logo" class="input-xlarge" type="text" value="<?php echo $project['logo'] ?>" placeholder="Project logo URL">
			<p class="help-block">
				
			</p>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="cover_img">Cover Image</label>
		<div class="controls">
			<input id="cover_img" name="cover_img" title="cover_img" class="input-xlarge" type="text" value="<?php echo $project['cover_img'];?>" placeholder="Project Cover Image URL">
			<p class="help-block">
				
			</p>
		</div>
	</div>
</fieldset>

<fieldset>
	<legend>
		Web Links
	</legend>
	
	<div class="control-group">
		<label class="control-label" for="homepage">Homepage</label>
		<div class="controls">
			<input id="homepage" name="homepage" title="homepage" class="input-xlarge" type="text" value="<?php echo $project['external_urls']['homepage'] ?>" placeholder="Project Homepage">
			<p class="help-block">
				
			</p>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="github_url">Github Page</label>
		<div class="controls">
			<input id="github_url" name="github_url" title="github_url" class="input-xlarge" type="text" value="<?php echo $project['external_urls']['github_url']; ?>" placeholder="Github URL">
			<p class="help-block">
				
			</p>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="facebook_url">Facebook Page</label>
		<div class="controls">
			<input id="facebook_url" name="facebook_url" title="facebook_url" class="input-xlarge" type="text" value="<?php echo $project['external_urls']['facebook_url']; ?>" placeholder="Facebook URL">
			<p class="help-block">
				
			</p>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="twitter_url">Twitter Page</label>
		<div class="controls">
			<input id="twitter_url" name="twitter_url" title="twitter_url" class="input-xlarge" type="text" value="<?php echo $project['external_urls']['twitter_url']; ?>" placeholder="Twitter URL">
			<p class="help-block">
				
			</p>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="gplus_url">Google+ Page</label>
		<div class="controls">
			<input id="gplus_url" name="gplus_url" title="gplus_url" class="input-xlarge" type="text" value="<?php echo $project['external_urls']['gplus_url']; ?>" placeholder="Google+ URL">
			<p class="help-block">
				
			</p>
		</div>
	</div>
	
</fieldset>

<fieldset>
	<legend>
		Project Mobile Apps Information
	</legend>
	
	<div class="control-group">
		<label class="control-label" for="ios_app_store_url">Apple App Store</label>
		<div class="controls">
			<input id="ios_app_store_url" name="ios_app_store_url" title="ios_app_store_url" class="input-xlarge" type="text" value="<?php echo $project['apps']['ios_app_store_url'] ?>" placeholder="iOS App Store URL">
			<p class="help-block">
				
			</p>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="android_market_url">Android Market</label>
		<div class="controls">
			<input id="android_market_url" name="android_market_url" title="android_market_url" class="input-xlarge" type="text" value="<?php echo $project['apps']['android_market_url']; ?>" placeholder="Android Market URL">
			<p class="help-block">
				
			</p>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="ios_app_store_url">Windows Phone Marketplace</label>
		<div class="controls">
			<input id="wp_market_url" name="wp_market_url" title="wp_market_url" class="input-xlarge" type="text" value="<?php echo $project['apps']['wp_market_url']; ?>" placeholder="Windows Phone Marketplace URL">
			<p class="help-block">
				
			</p>
		</div>
	</div>
	
	
</fieldset>