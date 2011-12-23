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
		
		<?php $this -> load -> view('admin/recommendations/ongoing.php');?>
		
		<br /><br />
		
		<h2>Past Recommendations</h2>
		
		
		<div>Total records: <?php echo isset($results['past_recommendations_count']) ? $results['past_recommendations_count'] : 0; ?></div>
		
		<div>
			<?php if (!empty($results['past_recommendations'])) { ?>
			<table class="comfortable-table" cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>User</th>
						<th>Target</th>
						<th>Reason</th>
						<th>Created On</th>
						<th>Valid</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($results['past_recommendations'] as $user) { ?>
					<tr>
						<td><?php echo ($user['index']); ?></td>
						<td>
							<div class="ls-profile-hover" ls-data-userid="<?php echo ($user['user_id']); ?>">
								<?php echo ($user['user_id']); ?>
							</div>
						</td>
						<td>
							<div class="ls-profile-hover" ls-data-userid="<?php echo ($user['rec_id']); ?>">
								<?php echo ($user['rec_id']); ?>
							</div>
						</td>
						<td><?php echo ($user['rec_reason']); ?></td>
						<td><?php echo ($user['timestamp']); ?></td>
						<td><?php echo ($user['valid'] ? "Yes" : "No"); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php } else { ?>
				<div class="">No records found.</div>
			<?php }?>
		</div>
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
<script>
jQuery("#form_new_recommendation").submit(function() {
	alert('Handler for .submit() called.');
	var str = jQuery("#form_new_recommendation").serialize();
	jQuery('body').append(str);
  	return false;
});
</script>