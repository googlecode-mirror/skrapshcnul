<div class="m-content">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('invitations/includes/sidetab');?>
	</div>
	<div class="m-content-2-col-right">
		<div id="invitations-invites">
			<h2>Invitation Status</h2>
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
					You have invited <?php echo $number_invites
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
			<div class="" style="text-align: center;">
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
</div>