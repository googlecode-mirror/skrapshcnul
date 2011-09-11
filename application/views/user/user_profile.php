<div id="profile-container">
	<div class="column-2-left">
		<div id="profile-picture">
			<a href="" class="edit-overlay">Edit Profile Picture</a>
			<img src="<?php echo $user_profile['profile_img'] ?>" class="profile_img"/>
		</div>
	</div>
	<div class="column-2-right">
		<div class="header-area">
			<div id="profile-data-name">
				<h1><?php echo $user_profile['name'] ?></h1>
			</div>
			<div id="profile-data-company">
				<?php echo $user_profile['title'] ?> at <?php echo $user_profile['company'] ?> 	
			</div>
		</div>
		<div class="content-area">
			<div class="title">Activity</div>
			<div class="stream">
				<?php foreach ($activity_list as $activity_item) {?>
				<div class="stream-item">
				  <?php echo $activity_item['data'] ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
