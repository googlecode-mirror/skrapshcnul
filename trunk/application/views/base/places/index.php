<div class="m-content">
	<div id="places-container" class="c-pages shadow-rounded" style="padding: 0px;">
		
		<div class="dashboard-activity" style="padding: 15px 10px;">
			<div class="row-fluid places-summary-large">
				<div class="span2" style="text-align: center";> <?php //places-logo ?>
					<?php if (isset($places['logo']) && $places['logo']) { ?>
						<img src="<?php echo $places['logo'] ?>" />
					<?php } ?>
				</div>
				<div class="span7 places-featured-data"> <?php // ?>
					<?php $this -> load -> view("base/places/includes/place_info.php");?>
				</div>
				<div class="span3 place-featured-statistics"> <?php // ?>
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
