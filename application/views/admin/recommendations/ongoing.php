<h2>On-going Recommendations</h2>
<div>
	Total records: <?php echo isset($results['recommendations_count']) ? $results['recommendations_count'] : 0;?>
</div>
<div>
	<?php if (!empty($results['recommendations'])) {
	?>
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
			<?php foreach($results['recommendations'] as $user) {
			?>
			<tr>
				<td><?php echo($user['index']);?></td>
				<td>
				<div class="ls-profile-hover" ls-data-userid="<?php echo $user['user_id'];?>">
					<?php echo($user['user_id']);?>
				</div></td>
				<td>
				<div class="ls-profile-hover" ls-data-userid="<?php echo($user['rec_id']);?>">
					<?php echo($user['rec_id']);?>
				</div></td>
				<td><?php echo($user['rec_reason']);?></td>
				<td><?php echo($user['timestamp']);?></td>
				<td><?php echo($user['valid'] ? "Yes" : "No");?></td>
			</tr>
			<?php }?>
		</tbody>
	</table>
	<div style="background: #F8F8F8; border: 1px solid #CCCCCC; padding: 10px; margin: 10px 0;">
		<div class="title" style="background: #F1F1F1; padding: 10px; cursor: pointer;" onclick="jQuery(this).next().toggle();">
			Create new recommendation.
		</div>
		<div style="display:block;">
			<form method="post" id="form_new_recommendation">
				<div>
					<div style="display: inline-block; width: 300px; vertical-align: top;">
						<label>User</label>
						<div class="caption">
							Enter the name of the user. Select from the dropdown list.
						</div>
						<input type="text" id="user_name" name="user_name" class="ls_user_autocomplete" placeholder="alias, firstname, lastname" />
						<input type="hidden" name="user_id">
					</div>
					<div style="display: inline-block; width: 50px; padding-top:10px; vertical-align: bottom;">
						<div class="ls-profile-hover" ls-data-userid="">
							<!-- image placeholder -->
						</div>
					</div>
				</div>
				<div>
					<div style="display: inline-block; width: 300px; vertical-align: top;">
						<label>Target User</label>
						<div class="caption">
							Enter the name of the user. Select from the dropdown list.
						</div>
						<input type="text" id="target_user_name" name="target_user_name" class="ls_user_autocomplete" placeholder="alias, firstname, lastname" />
						<input type="hidden" name="target_user_id">
					</div>
					<div style="display: inline-block; width: 50px; padding-top:10px; vertical-align: bottom;">
						<div class="ls-profile-hover" ls-data-userid="">
							<!-- image placeholder -->
						</div>
					</div>
				</div>
				<div>
					<label>Reason</label>
					<input type="text" id="reason" name="reason" placeholder="Reason" />
				</div>
				<input type="submit" />
			</form>
		</div>
	</div>
	<?php } else {?>
	<div class="">
		No records found.
	</div>
	<?php }?>
</div>

<script>
jQuery("#form_new_recommendation").submit(function() {
	alert('Handler for .submit() called.');
	var str = jQuery("#form_new_recommendation").serialize();
	jQuery.getJSON('/jsonp/recommendation/add/?alt=json&callback=?&'+str, {
	}, function(data){
		console.log(data);
	});
  	return false;
});
</script>
