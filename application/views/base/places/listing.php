<div class="m-content">
	<div id="places-container" class="c-pages shadow-rounded" style="padding: 0px;">
		<div style="padding:20px; min-height: 500px;">
			<h1><?php echo $tpl_page_title; ?></h1>
		
			<div id="PlacesListingModel">
				<div id="masonry-container" data-bind="foreach: places" class="">
					<div class="pin">
						<div class="pin-details">
							<a data-bind="attr: {href: '/places/'+place_id}">
								<div class="pin-image"><img data-bind='attr: {src: logo}' /></div>
							</a>
							<div class="pin-data">
								<a data-bind="attr: {href: '/places/'+place_id}">
									<h3 data-bind='text: name'></h3>
								</a>
								<div data-bind='text: location'></div>
							</div>
							<div class="pin-stats" data-bind="foreach: statistics">
								<span class="likes"><span data-bind="text: favourites"></span> favourites</span>
							</div>
						</div>
						<div class="pin-extras">
							<h5>Cuisine</h5>
							<div data-bind="foreach: cuisine">
								<div class="tag"> 
									<a data-bind="attr: {href: '/search/places/?q='+name}">
										<span data-bind="text: name"></span>
									</a>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
</div>
<div class="clearfix">&nbsp;</div>

<?php var_dump($places); ?>

<script>
var initialData = <?php echo json_encode($places); ?>;
 
var PlacesListingModel = function(places) {
	var self = this;
	self.places = ko.observableArray(ko.utils.arrayMap(places, function(place) {
		return { 
			place_id: place.place_id,
			logo: place.logo, 
			name: place.name, 
			status: place.status,
			opening_hours: place.opening_hours,
			cuisine: ko.observableArray(ko.utils.arrayMap((place.cuisine)? (place.cuisine).split(',') : '', function(cuisine) {
				console.log(cuisine);
				return {
					name: cuisine
				}
			})),
			location: place.location,
			statistics: ko.observableArray([place.statistics])
		};
	}));
	
	self.loadmore = function() {
    }
};

ko.applyBindings(new PlacesListingModel(initialData), document.getElementById('PlacesListingModel'));

jQuery('#masonry-container').imagesLoaded(function(){
	jQuery('#masonry-container').masonry({
		// options
		itemSelector : '.pin'
	});
});

jQuery(window).scroll(function () { 
   if (jQuery(window).scrollTop() >= jQuery(document).height() - jQuery(window).height() - 10) {
      if(window.console) console.log('end of page');
   }
});

</script>