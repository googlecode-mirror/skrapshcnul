<div id="preferences">
	
	<?php if (!empty($preferences)) { ?>
		<?php foreach($preferences as $value) { ?>
			
			<div class="preferences-container">
			<div class="title">
				<?php echo $value['preferences_name']; ?>  
				<div class="description"><?php echo $value['description'] ?></div>
			</div>
			
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
		<?php } ?>
	<?php } ?>
	<div>How I like to add value</div>
	<div>What I'm looking for</div>
	<div>What I've done</div>
	<div></div>
	
	
	
</div>