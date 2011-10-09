<div id="account-setting-sidebar">
	<ul>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'index') ? 'active' : '';?>">
			<?php echo anchor('invitations', 'Invitation Overview', 'id="a-s-overview" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'invite') ? 'active' : '';?>">
			<?php echo anchor('invitations/invite', 'Invite Friends', 'id="a-s-sync" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'status') ? 'active' : '';?>">
			<?php echo anchor('invitations/status', 'Invitation Status', 'id="a-s-sync" class="a-s-icon-xlhdpi"'); ?>
		</li>
	</ul>
	<div class="clearfix">
		&nbsp;
	</div>
</div>