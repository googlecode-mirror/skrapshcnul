<div class="m-content">
	<div id="notification">
		<div class="notification-header">
			<div class="title">
				Notifications
			</div>
		</div>
		<div class="notification-stream">
			<?php foreach($notifications as $item) {
			?>
			<div class="notification-item">
				<?php echo $item['message'];?>
				<small><?php echo unix_to_human($item['created_on']);?></small>
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
</div>