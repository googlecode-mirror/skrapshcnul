<div>
	<div class="hr">
		<h2 class="hr-text">Invite your friends!</h2>
	</div>
	<div id="invitation_left_box">
		<div style="text-align: center; margin: 5px">
			You have
		</div>
		<div class="invitation-left">
			<?php echo $invitation['invitation_left']; ?>
		</div>
		<div style="text-align: center; margin: 5px">
			<?php echo ($invitation['invitation_left'] > 1) ? 'Invitations' : 'Invitation' ?> left
		</div>
	</div>
	<div style="text-align: center;">
		
		<?php if($this->session->flashdata('message' )) { ?>
		<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
			<p>
				<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
				<?php echo $this -> session -> flashdata('message');?>
			</p>
		</div>
		<?php } ?>
		
		<?php if ($invitation['invitation_left'] > 0) { ?>
		<div style="margin: 10px 0;">
			Invite your friends!
		</div>
		<?php echo form_open('/invitations/invite'); ?>
			<input type="email" placeholder="your friends email" name="invitee_email" id="invitee_email" style="display: inline-block;">
			<input type="submit" value="Invite" name="invite_btn" id="invite_btn" class="button" style="padding:5px 25px;font-size: 110%; display: inline-block;">
		<?php echo form_close(); ?>
		<?php } else {?>
		<p>
			Don't worry, hang in there, we will be sending you some real soon! :)
		</p>
		<?php }?>
	</div>
	<br />
</div>