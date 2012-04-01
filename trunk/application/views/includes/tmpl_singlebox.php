<!doctype html>
<html class="singlebox">
	<head http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<?php $this -> load -> view('includes/scripts');?>
	</head>
	<body onload="bodyLoad();" class="singlebox">
		<div class="container">
			<?php $this -> load -> view('includes/_background_effects');?>
			<?php $this -> load -> view('includes/system_notifications');?>
			<div class="clearfix"></div>
		</div>
		
		<div id="m-container-outer">
			<div class="logo-home">
				<a href="/"><img src="/skin/images/ls_logo_white.png" /></a>
			</div>
			<div class="clearfix">&nbsp;</div>
			<div id="m-container">
				<div class="m-wrapper">
					<?php $this -> load -> view($main_content);?>
				</div>
			</div>
			<div class="clearfix">&nbsp;</div>
		</div>
	</body>
</html>
