<div class="m-content">
	<div id="notification" class="c-pages shadow-rounded">
		<h2><?php echo $tpl_page_title; ?></h2>
		<h3 class="sub-heading"></h3>
		
		<div class="row-item">
			<div class="section-top notification-header">
				<div class="title">
					Notifications
				</div>
			</div>
			<div class="section-middle notification-stream ">
				<?php if ($notifications) { ?>
					<?php foreach($notifications as $item) { ?>
					<div class="notification-item">
						<span><?php echo $item['message'];?></span>
						<a href="<?php echo $item['url'] ?>"><small><?php echo unix_to_human($item['created_on']);?></small></a>
					</div>
					<?php }?>
				<?php } else { ?>
					<div class="content-unavailable-xl">You have no notification at the moment.</div>
				<?php } ?>
			</div>
		</div>
		<div class="notification-footer">
			&nbsp;
		</div>
	</div>
</div>