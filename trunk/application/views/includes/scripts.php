<title><?php echo $head_title = 'Lunchsparks';?></title>
<link rel="stylesheet" href="<?php echo base_url();?>skin/css/style.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url();?>skin/css/layout.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url();?>skin/css/carousel.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url();?>skin/js/jquery-ui-1.8.16/css/smoothness/jquery-ui-1.8.16.custom.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url();?>skin/css/notification_icons.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url();?>skin/css/user.css" type="text/css" media="screen" charset="utf-8" />

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold&v1' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400' rel='stylesheet' type='text/css'>
<!-- Scripts -->
<?php /*
	 ?><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.0.22/webfont.js"></script><?php */
?>

<!-- offline -->
<script src="<?php echo base_url();?>skin/js/modernizr.custom.90595.js"></script>
<script src="<?php echo base_url();?>skin/js/jquery-1.6.4.min.js"></script>
<script src="<?php echo base_url();?>skin/js/jquery-ui-1.8.16/js/jquery-ui-1.8.16.custom.min.js"></script>
<script src="<?php echo base_url();?>skin/js/webfont.js"></script>
<script src="<?php echo base_url();?>skin/js/ls_notifications.js"></script>
<script src="<?php echo base_url();?>skin/js/lunchsparks.js"></script>


<?php if (isset($timepicker) && $timepicker == true) { ?>
  <script src="<?php echo base_url();?>skin/js/jquery-ui-timepicker-addon.js"></script>
<?php } ?>
  
<?php if (isset($googlemap) && $googlemap == true) { ?>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=geometry"></script>
  <script type="text/javascript" src="<?php echo base_url();?>skin/js/googlemap/ls_googlemap.js"></script>
<?php } ?>  


<?php // Dynamic scripts?>
<script language="javascript"><?php $this->load->view('includes/js/ls_notifications')
?></script>
