<div id="account-setting-sidebar" class="main-content-sidebar">
	<ul>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'index') ? 'active' : '';?>">
			<?php echo anchor('events', 'Events Overview', 'id="a-s-events" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'suggestions') ? 'active' : '';?>">
			<?php echo anchor('events/suggestions', 'Suggested Users', 'id="a-s-suggestions" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'upcoming') ? 'active' : '';?>">
			<?php echo anchor('events/upcoming', 'Matched Users', 'id="a-s-suggestions" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'past') ? 'active' : '';?>">
			<?php echo anchor('events/past', 'Past Events', 'id="a-s-suggestions" class="a-s-icon-xlhdpi"'); ?>
		</li>
	</ul>
	<div class="clearfix">
		&nbsp;
	</div>
</div>