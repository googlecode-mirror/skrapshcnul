<div style="text-align: right;">
	
	<!-- Place this tag where you want the +1 button to render -->
	<g:plusone href="<?php echo base_url("pub/".$this -> session -> userdata('user_id')); ?>"></g:plusone>
	
	<!-- Place this render call where appropriate -->
	<script type="text/javascript">
	  (function() {
	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	    po.src = 'https://apis.google.com/js/plusone.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>
	
</div>
