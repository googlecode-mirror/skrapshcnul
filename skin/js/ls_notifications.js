function bodyLoad() {
	resizeNotificationIframeToFitContent();
	set_notification_toggle();

	// Refresh notification bar every 3 seconds
	self.setInterval("refresh_notifications()",5000);
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

function refresh_notifications() {
	// TODO Set interval for Notification reload.
	
	//document.getElementById('txt').value=c;
	
	// fresh frame src.
}