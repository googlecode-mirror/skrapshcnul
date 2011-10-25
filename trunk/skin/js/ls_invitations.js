jQuery(document).ready( function() {
	
	jQuery('.withToolTip').focusin(function(){
		jQuery(this).next().show();
	});
	jQuery('.withToolTip').focusout(function(){
		jQuery(this).next().fadeOut('slow');
	});
	
	jQuery('#invitee_email_frm').submit(function() {
		var invitee_email = jQuery('input[name=invitee_email]').val();
		if (invitee_email) {
			// Enable caching
			jQuery.ajaxSetup({
				"error":function(XMLHttpRequest,textStatus, errorThrown) {   
			      console.log(textStatus);
			      console.log(errorThrown);
			      console.log(XMLHttpRequest.responseText);}
			});
			jQuery.getJSON('/invitations/invite', 
				{ alt: "json", invitee_email: invitee_email, call: 'sendInvitation'}, 
				function(data) {
					console.log(data.results);
					if(data.results) {
						jQuery('#invitee_email_results').html(data.results);
						jQuery('#invitee_email_results').parent().show().fadeOut(7000);
						check_invites_left();
					} else if(data.error) {
						jQuery('#invitee_email_results').html(data.error);
						jQuery('#invitee_email_results').parent().show().fadeOut(7000);
					}
			});
			
		} else {
			jQuery('input[name=invitee_email]').focus();
		}
		return false;
	});
	
});

function check_invites_left() {
	jQuery.getJSON('/invitations/invite', 
		{ alt: "json", call: 'checkInvitationLeft'}, 
		function(data) {
			jQuery('#invitation-left-number').hide();
			jQuery('#invitation-left-number').html(data);
			jQuery('#invitation-left-number').fadeIn('slow');
	});
}

function resendInvitation(invitee_email) {
	jQuery.getJSON('/invitations/invite', 
		{ alt: "json", call: 'resendInvitation', 'invitee_email': invitee_email}, 
		function(data) {
			console.log(data.results);
			if(data.results) {
				jQuery('#invitee_email_results').html(data.results);
				jQuery('#invitee_email_results').parent().show().fadeOut(7000);
				check_invites_left();
			} else if(data.error) {
				jQuery('#invitee_email_results').html(data.error);
				jQuery('#invitee_email_results').parent().show().fadeOut(7000);
			}
	});
}
