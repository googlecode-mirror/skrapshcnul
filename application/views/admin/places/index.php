<script src="<?php echo base_url();?>skin/js/angularjs/angular-0.9.19.min.js" ng:autobind></script>

<div class="m-content">
	<div id="announcements" class="shadow">
	</div>
	
	<?php //var_dump($places); ?>
	
	<div ng:init='places = (<?php echo json_encode($places);?>)'></div>
		
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('admin/includes/sidetab');?>
	</div>
	
	<div class="m-content-2-col-right">
		
		<div class="hr">
			<h2 class="hr-text"><?php echo $tpl_page_title; ?></h2>
		</div>
		
		<div>
			<div class="button-set" style="float: left; padding: 15px;">
				<a href="/places/add" target="blank">Add Place</a>
			</div>
			<div style="float: right;">
				<span class="sub-heading" style="color: #AFADAD;">Filter: </span>
				<input type="text" name="searchText" placeholder="keywords." style="display: inline-block;" />
			</div>
			<div class="clearfix"></div>
		</div>

		<div id="schedule-containers" ng:controller="PlacesController">
			<div ng:repeat="place in places.$filter(searchText)">
				<div class="row-item-simple">
					<div class="content-top-row">
						<div class="f-options-set">
							<ul>
								<li class="button button-grey">
									<a href="/places/{{place.place_id}}" target="blank">View</a>
								</li>
								<li class="button button-grey">
									<a href="/places/edit/{{place.place_id}}" target="blank">Edit</a>
								</li>
							</ul>
						</div>
						<div class="xbigger">
							{{place.name}}
						</div>
						<div class="xsmaller">
							{{place.location}}
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="clearfix">&nbsp;</div>
		</div> <!-- #schedule-containers -->
	</div>
	
	
</div>

<script>
PlacesController.$inject = ['$resource'];
function PlacesController($resource) {
	var scope = this;
	
	this.Places = $resource(
	  '/json/places/:func/',
	  { alt: 'json', callback: 'JSON_CALLBACK'},
	  { get:  {method: 'JSON', params: {func: 'select', visibility: '@self'}},
	    del:  {method: 'JSON', params: {func: 'delete', visibility: '@self'}}
	  });
    
};

ScheduleController.prototype = {
	getList : function() {
		this.schedules = this.Schedules.get();
	},
	deleteSchedules : function(data, schedule) {
		if(confirm('Are you sure you want to delete?')) {
			this.schedules = this.Schedules.del({index: data.index});
		}
	}
};

</script>