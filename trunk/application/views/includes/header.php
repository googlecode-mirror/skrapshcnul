<header>
	<div id="header">
		<div id="h-container">
			<div id="h-menu">
				<?php if ($is_logged_in) { ?>
				<ul>
					<li id="lunchsparks-header-logo">
						<?php echo anchor('', 'Lunchsparks', array('from' => 'main' )); ?>
					</li>
					<li>
						<?php echo anchor('friends', 'Friends', array('from' => 'main' )); ?>
					</li>
					<li>
						<?php echo anchor('messages', 'Messages', array('from' => 'main' )); ?>
					</li>
					<li>
						<?php echo anchor('notifications', 'Notifications', array('from' => 'main' )); ?>
					</li>
				</ul>
				<?php } else { ?>
					<ul>
						<li>
							<?php echo anchor('', 'Lunchsparks', array('from' => 'main' )); ?>
						</li>
					</ul>
				<?php } ?>
			</div>
			<div id="h-uacc">
				<?php if ($is_logged_in) { ?>
				<ul>
					<li>
						<?php echo anchor('user/profile', 'Profiles', array('from' => 'main' )); ?>
					</li>
					<li>
						<?php echo anchor('auth/settings', 'Settings', array('from' => 'main' )); ?>
					</li>
					<li>
						<?php echo anchor('logout', 'Logout', array('from' => 'main' )); ?>
					</li>
				</ul>
				<?php } else { ?>
					<ul>
						<li>
							<?php echo anchor('login', 'Login', array('from' => 'main' )); ?>
						</li>
						<li>
							<?php echo anchor('auth/signup', 'Signup', array('from' => 'main' )); ?>
						</li>
					</ul>
				<?php } ?>
			</div>
		</div>
	</div>
</header>
