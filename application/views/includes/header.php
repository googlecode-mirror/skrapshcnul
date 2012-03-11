<div id="notifications-mini-area" class="floating-dialog">
	<iframe id="notifications-mini-iframe" src="<?php echo site_url("notifications/minified");?>" scrolling="no" frameborder="0" allowtransparency="true"
	hspace="0" tabindex="-1" vspace="0"
	style="height: 100%">
		<p>
			Your browser does not support iframes. Please update your browser.
		</p>
	</iframe>
</div>
<header>
	<div id="header" class="navbar navbar-static">
		<div id="h-container" class="navbar-inner">
			<div class=" row-fluid">
				<div class="span8">
					<div id="lunchsparks-header-logo" class="brand header-items">
						<?php echo anchor('', '<img src="'.base_url().'skin/images/140/ls_logo_wide_white.png" height="40px" style="display: block;">', array('from' => 'main'));?>
					</div>
					<?php if (isset($is_logged_in) && $is_logged_in ) { ?>
						<div id="h-menu" class="header-items">
							<ul class="nav pills">
								<li class="dropdown" id="menu1">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#menu1">
										Personal
										<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										<li><a href="/preferences"><i class="icon-tags"></i> Preferences</a></li>
										<li><a href="/schedules"><i class="icon-time"></i> Schedules</a></li>
										<li><a href="/events"><i class="icon-calendar"></i> Events</a></li>
										<li class="divider"></li>
										<li><a href="/invitations"><i class="icon-comment"></i> Invitation</a></li>
									</ul>
								</li>
								<li class="dropdown" id="menu2">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#menu2">
										Projects
										<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										<li><a href="/projects/my"><i class="icon-lock"></i> My Projects</a></li>
										<li><a href="/projects/add"><i class="icon-plus"></i> Add Project</a></li>
										<li class="divider"></li>
										<li><a href="/projects/all"><i class="icon-th-large"></i> All Projects</a></li>
										<li><a href="/projects/trending"><i class="icon-th-list"></i> Trending Projects</a></li>
									</ul>
								</li>
								<li class="dropdown" id="menu3">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#menu3">
										People
										<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										<li><a href="/people/wishlist"><i class="icon-lock"></i> My Lunch Wishlist</a></li>
										<li class="divider"></li>
										<li><a href="/search/people/"><i class="icon-th-large"></i> All Users</a></li>
									</ul>
								</li>
								<li class="dropdown" id="menu4">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#menu4">
										Places
										<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										<li><a href="/places/all"><i class="icon-map-marker"></i> All Places</a></li>
										<li><a href="/places/all#restaurant"><i class="icon-map-marker"></i> Restaurants</a></li>
									</ul>
								</li>
								<?php if (isset($this->data['is_logged_in_admin']) && $this->data['is_logged_in_admin']) { ?>
								<li class="dropdown" id="menu0">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#menu0">
										Admin
										<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										<li><a href="/admin/dashboard">Dashboard</a></li>
										<li><a href="/statistics">Statistics</a></li>
										<li><a href="/events">Events</a></li>
										<li><a href="/events">Events</a></li>
										<li class="divider"></li>
										<li><a href="/invitations">Invitation</a></li>
									</ul>
								</li>
								<li class="divider-vertical"></li>
								<li>
									<form method="get" action="/search/" class="form-search">
										<input name="q" type="text" class="input-medium search-query" placeholder="Search...">
										<button type="submit" class="btn"><i class="icon-search"></i></button>
									</form>
								</li>
								<?php } ?>
							</ul>
						</div>
					<?php } ?>
				</div>
				
				<div class="span4">
					<div id="h-uacc" class="header-items">
						<div id="lunchsparks-header-logo" class="brand header-items"></div>
						<ul  class="nav pills">
							<?php if ($is_logged_in) { ?>     
							<li>
								<div class="notification-toggle-container">
									<div id="notification-toggle" class="notification" title="Notifications">
										<span id="notification-toggle-count">0</span>
									</div>
								</div>
							</li>
							<li class="dropdown" id="menu10">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#menu10">
									<?php echo $this -> session -> userdata['email'] ?>
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="/user/profile"><i class="icon-user"></i> My Profile</a></li>
									<li><a href="/settings"><i class="icon-cog"></i> Settings</a></li>
									<li class="divider"></li>
									<li><a href="/settings"><i class="icon-flag"></i></i> Settings</a></li>
									<li class="divider"></li>
									<li><a href="/logout">Logout</a></li>
								</ul>
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
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</header>

<script>
jQuery('.dropdown-toggle').dropdown();
</script>
</script>
