<div id="profile-summary-large">
	<div class="profile-summary-large">
		
		<div class="well-container profile-featured-data">
			<div class="well-header gradient-black">
				<div class="row-fluid">
					<div class="span8">
						<div class="profile-name">
							<span>Hey, I'm <?php echo $profile['first_name'];?>, <?php echo $profile['last_name'];?></span>
							<div class="profile-stats">
								<?php if(isset($profile['verification']) && $profile['verification']['status']) { ?>
									<div id="user-verification" class="u-v-verified">
										<div class="user-verification-icon user-verfied"> </div>
										<div class="user-verification-text"> verified </div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="pull-right">
							 Member since:
						</div>
					</div>
				</div>
			</div>
			<div class="well-content gradient-white">
				<div class="others headline">
					<?php echo $profile['headline'];?>
				</div>
				
				<?php if(!empty($profile['location'])) { ?>
				<div class="row-fluid others">
					<div class="span3">
						<i class="icon-map-marker"></i> Lives in 
					</div>
					<div class="span9">
						<strong><a href="http://maps.google.com/maps?q=<?php echo $profile['location']['name'];?>" target="_blank"><?php echo $profile['location']['name'];?></a></strong>
					</div>
				</div>
				<?php } ?>
				<?php if(!empty($profile['location'])) { ?>
				<div class="row-fluid others">
					<div class="span3">
						<i class="icon-book"></i> School
					</div>
					<div class="span9">
						
					</div>
				</div>
				<?php } ?>
				<?php if(!empty($profile['location'])) { ?>
				<div class="row-fluid others">
					<div class="span3">
						<i class="icon-folder-close"></i> Work
					</div>
					<div class="span9">
						
					</div>
				</div>
				<?php } ?>
				<?php if(!empty($profile['location'])) { ?>
				<div class="row-fluid others">
					<div class="span3">
						<i class="icon-user"></i> Groups
					</div>
					<div class="span9">
						
					</div>
				</div>
				<?php } ?>
				<?php if(!empty($profile['interests'][0])) { ?>
				<div class="row-fluid others">
					<div class="span3">
						<i class="icon-star"></i> Interest
					</div>
					<div class="span9">
						 <strong><?php echo ($profile['interests'][0]);?></strong>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>

