<div class="clearfix"></div>
<footer>
	<div id="f-container">
		<div id="f-twitter"></div>
		<?php if ($main_content == "main/main") {
		?>
		<div id="f-widgets">
			<div class="block">
				<h3>For Entrepreneurs:</h3>
				<p>
					With Lunchsparks, you can discover new friends and expand your network with professionals or fellow entrepreneurs. You might even meet your potential cofounder!
				</p>
			</div>
			<div class="block">
				<h3>For Industry Professionals:</h3>
				<p>
					Meet new contacts for career advices and career opportunities. Lunchsparks allows you to connect with other professionals from other industry to explore possible career advancement options.
				</p>
			</div>
			<div class="block">
				<h3>For Everyone else:</h3>
				<p>
					Lunchsparks is your networking platform where you could meet new friends of similar interest. It is now possible to connect with someone out of your network. 
				</p>
			</div>
			<div class="block" style="width: 230px">
				<h3>What people say:</h3>
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
			<div class="clearfix">
				&nbsp;
			</div>
		</div>
		<div class="clearfix">
			&nbsp;
		</div>
		<div id="f-bottom-bar">
			<?php $this -> load -> view('includes/footer-bottom-bar');?>
		</div>
		<?php } else {?>
		<div style="margin: 10px 0;">
			<?php $this -> load -> view('includes/footer-bottom-bar');?>
		</div>
		<?php }?>

		<div class="f-socialmedia">
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</footer>
</body> </html>