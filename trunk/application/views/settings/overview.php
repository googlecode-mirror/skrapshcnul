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
					Name
				</div>
				<div class="content-table-2-col-right">
					
				</div>
			</div>
			<div class="row-item">
				<div class="content-table-2-col-left">
					Username
				</div>
				<div class="content-table-2-col-right">
					http://lunchsparks.me/pub/<strong>username</strong>
				</div>
			</div>
			<div class="row-item">
				<div class="content-table-2-col-left">
					Password
				</div>
				<div class="content-table-2-col-right">
					<?php echo anchor('auth/change_password', 'Change Password', array('id'=>'change_password_btn')); ?>
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
					<input type="text" name="email" value="" />
				</div>
			</div>
			<div class="row-item">
				<div class="content-table-2-col-left">
					Phone
				</div>
				<div class="content-table-2-col-right">
					<input type="text" name="email" value="" />
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
