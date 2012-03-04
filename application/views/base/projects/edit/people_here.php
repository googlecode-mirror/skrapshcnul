<div class="dashboard-stream-box">
		
	<div class="dashboard-stream-box-top">
		<span class="title">
			<span class="user-icon-set u-i-s-dashboard-widget-icon"></span>
			People had lunches here
		</span>
	</div>
	
	<div class="dashboard-stream-box-middle dashboard-stream-box-container">
		<div class="activity-stream">
			<?php if (!isset($places['recent_lunches']) || !empty($places['recent_lunches'])) { ?>
				<?php foreach($places['recent_lunches'] as $recent_lunch) { ?>
					<div class="stream-item">
						<div class="stream-item-2-col-left">
						</div>
						<div class="stream-item-2-col-right stream-content">
						</div>
					</div>
				<?php } ?>
			<?php } else { ?>
				<div class="content-unavailable">
					No people so far. Want to be the first? :)
				</div>
			<?php } ?>
		</div>
	</div>
	
</div>

<div class="clearfix">&nbsp;</div>