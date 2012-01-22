<div id="account-setting-sidebar" class="main-content-sidebar">
	<ul>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'overview') ? 'active' : '';?>">
			<?php echo anchor('admin/dashboard/', 'Overview', 'id="a-s-overview" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'users') ? 'active' : '';?>">
			<?php echo anchor('admin/dashboard/users', 'Users', 'id="a-s-sync" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'users_invites') ? 'active' : '';?>">
			<?php echo anchor('admin/dashboard/users_invites', 'Users Invitations', 'id="a-s-security" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'preferences') ? 'active' : '';?>">
			<?php echo anchor('admin/dashboard/preferences', 'Preferences', 'id="a-s-mobile" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'recommendations') ? 'active' : '';?>">
			<?php echo anchor('admin/dashboard/recommendations', 'Recommendations', 'id="a-s-privacy" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'events') ? 'active' : '';?>">
			<?php echo anchor('admin/dashboard/events', 'Events', 'id="a-s-language" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'survey') ? 'active' : '';?>">
			<?php echo anchor('admin/dashboard/survey', 'Survey', 'id="a-s-payment" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<?php /* ?>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'past_events') ? 'active' : '';?>">
			<?php echo anchor('admin/dashboard/past_events', 'Past Events', 'id="a-s-mobile" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<?php */ ?>
	</ul>
	<div class="clearfix">
		&nbsp;
	</div>
</div>