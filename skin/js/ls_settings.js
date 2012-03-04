
var JSON_URL = {
	settings: '/settings/overview?alt=json&callback=?',
	places: '/jsonp/places/update_field',
	projects: '/jsonp/projects/update_field'
}


jQuery(document).ready(function(){
	
	jQuery('.editable').click(function(){
		var el = jQuery(this);
		
		var action_url_id = (window.location.pathname).split('/')[1];
		
		el.hide();
		el.next().show();
		el.next().children('input').focus();
		el.next().children('input').change(function() {
			var oid = el.next().children('input').attr('ls-oid');
			var datafld = el.next().children('input').attr('title');
			if (datafld = '') {
				datafld = el.next().children('input').attr('name');
			}
			var value = el.next().children('input').val();
			jQuery.getJSON(JSON_URL[action_url_id], {
				datafld: datafld,
				value: value,
				oid: oid
			}, function(data){
				console.log(data);
				if(data.results) {
					console.log('Settings changed.');
					el.children('.editable-value').html(value);
				}
			});
		});
		el.next().children('input').focusout(function(){
			el.next().hide();
			el.show();
		});
	});
	
	jQuery('.toggleable').click(function(){
		var el = jQuery(this);
		var datafld = el.attr('title');
		console.log(datafld);
	});
	
});

jQuery(document).ready(function() {
	jQuery('.button_yes_no').click(function(){
		alert('in');
	});
});
