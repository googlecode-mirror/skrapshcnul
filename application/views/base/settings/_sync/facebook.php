<?php if (!isset($external_data['facebook']['data']) || !$external_data['facebook']['data']) { ?>
	<div class="content-unavailable">
		You have not connect your Facebook Profile
		<a class="btn btn-primary btn-large" href="/synchronize/facebook">Connect with Facebook</a>
	</div>
<?php } else { ?> 
	<div class="row-fluid">
		<div class="span2">
			<div class="profile-img-100 image-border">
				<?php if(isset($external_data['facebook']['picture']['normal'])) { ?>
					<img src="<?php echo $external_data['facebook']['picture']['normal']; ?>" />
				<?php } ?>
			</div>
		</div>
		<div class="span10">
			<table class="table">
				<tbody>
					<tr>
						<td>Connected as</td>
						<td>
							<strong><?php echo $external_data['facebook']['data']['username'] ?></strong>
						</td>
					</tr>
					<tr>
						<td>Last Updated</td>
						<td>
							<?php echo date_format(date_create($external_data['facebook']['updated_on']), 'l jS F Y \o\n g:ia ');; ?>
						</td>
					</tr>
				</tbody>		
			</table>
			
			<div class="clearfix">&nbsp;</div>
			
			<a class="btn btn-primary btn-large" href="/synchronize/facebook">Refresh</a>
		</div>
	</div>
	
	<div class="external-data-settings">
		
	</div>
	
<?php } ?>
<div class="clearfix">&nbsp;</div>