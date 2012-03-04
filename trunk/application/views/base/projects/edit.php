<div class="m-content">
	<div id="places-container" class="c-pages shadow-rounded" style="padding: 10px;">
		<form id="update-places">
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
						<div class="editable">
							<span title="logo" class="editable-value">&nbsp;<?php echo $project['logo'] ?> </span>
						</div>
						<div style="display: none;">
							<input name="logo" title="logo" type="text" value="<?php echo $project['logo'] ?>" placeholder="Project logo URL" ls-oid="<?php echo $project['project_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Name
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="name" class="editable-value">&nbsp;<?php echo $project['name']; ?></span>
						</div>
						<div style="display: none;">
							<input name="name" title="name" type="text" value="<?php echo $project['name']; ?>" placeholder="Project name" ls-oid="<?php echo $project['project_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Description
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="description" class="editable-value">&nbsp;<?php echo $project['description']; ?></span>
						</div>
						<div style="display: none;">
							<input name="description" title="description" type="text" value="<?php echo $project['description']; ?>" placeholder="Project Description" ls-oid="<?php echo $project['project_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Cover Image
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="cover_img" class="editable-value">&nbsp;<?php echo $project['cover_img']; ?></span>
						</div>
						<div style="display: none;">
							<input name="cover_img" title="cover_img" type="text" value="<?php echo $project['cover_img']; ?>" placeholder="Project Cover Image URL" ls-oid="<?php echo $project['project_id'] ?>">
						</div>
					</div>
				</div>
				
			</div>
			
			<div class="clearfix">&nbsp;</div>
			
			<div class="section row-item">
				<div class="section-top">
					Tags
					<div class="caption"></div>
				</div>
				<div class="row-item xl">
					<?php $this -> load -> view("base/projects/edit/tags.php");?>
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
						<div class="editable">
							<span title="homepage" class="editable-value">&nbsp;<?php echo $project['external_urls']['homepage'] ?></span>
						</div>
						<div style="display: none;">
							<input name="homepage" title="homepage" type="text" value="<?php echo $project['external_urls']['homepage'] ?>" placeholder="Project Homepage" ls-oid="<?php echo $project['project_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Github Page
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="github_url" class="editable-value">&nbsp;<?php echo $project['external_urls']['github_url']; ?></span>
						</div>
						<div style="display: none;">
							<input name="github_url" title="github_url" type="text" value="<?php echo $project['external_urls']['github_url']; ?>" placeholder="Github URL" ls-oid="<?php echo $project['project_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Facebook Page
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="facebook_url" class="editable-value">&nbsp;<?php echo $project['external_urls']['facebook_url']; ?></span>
						</div>
						<div style="display: none;">
							<input name="facebook_url" title="facebook_url" type="text" value="<?php echo $project['external_urls']['facebook_url']; ?>" placeholder="Facebook URL" ls-oid="<?php echo $project['project_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Twitter Profile
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="twitter_url" class="editable-value">&nbsp;<?php echo $project['external_urls']['twitter_url']; ?></span>
						</div>
						<div style="display: none;">
							<input name="twitter_url" title="twitter_url" type="text" value="<?php echo $project['external_urls']['twitter_url']; ?>" placeholder="Twitter URL" ls-oid="<?php echo $project['project_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Google+ Page 
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="gplus_url" class="editable-value">&nbsp;<?php echo $project['external_urls']['gplus_url']; ?></span>
						</div>
						<div style="display: none;">
							<input name="gplus_url" title="gplus_url" type="text" value="<?php echo $project['external_urls']['gplus_url']; ?>" placeholder="Google+ URL" ls-oid="<?php echo $project['project_id'] ?>">
						</div>
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
						<div class="editable">
							<span title="ios_app_store_url" class="editable-value">&nbsp;<?php echo $project['apps']['ios_app_store_url'] ?></span>
						</div>
						<div style="display: none;">
							<input name="ios_app_store_url" title="ios_app_store_url" type="text" value="<?php echo $project['apps']['ios_app_store_url'] ?>" placeholder="iOS App Store URL" ls-oid="<?php echo $project['project_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Android Market
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="android_market_url" class="editable-value">&nbsp;<?php echo $project['apps']['android_market_url']; ?></span>
						</div>
						<div style="display: none;">
							<input name="android_market_url" title="android_market_url" type="text" value="<?php echo $project['apps']['android_market_url']; ?>" placeholder="Android Market URL" ls-oid="<?php echo $project['project_id'] ?>">
						</div>
					</div>
				</div>
				
				<div class="row-item xl">
					<div class="content-table-2-col-left">
						Windows Phone Marketplace
					</div>
					<div class="content-table-2-col-right">
						<div class="editable">
							<span title="wp_market_url" class="editable-value">&nbsp;<?php echo $project['apps']['wp_market_url']; ?></span>
						</div>
						<div style="display: none;">
							<input name="wp_market_url" title="wp_market_url" type="text" value="<?php echo $project['apps']['wp_market_url']; ?>" placeholder="Windows Phone Marketplace URL" ls-oid="<?php echo $project['project_id'] ?>">
						</div>
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
							<div class="editable">
								<span title="status" class="editable-value">&nbsp;<?php echo $project['verified_status']['status'] ?> </span>
							</div>
							<div style="display: none;">
								<input name="verified_status" title="status" type="text" value="<?php echo $project['verified_status']['status'] ?>" placeholder="Verification status" ls-oid="<?php echo $project['project_id'] ?>">
							</div>
						</div>
					</div>
					
					<div class="row-item xl">
						<div class="content-table-2-col-left">
							Remarks
						</div>
						<div class="content-table-2-col-right">
							<div class="editable">
								<span title="remarks" class="editable-value">&nbsp;<?php echo $project['verified_status']['remarks']; ?></span>
							</div>
							<div style="display: none;">
								<input name="remarks" title="remarks" type="text" value="<?php echo $project['verified_status']['remarks']; ?>" placeholder="Verification remarks" ls-oid="<?php echo $project['project_id'] ?>">
							</div>
						</div>
					</div>
				</div>
				
				<div class="clearfix">&nbsp;</div>
			<?php } ?>
			
		</form>
		
		<div class="clearfix">&nbsp;</div>
		<div><a href="/places/<?php echo $project['project_id'] ?>" class="button">Back</a></div>
		<div class="clearfix">&nbsp;</div>
		
	</div>
</div>
<div class="clearfix">&nbsp;</div>
