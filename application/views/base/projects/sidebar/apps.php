<div id="ProjectExternalUrlsModel" class="widget-box-simple">
	<div class="widget-box-title">
		<h4 class="widget-title">Available on</h4>
	</div>
	<div class="widget-box-container">
		<ul class="unstyled">
			<?php $is_empty = TRUE; ?>
			<?php if(!empty($project['apps']['ios_app_store_url'])) { ?>
				<?php $is_empty = FALSE; ?>
				<li>
					<span class="label label-info">iOS Apps Store</span> <a href="<?php echo ($project['apps']['ios_app_store_url']) ?>">link</a>
				</li>
			<?php } ?>
			<?php if(!empty($project['apps']['android_market_url'])) { ?>
				<?php $is_empty = FALSE; ?>
				<li>
					<span class="label label-info">Android Market</span> <a href="<?php echo ($project['apps']['android_market_url']) ?>">link</a>
				</li>
			<?php } ?>
			<?php if(!empty($project['apps']['wp_market_url'])) { ?>
				<?php $is_empty = FALSE; ?>
				<li>
					<span class="label label-info">Windows Phone Marketplace</span> <a href="<?php echo ($project['apps']['wp_market_url']) ?>">link</a>
				</li>
			<?php } ?>
			<?php if($is_empty) { ?>
				<div class="content-unavailable">
					No links.
				</div>
			<?php } ?>
		</ul>
	</div>
	<div class="clearfix"></div>
</div>