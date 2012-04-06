<div id="ProjectExternalUrlsModel" class="widget-box-simple">
	<div class="widget-box-title">
		<h4 class="widget-title">External Links</h4>
	</div>
	<div class="widget-box-container">
		<ul class="unstyled">
			<?php $is_empty = TRUE; ?>
			<?php if(!empty($project['external_urls']['homepage'])) { ?>
				<?php $is_empty = FALSE; ?>
				<li>
					<label>Homepage </label>
					<span>
						<a href="<?php echo ($project['external_urls']['homepage']) ?>"><?php echo ($project['external_urls']['homepage']) ?></a>
					</span>
				</li>
			<?php } ?>
			<?php if(!empty($project['external_urls']['github_url'])) { ?>
				<?php $is_empty = FALSE; ?>
				<li>
					<label>Github </label>
					<span>
						<a href="<?php echo ($project['external_urls']['github_url']) ?>"><?php echo ($project['external_urls']['github_url']) ?></a>
					</span>
				</li>
			<?php } ?>
			<?php if(!empty($project['external_urls']['facebook_url'])) { ?>
				<?php $is_empty = FALSE; ?>
				<li>
					<label>Facebook </label>
					<span>
						<a href="<?php echo ($project['external_urls']['facebook_url']) ?>"><?php echo ($project['external_urls']['facebook_url']) ?></a>
					</span>
				</li>
			<?php } ?>
			<?php if(!empty($project['external_urls']['twitter_url'])) { ?>
				<?php $is_empty = FALSE; ?>
				<li>
					<label>Twitter </label>
					<span>
						<a href="<?php echo ($project['external_urls']['twitter_url']) ?>"><?php echo ($project['external_urls']['twitter_url']) ?></a>
					</span>
				</li>
			<?php } ?>
			<?php if(!empty($project['external_urls']['gplus_url'])) { ?>
				<?php $is_empty = FALSE; ?>
				<li>
					<label>Google+ </label>
					<span>
						<a href="<?php echo ($project['external_urls']['gplus_url']) ?>"><?php echo ($project['external_urls']['gplus_url']) ?></a>
					</span>
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
