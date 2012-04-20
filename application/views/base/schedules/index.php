<script src="<?php echo base_url();?>skin/js/angularjs/angular-0.9.19.min.js" ng:autobind></script>
<div class="container">
	<div class="c-pages">
		<h2><?php echo $tpl_page_title; ?></h2>
		<h3 class="sub-heading">Enter your schedule here, so our system can arrange the timing that suits you.</h3>
		
		<div>
			<div class="button-set" style="float: left; padding: 15px;">
				<a href="/schedules/add">Add Schedule</a>
			</div>
			<div style="float: right;">
				<span class="sub-heading" style="color: #AFADAD;">Filter: </span>
				<input type="text" name="searchText" placeholder="keywords." style="display: inline-block;" />
			</div>
			<div class="clearfix"></div>
		</div>
		
		<div ng:init='schedules = (<?php echo json_encode($fixed_schedules);?>)'></div>
		
		<div id="schedule-containers" ng:controller="ScheduleController">
			<div ng:repeat="schedule in schedules.results.$filter(searchText)">
				<div class="schedule-item row-item">
					<div class="content-top-row section-top">
						<div class="f-options-set">
							<ul>
								<li class="button button-grey">
									<a href="/schedules/edit/id/{{schedule.index}}">Edit</a>
								</li>
								<li class="button button-grey">
									<a href="" id="{{schedule.index}}" class="delete-schedule" 
										ng:click="deleteSchedules({index: schedule.index}, schedule);">Delete</a>
								</li>
							</ul>
						</div>
						<div class="xbigger">
							{{schedule.name}}
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="section-middle">
						<div class="column-2-left">
							<div class="g-static-maps">
								<img src="{{getGMapStaticEncodedURL(schedule.center_lat,schedule.center_lng,schedule.radius);}}" />
							</div>
						</div>
						<div class="column-2-right box-details schedule">
							<div>
								<span class="title">Selected Timeslots </span>
							</div>
							<div ng:repeat="repeat_param in schedule.repeat_params" class="row-item-faded">
								<div class="column-2-left-xs">
									{{repeat_param.DAY}}
								</div>
								<div class="column-2-right-xl">
									<input type="hidden" name="repeat_param.LUNCH">
									<div ng:show="repeat_param.LUNCH">
										Lunch
									</div>
									<input type="hidden" name="repeat_param.DINNER">
									<div ng:show="repeat_param.DINNER">
										Dinner
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix">&nbsp;</div>
			</div>
			<div class="clearfix">&nbsp;</div>
		</div> <!-- #schedule-containers -->
		
		<div></div>
		
	</div>
</div>
