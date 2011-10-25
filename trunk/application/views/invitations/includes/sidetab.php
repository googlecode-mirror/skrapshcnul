<div id="account-setting-sidebar" class="main-content-sidebar">
	<ul>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'all') ? 'active' : '';?>">
			<?php echo anchor('invitations', 'Overview', 'id="a-s-invitations" class="a-s-icon-xlhdpi"'); ?>
		</li>
		<?php /* <li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'invite') ? 'active' : '';?>">
			<?php echo anchor('invitations/invite', 'Invite Friends', 'id="a-s-invite" class="a-s-icon-xlhdpi"'); ?>
		</li> */ ?>
		<li class="sideNavItem row-menu-item <?php echo ($tpl_page_id == 'status') ? 'active' : '';?>">
			<?php echo anchor('invitations/status', 'Invitation Status', 'id="a-s-status" class="a-s-icon-xlhdpi"'); ?>
		</li>
	</ul>
	<div class="clearfix">
		&nbsp;
	</div>
</div>