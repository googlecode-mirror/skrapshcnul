<div class="row-fluid">
	<div class="span3" style="width: 200px;">
		<img src="<?php echo($tag['tag_icon']);?>" style="max-width: 200px;">
	</div>
	<div class="span4">
		<div class="name">
			<span><h2><?php echo($tag['keywords']);?></h2></span>
		</div>
		<div class="description">
			<?php echo($tag['description']);?> 
		</div>
		<div>
			<ul class="unstyled">
				<li><i class="icon-user"></i> Users with this tag: <?php echo $tag['statistics']['users'] ?></li>
				<li><i class="icon-folder-open"></i> Projects with this tag: <?php echo $tag['statistics']['projects'] ?></li>
				<?php /* <li><i class="icon-folder-open"></i> Places with this tag: <?php echo $tag['statistics']['places'] ?></li> */ ?>
			</ul>
		</div>
	</div>
	<div class="span5">
		<div class="dashboard-featured-statistics pull-right">
			<div class="ratings">
				<div class="rating-points">
					<span class="points"><?php echo  isset($tag['statistics']['trend']) ? $tag['statistics']['trend'] : '-';?></span>
					<div class="fields">Trend</div>
				</div>
			</div>
			
			<div class="ratings">
				<div class="rating-points">
					<span class="points"><?php echo  isset($tag['statistics']['favourite']) ? $tag['statistics']['favourites'] : '-';?></span>
					<div class="fields" style="">Favourites</div>
				</div>
			</div>
		</div>
		
		
	</div>
</div>
<hr>
<div class="similar_tag">
	<h4>Simlar Tags</h4>
	<?php if (isset($tags_similar) && is_array($tags_similar)) { ?>
		 <?php foreach ($tags_similar as $tag_item) { ?>
		 	<span class="tag">
		 		<a href="/search/tags/<?php echo $tag_item['keywords'] ?>"><?php echo $tag_item['keywords'] ?></a> 
		 		(<?php echo $tag_item['count'] ?>)
		 	</span>
		 <?php } ?>
	<?php } ?>
</div>
<div class="clearfix">&nbsp;</div>