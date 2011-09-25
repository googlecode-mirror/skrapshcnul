<h2>What people say:</h2>

<div id="lunchsparks-testimonial">
	<?php if(!empty($ls_testimonial_list)) { ?>
		<?php foreach ($ls_testimonial_list as $ls_testimonial) { ?>
			<div class="lunchsparks-testimonial-item">
				<div class="l-t-i-headings">
					<span class="l-t-i-name"><?php echo $ls_testimonial['name']?></span>
					<span> | </span>
					<span class="l-t-i-company"><?php echo $ls_testimonial['company']?></span>
				</div>
				<div class="l-t-i-msg">
					"<?php echo $ls_testimonial['message']?>"
				</div>
			</div>
		<?php } ?>
	<?php }?>
</div>
