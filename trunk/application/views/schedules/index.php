<div class="m-content">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('schedules/includes/sidetab');?>
	</div>
	<div class="m-content-2-col-right">
		<h2>Events</h2>
		<div class="hr">
			<h2 class="hr-text">Added Schedules</h2>
		</div>
		<div>
			<?php //echo json_encode($fixed_schedules);?>
		</div>
		<div ng:init='schedules = <?php echo json_encode($fixed_schedules);?>'></div>
		<div>
			<span>Search: </span>
			<input type="text" name="searchText" placeholder="search keywords." style="display: inline-block;" />
		</div>
		<div id="schedule-containers" ng:controller="ScheduleController">
			<div ng:repeat="schedule in schedules.$filter(searchText)" class="schedule-item row-item">
				<div class="content-top-row">
					<div class="f-options-set">
						<ul>
							<li class="button button-grey">
								<a href="/schedules/edit/id/{{schedule.index}}">Edit</a>
							</li>
							<li class="button button-grey">
								<a href="/schedules/delete/id/{{schedule.index}}"
								onclick="return confirm('Are you sure you want to delete?')">Delete</a>
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
						<span class="title">Repeat: </span>{{schedule.params}}
					</div>
				</div>
				<div class="content-right-col">
					<div class="g-static-maps">
						<span class="title">Location: </span>
						<img src="{{returntxt(schedule.center_lat,schedule.center_lng,schedule.radius)}}" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
