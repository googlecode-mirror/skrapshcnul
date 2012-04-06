<fieldset id="project-team-members">
	
	<div>
		
		<?php if (is_array($project['team_members']) && sizeof($project['team_members']) > 0) { ?>
			<?php foreach($project['team_members'] as $team_member) { ?>
				<?php $pub_profile = $team_member['pub_profile']; ?>
				<?php //var_dump($pub_profile) ?>
				 	<div class="pin">
						<div class="form-actions" style="margin:0;padding: 5px;">
							<div class="btn-group">
								<button class="btn dropdown-toggle" data-toggle="dropdown">Manage <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li class="divider"></li>
									<li><a href="#" onclick="remove_team_member(<?php echo $pub_profile['id'] ?>);"><i class="icon-trash"></i> Remove</a></li>
								</ul>
							</div>
						</div>
						<div class="pin-details">
							<a href="<?php echo $pub_profile['ls_pub_url'] ?>">
								<div class="pin-image">
									<img src="<?php echo $pub_profile['profile_img'] ?>" title="<?php echo $pub_profile['display_name'] ?>">
								</div>
							</a>
							<div class="pin-data">
								<a href="<?php echo $pub_profile['ls_pub_url'] ?>">
									<h3><?php echo $pub_profile['display_name'] ?></h3>
								</a>
								<div><?php echo $pub_profile['headline'] ?></div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
			<?php } ?>
		<?php } ?>
		
		<div class="clearfix">&nbsp;</div>
	
	</div>
	
</fieldset>

<div class="form-horizontal">
	<legend>Add New Member</legend>
	<div class="control-group">
		<label class="control-label" for="member_name">Name</label>
		<div class="controls">
			<input id="member_name" name="member_name" type="text" class="input-xlarge">
		</div>
	</div> 
</div>


<script>
$(function() {
	$( "input[name=member_name]" ).autocomplete({
		minLength: 2,
		source: function( request, response ) {
			console.log(this)
				var q = $( "input[name=member_name]" ).val();
				jQuery.getJSON('/jsonp/search/people?callback=?',
				{ 
					q: q,
				}, function(data) {
					response( jQuery.map( data.results, function( item ) {
						return {
							label: item.display_name,
							fullname: item.display_name,
							user_id: item.id,
							profile_img: item.profile_img,
							ls_pub_url : item.ls_pub_url,
							firstname : item.firstname,
							headline: item.headline 
						}
					}));
				});
		},
		focus: function( event, ui ) {
			$( "input[name=member_name]" ).val( ui.item.label );
			return false;
		},
		select: function( event, ui ) {
			add_new_team_member(ui.item.user_id);
			$( "input[name=member_name]" ).val( '' );
			return false;
		}
	})
	.data( "autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li></li>" )
			.data( "item.autocomplete", item )
			.append( "<a class='profile-autocomplete'><div class='image profile-img-50'><img src='" + item.profile_img + "'></div><div class='text'><div class='name'>" + item.label + "</div><div class='headline'> " + item.headline + "</div></div><div class='clearfix'></div></a>" )
			.appendTo( ul );
	};
});

function add_new_team_member(user_id) {
	
	var project_id = jQuery('input[name=project_id]').val()
	
	jQuery.getJSON('/jsonp/projects/add/members/?alt=json&callback=?', {
		user_id: user_id,
		project_id: project_id
	}, function(data) {
		if (data.results) {
			jQuery('#project-team-members').load(window.location.href + ' #project-team-members > div ');
		} else {
			if (window.console) console.warn(data.reason);
		}
	});
	
}

function remove_team_member(user_id) {
	
	var project_id = jQuery('input[name=project_id]').val()
	
	jQuery.getJSON('/jsonp/projects/remove/members/?alt=json&callback=?', {
		user_id: user_id,
		project_id: project_id
	}, function(data) {
		if (data.results) {
			jQuery('#project-team-members').load(window.location.href + ' #project-team-members > div ');
		} else {
			if (window.console) console.warn(data.reason);
		}
	});
	
}

</script>

<div class="clearfix">&nbsp;</div>