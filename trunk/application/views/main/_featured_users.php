<div id="lunchsparks-features">
	<?php
	$featured_users[] = array('name' => 'Bhagaban Behera', 'company' => 'Founder of Noisestreet and Redsparro <br />Singapore Founder Institute', 'photo' => 'bhagaban_behera.jpg');
	$featured_users[] = array('name' => 'Chan Yi Seng', 'company' => 'Founder of Deals89<br />Founder of Storepair', 'photo' => 'chan_yi_seng.jpg');
	$featured_users[] = array('name' => 'Joash Wee', 'company' => 'Community Manager at e27 <br />Cofounder of Pandamian', 'photo' => 'joash_wee.jpg');
	$featured_users[] = array('name' => 'Virginia Cha', 'company' => 'INSEAD Adjunct Professor of Entrepreneurship<br />Chairperson, RAVE China Investments Holdings Pte. Ltd. ', 'photo' => 'virginia_cha.jpg');
	$featured_users[] = array('name' => '', 'company' => 'Could this be you?', 'photo' => 'silhouette.jpg');
	?>
	<div class="hr">
		<h2 class="hr-text">Users on Lunchsparks</h2>
	</div>
	<?php foreach($featured_users as $item) { ?>
	<div class="featured-user">
		<div class="photo">
			<img src="/skin/images/p/featured_users/<?php echo $item['photo']; ?>" />
		</div>
		<div class="name">
			<span><?php echo $item['name']; ?></span>
		</div>
		<div class="company"><?php echo $item['company']; ?></div>
	</div>
	<?php } ?>
	<div class="clearfix"></div>
</div>