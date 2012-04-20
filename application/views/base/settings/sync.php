<div class="container">
	
	<div class="row-fluid">
		<div class="span3">
			<?php $this -> load -> view('base/settings/includes/sidetab');?>
		</div>
		<div class="span9 hasLeftCol">
			<div class="content-area">
				<div class="hr">
					<h2 class="hr-text dark"><?php echo $tpl_page_title; ?></h2>
				</div>
				
				
				<div class="row-item">
					<div class="section-top">
						<div><i class="ext-icons-24-linkedin"></i> LinkedIn</div>
					</div>
					<div class="section-middle">
						<?php $this -> load -> view('base/settings/_sync/linkedin');?>
					</div> 
					<div class="clearfix"></div>
				</div>
				<div class="clearfix">&nbsp;</div>
				<div class="row-item">
					<div class="section-top">
						<div><i class="ext-icons-24-facebook"></i> Facebook</div>
					</div>
					<div class="section-middle">
						<?php $this -> load -> view('base/settings/_sync/facebook');?>
					</div>
				</div>
				<div class="clearfix">&nbsp;</div>
				<div class="row-item">
					<div class="section-top">
						<div><i class="ext-icons-24-twitter"></i> Twitter</div>
					</div>
					<div class="section-middle">
						<?php $this -> load -> view('base/settings/_sync/twitter');?>
					</div>
				</div>
				<div class="clearfix">&nbsp;</div>
				
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>