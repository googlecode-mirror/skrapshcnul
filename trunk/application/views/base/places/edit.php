<div class="m-content">
	<div id="places-container" class="c-pages shadow-rounded" style="padding: 10px;">
		<form id="update-places">
			<div class="section row-item">
				<div class="section-top">
					Place Information
					<div class="caption"></div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Logo
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="logo" class="editable-value"> <?php echo $places['logo'] ?> </span>
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
							<span title="name" class="editable-value"><?php echo $places['name']; ?></span>
						</div>
						<div style="display: none;">
							<input title="name" type="text" value="<?php echo $places['name']; ?>" placeholder="name" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Full Address
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="location" class="editable-value"><?php echo $places['location']; ?></span>
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
							<span title="geo_long" class="editable-value"><?php echo $places['geo_long']; ?></span>
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
							<span title="valid" class="editable-value"><?php echo $places['valid']; ?></span>
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
					Verification Status
					<div class="caption"></div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Status
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="status" class="editable-value"> <?php echo $places['verified_status']['status'] ?> </span>
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
							<span title="remarks" class="editable-value"><?php echo $places['verified_status']['remarks']; ?></span>
						</div>
						<div style="display: none;">
							<input title="remarks" type="text" value="<?php echo $places['verified_status']['remarks']; ?>" placeholder="remarks" ls-oid="<?php echo $places['place_id'] ?>">
						</div>
					</div>
				</div>
			</div>
			
			<div class="clearfix">&nbsp;</div>
			
		</form>
	</div>
</div>
<div class="clearfix">&nbsp;</div>
