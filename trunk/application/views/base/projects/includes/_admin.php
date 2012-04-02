<?php if ($has_edit_permission == TRUE) { ?>
<div class="clearfix">&nbsp;</div>
<ul class="nav nav-pills pull-left">
	<li>
		<div class="btn-group">
      		<a class="btn btn-primary" href="/projects/edit/<?php echo $project['project_id'];?>"><i class="icon-pencil icon-white"></i> Edit This Page</a>
			<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li>
					<a href="#"><i class="icon-trash"></i> Delete</a>
				</li>
				<?php /*
				<li>
					<a href="/projects/edit/<?php echo $project['project_id'];?>"><i class="icon-pencil"></i> Edit</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="#"><i class="icon-user"></i> Manage Admin</a>
				</li> */ ?>
			</ul>
    	</div>
	</li>
</ul>
<div class="clearfix"></div>
<?php }?>