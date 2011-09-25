<div id="carousel">
	<div class="m-wrapper">
		<?php $this -> load -> view('main/index');?>
	</div>
</div>
<div id="statistic-bar">
	<div class="m-wrapper">
		<div class="g-content-container">
			<div class="counter-stats-container">
				<div class="title">
					<span style="line-height: 40px;">Users on LetsLunch</span>
				</div>
				<div id="user-count" class="data counter-digit">
					00
				</div>
			</div>
			<div class="counter-stats-container">
				<div class="title">
					<span style="line-height: 40px;">Tech VIPs on LetsLunch</span>
				</div>
				<div id="user-count" class="data counter-digit">
					00
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<div id="m-content" style="background-color: #CAD5ED;">
	<div class="m-wrapper">
		<div class="g-content-container">
			<div class="main-content-sidebar">
				<?php $this -> load -> view('main/testimonial');?>
			</div>
			<div class="main-content-left">
				<?php $this -> load -> view('main/features');?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
