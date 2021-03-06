<div id="preferences" class="dashboard-stream-box">
	
	<div class="dashboard-stream-box-top">
		<span class="title">
			<span class="user-icon-set u-i-s-dashboard-widget-icon"></span>
			Interest
		</span>
	</div>
	
	
	<?php if (!empty($preferences)) { ?>
		<?php foreach($preferences as $value) { ?>
		<div class="section row-item">
			<div class="section-top preferences-container">
				<?php echo $value['preferences_name']; ?>  
				<div class="caption"><?php echo $value['description'] ?></div>
			</div>
			
			<div class="section-middle preferences-container">
				<?php foreach($value['data'] as $tag) { ?>
					<div class="preferences-data-item">
						<div class="preferences-data-item-content">
							<a href="/search/tag/<?php echo $tag ?>">
								<div><?php echo $tag ?></div>
							</a>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="clearfix">&nbsp;</div>
		<?php } ?>
	<?php } ?>
	
</div>