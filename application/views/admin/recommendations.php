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
		
		<div>Total records: <?php echo isset($results['total_records']) ? $results['total_records'] : 0; ?></div>
		
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
						<td><?php echo ($user->index); ?></td>
						<td><?php echo ($user->user_id); ?></td>
						<td><?php echo ($user->rec_id); ?></td>
						<td><?php echo ($user->rec_reason); ?></td>
						<td><?php echo ($user->timestamp); ?></td>
						<td><?php echo ($user->valid ? "Yes" : "No"); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php } ?>
			<?php echo ($pagination_links) ?>
			
		</div>
		
		<h2>Past Recommendations</h2>
		
		
		
	</div>
</div>