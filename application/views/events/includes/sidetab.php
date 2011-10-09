<div id="account-setting-sidebar">
	<ul>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'index') ? 'active' : '';?>">
			<?php echo anchor('events', 'Events Overview', 'id="a-s-overview" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'suggestions') ? 'active' : '';?>">
			<?php echo anchor('events/suggestions', 'Suggestions', 'id="a-s-sync" class="a-s-icon-xlhdpi"'); ?>
		</li>
	</ul>
	<div class="clearfix">
		&nbsp;
	</div>
</div>