<footer class="footer">
	<div class="container">
		<div class="">
			<div class="">
				<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
				<a class="btn btn-navbar hidden" data-toggle="collapse" data-target=".nav-collapse.footer"> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span> 
				</a>
				<!-- Be sure to leave the brand out there if you want it shown -->
				<a class="brand small pull-left" href="#" from="main" style="font-size: 100%; padding: 10px 20px; margin: 5px;">
					&copy; 2011 Lunchsparks.me
				</a>
				<!-- Everything you want hidden at 940px or less, place within here -->
				<div class="nav-collapse footer">
					<!-- .nav, .navbar-search, .navbar-form, etc -->
					<ul class="nav nav-pills pull-right">
						<li>
							<?php echo anchor('pages/about', 'About', array('from' => 'main'));?>
						</li>
						<li>
							<a href="https://www.facebook.com/pages/Lunchsparks/148121848608310">Facebook</a>
						</li>
						<li>
							<a href="http://twitter.com/#!/lunchsparks">Twitter</a>
						</li>
						<li>
							<a href="http://blog.lunchsparks.me/">Blog</a>
						</li>
						<li>
							<?php echo anchor('pages/press', 'Press', array('from' => 'main'));?>
						</li>
						<li>
							<?php echo anchor('pages/careers', 'Careers', array('from' => 'main'));?>
						</li>
						<li>
							<?php echo anchor('pages/privacy', 'Privacy', array('from' => 'main'));?>
						</li>
						<li>
							<?php echo anchor('pages/terms', 'Terms', array('from' => 'main'));?>
						</li>
						<li>
							<?php echo anchor('pages/help', 'Help', array('from' => 'main'));?>
						</li>
					</ul>
				</div>
			</div>
			<div class="clearfix"></div>
			<?php if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') { ?> 
				<p class="footer pull-right">
					<small>Page rendered in <strong>{elapsed_time}</strong> seconds</small> | 
					<small>Memory usage: {memory_usage}</small>
				</p>
			<?php } ?>
		</div>
	</div>
</footer>