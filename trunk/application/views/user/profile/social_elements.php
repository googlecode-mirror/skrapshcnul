<div class="widget-box">
	<div class="widget-box-container" style="border-radius: 3px;background: #DCF7DD;text-align: center;font-size: 90%;">
		
		<div style="margin: 5px 0;">
			<img src="/skin/images/24/social_linkedin_box_blue.png" />
			<img src="/skin/images/24/social_twitter_box_blue.png" />
		</div>
		
		<div >
			<?php /* <button id="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
				<span class="ui-button-text"></span>
			</button> */ ?>
			<a id="add_to_lunch_wishlist" class="add-to-lunch-wishlist-btn" href="#">Add to Lunch Wishlist</a>
			<script>
				jQuery(function() {
					jQuery( "#add_to_lunch_wishlist" ).button();
					jQuery( "#add_to_lunch_wishlist" ).click(function() { return false; });
				});
			</script>
		</div>
	</div>
	<div class="clearfix"></div>
</div>