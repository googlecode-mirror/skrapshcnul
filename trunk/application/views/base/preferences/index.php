<?php ## <div class="m-content" ng:controller="PreferenceCtrl"> ?>
<div class="m-content"">
	<div class="c-pages shadow-rounded">
		
		<h2><?php echo $tpl_page_title; ?></h2>
		<h3 class="sub-heading">Enter your preferences here. Our system will pickup the keywords from here.</h3>
		
		<?php if (!empty($preferences)) { ?>
			<?php foreach($preferences as $value) { ?>
				<div class="row-item preferences-container">
					<div class="section-top">
						<?php echo $value['preferences_name']; ?>  
						<div class="caption"><?php echo $value['description'] ?></div>
					</div>
					<div class="section-middle preferences-data">
						<div id="preferences-data-container-<?php echo $value['preferences_ref_id']; ?>" class="preferences-data-container">
							<?php foreach($value['data'] as $tag) { ?>
								<div class="preferences-data-item">
									<div class="preferences-data-item-content">
										<a href="/search/tag/<?php echo $tag ?>">
											<div>
												<span></span><?php echo $tag ?>
												<a href="javascript:void(0)" class="preference-tag-btn-remove" ls:pref_id="<?php echo $value['preferences_ref_id']; ?>" ls:pref_tag="<?php echo $tag; ?>" onclick="preference_tag_delete(this)"> [x] </a>
											</div>
										</a>
									</div>
								</div>
							<?php } ?>
						</div>
						<input type="text" id="tag_value_<?php echo $value['preferences_ref_id']; ?>" class ="ls_user_autocomplete" name="tag_value_<?php echo $value['preferences_ref_id']; ?>" size="35" placeholder="Entrepreneur, Technical, Anyone" style="display: inline-block;">
			      		<input type="submit" value="add" required="required" class="preference-tag-btn-add" ls:pref_id="<?php echo $value['preferences_ref_id']; ?>" />
					</div>
				</div>
				<div class="clearfix">&nbsp;</div>
			<?php } ?>
			
			<?php /* ?><div class="preferences-container" ng:repeat="preference in preferences">
				<div class="title">
					{{preference.preferences_name}} 
					<div class="description">{{preference.description}}</div>
				</div>
				<div class="preferences-data">
					<div class="preferences-data-item" ng:repeat="tag in (preference.data)">
						<img src="/skin/images/tag_before.png" />
						<div class="preferences-data-item-content">
							{{tag}}
							<a ng:click="deleteTag(preference.preferences_ref_id, tag);(preference.data).$remove(tag)"> [x] </a>
							<?php ## <a ng:click="(preference.data).$remove(tag)"> [x] </a> ?>
						</div>
						<img src="/skin/images/tag_after.png" />
					</div>
				</div>
				<input type="text" id="tag_value_{{preference.preferences_ref_id}}" name="tag_value" size="35" placeholder="New keywords here" style="display: inline-block;">
	      		<input type="submit" value="add" required="required" ng:click="addTag(preference.preferences_ref_id,tag_value);(preference.data).$add(tag_value)">
			</div>
			<?php */?>
		
		<?php } ?>
	</div>
	
	<pre style="display: none;">{{preferences}}</pre>
	
	<script>
	
    
	</script>
	<script>
jQuery('.ls_user_autocomplete').each( function() {
	var el = jQuery(this);
	el.autocomplete({
		source: function( request, response ) {
			var keywords = el.val();
			
			jQuery.getJSON("/jsonp/autocomplete/network?callback=?",
			{ 
				keywords: keywords,
				tag_value : this.id,
			}, function(data) {
				//console.log(data);
				response( jQuery.map( data.results, function( item ) {
					return {
						label: item.keywords,
						value: item.keywords,
					}
				}));
			});
		},
		minLength: 2,
		select: function( event, ui ) {
			console.log( ui.item ?
				"Selected: " + ui.item.label :
				"Nothing selected, input was " + this.value);
			//el.next().val(ui.item.label);			
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
	//alert('Handler for .submit() called.');
	var str = jQuery("#form_new_recommendation").serialize();
	jQuery('body').append(str);
  	return false;
});
</script>
</div>
