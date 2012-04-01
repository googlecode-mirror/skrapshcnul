<div id="preferences" class="dashboard-stream-box well-container">
	
	<h3 class="dashboard-stream-box-top">
		Tags
	</h3>
	
	<div class="clearfix">&nbsp;</div>
	<?php if (!empty($preferences)) { ?>
		<?php foreach($preferences as $value) { ?>
			<div class="preferences-container">
				<div class="content-table-2-col-left preferences-container">
					<?php echo $value['preferences_name']; ?>
				</div>
				<div class="content-table-2-col-right">
					<?php foreach($value['data'] as $tag) { ?>
						<div class="preferences-data-item">
							<div class="tag" unused-class="preferences-data-item-content">
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
	<div class="clearfix">&nbsp;</div>
</div>