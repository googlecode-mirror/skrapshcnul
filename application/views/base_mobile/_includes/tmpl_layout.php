<!doctype html>
<html>
	<head http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<?php $this -> load -> view($this -> data['theme'].'_includes/scripts');?>
	</head>
	<body onLoad="bodyLoad();">
		<?php $this -> load -> view($this -> data['theme'].'_includes/header');?><div class="clearfix"></div>
		<div id="m-container-outer">
			<div id="m-container">
				<div class="m-wrapper">
					<?php $this -> load -> view($this -> data['theme'].$main_content);?>
				</div>
			</div>
		</div><div class="clearfix"></div>
		<?php $this -> load -> view($this -> data['theme'].'_includes/footer');?><div class="clearfix"></div>
	</body>
</html>
