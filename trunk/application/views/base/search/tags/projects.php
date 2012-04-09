<div class="container">
	<div id="content" class="ProjectsListingModel masonry-container">
		<?php if (isset($projects) && is_array($projects)) { ?>
			<?php foreach($projects as $project) { ?>
				<div class="pin">
					<div class="pin-details">
						<a href="/projects/<?php echo $project['project_id'] ?>">
							<div class="pin-image"><img src="<?php echo $project['logo'] ?>" /></div>
						</a>
						<div class="pin-data">
							<a href="/projects/<?php echo $project['project_id'] ?>">
								<h3><?php echo $project['name'] ?></h3>
							</a>
							<div>
								<?php echo $project['description'] ?>
							</div>
						</div>
						<div class="pin-stats">
							<span class="likes"><?php echo $project['statistics']['followers'] ?> followers</span>
							<span class="likes"><?php echo $project['statistics']['favourites'] ?> favourites</span>
						</div>
					</div>
					<div class="pin-extras" data-bind="foreach: tags">
						<?php foreach($project['tags'] as $tag) { ?>
							<?php foreach($tag['tags_data'] as $tags_data) { ?>
								<div class="tag"> 
									<a href="/search/tag/<?php echo $tags_data['name'] ?>">
										<span><?php echo $tags_data['name'] ?></span>
									</a>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
					<div class="pin-extras">
						<h5>Team Members</h5>
						<?php foreach($project['team_members'] as $team_member) { ?>
							<?php $pub_profile = $team_member['pub_profile']; ?>
							<a href="<?php echo $pub_profile['ls_pub_url'] ?>" ls-data-userid="<?php echo $pub_profile['id'] ?>" class="profile-img-45 ls-profile-hover inset-image">
								<img src="<?php echo $pub_profile['profile_img'] ?>" title="<?php echo $pub_profile['display_name'] ?>" />
							</a>
						<?php } ?>
					</div>
					<div class="clearfix"></div>
				</div>
			
				<div class="navigation pagination-centered hidden">
					<ul>
						<li>
							<a href="<?php echo isset($pagination['next_page_url']) ? $pagination['next_page_url'] : ''; ?>">Load More</a>
						</li>
					</ul>
				</div>
			<?php } ?>
		<?php } else { ?>
			 
			<div class="content-unavailable">
				No result.
			</div>
			 
		<?php } ?>
	</div>
	
</div>
<div class="clearfix">&nbsp;</div>
