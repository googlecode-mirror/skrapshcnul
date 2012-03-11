<div class="m-content">
	<div id="people-container" class="c-pages shadow-rounded">
		<div style="padding:20px; min-height: 500px;">
			<div class="row-fluid">
  				<div class="span8">
					<h1><?php echo $tpl_page_title ?></h1>
					<p class="lead">Awesome users on Lunchsparks.</p>
  				</div>
  				<div class="span4">
  					<form action="/search/people/" class="form-search pull-right">
						<input type="text" class="input-medium search-query" placeholder="search..." value="<?php echo isset($query_result['q']) ? $query_result['q'] : '' ?>">
						<button type="submit" class="btn">Search</button>
  					</form>
  				</div>
  			</div>
			
			<div id="PeopleListingModel">
				<div id="masonry-container" data-bind="foreach: people" class="">
					<div class="pin">
						<div class="pin-details">
							<a data-bind="attr: {href: ls_pub_url}">
								<div class="pin-image"><img data-bind='attr: {src: profile_img}' /></div>
							</a>
							<div class="pin-data">
								<a data-bind="attr: {href: ls_pub_url}">
									<h3 data-bind='text: display_name'></h3>
								</a>
								<div data-bind='text: headline'></div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					
				</div>
			</div>
		
		</div>
		<div>
		
		<div class="clearfix"></div>
		</div>
	</div>
</div>

<?php //var_dump($users) ?>

<script>
var initialData = <?php echo json_encode($users); ?>;
 
var PeopleListingModel = function(people) {
	var self = this;
	self.people = ko.observableArray(ko.utils.arrayMap(people, function(user) {
		return { 
			id: user.id,
			display_name: user.display_name, 
			profile_img: user.profile_img, 
			headline: user.headline, 
			ls_pub_url: user.ls_pub_url,
			verification: ko.observableArray([user.verification])
		};
	}));
	
	self.loadmore = function() {
    }
};

ko.applyBindings(new PeopleListingModel(initialData), document.getElementById('PeopleListingModel'));

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
