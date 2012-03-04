<div class="cover_background">
	<?php if(isset($project['cover_img'])) { ?>
		<img src="<?php echo isset($project['cover_img']) ? $project['cover_img'] : ""; ?>">
	<?php } ?>
</div>

<div class="after_cover_background">
	<div class="after-cover-background-inner dashboard-featured-container">
		<div class="dashboard-featured-logo">
			<?php if(isset($project['logo'])) { ?>
				<img src="<?php echo isset($project['logo']) ? $project['logo'] : ''; ?>" />
			<?php } ?>
		</div>
		<div class="dashboard-featured-data">
			<div class="name">
				<span><?php echo $project['name']; ?></span>
				<?php if(isset($project['verified_status']['status']) && $project['verified_status']['status']) { ?>
					<div id="profile-stats">
						<div id="user-verification" class="u-v-verified">
							<div class="user-verification-icon user-verfied"> </div>
							<div class="user-verification-text"> verified </div>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="others">
				<?php if (isset($project['tags']['tags_data']) && sizeof($project['tags']['tags_data']) > 0) { ?>
					<?php foreach ($project['tags']['tags_data'] as $tags) { ?>
						<div class="tag"> 
							<a href="/search/tag/<?php echo $tags ?>">
								<?php echo $tags ?>
							</a>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
			<div class="others">
				<?php if (isset($project['external_urls']['homepage'])) { ?>
					<a href="<?php echo  $project['external_urls']['homepage'] ?>">
						<?php echo  $project['external_urls']['homepage'] ?>
					</a>
				<?php } ?>
			</div>
			<div class="others">
			</div>
		</div>
		<div class="dashboard-featured-statistics">
			<div class="ratings">
				<div class="rating-points">
					<span class="points"><?php echo $project['statistics']['followers']; ?></span>
					<div class="fields">Followers</div>
				</div>
			</div>
			
			<div class="ratings">
				<div class="rating-points">
					<span class="points"><?php echo $project['statistics']['favourite']; ?></span>
					<div class="fields" style="">Favourite</div>
				</div>
			</div>
		</div>
	</div>
</div>