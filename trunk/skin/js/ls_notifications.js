function bodyLoad() {
	resizeNotificationIframeToFitContent();
	set_notification_toggle();

	// Refresh notification bar every 3 seconds
	refresh_notifications();
	// Schedule Refresh Interval
	setInterval("refresh_notifications()", 5000);
}


$(document).click(function() {
	// Notification Bar Toggle
	var el = document.getElementById('notifications-mini-area');
	if(el) {
		el.style.visibility = 'hidden';
	}
});
function toggle_notifications() {
	resizeNotificationIframeToFitContent();
	var el = document.getElementById('notifications-mini-area');
	// Bug Fix for first click
	if(el) {
		if(el.style.visibility == '') {
			el.style.visibility = 'hidden'
		};
		el.style.visibility = (el.style.visibility != 'hidden' ? 'hidden' : 'visible' );
	}
	return false;
}

function resizeNotificationIframeToFitContent() {
	// This function resizes an IFrame object to fit its content.
	var iframe = document.getElementById('notifications-mini-iframe');
	if(iframe) {
		var innerDoc = (iframe.contentWindow.document || iframe.contentDocument);
		var not_area = document.getElementById('notifications-mini-area');

		var element_height = innerDoc.getElementById('notification-mini').offsetHeight;
		if(element_height)
			not_area.style.height = element_height + 10 + "px";
	}
}

function set_notification_toggle() {
	$("#notification-toggle").click(function(event) {
		toggle_notifications();
		event.stopPropagation();
	});
}


$(document).ready(function() {
	$('.notification-new').hover(function() {
		var result = $.post("/json/set_notifications_new_as_read", {
			'notification_id' : this.id
		});
		$(this).stop().animate({
			backgroundColor : '#EEF0F9'
		}, 300);
	}, function() {
		$(this).stop().animate({
			backgroundColor : '#EEF0F9'
		}, 100);
	});
});

function set_notification_as_read (notification_id) {
  
}
