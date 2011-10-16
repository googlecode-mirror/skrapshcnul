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
				scope.preferences[preference_id].data.push(tag_value);
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