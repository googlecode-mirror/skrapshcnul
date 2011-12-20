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
		
		<h2>On-going Recommendations</h2>
		
		<div>Total records: <?php echo isset($results['recommendations_count']) ? $results['recommendations_count'] : 0; ?></div>
		
		<div>
			<?php if (!empty($results['recommendations'])) { ?>
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
					<?php foreach($results['recommendations'] as $user) { ?>
					<tr>
						<td><?php echo ($user['index']); ?></td>
						<td>
							<div class="ls-profile-hover" ls-data-userid="<?php echo $user['user_id']; ?>">
								<?php echo ($user['user_id']); ?>
							</div>
						</td>
						<td>
							<div class="ls-profile-hover" ls-data-userid="<?php echo ($user['rec_id']); ?>">
								<?php echo ($user['rec_id']); ?>
							</div>
						</td>
						<td><?php echo ($user['rec_reason']); ?></td>
						<td><?php echo ($user['timestamp']); ?></td>
						<td><?php echo ($user['valid'] ? "Yes" : "No"); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div style="background: #F8F8F8; border: 1px solid #CCCCCC; padding: 10px; margin: 10px 0;">
				<div class="title" style="background: #F1F1F1; padding: 10px; cursor: pointer;" onclick="jQuery(this).next().toggle();">Create new recommendation.</div>
				<div style="display:none;">
					<form method="post">
						<div>
							<label>User ID</label>
							<input type="text" />
						</div>
						<div>
							<label>Target User ID</label>
							<input type="text" />
						</div>
						<div>
							<label>Reason</label>
							<input type="text" />
						</div>
						<input type="submit" />
					</form>
				</div>
			</div>
			<?php } else { ?>
				<div class="">No records found.</div>
			<?php }?>
		</div>
		
		<br /><br />
		
		<h2>Past Recommendations</h2>
		
		
		<div>Total records: <?php echo isset($results['past_recommendations_count']) ? $results['past_recommendations_count'] : 0; ?></div>
		
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
						<td><?php echo ($user['index']); ?></td>
						<td>
							<div class="ls-profile-hover" ls-data-userid="<?php echo ($user['user_id']); ?>">
								<?php echo ($user['user_id']); ?>
							</div>
						</td>
						<td>
							<div class="ls-profile-hover" ls-data-userid="<?php echo ($user['rec_id']); ?>">
								<?php echo ($user['rec_id']); ?>
							</div>
						</td>
						<td><?php echo ($user['rec_reason']); ?></td>
						<td><?php echo ($user['timestamp']); ?></td>
						<td><?php echo ($user['valid'] ? "Yes" : "No"); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php } else { ?>
				<div class="">No records found.</div>
			<?php }?>
		</div>
	</div>
</div>