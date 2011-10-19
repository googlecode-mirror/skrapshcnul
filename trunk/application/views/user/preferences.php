<div class="m-content" ng:controller="PreferenceCtrl">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('user/includes/sidetab');?>
	</div>
	<div class="m-content-2-col-right">
		
		<div class="hr">
			<h2 class="hr-text">Preferences</h2>
		</div>
		<div>Enter your preferences here. Our system will pickup the keywords from here.</div>
		
		<?php /* foreach(json_decode($preferences) as $value) { ?>
			<div class="preferences-container">
			<div class="title">
				<?php echo $value->preferences_name ?>  
				<div class="description"><?php echo $value->description ?></div>
			</div>
			<div class="preferences-data">
				<?php foreach($value->data as $tag) { ?>
				<div class="preferences-data-item">
					<img src="/skin/images/tag_before.png" />
					<div class="preferences-data-item-content">
						<?php echo $tag ?>
						<a ng:click="removeTag(preference.id, tag)"> [x] </a>
					</div>
					<img src="/skin/images/tag_after.png" />
				</div>
				<?php } ?>
			</div>
			<input type="text" id="tag_value_{{preference.id}}" name="tag_value_{{preference.id}}" size="35" placeholder="New keywords here" style="display: inline-block;">
      		<input type="submit" value="add" required="required" onclick="savePreferences({{preference.id}})">
		</div>
		<?php } */?>
		
		<div class="preferences-container" ng:repeat="preference in preferences">
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
						<?php /* <a ng:click="(preference.data).$remove(tag)"> [x] </a> */ ?>
					</div>
					<img src="/skin/images/tag_after.png" />
				</div>
			</div>
			<input type="text" id="tag_value_{{preference.preferences_ref_id}}" name="tag_value" size="35" placeholder="New keywords here" style="display: inline-block;">
      		<input type="submit" value="add" required="required" ng:click="addTag(preference.preferences_ref_id,tag_value);">
		</div>
	</div>
	
	<pre style="display: none;">{{preferences}}</pre>
	
	<script>
	
    
	</script>
</div>
