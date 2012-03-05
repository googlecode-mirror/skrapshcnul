<div class="dashboard-stream-box">
	
	<div class="dashboard-stream-box-top">
		<div class="title"> Projects that I've worked on  </div>
	</div>
	
	<div class="dashboard-stream-box-middle dashboard-stream-box-container">
		<div class="activity-stream">
			<?php if (isset($projects) && is_array($projects)) { ?>
				<?php foreach($projects as $key => $value) { ?>
					<div class="profile-img-thumb profile-img-80">
						<a class="has_tipsy" title="<?php echo $value['name'] ?>" href="/projects/<?php echo $value['project_id'] ?>">
							<img src="<?php echo $value['logo'] ?>" />
						</a>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>

<div class="clearfix">&nbsp;</div>
