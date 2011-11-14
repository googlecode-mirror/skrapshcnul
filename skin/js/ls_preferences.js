jQuery(document).ready(function() {
	/*jQuery('.preference-tag-btn-remove').click(function() {
		if(confirm('Are you sure you want to delete this tag?')) {
			var preference_id = escape(jQuery(this).attr('ls:pref_id'));
			var preference_tag = escape(jQuery(this).attr('ls:pref_tag'));
			
			
		}
	}); */
	
	jQuery('.preference-tag-btn-add').click(function() {
		//alert(preference_tag);
		var el = jQuery(this);
		var preference_id = escape(el.attr('ls:pref_id'));
		var preference_tag = escape(el.prev().val());
		
		jQuery.getJSON('/user/preferences', 
			{alt: 'json', call: 'save', preference_id: preference_id, preference_tag: preference_tag}, 
			function(data){
				console.log(data);
				if (data.results) {
					el.prev().val('');
					preference_tag = unescape(preference_tag);
					preference_tag_add_html(preference_id, preference_tag);
				}
		});
		
	});
});

function preference_tag_add_html(preference_id, preference_tag) {
	var el = jQuery(
		'<div class="preferences-data-item">'+
			'<img src="/skin/images/tag_before.png" />'+
			'<div class="preferences-data-item-content">'+
				preference_tag+
				' <a href="javascript:void(0)" class="preference-tag-btn-remove" ls:pref_id="'+preference_id+'" ls:pref_tag="'+preference_tag+'" onclick="preference_tag_delete(this)"> [x] </a>'+
			'</div>'+
			'<img src="/skin/images/tag_after.png" />'+
		'</div>');
	jQuery("#preferences-data-container-"+preference_id).append(el);
}

function preference_tag_delete(el) {
	
	var preference_id = escape(jQuery(el).attr('ls:pref_id'));
	var preference_tag = escape(jQuery(el).attr('ls:pref_tag'));
	
	jQuery.getJSON('/user/preferences', 
		{alt: 'json', call: 'delete', preference_id: preference_id, preference_tag: preference_tag}, 
		function(data){
			console.log(data);
			if (data.results) {
				preference_tag = unescape(preference_tag);
				jQuery(el).parent().parent().remove();
			}
	});
}

