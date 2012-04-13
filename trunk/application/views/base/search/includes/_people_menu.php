<?php /* <h1><?php echo $tpl_page_title ?> <small>Awesome users on Lunchsparks.</small></h1> */ ?>
<ul class="nav nav-pills pull-left">
	<li>
		<h2>Search &nbsp;</h2>
	</li>
	<li>
		<div class="btn-group">
			<button class="btn btn-large dropdown-toggle" data-toggle="dropdown">People <span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a href="/search/projects/<?php echo ($_SERVER['QUERY_STRING']) ? '?' . ($_SERVER['QUERY_STRING']) : ''; ?>">Projects </a></li>
				<li><a href="/search/tags/<?php echo ($_SERVER['QUERY_STRING']) ? '?' . ($_SERVER['QUERY_STRING']) : ''; ?>">Tags </a></li>
			</ul>
		</div>
	</li>
</ul>


<ul class="nav nav-pills pull-right">
	<li>
		<form method="get" class="search pull-left" style="margin: 6px 10px 0 10px">
			<input name="q[people]" value="<?php echo isset($q['people']) ? $q['people'] : '' ?>" type="text" class="search-query span2" placeholder="Search">
		</form>
	</li>
</ul>