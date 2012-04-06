<legend>Tags </legend>

<div id="ProjectsTagsModel">
	<div data-bind="foreach: tags">
		
		<div data-bind="text: tags_type_name" class="content-table-2-col-left"></div>
		
		<div class="content-table-2-col-right">
			<div data-bind="foreach: tags_data">
				<div class="tag"> 
					<a data-bind="attr: {href: '/search/tag/'+name}">
						<span data-bind="text: name"></span>
					</a>
					<a href='#' data-bind='click: $root.removeTag'>[x]</a>
				</div>
			</div>
			<div class="edit-control form-horizontal">
				<input type="text" name="add_tag" placeholder="Add tag" style="display: inline-block; vertical-align: middle;" />
				<button class="btn btn-small" data-bind='click: $root.addTag'>Add</button>
			</div>
		</div>
		
	</div>
</div>
<script>
var initialData = <?php echo json_encode($project['tags']) ?>;
 
var ProjectsTagsModel = function(contacts) {
	var self = this;
	
	self.tags = ko.observableArray(ko.utils.arrayMap(contacts, function(contact) {
		return { 
			project_id: contact.project_id,
			tags_type_id: contact.tags_type_id, 
			tags_type_name: contact.tags_type_name, 
			updated_on: contact.updated_on, 
			tags_data: ko.observableArray(ko.utils.arrayMap(contact.tags_data, function(tag_data) {
				return {
					name: tag_data.name
				};
			}))
		};
	}));
	
	self.addTag = function(tags) {
		tags.tags_data.push({
			name: jQuery('input[name=add_tag]').val()
		});
		jQuery('input[name=add_tag]').val('');
		self.save();
	};
	
	self.removeTag = function(tag) {
		jQuery.each(self.tags(), function() { this.tags_data.remove(tag) });
		self.save();
	};
	
	self.save = function() {
		var value = (JSON.stringify(ko.toJS(self.tags)));
		jQuery.getJSON('/jsonp/projects/update_tags?alt=json&callback=?', {
			value: value
		}, function(data) {
			console.log(data);
			// TODO 
		});
	};
};

ko.applyBindings(new ProjectsTagsModel(initialData), document.getElementById("ProjectsTagsModel"));
</script>


