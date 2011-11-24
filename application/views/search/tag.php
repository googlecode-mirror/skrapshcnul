<div class="m-content">
	<div class="c-pages shadow-rounded">
		<h1>Search</h1>
		
		<div>
		<?php if(isset($query_result)) { ?>
			
			<div>
			<?php echo $query_result['count'] ?> person found for <?php echo $query_result['keyword'] ?>
			</div>	
			
			<div>
			<?php if(isset($query_result['similar_keywords']) && count($query_result['similar_keywords']) > 1) { ?>
				Similar results 
				<?php foreach ($query_result['similar_keywords'] as $keyword) { ?>
					<a href="/search/tag/<?php echo $keyword ?>"><?php echo $keyword ?></a>,
				<?php } ?>
			<?php } ?>
			<?php //var_dump($query_result); ?>
				
			</div>
		<?php } ?>
		</div>
		
		<div>
		<?php if (isset($users) && count($users) > 0) { ?>
		<?php foreach ($users as $user) { ?>
			<div class="profile-img-45">
				<a href="/pub/<?php echo !empty($user['alias']) ? $user['alias'] : $user['user_id'] ?>">
					<img title="<?php echo ($user['firstname']) ?>" 
						src="<?php echo ($user['profile_img']) ?>">
				</a>
			</div>
			<?php //var_dump($user); ?>
		<?php } ?>
		<?php } ?>
		</div>
		<div class="clearfix"></div>
		
		
		
		
		
		
	</div>
</div>