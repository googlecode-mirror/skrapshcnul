<div>
	<div class="hr">
		<h2 class="hr-text">Invite your friends!</h2>
	</div>
	<div id="invitation_left_box">
		<div style="text-align: center; margin: 5px">
			You have
		</div>
		<div id="invitation-left-number" class="invitation-left">
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
		<div>
			<?php
			$attributes = array('class' => 'invitee_email_frm', 'id' => 'invitee_email_frm');
			echo form_open('/invitations/invite', $attributes); 
			?>
			<div style="display: inline-block;">
				<input type="email" placeholder="Enter your friend's email here." name="invitee_email" id="invitee_email" class="withToolTip" style="display: inline-block;" required="required">
				<span id="invitee_email_tooltip" class="input-tooltip">
					Enter your friend's email here.
				</span>
			</div>		
			<button type="submit" value="Invite" name="invitee_email_btn" id="invitee_email_btn" class="button" style="padding:5px 25px;font-size: 110%; display: inline-block;">Invite</button>
			<?php /* <input onclick="invitee_email_submit();" type="submit" value="Invite" name="invitee_email_btn" id="invitee_email_btn" class="button" style="padding:5px 25px;font-size: 110%; display: inline-block;">*/ ?>
			<?php echo form_close(); ?>
			
			<div class="ui-state-highlight ui-corner-all ajax-highlight"> 
				<p id="invitee_email_results">
				</p>
			</div>
		</div>
		<?php } else {?>
		<p>
			Don't worry, hang in there, we will be sending you some real soon! :)
		</p>
		<?php }?>
	</div>
	<br />
</div>