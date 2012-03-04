<div class="m-content">
	<div class="c-pages radial-grey shadow-rounded">
		<div class="forms">
			<div class="column-2-left">
				<div id="login_form">
					<h1>Signup</h1>
					<?php if (isset($invitation_key_val) && !empty($invitation_key_val)) {
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
							<input id="invitation_key" name="invitation_key" type="text" size="10" placeholder="Invitation key" style="display: inline-block; vertical-align: middle;" required="required" />
							<input type="submit" value="Sign up" style="display: inline-block; vertical-align: middle; padding: 8px; margin: 0 5px;" />
						</form>
						<div class="clearfix"></div>
						<div class="box-padding">
							Don't have invitation key? Sign up to become our Alpha testers <?php echo anchor('http://eepurl.com/ftkI-/', 'here', 'style="text-decoration:underline;"');?>.
						</div>
					</div>
					<br />
				</div>
			</div>
			<div class="column-2-right" style="text-align: center;">
				<h2>Already have an account?</h2>
				<div style="text-align: center;margin: 10px auto;">
					<a href="/auth/login" class="button xl">Login Here!</a>
				</div>
				
			</div>
		</div>
		<div class="clearfix"></div>
		<br>
	</div>
</div>