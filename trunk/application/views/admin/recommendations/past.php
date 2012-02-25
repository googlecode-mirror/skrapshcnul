<h2>Past Recommendations</h2>
	

<div>Total records: <?php echo isset($results['past_recommendations_count']) ? $results['past_recommendations_count'] : 0;?></div>

<div>
	<?php if (!empty($results['past_recommendations'])) { ?>
	<table class="comfortable-table" cellspacing="0">
		<thead>
			<tr>
				<th>Id</th>
				<th>User</th>
				<th>Target</th>
				<th>Reason</th>
				<th>Created On</th>
				<th>Valid</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($results['past_recommendations'] as $user) { ?>
			<tr>
				<td><?php echo($user['index']);?></td>
				<td>
					<div class="ls-profile-hover" ls-data-userid="<?php echo($user['user_id']);?>">
						<?php echo($user['user_id']);?>
					</div>
				</td>
				<td>
					<div class="ls-profile-hover" ls-data-userid="<?php echo($user['rec_id']);?>">
						<?php echo($user['rec_id']);?>
					</div>
				</td>
				<td><?php echo($user['rec_reason']);?></td>
				<td><?php echo($user['timestamp']);?></td>
				<td><?php echo($user['approved'] ? "Yes" : "No");?></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
	<?php } else {?>
		<div class="">No records found.</div>
	<?php }?>
</div>