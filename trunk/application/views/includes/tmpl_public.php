<!doctype html>
<html>
	<head http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<?php $this -> load -> view('includes/scripts');?>
	</head>
	<body>
		<?php $this -> load -> view('includes/header');?><div class="clearfix"></div>
		<div id="m-container-outer">
				<?php $this -> load -> view($main_content);?>
		</div><div class="clearfix"></div>
		<?php $this -> load -> view('includes/footer');?><div class="clearfix"></div>
	</body>
</html>
