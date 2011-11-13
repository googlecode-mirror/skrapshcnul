<div class="m-content">
	<div id="announcements" class="shadow">
	</div>
	
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('admin/includes/sidetab');?>
	</div>
	
	<div class="m-content-2-col-right">
		
		<div class="hr">
			<h2 class="hr-text"><?php echo $tpl_page_title; ?></h2>
		</div>
		
		<div>Total records: <?php echo isset($results['total_records']) ? $results['total_records'] : 0; ?></div>
		
		<div>
			<table class="comfortable-table" cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Alias</th>
						<th>Name</th>
						<th>Email</th>
						<th>Created On</th>
						<th>Last Login</th>
						<th>Active</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($results['users'] as $user) { ?>
					<tr>
						<td><?php echo $user->id ?></td>
						<td style="text-align: left;">
							<div class="bubbleInfo">
								<span class="trigger"><?php echo $user->alias ?></span>
								<div class="popup">
									<a href="<?php echo $user->lunchsparks ?>">
										<img src="<?php echo $user->profile_img ?>">
									</a>
								</div>
							</div>
						</td>
						<td style="text-align: left;"><?php echo $user->email ?></td>
						<td style="text-align: left;"><?php echo $user->firstname ?>, <?php echo $user->lastname ?></td>
						<td><?php echo date("Y-m-d H:m:s" ,$user->created_on); ?></td>
						<td><?php echo date("Y-m-d H:m:s" ,$user->last_login); ?></td>
						<td><?php echo $user->active ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php echo ($pagination_links) ?>
		</div>
		
	</div>
</div>