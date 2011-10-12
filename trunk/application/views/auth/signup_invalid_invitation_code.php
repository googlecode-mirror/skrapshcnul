<div class="m-content">
	<div class="mainInfo">
		<div class="forms">
			<div id="login_form">
				<h1>Signup</h1>
				<?php if ($invitation_key) {
				?>
				<div class="ui-widget">
					<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
						<p>
							<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
							<strong>Opps...</strong> You have entered an invalid invitation code.
						</p>
					</div>
				</div>
				<?php }?>
				<br />
				<div class="invitation-box">
					<form id="invitation-signup" action="/auth/signup" method="post">
						<input id="invitation_key" name="invitation_key" type="text" size="10" placeholder="Invitation key" style="float: left;" required="required" />
						<input type="submit" value="Sign up" style="float:left; padding: 8px; margin: 0 5px;" />
					</form>
					<div class="clearfix"></div>
					<div>
						Don't have invitation key? Sign up to become our Alpha testers <?php echo anchor('http://eepurl.com/ftkI-/', 'here', 'style="text-decoration:underline;"');?>.
					</div>
				</div>
				<br />
			</div>
		</div>
		<div class="clearfix"></div>
		<br>
	</div>
</div>