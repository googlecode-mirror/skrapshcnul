<div class="container">
	<div id="content" class="PeopleListingModel masonry-container">
		<?php if (isset($users) && is_array($users)) { ?>
			<?php foreach ($users as $user) { ?>
			<div class="pin people">
				<div class="pin-details">
					<div class="pin-image">
						<a href="<?php echo $user['ls_pub_url'] ?>"> <img src="<?php echo $user['profile_img'] ?>" /> </a>
					</div>
					<div class="pin-data">
						<a href="<?php echo $user['ls_pub_url'] ?>"> <h3><?php echo $user['display_name']
						?></h3> </a>
						<div>
							<?php echo $user['headline']
							?>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php }?>
		<?php } else { ?>
		 
			<div class="content-unavailable">
				No result.
			</div>
			 
		<?php } ?>
	</div>
	
	<div class="clearfix">&nbsp;</div>
</div>
