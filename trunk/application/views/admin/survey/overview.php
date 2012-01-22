<div class="m-content">
	<div id="announcements" class="shadow">
	</div>
	
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('admin/includes/sidetab');?>
	</div>
	
	<div class="m-content-2-col-right">
		
		<div class="hr">
			<h2 class="hr-text"><?php echo $tpl_page_title; ?></h2>
		</div>
		
		<div class="clearfix">&nbsp;</div>
		
		<?php $this -> load -> view('admin/survey/completed.php'); ?>
		
		<div class="clearfix">&nbsp;</div>
		
		<?php $this -> load -> view('admin/survey/incomplete.php'); ?>
		
		<div class="clearfix">&nbsp;</div>
		
	</div>
</div>

<script>
jQuery('.ls_user_autocomplete').each( function() {
	var el = jQuery(this);
	el.autocomplete({
		source: function( request, response ) {
			var keywords = el.val();
			jQuery.getJSON("/jsonp/autocomplete/name?callback=?",
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
			el.next().val(ui.item.user_id);
			el.parent().next().children().attr('ls-data-userid', ui.item.user_id);
			el.parent().next().children().html(
				'<div class="profile-img-45 hover-profile-card" ls:uid="'+ui.item.user_id+'">'+
					'<a href="'+ui.item.ls_pub_url+'">'+
						'<img title="'+ui.item.firstname+'" src="'+ui.item.profile_img+'">'+
					'</a>'+
				'</div>'
			);
			
		},
		open: function() {
			jQuery( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
		},
		close: function() {
			jQuery( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
		}
	});
});
</script>