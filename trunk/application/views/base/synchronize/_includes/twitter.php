<?php if (!isset($external_data['twitter']['data']) || !$external_data['twitter']['data']) { ?>
	<div class="content-unavailable">
		You have not connect your Twitter account
		<a class="btn btn-primary btn-large" href="/synchronize/twitter">Connect with Twitter</a>
	</div>
<?php } else { ?> 
	<div class="profile-img-100 image-border pull-left">
		<?php if(isset($external_data['twitter']['data']['profile_image'])) { ?>
			<img src="<?php echo $external_data['twitter']['data']['profile_image']; ?>" />
		<?php } ?>
	</div>
	<div class="external-data-settings">
		<p>
			<span class="label label-info">Connected as</span> <strong><?php echo $external_data['twitter']['data']['profile']['screen_name'] ?></strong>
		</p>
		<p>
			<span class="label label-info">Last Updated</span> <?php echo date_format(date_create($external_data['twitter']['updated_on']), 'l jS F Y \o\n g:ia ');; ?>
		</p>
		
		<br />
		<a class="btn btn-primary btn-large" href="/synchronize/twitter">Refresh</a>
	</div>
	
<?php } ?>
<div class="clearfix">&nbsp;</div>