<div class="m-content">
	<div class="c-pages shadow-rounded">
		<h2><?php echo $tpl_page_title; ?></h2>
		
		<div id="settings-sync-linkedin">
			<h3 class="sub-heading">Synchronize with other networks</h3>
			<div class="row-item">
				<div class="section-top">
					<div id="linkedin" class="service-icon">LinkedIn</div>
				</div>
				<div class="section-middle">
					<?php if ($this->session->userdata('linkedin_pulled') == FALSE) { ?>
						<form id="linkedin_sync_form" action="pullLinkedInData" method="get">
							<input type="hidden" name="<?php echo LINKEDIN::_GET_TYPE;?>" id="<?php echo LINKEDIN::_GET_TYPE;?>" value="initiate" /> 
							<input type="submit" value="Synchronize with LinkedIn" /></form>
					<?php } else { ?> 
						<div class="external-data">
							
							<?php $linkedin_data = new SimpleXMLElement($external_data['linkedin'] -> data); ?>
							<?php $picture_url = ($linkedin_data->{'picture-url'}) ? ($linkedin_data->{'picture-url'}) : base_url().'skin/images/100/icon_no_photo_no_border_offset_100x100.png'; ?>
							
							<div class="profile-img-100 image-border connections-profile-img">
								<img src="<?php echo $picture_url; ?>" />
							</div>
							<div class="external-data-settings">
								<p>Connected to LinkedIn as <strong><?php echo ($linkedin_data->{'first-name'}); ?>, <?php echo ($linkedin_data->{'last-name'}); ?></strong></p>
								<p><?php echo ($linkedin_data->{'headline'}); ?></p>
								<p>Last profile update: <?php echo($external_data['linkedin']->timestamp); ?></p>
								<form id="linkedin_sync_form" action="pullLinkedInData" method="get">
									<input type="hidden"
									name="<?php echo LINKEDIN::_GET_TYPE;?>"
									id="<?php echo LINKEDIN::_GET_TYPE;?>" value="initiate" />
									<input type="submit" value="Synchronize with LinkedIn" />
								</form>
							</div>
						</div>
					<?php } ?>
				</div> 
				<div class="clearfix"></div>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class="row-item">
				<div class="section-top">
					<div id="twitter" class="service-icon">Twitter</div>
				</div>
				<div class="section-middle">
					<?php if ($this->session->userdata('linkedin_pulled') == FALSE) { ?>
						<div class="content-unavailable">Coming soon.</div>
					<?php } else { ?> 
						<div class="content-unavailable">Coming soon.</div>
					<?php } ?>
				</div>
			</div>
			<div class="clearfix">&nbsp;</div>
		</div>
		
		<?php /*
		<div class="content-table-2-col-left">
		</div>
		<div class="content-table-2-col-right">
		</div>
		 */ ?>
		
		<?php /* <table class="table-connections">
		<tr class="row-item">
			<td width="20%"><div id="linkedin" class="service-icon">LinkedIn</div></td>
			<td width="80%">
				<?php if ($this->session->userdata('linkedin_pulled') == FALSE) { ?>
					<form id="linkedin_sync_form" action="pullLinkedInData" method="get">
						<input type="hidden" name="<?php echo LINKEDIN::_GET_TYPE;?>" id="<?php echo LINKEDIN::_GET_TYPE;?>" value="initiate" /> 
						<input type="submit" value="Sync with LinkedIn" /></form>
				<?php } else { ?> 
					<div class="external-data">
						
						<?php $linkedin_data = new SimpleXMLElement($external_data['linkedin'] -> data); ?>
						<?php $picture_url = ($linkedin_data->{'picture-url'}) ? ($linkedin_data->{'picture-url'}) : base_url().'skin/images/100/icon_no_photo_no_border_offset_100x100.png'; ?>
						
						<div class="profile-img-100 image-border connections-profile-img">
							<img src="<?php echo $picture_url; ?>" />
						</div>
						<div class="external-data-settings">
							<p>Connected to LinkedIn as <strong><?php echo ($linkedin_data->{'first-name'}); ?>, <?php echo ($linkedin_data->{'last-name'}); ?></strong></p>
							<p><?php echo ($linkedin_data->{'headline'}); ?></p>
							<p>Last profile update: <?php echo($external_data['linkedin']->timestamp); ?></p>
							<form id="linkedin_sync_form" action="pullLinkedInData" method="get">
								<input type="hidden"
								name="<?php echo LINKEDIN::_GET_TYPE;?>"
								id="<?php echo LINKEDIN::_GET_TYPE;?>" value="initiate" />
								<input type="submit" value="Sync with LinkedIn" />
							</form>
						</div>
					</div>
				<?php } ?>
			</td>
		</tr>
		<tr class="row-item">
			<td width="20%"><div id="twitter" class="service-icon">Twitter</div></td>
			<td width="80%">
				<?php if ($this->session->userdata('linkedin_pulled') == FALSE) { ?>
					Coming soon.
				<?php } else { ?> 
					Coming soon.
				<?php } ?>
			</td>
		</tr>
	</table> */ ?>
	</div>
	<div class="clearfix"></div>
</div>