<div id="notifications-mini-area" class="floating-dialog">
	<div class="container">
		<iframe id="notifications-mini-iframe" src="<?php echo site_url("notifications/minified");?>" scrolling="no" frameborder="0" allowtransparency="true"
		hspace="0" tabindex="-1" vspace="0"
		style="height: 100%">
			<p>
				Your browser does not support iframes. Please update your browser.
			</p>
		</iframe>
	</div>
</div>
<div> <!-- to replace with "header" tag -->
	<div id="header" class="navbar navbar-fixed-top">
		<div id="h-container" class="navbar-inner">
			<div class="container">
				<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span> 
				</a>
				<!-- Be sure to leave the brand out there if you want it shown -->
				<a class="brand" href="/" style="padding: 5px;">
						<img src="/skin/images/140/ls_logo_wide_white.png" style="display: block;">
				</a>
				<!-- Everything you want hidden at 940px or less, place within here -->
				<div class="nav-collapse">
					<ul class="nav pull-right">
						<?php if (isset($this->data['is_logged_in_admin']) && $this->data['is_logged_in_admin']) { ?>
						<li class="dropdown" id="menu0">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#menu0"> Admin <b class="caret"></b> </a>
							<ul class="dropdown-menu">
								<li>
									<a href="/admin/dashboard"><i class="icon-asterisk"></i> Dashboard</a>
								</li>
								<li>
									<a href="/statistics/users"><i class="icon-asterisk"></i> Statistics</a>
								</li>
								<li>
									<a href="/admin/dashboard/events"><i class="icon-asterisk"></i> Events</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="/invitations"><i class="icon-asterisk"></i> Invitation</a>
								</li>
							</ul>
						</li>
						<li class="divider-vertical"></li>
						<?php }?>
						<?php if (isset($is_logged_in) && $is_logged_in) { ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Discover <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li class="nav-header">People</li>
								<li>
									<a href="/search/people/"><i class="icon-user"></i> All</a>
								</li>
								<li>
									<a href="/search/people/trending"><i class="icon-user"></i> Trending</a>
								</li>
								<li class="divider"></li>
								<li class="nav-header">Projects</li>
								<li>
									<a href="/search/projects/"><i class="icon-folder-open"></i> All</a>
								</li>
								<li>
									<a href="/search/projects/trending"><i class="icon-folder-open"></i> Trending</a>
								</li>
								<li class="divider"></li>
								<li class="nav-header">Restaurants</li>
								<li>
									<a href="/places/all/restaurant"><i class="icon-map-marker"></i> All</a>
								</li>
								<li>
									<a href="/places/all/restaurant/trending"><i class="icon-map-marker"></i> Trending</a>
								</li>
							</ul>
						</li>
						<li class="dropdown" id="menu10">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#menu10">
								<?php echo $this -> session -> userdata['email'] ?> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="/settings/sync"><i class="icon-refresh"></i> Synchronize</a>
								</li>
								<li>
									<a href="/preferences"><i class="icon-tags"></i> Preferences</a>
								</li>
								<li>
									<a href="/schedules"><i class="icon-time"></i> Schedules</a>
								</li>
								<li>
									<a href="/events"><i class="icon-calendar"></i> Events</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="/invitations"><i class="icon-comment"></i> Invitation</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="/user/profile"><i class="icon-user"></i> My Profile</a>
								</li>
								<li>
									<a href="/user/wishlist"><i class="icon-lock"></i> My Lunch Wishlist</a>
								</li>
								<li>
									<a href="/settings"><i class="icon-flag"></i></i> Settings</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="/logout">Logout</a>
								</li>
							</ul>
						</li>
						<li>
							<div class="notification-toggle-container">
								<div id="notification-toggle" class="notification" title="Notifications">
									<span id="notification-toggle-count">0</span>
								</div>
							</div>
						</li>
						<?php } else {?>
						<li>
							<?php echo anchor('login', 'Login', array('from' => 'main'));?>
						</li>
						<li>
							<?php echo anchor('auth/signup', 'Signup', array('from' => 'main'));?>
						</li>
						<?php }?>
					</ul>
					<?php if (isset($is_logged_in) && $is_logged_in) { ?>
					<form class="navbar-search pull-right" action="/search/">
						<input type="text" name="q" class="search-query span2" placeholder="Search">
					</form>
					<?php }?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<script>
jQuery(function() {
	jQuery('.dropdown-toggle').dropdown();
});
</script>