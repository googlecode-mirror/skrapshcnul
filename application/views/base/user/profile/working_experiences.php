<div class="profile-summary-large">
	<div class="profile_card_data">
		<?php if(!empty($profile['positions'])) { ?>
			<div class="header">
				<strong>Working Experience</strong>
			</div>
			<ul>
			<?php $i = 0; ?>
			<?php foreach($profile['positions'] as $position) { ?>
				<li><?php echo $position['title'] ?> at <?php echo $position['company']['name'] ?></li>
				<?php  if (++$i > 6) { break; }  ?>
			<?php } ?>
			</ul>
		<?php } ?>
	</div>
</div>