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
					Discover new friends and expand your network with professionals or fellow entrepreneurs with Lunchsparks. You can also leverage on your new connection's network for their resources. And who knows, you could also meet with your potential cofounder!
				</p>
			</div>
			<div class="block">
				<h3>For Industry Professionals:</h3>
				<p>
					Expand your network to other industry for career advices, career opportunities or simply tap on their resources if you need any contacts. Lunchsparks allows you to connect with other professionals from other industry to explore possible career advancement options.
				</p>
			</div>
			<div class="block">
				<h3>For Everyone else:</h3>
				<p>
					Lunchsparks is your new networking platform where you could meet new friends out of your network, where it is now possible to connect with someone out of your network who is of the same interest as you! Network and discover new awesome friends now! For it is your network that determines your net worth!
				</p>
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
		
		<?php } else { ?>
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