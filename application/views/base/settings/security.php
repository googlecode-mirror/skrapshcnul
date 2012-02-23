<div class="m-content">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('base/settings/includes/sidetab');?>
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
					<div id="secure_browsing_switch">
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

<?php 
if(!empty($settings['security']['secure_browsing'])) {
	$secure_browsing = $settings['security']['secure_browsing'] ? 'on' : 'off';
} else {
	$secure_browsing = 'off';
} 
?>

<script>
jQuery(function() {
	jQuery( "#secure_browsing_switch" ).iphoneSwitch('<?php echo $secure_browsing; ?>',
	function() {
		//$('#ajax').load('on.html');
		console.log('on');
		jQuery.getJSON('/settings/security?alt=json&callback=?', {
			datafld: 'secure_browsing',
			value: 1
		}, function(data) {
			//console.log(data);
		});
	},
	function() {
		//$('#ajax').load('off.html');
		console.log('off');
		jQuery.getJSON('/settings/security?alt=json&callback=?', {
			datafld: 'secure_browsing',
			value: 0
		}, function(data) {
			//console.log(data);
		});
	},
	{
		switch_on_container_path: '/skin/js/jquery.iphone-switch/iphone_switch_container_on.png',
		switch_off_container_path: '/skin/js/jquery.iphone-switch/iphone_switch_container_off.png',
		switch_path: '/skin/js/jquery.iphone-switch/iphone_switch.png',
	});
	
});
</script>