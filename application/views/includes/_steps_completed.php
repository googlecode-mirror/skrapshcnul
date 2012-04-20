<div class="container">
	<div id="steps-completed" style="display:none;">
		<div id="steps-completed-title" class="ui-dialog" style="cursor: pointer;">
			<strong>Guide</strong> <span>Complete these 4 simple steps to get listed for lunches!</span>
			<a id="steps-completed-title-btn" href="javascript:void(0);" class="ui-dialog-titlebar-close ui-corner-all" role="button">
				<span class="ui-icon ui-icon-closethick">close</span>
				<?php /* <span class="ui-icon ui-icon-triangle-1-s">close</span> */ ?>
				
			</a>
		</div>
		
		<div id="steps-completed-body" style="display:none;">
			<div class="steps-completed-item step1 first-item">
				<?php echo anchor('/synchronize', 
				'<div class="completed-overlay incomplete"></div>'.
				'<div><img src="/skin/images/p/steps_completed/completed_step_1.png"></div>'.
				'<div class="desc">
					<strong>Synchronize LinkedIn</strong>
					<p>A simple click to sync your profile with Linkedin.</p>
				</div>	
				<span class="steps-completed-number one"></span>
				', 
				array('from' => 'main')); ?>
			</div>
			<div class="steps-completed-item step2">
				<?php echo anchor('/preferences', 
				'<div class="completed-overlay incomplete"></div>'.
				'<div><img src="/skin/images/p/steps_completed/completed_step_2.png"></div>'.
				'<div class="desc">
					<strong>Indicate Preferences</strong>
					<p>Get the most value out of the connection.</p>
				</div>	
				<span class="steps-completed-number two"></span>
				', array('from' => 'main')); ?>
			</div>
			<div class="steps-completed-item step3">
				<?php echo anchor('schedules', 
				'<div class="completed-overlay incomplete"></div>'.
				'<div><img src="/skin/images/p/steps_completed/completed_step_3.png"></div>'.
				'<div class="desc">
					<strong>Indicate Schedules</strong>
					<p>Tell us your available timeslot and preferred meeting area.</p>
				</div>	
				<span class="steps-completed-number three"></span>
				', array('from' => 'main')); ?>
			</div>
			<div class="steps-completed-item step4">
				<?php echo anchor('events', 
				'<div class="completed-overlay incomplete"></div>'.
				'<div><img src="/skin/images/p/steps_completed/completed_step_4.png"></div>'.
				'<div class="desc">
					<strong>Accept Event Invitation</strong>
					<p>Browse through recommended connection to you.</p>
				</div>	
				<span class="steps-completed-number four"></span>
				', array('from' => 'main')); ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
