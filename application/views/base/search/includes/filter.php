<ul class="nav nav-tabs filter">
	<li class="active">
		<a href="#home" data-toggle="tab">People</a>
	</li>
	<li>
		<a href="#projects" data-toggle="tab">Project</a>
	</li>
	<li>
		<a href="#places" data-toggle="tab">Places</a>
	</li>
</ul>
<div class="tab-content">
	<div class="tab-pane active" id="home">
		...
	</div>
	<div class="tab-pane" id="projects">
		...
	</div>
	<div class="tab-pane" id="places">
		...
	</div>
</div>
<script>
	$(function() {
		$('.tabs a:last').tab('show')
	})
	$('a[data-toggle="tab"]').on('shown', function(e) {
		alert();
		e.target
		e.relatedTarget
	})
</script>
