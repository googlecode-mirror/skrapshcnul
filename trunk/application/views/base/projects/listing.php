<div class="m-content">
	<div id="places-container" class="c-pages shadow-rounded" style="padding: 0px;">
		<div style="padding:20px; min-height: 500px;">
			<h1><?php echo $tpl_page_title; ?></h1>
		
			<div id="ProjectsListingModel">
				<div id="masonry-container" data-bind="foreach: projects" class="">
					<div class="pin">
						<div class="pin-details">
							<div class="pin-image"><img data-bind='attr: {src: logo}' /></div>
							<div class="pin-data">
								<h3 data-bind='text: name'></h3>
								<div data-bind='text: description'></div>
							</div>
							<div class="pin-stats" data-bind="foreach: statistics">
								<span class="likes"><span data-bind="text: followers"></span> followers</span>
								<span class="likes"><span data-bind="text: favourites"></span> favourites</span>
							</div>
						</div>
						<div class="pin-extras" data-bind="foreach: tags">
							<div data-bind="foreach: tag_data">
								<div class="tag"> 
									<a data-bind="attr: {href: '/search/tag/'+name}">
										<span data-bind="text: name"></span>
									</a>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
</div>
<div class="clearfix">&nbsp;</div>

<script>
var initialData = <?php echo json_encode($projects); ?>;
 
var ProjectsListingModel = function(contacts) {
	var self = this;
	self.projects = ko.observableArray(ko.utils.arrayMap(contacts, function(contact) {
		return { 
			logo: contact.logo, 
			name: contact.name, 
			description: contact.description, 
			status: contact.status,
			statistics: ko.observableArray([contact.statistics]),
			tags: ko.observableArray(ko.utils.arrayMap(contact.tags, function(tags) {
				return {
					tag_data: ko.observableArray(ko.utils.arrayMap(tags.tags_data, function(tag_data) {
						return {
							name: tag_data.name
						}
					}))
				}
			}))
		};
	}));
	
	self.loadmore = function() {
    }
};

ko.applyBindings(new ProjectsListingModel(initialData), document.getElementById('ProjectsListingModel'));

jQuery('#masonry-container').imagesLoaded(function(){
	jQuery('#masonry-container').masonry({
		// options
		itemSelector : '.pin'
	});
});

jQuery(window).scroll(function () { 
   if (jQuery(window).scrollTop() >= jQuery(document).height() - jQuery(window).height() - 10) {
      if(window.console) console.log('end of page');
   }
});

</script>