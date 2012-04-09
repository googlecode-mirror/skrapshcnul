<div id="container" class="projects container">
	<div style="padding:20px; min-height: 500px;">
		<?php $this -> load -> view("base/search/includes/_tags_menu.php");?>
		<div class="clearfix">&nbsp;</div>
		
		<?php $this -> load -> view("base/search/tags/_tags_description.php");?>
		<div class="clearfix">&nbsp;</div>
		
		<ul class="nav nav-tabs filter">
			<li>
				<a href="#people" data-toggle="tab" data-source="/search/tag/<?php echo isset($q['tags']) ? $q['tags'] : '' ?>/?type=people">People</a>
			</li>
			<li>
				<a href="#projects" data-toggle="tab" data-source="/search/tag/<?php echo isset($q['tags']) ? $q['tags'] : '' ?>/?type=project">Project</a>
			</li>
			<?php /* 
			<li>
				<a href="#places" data-toggle="tab" data-source="/search/tag/<?php echo isset($q['tags']) ? $q['tags'] : '' ?>/?type=people">People</a>
			</li> */ ?>
		</ul>
		
		<div class="tab-content">
			<div class="tab-pane" id="people">
				<?php $this -> load -> view("base/search/tags/people.php");?>
			</div>
			<div class="tab-pane" id="projects">
				<?php $this -> load -> view("base/search/tags/projects.php");?>
			</div>
			<div class="tab-pane" id="places">
				<?php if (isset($places) && is_array($places)) { ?>
					<?php $this -> load -> view("base/search/tags/places.php");?>
				<?php } ?>
			</div>
		</div>
		<script>
			$(function() {
				$('.nav-tabs a[href=#<?php echo ($filter) ?>]').tab('show')
			})
			$('a[data-toggle="tab"]').on('shown', function(e) {
				//if (jQuery.trim(jQuery(e.target.hash).html()) == '') {
					//jQuery(e.target.hash).html('<div class="loading-icon-overlay"><div class="loading-icon rotate">&nbsp;</div></div>');
					jQuery(e.target.hash).html('<div class="loading-icon-gif">&nbsp;</div>');
					jQuery(e.target.hash).load(e.target.dataset.source + ' ' + e.target.hash + ' > * ');
				//};
			})
		</script>
		<div class="clearfix">
			&nbsp;
		</div>
	</div>
</div>
<div class="clearfix">
	&nbsp;
</div>
<script>
	jQuery(function() {
		init();
	})
	function init() {
		$('#content').infinitescroll({

			navSelector : "div.navigation",
			// selector for the paged navigation (it will be hidden)
			nextSelector : "div.navigation a:first",
			// selector for the NEXT link (to page 2)
			itemSelector : "#content div.pin",
			// selector for all items you'll retrieve
			loading : {
				msgText : "Loading more results...",
				finishedMsg : "End of results."
			}
		});
	}
</script>