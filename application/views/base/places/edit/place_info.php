<div class="places-name">
	
	<div class="editable" style="display: inline-block;">
		<span title="name" class="editable-value"><?php echo $places['name']; ?></span>
	</div>
	<div style="display: none;">
		<input title="name" type="text" value="<?php echo $places['name']; ?>" placeholder="name">
	</div>
	
	<?php if(isset($places['verified_status']['status'])) { ?>
	<div id="profile-stats">
		<div id="user-verification" class="u-v-verified">
			<div class="user-verification-icon user-verfied"> </div>
			<div class="user-verification-text"> verified </div>
		</div>
	</div>
	<?php } ?>
</div>
<div class="others">
	<?php echo $places['location']; ?>
</div>