<div id="ProjectExternalUrlsModel" class="widget-box-simple">
	<div class="widget-box-title">
		<h4 class="widget-title">Available on</h4>
	</div>
	<div class="widget-box-container">
		<ul>
			<?php if(!empty($project['apps']['ios_app_store_url'])) { ?>
				<li>
					<span class="label label-info">iOS Apps Store</span> 
					<a href="<?php echo ($project['apps']['ios_app_store_url']) ?>"><?php echo ($project['apps']['ios_app_store_url']) ?></a>
				</li>
			<?php } ?>
			<?php if(!empty($project['apps']['android_market_url'])) { ?>
				<li>
					<span class="label label-info">Android Market</span> 
					<a href="<?php echo ($project['apps']['android_market_url']) ?>"><?php echo ($project['apps']['android_market_url']) ?></a>
				</li>
			<?php } ?>
			<?php if(!empty($project['apps']['wp_market_url'])) { ?>
				<li>
					<span class="label label-info">Windows Phone Marketplace</span> 
					<a href="<?php echo ($project['apps']['wp_market_url']) ?>"><?php echo ($project['apps']['wp_market_url']) ?></a>
				</li>
			<?php } ?>
		</ul>
	</div>
	<div class="clearfix"></div>
</div>
