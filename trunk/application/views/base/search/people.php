<div class="m-content">
	<div class="c-pages shadow-rounded">
		
		<div>
		<div style="float: right;">
			<input type="text" class="search" placeholder="Search tag..." value="<?php echo isset($query_result['keyword']) ? $query_result['keyword'] : "" ?>" />
		</div>
		<h1><?php echo $tpl_page_title ?></h1>
		<div class="clearfix"></div>
		</div>
		
		<div id="results-container">
		<?php if(isset($query_result)) { ?>
			
			<div>
			<?php echo $query_result['count'] ?> person found for <?php echo isset($query_result['keyword']) ? $query_result['keyword'] : "" ?>
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
		
		<div>
		<?php if (isset($users) && count($users) > 0) { ?>
			<?php $i = 0 ?>
			<?php foreach ($users as $user) { ?>
				<div class="profile-img-45 hover-profile-card" ls:uid="<?php echo !empty($user['user_id']) ? $user['user_id'] : '' ?>">
					<a href="/pub/<?php echo !empty($user['alias']) ? $user['alias'] : $user['user_id'] ?>">
						<img title="<?php echo ($user['firstname']) ?>" 
							src="<?php echo ($user['profile_img']) ?>">
					</a>
				</div>
				<?php //var_dump($user); ?>
				
				
				<?php $profileImg_mapPin = base_url('/media/images/profile/32/'.$user['user_id'].'.jpg') ?>
				
			<?php } ?>
		<?php } ?>
		</div>
		<div class="clearfix"></div>
		
		</div>
	</div>
</div>
<script>
var persons = <?php echo json_encode($person_arr); ?>;
</script>

