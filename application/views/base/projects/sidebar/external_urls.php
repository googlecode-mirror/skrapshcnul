<div id="ProjectExternalUrlsModel" class="widget-box-simple">
	<div class="widget-box-title">
		<h4 class="widget-title">External Links</h4>
	</div>
	<div class="widget-box-container">
		<ul>
			<?php if(!empty($project['external_urls']['homepage'])) { ?>
				<li>
					<label>Homepage </label>
					<a href="<?php echo ($project['external_urls']['homepage']) ?>"><?php echo ($project['external_urls']['homepage']) ?></a>
				</li>
			<?php } ?>
			<?php if(!empty($project['external_urls']['github_url'])) { ?>
				<li>
					<label>Github </label>
					<a href="<?php echo ($project['external_urls']['github_url']) ?>"><?php echo ($project['external_urls']['github_url']) ?></a>
				</li>
			<?php } ?>
			<?php if(!empty($project['external_urls']['facebook_url'])) { ?>
				<li>
					<label>Facebook </label>
					<a href="<?php echo ($project['external_urls']['facebook_url']) ?>"><?php echo ($project['external_urls']['facebook_url']) ?></a>
				</li>
			<?php } ?>
			<?php if(!empty($project['external_urls']['twitter_url'])) { ?>
				<li>
					<label>Twitter </label>
					<a href="<?php echo ($project['external_urls']['twitter_url']) ?>"><?php echo ($project['external_urls']['twitter_url']) ?></a>
				</li>
			<?php } ?>
			<?php if(!empty($project['external_urls']['gplus_url'])) { ?>
				<li>
					<label>Google+ </label>
					<a href="<?php echo ($project['external_urls']['gplus_url']) ?>"><?php echo ($project['external_urls']['gplus_url']) ?></a>
				</li>
			<?php } ?>
		</ul>
	</div>
	<div class="clearfix"></div>
</div>
