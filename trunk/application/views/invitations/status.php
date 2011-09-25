<div class="m-content">
	<div id="invitations-invites">
		<?php if (isset($invites)) {
		?>
		<table class="invite-table table">
			<thead>
				<tr>
					<th>Email</th>
					<th>Invite Code</th>
					<th>Status</th>
				</tr>
			</thead>
			<?php foreach ($invites as $invite) {
			?>
			<tbody>
				<tr>
					<td><?php echo $invite['invitee_email']
					?></td>
					<td><?php echo $invite['invitation_code']
					?></td>
					<td><?php echo ($invite['joined_on']) ? "Joined" : 'Invited';
					?></td>
				</tr>
			</tbody>
			<?php }?>
		</table>
		<div style="text-align: center">
			<p>
				So far, you have invited <?php echo $number_invites
				?>
				friends and <?php echo $number_signup
				?>
				friends signed up
			</p>
			<p>
				Invite more people to join Lunchsparks!
			</p>
		</div>
		<?php } else {?>
		<div class="m-content">
			<p>
				You have not invited anyone.
			</p>
			<p>
				Start inviting now.
			</p>
		</div>
		<?php }?>
	</div>
</div>