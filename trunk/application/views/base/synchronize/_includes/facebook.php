<?php if (!isset($external_data['facebook']['data']) || !$external_data['facebook']['data']) { ?>
	<div class="content-unavailable">
		You have not connect your Facebook Profile
		<a class="btn btn-primary btn-large" href="/synchronize/facebook">Connect with Facebook</a>
	</div>
<?php } else { ?> 
	<div class="profile-img-100 image-border pull-left">
		<?php if(isset($external_data['facebook']['picture']['normal'])) { ?>
			<img src="<?php echo $external_data['facebook']['picture']['normal']; ?>" />
		<?php } ?>
	</div>
	<div class="external-data-settings">
		<p>
			<span class="label label-info">Connected as</span> <strong><?php echo $external_data['facebook']['data']['username'] ?></strong>
		</p>
		<p>
			<span class="label label-info">Last Updated</span> <?php echo date_format(date_create($external_data['facebook']['updated_on']), 'l jS F Y \o\n g:ia ');; ?>
		</p>
		
		<br />
		<a class="btn btn-primary btn-large" href="/synchronize/facebook">Refresh</a>
	</div>
	
<?php } ?>
<div class="clearfix">&nbsp;</div>