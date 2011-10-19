<div id="invitations-invites">
	<div class="hr">
		<h2 class="hr-text">Invitation Status</h2>
	</div>
	<?php if (empty($invite_log)) { ?>
	<table class="invite-table table" cellspacing="0">
		<thead>
			<tr class="thead">
				<th>Email</th>
				<th>Invite Code</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<?php if (!empty($invite_logs)) { ?>
			<?php foreach ($invite_logs as $invite) { ?> 
			<?php $index = 0; ?>
			<tbody>
				<tr class="row-<?php echo $index ? $index++ : $index = 0; ?> row-item">
					<td><?php echo $invite['invitee_email']; ?></td>
					<td><?php echo $invite['invitation_code']; ?></td>
					<td><?php echo ($invite['joined_on']) ? "Joined" : 'Invited'; ?></td>
					<td>Resend</td>
				</tr>
			</tbody>
			<?php } ?>
		<?php } else { ?>
			<tr class="row-0">
				<td colspan="4"><div style="text-align: center;margin: 15px;">No one invited</div></td>
			</tr>
		<?php } ?>
	</table>
	<div style="text-align: center">
		<p>
			You have invited <?php echo count($invite_logs);?> friends and <?php echo count($invite_logs_number_signup);?> friends signed up.
		</p>
		<p>
			Invite more friends to join Lunchsparks!
		</p>
	</div>
	<?php } else { ?>
	<div class="" style="text-align: center;">
		<p>
			You have not invited anyone.
		</p>
		<p>
			Start inviting now.
		</p>
	</div>
	<?php } ?>
</div>