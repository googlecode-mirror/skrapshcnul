<div class="m-content">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('invitations/includes/sidetab');?>
	</div>
	<div class="m-content-2-col-right">
		<p>You have <?php echo isset($invites_available) ? $invites_available : '0' ; ?> invites in your account.</p>
		
		<?php if (isset($invites_available) && $invites_available > 0) { ?>
			<form>
				<input type="email">
			</form>
		<?php } else { ?>
			<p>Don't worry, hang in there, we will be sending you some real soon! :)</p>
		<?php }?>
		<br />
	</div>
</div>