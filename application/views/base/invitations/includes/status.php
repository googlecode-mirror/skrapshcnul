<div id="invitations-invites" class="row-item">
	<div class="section-top">
		Invitation Status
	</div>
	<?php if (!empty($invite_logs)) { ?>
		<div class="section-middle" style="padding:0;">
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
							<td><a href="#" id="resendInvitation" onclick="resendInvitation('<?php echo $invite['invitee_email']; ?>')">Resend</a></td>
						</tr>
					</tbody>
					<?php } ?>
				<?php } else { ?>
					<tr class="row-0">
						<td colspan="4"><div style="text-align: center;margin: 15px;">No one invited</div></td>
					</tr>
				<?php } ?>
			</table>
			<div class="ui-state-highlight ui-corner-all ajax-highlight"> 
				<p id="invitee_email_results">
				</p>
			</div>
			
			<div style="text-align: center">
				<p>
					You have invited <?php echo count($invite_logs);?> friends and <?php echo count($invite_logs_number_signup);?> friends have signed up.
				</p>
				<p>
					<a href="#invitee_email" onclick="inviteMoreFriends()">Invite more friends to join Lunchsparks!</a>
				</p>
			</div>
			<div class="clearfix">&nbsp;</div>
		</div>
	<?php } else { ?>
		<div class="content-unavailable">
			<p>
				You have not invited anyone.
			</p>
			<p>
				Start inviting now.
			</p>
		</div>
	<?php } ?>
</div>

<script>
function inviteMoreFriends() {
	jQuery("input[name=invitee_email]").focus();
	return false;
}
</script>