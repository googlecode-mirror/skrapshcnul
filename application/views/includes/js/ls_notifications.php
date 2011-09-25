function refresh_notifications() {
	// TODO Set interval for Notification reload.
	// Check number of new notifications
	$.getJSON("<?php echo site_url('/json/check_notifications_new') ?>", function(data) {
		$('#notification-toggle-count').html(data);
		if(data) {
			$('#notification-toggle').css("background-position-y", -35);
			$('#notification-toggle-count').css("color", "#FFFFFF");
		} else {
			$('#notification-toggle').css("background-position-y", 0);
			$('#notification-toggle-count').css("color", "#000000");
		}
	});
	// fresh frame src.
}

$.getJSON("<?php echo site_url('/json/getTotalUsers') ?>", function(data) {
	$('#user-count').html(data);
});