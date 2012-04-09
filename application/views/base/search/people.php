<div class="m-content">
	<div id="people-container" class="container">
		<div style="padding:20px; min-height: 500px;">
			<div class="clearfix">&nbsp;</div>
			
			<?php $this -> load -> view("base/search/includes/_people_menu.php");?>
			<div class="clearfix">&nbsp;</div>
			
			<div class="clearfix">&nbsp;</div>
			
			<div id="content" class="PeopleListingModel masonry-container">
				<?php if (is_array($users) && sizeof($users) > 0) { ?>
					<?php foreach ($users as $user) { ?>
					<div class="pin people">
						<div class="pin-details">
							<div class="pin-image">
								<a href="<?php echo $user['ls_pub_url'] ?>"> <img src="<?php echo $user['profile_img'] ?>" /> </a>
							</div>
							<div class="pin-data">
								<a href="<?php echo $user['ls_pub_url'] ?>"> <h3><?php echo $user['display_name']
								?></h3> </a>
								<div>
									<?php echo $user['headline']
									?>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php }?>
				<?php } ?>
			</div>
			
			<div class="navigation pagination-centered hidden">
				<ul>
					<li>
						<a href="<?php echo isset($pagination['next_page_url']) ? $pagination['next_page_url'] : ''; ?>">Load More</a>
					</li>
				</ul>
			</div>
			
			<div class="clearfix">&nbsp;</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<script>
$('#content').infinitescroll({
 
navSelector  : "div.navigation",            
               // selector for the paged navigation (it will be hidden)
nextSelector : "div.navigation a:first",    
               // selector for the NEXT link (to page 2)
itemSelector : "#content div.pin",          
               // selector for all items you'll retrieve
loading      : {
	msgText      : "Loading more results...",
	finishedMsg  : "End of results."
}
});
</script>