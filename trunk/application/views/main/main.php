<div id="carousel">
	<div class="m-wrapper">
		<?php $this -> load -> view('main/index');?>
	</div>
</div>
<div id="statistic-bar">
	<div class="m-wrapper">
		<div class="container">
			<div class="counter-stats-container">
				<div class="title">
					<span style="line-height: 40px;">Users on Lunchsparks: </span>
				</div>
				<div id="user-count" class="data counter-digit">
					00
				</div>
			</div>
			<div class="counter-stats-container">
				<div class="title">
					<span style="line-height: 40px;">Successful lunches: </span>
				</div>
				<div id="lunches-count" class="data counter-digit">
					00
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<div id="m-content" class="main-page-content-bg">
	<div class="m-wrapper">
		<div class="container">
			<?php $this -> load -> view('main/_featured_users');?>
			<?php $this -> load -> view('main/_features');?>
			<?php //$this -> load -> view('main/_testimonial');?>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
