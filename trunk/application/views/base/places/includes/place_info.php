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
<div class="row-fluid">
	<div class="span3">Location</div>
	<div class="span9">
		<?php echo isset($places['location']) ? $places['location'] : ""; ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span3">Phone</div>
	<div class="span9">
		<?php echo isset($places['primary_phone']) ? $places['primary_phone'] : ""; ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span3">Homepage</div>
	<div class="span9">
		<?php echo isset($places['url']) ? $places['url'] : ""; ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span3">Cuisine</div>
	<div class="span9">
		<?php echo isset($places['restaurant_info']['cuisine']) ? $places['restaurant_info']['cuisine'] : ""; ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span3">Opening Hours</div>
	<div class="span9">
		<?php echo isset($places['restaurant_info']['opening_hours']) ? $places['restaurant_info']['opening_hours'] : ""; ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span3">Special Features</div>
	<div class="span9">
		<?php echo isset($places['restaurant_info']['special_features']) ? $places['restaurant_info']['special_features'] : ""; ?>
	</div>
</div>
<div class="row-fluid">
	<?php echo isset($places['restaurant_info']['extras']) ? $places['restaurant_info']['extras'] : ""; ?>
</div>
