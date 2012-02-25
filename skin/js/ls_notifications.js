function bodyLoad() {
}


jQuery(document).click(function() {
	// Notification Bar Toggle
	var el = jQuery('#notifications-mini-area');
	if(el) {
		el.slideUp();
	}
});
function toggle_notifications() {
	resizeNotificationIframeToFitContent();
	var el = jQuery('#notifications-mini-area');
	// Bug Fix for first click
	if(el) {
		el.slideToggle();
		/*if(el.style.visibility == '') {
			el.style.visibility = 'hidden'
		};
		el.style.visibility = (el.style.visibility != 'hidden' ? 'hidden' : 'visible' );*/
	}
	return false;
}

function resizeNotificationIframeToFitContent() {
	// This function resizes an IFrame object to fit its content.
	var iframe = document.getElementById('notifications-mini-iframe');
	if(iframe != null) {
		var innerDoc = (iframe.contentWindow.document || iframe.contentDocument);
		//var not_area = document.getElementById('notifications-mini-area');
		var not_area = jQuery('#notifications-mini-area');

		//var element_height = innerDoc.getElementById('notification-mini').offsetHeight;
		var element_height = jQuery('#notification-mini').height();
		if(element_height)
			//not_area.style.height = element_height + 10 + "px";
			not_area.height(element_height + 10);
	}
}

function set_notification_toggle() {
	jQuery("#notification-toggle").click(function(event) {
		toggle_notifications();
		event.stopPropagation();
	});
}


jQuery(document).ready(function() {
	
	new LS_notifications();
	
	jQuery.getJSON("/json/getTotalUsers", function(data) {
		jQuery('#user-count').html(data);
	});
	jQuery.getJSON("/json/getTotalLunches", function(data) {
		jQuery('#lunches-count').html(data);
	});


});

var LS_notifications = function() {
	
	LS_notifications.init();
}

LS_notifications.init = function() {
	
	resizeNotificationIframeToFitContent();
	set_notification_toggle();

	// Refresh notification bar every 3 seconds
	refresh_notifications();
	// Schedule Refresh Interval
	setInterval("refresh_notifications()", 10000);
	
	/*jQuery('.unread-notification').hover(function() {
		var result = jQuery.post("/json/set_notifications_new_as_read", {
			'notification_id' : this.id
		}, function(data) {
			jQuery(this).removeClass('unread-notification');
		});
	});*/
	
	jQuery('.unread-notification').click(function() {
		LS_notifications.mark_as_read(this);
	});
}

LS_notifications.mark_as_read = function(notification_el) {
	var el = jQuery(notification_el);
	var notification_id = el.attr('ls-oid');
	var notification_url = el.attr('ls-url');
	jQuery.getJSON("/jsonp/notifications/set_notifications_as_read?alt=json&callback=?", {
		'notification_id' : notification_id
	}, function(data) {
		if (window.log) console.log(data);
		jQuery(this).removeClass('unread-notification');
		window.parent.location.href = notification_url;
	});
	
}

function refresh_notifications() {
	// TODO Set interval for Notification reload.
	// Check number of new notifications
	
	jQuery.getJSON("/json/check_notifications_new", function(data) {
		if(data) {
			jQuery('#notification-toggle-count').html(data);
			jQuery('#notification-toggle').addClass('hasNewNotifications');
			if (document.getElementById('notifications-mini-iframe'))
				document.getElementById('notifications-mini-iframe').contentDocument.location.reload(true);
		} else {
			jQuery('#notification-toggle-count').html('0');
			jQuery('#notification-toggle').removeClass('hasNewNotifications');
			console.log(jQuery('#notification-toggle'));
		}
	});
	// fresh frame src.
}
