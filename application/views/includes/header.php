<div id="notifications-mini-area" class="floating-dialog">
	<iframe id="notifications-mini-iframe" src="<?php echo site_url("notifications/minified");?>"
	scrolling="no" frameborder="0" allowtransparency="true"
	hspace="0" tabindex="-1" vspace="0"
	style="height: 100%">
		<p>
			Your browser does not support iframes. Please update your browser.
		</p>
	</iframe>
</div>
<header>
	<div id="header">
		<div id="h-container">
			<div id="lunchsparks-header-logo" class="header-menu-items">
				<?php echo anchor('', '<img src="'.base_url().'/skin/images/ls_logo_white.png" height="40px" style="display: block;">', array('from' => 'main'));?>
			</div>
			<div id="h-menu" class="header-menu-items">
				<ul>
					<?php if (isset($is_logged_in) && $is_logged_in ) { ?>
						<?php /*
						<li>
							<?php echo anchor('user/friends', 'Friends', array('from' => 'main'));?>
						</li>
						<li>
							<?php echo anchor('user/messages', 'Messages', array('from' => 'main'));?>
						</li>
						*/ ?>
						<li><div style="width: 20px;">&nbsp;</div></li>
						<li>
							<?php echo anchor('synchronize', ' ', array('from' => 'main', 'class' => 'ls-h-m-icon', 'id' => 'ls-h-m-synchronize', 'title'=>'Synchronize')); ?>
						</li>
						<li>
							<?php echo anchor('preferences', ' ', array('from' => 'main', 'class' => 'ls-h-m-icon', 'id' => 'ls-h-m-preferences', 'title'=>'Preferences')); ?>
						</li>
						<li>
							<?php echo anchor('schedules', ' ', array('from' => 'main', 'class' => 'ls-h-m-icon', 'id' => 'ls-h-m-schedules', 'title'=>'Schedule')); ?>
						</li>
						<li>
							<?php echo anchor('events', ' ', array('from' => 'main', 'class' => 'ls-h-m-icon', 'id' => 'ls-h-m-events', 'title'=>'Events')); ?>
						</li>
						<li>
							<?php echo anchor('invitations', ' ', array('from' => 'main', 'class' => 'ls-h-m-icon', 'id' => 'ls-h-m-invitations', 'title'=>'Invitations'));?>
						</li>
	          			<?php /* <li>
							<?php echo anchor('suggestion', 'Suggestions', array('from' => 'main'));?>
						</li> */ ?>
					<?php } ?>
					
					<?php if (isset($this->data['is_logged_in_admin']) && $this->data['is_logged_in_admin']) { ?>
						<li>
							<?php echo anchor('admin/dashboard', ' ', array('from' => 'main', 'class' => 'ls-h-m-icon', 'id' => 'ls-h-m-admin', 'title'=>'Admin Dashboard'));?>
						</li>
					<?php } ?>
				</ul>
			</div>
			
			<div id="lunchsparks-header-logo" class="header-menu-items">
				<form method="get" action="/search/">
					<input name="q" type="search" class="search" placeholder="Search tag..." value="">
					<input type="button" class="button" value="Go" />
				</form>
			</div>
			<div id="h-uacc">
				<?php if ($is_logged_in) {
				?>
				<ul>         
					<li class="notification-toggle-container">
						<div id="notification-toggle" class="notification" title="Notifications">
							<span id="notification-toggle-count">0</span>
						</div>
					</li>
					<li>
						<?php echo anchor('user/profile', $this -> session -> userdata['email'], array('from' => 'main'));?>
					</li>
					<li>
						<?php echo anchor('settings', 'Settings', array('from' => 'main'));?>
					</li>
					<li>
						<?php echo anchor('logout', 'Logout', array('from' => 'main'));?>
					</li>          
				</ul>
				<?php } else {?>
				<ul>
					<li>
						<?php echo anchor('login', 'Login', array('from' => 'main'));?>
					</li>
					<li>
						<?php echo anchor('auth/signup', 'Signup', array('from' => 'main'));?>
					</li>
				</ul>
				<?php }?>
			</div>
		</div>
	</div>
</header>
