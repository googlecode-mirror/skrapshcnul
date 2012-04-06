<div id="ProjectScreenshotsModel" class="screenshots">
	<div class="dashboard-stream-box-top">
		<div class="title"> Videos </div>
	</div>
	
	<div class="dashboard-stream-box-middle dashboard-stream-box-container">
		<div class="activity-stream">
			<?php if (isset($project['video_src']) && $project['video_src']) { ?>
				<?php echo $project['video_src'] ?>
			<?php } else { ?>
				 <div class="content-unavailable">
					No videos.
				 </div>
			<?php } ?>
		</div>
	</div>
</div>