<div class="m-content">
	<div id="places-container" class="c-pages shadow-rounded" style="padding: 10px;">
		<form id="update-places">
			<div class="section row-item">
				<div class="section-top">
					Place Information
					<div class="caption"></div>
				</div>
				
				<?php //var_dump($places) ?>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Logo
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="logo" class="editable-value">&nbsp;<?php echo $places['logo'] ?> </span>
						</div>
						<div style="display: none;">
							<input title="logo" type="text" value="<?php echo $places['logo'] ?>" placeholder="logo" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Name
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="name" class="editable-value">&nbsp;<?php echo $places['name']; ?></span>
						</div>
						<div style="display: none;">
							<input title="name" type="text" value="<?php echo $places['name']; ?>" placeholder="name" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Primary Phone
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="primary_phone" class="editable-value">&nbsp;<?php echo $places['primary_phone']; ?></span>
						</div>
						<div style="display: none;">
							<input title="primary_phone" type="text" value="<?php echo $places['primary_phone']; ?>" placeholder="name" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						URL
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="url" class="editable-value">&nbsp;<?php echo $places['url']; ?></span>
						</div>
						<div style="display: none;">
							<input title="url" type="text" value="<?php echo $places['url']; ?>" placeholder="name" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Full Address
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="location" class="editable-value">&nbsp;<?php echo $places['location']; ?></span>
						</div>
						<div style="display: none;">
							<input title="location" type="text" value="<?php echo $places['location']; ?>" placeholder="location" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Geo Latitude
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="geo_lat" class="editable-value">&nbsp;<?php echo $places['geo_lat']; ?> </span>
						</div>
						<div style="display: none;">
							<input title="geo_lat" type="text" value="<?php echo $places['geo_lat']; ?>" placeholder="geo_lat" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Geo Longitute
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="geo_long" class="editable-value">&nbsp;<?php echo $places['geo_long']; ?></span>
						</div>
						<div style="display: none;">
							<input title="geo_long" type="text" value="<?php echo $places['geo_long']; ?>" placeholder="geo_long" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Valid
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="valid" class="editable-value">&nbsp;<?php echo $places['valid']; ?></span>
						</div>
						<div style="display: none;">
							<input title="valid" type="text" value="<?php echo $places['valid']; ?>" placeholder="valid" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
			</div>
			
			<div class="clearfix">&nbsp;</div>
			
			<div class="section row-item">
				<div class="section-top">
					Restaurant Additional Information
					<div class="caption"></div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Cuisine
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="cuisine" class="editable-value">&nbsp;<?php echo $places['restaurant_info']['cuisine'] ?></span>
						</div>
						<div style="display: none;">
							<input title="cuisine" type="text" value="<?php echo $places['restaurant_info']['cuisine'] ?>" placeholder="cuisine" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Opening Hours
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="opening_hours" class="editable-value">&nbsp;<?php echo $places['restaurant_info']['opening_hours']; ?></span>
						</div>
						<div style="display: none;">
							<input title="opening_hours" type="text" value="<?php echo $places['restaurant_info']['opening_hours']; ?>" placeholder="opening_hours" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Special Features
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="special_features" class="editable-value">&nbsp;<?php echo $places['restaurant_info']['special_features']; ?></span>
						</div>
						<div style="display: none;">
							<input title="special_features" type="text" value="<?php echo $places['restaurant_info']['special_features']; ?>" placeholder="special_features" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Extras
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="extras" class="editable-value">&nbsp;<?php echo $places['restaurant_info']['extras']; ?></span>
						</div>
						<div style="display: none;">
							<input title="extras" type="text" value="<?php echo $places['restaurant_info']['extras']; ?>" placeholder="extras" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
			</div>
			
			<div class="clearfix">&nbsp;</div>
			
			<div class="section row-item">
				<div class="section-top">
					Verification Status
					<div class="caption"></div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Status
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="status" class="editable-value">&nbsp;<?php echo $places['verified_status']['status'] ?> </span>
						</div>
						<div style="display: none;">
							<input title="status" type="text" value="<?php echo $places['verified_status']['status'] ?>" placeholder="status" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Remarks
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="remarks" class="editable-value">&nbsp;<?php echo $places['verified_status']['remarks']; ?></span>
						</div>
						<div style="display: none;">
							<input title="remarks" type="text" value="<?php echo $places['verified_status']['remarks']; ?>" placeholder="remarks" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
			</div>
			
			<div class="clearfix">&nbsp;</div>
			
		</form>
		
		<div class="clearfix">&nbsp;</div>
		<div><a href="/places/<?php echo $places['place_id'] ?>" class="button">Back</a></div>
		<div class="clearfix">&nbsp;</div>
	</div>
</div>
<div class="clearfix">&nbsp;</div>
