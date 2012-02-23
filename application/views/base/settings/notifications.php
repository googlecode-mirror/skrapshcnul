<div class="m-content">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('settings/includes/sidetab');?>
	</div>
	<div class="m-content-2-col-right">
		<div class="hr">
			<h2 class="hr-text"><?php echo $tpl_page_title; ?></h2>
		</div>

		<div id="settings-system-notification">
			<h3>System Notifications</h3>
			<div class="row-item">
				<div class="content-table-2-col-left">
					When I receive system announcement
				</div>
				<div class="content-table-2-col-right">
					<div class="buttonset">
						<input class="toggleable" title="sys_ann_email" type="checkbox" id="check_sys_ann_email" /><label for="check_sys_ann_email">Email</label>
						<input class="toggleable" title="sys_ann_phone" type="checkbox" id="check_sys_ann_phone" /><label for="check_sys_ann_phone">Phone</label>
					</div>
				</div>
			</div>
			<div class="row-item">
				<div class="content-table-2-col-left">
					When I receive system notifications
				</div>
				<div class="content-table-2-col-right">
					<div class="buttonset">
						<input type="checkbox" id="check_sys_notif_email" /><label for="check_sys_notif_email">Email</label>
						<input type="checkbox" id="check_sys_notif_phone" /><label for="check_sys_notif_phone">Phone</label>
					</div>
				</div>
			</div>
		</div>
		
		<div id="settings-system-notification">
			<h3>Profile Notifications</h3>
			<div class="row-item">
				<div class="content-table-2-col-left">
					When I receive event notifications.
				</div>
				<div class="content-table-2-col-right">
					<div class="buttonset">
						<input type="checkbox" id="check_sys_event_email" /><label for="check_sys_event_email">Email</label>
						<input type="checkbox" id="check_sys_event_phone" /><label for="check_sys_event_phone">Phone</label>
					</div>
				</div>
			</div>
			<div class="row-item">
				<div class="content-table-2-col-left">
					When people add me to their lunch wishlist.
				</div>
				<div class="content-table-2-col-right">
					<div class="buttonset">
						<input type="checkbox" id="check_sys_lunch_wishlist_email" /><label for="check_sys_lunch_wishlist_email">Email</label>
						<input type="checkbox" id="check_sys_lunch_wishlist_phone" /><label for="check_sys_lunch_wishlist_phone">Phone</label>
					</div>
				</div>
			</div>
		</div>
		
		<div id="settings-system-notification">
			<h3>Desktop Notifications</h3>
			<div class="row-item">
				<div class="content-table-2-col-left">
					Chrome Notification
				</div>
				<div class="content-table-2-col-right">
					<div class="iphoneSwitch">
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
	<div class="clearfix"></div>
</div>


<?php 
if(!empty($settings['notification']['chrome_desktop_notification'])) {
	$chrome_desktop_notification = $settings['notification']['chrome_desktop_notification'] ? 'on' : 'off';
} else {
	$chrome_desktop_notification = 'off';
} 
?>

<script>jQuery(".buttonset").buttonset();</script>
<script>
jQuery(function() {
	jQuery( ".iphoneSwitch" ).iphoneSwitch("<?php echo $chrome_desktop_notification; ?>",
		function() {
			//$('#ajax').load('on.html');
			console.log('on');
			jQuery.getJSON('/settings/notifications?alt=json&callback=?', {
				datafld: 'chrome_desktop_notification',
				value: 1
			}, function(data) {
				//console.log(data);
			});
		},
		function() {
			//$('#ajax').load('off.html');
			console.log('off');
			jQuery.getJSON('/settings/notifications?alt=json&callback=?', {
				datafld: 'chrome_desktop_notification',
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