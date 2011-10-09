<div id="account-setting-sidebar">
	<ul>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'index') ? 'active' : '';?>">
			<?php echo anchor('schedules', 'Schedule Overview', 'id="a-s-overview" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'add') ? 'active' : '';?>">
			<?php echo anchor('schedules/add', 'Add', 'id="a-s-sync" class="a-s-icon-xlhdpi"'); ?>
		</li>
	</ul>
	<div class="clearfix">
		&nbsp;
	</div>
</div>