<div class="m-content">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('events/includes/sidetab');?>
	</div>
	<div class="m-content-2-col-right">
		<div class="hr">
			<h2 class="hr-text">Upcoming Events</h2>		
		</div>
		<div>
			<?php if(!empty($events['upcoming'])) { ?>
				<?php foreach($events['upcoming'] as $item) { ?>
				<div class="stream-item">
					<div class="clearfix"></div>
				</div>
				<?php }?>
			<?php } else { ?>
				<div class="">You have no upcoming event.</div>
			<?php }?>
		</div>
		
		<div class="hr">
			<h2 class="hr-text">Past Events</h2>		
		</div>
		<div>
			<?php if(!empty($events['past'])) { ?>
				<?php foreach($events['past'] as $item) { ?>
				<div class="stream-item">
					<div class="clearfix"></div>
				</div>
				<?php }?>
			<?php } else { ?>
				<div class="">You have no past event.</div>
			<?php }?>
		</div>
	</div>
</div>
