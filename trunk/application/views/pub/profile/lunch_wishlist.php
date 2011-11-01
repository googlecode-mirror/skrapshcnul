<div class="widget-box">
	<div class="widget-box-title-bar">
		<h4 class="widget-title">Lunch Wishlist (<?php echo sizeof($profile_stats['lunch_wishlist']);?>)</h4>
	</div>
	<div class="widget-box-container">
		<div id="user-wishlist">
			<?php if ($profile_stats['lunch_wishlist']) { ?>
			<?php foreach($profile_stats['lunch_wishlist'] as $wishlist_item) { ?>
			<div class="wishlist-item">
				<a href="/pub/<?php echo $wishlist_item->alias ? $wishlist_item->alias : $wishlist_item->target_user_id;?>">
					<div class="lunch-with profile-img-45">
						<img title="<?php echo $wishlist_item->firstname;?>" src="<?php echo ($wishlist_item->profile_img) ? $wishlist_item->profile_img :  '/skin/images/160/silhouette_male.jpg'; ?>">
					</div>
				</a>
			</div>
			<?php }?>
			<?php } else { ?>
				<div style="text-align: center;">You have 0 lunch wishlist.</div>
			<?php }?>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>


