function refresh_notifications() {
	// TODO Set interval for Notification reload.
	// Check number of new notifications
	jQuery.getJSON("<?php echo site_url('/json/check_notifications_new') ?>", function(data) {
		jQuery('#notification-toggle-count').html(data);
		if(data) {
			jQuery('#notification-toggle').css("background-color", "#FF0000");
			jQuery('#notification-toggle-count').css("color", "#FFFFFF");
		} else {
			jQuery('#notification-toggle').css("background-color", "#CCCCCC");
			jQuery('#notification-toggle-count').css("color", "#000000");
		}
	});
	// fresh frame src.
}

jQuery.getJSON("<?php echo site_url('/json/getTotalUsers') ?>", function(data) {
	jQuery('#user-count').html(data);
});