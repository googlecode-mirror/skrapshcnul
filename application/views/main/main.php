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
					<span style="line-height: 40px;">Users on Lunchsparks</span>
				</div>
				<div id="user-count" class="data counter-digit">
					00
				</div>
			</div>
			<div class="counter-stats-container">
				<div class="title">
					<span style="line-height: 40px;">Tech VIPs on Lunchsparks</span>
				</div>
				<div id="user-count" class="data counter-digit">
					00
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<div id="m-content">
	<div class="m-wrapper">
		<div class="g-content-container">
			<div class="main-content-sidebar">
				
			</div>
			<div class="main-content-left">
				
			</div>
			<?php $this -> load -> view('main/features');?>
			<?php $this -> load -> view('main/testimonial');?>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
