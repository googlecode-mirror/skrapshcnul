<div class="m-content">
	<div id="places-container" class="c-pages shadow-rounded" style="padding: 0px;">
		
		<div class="dashboard-activity">
			<div class="places-summary-large">
				<div class="places-logo">
					<img src="<?php echo $places['logo'] ?>" />
				</div>
				<div class="places-featured-data">
					<?php $this -> load -> view("base/places/includes/place_info.php");?>
				</div>
				<div class="place-featured-statistics">
					<?php $this -> load -> view("base/places/includes/statistics.php");?>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		
		<div class="m-content-2-col-left-xl">
			<div class="others">
				<?php $this -> load -> view("base/places/includes/google_maps.php");?>
			</div>
			
			<?php $this -> load -> view("base/places/includes/people_here.php");?>
			<?php $this -> load -> view("base/places/includes/recent_lunches.php");?>
			
		</div>
		
		<div class="m-content-2-col-right-xs">
			<?php $this -> load -> view("base/places/sidebar/share.php");?>
			<?php $this -> load -> view("base/places/sidebar/claim.php");?>
		</div>
		
		<?php //var_dump($places) ?>
		
		<div class="clearfix">&nbsp;</div>
	</div>
</div>
<div class="clearfix">&nbsp;</div>
