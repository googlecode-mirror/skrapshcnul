<?php if (is_array($users) && sizeof($users) > 0) { ?>
	<?php foreach ($users as $user) { ?>
		<a href="<?php echo $user['ls_pub_url'] ?>">
			<div class="pin people">
				<div class="pin-over">
					<h3><h3><?php echo $user['display_name'];?></h3></h3>
					<?php if (isset($user['location']) && !empty($user['location'])) {?>
					<div>
						<i class="icon-map-marker"></i><?php echo $user['location'];?>
					</div>
					<?php }?>
					<div style="margin-top: 10px;">
						<?php echo $user['headline'];?>
					</div>
				</div>
				<div class="pin-details">
					<div class="pin-image">
						<a href="<?php echo $user['ls_pub_url'] ?>"> <img src="<?php echo $user['profile_img'] ?>" /> </a>
					</div>
					<div class="pin-data oneliner" style="margin-top: 5px;">
						<div class="pull-right"></div>
						<ul class="unstyled pull-left pin-stats">
							<li>
								<div class="count">
									<?php echo $user['statistics']['projects'];?>
								</div>
								<div class="meta">
									projects
								</div>
							</li>
							<li>
								<div class="count">
									<?php echo $user['statistics']['lunches'];?>
								</div>
								<div class="meta">
									lunches
								</div>
							</li>
							<li>
								<div class="count">
									<?php echo $user['statistics']['ratings'];?>
								</div>
								<div class="meta">
									rating
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="clearfix"></div>
			</div> 
		</a>
	<?php }?>
<?php } else { ?>
 
	<div class="content-unavailable">
		No result.
	</div>
	 
<?php } ?>