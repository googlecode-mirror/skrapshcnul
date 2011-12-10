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
			<?php if (!empty($results['users'])) { ?>
			<table class="comfortable-table" cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Email</th>
						<th>Alias</th>
						<th>Name</th>
						<th>Created On</th>
						<th>Last Login</th>
						<th>Active</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($results['users'] as $user) { ?>
					<tr>
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