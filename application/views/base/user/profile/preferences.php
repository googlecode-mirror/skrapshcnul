<div id="preferences" class="dashboard-stream-box">
	
	<div class="dashboard-stream-box-top">
		<span class="title">
			<span class="user-icon-set u-i-s-dashboard-widget-icon"></span>
			Tags
		</span>
	</div>
	
	
	<?php if (!empty($preferences)) { ?>
		<?php foreach($preferences as $value) { ?>
			<div class="stream-item preferences-container">
				<div class="content-table-2-col-left preferences-container">
					<?php echo $value['preferences_name']; ?>
				</div>
				<div class="content-table-2-col-right">
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
		<?php } ?>
	<?php } ?>
	<div class="clearfix">&nbsp;</div>
</div>