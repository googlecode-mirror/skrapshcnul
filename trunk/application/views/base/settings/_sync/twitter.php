<?php if (!isset($external_data['twitter']['data']) || !$external_data['twitter']['data']) { ?>
	<div class="content-unavailable">
		You have not connect your Twitter account
		<a class="btn btn-primary btn-large" href="/synchronize/twitter">Connect with Twitter</a>
	</div>
<?php } else { ?> 
	
	
	<div class="row-fluid">
		<div class="span2">
			<div class="profile-img-100 image-border">
				<?php if(isset($external_data['twitter']['data']['profile_image'])) { ?>
					<img src="<?php echo $external_data['twitter']['data']['profile_image']; ?>" />
				<?php } ?>
			</div>
		</div>
		<div class="span10">
			<table class="table">
				<tbody>
					<tr>
						<td>Connected as</td>
						<td>
							<strong><?php echo $external_data['twitter']['data']['profile']['screen_name'] ?></strong>
						</td>
					</tr>
					<tr>
						<td>Last Updated</td>
						<td>
							<?php echo date_format(date_create($external_data['twitter']['updated_on']), 'l jS F Y \o\n g:ia ');; ?>
						</td>
					</tr>
				</tbody>		
			</table>
			
			<div class="clearfix">&nbsp;</div>
			
			<a class="btn btn-primary btn-large" href="/synchronize/twitter">Refresh</a>
		</div>
	</div>
	
	
	<div class="external-data-settings">
		
	</div>
	
<?php } ?>
<div class="clearfix">&nbsp;</div>