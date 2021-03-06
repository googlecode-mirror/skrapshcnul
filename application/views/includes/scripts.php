
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo isset($head_title) ? $head_title : 'Lunchsparks';?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta charset="UTF-8">
<link rel="stylesheet" href="<?php echo base_url();?>skin/libs/jquery.ui.stars-3.0/jquery.ui.stars.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url();?>skin/libs/bootstrap/css/bootstrap.min.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url();?>skin/libs/bootstrap/css/bootstrap-responsive.min.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url();?>skin/css/ext-icons/css/ext-icons.css" type="text/css" media="screen" charset="utf-8" />

<link rel="stylesheet" href="<?php echo base_url();?>skin/libs/jquery-ui/jquery-ui-1.8.17/css/smoothness/jquery-ui-1.8.17.custom.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url();?>skin/libs/jquery.iphone-switch/jquery.iphone-switch.css" type="text/css" media="screen" charset="utf-8" />


<!-- JavaScripts -->
<?php ## Fonts ?>
<link href='http://fonts.googleapis.com/css?family=Gloria+Hallelujah' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold&v1' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400' rel='stylesheet' type='text/css'>

<script src="<?php echo base_url();?>skin/libs/jquery/jquery-1.7.2.min.js"></script>
<script src="<?php echo base_url();?>skin/libs/jquery-ui/jquery-ui-1.8.17/js/jquery-ui-1.8.17.custom.min.js"></script>
<script src="<?php echo base_url();?>skin/libs/desandro-masonry/jquery.masonry.min.js"></script>
<script src="<?php echo base_url();?>skin/libs/jquery-cookie/jquery.cookie.js"></script>
<script src="<?php echo base_url();?>skin/libs/jquery-flip-0.9.9/jquery.flip.min.js"></script>
<script src="<?php echo base_url();?>skin/libs/jquery-tipsy/javascripts/jquery.tipsy.js"></script>
<script src="<?php echo base_url();?>skin/libs/jquery-ui-timepicker-addon.js"></script>
<script src="<?php echo base_url();?>skin/libs/paulirish-infinite-scroll/jquery.infinitescroll.min.js"></script>
<script src="<?php echo base_url();?>skin/libs/jquery.iphone-switch/jquery.iphone-switch.js"></script>
<script src="<?php echo base_url();?>skin/libs/jquery.ui.stars-3.0/jquery.ui.stars.js"></script>
<script src="<?php echo base_url();?>skin/libs/knockout/knockout-2.0.0.js"></script>
<script src="<?php echo base_url();?>skin/libs/modernizr.custom.90595.js"></script>
<script src="<?php echo base_url();?>skin/libs/webfont.js"></script>
<script src="<?php echo base_url();?>skin/libs/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>skin/libs/yqlgeo/yqlgeo.js"></script>
<script src="<?php echo base_url();?>skin/libs/bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>skin/libs/underscore/underscore-min.js"></script>
<script src="<?php echo base_url();?>skin/libs/backbone/backbone-min.js"></script>


<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyApOFb7Kw0EGguo5j2Al7gUUq9JNqIH4aM&sensor=true&libraries=geometry,places"></script>

<?php echo $css_combined; ?>
<?php echo $js_combined; ?>
<?php ## Dynamic scripts?>
<script language="javascript"><?php $this->load->view('includes/js/ls_notifications'); ?></script>

<!-- Googe Analytics -->
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-26287683-1']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script');
		ga.type = 'text/javascript';
		ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ga, s);
	})();

	_gaq.push(['_trackEvent', 'Memory Usage', 'action', '<?php echo $_SERVER['REQUEST_URI']?>', <?php echo intval(memory_get_usage()/1024/1024)  ?>, true]);
</script>

<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->

<?php # ------------- Removed -------------------- ?>
<?php /*<script src="<?php echo base_url();?>skin/libs/angularjs/angular-0.9.19.min.js" ng:autobind></script>*/ ?>
<?php /*
<!-- start Mixpanel -->
<script type="text/javascript">var mpq=[];mpq.push(["init","5f033e0ea3da3e277ef6cdd07d582b36"]);(function(){var b,a,e,d,c;b=document.createElement("script");b.type="text/javascript";b.async=true;b.src=(document.location.protocol==="https:"?"https:":"http:")+"//api.mixpanel.com/site_media/js/api/mixpanel.js";a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(b,a);e=function(f){return function(){mpq.push([f].concat(Array.prototype.slice.call(arguments,0)))}};d=["init","track","track_links","track_forms","register","register_once","identify","name_tag","set_config"];for(c=0;c<d.length;c++){mpq[d[c]]=e(d[c])}})();
</script><!-- end Mixpanel -->
 */ ?>