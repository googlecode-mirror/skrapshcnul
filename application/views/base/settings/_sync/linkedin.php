<?php if ($this->session->userdata('linkedin_pulled') == FALSE) { ?>
	<div class="content-unavailable">
		<span>You have not sync your LinkedIn profile.</span>
		<form id="linkedin_sync_form" action="/synchronize/linkedIn/pullLinkedInData" method="get">
			<input type="hidden" name="<?php echo LINKEDIN::_GET_TYPE; ?>" id="<?php echo LINKEDIN::_GET_TYPE; ?>" value="initiate" /> 
			<input type="submit" value="Synchronize with LinkedIn" />
		</form>
	</div>
<?php } else { ?> 
		
	<?php $linkedin_data = new SimpleXMLElement($external_data['linkedin'] -> data); ?>
	<?php $picture_url = ($linkedin_data->{'picture-url'}) ? ($linkedin_data->{'picture-url'}) : base_url().'skin/images/100/icon_no_photo_no_border_offset_100x100.png'; ?>
	
	<div class="row-fluid">
		<div class="span2">
			<div class="profile-img-100 image-border">
				<img src="<?php echo $picture_url; ?>" />
			</div>
		</div>
		<div class="span10">
			<table class="table">
				<tbody>
					<tr>
						<td>Connected as</td>
						<td>
							<strong><?php echo ($linkedin_data->{'first-name'}); ?>, <?php echo ($linkedin_data->{'last-name'}); ?></strong>
						</td>
					</tr>
					<tr>
						<td>Last Updated</td>
						<td>
							<?php echo date_format(date_create($external_data['linkedin'] -> timestamp), 'l jS F Y \o\n g:ia ');; ?>
						</td>
					</tr>
				</tbody>		
			</table>
			
			<div class="clearfix">&nbsp;</div>
			
			<form id="linkedin_sync_form" action="/synchronize/linkedIn/pullLinkedInData" method="get">
				<input type="hidden"
				name="<?php echo LINKEDIN::_GET_TYPE; ?>"
				id="<?php echo LINKEDIN::_GET_TYPE; ?>" value="initiate" />
				<button type="submit" class="btn btn-primary btn-large" >Refresh</button>
			</form>
		</div>
	</div>
<?php } ?>