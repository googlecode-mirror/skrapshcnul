
<!doctype html>
<html>
	<head http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<?php $this -> load -> view('includes/scripts');?>
	</head>
	<body onload="bodyLoad();">
		<?php $this -> load -> view('includes/system_notifications');?><div class="clearfix"></div>
		<?php $this -> load -> view('includes/header');?><div class="clearfix"></div>
		<div id="m-container-outer">
			<div id="m-container">
				<div class="m-wrapper">
					
					<?php if ($is_logged_in) { ?>
						<?php $is_in = array('settings', 'user', 'schedules', 'events'); ?>
						<?php if (in_array(current(explode('/', $main_content)), $is_in)) { ?> 
							<?php if (!$steps_completed['is_disabled']) { ?>
								<?php $this -> load -> view('includes/_steps_completed');?>
							<?php } ?>
						<?php } ?>
					<?php } ?>
					
					<?php $this -> load -> view($main_content);?>
				</div>
			</div>
		</div><div class="clearfix"></div>
		<?php $this -> load -> view('includes/footer');?><div class="clearfix"></div>
	</body>
	<script>
		mpq.name_tag('<?php echo $this->session->userdata['email']?>');
	</script>
</html>
