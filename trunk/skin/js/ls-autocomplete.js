
var Ls_autocomplete = function() {
	
	Ls_autocomplete.urls = {
		places: "/jsonp/autocomplete/places?callback=?",
		users: "/jsonp/autocomplete/name?callback=?"
	}
	
	Ls_autocomplete.places();
	Ls_autocomplete.users();
}

	
Ls_autocomplete.places = function(data, callback) {
	
	jQuery('.ls-autocomplete-places').each( function() {
		var el = jQuery(this);
		el.autocomplete({
			source: function( request, response ) {
				var keywords = el.val();
				jQuery.getJSON(Ls_autocomplete.urls.places,
				{ 
					keywords: keywords,
				}, function(data) {
					response( jQuery.map( data.results, function( item ) {
						return {
							label: item.name,
							value: item.name,
							place_id: item.place_id
						}
					}));
				});
			},
			minLength: 2,
			select: function( event, ui ) {
				console.log( ui.item ?
					"Selected: " + ui.item.label :
					"Nothing selected, input was " + this.value);
				
				jQuery('input[name=event_location]').val(ui.item.place_id);
			},
			open: function() {
				jQuery( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				jQuery( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
	});
}

Ls_autocomplete.users = function() {
	
	jQuery('.ls-autocomplete-users').each( function() {
		var el = jQuery(this);
		el.autocomplete({
			source: function( request, response ) {
				var keywords = el.val();
				
				jQuery.getJSON(Ls_autocomplete.urls.users,
				{ 
					keywords: keywords,
				}, function(data) {
					//console.log(data);
					response( jQuery.map( data.results, function( item ) {
						return {
							label: item.firstname + (item.lastname ? ", " + item.lastname : ""),
							value: item.firstname + (item.lastname ? ", " + item.lastname : ""),
							user_id: item.user_id,
							profile_img: item.profile_img,
							ls_pub_url : item.lunchsparks,
							firstname : item.firstname
						}
					}));
				});
			},
			minLength: 2,
			select: function( event, ui ) {
				console.log( ui.item ?
					"Selected: " + ui.item.label :
					"Nothing selected, input was " + this.value);
				//el.next().val(ui.item.user_id);
				//el.parent().next().children(":first").attr('ls-data-userid', ui.item.user_id);
				el.parent().next().append(
					'<div class="container ls-profile-hover" ls-data-userid="'+ui.item.user_id+'">'+
						'<div class="profile-img-45 hover-profile-card inset-image" ls:uid="'+ui.item.user_id+'">'+
							'<a href="'+ui.item.ls_pub_url+'">'+
								'<img title="'+ui.item.firstname+'" src="'+ui.item.profile_img+'">'+
							'</a>'+
						'</div>'+
					'</div>'+
					'<input type="hidden" name="user_ids[]" value="'+ui.item.user_id+'" />' 
				).each(function(){
					profile_hover_init();
				});
			},
			open: function() {
				jQuery( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				jQuery( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				jQuery(this).val('');
			}
		});
	});
}
