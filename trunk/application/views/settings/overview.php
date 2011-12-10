<div class="m-content">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('settings/includes/sidetab');?>
	</div>
	<div class="m-content-2-col-right">
		<div class="hr">
			<h2 class="hr-text">Account Settings Overview</h2>
		</div>
		
		<div id="settings-profile">
			<h3>Profile</h3>
			<div class="row-item">
				<div class="content-table-2-col-left">
					First Name
				</div>
				<div class="content-table-2-col-right">
					<div class="editable">
						<span title="firstname" class="editable-value">
							<?php echo !empty($settings['firstname']) ? ($settings['firstname']) : '<i>[firstname]</i>' ?>
						</span>
					</div>
					<div style="display: none;">
						<input title="firstname" type="text" value="<?php echo !empty($settings['firstname']) ? ($settings['firstname']) : '' ?>" placeholder="firstname" />
					</div>
				</div>
			</div>
			<div class="row-item">
				<div class="content-table-2-col-left">
					Last Name
				</div>
				<div class="content-table-2-col-right">
					<div class="editable">
						<span title="lastname" class="editable-value">
							<?php echo !empty($settings['lastname']) ? ($settings['lastname']) : '<i>[lastname]</i>' ?>
						</span>
					</div>
					<div style="display: none;">
						<input title="lastname" type="text" value="<?php echo !empty($settings['lastname']) ? ($settings['lastname']) : '' ?>" placeholder="lastname" />
					</div>
				</div>
			</div>
			<div class="row-item">
				<div class="content-table-2-col-left">
					Alias
				</div>
				<div class="content-table-2-col-right">
					<?php if (empty($settings['alias'])) { ?>
						<div title="alias" class="editable">
							http://lunchsparks.me/pub/<span class="editable-value" style="font-weight: bold;"><?php echo !empty($settings['alias']) ? ($settings['alias']) : '<i>[username]</i>' ?></span>
						</div>
						<div style="display: none;">
							<input title="alias" type="text" value="<?php echo !empty($settings['alias']) ? ($settings['alias']) : '' ?>" placeholder="username" />
						</div>
					<?php } else { ?>
						<div title="alias">
							http://lunchsparks.me/pub/<span class="editable-value" style="font-weight: bold;"><?php echo !empty($settings['alias']) ? ($settings['alias']) : '<i>[username]</i>' ?></span>
						</div>
					<?php } ?>
					
				</div>
			</div>
			<div class="row-item">
				<div class="content-table-2-col-left">
					Public Location
				</div>
				<div class="content-table-2-col-right">
					<div title="location" class="editable">
						<span title="location" class="editable-value">
						<?php echo (isset($settings['location']) && !empty($settings['location'])) ? ($settings['location']) : '<i>location</i>' ?></span>
						</span>
					</div>
					<div style="display: none;">
						<input title="location" type="text" value="<?php echo !empty($settings['location']) ? ($settings['location']) : '' ?>" placeholder="location" />
					</div>
				</div>
			</div>
		</div>
		
		<div class="divider"></div>
		<div id="settings-delivery-preferences">
			<h3>Delivery</h3>
			<div class="row-item">
				<div class="content-table-2-col-left">
					Email
				</div>
				<div class="content-table-2-col-right">
					<div class="editable">
						<span title="delivery_email" class="editable-value"><?php echo !empty($settings['delivery_email']) ? ($settings['delivery_email']) : '<i>[email@example.com]</i>' ?></span>
					</div>
					<div style="display: none;">
						<input title="delivery_email" type="text" value="<?php echo !empty($settings['delivery_email']) ? ($settings['delivery_email']) : '' ?>" placeholder="email@example.com" />
					</div>
				</div>
			</div>
			<div class="row-item">
				<div class="content-table-2-col-left">
					Phone
				</div>
				<div class="content-table-2-col-right">
					<div class="editable">
						<span title="mobile_number" class="editable-value"><?php echo !empty($settings['mobile_number']) ? ($settings['mobile_number']) : '<i>[+6599998888]</i>' ?></span>
					</div>
					<div style="display: none;">
						<input title="mobile_number" type="text" value="<?php echo !empty($settings['mobile_number']) ? ($settings['mobile_number']) : '' ?>" placeholder="+6599998888" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
