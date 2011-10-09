<!doctype html>
<html xmlns:ng="http://angularjs.org">
	<head http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<?php $this -> load -> view('includes/scripts');?>
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map_canvas { height: 100% }
    </style>
	</head>
  
	<body onload="bodyLoad(); initialize_lunchsparks_googlemap();">
    <?php $this -> load -> view('includes/system_notifications');?><div class="clearfix"></div>
		<?php $this -> load -> view('includes/header');?><div class="clearfix"></div>
		
		<?php $this -> load -> view($main_content);?>
    
		<div class="clearfix"></div>
    <?php $this -> load -> view('includes/footer');?><div class="clearfix"></div>
	</body>
</html>
