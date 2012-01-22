jQuery(document).ready(function($) {
	// User verification
	jQuery("#user-verification").hover(function() {
		jQuery(".user-verification-text").show("slide", {
			direction : "left"
		}, 500);
	}, function() {
		jQuery(".user-verification-text").hide("slide", {
			direction : "left"
		}, 500);
	});
});
/*
 PreferenceCtrl.$inject = ['$resource', '$defer'];
 function PreferenceCtrl($resource,$defer) {
 var scope = this;
 //scope.preferences = <?php echo $preferences; ?>;

 scope.Preferences = $resource(
 '/user/preferences/:preference_id/:tag_value',
 { alt: 'json', preference_id:'@preference_id', tag_value:'@tag_value'},
 { get:   {method: 'GET', params: {call:'get'}},
 save:  {method: 'POST', params: {call:'save'}},
 dele:  {method: 'POST', params: {call:'delete'}},
 }
 );

 scope.preferences = scope.Preferences.get();

 scope.addTag = function(preference_id, tag_value) {
 try {
 var result = scope.Preferences.save({preference_id:preference_id, tag_value:tag_value});
 console.log(result);
 //scope.preferences[preference_id].data.push(tag_value);
 jQuery('#tag_value_'+preference_id).val('');
 } catch (e) {}
 };
 scope.deleteTag = function(preference_id, tag_value){
 try {
 var result = scope.Preferences.dele({preference_id:preference_id, tag_value:tag_value});
 console.log(result);
 } catch (e) {}
 };

 scope.refresh = function() {
 function poll() {
 scope.preferences = scope.preferences;
 $defer(poll, 3000);
 }
 poll();
 };
 scope.refresh();
 }

 PreferenceCtrl.prototype = {
 };
 */

jQuery(document).ready(function() {
	jQuery(".steps-completed-item a").hover(function() {
		jQuery(this).children(".arrow").css('background-position', '0px -50px');
	}, function() {
		jQuery(this).children(".arrow").css('background-position', '0px 0px');
	});

	jQuery(".ls-h-m-icon").hover(function() {
		var bg_pos = (jQuery(this).css('background-position'));
		var bg_pos_y = bg_pos.split(" ",2)[1];
		jQuery(this).css('background-position', '-30px ' + bg_pos_y);
	}, function() {
		var bg_pos = (jQuery(this).css('background-position'));
		var bg_pos_y = bg_pos.split(" ",2)[1];
		jQuery(this).css('background-position', '0px ' + bg_pos_y);
	});
	var profile_card_index = 0;
	var profile_card_total = jQuery(".ls_profile_card_container").size();
	//console.log('profile_card_total: '+profile_card_total);

	function profile_card_flip() {
		//console.log('profile_card_index: '+profile_card_index);
		jQuery("#ls_profile_card").flip({
			direction : 'tb',
			speed : 300,
			dontChangeColor : true,
			content : jQuery(".ls_profile_card_" + profile_card_index)
		});
		profile_card_index = profile_card_index + 1;
		if(profile_card_index >= profile_card_total) {
			profile_card_index = 0;
		}
		//console.log('profile_card_index: '+profile_card_index);
	}


	jQuery("#ls_profile_card").bind("click", function() {
		profile_card_flip();
		return false;
	});
	/* Initialize Profile Card */
	profile_card_flip();

	/* Initialize Add to Cart Button */

});
function updateLuncWishlistBtn(el, data) {
	console.log(data);
	if(data.results.followed) {
		el.button();
		el.children().html('Added To Lunch Wishlist');
		el.addClass('lw-btn-added');
	} else {
		el.button();
		el.children().html('Add To Lunch Wishlist');
		el.removeClass('lw-btn-added');
	}

	if(data.results.disabled) {
		el.button({
			'disabled' : 'true'
		});
	} else {
		el.button();
	}
}


jQuery(document).ready(function() {
	jQuery(".add-to-lunch-wishlist-btn").click(function() {
		var el = jQuery(this);
		var t_uid = el.attr('ls:t_uid');
		jQuery.getJSON('/json/addToLunchWishList', {
			target_user_id : t_uid
		}, function(data) {
			updateLuncWishlistBtn(el, data);
		});
	});

	jQuery.each(jQuery(".add-to-lunch-wishlist-btn"), function() {
		var el = jQuery(this);
		var t_uid = el.attr('ls:t_uid');
		jQuery.getJSON('/json/checkAddToLunchWishList', {
			target_user_id : t_uid
		}, function(data) {
			updateLuncWishlistBtn(el, data);
		});
	})
});
/* ## Profile Hover Card */
jQuery(document).ready(function() {
	profile_hover_init();
});

function profile_hover_init() {
	jQuery(".ls-profile-hover").hover(function(e) {
		// handlerIn 
		if (!jQuery(".ls-profile-card-holder").length > 0) {
			jQuery("body").append(jQuery('<div class="ls-profile-card-holder"></div>'));
		}
		
		var userid = jQuery(this).attr('ls-data-userid');
		if (userid) {
			generate_profile_card_html(userid);
		}
		jQuery(".ls-profile-card-holder").css('left', e.pageX);
		jQuery(".ls-profile-card-holder").css('top', e.pageY);
		jQuery(".ls-profile-card-holder").show('fade', 'slow');
	}, function() {
		// handlerOut
		jQuery(".ls-profile-card-holder").hide();
		jQuery(".ls-profile-card-holder").bind("mouseenter",function(){
			jQuery(".ls-profile-card-holder").show();
		}).bind("mouseleave",function(){
			jQuery(".ls-profile-card-holder").hide('fade', 'slow');
		});
		
	});
}

function generate_profile_card_html(userid) {
	
	// TODO: If element not exist
	// Get and Generate HTML
	jQuery.getJSON('/jsonp/people/'+userid+'?callback=?', {}, function(data) {
		if (data.results) {
			console.log(data.results[0]);
			var profile_img = data.results[0].profile_img;
			var display_name = data.results[0].display_name;
			var first_name = data.results[0].fullname.first;
			var last_name = data.results[0].fullname.last;
			var headline = data.results[0].headline;
			var ls_pub_url = data.results[0].ls_pub_url;
			
			var return_html = 
				'<a href="'+ls_pub_url+'">'+
					'<div class="profile-pic lunch-with profile-img-80">'+
						'<img title="'+display_name+'" src="'+profile_img+'">'+
					'</div>'+
				'</a>'+
				
				'<div class="profile-info">'+
					'<div class="name">'+
						'<a href="'+ls_pub_url+'">'+display_name+'</a>'+
					'</div>'+
					'<div class="headline">'+
						headline+
					'</div>'+
				'</div>'
			jQuery(".ls-profile-card-holder").html(jQuery(return_html));
			
			// To Handle text-overflow for headline
			var p = jQuery('.profile-info .headline');
			var divh = jQuery('.profile-info').height();
			divh = 50;
			while (jQuery(p).outerHeight()>divh) {
			    jQuery(p).text(function (index, text) {
			        return text.replace(/\W*\s(\S)*$/, '...');
			    });
			}
			
		}
		
	}); 
	
	
}
