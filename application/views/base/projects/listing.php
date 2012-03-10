<div class="m-content">
	<div id="places-container" class="c-pages shadow-rounded" style="padding: 0px;">
		<div style="padding:20px; min-height: 500px;">
			<h1><?php echo $tpl_page_title; ?></h1>
		
			<div id="ProjectsListingModel">
				<div id="masonry-container" data-bind="foreach: projects" class="">
					<div class="pin" data-bind="">
						<div class="pin-details">
							<a data-bind="attr: {href: '/projects/'+project_id}">
								<div class="pin-image"><img data-bind='attr: {src: logo}' /></div>
							</a>
							<div class="pin-data">
								<a data-bind="attr: {href: '/projects/'+project_id}">
									<h3 data-bind='text: name'></h3>
								</a>
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
						<div class="pin-extras">
							<h5>Team Members</h5>
							<div data-bind="foreach: team_members">
								<a data-bind="attr: {href: ls_pub_url, 'ls-data-userid': id}" class="profile-img-45 ls-profile-hover inset-image">
									<img data-bind="attr : {src: profile_img, title: display_name} " />
								</a>
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

<?php var_dump($projects[0]); ?>

<script>
var initialData = <?php echo json_encode($projects); ?>;
 
var ProjectsListingModel = function(projects) {
	var self = this;
	self.projects = ko.observableArray(ko.utils.arrayMap(projects, function(project) {
		return { 
			project_id: project.project_id,
			logo: project.logo, 
			name: project.name, 
			description: project.description, 
			status: project.status,
			external_urls: ko.observableArray([project.external_urls]),
			statistics: ko.observableArray([project.statistics]),
			team_members: ko.observableArray(ko.utils.arrayMap(project.team_members, function(team_member) {
				return {
					id: team_member.pub_profile.id,
					profile_img: team_member.pub_profile.profile_img,
					display_name: team_member.pub_profile.display_name,
					ls_pub_url: team_member.pub_profile.ls_pub_url
				}
			})),
			tags: ko.observableArray(ko.utils.arrayMap(project.tags, function(tags) {
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