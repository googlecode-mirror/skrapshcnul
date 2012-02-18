<div class="m-content">
	<div class="c-pages shadow-rounded">
		<h2><?php echo $tpl_page_title; ?></h2>
		<h3 class="sub-heading">Events listed below requires your attention.</h3>
		
		<div class="section row-item">
			<div class="section-top">
				Suggestions
				<div class="caption">Hi there! We have a few suggestion here for your next meetup!</div>
			</div>
			<div class="section-middle">
				<?php if(!empty($events['auto_recommendation'])) { ?>
					<?php foreach($events['auto_recommendation'] as $item) { ?>
					<div class="stream-item row-item">
						<div class="clearfix"></div>
						<div style="display: inline-block; vertical-align: middle;">
							<a href="<?php echo $item['rec_id_profile']['ls_pub_url']; ?>"  class="ls-profile-hover" ls-data-userid="<?php echo $item['rec_id_profile']['user_id'] ?>">
								<div class="lunch-with inset-image profile-img-80">
									<img title="<?php echo $item['rec_id_profile']['firstname']; ?>" src="<?php echo $item['rec_id_profile']['profile_img']; ?>">
								</div>
							</a>
						</div>
						<div style="display: inline-block;">
							<div style="padding: 20px;" class="radio_buttonset">
								<input type="radio" id="radio<?php echo $item['index'] ?>_1" name="user_recommendation_radio<?php echo $item['index'] ?>" <?php echo $item['selected'] ? 'checked="checked"' : ''; ?> ls-oid="<?php echo $item['index'] ?>" onclick="user_recommendation_confirm(this);" />
								<label for="radio<?php echo $item['index'] ?>_1">Yes</label>
								<input type="radio" id="radio<?php echo $item['index'] ?>_0" name="user_recommendation_radio<?php echo $item['index'] ?>" <?php echo !$item['selected'] ? 'checked="checked"' : ''; ?> ls-oid="<?php echo $item['index'] ?>" onclick="user_recommendation_reject(this);" />
								<label for="radio<?php echo $item['index'] ?>_0">No</label>
							</div>
						</div>
						
						<div class="clearfix"></div>
					</div>
					<?php }?>
				<?php } else { ?>
					<div class="content-unavailable">You have no recommendation.</div>
				<?php }?>
			</div>
		</div>
		
		<div class="clearfix">&nbsp;</div>
		
		<?php $this -> load -> view('base/events/_event_request');?>
		
		<div class="clearfix">&nbsp;</div>
		
		<?php $this -> load -> view('base/events/_upcoming_events');?>
		
		<div class="clearfix">&nbsp;</div>
		
		<?php $this -> load -> view('base/events/_past_events');?>
		
	</div>
	<div class="clearfix">&nbsp;</div>
</div>

<script>
jQuery(document).ready(function() {
	jQuery( ".radio_buttonset" ).buttonset();
});
</script>
