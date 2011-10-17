<div class="m-content">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('invitations/includes/sidetab');?>
	</div>
	<div class="m-content-2-col-right">
		
		<div class="hr">
			<h2 class="hr-text">Invite your friends!</h2>
		</div>
		
		<div id="invitation_left_box">
			<div style="text-align: center; margin: 5px">You have</div>
			<div class="invitation-left">
				<?php echo $invitation['invitation_left'] ; ?>
			</div>
			<div style="text-align: center; margin: 5px">Invitation left</div>
		</div>
		
		<?php if ($invitation['invitation_left'] > 0) { ?>
			<div style="margin: 10px 0;">
				Invite your friends!
			</div>
			<form>
				<input type="email" placeholder="your friends email">
				<input type="submit" value="Invite" name="invite" id="invite" class="button" style="padding:5px 25px;font-size: 110%;">
			</form>
		<?php } else { ?>
			<p>Don't worry, hang in there, we will be sending you some real soon! :)</p>
		<?php }?>
		<br />
	</div>
</div>