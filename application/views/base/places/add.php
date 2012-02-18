<div class="m-content">
	<div id="places-container" class="c-pages shadow-rounded" style="padding: 10px;">
		<form method="post" id="add-places">
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
						<input name="logo" title="logo" type="text" value="" placeholder="logo">
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Name
					</div>
					<div class="content-table-2-col-right">
						<input name="name" title="name" type="text" value="" placeholder="name">
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Primary Phone
					</div>
					<div class="content-table-2-col-right">
						<input name="primary_phone" title="primary_phone" type="text" value="" placeholder="name">
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						URL
					</div>
					<div class="content-table-2-col-right">
						<input name="url" title="url" type="text" value="" placeholder="name">
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Full Address
					</div>
					<div class="content-table-2-col-right">
						<input name="location" title="location" type="text" value="" placeholder="location">
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Geo Latitude
					</div>
					<div class="content-table-2-col-right">
						<input name="geo_lat" title="geo_lat" type="text" value="" placeholder="geo_lat">
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Geo Longitute
					</div>
					<div class="content-table-2-col-right">
						<input name="geo_long" title="geo_long" type="text" value="" placeholder="geo_long">
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Valid
					</div>
					<div class="content-table-2-col-right">
						<input name="valid" title="valid" type="text" value="" placeholder="valid">
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
						<input name="cuisine" title="cuisine" type="text" value="" placeholder="cuisine">
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Opening Hours
					</div>
					<div class="content-table-2-col-right">
						<input name="opening_hours" title="opening_hours" type="text" value="" placeholder="opening_hours">
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Special Features
					</div>
					<div class="content-table-2-col-right">
						<input name="special_features" title="special_features" type="text" value="" placeholder="special_features">
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Extras
					</div>
					<div class="content-table-2-col-right">
						<input name="extras" title="extras" type="text" value="" placeholder="extras">
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
						<input name="status" title="status" type="text" value="" placeholder="status">
					</div>
				</div>
				
				<div class="row-item">
					<div class="content-table-2-col-left">
						Remarks
					</div>
					<div class="content-table-2-col-right">
						<input name="remarks" title="remarks" type="text" value="" placeholder="remarks">
					</div>
				</div>
			</div>
			
			<div class="clearfix">&nbsp;</div>
			
			<input type="submit" class="button" value="Add" >
			
		</form>
		
		<?php /*<div class="clearfix">&nbsp;</div>
		<div><a class="button" onclick="submit_new_place()">Add</a></div>*/ ?>
		<div class="clearfix">&nbsp;</div>
	</div>
</div>
<div class="clearfix">&nbsp;</div>

<script>
function submit_new_place() {
	var data = jQuery('#add-places').serialize();
	console.log(jQuery('#add-places'));
	console.log(jQuery(data));
	jQuery.getJSON('/jsonp/places/add?alt=json&callback=?'+data, {
		
	}, function(data) {
		console.log(data);
	});
}
</script>