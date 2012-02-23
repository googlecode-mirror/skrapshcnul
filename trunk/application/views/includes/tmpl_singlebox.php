<!doctype html>
<html>
	<head http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<?php $this -> load -> view('includes/scripts');?>
	</head>
	<body onload="bodyLoad();" class="singlebox">
		<?php $this -> load -> view('includes/system_notifications');?><div class="clearfix"></div>
		<div id="m-container-outer">
			<div class="logo-home">
				<a href="/"><img src="/skin/images/ls_logo_white.png" /></a>
			</div>
			<div id="m-container">
				<div class="m-wrapper">
					<?php $this -> load -> view($main_content);?>
				</div>
			</div>
		</div><div class="clearfix"></div>
	</body>
</html>
