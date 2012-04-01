<div class="dashboard-stream-box well-container">
	
	<h3 class="dashboard-stream-box-top">
		Projects that I've worked on.
	</h3>
	
	<div class="dashboard-stream-box-middle dashboard-stream-box-container">
		<div class="activity-stream">
			<?php /* var_dump($projects); ?>
			
			<?php if (isset($projects) && is_array($projects)) { ?>
				<?php foreach($projects as $key => $value) { ?>
					<div class="span profile-img-thumb profile-img-80">
						<a class="has_tipsy" title="<?php echo $value['name'] ?>" href="/projects/<?php echo $value['project_id'] ?>">
							<img src="<?php echo $value['logo'] ?>" />
						</a>
					</div>
				<?php } ?>
			<?php } */ ?>
			<div id="ProjectsListingModel">
				<div id="masonry-container" data-bind="foreach: projects" class="">
					<div class="pin projects">
						<div class="pin-details">
							<a data-bind="attr: {href: '/projects/'+project_id}">
								<div class="pin-image"><img data-bind='attr: {src: logo}' /></div>
							</a>
							<div class="pin-data name">
								<a data-bind="attr: {href: '/projects/'+project_id}">
									<h3 data-bind='text: name'></h3>
								</a>
							</div>
							<div class="pin-data description">
								<div data-bind='text: description'></div>
							</div>
							<div class="pin-stats" data-bind="foreach: statistics">
								<span class="likes"><span data-bind="text: followers"></span> followers</span>
								<span class="likes"><span data-bind="text: favourites"></span> favourites</span>
							</div>
						</div>
						<div class="pin-extras tags" data-bind="foreach: tags">
							<div data-bind="foreach: tag_data">
								<div class="tag"> 
									<a data-bind="attr: {href: '/search/tag/'+name}">
										<span data-bind="text: name"></span>
									</a>
								</div>
							</div>
						</div>
						<div class="pin-extras team-members">
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
</div>

<div class="clearfix">&nbsp;</div>

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

</script>