<div class="m-content">
	<div class="c-pages shadow-rounded">
		<h2><?php echo $tpl_page_title; ?></h2>
		<h3 class="sub-heading">Although we are still in closed Alpha stage, we are giving out invitations to you so that you can invite those who you think will benefit from this platform</h3>
		
		<div class="section">
			<?php $this -> load -> view('base/invitations/includes/status');?>
		</div>
		<div class="clearfix">&nbsp;</div>
		
		<div class="section">
			<?php $this -> load -> view('base/invitations/includes/invite');?>
		</div>
		<div class="clearfix">&nbsp;</div>
		
	</div>
</div>