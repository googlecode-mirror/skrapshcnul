<div class="m-content">
	<div id="people-container" class="container">
		<div style="padding:20px; min-height: 500px;">
			<div class="clearfix">&nbsp;</div>
			
			<?php /* <h1><?php echo $tpl_page_title ?> <small>Awesome users on Lunchsparks.</small></h1> */ ?>
			
			<div class="row-fluid">
				<div class="span12">
					<ul class="nav nav-pills pull-left">
						<li>
							<h2>Search &nbsp;</h2>
						</li>
						<li>
							<div class="btn-group">
								<button class="btn btn-large dropdown-toggle" data-toggle="dropdown">People <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a href="/search/tags/<?php echo ($_SERVER['QUERY_STRING']) ? '?' . ($_SERVER['QUERY_STRING']) : ''; ?>">Tag</a></li>
									<li><a href="/search/projects/<?php echo ($_SERVER['QUERY_STRING']) ? '?' . ($_SERVER['QUERY_STRING']) : ''; ?>">Projects</a></li>
								</ul>
							</div>
						</li>
					</ul>
					
					<ul class="nav nav-pills pull-right">
						<li>
							<form action="/search/people/" class="form-search">
								<input name="q" type="text" class="input-medium search-query" placeholder="search..." value="<?php echo isset($q) ? $q : '' ?>">
								<button type="submit" class="btn">
									<i class="icon-search"></i>
								</button>
							</form>
						</li>
					</ul>
					
				</div>
			</div>
			
			<div class="clearfix">&nbsp;</div>
			
			<div id="PeopleListingModel">
				<div id="masonry-container">
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
				</div>
				<div data-bind="visible: people().length < 1">
					<div class="row-fluid">
						<div class="span4">
							&nbsp;
						</div>
						<div class="span4 well pagination-centered">
							Opps... No Results found for "<em><strong><?php echo isset($q) ? $q : '' ?></strong></em>".
						</div>
						<div class="span4">
							&nbsp;
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<?php //var_dump($users)?>

<script>var initialData =<?php echo json_encode($users);?>
		;

		var PeopleListingModel = function(people) {
			var self = this;
			self.people = ko.observableArray(ko.utils.arrayMap(people, function(user) {
				return {
					id : user.id,
					display_name : user.display_name,
					profile_img : user.profile_img,
					headline : user.headline,
					ls_pub_url : user.ls_pub_url,
					verification : ko.observableArray([user.verification])
				};
			}));

			self.loadmore = function() {
			}
		};

		ko.applyBindings(new PeopleListingModel(initialData), document.getElementById('PeopleListingModel'));

	<?php /* jQuery('#masonry-container').imagesLoaded(function(){
	 jQuery('#masonry-container').masonry({
	 // options
	 itemSelector : '.pin'
	 });
	 }); */
	?>
		jQuery(window).scroll(function() {
			if(jQuery(window).scrollTop() >= jQuery(document).height() - jQuery(window).height() - 10) {
				if(window.console)
					console.log('end of page');
			}
		});

</script>
