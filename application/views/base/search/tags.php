<div class="container c-pages">
	<div style="padding:20px; min-height: 500px;">
		
		<?php $this -> load -> view("base/search/includes/_tags_menu.php");?>
		<div class="clearfix">&nbsp;</div>
		
		<div id="content" class="ProjectsListingModel masonry-container">
			<?php if (is_array($tags) && sizeof($tags)) { ?>
				<?php foreach($tags as $tag) { ?>
					<span>
						<a href="/search/tags/<?php echo $tag['keywords'] ?>">
							<?php echo $tag['keywords'] ?>
						</a> 
						(<?php echo $tag['count'] ?>)
					</span>
				<?php } ?> 
			<?php } ?>
		</div>
	</div>
</div>

<script>
/*jQuery(document).ready(function() {
	google.maps.event.addDomListener(window, 'load', initiate_geolocation);
});*/
</script>
