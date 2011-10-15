<div class="m-content" ng:controller="PreferenceCtrl">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('user/includes/sidetab');?>
	</div>
	<div class="m-content-2-col-right">
		
		<div class="hr">
			<h2 class="hr-text">Preferences</h2>
		</div>
		<div>Enter your preferences here. Our system will pickup the keywords from here.</div>
		
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
						<a ng:click="removeTag(preference.id, tag)"> [x] </a>
					</div>
					<img src="/skin/images/tag_after.png" />
				</div>
			</div>
			<input type="text" name="tag_value" size="35" placeholder="New keywords here" style="display: inline-block;">
      		<input type="submit" value="add" ng:click="addTag(preference.id, tag_value)">
		</div>
	</div>
	<pre>{{preferences}}</pre>
	<pre>{{preferences2}}</pre>
	<pre>{{preferences3}}</pre>
	
	<script>
	
	PreferenceCtrl.$inject = ['$resource', '$defer'];
    function PreferenceCtrl($resource,$defer) {
		var scope = this;
		scope.preferences = <?php echo $preferences; ?>;
  		
  		scope.Preferences = $resource(
  			'/user/preferences',
		    {alt: 'json'},
			{ test: {method: 'GET', params: {}},
			  save: {method:'POST', params: {}},
			}
  		);
  		
  		//scope.preferences = scope.Preferences.get();
  		
		scope.addTag = function(preference_id, tag_value) {
			//scope.preferences[preference_id].data.push(tag_value);
			alert(preference_id + ', ' + tag_value);
			scope.preferences[preference_id].data = scope.Preferences.save({'preference_id': preference_id, 'tag_value': tag_value});
			//scope.preferences[preference_id].data = ["banking"," finanace"];
			//scope.todoText = '';
		};
   
		scope.remaining = function(){
			return angular.Array.count(scope.preferences.data, function(todo){
				return !todo.done;
			});
		};
   
		scope.removeDone = function() {
			var oldpreferences = scope.preferences;
			scope.preferences = [];
			angular.forEach(oldpreferences.data, function(todo) {
				if (!todo.done) scope.preferences.data.push(todo);
			});
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
    
	</script>
</div>
