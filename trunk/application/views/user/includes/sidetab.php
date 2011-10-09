<div id="account-setting-sidebar">
	<ul>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'profile') ? 'active' : '';?>">
			<?php echo anchor('user/profile', 'Profile Overview', 'id="a-s-overview" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'preferences') ? 'active' : '';?>">
			<?php echo anchor('user/preferences', 'Preferences', 'id="a-s-sync" class="a-s-icon-xlhdpi"'); ?>
		</li>
	</ul>
	<div class="clearfix">
		&nbsp;
	</div>
</div>