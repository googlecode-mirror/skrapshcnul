<!doctype html>
<html xmlns:ng="http://angularjs.org">
	<head http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<?php $this -> load -> view('includes/scripts');?>
	</head>
	<body onload="bodyLoad();">
		<?php $this -> load -> view('includes/system_notifications');?><div class="clearfix"></div>
		<?php $this -> load -> view('includes/header');?><div class="clearfix"></div>
		<div id="m-container-outer">
			<div id="m-container">
				<div class="m-wrapper">
					<?php $this -> load -> view($main_content);?>
				</div>
			</div>
		</div><div class="clearfix"></div>
		<?php $this -> load -> view('includes/footer');?><div class="clearfix"></div>
	</body>
</html>
