
<div class="m-content">
	<div class="c-pages shadow-rounded">
		<h2><?php echo $tpl_page_title; ?></h2>
		<h3 class="sub-heading">Just a short survey to help us improve our service.</h3>
		
		<div class="section">
			<div class="intro-heading">
				<span>Recently, you had lunch with</span> 
				<?php $i = 0; ?>
				<?php foreach($event_info['buddies_info'] as $buddy) { ?>
					<?php $i++; ?>
					<?php if ($i > 1) echo ', ';?>
					<a href=<?php echo $buddy['rec_id_profile']['ls_pub_url']; ?>> <?php echo $buddy['rec_id_profile']['firstname'] ?> </a>
				<?php } ?>
				<span> on <?php echo $event_info['event_info']['date'] ?></span>
				<span>, at <?php echo $event_info['restaurant_info']['name']; ?>. </span>
				<br />
				<span>We would appreciate if you could provide feedback regarding your lunch! </span>
			</div>
		</div>
			
		<form id="event_survey_form" class="section" method="post" action="/survey/save/">
			<div class="row-item">
				<div class="section-top">
					Lunch Buddy Rating
				</div>
				<div class="section-middle">
					<?php foreach ($event_info['buddies_info'] as $buddy) { ?>
						<div class="stream-item row-item">
							<div style="display: inline-block; vertical-align: middle;">
								<a href="<?php echo $buddy['rec_id_profile']['ls_pub_url']; ?>" class="ls-profile-hover" ls-data-userid="<?php echo $buddy['rec_id_profile']['user_id']; ?>">
									<div class="lunch-with inset-image profile-img-80">
										<img title="<?php echo $buddy['rec_id_profile']['firstname']; ?>" src="<?php echo $buddy['rec_id_profile']['profile_img']; ?>">
									</div>
								</a>
							</div>
							
							<div style="display: inline-block; vertical-align: middle; padding: 0 20px;">
								<div>
									<label>Rating for <a href="<?php echo $buddy['rec_id_profile']['ls_pub_url']; ?>"> <?php echo $buddy['rec_id_profile']['firstname']; ?>, <?php echo $buddy['rec_id_profile']['lastname']; ?></a></label>
								</div>
								<div>
									<span id="stars-cap"></span>
									<div id="stars-wrapper3" class="abc">
										<select name="target_point[]">
											<option value="1" selected="selected">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>
								<div class="clearfix">&nbsp;</div>
								<div>
									<label>Testimonial</label>
									<textarea name="target_review[]" style="width: 300px;height: 60px;"></textarea>
								</div>
								<input type="hidden" name="target_id[]" value="<?php echo $buddy['rec_id_profile']['user_id']; ?>" />
							</div>
						</div>
					
					<?php } ?>
				</div>
			</div>
			
			<div class="clearfix">&nbsp;</div>
			
			<div class="row-item">
				<div class="section-top">
					Restaurant Rating
				</div>
				<div class="section-middle">
					
					<div class="stream-item row-item">
						<label>Rating for <?php echo $event_info['restaurant_info']['name']; ?></label>
						<div>
							<span id="stars-cap"></span>
							<div id="stars-wrapper2" class="abc">
								<select name="restaurant_point">
									<option value="1" selected="selected">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</div>
						</div>
						<div class="clearfix">&nbsp;</div>
						<div>
							<label>Feedback</label>
							<textarea name="restaurant_review" style="width: 300px;height: 60px;"></textarea>
						</div>
					</div>
				</div>
			</div>
			
			<div class="clearfix">&nbsp;</div>
			
			<div class="margin: 20px 0;">
				<input type="submit" value="submit"/>
			</div>
			
			<input type="hidden" name="event_id" value="<?php echo $event_info['event_info']['event_id'] ?>" />
			<input type="hidden" name="user_id" value="<?php echo $user_id ?>" />
			<input type="hidden" name="restaurant_id" value="<?php echo $event_info['restaurant_info']['restaurant_id']; ?>" />
			
			<?php ##var_dump($event_info); ?>
			<?php ##var_dump($user_id); ?>
		</form>	
		<div class="clearfix">&nbsp;</div>
	</div>
</div>

<script>
jQuery(document).ready(function(){
	
	jQuery("#event_survey_form").submit(function(){
		console.log(jQuery("#event_survey_form").serialize());
	});
	
});
</script>

