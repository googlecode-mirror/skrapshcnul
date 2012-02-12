<div id="account-setting-sidebar" class="main-content-sidebar">
	<ul>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'user#profile') ? 'active' : '';?>">
			<?php echo anchor('user/profile', 'Profile Overview', 'id="a-s-profile" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'user#preferences') ? 'active' : '';?>">
			<?php echo anchor('user/preferences', 'Preferences', 'id="a-s-preferences" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<?php /* <li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'user#location') ? 'active' : '';?>">
			<?php echo anchor('user/location', 'Location', 'id="a-s-preferences" class="a-s-icon-xlhdpi"'); ?>
		</li> */ ?>
	</ul>
	<div class="clearfix">
		&nbsp;
	</div>
</div>