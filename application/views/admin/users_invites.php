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
			<?php if (!empty($results['users'])) { ?>
			<table class="comfortable-table" cellspacing="0">
				<thead>
					<tr>
						<th>User Id</th>
						<th>Email</th>
						<th>Name</th>
						<th>Last Updated</th>
						<th>Remaining Invites</th>
						<th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($results['users'] as $user) { ?>
					<tr>
						<td><?php echo $user->user_id; ?></td>
						<td style="text-align: left;">
							<div class="ls-profile-hover" ls-data-userid="<?php echo $user->user_id; ?>"><?php /* <div class="bubbleInfo"> */ ?>
								<span class="trigger"><?php echo !empty($user->alias) ? $user->alias : "[ no alias ]"?></span>
								<div class="popup">
									<a href="<?php echo $user->lunchsparks ?>">
										<img src="<?php echo $user->profile_img ?>">
									</a>
								</div>
							</div>
						</td>
						<td style="text-align: left;"><?php echo $user->firstname ?>, <?php echo $user->lastname ?></td>
						<td><?php echo $user->updated_on; ?></td>
						<td><span id="<?php echo $user->user_id; ?>_invitation_left"><?php echo $user->invitation_left; ?></span></td>
						<td>
							<a href="javascript:void(0)" onclick="addInvitation(<?php echo $user->user_id ?>);">
								Add
							</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php } ?>
			
			<?php echo ($pagination_links) ?>
		</div>
		
	</div>
</div>