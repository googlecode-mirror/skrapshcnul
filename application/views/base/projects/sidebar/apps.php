<div id="ProjectExternalUrlsModel" class="widget-box-simple">
	<div class="widget-box-title">
		<h4 class="widget-title">Available on</h4>
	</div>
	<div class="widget-box-container">
		<ul>
			<?php if(!empty($project['apps']['ios_app_store_url'])) { ?>
				<li>
					<label>iOS Apps Store </label>
					<a href="<?php echo ($project['external_urls']['ios_app_store_url']) ?>"><?php echo ($project['external_urls']['ios_app_store_url']) ?></a>
				</li>
			<?php } ?>
			<?php if(!empty($project['apps']['android_market_url'])) { ?>
				<li>
					<label>Android Market </label>
					<a href="<?php echo ($project['external_urls']['android_market_url']) ?>"><?php echo ($project['external_urls']['android_market_url']) ?></a>
				</li>
			<?php } ?>
			<?php if(!empty($project['apps']['wp_market_url'])) { ?>
				<li>
					<label>Windows Phone Marketplace </label>
					<a href="<?php echo ($project['external_urls']['wp_market_url']) ?>"><?php echo ($project['external_urls']['wp_market_url']) ?></a>
				</li>
			<?php } ?>
		</ul>
	</div>
	<div class="clearfix"></div>
</div>
