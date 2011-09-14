<div id="notifications-mini-area">
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
			<div id="h-menu">
				<?php if ($is_logged_in) {
				?>
				<ul>
					<li id="lunchsparks-header-logo">
						<?php echo anchor('', 'Lunchsparks', array('from' => 'main'));?>
					</li>
					<li>
						<?php echo anchor('friends', 'Friends', array('from' => 'main'));?>
					</li>
					<li>
						<?php echo anchor('messages', 'Messages', array('from' => 'main'));?>
					</li>
				</ul>
				<?php } else {?>
				<ul>
					<li>
						<?php echo anchor('', 'Lunchsparks', array('from' => 'main'));?>
					</li>
				</ul>
				<?php }?>
			</div>
			<div id="h-uacc">
				<?php if ($is_logged_in) {
				?>
				<ul>
					<li>
						<?php echo anchor('user/profile', 'Profiles', array('from' => 'main'));?>
					</li>
					<li>
						<?php //echo anchor('notifications', 'Notifications', array('from' => 'main', 'id' => 'notification_toggle'));?>
						<div class="notification-toggle-container">
							<div id="notification-toggle" title="Notifications">
								<span>0</span>
							</div>
						</div>
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
<script></script>
