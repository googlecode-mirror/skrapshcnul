<div class="places-name">
	<span><?php echo $places['name']; ?></span>
	<?php if(isset($places['verified_status']['status'])) { ?>
	<div id="profile-stats">
		<div id="user-verification" class="u-v-verified">
			<div class="user-verification-icon user-verfied"> </div>
			<div class="user-verification-text"> partners </div>
		</div>
	</div>
	<?php } ?>
</div>
<div class="others">
	<?php echo $places['location']; ?>
</div>