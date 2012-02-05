<div class="m-content">
	<div class="c-pages shadow-rounded">
		<h2><?php echo $tpl_page_title; ?></h2>
		<h3 class="sub-heading">Enter your schedule here, so our system can arrange the timing that suits you.</h3>
		
		<div ng:init='schedules = (<?php echo json_encode($fixed_schedules);?>)'></div>
		<div>
			<div class="button-set" style="float: left;">
				<a >Add Schedule</a>
			</div>
			<div style="float: right;">
				<span>Filter: </span>
				<input type="text" name="searchText" placeholder="keywords." style="display: inline-block;" />
			</div>
			<div class="clearfix"></div>
		</div>
		<div id="schedule-containers" ng:controller="ScheduleController">
			<div ng:repeat="schedule in schedules.results.$filter(searchText)" class="schedule-item row-item">
				<div class="content-top-row">
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
				</div>
				<div class="clearfix"></div>
				<div class="content-left-col">
					<div>
						<span class="title">Date: </span>{{schedule.startDate}}
					</div>
					<div>
						<span class="title">Time: </span>{{schedule.startTime}} to {{schedule.endTime}}
					</div>
					<div>
						<span class="title">Repeat: </span>
						<span>
							{{schedule.repeat_params.repeat_frequency}}
						</span>
						<div>
							<span ng:repeat="day in schedule.repeat_params.repeat_day">
								{{day}}, 
							</span>
						</div>
					</div>
				</div>
				<div class="content-right-col">
					<div class="g-static-maps">
						<span class="title">Location: </span>
						<img src="{{getGMapStaticEncodedURL(schedule.center_lat,schedule.center_lng,schedule.radius);}}" />
					</div>
				</div>
			</div>
		</div> <!-- #schedule-containers -->
		
		<div></div>
		
	</div>
</div>
