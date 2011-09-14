<div id="notification-mini" class="overlay-frame">
	<div class="notification-header">
		<div class="title">
			Notifications
		</div>
	</div>
	<div class="notification-stream">
		<?php foreach($notifications as $item) {
		?>
		<div class="notification-item">
			<div class="message"></div><?php echo $item['message'];?>
			<div class="clearfix metadata">
				<div class="notification-icon-xlhdpi <?php echo $item['component_class'];?>-xlhdpi">&nbsp;</div>
				<small><?php echo unix_to_human($item['created_on']);?></small>
			</div>
		</div>
		<?php }?>
	</div>
	<div class="notification-footer">
		<div>
			<?php echo anchor("notifications", "View All", array('class' => 'more', 'target' => '_parent'));?>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
