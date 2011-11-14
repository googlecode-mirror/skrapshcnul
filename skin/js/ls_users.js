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
	jQuery(".steps-completed-item a").hover(
		function () {
			jQuery(this).children(".arrow").css('background-position', '0px -50px');
		},
		function () {
			jQuery(this).children(".arrow").css('background-position', '0px 0px');
		}
	);
	
	jQuery(".ls-h-m-icon").hover(
		function () {
			var bg_pos = (jQuery(this).css('background-position'));
			var bg_pos_y = bg_pos.split(" ",2)[1];
			jQuery(this).css('background-position', '-30px '+ bg_pos_y);
		},
		function () {
			var bg_pos = (jQuery(this).css('background-position'));
			var bg_pos_y = bg_pos.split(" ",2)[1];
			jQuery(this).css('background-position', '0px '+ bg_pos_y);
		}
	);
	
	
	var profile_card_index = 0; 
	var profile_card_total = jQuery(".ls_profile_card_container").size();
	//console.log('profile_card_total: '+profile_card_total);
	
	function profile_card_flip() {
		//console.log('profile_card_index: '+profile_card_index);
		jQuery("#ls_profile_card").flip({
			direction:'tb',
			speed:300,
			dontChangeColor: true,
			content: jQuery(".ls_profile_card_"+profile_card_index)
		});
		profile_card_index = profile_card_index + 1;
		if (profile_card_index >= profile_card_total) { profile_card_index = 0; }
		//console.log('profile_card_index: '+profile_card_index);
	}

	jQuery("#ls_profile_card").bind("click",function(){
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
	
	if (data.results.disabled) {
		el.button({'disabled':'true'});
	} else {
		el.button();
	}
}

jQuery(document).ready(function() {
	jQuery(".add-to-lunch-wishlist-btn").click(function() {
		var el = jQuery(this);
		var t_uid = el.attr('ls:t_uid');
		jQuery.getJSON('/json/addToLunchWishList', {target_user_id: t_uid}, function(data) {
				updateLuncWishlistBtn(el, data);
		});
	});
	
	jQuery.each(jQuery(".add-to-lunch-wishlist-btn"), function() {
		var el = jQuery(this);
		var t_uid = el.attr('ls:t_uid');
		jQuery.getJSON('/json/checkAddToLunchWishList', {target_user_id: t_uid}, function(data) {
				updateLuncWishlistBtn(el, data);
		});
	})
});