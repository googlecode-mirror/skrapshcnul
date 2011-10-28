<div class="m-content">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('settings/includes/sidetab');?>
	</div>
	<div class="m-content-2-col-right">
		<div class="hr">
			<h2 class="hr-text"><?php echo $tpl_page_title; ?></h2>
		</div>
		
		<div id="settings-system-security">
			<h3>Security Settings</h3>
			<div class="row-item">
				<div class="content-table-2-col-left">
					Password
				</div>
				<div class="content-table-2-col-right">
					<?php echo anchor('auth/change_password', 'Change Password', array('id'=>'change_password_btn')); ?>
					<script>jQuery('#change_password_btn').button();</script>
				</div>
			</div>
			<div class="row-item">
				<div class="content-table-2-col-left">
					Secure Browsing
				</div>
				<div class="content-table-2-col-right">
					<div class="iphoneSwitch">
					</div>
				</div>
			</div>
		</div>
		
		
		<p></p>
		<p>
			
		</p>
	</div>
	<div class="clearfix"></div>
</div>

<script>
jQuery(function() {
	jQuery( ".iphoneSwitch" ).iphoneSwitch("on",
	function() {
		//$('#ajax').load('on.html');
	},
	function() {
		//$('#ajax').load('off.html');
	},
	{
		switch_on_container_path: '/skin/js/jquery.iphone-switch/iphone_switch_container_on.png',
		switch_off_container_path: '/skin/js/jquery.iphone-switch/iphone_switch_container_off.png',
		switch_path: '/skin/js/jquery.iphone-switch/iphone_switch.png',
	});
	
});
</script>