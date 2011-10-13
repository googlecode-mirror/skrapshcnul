<div id="lunchsparks-testimonials" class="infobox">
	<div class="block">
		<div class="hr">
			<h2 class="hr-text">Who are we:</h2>
		</div>
		<p>
			We are very excited to finally be able to address the problem of inefficiency in networking. With Lunchsparks, you can now decide who you want to network with, instead of showing up at an networking event and network with people whom might not be relevant to you. How can we do that? We let you indicate your preference of your preferred connection. Networking will now be effective and efficient! At the very least, we connect you with someone who is as awesome as you are!
		</p>
	</div>
	<div class="block">
		<div class="hr">
			<h2 class="hr-text">What people say:</h2>
		</div>
		<div id="lunchsparks-testimonial">
			<?php if(!empty($ls_testimonial_list)) {
			?>
			<?php foreach ($ls_testimonial_list as $ls_testimonial) {
			?>
			<div class="lunchsparks-testimonial-item">
				<div class="l-t-i-headings">
					<span class="l-t-i-name"><?php echo $ls_testimonial['name']
						?></span>
					<span> | </span>
					<span class="l-t-i-company"><?php echo $ls_testimonial['company']
						?></span>
				</div>
				<div class="l-t-i-msg">
					"<?php echo $ls_testimonial['message']?>"
				</div>
			</div>
			<?php }?>
			<?php }?>
		</div>
	</div>
	<div class="clearfix"></div>
	<br />
</div>
<div class="clearfix">&nbsp;</div>
