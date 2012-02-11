
<div class="m-content">
	<div class="c-pages shadow-rounded">
		<h2><?php echo $tpl_page_title; ?></h2>
		<h3 class="sub-heading">We would appreciate if you could provide feedback regarding your lunch! :)</h3>
		
		<div class="section">
			You just had lunch at <?php echo $event_info['restaurant_info']['name']; ?> with 
			<?php foreach($event_info['buddies_info'] as $buddy) { ?>
				<a href=<?php echo $buddy['rec_id_profile']['ls_pub_url']; ?>> <?php echo $buddy['rec_id_profile']['firstname'] ?> </a>
			<?php } ?>
		</div>
			
		<form class="section">
			<div class="row-item">
				<div class="section-top">
					Lunch Buddy Rating
				</div>
				<div class="section-middle">
					2. Rating <a href=<? echo '/pub/' . $event_info -> partner -> alias; ?>> <? echo $event_info -> partner -> firstname ?></a>:
					<span id="stars-cap"></span>
					<div id="stars-wrapper3" class="abc">
						<select name="selrate">
							<option value="1" selected="selected">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
					<br>
					<br>
					<textarea style="width: 300px;height: 60px;">testimonial</textarea>
					<br>
					<br>
				</div>
			</div>
			
			
			<div class="row-item">
				<div class="section-top">
					Lunch Buddy Rating
				</div>
				<div class="section-middle">
					
				</div>
			</div>
			1. Rating <? echo $event_info -> restaurant -> name; ?>: 
			<span id="stars-cap"></span>
			<div id="stars-wrapper2" class="abc">
				<select name="selrate">
					<option value="1" selected="selected">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</div>
			<br>
			<br>
			<textarea style="width: 300px;height: 60px;">testimonial</textarea>
			<br>
			<br>
			
			
			<div class="row-item">
				<input type="submit" value="submit"/>
			</div>
		</form>	
		
		
		<?php var_dump($event_info['buddies_info']) ?>	
		<?php var_dump($event_info); ?>
		
	</div>
</div>



