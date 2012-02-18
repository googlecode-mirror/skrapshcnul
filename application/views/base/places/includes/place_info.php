<div class="places-name">
	<span><?php echo $places['name']; ?></span>
	<?php if(isset($places['verified_status']['status']) && $places['verified_status']['status']) { ?>
		<div id="profile-stats">
			<div id="user-verification" class="u-v-verified">
				<div class="user-verification-icon user-verfied"> </div>
				<div class="user-verification-text"> partners </div>
			</div>
		</div>
	<?php } ?>
</div>
<div class="others">
<label>Location:</label> <?php echo $places['location']; ?>
</div>
<div class="others">
<label>Phone:</label> <?php echo $places['primary_phone']; ?>
</div>
<div class="others">
<label>Homepage:</label> <?php echo $places['url']; ?>
</div>
<div class="others">
<label>Cuisine:</label> <?php echo $places['restaurant_info']['cuisine']; ?>
</div>
<div class="others">
<label>Opening Hours:</label> <?php echo $places['restaurant_info']['opening_hours']; ?>
</div>
<div class="others">
<label>Special Features:</label> <?php echo $places['restaurant_info']['special_features']; ?>
</div>
<div class="others">
<?php echo $places['restaurant_info']['extras']; ?>
</div>