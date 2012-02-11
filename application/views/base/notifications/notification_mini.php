<div id="notification-mini" class="overlay-frame">
	<div class="notification-header">
		<div class="title">
			Notifications
		</div>
	</div>
	<div class="notification-stream-xs">
		<?php if ($notifications) { ?>
			<?php foreach($notifications as $item) { ?>
			<div id="notification_<?php echo $item['id'] ?>" class="row-item notification-item-xs <?php echo (!$item['read_on']) ? "notification-new" : "" ?>">
				<div class="section-top-xs">
					<div class="message"></div><?php echo $item['message'];?>
				</div>
				<div class="section-middle-xs">
					<div class="clearfix metadata">
						<div class="notification-icon-xlhdpi <?php echo $item['component_class'];?>-xlhdpi">
							&nbsp;
						</div>
						<small><?php echo unix_to_human($item['created_on']);?></small>
					</div>
				</div>
			</div>
			<?php } ?>
		<?php } else { ?>
			<div class="content-unavailable">You have no notification at the moment.</div>
		<?php } ?>
	</div>
	<div class="notification-footer">
		<div>
			<?php echo anchor("notifications", "View All", array('class' => 'more', 'target' => '_parent'));?>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
