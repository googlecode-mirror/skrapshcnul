<div class="m-content">
	<div id="places-container" class="c-pages shadow-rounded" style="padding: 10px;">
		<h2><?php echo $tpl_page_title; ?></h2>
		
		<form method="post" id="add-project">
			<div class="section row-item">
				<div class="section-top">
					Project Information
					<div class="caption"></div>
				</div>
				
				<?php //var_dump($project) ?>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Logo
					</div>
					<div class="content-table-2-col-right">
						<input name="logo" title="logo" type="text" value="" placeholder="Project logo URL">
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Name
					</div>
					<div class="content-table-2-col-right">
						<input name="name" title="name" type="text" value="" required="required" placeholder="Project name">
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Description
					</div>
					<div class="content-table-2-col-right">
						<input name="description" title="description" type="text" value="" placeholder="Project Description">
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Cover Image
					</div>
					<div class="content-table-2-col-right">
						<input name="cover_img" title="cover_img" type="text" value="" placeholder="Project Cover Image URL">
					</div>
				</div>
				
			</div>
			
			<div class="clearfix">&nbsp;</div>
			
			<div class="section row-item">
				<div class="section-top">
					Project Web Links
					<div class="caption"></div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Homepage
					</div>
					<div class="content-table-2-col-right">
						<input name="homepage" title="homepage" type="text" value="" placeholder="Project Homepage">
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Github Page
					</div>
					<div class="content-table-2-col-right">
						<input name="github_url" title="github_url" type="text" value="" placeholder="Github URL">
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Facebook Page
					</div>
					<div class="content-table-2-col-right">
						<input name="facebook_url" title="facebook_url" type="text" value="" placeholder="Facebook URL">
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Twitter Profile
					</div>
					<div class="content-table-2-col-right">
						<input name="twitter_url" title="twitter_url" type="text" value="" placeholder="Twitter URL">
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Google+ Page 
					</div>
					<div class="content-table-2-col-right">
						<input name="gplus_url" title="gplus_url" type="text" value="" placeholder="Google+ URL">
					</div>
				</div>
				
			</div>
			
			<div class="clearfix">&nbsp;</div>
			
			<div class="section row-item">
				<div class="section-top">
					Project Mobile Apps Information
					<div class="caption"></div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Apple App Store 
					</div>
					<div class="content-table-2-col-right">
						<input name="ios_app_store_url" title="ios_app_store_url" type="text" value="" placeholder="iOS App Store URL">
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Android Market
					</div>
					<div class="content-table-2-col-right">
						<input name="android_market_url" title="android_market_url" type="text" value="" placeholder="Android Market URL">
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Windows Phone Marketplace
					</div>
					<div class="content-table-2-col-right">
						<input name="wp_market_url" title="wp_market_url" type="text" value="" placeholder="Windows Phone Marketplace URL">
					</div>
				</div>
				
			</div>
			
			<div class="clearfix">&nbsp;</div>
			
			<?php if(isset($is_logged_in_admin) && $is_logged_in_admin == TRUE) { ?>
				<div class="section row-item">
					<div class="section-top">
						Verification Status
						<div class="caption"></div>
					</div>
					
					<div class="row-item xl">
						<div class="content-table-2-col-left">
							Status
						</div>
						<div class="content-table-2-col-right">
							<input name="verified_status" title="status" type="text" value="" placeholder="Verification status">
						</div>
					</div>
					
					<div class="row-item xl">
						<div class="content-table-2-col-left">
							Remarks
						</div>
						<div class="content-table-2-col-right">
							<input name="remarks" title="remarks" type="text" value="" placeholder="Verification remarks">
						</div>
					</div>
				</div>
				
				<div class="clearfix">&nbsp;</div>
				
				<input class="button xl" type="submit" value="Save" />
			<?php } ?>
			
		</form>
		
		<div class="clearfix">&nbsp;</div>
		<div><a href="#" onclick="history.back();" class="button xs">Back</a></div>
		<div class="clearfix">&nbsp;</div>
		
	</div>
</div>
<div class="clearfix">&nbsp;</div>
