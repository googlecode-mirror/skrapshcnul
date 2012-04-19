<div class="m-content">
	<div id="people-container" class="container">
		<div style="padding:20px; min-height: 500px;">
			<div class="clearfix">&nbsp;</div>
			
			<?php $this -> load -> view("base/search/includes/_people_menu.php");?>
			<div class="clearfix">&nbsp;</div>
			
			<div class="clearfix">&nbsp;</div>
			
			<div id="content" class="PeopleListingModel masonry-container">
				<?php $this -> load -> view("base/_tmpl/pin/people.php");?>
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