<div class="dashboard-stream-box well-container">
	
	<h3 class="dashboard-stream-box-top">
		Similar People (<?php echo  ($profile_stats['similar_user']) ? count($profile_stats['similar_user']) : '0';?>)
	</h3>
	
	<div class="dashboard-stream-box-middle dashboard-stream-box-container">
		<div class="activity-stream">
			<div id="user-wishlist">
				<?php if ($profile_stats['similar_user']) { ?>
				<?php foreach($profile_stats['similar_user'] as $wishlist_item) { ?>
					<div class="wishlist-item">
						<a class="" href="/pub/<?php echo $wishlist_item->alias ? $wishlist_item->alias : $wishlist_item->target_user_id;?>">
							<div class="lunch-with profile-img-45 ls-profile-hover inset-image" ls-data-userid="<?php echo $wishlist_item->target_user_id; ?>">
								<img title="<?php echo $wishlist_item->firstname;?>" src="<?php echo ($wishlist_item->profile_img) ? $wishlist_item->profile_img :  '/skin/images/160/silhouette_male.jpg'; ?>">
							</div>
						</a>
					</div>
				<?php }?>
				<?php } else { ?>
					<div style="text-align: center;">0 similar people.</div>
				<?php }?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>

<div class="clearfix">&nbsp;</div>


