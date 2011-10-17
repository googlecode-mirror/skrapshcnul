<div class="m-content">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('events/includes/sidetab');?>
	</div>
	<div class="m-content-2-col-right">
		<div class="hr">
			<h2 class="hr-text">Event Suggestions</h2>		
		</div>
		<div>
			<?php if(!empty($events['suggestions'])) { ?>
				<?php foreach($events['suggestions'] as $item) { ?>
				<div class="stream-item">
					<div class="clearfix"></div>
				</div>
				<?php }?>
			<?php } else { ?>
				<div class="">You have no event suggestions.</div>
			<?php }?>
		</div>
	</div>
</div>