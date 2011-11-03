jQuery(document).ready(function(){
	jQuery('.editable').click(function(){
		var el = jQuery(this);
		el.hide();
		el.next().show();
		el.next().children('input').focus();
		el.next().children('input').change(function() {
			var datafld = el.next().children('input').attr('title');
			var value = el.next().children('input').val();
			jQuery.getJSON('/settings/overview?alt=json&callback=?', {
				datafld: datafld,
				value: value
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
