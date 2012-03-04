<div id="ProjectTeamMemberModel" class="team_members">
	<div class="dashboard-stream-box-top">
		<div class="title"> Team Members </div>
	</div>
	<div class="dashboard-stream-box-middle dashboard-stream-box-container">
		<div class="activity-stream" data-bind="foreach: team_members">
			<a data-bind=" attr: {href: ls_pub_url}" target="_blank">
				<div data-bind="attr: { 'ls-data-userid': user_id }" class="profile-img-80 ls-profile-hover">
					<img data-bind="attr: { src: profile_img, title: display_name}" />
				</div>
			</a>
		</div>
	</div>
</div>
<script>
// TODO 
// Update data via JSON call.
var initialData = <?php echo (json_encode($project['team_members']));?>;

var ProjectTeamMemberModel = function(team_members) {
    var self = this;
    self.team_members = ko.observableArray(ko.utils.arrayMap(team_members, function(team_member) {
    	console.log(team_member.pub_profile);
        return { 
        	user_id: team_member.user_id,
        	display_name: team_member.pub_profile.display_name,
        	profile_img: team_member.pub_profile.profile_img,
        	ls_pub_url : team_member.pub_profile.ls_pub_url
        };
    }));
};
 
ko.applyBindings(new ProjectTeamMemberModel(initialData), document.getElementById("ProjectTeamMemberModel"));
</script>
