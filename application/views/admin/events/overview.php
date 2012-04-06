<div class="m-content container">
	<div id="announcements" class="shadow">
	</div>
	
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('admin/includes/sidetab');?>
	</div>
	
	<div class="m-content-2-col-right">
		
		<div class="hr">
			<h2 class="hr-text"><?php echo $tpl_page_title; ?></h2>
		</div>
		
		<?php $this -> load -> view('admin/events/create.php'); ?>
		
		<div class="clearfix">&nbsp;</div>
		
		<?php $this -> load -> view('admin/events/upcoming.php'); ?>
		
		<div class="clearfix">&nbsp;</div>
		
		<?php $this -> load -> view('admin/events/past.php'); ?>
		
		<div class="clearfix">&nbsp;</div>
		
	</div>
</div>
