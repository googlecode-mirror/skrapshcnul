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
			<?php if (!empty($results['preferences'])) { ?>
			<table class="comfortable-table" cellspacing="0">
				<thead>
					<tr>
						<th>Keywords</th>
						<th>Count</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($results['preferences'] as $preference) { ?>
					<tr>
						<td><?php echo $preference->keywords ?></td>
						<td><?php echo $preference->count ?></td>
						<td><a href="javascript:void(0);" onclick="preference_tag_recount(this);" ls:pref_tag="<?php echo $preference->keywords ?>">Recount</a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php } ?>
			
			<?php echo ($pagination_links) ?>
		</div>
		
	</div>
</div>