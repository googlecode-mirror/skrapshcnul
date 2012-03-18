<div class="m-content">
	<div id="places-container" class="c-pages shadow-rounded" style="padding: 100px;">
		
		<?php var_dump($fb_data); ?>
		
		<?php if(!$fb_data['user_profile']): ?>
		Please login with your FB account: <a href="<?php echo $fb_data['loginUrl'];?>">login</a>
		<!-- Or you can use XFBML -->
		<div class="fb-login-button" data-show-faces="false" data-width="100" data-max-rows="1" data-scope="email,user_birthday,publish_stream"></div>
		<?php else:?><img src="https://graph.facebook.com/<?php echo $fb_data['uid'];?>/picture" alt="" class="pic" />
		<p>
			Hi <?php echo $fb_data['user_profile']['name'];?>,
			<br />
			<a href="<?php echo site_url('topsecret');?>">You can access the top secret page</a> or <a href="<?php echo $fb_data['logoutUrl'];?>">logout</a>
		</p>
		<?php endif;?>
		
		<?php var_dump($user_profile); ?>
	</div>
</div>