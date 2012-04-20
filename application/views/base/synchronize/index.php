<div class="container">
	<div class="c-pages">
		<h1><?php echo $tpl_page_title; ?> <small>connect with other networks</small></h1>
		<div class="clearfix">&nbsp;</div>
		
		<div>
			
			<div class="row-item">
				<div class="section-top">
					<div><i class="ext-icons-24-linkedin"></i> LinkedIn</div>
				</div>
				<div class="section-middle">
					<?php $this -> load -> view('base/synchronize/_includes/linkedin');?>
				</div> 
				<div class="clearfix"></div>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class="row-item">
				<div class="section-top">
					<div><i class="ext-icons-24-facebook"></i> Facebook</div>
				</div>
				<div class="section-middle">
					<?php $this -> load -> view('base/synchronize/_includes/facebook');?>
				</div>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div class="row-item">
				<div class="section-top">
					<div><i class="ext-icons-24-twitter"></i> Twitter</div>
				</div>
				<div class="section-middle">
					<?php $this -> load -> view('base/synchronize/_includes/twitter');?>
				</div>
			</div>
			<div class="clearfix">&nbsp;</div>
			
		</div>
		
	</div>
	<div class="clearfix"></div>
</div>