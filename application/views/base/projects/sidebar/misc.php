<div class="widget-box-simple">
	<div class="widget-box-title">
		<h4 class="widget-title">Created by</h4>
	</div>
	<div class="widget-box-container">
		<ul class="others">
			<li>
				<?php if (isset($project['created_by'])) { ?> 
					<a href="<?php echo $project['created_by']['ls_pub_url']; ?>">
						<div class="profile-img-45 ls-profile-hover inset-image" ls-data-userid="<?php echo $project['created_by']['id'] ?>">
							<img title="<?php echo $project['created_by']['display_name'] ?>" src="<?php echo $project['created_by']['profile_img'] ?>" />
						</div>
					</a>
				<?php } ?>
			</li>
		</ul>
	</div>
	<div class="clearfix"></div>
</div>
