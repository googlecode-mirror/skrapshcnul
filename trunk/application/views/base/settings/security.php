<div class="container">

	<div class="row-fluid">
		<div class="span3">
			<?php $this -> load -> view('base/settings/includes/sidetab'); ?>
		</div>
		<div class="span9 hasLeftCol">
			<div class="content-area">

				<div class="hr">
					<h2 class="hr-text"><?php echo $tpl_page_title; ?></h2>
				</div>

				<form method="post" class="form-horizontal">
					<fieldset>

						<legend>
							Security Settings
						</legend>

						<div class="control-group">
							<label class="control-label" for="input01">Password</label>
							<div class="controls">
								<a href="/auth/change_password" class="btn"> Change Password </a>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="input01">Secure Browsing</label>
							<div class="controls">
								<div class="pull-left">
									<div id="secure_browsing_switch"></div>
								</div>
							</div>
						</div>

					</fieldset>
				</form>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

<?php
if (!empty($settings['security']['secure_browsing'])) {
	$secure_browsing = $settings['security']['secure_browsing'] ? 'on' : 'off';
} else {
	$secure_browsing = 'off';
}
?>

<script>
		jQuery(function() {
	jQuery( "#secure_browsing_switch" ).iphoneSwitch('<?php echo $secure_browsing; ?>
		',
		function() {
		//$('#ajax').load('on.html');
		console.log('on');
		jQuery.getJSON('/settings/security?alt=json&callback=?', {
		datafld: 'secure_browsing',
		value: 1
		}, function(data) {
		//console.log(data);
		});
		},
		function() {
		//$('#ajax').load('off.html');
		console.log('off');
		jQuery.getJSON('/settings/security?alt=json&callback=?', {
		datafld: 'secure_browsing',
		value: 0
		}, function(data) {
		//console.log(data);
		});
		},
		{
		switch_on_container_path: '/skin/js/jquery.iphone-switch/iphone_switch_container_on.png',
		switch_off_container_path: '/skin/js/jquery.iphone-switch/iphone_switch_container_off.png',
		switch_path: '/skin/js/jquery.iphone-switch/iphone_switch.png',
		});

		});
</script>